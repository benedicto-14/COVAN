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
  <title>Ventas</title>

  <?php
  echo $struc->links();
   ?>
  <link rel="stylesheet" href="../assets/css/style_ventas.css">

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
          <h2>Ventas</h2>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-outline-info mr-1">Recargas</button>
              <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalCorte" onclick="tablaCorte()">Corte</button>
              <!--<button type="button" class="btn btn-outline-dark">Servicios</button>-->
            </div>
          </div>
        </div>

              <!--Modal para ver Corte-->
        <div class="modal fade" id="modalCorte" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div id="pagoHea" class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Corte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div id="modalPago" class="modal-body">
                        <div  class="row">
                           <div id="containerModal" class="container-fluid">
                               <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Departamento</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabla_corte">
                                                <!-- aquí aparecen los resultados -->
                                            </tbody>
                                       </table>
                                   </div>
                               </div>
                               <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <h4><span id="total_corte" class="label label-success">  <!-- aquí aparece el total --> </span></h4>
                                    </div>
                              </div>
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn  btn-danger" data-dismiss="modal">Cancelar</button>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalOp Pagado">
                              Realizar Corte
                           </button>
                      </div>
                   </div>
                </div>
            </div>
        </div>
       <!--Termina modal para ver Corte-->

        <div class="row">
          <div class="col-md-4">
            <div class="input-group input-group-lg">
              <div class="input-group-prepend">
              </div>
              <input id="buscar" type="text" value="" class="form-control border border-primary" placeholder="Buscar Producto" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
            </div>
            <div id="PmasVendidos" class="card-header">
              Productos más vendidos
            </div>
            <div id="cardHe" class="card-deck">
              <div class="col-md-12">
                <div class="row" id="productos">
                  <!-- Productos mas vendidos -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="tablaVentas" class="table table-hover border border-dark">
                    <thead>
                      <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Eliminar</th>
                      </tr>
                    </thead>
                    <tbody id="productoVenta">
                      <tr>
                        <td class="text-muted" colspan="6"><em>Agrega un producto.</em></td>
                        <!-- Apartado de productos a vender -->
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="row">
             <div class="col-md-4"></div>
             <div class="col-md-8 mt-3">
               <div class="table-responsive">
                 <table id="tablaSub" class="table">
                   <tbody>
                     <thead class="thead-light">
                       <tr>
                         <th scope="col"><h5><b>Subtotal:</b></h5></th>
                         <td id="subTotal"><h5>$00.00</h5></td>
                       </tr>
                     </thead>
                     <thead class="thead-light">
                       <tr>
                         <th scope="col"><h6><b>I.V.A:</b></h6></th>
                         <td id="iva"><h6>$00.00</h6></td>
                       </tr>
                     </thead>
                     <thead class="thead-light" >
                       <tr>
                         <th scope="col"><h6><b>I.E.P.S:</b></h6></th>
                         <td id="ieps"><h6>$00.00</h6></td>
                       </tr>
                     </thead>
                     <thead id="iepsGen">
                       <!-- Ieps desglosado -->
                     </thead>
                     <thead class="thead-light">
                       <tr>
                         <th scope="col"><h4><b>Total:</b></h4></th>
                         <td id="total"><h3>$00.00</h3></td>
                       </tr>
                     </thead>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>

            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <form>
                  <div id="btnCobrar" class="form-group row">
                    <div class="col-md-12">
                      <!-- Button trigger modal -->
                      <button id="cobrarVenta" type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#modalCobrar">
                        Cobrar
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="modalCobrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div id="pagoHea" class="modal-header">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Pago</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div id="modalPago" class="modal-body">
                              <div id="containerModal" class="container-fluid">
                                <div id="mPago" class="row">
                                  <div class="col-md-4">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Efectivo</a>
                                      <!--<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tarjeta</a>
                                      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Crédito</a>-->
                                    </div>
                                  </div>
                                  <div class="col-md-8 ml-auto">
                                    <div class="tab-content" id="v-pills-tabContent">
                                      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                          <input id="efectivo" type="number" aria-label="First name" class="form-control">
                                        </div>
                                      </div>
                                      <!--<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                                          <input type="text" aria-label="First name" class="form-control">
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-hands-helping"></i></span>
                                          <input type="text" aria-label="First name" class="form-control">
                                        </div>
                                      </div>-->
                                    </div>
                                  </div>
                                </div>
                                <div id="saldos" class="row">
                                  <div class="col-md-6 ml-auto">
                                    <span class="label label-success">Saldo</span>
                                    <span id="saldoFinal" class="label label-success">
                                      <h4>00.00</h4>
                                    </span>
                                  </div>
                                  <div class="col-md-6 ml-auto">
                                    <span class="label label-success">Cambio</span>
                                    <span id="cambioVenta" class="label label-success">
                                      <h4>00.00</h4>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn  btn-danger" data-dismiss="modal">Cancelar</button>
                              <!-- Button trigger modal pagado -->
                              <button id="cobrar" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalOpPagado">
                                Vender
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
<script src="../ajax/ajax-ventas.js"></script>
  <script src="../ajax/ajax-login.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
