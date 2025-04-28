from flask import Flask, jsonify
import requests

# Crear la aplicación Flask
app = Flask(__name__)

API_URL = 'https://validate.adsuminternational.net:8443'

# Endpoint que consume el API externo
@app.route('/total_shards', methods=['GET'])
def api_get_total_shards():
    try:
        response = requests.get(f'{API_URL}/total_shards')
        if response.status_code == 200:
            return jsonify(response.json()), 200
        else:
            return jsonify({'status': 'Error fetching total shards'}), response.status_code
    except Exception as e:
        return jsonify({'status': f'Error: {str(e)}'}), 500

# Asegúrate de que 'application' esté definido
# Passenger usará 'application' como punto de entrada
application = app

# Esto solo se ejecuta cuando corres el archivo directamente, no cuando lo carga Passenger
if __name__ == "__main__":
    app.run()

