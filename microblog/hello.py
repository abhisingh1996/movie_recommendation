from flask import Flask
app = Flask(__name__)
#connect to a webpage
@app.route('/hello/<name>')
def hello_name(name):
   return '%s!' % name

if __name__ == '__main__':      #only run the app or just only run the webserver??
   app.run(debug = True)