from flask import Flask
from flask_sqlalchemy import SQLAlchemy
from flask import redirect
from flask import render_template
from flask import request
from flask_login import LoginManager, UserMixin, login_manager

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql+psycopg2://postgres:787899111@localhost:5432/shop.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'a really really really really long secret key'
db = SQLAlchemy(app)
manager = LoginManager(app)

app.app_context().push()

class Item(db.Model):
    id = db.Column(db.Integer, primary_key = True)
    title = db.Column(db.String(100), nullable=False)
    price = db.Column(db.Integer, nullable=False)
    #description = db.Column(db.Text, nullable=False)

    def __repr__(self):
        return self.title, self.price

class User(db.Model, UserMixin):
    id = db.Column(db.Integer, primary_key = True)
    login = db.Column(db.String(128), nullable = False, unique = True)
    password = db.Column(db.String(255), nullable = False)

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(user_id)

@app.route('/account/',methods = ['POST', 'GET'])
def account():
    return render_template('account.html')

@app.route('/sitelist/')
def sitelist():
    return render_template('sitelist.html')

@app.route('/support/')
def support():
    return render_template('support.html')

@app.route('/terms/')
def terms():
    return render_template('terms.html')

@app.route('/thankyou/')
def thankyou():
    return render_template('thankyou.html')

@app.route('/index/',methods = ['POST', 'GET'])
def index():
    items = Item.query.order_by(Item.price).all()
    return render_template('index.html', data = items)

@app.route('/checkout/')
def checkout():
    return render_template('checkout.html')

@app.route('/privacy/')
def privacy():
    return render_template('privacy.html')

@app.route('/error/')
def error():
    return render_template('error.html')

@app.route('/admin/', methods = ['POST', 'GET'])
def admin():
    if request.method == "POST":
        title = request.form['title']
        price = request.form['price']

        item = Item(title=title, price=price)

        try:
            db.session.add(item)
            db.session.commit()
            return redirect('/index/')
        except:
            return redirect('/error/')
    else:
        return render_template('admin.html')

if __name__ == "__main__":
    app.run(host='0.0.0.0')