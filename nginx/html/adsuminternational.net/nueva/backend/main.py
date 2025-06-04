# backend/main.py
from fastapi import FastAPI, Depends, HTTPException, Form, Body, status
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from fastapi.security import OAuth2PasswordRequestForm
from sqlalchemy.orm import Session
from typing import List, Optional, Dict, Any
from datetime import timedelta
import json
import os
from datetime import datetime
from dotenv import load_dotenv

# Cargar variables de entorno
load_dotenv()

from models import models
from schemas import schemas
from core import database
from core.auth import (
    authenticate_user, 
    create_access_token, 
    ACCESS_TOKEN_EXPIRE_MINUTES,
    verify_password,
    oauth2_scheme,
    get_current_user,
    get_current_active_user,
    get_admin_user
)

# Inicialización de FastAPI
app = FastAPI(title="Adsum Blockchain API", description="API para Adsum Blockchain Platform")

# Configuración CORS
# Obtener orígenes permitidos de variables de entorno o usar wildcard en desarrollo
cors_origins = os.getenv("CORS_ORIGINS", "*")
if cors_origins != "*":
    # Si hay una lista de orígenes, convertirla a lista
    cors_origins = [origin.strip() for origin in cors_origins.split(",")]

app.add_middleware(
    CORSMiddleware,
    allow_origins=cors_origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Funciones de dependencia con acceso a la base de datos
def get_current_user_dep(token: str = Depends(oauth2_scheme), db: Session = Depends(database.get_db)) -> models.User:
    return get_current_user(token, db)

def get_current_active_user_dep(current_user: models.User = Depends(get_current_user_dep)) -> models.User:
    return get_current_active_user(current_user)

def get_admin_user_dep(current_user: models.User = Depends(get_current_active_user_dep)) -> models.User:
    return get_admin_user(current_user)

# Eventos de inicio
@app.on_event("startup")
async def startup_event():
    # Crear tablas si no existen
    database.init_db()
    
    # Crear intereses predefinidos
    db = next(database.get_db())
    if db.query(models.Interest).count() == 0:
        database.create_default_interests(db)
    
    # Crear usuario admin por defecto
    database.create_default_admin(db)

# ===== Endpoints de Autenticación =====
@app.post("/api/auth/login", response_model=schemas.Token)
def login_for_access_token(form_data: OAuth2PasswordRequestForm = Depends(), db: Session = Depends(database.get_db)):
    user = authenticate_user(db, form_data.username, form_data.password)
    if not user:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Incorrect username or password",
            headers={"WWW-Authenticate": "Bearer"},
        )
    
    # Actualizar último login
    database.update_last_login(db, user.id)
    
    access_token_expires = timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES)
    access_token = create_access_token(
        data={"sub": user.username}, expires_delta=access_token_expires
    )
    return {"access_token": access_token, "token_type": "bearer"}

@app.post("/api/auth/register", response_model=schemas.User)
def register_user(user: schemas.UserCreate, db: Session = Depends(database.get_db)):
    # Verificar si el usuario ya existe
    db_user_email = database.get_user_by_email(db, email=user.email)
    if db_user_email:
        raise HTTPException(status_code=400, detail="Email already registered")
    
    db_user_username = database.get_user_by_username(db, username=user.username)
    if db_user_username:
        raise HTTPException(status_code=400, detail="Username already taken")
    
    return database.create_user(db=db, user=user)

@app.get("/api/auth/me", response_model=schemas.User)
def read_users_me(current_user: models.User = Depends(get_current_active_user_dep)):
    return current_user

@app.put("/api/auth/me", response_model=schemas.User)
def update_user_me(
    user_update: schemas.UserUpdate,
    current_user: models.User = Depends(get_current_active_user_dep),
    db: Session = Depends(database.get_db)
):
    return database.update_user(db, current_user.id, user_update)

@app.post("/api/auth/change-password", response_model=schemas.SuccessResponse)
def change_password(
    password_data: schemas.ChangePasswordRequest,
    current_user: models.User = Depends(get_current_active_user_dep),
    db: Session = Depends(database.get_db)
):
    # Verificar contraseña actual
    if not verify_password(password_data.current_password, current_user.hashed_password):
        raise HTTPException(status_code=400, detail="Incorrect current password")
    
    # Cambiar contraseña
    database.change_password(db, current_user.id, password_data.new_password)
    return schemas.SuccessResponse(message="Password changed successfully")

