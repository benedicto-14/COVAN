<?php
class componentes {

    function links(){
    return'<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bower_components/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style-original.css">
    <link rel="stylesheet" href="../bower_components/sweetAlert2/dist/sweetalert2.min.css">
    ';
    }

    function navHeader(){
    return'
<nav class="navbar navbar-expand-lg navbar-light" id="valdi">

  <div class="col-lg-3 col-md-4 col-sm-4">
    <button type="button" id="sidebarCollapse" class="navbar-btn">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>

  <div class="col-lg-6 col-md-8 col-sm-8 d-none d-md-block">
    <h3 style="text-align: center;color: #FFFFFF;">Miscelánea Jenny</h3>
  </div>

  <div class="col-lg-3">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><label><?php echo $_SESSION["usuario"]; ?></label></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"><i class="fas fa-wrench"></i> Configuración </a>
            <a class="dropdown-item" href="#"><i class="fas fa-power-off"></i> Salir</a>
          </div>
        </li>
      </ul>
    </div>
  </div>

</nav>
';
    }

    function navbarLateral(){
    return'
<nav id="sidebar">

  <div id="josue" class="sidebar-header">
    <a id="logo" class="navbar-brand" href="../../index.php">
      <h3 style="color: #FFF;margin: 0;">SILIAN</h3>
    </a>
  </div>

  <ul class="navbar-nav">
    <p>Ventas</p>

    <li>
      <a class="nav-link active" href="ventas.php">
        <i class="fas fa-cash-register"></i>
        Caja
      </a>
    </li>

    <li>
      <a class="nav-link" href="productos.php">
        <i class="fas fa-cubes"></i>
        Productos
      </a>
    </li>

    <li>
      <a class="nav-link" href="clientes.php">
        <i class="fas fa-users"></i>
        Clientes
      </a>
    </li>

    <li>
      <a class="nav-link" href="facturacion.php">
        <i class="fas fa-file"></i>
        Facturación
      </a>
    </li>
  </ul>


  <ul class="list-unstyled">
    <p>Administración</p>

    <li class="nav-item">
      <a class="nav-link" href="compras.php">
        <i class="fas fa-shopping-cart"></i>
        Compras
      </a>
    </li>

    <li>
      <a class="nav-link" href="proveedores.php">
        <i class="fas fa-dolly"></i>
        Proveedores
      </a>
    </li>

    <li>
      <a class="nav-link" href="sucursales.php">
        <i class="fas fa-store-alt"></i>
        Surcursales
      </a>
    </li>

    <li>
      <a class="nav-link" href="departamentos.php">
        <i class="fas fa-columns"></i>
        Departamentos
      </a>
    </li>

    <li>
      <a class="nav-link" href="empleados.php">
        <i class="fas fa-address-card"></i>
        Empleados
      </a>
    </li>

    <li>
      <a class="nav-link" href="estadisticas.php">
        <i class="fas fa-poll"></i>
        Estadísticas
      </a>
    </li>

  </ul>
</nav>
  ';
    }

    function scripts(){
        return '
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/fontawesome/js/all.min.js"></script>
        <script src="../bower_components/sweetAlert2/dist/sweetalert2.all.min.js"></script>
        <script src="../bower_components/sweetAlert2/dist/sweetalert2.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebarCollapse").on("click", function () {
                    $("#sidebar").toggleClass("active");
                    $(this).toggleClass("active");
                });
            });
            </script>
       ';
    }
}
