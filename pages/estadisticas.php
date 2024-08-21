<?php
include_once '../controller/controller-pages.php';
$struc = new componentes();
/*session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
  {*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Estadisticas</title>
  <!--<link rel="stylesheet" href="../bower_components/boostrap/dist/css/bootstrap.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/estadisticas.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">-->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../assets/css/estadisticas.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="../bower_components/sweetAlert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../bower_components/pagination/pagination.css">
  <?php
  echo $struc->links();
   ?>
</head>

<body>
  <div class="wrapper">

    <!-- Sidebar Holder -->
    <?php
      echo $struc->navbarLateral();
       ?>

    <!-- Page Content Holder -->
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light" id="valdi">

        <div class="col-lg-3 col-md-4 col-sm-4">
          <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>
        </div>

        <div class="col-lg-6 col-md-8 col-sm-8 d-none d-md-block">
          <h3 style="text-align: center;color: #FFFFFF;"><?php //echo $_SESSION["empresa"];?></h3>
        </div>

        <div class="col-lg-3">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item dropdown">
                <input type="hidden" name="nombreUser" id="nombreUser" value="<?php //echo $_SESSION["usuario"]; ?>">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><label> <?php //echo $_SESSION["usuario"]; ?></label></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="perfil-empresa.php"><i class="fas fa-wrench"></i> Configuración </a>
                  <a class="dropdown-item" href="#" onclick='cerrar();'><i class="fas fa-power-off"></i> Salir</a>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </nav>

      <div id="contenttwo">

        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Estadisticas</h2>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">

              <button type="button" class="btn btn-outline-info" data-toggle="tooltip" title="Generar Reportes" data-placement="bottom"
                data-target="#myModal" onclick="reportes();">
                <i class="fas fa-file-alt"></i>
              </button>

              <button type="button" class="btn btn-outline-info" data-toggle="tooltip" title="Generar PDF de graficas"
                onclick="previewPDF();">
                <i class="fas fa-file-pdf"></i>
              </button>

              <button type="button" class="btn btn-outline-info" data-target="#exampleModal" data-toggle="tooltip"
                data-placement="bottom" title="Guardar el tipo de graficas" onclick="guardarInfo();">
                <i class="fas fa-save"></i>
              </button>

              <button type="button" class="btn btn-outline-info" data-toggle="tooltip" title="Registro de Actividades"
                data-target="#myModal" onclick="generarlogs();">
                <i class="fas fa-book"></i>
              </button>

            </div>
          </div>
        </div>


        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title" id="titulolog">
                  <!-- tituloModal -->
                </h4>
                <button type="button" class="close" data-dismiss="modal" onclick="closeModal();">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" id="modalLog">

                <!-- Contenido Logs -->

              </div>

            </div>
          </div>
        </div>



        <!---Contenido--->
        <div class="row" id="load">
          <div class="col-md-12">

            <div id="spinner">
              <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
              </div>
            </div>

            <div id="mensaje" class="text-center">
            </div>

          </div>
        </div>

        <div class="row" id="DatosNull">
          <div class="col-md-12">

            <br><br><br>
            <h1 id="mensajeDatos" class="text-center"></h1>

          </div>
        </div>

        <div class="row" id="contenido">

          <div class="col-md-6">

            <div class="row">

              <div class="col-md-12">
                <select id="tipo" class="custom-select" id="inputGroupSelect04"
                  aria-label="Example select with button addon" onchange="cambiar();">
                  <!--Tipos de Graficas-->
                </select>
              </div>

              <div class="input-group col-md-5" id="FI">
                <!--Fechas-->
              </div>

              <div class="input-group col-md-5" id="FF">
                <!--Fechas-->
              </div>

              <div class="custom-control custom-switch col-md-2">
                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1"></label>
              </div>

            </div>

            <br>

            <div class="shadow p-3 mb-5 bg-white rounded">
              
              <h6 id="mensajeGanancias"></h6>
              
              <canvas class="grafica" id="CanvasGanancias">
                Su navegador no es compatible con Canvas
              </canvas>
            </div>

          </div>

          <div class="col-md-6">

            <div class="row">

              <div class="col-md-12">
                <select id="tipoC" class="custom-select" id="inputGroupSelect04"
                  aria-label="Example select with button addon" onchange="cambiarC();">
                  <!--Tipos de Graficas-->
                </select>
              </div>

              <div class="input-group col-md-5" id="FIC">
                <!--Fechas-->
              </div>

              <div class="input-group col-md-5" id="FFC">
                <!--Fechas-->
              </div>

              <div class="custom-control custom-switch col-md-2">
                <input type="checkbox" class="custom-control-input" id="customSwitch2">
                <label class="custom-control-label" for="customSwitch2"></label>
              </div>

            </div>

            <br>

            <div class="shadow p-3 mb-5 bg-white rounded">
              
            <h6 id="mensajeCompras"></h6>
              
              <canvas class="grafica" id="CanvasCompras">
                Su navegador no es compatible con Canvas
              </canvas>
            </div>

          </div>

          <div class="col-md-6">

            <div class="row">

              <div class="col-md-12">
                <select id="tipoV" class="custom-select" id="inputGroupSelect04"
                  aria-label="Example select with button addon" onchange="cambiarV();">
                  <!--Tipos de Graficas-->
                </select>
              </div>

              <div class="input-group col-md-5" id="FIV">
                <!--Fechas-->
              </div>

              <div class="input-group col-md-5" id="FFV">
                <!--Fechas-->
              </div>

              <div class="custom-control custom-switch col-md-2">
                <input type="checkbox" class="custom-control-input" id="customSwitch3">
                <label class="custom-control-label" for="customSwitch3"></label>
              </div>

            </div>

            <br>

            <div class="shadow p-3 mb-5 bg-white rounded">
              
            <h6 id="mensajeVentas"></h6>
              
              <canvas class="grafica" id="CanvasVentas">
                Su navegador no es compatible con Canvas
              </canvas>
            </div>

          </div>

          <div class="col-md-6">

            <div class="row">

              <div class="col-md-12">
                <select id="tipoVP" class="custom-select" id="inputGroupSelect04"
                  aria-label="Example select with button addon" onchange="cambiarVP();">
                  <!--Tipos de Graficas-->
                </select>
              </div>

              <div class="input-group col-md-5" id="FIVP">
                <!--Fechas-->
              </div>

              <div class="input-group col-md-5" id="FFVP">
                <!--Fechas-->
              </div>

              <div class="custom-control custom-switch col-md-2">
                <input type="checkbox" class="custom-control-input" id="customSwitch4">
                <label class="custom-control-label" for="customSwitch4"></label>
              </div>

            </div>

            <br>

            <div class="shadow p-3 mb-5 bg-white rounded">
              
            <h6 id="mensajeVentasProducts"></h6>
              
              <canvas class="grafica" id="CanvasVentasProducts">
                Su navegador no es compatible con Canvas
              </canvas>
            </div>

          </div>

        </div>




      </div>
    </div>
  </div>
  <?php
/*}
else
{
  header("location: ../index.php");
}*/
    //echo $struc->scripts();
?>
  <!--<script src="../bower_components/chartjs/dist/Chart.min.js"></script>
  <script src="../ajax/ajax-estadisticas.js"></script>
    <script src="../ajax/ajax-login.js"></script>
  <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>-->

  <script src="../bower_components/sweetAlert2/dist/sweetalert2.all.min.js"></script>
  <script src="../bower_components/sweetAlert2/dist/sweetalert2.js"></script>

  <script src="../bower_components/chartjs/dist/Chart.min.js"></script>
  <script src="../bower_components/pagination/pagination.js"></script>
  <script src="../ajax/ajax-estadisticas.js"></script>
  <script src="../ajax/ajax-reportes.js"></script>
  <script src="../ajax/ajax-login.js"></script>
  <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
  <script src=" https://unpkg.com/jspdf-autotable"></script>

</body>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

</html>