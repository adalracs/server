# backend/core/database.py
from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker
import os
from typing import List, Optional, Dict, Any
from datetime import datetime

from models.models import Base, User, Lead, Interest, Badge, Content, SocialAccount, SocialPost
from schemas import schemas
from passlib.context import CryptContext

# Context para hashing de contraseñas
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

def get_password_hash(password: str) -> str:
    """Generar hash de contraseña"""
    return pwd_context.hash(password)

# Configuración de base de datos
# Por defecto usamos PostgreSQL para producción
# Si no hay variable de entorno, se usa una configuración local estándar
DEFAULT_POSTGRES_URL = "postgresql://postgres:ren-2025@localhost:5432/adsum-CMS"
DATABASE_URL = os.getenv("DATABASE_URL", DEFAULT_POSTGRES_URL)

# Si estamos en modo desarrollo y se quiere usar SQLite
USE_SQLITE = os.getenv("USE_SQLITE", "false").lower() == "true"
if USE_SQLITE:
    DATABASE_URL = "sqlite:///./adsum.db"

engine = create_engine(
    DATABASE_URL, 
    connect_args={"check_same_thread": False} if DATABASE_URL.startswith("sqlite") else {},
    # Para PostgreSQL, configuraciones recomendadas
    pool_size=5,
    max_overflow=10,
    pool_timeout=30,  # segundos
    pool_recycle=1800,  # 30 minutos
)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Función para obtener la sesión de base de datos
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# Inicializar la base de datos
def init_db():
    Base.metadata.create_all(bind=engine)

# Función para crear intereses predefinidos
def create_default_interests(db):
    default_interests = [
        {"name": "identity", "description": "Decentralized Identity Solutions"},
        {"name": "transparency", "description": "Transparency and Accountability Solutions"},
        {"name": "industrial", "description": "Industrial Applications of Blockchain"}
    ]
    
    for interest_data in default_interests:
        interest = Interest(**interest_data)
        db.add(interest)
    
    db.commit()

# Función para crear usuario admin por defecto
def create_default_admin(db):
    # Verificar si ya existe un admin
    admin = db.query(User).filter(User.is_admin == True).first()
    if admin:
        return admin
    
    # Crear admin por defecto
    admin_data = {
        "username": "admin",
        "email": "admin@adsuminternational.net",
        "full_name": "Administrador",
        "hashed_password": get_password_hash("admin123"),  # Cambiar en producción
        "is_admin": True,
        "is_active": True
    }
    
    admin_user = User(**admin_data)
    db.add(admin_user)
    db.commit()
    db.refresh(admin_user)
    
    print(f"✅ Usuario admin creado: username=admin, password=admin123")
    return admin_user

# ===== Funciones para usuarios =====
def create_user(db, user: schemas.UserCreate):
    hashed_password = get_password_hash(user.password)
    db_user = User(
        email=user.email,
        username=user.username,
        full_name=user.full_name,
        hashed_password=hashed_password,
        is_admin=user.is_admin,
        is_active=user.is_active
    )
    db.add(db_user)
    db.commit()
    db.refresh(db_user)
    return db_user

def get_user(db, user_id: int):
    return db.query(User).filter(User.id == user_id).first()

def get_user_by_email(db, email: str):
    return db.query(User).filter(User.email == email).first()

def get_user_by_username(db, username: str):
    return db.query(User).filter(User.username == username).first()

def get_users(db, skip: int = 0, limit: int = 100):
    return db.query(User).offset(skip).limit(limit).all()

def update_user(db, user_id: int, user_data: schemas.UserUpdate):
    user = db.query(User).filter(User.id == user_id).first()
    if not user:
        return None
    
    update_data = user_data.dict(exclude_unset=True)
    for key, value in update_data.items():
        if hasattr(user, key):
            setattr(user, key, value)
    
    db.commit()
    db.refresh(user)
    return user

def update_last_login(db, user_id: int):
    user = db.query(User).filter(User.id == user_id).first()
    if user:
        user.last_login = datetime.now()
        db.commit()
        db.refresh(user)
    return user

def change_password(db, user_id: int, new_password: str):
    user = db.query(User).filter(User.id == user_id).first()
    if not user:
        return None
    
    user.hashed_password = get_password_hash(new_password)
    db.commit()
    db.refresh(user)
    return user

# ===== Funciones para leads =====
def create_lead(db, lead: schemas.LeadCreate, is_early_adopter: bool = False):
    # Crear el lead
    db_lead = Lead(
        email=lead.email,
        name=lead.name,
        company=lead.company,
        segment=lead.segment,
        is_early_adopter=is_early_adopter
    )
    db.add(db_lead)
    db.flush()  # Para obtener el ID
    
    # Asociar intereses
    if lead.interests:
        for interest_name in lead.interests:
            interest = db.query(Interest).filter(Interest.name == interest_name).first()
            if interest:
                db_lead.interests.append(interest)
    
    db.commit()
    db.refresh(db_lead)
    return db_lead

