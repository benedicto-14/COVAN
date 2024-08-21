<?php
include_once './controller/controller-index.php';
$struc = new componentes();
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
   ?>  <title>Registro</title>
    </head>
    <body>
        <div class="container col-12">
            <!--Inicia el cuerpo del contenido-->
            <div class="cuadro bg-white col-md-8 p-lg-12" >
                <!--Inicia el recuadro de registro-->
                <div class="row contenido">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form method="post" id="form-company">
                          <input type="hidden" name="registrarEmpresa" value="1">
                            <div class="row p-md-12 rounded">
                                <div class="col-md-6">
                                    <p class="h3 text-primary">COVAN</p>
                                    <h5 class="log6in-heading">Registrar Negocio</h5>
                                    <div class="mb3">
                                    <label class="col-form-label">Razon social: </label>
                                    <input type="text" name="razonSocial" autofocus="autofocus" class="form-control input-r" id="rsocial" aria-describedby="razonsocialHelp" placeholder="Company name" required="">
                                    <div class="invalid-tooltip">
                                    Este nombre ya esta en uso, pruebe con otro.
                                    </div>
                                    </div>
                                    <div class="">
                                    <label class="col-form-label">RFC : </label>
                                    <input type="text" name="rfc" onkeypress="consultarEmpresas();" maxlength="13" class="form-control" id="rfc" aria-describedby="rfcHelp" placeholder="Opcional" required="">
                                    </div>
                                </div>
                                <div class="col-md-6 d-none d-md-block">
                                    <figure class="figure">
                                        <img src="./assets/img/product.png"  style="width: 18rem;"class="figure-img img-fluid rounded" alt="...">
                                        <figcaption class="figure-caption">Un solo registro, todas las funciones en tus manos desde cualquier dispositivo.</figcaption>
                                    </figure>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-10 " >
                                    <label class="col-form-label">Nombre de usuario: </label>
                                    <input type="text"   name="usuario" class="form-control input-user" id="usuario" aria-describedby="usuarioHelp" placeholder="Usuario" required="">
                                    <div class="invalid-tooltip">
                                    Este usuario ya esta en uso, pruebe con otro.
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <label class="col-form-label">Contraseña: </label>
                                    <div class="input-group">
                                    <input type="password" maxlength="12" name="contraseña" class="form-control input-pass1" id="pass1" aria-describedby="contraseñaHelp" placeholder="********" required="">
                                    <div class="input-group-prepend">
                                    <button id="show_password" class="btn btn-outline-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                    </div>
                                    <div class="invalid-tooltip">
                                    8 a 12 caracteres, debe incluir mínimo 1 Mayúscula (A-Z), una Minúscula (a-z) y un Número. No se permiten espacios en blanco.
                                    </div>
                                </div>
                              </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">Repite contraseña: </label>
                                    <input type="password" class="form-control input-pass2" maxlength="12" id="pass2" onKeyDown="validarCotraseña();"  aria-describedby="rcontraseñaHelp" placeholder="*******" required="">
                                    <div class="valid-feedback">
                                    Las contraseñas coinciden.
                                    </div>
                                    <div class="invalid-feedback">
                                    La contraseña no coincide.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
                                    <label class="col-form-label">Calle: </label>
                                    <input type="text" name="calle" class="form-control" onkeypress="compararContraseñas();" id="calle" aria-describedby="calleHelp" placeholder="" required="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">N° exterior: </label>
                                    <input type="text" name="exterior" class="form-control" id="exterior" aria-describedby="exteriorHelp" placeholder="" required="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">N° interior: </label>
                                    <input type="text" name="interior" class="form-control" id="interior" aria-describedby="interiorHelp" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
                                   <label class="col-form-label">Estado: </label>
                                    <div class="form-group" id="estados">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">Municipio: </label>
                                    <div class="form-group" id="municipios">
                                        <select class="custom-select">
                                            <option selected="">--SELECCIONE--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                 <label class="col-form-label">Localidad: </label>
                                    <div class="form-group" id="localidades">
                                        <select class="custom-select">
                                            <option selected="">--SELECCIONE--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">Colonia: </label>
                                    <input type="text" name="colonia" class="form-control" id="colonia" aria-describedby="coloniaHelp" placeholder="" required="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">Código Postal: </label>
                                    <input type="text" name="cp" class="form-control" id="cp" aria-describedby="codigoPostalHelp" placeholder="" required="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                        <label class="col-form-label">Giro: </label>
                                    <select class="custom-select" id="giro" name="giro">
                                        <option selected>--SELECCIONE--</option>
                                        <option value="1">Abarrotes</option>
                                        <option value="2">Farmacia</option>
                                        <option value="3">Papeleria</option>
                                        <option value="4">Cyber-café</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
                                    <label class="col-form-label">Teléfono: </label>
                                    <input type="text" name="telefono" class="form-control" id="telefono" aria-describedby="telefonoHelp" placeholder="" required="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">Email: </label>
                                    <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="" required="">
                                </div>
                            </div>
                            <br>
                            <div class="div2 form-group col-2">
                                <button type="button" class="btn btn-primary btn-block" onclick="getDataCompany();">Registrar</button>
                            </div>
                        </form>
                        <div class="div3 form-group" >
                                <h6>© 2019 <a href="#" >COVAN.</a></h6>
                            </div>
                    </div>
                </div>
            </div>
            <div class=" condiciones col-md-8" >
                <button type="button" class="text-muted btn btn-link btn-sm float-left"> Ayuda</button>
                <button type="button" class="text-muted btn btn-link btn-sm float-left">&copy; <script>document.write(new Date().getFullYear())</script> COVAN.</button>
                <button type="button" class="text-muted btn btn-link btn-sm float-right">Condiciones</button>
                <button type="button" class="text-muted btn btn-link btn-sm float-right">Privacidad</button>
            </div>
        </div>
              <?php
    echo $struc->scripts();
     ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="./ajax/ajax-EML.js"></script>
        <script type="text/javascript" src="./ajax/ajax-empresa.js"></script>
        <!--Termina el cuerpo del contenido-->
        <script>
$(document).ready( function(){
    consultarEstados();
});
</script>
    </body>
</html>
