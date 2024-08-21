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
  <title>Configuración</title>

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
            <input type="hidden" class="form-control"  value="<?php echo $_SESSION["idEmpresa"];?>" id="idEmpresa">
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
          <h2>Perfil</h2>
        </div
        </nav>

        <div class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-9">
                    <div class="card">
                       <div class="header">
                         <h5 class="title">Datos de la empresa</h5>
                       </div>
                       <div class="content" id="datosEmpresa">

                       </div>

                       <div class="card-footer">
                         <div class="row">
                       <div class="col-md-4">
                         <div class="col-form col-sm-12">
                          <button type="button" class="btn btn-primary  btn-sm btn-block" >Actualizar Información</button>
                          </div>
                       </div>
                       <div class="col-md-4">
                        <div class="col-form col-sm-12">
                           <button type="button" class="btn btn-primary btn-sm btn-block" onclick="editarEmpresa();">Guardar</button>
                          </div>
                       </div>
                     </div>
                   </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card text-center">
                    <div class="content" id="imgEmpresa">

                    </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>

      </div>
    </div>
    <!-- Modales -->
    <!-- Modal para modificar proveedor -->
    <div class="modal" id="modalImg" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <label class="modal-titel text-white">Actualizar logotipo.</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                   </button>
            </div>
                <div class="modal-body">
                  <form id="enviarImagen" method="post" enctype="multipart/form-data" >
                    <input type="hidden" class="form-control" name="img" value="<?php echo $_SESSION["idEmpresa"];?>">
                    <div class="form-group text-center" >
                    <div class="card col-md-8 mx-auto"  id="list">
                       <i class="fa fa-image rounded mx-auto img-fluid" alt="Responsive image" style="width: 235px; height:235px; color:#f9f9f9;"></i>
                    </div>
                      <figcaption class="figure-caption">Sólo se aceptan JPG y PNG no mayor de 3MB.</figcaption>
                    <div class="form-group text-center">
                    <label for="file-upload" class="subir btn btn-info">
                      <i class="fa fa-cloud-upload-alt"></i> Subir Archivo
                    </label>
                    <input type="file" name="file-upload" id="file-upload" style="display:none;"/>
                    </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="cerrarEdit">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="subirImagen();">Guardar</button>
                </div>
        </div>
    </div>
    </div>
    <!-- Termina modal para modificar proveedor -->
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
cargarEmpresa();
cargarImagen();
});
</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="../ajax/ajax-login.js"></script>
  <script src="../ajax/ajax-empresa.js"></script>
  <script src="../ajax/ajax-EML.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
