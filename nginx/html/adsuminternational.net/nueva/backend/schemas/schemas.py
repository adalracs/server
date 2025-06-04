# backend/schemas/schemas.py
from pydantic import BaseModel, EmailStr, validator, Field
from typing import List, Optional, Dict, Any
from datetime import datetime

# ===== User/Auth Schemas =====
class UserBase(BaseModel):
    email: EmailStr
    username: str
    full_name: Optional[str] = None
    is_active: Optional[bool] = True

class UserCreate(UserBase):
    password: str
    is_admin: Optional[bool] = False
    
    @validator('password')
    def validate_password(cls, v):
        if len(v) < 6:
            raise ValueError('Password must be at least 6 characters long')
        return v
    
    @validator('username')
    def validate_username(cls, v):
        if len(v) < 3:
            raise ValueError('Username must be at least 3 characters long')
        return v

class User(UserBase):
    id: int
    is_admin: bool
    created_at: datetime
    last_login: Optional[datetime] = None
    
    class Config:
        from_attributes = True

class UserUpdate(BaseModel):
    email: Optional[EmailStr] = None
    username: Optional[str] = None
    full_name: Optional[str] = None
    is_active: Optional[bool] = None
    is_admin: Optional[bool] = None

class Token(BaseModel):
    access_token: str
    token_type: str

class TokenData(BaseModel):
    username: Optional[str] = None

class LoginRequest(BaseModel):
    username: str
    password: str

class ChangePasswordRequest(BaseModel):
    current_password: str
    new_password: str
    
    @validator('new_password')
    def validate_new_password(cls, v):
        if len(v) < 6:
            raise ValueError('New password must be at least 6 characters long')
        return v

# ===== Lead Schemas =====
class InterestBase(BaseModel):
    name: str
    description: Optional[str] = None

class Interest(InterestBase):
    id: int
    
    class Config:
        from_attributes = True

class LeadBase(BaseModel):
    email: EmailStr
    name: str
    company: Optional[str] = None
    segment: str  # 'developer', 'business', 'academic', 'ngo_gov'
    
    @validator('segment')
    def validate_segment(cls, v):
        valid_segments = ['developer', 'business', 'academic', 'ngo_gov']
        if v not in valid_segments:
            raise ValueError(f'Segment must be one of: {", ".join(valid_segments)}')
        return v

class LeadCreate(LeadBase):
    interests: List[str] = []  # Lista de identificadores de intereses

class Lead(LeadBase):
    id: int
    is_early_adopter: bool
    created_at: datetime
    last_contact: Optional[datetime] = None
    interests: List[Interest] = []
    
    class Config:
        from_attributes = True

# ===== Badge Schemas =====
class BadgeBase(BaseModel):
    badge_type: str
    
    @validator('badge_type')
    def validate_badge_type(cls, v):
        valid_types = ['pioneer', 'innovator', 'contributor', 'visionary']
        if v not in valid_types:
            raise ValueError(f'Badge type must be one of: {", ".join(valid_types)}')
        return v

class BadgeCreate(BadgeBase):
    lead_id: int

class Badge(BadgeBase):
    id: int
    lead_id: int
    awarded_at: datetime
    
    class Config:
        from_attributes = True

# ===== Content Schemas =====
class ContentBase(BaseModel):
    key: str
    language: str
    content: str
    
    @validator('language')
    def validate_language(cls, v):
        valid_languages = ['en', 'es', 'fr', 'de', 'it', 'pt', 'ru', 'zh']
        if v not in valid_languages:
            raise ValueError(f'Language must be one of: {", ".join(valid_languages)}')
        return v

class ContentCreate(ContentBase):
    version: Optional[int] = 1
    published: Optional[bool] = False

class Content(ContentBase):
    id: int
    version: int
    created_at: datetime
    updated_at: datetime
    published: bool
    
    class Config:
        from_attributes = True

# ===== Social Account Schemas =====
class SocialAccountBase(BaseModel):
    platform: str
    account_name: str
    active: Optional[bool] = True
    
    @validator('platform')
    def validate_platform(cls, v):
        valid_platforms = ['instagram', 'github', 'reddit', 'stackoverflow', 'telegram', 'threads', 'tiktok', 'csdn']
        if v not in valid_platforms:
            raise ValueError(f'Platform must be one of: {", ".join(valid_platforms)}')
        return v

class SocialAccountCreate(SocialAccountBase):
    auth_token: Optional[str] = None
    refresh_token: Optional[str] = None
    token_expires: Optional[datetime] = None

class SocialAccount(SocialAccountBase):
    id: int
    auth_token: Optional[str] = None
    refresh_token: Optional[str] = None
    token_expires: Optional[datetime] = None
    
    class Config:
        from_attributes = True

# ===== Social Post Schemas =====
class SocialPostBase(BaseModel):
    content: str
    scheduled_at: datetime

class SocialPostCreate(SocialPostBase):
    account_id: int

class SocialPost(SocialPostBase):
    id: int
    account_id: int
    published_at: Optional[datetime] = None
    status: str  # 'scheduled', 'published', 'failed'
    post_url: Optional[str] = None
    engagement_metrics: Optional[Dict[str, Any]] = None
    
    class Config:
        from_attributes = True

# ===== Response Models =====
class SuccessResponse(BaseModel):
    status: str = "success"
    message: str

class ErrorResponse(BaseModel):
    status: str = "error"
    detail: str
