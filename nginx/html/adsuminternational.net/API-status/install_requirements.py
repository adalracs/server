import subprocess
import sys

def install_requirements():
    """Instala los paquetes listados en requirements.txt"""
    try:
        # Eliminar la opción --user
        result = subprocess.check_call([sys.executable, "-m", "pip", "install", "-r", "requirements.txt"])
        if result == 0:
            print("Dependencias instaladas exitosamente.")
        else:
            print("Hubo un error al instalar las dependencias.")
    except subprocess.CalledProcessError as e:
        print(f"Error al intentar instalar dependencias: {e}")
    except Exception as e:
        print(f"Ha ocurrido un error inesperado: {e}")

if __name__ == "__main__":
    install_requirements()

