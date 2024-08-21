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
  <link rel="stylesheet" type="text/css" href="../assets/css/spinner.css" />
  <!-- <link rel="stylesheet" href="../assets/css/ticket.css">-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Facturación</title>



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
          <h2>Facturación</h2>
          <div class="btn-toolbar mb-2 mb-md-0">


          </div>
        </div>



        <!-- Modal Buscar Cliente-->
        <div class="modal fade" id="modalBuscarCliente">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Buscar cliente.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true" class="text-white">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="">
                <form method="post" id="formConsultarCliente">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Datos del cliente</span>
                    </div>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)." required>
                    <input type="text" class="form-control" id="paterno" name="paterno" placeholder="Apellido paterno." required>
                    <input type="text" class="form-control" id="materno" name="materno" placeholder="Apellido materno." required>
                  </div>
                </form>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="buscarCliente()" id="loadingBoton">Buscar cliente</button>
                <button class="btn btn-primary" id="loadingBoton2" type="button" disabled style="display: none">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  cargando...
                </button>
                <button type="button" id="cancelarB" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>


        <!-- Termina modal -->

        <!-- Modal Buscar productos de venta -->
        <div class="modal fade" id="modalBuscarProductos">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Buscar productos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                  <span aria-hidden="true" class="text-white">&times;</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="modal-body" id="">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Datos de la venta</span>
                  </div>
                  <input type="number" class="form-control" id="productos" name="productos" placeholder="Id compra" required>
                </div>

              </div>
              <!-- Modal footer -->
              <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="buscarProductos()" id="loadingBoton3">Buscar productos</button>
                <button class="btn btn-primary" id="loadingBoton4" type="button" disabled style="display: none">
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  cargando...
                </button>
                <button type="button" id="cancelarP" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>


        <!-- Termina modal -->
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Realizar facturación <i class="fa fa-plus"> </i> </a>

            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Facturaciones realizadas <i class="fas fa-folder-open"></i></a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Configuraciones <i class="fas fa-cogs"></i></a>

          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <br>



            <form action="/action_page.php">
              <div class="row">

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="nombre">Nombre del cliente:</label>
                    <input type="text" class="form-control" id="nombreC" placeholder="Nombre" name="nombreC" value="" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="apellidoP">Apellido paterno:</label>
                    <input type="text" class="form-control" id="apellidoC" placeholder="Apellido paterno." name="apellidoPC" value="" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="rfc">RFC:</label>
                    <input type="text" class="form-control" id="rfcC" placeholder="RFC" name="rfcC" value="" disabled>
                  </div>
                </div>

                <div class="col-md-2">
                  <label for="">Buscar cliente</label>

                  <button type="button" class="btn btn-primary  btn-block" id="buscarC" data-toggle="modal" data-target="#modalBuscarCliente">
                    Buscar cliente
                    <i class="fas fa-search"></i>
                  </button>
                </div>
                <div class="col-md-2">
                  <label for="">Buscar productos</label>

                  <button type="button" class="btn btn-primary  btn-block" id="buscarPC" data-toggle="modal" data-target="#modalBuscarProductos">
                    Productos
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="row">

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="referencia">Referencia:</label>
                    <input type="text" class="form-control" id="referencia" placeholder="Referencia." name="referenciaC" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="metodoPago">Método de pago:</label>
                    <input type="text" class="form-control" id="metodoPago" placeholder="Metodo de pago" name="metodoPagoC" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="formaPago">Forma de pago:</label>
                    <input type="text" class="form-control" id="formaPago" placeholder="Forma de pago" name="formaPagoC" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="abono">Abono:</label>
                    <input type="text" class="form-control" id="abono" placeholder="Abono." name="AbonoC" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <strong><label for="cfdi">Uso del CFDI:</label></strong>
                  <div class="form-group" id="cfdi">
                    <select class="form-control" id="cfdi">
                      <option></option>
                      <option value="G01">Adquisición de mercancias</option>
                      <option value="G03">Gastos en general</option>
                      <option value="P01">Por definir</option>
                    </select>
                  </div>
                </div>

              </div>


            </form>

            <table class="table">
              <thead>
                <tr>
                  <th>Cantidad</th>
                  <th>Unidad</th>
                  <th>Clave de producto</th>
                  <th>IVA</th>
                  <th>IEPS</th>
                  <th>V. Unitario</th>
                  <th>Importe</th>

                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <hr />

            <div class="row">


              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
              <div class="col-md-3">

                <label for="sub">SubTotal: </label>
                <input type="text" class="form-control" id="sub" placeholder="0" name="sub">
                <label for="iva">IVA(16%): </label>
                <input type="iva" class="form-control" id="iva" placeholder="0" name="iva">
                <label for="sub">IEPS: </label>
                <input type="iva" class="form-control" id="iva" placeholder="0" name="iva">
                <label for="sub">Total de la factura: </label>
                <input type="iva" class="form-control" id="iva" placeholder="0" name="iva">



              </div>

            </div>
            <button type="button" class="btn btn-primary  btn-block" id="modalCargar" data-toggle="modal" data-target="#login" style="display: none">
              Productos
              <i class="fas fa-search"></i>
            </button>

          </div>

          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            <div class="text-center">
              <h3>Facturaciones realizadas</h3>
            </div>

            <button type="button" class="btn btn-primary" id="br" data-toggle="modal" data-target="#modalTicket">Prueba</button>

            <!-- Modal ticket-->
            <div class="modal fade" id="modalTicket">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Ticket.</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body" id="">



                    <div id="ticket">
                      <div class="ticket" style="font-size: 12px;font-family: 'Times New Roman';">
                        <!--                <img src="https://yt3.ggpht.com/-3BKTe8YFlbA/AAAAAAAAAAI/AAAAAAAAAAA/ad0jqQ4IkGE/s900-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="Logotipo" >-->
                        <p class="centrado" style=" text-align: left; align-content: center;">TICKET DE VENTA
                          <br>SILIAN
                          <br>17/10/2017 02:22 a.m.
                          <br>Id de la venta:</p>
                        <table style="  border-top: 1px solid black; border-collapse: collapse;  font-size: 12px;font-family: 'Times New Roman'; width: 155px; max-width: 155px;">
                          <thead>
                            <tr>
                              <th class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse; ">CANT</th>
                              <th class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">PRODUCTO</th>
                              <th class="precio" style=" border-top: 1px solid black; border-collapse: collapse;">PRECIO</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;">1.00</td>
                              <td class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">CHEETOS VERDES 80 G</td>
                              <td class="precio" style=" border-top: 1px solid black; border-collapse: collapse;">$8.50</td>
                            </tr>

                            <tr>
                              <td class="cantidad" style=" border-top: 1px solid black; border-collapse: collapse;"></td>
                              <td class="producto" style=" border-top: 1px solid black; border-collapse: collapse;">TOTAL</td>
                              <td class="precio" style=" border-top: 1px solid black; border-collapse: collapse;">$28.50</td>
                            </tr>
                          </tbody>
                        </table>
                        <p class="centrado">¡GRACIAS POR SU COMPRA!</ </div> </div> </div> </div> </div> <!-- Modal footer -->
                          <div class="modal-footer">

                            <button type="button" class="btn btn-primary" onclick="imprimir()">imprimir ticket</button>
                            <!--            <button class="btn btn-primary" id="loadingBoton2" type="button" disabled style="display: none">
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  cargando...
</button>-->
                            <button type="button" id="cancelarB" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>

                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="text-center">
                      <h3>Configuraciones</h3>
                    </div>

                  </div>

                </div>

              </div>
            </div>

</body>
<?php
}
else
{
header("location: ../index.php");
}
  echo $struc->scripts();
?>
<script src="../ajax/ajax-facturacion.js"></script>
  <script src="../ajax/ajax-login.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</html>
