from flask import Flask, redirect, url_for, request,render_template
import csv
app = Flask(__name__)

@app.route('/success/<name>')

def success(name):
    return 'welcome %s' % name

@app.route('/login',methods = ['POST', 'GET'])
def login():
    if request.method == 'POST':
        filter1 = request.form['filter-1']
        filter2 = request.form['filter-2']
        filter3 = request.form['filter-3']
        c,u=function(filter1,filter2,filter3)
        dict={}
        if len(c)<3:
            dict['First']=u[0]
            dict['Second']=u[1]
            dict['Third']=u[2]
            return render_template('login.html', name = dict)
        else:
            dict['First']=c[0]
            dict['Second']=c[1]
            dict['Third']=c[2]
            return render_template('login.html', name = dict)
    else:
        user = request.args.get('nm')
        return redirect(url_for('success',name = user))
def function(x,y,z):
    file1=str(x)+".csv"
    f1=open(file1)
    file2=str(y)+".csv"
    f2=open(file2)
    file3=str(z)+".csv"
    f3=open(file3)
    fi1=[]
    fi2=[]
    fi3=[]
    for i in csv.reader(f1):
        fi1.append(i[0])
    for j in csv.reader(f2):
        fi2.append(j[0])
    for k in csv.reader(f3):
        fi3.append(k[0])
    common=set(fi1) & set(fi2) & set(fi3)
    common=list(common)
    uncommon=[fi1[0],fi2[0],fi3[0]]
    return common,uncommon

if __name__ == '__main__':
    app.run(debug = True)