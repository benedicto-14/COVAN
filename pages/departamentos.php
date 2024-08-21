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
          <h2>Categorias y Departamentos</h2>
        </div

          <div class="row">

            <!--Tabla de departamentos-->
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-dep-tab" data-toggle="tab" href="#nav-dep" role="tab" aria-controls="nav-dep" aria-selected="true">Departamentos</a>
                    <a class="nav-item nav-link" id="nav-cat-tab" data-toggle="tab" href="#nav-cat" role="tab" aria-controls="nav-cat" aria-selected="false">Categorias</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-dep" role="tabpanel" aria-labelledby="nav-dep-tab">
                    <div class="row" style="padding-top:2px;">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title float-left">Departamentos:</h5>
                                <button class="btn-primary btn-sm float-right" data-toggle="modal" data-target="#addDepartamento" >Agregar <i class="fa fa-plus"></i></button>
                            </div>
                    <div class="col-sm-12 col-md-12">
                          <div class="table-responsive ">
                              <table class="table table-sm " style="table-layout:fixed">
                                  <thead class="bg-light">
                                      <tr>
                                          <th>Departamento</th>
                                          <th>Descripción</th>
                                          <th>Eliminar</th>
                                      </tr>
                                  </thead>
                                  <tbody  id="departamentos">

                                  </tbody>
                              </table>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
                  <div class="tab-pane fade" id="nav-cat" role="tabpanel" aria-labelledby="nav-cat-tab">
                    <div class="row" style="padding-top:2px;">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title float-left">Categorias:</h5>
                                <button class="btn-primary btn-sm float-right" data-toggle="modal" onclick="comboDepartamentos();" data-target="#addCategoria" >Agregar <i class="fa fa-plus"></i></button>
                            </div>
                            <div class="table-responsive ">
                                <table class="table table-sm " style="table-layout:fixed">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th colspan="2" width="100">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categorias">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                    </div>
                  </div>
            </div>
       </main>
      </div>

        <!-- Modales -->
      <!-- Modal para agregar departamento -->
      <div class="modal" id="addDepartamento" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <label class="modal-titel text-white"> Agregar Departamento</label>
                      <button type="button" class="close" data-dismiss="modal" aria-label="close">
                          <span aria-hidden="true" class="text-white">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12 col-sm-12">
                              <label class="col-form-label">Nombre del departamento: </label>
                              <input type="text" name="calle" class="form-control" id="nombreDepartamento" aria-describedby="departamentoHelp" placeholder="" required="">
                          </div>
                          <div class="col-md-12 col-sm-12">
                              <label class="col-form-label">Descripción: </label>
                              <textarea type="text" name="exterior" class="form-control" id="descripcionDep" aria-describedby="desDepartamentoHelp" placeholder="" required=""></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" id="cerrarDep" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary btn-sm" onclick="insertarDepartamento();">Guardar</button>
                  </div>
              </div>
          </div>
      </div>
          </div>

          </div>
        </div>

    <!-- Modales -->
    <!-- Modales -->
          <!-- Modal para agregar departamento -->
          <div class="modal" id="addDepartamento" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-primary">
                          <label class="modal-titel text-white"> Agregar Departamento</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="close">
                              <span aria-hidden="true" class="text-white">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label">Nombre del departamento: </label>
                                  <input type="text" name="calle" class="form-control" id="nombreDepartamento" aria-describedby="departamentoHelp" placeholder="" required="">
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label">Descripción: </label>
                                  <textarea type="text" name="exterior" class="form-control" id="descripcionDep" aria-describedby="desDepartamentoHelp" placeholder="" required=""></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" id="cerrarDep" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary btn-sm" onclick="insertarDepartamento();">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Termina modal para agregar departamento -->

          <!-- Modal para agregar categoria-->
          <div class="modal" id="addCategoria" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-primary">
                          <label class="modal-titel text-white"> Agregar Categoria</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="close">
                              <span aria-hidden="true" class="text-white">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label class="col-form-label">Departamento: </label>
                                <div class="form-group" id="comboDepartamentos">
                                    <select class="custom-select">
                                        <option selected="">--SELECCIONE--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label class="col-form-label">Clave: </label>
                                <input type="text" name="clave" class="form-control" id="clave" aria-describedby="categoriaHelp" placeholder="" required="">
                            </div>
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label">Nombre de categoria: </label>
                                  <input type="text" name="categoria" class="form-control" id="nombreCategoria" aria-describedby="categoriaHelp" placeholder="" required="">
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <label class="col-form-label">Descripción:</label>
                                  <textarea type="text" name="desCategoria" class="form-control" id="descripcionCat" aria-describedby="desCategoriaHelp" placeholder="" required=""></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="cerrarCat">Close</button>
                          <button type="button" class="btn btn-primary btn-sm" onclick="insertarCategoria();">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Termina modal para agregar categoria-->

          <!-- Modal para modificar categoria-->
          <div class="modal" id="actualizarCategoria" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <label class="modal-titel text-white">Actualizar información de categoria</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="close">
                              <span aria-hidden="true" class="text-white">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body" id="editarCategoria">
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="cerrarCat">Close</button>
                          <button type="button" class="btn btn-success btn-sm" onclick="editarCategoria();">Guardar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Termina modal para modificar categoria -->

          <!--Modal para eliminar departamento-->
          <div class="modal" id="modal-eliminar-departamento" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <label class="modal-title text-white">Eliminar departamento</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-white">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p>¿Está seguro de eliminar a este departamento?</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Aceptar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Termina modal para eliminar departamento -->

          <!--Modal para eliminar categoria-->
          <div class="modal" id="modal-eliminar-categoria" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <label class="modal-title text-white">Eliminar categoria</label>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-white">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <p>¿Está seguro de eliminar a esta categoria?</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-danger">Aceptar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Termina modal para eliminar categoria -->
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
      cargarDepartamentos();
      cargarCategorias();
      });
</script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="../ajax/ajax-departamentos.js"></script>
    <script src="../ajax/ajax-login.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
