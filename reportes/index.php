<?php
session_start();
if(empty($_SESSION['nombre'])){
	

?>
<!DOCTYPE html>
<html lang="es-MX">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" href="">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/mane.css">
       
        <title>Reportes Contraloria</title>
    </head>
    <body>
		<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
            <center> <img src="img/logoapp.png" width="70%"></center>
              <h3 class="login-heading mb-4 text-center">Inicio de sesión</h3>
              <p class="text-center">Ingresa tus credenciales para acceder al sistema</p>
              <form action="php/validar_usuario.php" method="post">
                <div class="form-label-group">
                  <input type="text" id="inputEmail" name="usuario" class="form-control" placeholder="Email address" required autofocus>
                  <label for="inputEmail">Usuario</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="pasword" class="form-control" placeholder="Password" required>
                  <label for="inputPassword">Contraseña</label>
                </div>

                
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Iniciar Sesión</button>
                
              </form>
            </div>
          </div>
        </div>
      </div>
       <img src="img/nuevaImganeMichSinFondo.png" width="40%" style="margin-left: 3%;"><img src="img/contraloria.png" width="40%" style="margin-left: 5%;">
    </div>
  </div>
 
</div>
    </body> 
</html>
<?php
}else{
	header('location: vistas/PaginaInicio.php');

}
?>