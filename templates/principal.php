<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menu control</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  <div class="">
   
    <section class="content">
      <div class="container-fluid">
        <div class="contariner alert alert-info">
          <h2>Central de correos</h2>
          </div>
        
          
          <div class=" row">
            <div class="col-12">
              <!-- Custom Tabs -->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3"><a href="/"><button class="btn btn-danger">Cerrar Sesion</button></a></h3>
                  <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Gestion de Envio</a></li>
                    <li class="nav-item" onclick="verhistorial()"><a class="nav-link" href="#tab_2" data-toggle="tab">Historial</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Contraseña</a></li>
                    
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      
                      <form onsubmit="return enviarMail()">
                      <input required id="txtasunto" name="txtasunto" class="form-control" type="text" placeholder="Asunto:" max="50"/>
                      <hr>
                      <select required class="form-control" id="slDestino" name="slDestino">
                      <option value=''>Seleccionar destinario </option>
                        {% for m in data %}
                        <option value="{{ m['correo']}}">{{ m['nombreusuario']}}</option>
                      {% endfor%}
                    </select>
                      <hr>
                      <textarea placeholder="Mensaje:"  required id="txtmensaje" name="txtmensaje" class="form-control"></textarea>
                      <br>
                      <center><button class="btn btn-success" type="submit">Enviar</button></center>

                    </form>
                      

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                      
                      <div class="row">
                      <div class="col-6" id="dEnviados" name="dEnviados">
                        Observa tus correos enviados
                      </div>
                      <div class="col-6" id="dRecibidos" name="dRecibidos">
                        Observa tus correos recibidos
                      </div>

                    </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                      <center class="alert alert-info"><h3>Cambio de contraseña</h3></center>
                      <hr>
                      <form onsubmit="return cambiopassword()">
                      Nueva Contraseña
                      <input required type="password" class="form-control" id="txtpass1" name="txtpass1">
                      Confirmar Contraseña
                      <input required type="password" class="form-control" id="txtpass2" name="txtpass2">
                      <hr>  
                      <button type="submit" class="btn btn-info">Actualizar</button>
                    </form>

                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- ./card -->
            </div>
            <!-- /.col -->
          </div>

          
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/sparklines/sparkline.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://adminlte.io/themes/v3/dist/js/adminlte.js"></script>
<script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script>

<script>
function cambiopassword(){

    if($("#txtpass1").val()==$("#txtpass2").val()){
      $.ajax({
    url:'actualizacionPassword',
    data:"pass="+$("#txtpass1").val(),
    type: 'POST',
    success: function(r){
           alert(r);
    },
    error : function(xhr,status){
      alert("Error intente en otro instante");
    }
  });


    }
    else{
      alert("ERROR..., las contraseñas no coinciden")
    }

  return false;
}


function verhistorial(){
  $.ajax({
    url:'historialEnviados',
    data:"",
    type: 'POST',
    success: function(r){
            r="<center class='alert alert-info'><strong>Correos enviados </strong></center>"+r;
          $("#dEnviados").html(r)
    },
    error : function(xhr,status){
      alert("Error intente en otro instante");
    }
  });


  ////////////////////////////////////////////////
  $.ajax({
    url:'historialRecibidos',
    data:"",
    type: 'POST',
    success: function(r){
            r="<center class='alert alert-info'><strong>Correos recibidos </strong></center>"+r;
          $("#dRecibidos").html(r)
    },
    error : function(xhr,status){
      alert("Error intente en otro instante");
    }
  });
}


/////////////////////////////
function enviarMail(){
  $.ajax({
    url:'enviarMail',
    data:"asunto="+$("#txtasunto").val()+"&emailDestino="+$("#slDestino").val()+"&mensaje="+$("#txtmensaje").val(),
    type: 'POST',
    success: function(r){
      alert(r);
    },
    error : function(xhr,status){
      alert("Error intente en otro instante");
    }
  });

return false;

}





//////////////////////////////////////////////////////////////////////////////////////////
function gestionmenus(){
  $("#titulo").html("Gestion de Menus");

  var info="<h1>informacion de menus</h1>"
  +"<br>sdfghjkoifgghiojb "
  +"<br><button class='btn btn-info'>Procesar</button>";

  $("#contenido").html(info);


}

</script>

</body>
</html>
