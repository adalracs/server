"""
    Intellectual property of Andres Riascos.
 
    File              : main.py
    Function          : Biometric authentication system with two flows:
                        - Pre-registered users (via token validation)
                        - New users (full registration)
    Description       : Integrates with Adsum-Blockchain for email validation
                       and handles FIDO2 biometric operations.
 
    Main Components   :
        - BlockchainClient: Handles communication with blockchain endpoint
        - BiometricAuthSystem: Main authentication system
        - Flask routes for registration and authentication
        - FIDO2 server configuration
 
    Authentication Flow:
        1. Registration Begin:
           - Validate user data
           - Generate FIDO2 registration options
           - Return challenge to client
 
        2. Registration Complete:
           - Verify FIDO2 registration data
           - Extract public key
           - Store in blockchain
           - Return transaction confirmation
 
        3. Authentication:
           - Verify stored credentials
           - Process biometric validation
           - Confirm user identity
 
    Dependencies      :
        - Flask==2.0.3: Web framework
        - requests==2.26.0: HTTP client
        - Werkzeug==2.0.3: WSGI utilities
        - fido2==1.1.2: FIDO2 protocol implementation
        - python-dotenv==1.0.0: Environment management
 
    Modified by     : Andrés Riascos     2024-11-29
    Reason          : Implementation of blockchain-agnostic biometric system
    Modified by     : Andrés Riascos     2025-04-08
    Reason          : Added dual-flow support and token validation
"""

from werkzeug.middleware.dispatcher import DispatcherMiddleware
from flask import Flask, request, jsonify, render_template, session, redirect, url_for
from fido2.webauthn import PublicKeyCredentialRpEntity, UserVerificationRequirement
from fido2.server import Fido2Server
import requests
import os
from datetime import datetime
import json
from dotenv import load_dotenv
from werkzeug.middleware.proxy_fix import ProxyFix

load_dotenv(os.path.join(os.path.dirname(__file__), '.env'))
app = Flask(__name__)
app.secret_key = os.getenv("SECRET_KEY", "dev-secret-key")  # Para manejar sesiones

app.wsgi_app = ProxyFix(app.wsgi_app, x_proto=1, x_host=1)

# Configuración FIDO2
rp = PublicKeyCredentialRpEntity("www.adsuminternational.net/CreateUser", "Adsum Biometric Auth")
fido2_server = Fido2Server(rp)

# URL de la blockchain (desde .env)
BLOCKCHAIN_API = os.getenv("BLOCKCHAIN_API", "https://validate.adsuminternational.net:8443")

class BlockchainClient:
    """Cliente para interactuar con la blockchain"""
    def __init__(self, endpoint: str):
        self.endpoint = endpoint
        
    def store_key(self, user_id: str, public_key: bytes, user_data: dict):
        """Almacena clave pública en la blockchain"""
        response = requests.post(
            f"{self.endpoint}/store-key",
            json={
                "user_id": user_id,
                "public_key": public_key.hex(),
                **user_data
            }
        )
        response.raise_for_status()

class BiometricAuthSystem:
    """Maneja la lógica central de autenticación biométrica"""
    def __init__(self):
        self.blockchain = BlockchainClient(BLOCKCHAIN_API)

auth_system = BiometricAuthSystem()

# --- Helpers --- #
def validate_blockchain_token(user_id: str, token: str) -> dict:
    """Valida el token con la blockchain y obtiene datos del usuario"""
    try:
        response = requests.get(
            f"{BLOCKCHAIN_API}/validate-token",
            params={"user_id": user_id, "token": token},
            timeout=5
        )
        return response.json() if response.status_code == 200 else None
    except requests.exceptions.RequestException:
        return None

# --- Rutas Principales --- #

@app.route('/')
def home():
    """Página inicial para nuevos usuarios"""
    return render_template('new_user_form.html')

@app.route('/validate-user/<user_id>/<token>')
def handle_pre_registered(user_id: str, token: str):
    """
    Maneja usuarios pre-inscritos que vienen con token de validación.
    Flujo: Validar token → Cargar datos → Redirigir a registro biométrico.
    """
    # Validar token con la blockchain
    token_data = validate_blockchain_token(user_id, token)
    
    if not token_data or not token_data.get('valid'):
        return render_template('error.html', 
                            error="Enlace inválido o expirado",
                            code="INVALID_TOKEN"), 400

    # Guardar datos en sesión
    session['user_data'] = {
        'user_id': user_id,
        'email': token_data['email'],
        'backup_email': token_data.get('backup_email', ''),
        'pre_validated': True  # Para saltar validación de email
    }

    return redirect(url_for('biometric_registration'))

@app.route('/register', methods=['POST'])
def handle_new_user():
    """
    Maneja nuevos usuarios desde formulario.
    Flujo: Enviar datos a blockchain → Esperar validación por correo.
    """
    form_data = request.form
    
    # Enviar datos a blockchain
    response = requests.post(
        f"{BLOCKCHAIN_API}/register_user_web",
        json={
            "email": form_data['email'],
            "nombres": form_data['first_name'],
            "apellido1": form_data['last_name'],
            "documento": form_data['document_id'],
            "source": "web"
        }
    )

    if response.status_code != 202:
        return render_template('error.html',
                            error="Error en el registro",
                            code="REGISTRATION_FAILED"), 400

    return render_template('validation_pending.html',
                         email=form_data['email'])

@app.route('/biometric-registration')
def biometric_registration():
    """Muestra el formulario de registro biométrico"""
    if 'user_data' not in session:
        return redirect(url_for('home'))
    
    return render_template(
        'biometric_form.html',
        email=session['user_data']['email'],
        user_id=session['user_data']['user_id']
    )

# --- API FIDO2 --- #

@app.route('/api/register/begin', methods=['POST'])
def fido2_register_begin():
    """Inicia el registro FIDO2 para ambos flujos"""
    if 'user_data' not in session:
        return jsonify({"error": "Sesión inválida"}), 401
        
    user_id = session['user_data']['user_id']
    
    # Generar opciones FIDO2
    options, state = fido2_server.register_begin(
        {
            "id": user_id.encode(),
            "name": session['user_data']['email'],
            "displayName": session['user_data']['email']
        },
        user_verification=UserVerificationRequirement.PREFERRED
    )
    
    session['fido2_state'] = state
    return jsonify({"options": options})

@app.route('/api/register/complete', methods=['POST'])
def fido2_register_complete():
    """Completa el registro FIDO2"""
    if 'fido2_state' not in session:
        return jsonify({"error": "Estado inválido"}), 400
        
    try:
        # Verificar registro FIDO2
        auth_data = fido2_server.register_complete(
            session['fido2_state'],
            request.json['registration_data']
        )
        
        # Guardar clave pública en blockchain
        public_key = auth_data.credential_data.public_key
        user_id = session['user_data']['user_id']
        
        auth_system.blockchain.store_key(
            user_id=user_id,
            public_key=public_key,
            user_data={
                "email": session['user_data']['email'],
                "backup_email": session['user_data'].get('backup_email', '')
            }
        )
        
        # Limpiar sesión
        session.clear()
        return jsonify({"status": "success"})
        
    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == '__main__':
    app.run()
else:
    # Montar la app Flask bajo el subpath /CreateUser
    from flask import Flask as DummyApp
    application = DispatcherMiddleware(DummyApp('dummy'), {
        '/CreateUser': app
    })
