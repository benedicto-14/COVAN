<?php
include_once'../controller/controller-pages.php';
$struc = new componentes();
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
  {
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inicio</title>
  <!--
      <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" href="../../bower_components/fontawesome/css/all.css">
          <link rel="stylesheet" href="../../css/style-estructura.css"> -->


  <title>Sucursales</title>


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
          <h3 style="text-align: center;color: #FFFFFF;"><?php echo $_SESSION["empresa"];?></h3>
        </div>

        <div class="col-lg-3">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><label><?php echo $_SESSION["usuario"]; ?></label></a>
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h2>Sucursales</h2>
          <div class=" mb-2 mb-md-0">
            <button class="btn btn-primary btn-sm" data-toggle="modal" onclick="consultarEstados();" data-target="#agregar_nuevo_registro_modal">Agregar <i class="fa fa-plus"></i></button>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button> -->
          </div>
          <!-- <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div> -->
        </div>
        <h2>Sucursales Registradas</h2>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
          <form class="form-inline my-2 my-lg-0">
            <section>
              <!-- <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..."> -->
              <input class="form-control mr-sm-2" type="search" placeholder="Buscar Sucursal" aria-label="Search" name="busqueda" id="busqueda">
            </section>
          </form>
        </div>
        <div class="table-responsive">
          <table class="table  table-sm">
            <thead class="bg-light">

              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th colspan="3">Opciones</th>
              </tr>

            </thead>
            <tbody id="registros_content">
              <!-- aquí aparerecn los resultados -->
            </tbody>
          </table>

        </div>
      </div>




    </div>
  </div>
  </div>

  <!-- Modales -->
  <!-- Modal para agregar sucursal -->
  <div class="modal" id="agregar_nuevo_registro_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <label class="modal-titel text-white"> Agregar Nueva Sucursal</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="close" onclick="limpiarModalAgregar()">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-form-4 col-sm-6 ">
              <label>Nombre de la Sucursal:</label>
              <input class="form-control" id="nombre" placeholder="Sucursal" required="">
            </div>
            <div class="col-form-4 col-sm-6">
              <label>Teléfono:</label>
              <input class="form-control" id="telefono" placeholder="Teléfono" required="">
            </div>
            <div class="col-form-4 col-sm-6">
              <label>Correo:</label>
              <input class="form-control" id="correo" type="email" placeholder="Correo" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
              <label class="col-form-label">Calle: </label>
              <input type="text" name="calle" class="form-control" id="calle" aria-describedby="calleHelp" placeholder="" required="">
            </div>
            <div class="col-md-4 col-sm-6">
              <label class="col-form-label">N° Exterior: </label>
              <input type="text" name="exterior" class="form-control" id="exterior" aria-describedby="exteriorHelp" placeholder="" required="">
            </div>
            <div class="col-md-4 col-sm-6">
              <label class="col-form-label">N° Interior: </label>
              <input type="text" name="interior" class="form-control" id="interior" aria-describedby="interiorHelp" placeholder="" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Estado:</label>
              <div class="form-group" id="estados">

              </div>
            </div>
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Municipio:</label>
              <div class="form-group" id="municipios">
                <select class='custom-select'>
                  <option selected=''>--SELECCIONE--</option>
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Localidad: </label>
              <div class="form-group" id="localidades">
                <select class='custom-select'>
                  <option selected=''>--SELECCIONE--</option>
                </select>
              </div>
            </div>


            <div class="col-form-4 col-sm-6">
              <label class="col-form-label"> Colonia: </label>
              <input type="text" name="Colonia" class="form-control" id="colonia" aria-describedby="otraColoniaHelp" placeholder="" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label"> Coódigo Postal: </label>
              <input type="text" name="cp" class="form-control" id="cp" placeholder="" required="">
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" onclick="limpiarModalAgregar()">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="agregarSucursal()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Termina modal para agregar sucursal -->

  <!-- Modal para modificar sucursal -->
  <div class="modal" id="actualizar_modal_sucursal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <label class="modal-titel text-white">Actualizar Información de la Sucursal</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-form-4 col-sm-6 ">
              <label for="actualizar_nombre">Nombre de la Sucursal:</label>
              <input class="form-control" id="actualizar_nombre" placeholder="Sucursal" required="">
            </div>
            <div class="col-form-4 col-sm-6">
              <label>Teléfono:</label>
              <input class="form-control" id="actualizar_telefono" placeholder="Teléfono" required="">
            </div>
            <div class="col-form-4 col-sm-6">
              <label>Correo:</label>
              <input class="form-control" id="actualizar_correo" type="email" placeholder="Correo" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
              <label class="col-form-label">Calle: </label>
              <input type="text" name="calle" class="form-control" id="actualizar_calle" aria-describedby="calleHelp" placeholder="" required="">
            </div>
            <div class="col-md-4 col-sm-6 offset-sm-1 offset-md-0">
              <label class="col-form-label">N° Exterior: </label>
              <input type="text" name="exterior" class="form-control" id="actualizar_exterior" aria-describedby="exteriorHelp" placeholder="" required="">
            </div>
            <div class="col-md-4 col-sm-6 offset-sm-1 offset-md-0">
              <label class="col-form-label">N° Interior: </label>
              <input type="text" name="interior" class="form-control" id="actualizar_interior" aria-describedby="interiorHelp" placeholder="" required="">
            </div>
          </div>

          <div class="row">
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Estado: </label>
              <div class="form-group" id="editarEstado">

              </div>
            </div>
            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Municipio: </label>
              <div class="form-group" id="editarMunicipio">

              </div>
            </div>


            <div class="col-form-4 col-sm-6">
              <label class="col-form-label">Localidad: </label>
              <div class="form-group" id="editarLocalidas">

              </div>
            </div>

            <div class="col-form-4 col-sm-6">
              <label class="col-form-label"> Colonia: </label>
              <input type="text" name="colonia" class="form-control" id="actualizar_colonia" aria-describedby="otraColoniaHelp" placeholder="" required="">
            </div>
          </div>

          <div class="row">


            <div class="col-form-4 col-sm-6">
              <label class="col-form-label"> Codigo Postal: </label>
              <input type="text" name="cp" class="form-control" id="actualizar_cp" placeholder="" required="">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success btn-sm" onclick="actualizarSucursal()">Guardar</button>
          <input type="hidden" id="id_sucursal_oculto">
        </div>
      </div>
    </div>
  </div>
  <!-- Termina modal para modificar sucursal -->

  <!--Modal para eliminar sucursal-->
  <div class="modal" id="modal_eliminar_sucursal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <label class="modal-title text-white">Eliminar sucursal</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Está seguro de eliminar a este sucursal?</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" onclick="eliminarSucursal()">Aceptar</button>
          <input type="hidden" id="id_sucursal_eliminar_oculto">
        </div>
      </div>
    </div>
  </div>
  <!-- Termina modal para eliminar sucursal -->

  <!--Modal para ver información del sucursal-->
  <div class="modal" id="modalInformación" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background:  #002752">
          <label class="modal-title text-white">Información de la Sucursal</label>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label>Detalles:</label>
          <div id="">
            <table class="table table-striped table-bordered table-sm" style="table-layout:fixed">
              <tbody id="infoSucursal">
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background:  #002752">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Termina modal para ver información del sucursal-->

  <?php
}
else
{
  header("location: ../index.php");
}
    echo $struc->scripts();
?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../ajax/ajax-sucursales.js"></script>
  <script src="../ajax/ajax-EML.js"></script>
    <script src="../ajax/ajax-login.js"></script>
  <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