# ===== Endpoints de Administración de Usuarios (solo admin) =====
@app.get("/api/admin/users", response_model=List[schemas.User])
def read_users(
    skip: int = 0, 
    limit: int = 100, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    users = database.get_users(db, skip=skip, limit=limit)
    return users

@app.post("/api/admin/users", response_model=schemas.User)
def create_user_by_admin(
    user: schemas.UserCreate,
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    # Verificar si el usuario ya existe
    db_user_email = database.get_user_by_email(db, email=user.email)
    if db_user_email:
        raise HTTPException(status_code=400, detail="Email already registered")
    
    db_user_username = database.get_user_by_username(db, username=user.username)
    if db_user_username:
        raise HTTPException(status_code=400, detail="Username already taken")
    
    return database.create_user(db=db, user=user)

@app.get("/api/admin/users/{user_id}", response_model=schemas.User)
def read_user(
    user_id: int,
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    db_user = database.get_user(db, user_id=user_id)
    if db_user is None:
        raise HTTPException(status_code=404, detail="User not found")
    return db_user

@app.put("/api/admin/users/{user_id}", response_model=schemas.User)
def update_user(
    user_id: int,
    user_update: schemas.UserUpdate,
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    db_user = database.update_user(db, user_id, user_update)
    if db_user is None:
        raise HTTPException(status_code=404, detail="User not found")
    return db_user

# ===== Endpoints para leads y early adopters =====
@app.post("/api/leads", response_model=schemas.Lead)
def create_lead(lead: schemas.LeadCreate, db: Session = Depends(database.get_db)):
    db_lead = database.get_lead_by_email(db, email=lead.email)
    if db_lead:
        raise HTTPException(status_code=400, detail="Email already registered")
    return database.create_lead(db=db, lead=lead)

@app.post("/api/early-adopters", response_model=schemas.Lead)
def create_early_adopter(adopter: schemas.LeadCreate, db: Session = Depends(database.get_db)):
    db_lead = database.get_lead_by_email(db, email=adopter.email)
    if db_lead:
        raise HTTPException(status_code=400, detail="Email already registered")
    return database.create_lead(db=db, lead=adopter, is_early_adopter=True)

@app.get("/api/leads", response_model=List[schemas.Lead])
def read_leads(
    skip: int = 0, 
    limit: int = 100, 
    segment: Optional[str] = None, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    leads = database.get_leads(db, skip=skip, limit=limit, segment=segment)
    return leads

@app.get("/api/early-adopters", response_model=List[schemas.Lead])
def read_early_adopters(
    skip: int = 0, 
    limit: int = 100, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    adopters = database.get_early_adopters(db, skip=skip, limit=limit)
    return adopters

@app.get("/api/leads/{lead_id}", response_model=schemas.Lead)
def read_lead(
    lead_id: int, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    db_lead = database.get_lead(db, lead_id=lead_id)
    if db_lead is None:
        raise HTTPException(status_code=404, detail="Lead not found")
    return db_lead

# ===== Endpoints para insignias =====
@app.post("/api/badges", response_model=schemas.Badge)
def award_badge_to_lead(
    badge: schemas.BadgeCreate, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    db_lead = database.get_lead(db, lead_id=badge.lead_id)
    if db_lead is None:
        raise HTTPException(status_code=404, detail="Lead not found")
    
    return database.award_badge(db, lead_id=badge.lead_id, badge_type=badge.badge_type)

@app.get("/api/leads/{lead_id}/badges", response_model=List[schemas.Badge])
def read_lead_badges(
    lead_id: int, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    db_lead = database.get_lead(db, lead_id=lead_id)
    if db_lead is None:
        raise HTTPException(status_code=404, detail="Lead not found")
    
    return database.get_lead_badges(db, lead_id=lead_id)

# ===== Endpoints para contenidos multiidioma =====
@app.post("/api/content", response_model=schemas.Content)
def create_content(
    content: schemas.ContentCreate, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    return database.create_content(db=db, content=content)

@app.get("/api/content/{key}", response_model=schemas.Content)
def get_content(key: str, language: str = "en", version: Optional[int] = None, db: Session = Depends(database.get_db)):
    content = database.get_content(db=db, key=key, language=language, version=version)
    if content is None:
        raise HTTPException(status_code=404, detail="Content not found")
    return content

@app.get("/api/content/{key}/all", response_model=List[schemas.Content])
def get_all_content_versions(
    key: str, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    contents = database.get_contents(db=db, key=key)
    if not contents:
        raise HTTPException(status_code=404, detail="Content not found")
    return contents

@app.put("/api/content/{content_id}/publish", response_model=schemas.Content)
def publish_content(
    content_id: int, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    content = database.publish_content(db=db, content_id=content_id)
    if content is None:
        raise HTTPException(status_code=404, detail="Content not found")
    return content

# ===== Endpoints para redes sociales =====
@app.post("/api/social/accounts", response_model=schemas.SocialAccount)
def create_social_account(
    account: schemas.SocialAccountCreate, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    return database.create_social_account(db=db, account=account)

@app.get("/api/social/accounts", response_model=List[schemas.SocialAccount])
def read_social_accounts(
    platform: Optional[str] = None, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    accounts = database.get_social_accounts(db=db, platform=platform)
    return accounts

@app.post("/api/social/posts", response_model=schemas.SocialPost)
def create_social_post(
    post: schemas.SocialPostCreate, 
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    return database.create_social_post(db=db, post=post)

@app.get("/api/social/posts/scheduled", response_model=List[schemas.SocialPost])
def read_scheduled_posts(
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    posts = database.get_scheduled_posts(db=db)
    return posts

@app.put("/api/social/posts/{post_id}/status", response_model=schemas.SocialPost)
def update_post_status(
    post_id: int, 
    status: str = Body(...), 
    post_url: Optional[str] = Body(None), 
    metrics: Optional[Dict[str, Any]] = Body(None),
    current_user: models.User = Depends(get_admin_user_dep),
    db: Session = Depends(database.get_db)
):
    post = database.update_post_status(
        db=db, 
        post_id=post_id, 
        status=status, 
        post_url=post_url, 
        metrics=metrics
    )
    if post is None:
        raise HTTPException(status_code=404, detail="Post not found")
    return post

# Endpoint para cargar archivos de idioma directamente
@app.get("/api/languages/{lang}")
def get_language(lang: str):
    try:
        with open(f"lang/{lang}.json", "r", encoding="utf-8") as f:
            return json.load(f)
    except FileNotFoundError:
        raise HTTPException(status_code=404, detail="Language file not found")

# Montaje de archivos estáticos
app.mount("/static", StaticFiles(directory="static"), name="static")
