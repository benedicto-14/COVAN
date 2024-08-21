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
        </div>


        <nav>
          <div class="row">

            <div class="col-md-8">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Producto</a>
              </div>
            </div>

            <div class="col-md-4">
              <!-- Button trigger modal Agregar producto-->
              <button type="button" class="btn btn-secondary mt-3" onclick="consultarDepartamentos(); consultarUnidadMedida();" title="Agregar Producto" data-toggle="modal" data-target="#ModalCenterAddProduct">
                <i class="fas fa-plus-square fa-2x"></i>
              </button>

              <button type="button" class="btn btn-secondary mt-3" title="Compras">
                <i class="fas fa-shopping-cart fa-2x"></i>
              </button>

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-secondary mt-3" title="Promociones" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-gift fa-2x"></i>
              </button>


              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>






              <!-- Modal add product -->
              <div class="modal fade" id="ModalCenterAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div id="addProduto" class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Producto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" id="form-Product">
                        <input type="hidden" name="addProduct" value="1">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputSn">Código de barras</label>
                            <input type="number" class="form-control" name="codigoBarras" id="codigoBarras" placeholder="Ingresar Código Barras">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputD">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombreProducto" placeholder="Ingresar Nombre">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputSn">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Información Detallada">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputD">Departamento</label>
                            <div class="input-group" id="departamentos">
                              <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addo">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="inputD">Categoría</label>
                            <div class="input-group" id="categorias">
                              <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addo">
                                <option selected>Seleccione...</option>
                              </select>
                            </div>
                          </div>
                        </div>



                        <fieldset class="form-group" id="gradosAlcohol" style='display:none;'>
                          <div class="row">
                            <div class="col-md-8">


                              <legend class="col-form-label col-sm-2 pt-0">Graduación alcohólica</legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" id="gridRadios1" value="option1" checked>
                                  <label class="form-check-label" for="gridRadios1">
                                    Hasta 14° GL
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" id="gridRadios2" value="option2">
                                  <label class="form-check-label" for="gridRadios2">
                                    Más de 14° y hasta 20° GL
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" id="gridRadios2" value="option2">
                                  <label class="form-check-label" for="gridRadios2">
                                    Más de 20°GL
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-4">
                              <label for="validationTooltip01">Precio venta</label>
                              <input type="number" class="form-control" id="precioVenta" placeholder="Ingresar precio" required>

                            </div>
                          </div>
                        </fieldset>

                        <div class="form-row">
                          <div class="col-md-4 mb-3">
                            <label for="validationTooltip01">Precio venta</label>
                            <input type="number" name="precioVenta" class="form-control" id="precioVenta" placeholder="Ingresar precio" required>

                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="validationTooltip02">Precio Mayoreo</label>
                            <input type="Number" class="form-control" name="precioMayoreo" id="precioMayoreo" placeholder="Ingresar precio" required>
                          </div>

                          <div class="col-md-4 mb-3">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Unidad de venta</label>
                            <div class="input-group" id="uniMedida">
                              <select class="custom-select" id="inlineFormCustomSelectPref">
                                <option selected>Elegir...</option>
                                <option value="1">Pieza</option>
                                <option value="2">Kilo</option>
                                <option value="3">Metro</option>
                                <option value="3">litro</option>
                              </select>
                            </div>
                          </div>

                        </div>


                        <div class="form-row">
                          <div class="form-group col-md-12">

                          </div>
                        </div>

                        <div class="form-row">

                          <div class="col-md-6 mb-3">
                            <label for="validationTooltip02">ieps</label>
                            <input type="Number" class="form-control" name="ieps" id="validationTooltip02" placeholder="Ingresar precio" required>
                          </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success" onclick="getDataProduct();">Registrar producto</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Termina modal para agregar producto -->

            </div>
          </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

            <div class="col-md-12">
              <form id="buscadorP" class="form-inline">
                <div class="form-group mb-2">
                  <label>Buscar Producto</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">

                  <input id="search" type="text" value="" class="form-control border border-primary" placeholder="S/N o Descripción" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                  <input type="text" class="form-control" placeholder="S/N o Descripción" style='display:none;'>
                </div>
              </form>
            </div>


            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">IdProducto</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">PrecioVenta</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Stock</th>
                    <th scope="col" colspan="2">Opciones</th>
                  </tr>
                </thead>
                <tbody id="producto">

                </tbody>
              </table>
            </div>

            <!-- Modal Modificar Prodcutos add-->
            <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Valdi</h5>
                    <button type='button' class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class='container-fluid' id="editarProducto">

                      <!--datos del producto a Modificar-->
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  <?php
}
else
{
  header("location: ../index.php");
}
    echo $struc->scripts();
?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="../ajax/ajax-productos.js"></script>
    <script src="../ajax/ajax-login.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
