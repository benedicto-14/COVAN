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
  <title>Productos</title>

  <?php
   echo $struc->links();
     ?>
  <link rel="stylesheet" href="../assets/css/style_productos.css">

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
          <h2>Productos</h2>
        </div


        <nav>
          <div class="row">

            <div class="col-md-10">
              <div class="" >
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">  <h2 class="blockquote">Tabla de registro de proveedores</h2></a>
              </div>
            </div>

            <div class="col-md-2">
              <div class=" mb-2 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block"  data-toggle="modal" onclick="consultarEstados();" data-target="#modalAgregar">Agregar <i class="fa fa-plus"></i></button>
              </div>
            </div>
          </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="table-responsive d-md-block">
            <table class="table  table-sm">
                <thead class="bg-light">
                <tr>
                  <th>Proveedor</th>
                  <th>Teléfono</th>
                  <th>RFC</th>
                  <th>Correo</th>
                  <th colspan="3">Opciones</th>
                </tr>
              </thead>
              <tbody id="resultado">
              </tbody>
            </table>
          </div>

          </div>
        </div>

      </div>
    </div>
    <!-- Modales -->
<!-- Modal para agregar proveedor -->
<div class="modal" id="modalAgregar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <label class="modal-titel text-white"> Agregar proveedor</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true" class="text-white">&times;</span>
               </button>
        </div>
            <div class="modal-body">
                <form method="POST" id="form-provider">
                    <input type="hidden" name="agregarProveedor" value="1">
                <div class="row" >
                    <div class="col-form-4 col-sm-6 ">
                <label>Nombre del proveedor:</label>
                <input class="form-control"   name="nombre" id="nombreProveedor" placeholder="Proveedor">
                   <span id="error" class="help-block"></span>
                </div>
                    <div class="col-form-4 col-sm-6">
                <label>Teléfono:</label>
                <input class="form-control"  name="telefono" id="telefono" placeholder="Telefono">
                    </div>
                </div>
                <div class="row" >
                    <div class="col-form-4 col-sm-6 ">
                <label>RFC:</label>
                <input class="form-control" maxlength="14" text name="rfc" id="rfc" placeholder="">
                </div>
                    <div class="col-form-4 col-sm-6">
                <label>Email:</label>
                <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                    </div>
                </div>
                <div class="row">
                                <div class="col-md-4 col-sm-10 offset-sm-1 offset-md-0">
                                    <label class="col-form-label">Calle: </label>
                                    <input type="text" name="calle" class="form-control" id="calle" aria-describedby="calleHelp" placeholder="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">N° exterior: </label>
                                    <input type="text" name="exterior" class="form-control" id="exterior" aria-describedby="exteriorHelp" placeholder="">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="col-form-label">N° interior: </label>
                                    <input type="text" name="interior" class="form-control" id="interior" aria-describedby="interiorHelp" placeholder="">
                                </div>
                </div>
                <div class="row">
                                <div class="col-form-4 col-sm-6">
                                    <label class="col-form-label">Estado: </label>
                                    <div class="form-group" id="estados">
                                    </div>
                                </div>
                                <div class="col-form-4 col-sm-6">
                                    <label class="col-form-label">Municipio: </label>
                                    <div class="form-group" id="municipios">
                                        <select class="custom-select">
                                            <option selected="">--SELECCIONE--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                <div class="row">
                    <div class="col-form-4 col-sm-6">
                                    <label class="col-form-label">Localidad: </label>
                                    <div class="form-group" id="localidades">
                                        <select class="custom-select">
                                            <option selected="">--SELECCIONE--</option>
                                        </select>
                                    </div>
                                </div>
                   <div class="col-form-4 col-sm-6">
                                    <label class="col-form-label">Colonia: </label>
                                    <input type="text" name="colonia" class="form-control" id="colonia" aria-describedby="otraColoniaHelp" placeholder="" required="">
                                </div>
                </div>
                <div class="row">
                                <div class="col-form-4 col-sm-6">
                                    <label class="col-form-label">Código Postal: </label>
                                    <input type="text" name="cp" class="form-control" id="cp" aria-describedby="otraColoniaHelp" placeholder="" required="">
                                </div>
                            </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="cerrar">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="getDataProvider();">Guardar</button>
            </div>
    </div>
</div>
</div>
<!-- Termina modal para agregar proveedor -->

<!-- Modal para modificar proveedor -->
<div class="modal" id="modalActualizar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <label class="modal-titel text-white">Actualizar información del proveedor</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true" class="text-white">&times;</span>
               </button>
        </div>
            <div class="modal-body"  id="editarProveedor">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="cerrarEdit">Cerrar</button>
                <button type="button" class="btn btn-success btn-sm" onclick="getDataProviderEdit();">Guardar</button>
            </div>
    </div>
</div>
</div>
<!-- Termina modal para modificar proveedor -->

<!--Modal para ver información del proveedor-->
    <div class="modal fade bd-example-modal-lg" id="modalInformación" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:  #002752">
          <label class="modal-title text-white">Información de proveedor</label>
        <button type="button" class="close" data-dismiss="modal"aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label>Detalles:</label>
            <div id="">
            <table class="table table-striped table-bordered table-sm" style="table-layout:fixed">
                <tbody id="infoProveedor">
                </tbody>
                </table>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="close" style="background:#002752">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Termina modal para ver información del proveedor-->
  </div>

  <?php
}
else
{
  header("location: ../index.php");
}
    echo $struc->scripts();
?>
<script>
$(document).ready( function(){
cargarProveedores();
});
</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="../ajax/ajax-login.js"></script>
<script src="../ajax/ajax-proveedores.js"></script>
<script src="../ajax/ajax-EML.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
