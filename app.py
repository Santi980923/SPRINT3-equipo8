import email
from flask import Flask,render_template,request
import hashlib
import controlador
from datetime import datetime
import Sendemail

app = Flask(__name__)

email_origen=""

@app.route("/")
def Inicio():
    return render_template("login.html")

@app.route("/validarUsuario",methods=["GET","POST"])
def validarUsuario():
    if request.method=="POST":
        usu=request.form["txtusuario"]
        usu=usu.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        passw=request.form["txtpass"]
        passw=passw.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        passw2=passw.encode()
        passw2=hashlib.sha384(passw2).hexdigest()

        respuesta=controlador.validarusuario(usu,passw2)

        global email_origen


        if len(respuesta)==0:
            email_origen=""
            mensaje="ERROR DE AUTENTICACION !!!verifique su usuario y contraseña"
            return render_template("informacion.html",data=mensaje)
        else:
        #print("usuario= "+usu)
        #print("password= "+passw)
        #print("pasw encriptado="+passw2)
            email_origen=usu
            respuesta2=controlador.listaDestinarios(usu)
            return render_template("principal.html",data=respuesta2)


@app.route("/registrarUsuario",methods=["GET","POST"])
def registrarUsuario():
    if request.method=="POST":
        nombreusuario=request.form["txtnombre"]
        nombreusuario=nombreusuario.usu.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        correo=request.form["txtusuarioregistro"]
        correo=correo.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        passw=request.form["txtpassregistro"]
        passw=passw.usu.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        passw2=passw.encode()
        passw2=hashlib.sha384(passw2).hexdigest()

        code=datetime.now()
        code2=str(code)
        code2=code2.replace("-","")
        code2=code2.replace(" ","")
        code2=code2.replace(":","")
        code2=code2.replace(".","")
        print(code2)

        mensaje="Señor@, usuario su codigo de activacion es :\n\n"+code2+ "\n\n Recuerde copiarlo y pegarlo para validarlo en la seccion de login y activar su cuenta.\n\nMuchas Gracias"
        Sendemail.enviar(correo,mensaje,"Codigo de Activacion")

        respuesta=controlador.registrarUsuario(nombreusuario,correo,passw2,code2)

        #mensaje="Usuario"+nombreusuario+" registrado satisfactoriamente."
        return render_template("informacion.html",data=respuesta)


@app.route("/enviarMail",methods=["GET","POST"])
def enviarMail():
    if request.method=="POST":
        emailDestino=request.form["emailDestino"]
        asunto=request.form["asunto"]
        asunto=asunto.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        mensaje=request.form["mensaje"]
        mensaje=mensaje.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        
        controlador.registrarmail(email_origen,emailDestino,asunto,mensaje)
        
        mensaje2="Señor usuario usted recibio un mensaje nuevo,ingrese a la plaforma en el tab historial"

    Sendemail.enviar(emailDestino,mensaje2,"Nuevo Mensaje enviado")
    return "Email enviado exitosamente"

@app.route("/actualizacionPassword",methods=["GET","POST"])
def actualizacionPassword():
    if request.method=="POST":
        pass1=request.form["pass"]
        pass1=pass1.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        passw2=pass1.encode()
        passw2=hashlib.sha384(passw2).hexdigest()
        
    controlador.actualizapass(passw2,email_origen)
    return "Actualizacion satisfactoria de contraseña"



@app.route("/activarUsuario",methods=["GET","POST"])
def activarUsuario():
    if request.method=="POST":
        codigo=request.form["txtcodigo"]
        codigo=codigo.replace("SELECT","").replace("INSERT","").replace("DELETE","").replace("UPDATE","").replace("WHERE","")
        

        respuesta=controlador.activarUsuario(codigo)
        if len(respuesta)==0:
            mensaje="Codigo de activacion erroneo,reviselo"
        else:
            mensaje="Codigo de activacion correcto,usuario activado."
        return render_template("informacion.html",data=mensaje)

@app.route("/historialEnviados",methods=["GET","POST"])
def historialEnviados():
        resultado=controlador.ver_Enviados(email_origen)
        return render_template("respuesta.html",data=resultado)
    
@app.route("/historialRecibidos",methods=["GET","POST"])
def historialRecibidos():
        resultado=controlador.ver_recibidos(email_origen)
        return render_template("respuesta.html",data=resultado)

