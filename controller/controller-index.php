<?php
class componentes {

    function headers(){
    return'<link rel="stylesheet" href="./bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bower_components/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">';
    }

    function nav(){
    return'<nav id="header" class="navbar navbar-expand-lg">
    <a id="logo" class="navbar-brand" href="../../index.php">COVAN</a>
    <button id="btnheader" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" >

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configuración
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>';
    }

    function navbarLateral(){
        return'<nav id="navLateral" class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span class="Descrip">Ventas</span>
              <a class="d-flex align-items-center text-muted" href="#">
              </a>
            </h6>
            <li class="nav-item">
              <a class="nav-link active" href="./ventas/ventas.php">
                <i class="fas fa-cash-register"></i>
                Caja
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="productos/productos.php">
                <i class="fas fa-cubes"></i>
                Productos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clientes/clientes.php">
                <i class="fas fa-users"></i>
                Clientes
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="facturacion/facturacion.php">
              <i class="fas fa-file"></i>
                Facturación
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span class="Descrip">Administraciòn</span>
            <a class="d-flex align-items-center text-muted" href="#">
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="compras/compras.php">
                <i class="fas fa-shopping-cart"></i>
              Compras
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="proveedores/proveedores.php">
                <i class="fas fa-dolly"></i>
                Proveedores
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sucursales/sucursales.php">
              <i class="fas fa-store-alt"></i>
                Surcursales
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="empleados/empleados.php">
              <i class="fas fa-address-card"></i>
                Empleados
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="estadisticas/estadisticas.php">
                <i class="fas fa-poll"></i>
                Estadìsticas
              </a>
            </li>
          </ul>
        </div>
      </nav>';
    }

    function scripts(){
        return '
         <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="./bower_components/jquery/dist/jquery.min.js"></script>
        <script src="./bower_components/fontawesome/js/all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
       ';
    }
}