def get_lead(db, lead_id: int):
    return db.query(Lead).filter(Lead.id == lead_id).first()

def get_lead_by_email(db, email: str):
    return db.query(Lead).filter(Lead.email == email).first()

def get_leads(db, skip: int = 0, limit: int = 100, segment: Optional[str] = None):
    query = db.query(Lead)
    if segment:
        query = query.filter(Lead.segment == segment)
    return query.offset(skip).limit(limit).all()

def get_early_adopters(db, skip: int = 0, limit: int = 100):
    return db.query(Lead).filter(Lead.is_early_adopter == True).offset(skip).limit(limit).all()

def update_lead(db, lead_id: int, lead_data: Dict[str, Any]):
    lead = db.query(Lead).filter(Lead.id == lead_id).first()
    if not lead:
        return None
    
    for key, value in lead_data.items():
        if hasattr(lead, key):
            setattr(lead, key, value)
    
    db.commit()
    db.refresh(lead)
    return lead

# ===== Funciones para insignias =====
def award_badge(db, lead_id: int, badge_type: str):
    # Verificar si el lead existe
    lead = get_lead(db, lead_id)
    if not lead:
        return None
    
    # Verificar si ya tiene esta insignia
    existing_badge = db.query(Badge).filter(
        Badge.lead_id == lead_id,
        Badge.badge_type == badge_type
    ).first()
    
    if existing_badge:
        return existing_badge
    
    # Crear nueva insignia
    badge = Badge(lead_id=lead_id, badge_type=badge_type)
    db.add(badge)
    db.commit()
    db.refresh(badge)
    return badge

def get_lead_badges(db, lead_id: int):
    return db.query(Badge).filter(Badge.lead_id == lead_id).all()

# ===== Funciones para contenidos =====
def create_content(db, content: schemas.ContentCreate):
    # Verificar si ya existe una versión para esta key y language
    existing_content = db.query(Content).filter(
        Content.key == content.key,
        Content.language == content.language
    ).first()
    
    if existing_content:
        # Crear nueva versión
        new_version = existing_content.version + 1
        db_content = Content(
            key=content.key,
            language=content.language,
            content=content.content,
            version=new_version,
            published=content.published
        )
    else:
        # Crear primer versión
        db_content = Content(
            key=content.key,
            language=content.language,
            content=content.content,
            version=1,
            published=content.published
        )
    
    db.add(db_content)
    db.commit()
    db.refresh(db_content)
    return db_content

def get_content(db, key: str, language: str, version: Optional[int] = None):
    query = db.query(Content).filter(Content.key == key, Content.language == language)
    
    if version:
        # Obtener versión específica
        return query.filter(Content.version == version).first()
    else:
        # Obtener versión más reciente
        return query.order_by(Content.version.desc()).first()

def get_contents(db, key: str):
    # Obtener todas las versiones para todas las lenguas
    return db.query(Content).filter(Content.key == key).all()

def publish_content(db, content_id: int):
    content = db.query(Content).filter(Content.id == content_id).first()
    if not content:
        return None
    
    content.published = True
    db.commit()
    db.refresh(content)
    return content

# ===== Funciones para cuentas sociales =====
def create_social_account(db, account: schemas.SocialAccountCreate):
    db_account = SocialAccount(
        platform=account.platform,
        account_name=account.account_name,
        auth_token=account.auth_token,
        refresh_token=account.refresh_token,
        token_expires=account.token_expires,
        active=account.active
    )
    db.add(db_account)
    db.commit()
    db.refresh(db_account)
    return db_account

def get_social_accounts(db, platform: Optional[str] = None):
    query = db.query(SocialAccount).filter(SocialAccount.active == True)
    if platform:
        query = query.filter(SocialAccount.platform == platform)
    return query.all()

def update_social_account(db, account_id: int, account_data: Dict[str, Any]):
    account = db.query(SocialAccount).filter(SocialAccount.id == account_id).first()
    if not account:
        return None
    
    for key, value in account_data.items():
        if hasattr(account, key):
            setattr(account, key, value)
    
    db.commit()
    db.refresh(account)
    return account

# ===== Funciones para publicaciones sociales =====
def create_social_post(db, post: schemas.SocialPostCreate):
    db_post = SocialPost(
        account_id=post.account_id,
        content=post.content,
        scheduled_at=post.scheduled_at,
        status="scheduled"
    )
    db.add(db_post)
    db.commit()
    db.refresh(db_post)
    return db_post

def get_scheduled_posts(db):
    return db.query(SocialPost).filter(SocialPost.status == "scheduled").all()

def update_post_status(db, post_id: int, status: str, post_url: Optional[str] = None, metrics: Optional[Dict[str, Any]] = None):
    post = db.query(SocialPost).filter(SocialPost.id == post_id).first()
    if not post:
        return None
    
    post.status = status
    if status == "published":
        post.published_at = datetime.now()
        if post_url:
            post.post_url = post_url
    
    if metrics:
        post.engagement_metrics = metrics
    
    db.commit()
    db.refresh(post)
    return post
