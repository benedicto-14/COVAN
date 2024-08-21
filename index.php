<?php
include_once './controller/controller-index.php';
$struc = new componentes();
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
  {http://localhost:8081/Covan/pages/proveedores.php
      header("location:http://localhost:8081/Covan/pages/proveedores.php");
  }
  else
  {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./assets/css/style-login.css">
     <?php
 echo $struc->headers();
 ?>
    <title>Inicio de sesión</title>
</head>
    <body>
        <div class="container col-12">
        <!--Inicia el cuerpo del contenido-->
            <div class="cuadro bg-white col-md-4 p-lg-4  " >
                <!--Inicia el recuadro de login-->
                    <form method="post" id="form-access">
                    <div class="div1 form-group" >
                      <input type="hidden" name="acceder" value="1">
                            <img src="https://www.wmtransfer.com/img/icons/wmlogo_flat_256.png" style="width: 7rem;">
                        <h5 class="login-heading">Acceder</h5>
                    </div>
                    <div class=" div2 form-group">
                        <label class="col-form-label">Nombre de usuario: </label>
                        <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuarioHelp" placeholder="Ingresa tu nombre de usuario" required="">
                         <label class="col-form-label">Contraseña: </label>
                         <input type="password" name="contraseña" class="form-control" id="contraseña" autocomplete="off" aria-describedby="contraseñaHelp" placeholder="************" required="">
                    </div>
                    <div class="div2 form-group ">
                      <button type="button" onclick="location.href ='register-company.php' " class="btn btn-link   float-lef">Crear cuenta</button>
                        <button type="button" class="btn btn-primary float-right" onclick="access();">Aceptar</button>
                    </div>
                </form>
                     <div class="div3 form-group" >
                                 <h6 style="text-">© 2019 <a href="#" >COVAN.</a></h6>
                        </div>
            </div>
                 <!--Termina el recuadro de login-->
            </div>
        <div class=" condiciones col-md-4" >
            <button type="button" class="text-muted btn btn-link btn-sm float-lef"> Ayuda</button>
            <button type-="button" class="text-muted btn btn-link btn-sm float-right">Condiciones</button>
            <button type="button" class="text-muted btn btn-link btn-sm float-right">Privacidad</button>
        </div>
        <!--Termina el cuerpo del contenido-->
    </body>
      <?php
    echo $struc->scripts();
  }
     ?>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="./ajax/ajax-login.js"></script>
</html>
