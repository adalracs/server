#backend/models/models.py
from sqlalchemy import Boolean, Column, DateTime, ForeignKey, Integer, String, Text, JSON, Table
from sqlalchemy.orm import relationship
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.sql import func

Base = declarative_base()

# Tabla de relación muchos a muchos para intereses de leads
lead_interests = Table(
    "lead_interests",
    Base.metadata,
    Column("lead_id", Integer, ForeignKey("leads.id")),
    Column("interest_id", Integer, ForeignKey("interests.id")),
)

class User(Base):
    """Modelo para usuarios del sistema (administradores y usuarios regulares)"""
    __tablename__ = "users"

    id = Column(Integer, primary_key=True, index=True)
    email = Column(String(255), unique=True, index=True, nullable=False)
    username = Column(String(100), unique=True, index=True, nullable=False)
    hashed_password = Column(String(255), nullable=False)
    full_name = Column(String(200))
    is_admin = Column(Boolean, default=False)
    is_active = Column(Boolean, default=True)
    created_at = Column(DateTime, default=func.now())
    last_login = Column(DateTime)

class Lead(Base):
    """Modelo para leads y early adopters"""
    __tablename__ = "leads"

    id = Column(Integer, primary_key=True, index=True)
    email = Column(String(255), unique=True, index=True, nullable=False)
    name = Column(String(100), nullable=False)
    company = Column(String(200))
    segment = Column(String(50), nullable=False)  # 'developer', 'business', 'academic', 'ngo_gov'
    is_early_adopter = Column(Boolean, default=False)
    created_at = Column(DateTime, default=func.now())
    last_contact = Column(DateTime)
    
    # Relaciones
    interests = relationship("Interest", secondary=lead_interests, back_populates="leads")
    badges = relationship("Badge", back_populates="lead")

class Interest(Base):
    """Modelo para intereses/temas que pueden interesar a los leads"""
    __tablename__ = "interests"

    id = Column(Integer, primary_key=True, index=True)
    name = Column(String(100), unique=True, nullable=False)
    description = Column(String(500))
    
    # Relaciones
    leads = relationship("Lead", secondary=lead_interests, back_populates="interests")

class Badge(Base):
    """Modelo para insignias de reconocimiento a early adopters"""
    __tablename__ = "badges"

    id = Column(Integer, primary_key=True, index=True)
    lead_id = Column(Integer, ForeignKey("leads.id"))
    badge_type = Column(String(50), nullable=False)  # 'pioneer', 'innovator', 'contributor', etc.
    awarded_at = Column(DateTime, default=func.now())
    
    # Relaciones
    lead = relationship("Lead", back_populates="badges")

class Content(Base):
    """Modelo para contenidos multiidioma"""
    __tablename__ = "contents"

    id = Column(Integer, primary_key=True, index=True)
    key = Column(String(100), index=True, nullable=False)  # Identificador único del contenido
    language = Column(String(5), nullable=False)  # 'en', 'es', 'fr', etc.
    content = Column(Text, nullable=False)
    version = Column(Integer, default=1)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())
    published = Column(Boolean, default=False)
    
    # Restricción única para key+language
    __table_args__ = (
        # Creamos una restricción única para la combinación de key y language
        # para asegurar que no hay duplicados para el mismo contenido en el mismo idioma
        {"sqlite_autoincrement": True},
    )

class SocialAccount(Base):
    """Modelo para cuentas de redes sociales conectadas"""
    __tablename__ = "social_accounts"

    id = Column(Integer, primary_key=True, index=True)
    platform = Column(String(50), nullable=False)  # 'instagram', 'github', etc.
    account_name = Column(String(100), nullable=False)
    auth_token = Column(Text)
    refresh_token = Column(Text)
    token_expires = Column(DateTime)
    active = Column(Boolean, default=True)
    
    # Relaciones
    posts = relationship("SocialPost", back_populates="account")

class SocialPost(Base):
    """Modelo para publicaciones programadas en redes sociales"""
    __tablename__ = "social_posts"

    id = Column(Integer, primary_key=True, index=True)
    account_id = Column(Integer, ForeignKey("social_accounts.id"))
    content = Column(Text, nullable=False)
    scheduled_at = Column(DateTime, nullable=False)
    published_at = Column(DateTime)
    status = Column(String(50), default="scheduled")  # 'scheduled', 'published', 'failed'
    post_url = Column(String(255))  # URL de la publicación una vez publicada
    engagement_metrics = Column(JSON)  # Métricas en formato JSON
    
    # Relaciones
    account = relationship("SocialAccount", back_populates="posts")
