from flask import Flask, render_template, url_for, redirect, request, jsonify
from flaskext.mysql import MySQL

import os, time; from datetime import datetime

app = Flask(__name__, template_folder = os.path.abspath('.'), static_folder = os.path.abspath('.'))

path = ''
requests = 0

sql = True
try:

    import mysql.connector
    from mysql.connector import Error
    mysql = MySQL()
    app.config['MYSQL_DATABASE_USER'] = ''
    app.config['MYSQL_DATABASE_PASSWORD'] = ''
    app.config['MYSQL_DATABASE_DB'] = ''
    app.config['MYSQL_DATABASE_HOST'] = ''
    mysql.init_app(app)
    conn = mysql.connect()
    cursor = conn.cursor()

    cursor.execute("CREATE TABLE IF NOT EXISTS posts (id text, title text, text text, date text, category text)")
    cursor.execute("CREATE TABLE IF NOT EXISTS logs (log text, date text, ip text)")
    cursor.execute("CREATE TABLE IF NOT EXISTS manutencao (status text)")

except Exception as error:
    sql = False; print(' * SQL Error: ' + str(error))

# Functions

def check_sql():
    pass

def check_sqli():
    pass

def replace_caract(text):
    return text.replace(',', '').replace('\'', '').replace(')', '').replace('(', '')

# Application

@app.route('/', methods=["GET"])
def home():
    pass

# Redirects

@app.route('/api/stats/')
def api_status_redirect():
    return redirect('/api/status')

@app.route('/api/<version>')
def api(version):
    return redirect('/')

# API

@app.route('/status/')
@app.route('/api/status/')
def api_status():
    return jsonify(
        {
            "online-since": str(datetime.now() - started),
            'database': 'on' if sql else 'off',
            'version': 'v1.0',
            'requests-since-its-been-online': f'{requests}'
        }
    )


@app.route('/api/v1/posts/create/')
def api_create_post():
    pass

# Error Handler

@app.errorhandler(404)
def error_notfound(error):
    return render_template(f'{path}/static/err/404.html'), 404

@app.errorhandler(500)
def error_internal(error):
    return render_template(f'{path}/static/err/500.html'), 500

# Other

@app.before_request
def before_request():
    if 'api_status' in request.endpoint:
        pass
    pass

@app.after_request
def after_request(response):
    global requests
    requests += 1
    return response

@app.route('/robots.txt/')
def robots():
    return """
    User-Agent: *<br>
    Disallow: /static/
    """

started = datetime.now()
if __name__ == '__main__':
    app.run(host='0.0.0.0', port=80, debug=True)
