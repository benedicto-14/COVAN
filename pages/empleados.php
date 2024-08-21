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
  <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <!--Import materialize.css-->
  <link rel="stylesheet" href="../assets/css/estadisticas.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Empleados</title>
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
          <h2>Empleados</h2>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-primary" id="agregarM" data-toggle="modal" data-target="#ModalAgregar" onclick="activarFunciones();">
                Agregar nuevo empleado.
                <i class="fas fa-user-plus"></i>
              </button>



              <!--              <a href="agregarEmpleado.php"><button type="button" class="btn btn-sm btn-outline-secondary">Agregar nuevo empleado. <i class="fas fa-user-plus"></i></button></a>-->
            </div>
          </div>

        </div>

         <div class="row">
                        <div class="col-md-4">
                            <h2 class="blockquote ">Tabla de registro de empleados</h2>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <!--       Cuadro de texto para buscar a los empleados por nombre o apellido paterno o apellido materno-->
                                <input type="text" class="form-control" placeholder="Buscar por nombre o apellido" id="buscadorEmpleados" name="username">
                            </div>
                        </div>
                    </div>


        <div class="table-responsive">
          <table class="table  table-sm">
            <thead class="bg-light">
              <tr>
                <th>Nombre.</th>
                <th>Apellido paterno.</th>
                <th>Apellido materno.</th>
                <th>Edad.</th>
                <th>Sexo.</th>
                <th>Visualizar datos.</th>
                <th>Editar empleado.</th>
                <th>Eliminar empleado.</th>
                <!--          <td class="text-center"><a href="editarEmpleado.php?id='.$r["idEmpleado"].'"><i class="fas fa-user-edit"></i></a> </td>-->
              </tr>
            </thead>
            <tbody id="empleado">

            </tbody>
          </table>
          <br>
          <br>
          <div id="spinner" style="display: none">
            <div class="sk-folding-cube">
              <div class="sk-cube1 sk-cube"></div>
              <div class="sk-cube2 sk-cube"></div>
              <div class="sk-cube4 sk-cube"></div>
              <div class="sk-cube3 sk-cube"></div>

            </div>

          </div>
        </div>




      </div>
    </div>
  </div>



  <!-- Modal agregar empleado -->
  <div class="modal fade" id="ModalAgregar">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Agregar empleado.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" id="form_account">

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Empleado</span>
              </div>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)." required>
              <input type="text" class="form-control" id="paterno" name="paterno" placeholder="Apellido paterno." required>
              <input type="text" class="form-control" id="materno" name="materno" placeholder="Apellido materno." required>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <strong><label for="curp">Curp:</label></strong>
                  <input class="form-control" id="curp" name="curp" placeholder="Curp" type="text" required>
                </div>


              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <strong><label for="rfc">RFC:</label></strong>
                  <input class="form-control" id="rfc" name="rfc" placeholder="RFC" type="text" required>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Dirección.</span>
              </div>
              <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia." required>
              <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle." required>
              <input type="number" class="form-control" id="numeroext" name="numeroext" placeholder="Número ext." required>
              <input type="number" class="form-control" id="numeroint" name="numeroint" placeholder="Número int." required>
            </div>
            <div class="row">
              <div class="col-md-3">
                <strong><label for="estado">Estado:</label></strong>
                <div class="form-group" id="estadoA">

                </div>
              </div>
              <div class="col-md-3">
                <strong><label for="municipio">Municipio:</label></strong>
                <div class="form-group" id="municipioA">
                  <select class="form-control" id="m">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <strong><label for="localidad">Localidad:</label></strong>
                <div class="form-group" id="localidadA">

                  <select class="form-control" id="l">
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <strong><label for="cpostal">Codigo postal:</label></strong>
                <input type="number" class="form-control" id="cpostal" name="cpostal" placeholder="Codigo postal." required>

              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <strong><label for="turno">Turno:</label></strong>
                <div class="form-group" id="turnosA">


                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <strong><label for="sexo">Sexo:</label></strong>
                  <select class="form-control" id="sexo" name="sexo">
                    <option></option>
                    <option value="1">Hombre</option>
                    <option value="2">Mujer</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <strong><label for="edad">Edad:</label></strong>
                  <input class="form-control" id="edad" name="edad" placeholder="Edad." type="number" required>
                </div>
              </div>

            </div>
            <strong><label for="sucursal">Sucursal:</label></strong>
            <div class="form-group" id="sucursales">

            </div>


            <!--             <div class="form-group" id="iHiden"> </div>-->


          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="getDataEmployee();">Agregar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelar">Cancelar</button>
        </div>

      </div>
    </div>
  </div>


  <!-- Modal editar empleado -->
  <div class="modal fade" id="ModalEditar">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Editar empleado.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="MbodyEditar">
          <form>

            <!--      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Empleado</span>
        </div>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)." required value="'.$r["empleado"].'">
        <input type="text" class="form-control" id="paterno" name="paterno" placeholder="Apellido paterno." required value='.$r["apellidoPaterno"].'>
        <input type="text" class="form-control" id="materno" name="materno" placeholder="Apellido materno." required value='.$r["apellidoMaterno"].'>
      </div>  -->





          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="obtenerDatosEditar()">Guardar datos</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelarE">Cancelar</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal visualizar empleado -->
  <div class="modal fade" id="ModalVisualizar">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Datos del empleado.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="MbodyVisualizar"></div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>

      </div>
    </div>
  </div>
  <!-- Modal eliminar empleado -->
  <div class="modal fade" id="ModalEliminar">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Eliminar empleado.</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="MbodyEliminar">
          <p>¿Desea eliminar al empleado?</p>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
        </div>

      </div>
    </div>
  </div>
  <!-- Modal agregar usuario al sistema -->
  <div class="modal fade" id="ModalAgregarSistema">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Datos del usuario.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="MbodyAgregarSistema">
          <form method="post" id="form_usuario">
            <div id="DatosUsuario">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <strong><label for="Usuario">Usuario:</label></strong>
                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="usuario">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <strong><label for="pass">Contraseña:</label></strong>
                    <input type="text" class="form-control" id="pass" placeholder="Contraseña" name="pass">
                    <input type="hidden" id="idEmpleadoUsuario" name="idEmpleadoUsuario">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <strong><label for="tipoUsuario">Tipo de usuario:</label></strong>

                    <select class="form-control" id="tipoUsuario" name="tipoUsuario" onchange="asignarPrivilegios();">
                      <option></option>
                      <option value="1">Administrador</option>
                      <option value="2">General</option>
                      <option value="3">Usuario</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-md-4">
                <h4>Asignar privilegios a usuario</h4>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-block" onclick="habilitarCheckbox();">Habilitar privilegios </button>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Módulo clientes.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_Cliente" value="1" name="agregar_Cliente">
                    <label class="custom-control-label" for="agregar_Cliente">Agregar clientes.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_Cliente" value="1" name="modificar_Cliente">
                    <label class="custom-control-label" for="modificar_Cliente">Modificar datos de los clientes.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_Cliente" value="1" name="eliminar_Cliente">
                    <label class="custom-control-label" for="eliminar_Cliente">Eliminar clientes.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo compras.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_Compra" value="1" name="agregar_Compra">
                    <label class="custom-control-label" for="agregar_Compra">Agregar.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_Compra" value="1" name="modificar_Compra">
                    <label class="custom-control-label" for="modificar_Compra">Modificar datos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_Compra" value="1" name="eliminar_Compra">
                    <label class="custom-control-label" for="eliminar_Compra">Eliminar datos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo empleados.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_Empleado" value="1" name="agregar_Empleado">
                    <label class="custom-control-label" for="agregar_Empleado">Agregar empleados.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_empleado" value="1" name="modificar_empleado">
                    <label class="custom-control-label" for="modificar_empleado">Modificar datos de los empleados.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_Empleado" value="1" name="eliminar_Empleado">
                    <label class="custom-control-label" for="eliminar_Empleado">Eliminar empleados.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de facturación electronica.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_facturacion" value="1" name="agregar_facturacion">
                    <label class="custom-control-label" for="agregar_facturacion">Realizar facturación.</label>
                  </div>
                </div>

              </div>
              <hr />
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Usuarios.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_usuario" value="1" name="agregar_usuario">
                    <label class="custom-control-label" for="agregar_usuario">Agregar usuarios.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_usuario" value="1" name="modificar_usuario">
                    <label class="custom-control-label" for="modificar_usuario">Modificar datos de los usuarios.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_usuario" value="1" name="eliminar_usuario">
                    <label class="custom-control-label" for="eliminar_usuario">Eliminar usuarios.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de productos.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_productos" value="1" name="agregar_productos">
                    <label class="custom-control-label" for="agregar_productos">Agregar productos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_productos" value="1" name="modificar_productos">
                    <label class="custom-control-label" for="modificar_productos">Modificar datos de los productos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_productos" value="1" name="eliminar_productos">
                    <label class="custom-control-label" for="eliminar_productos">Eliminar productos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de proveedores.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_proveedores" value="1" name="agregar_proveedores">
                    <label class="custom-control-label" for="agregar_proveedores">Agregar proveedores.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_proveedores" value="1" name="modificar_proveedores">
                    <label class="custom-control-label" for="modificar_proveedores">Modificar datos de los proveedores.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_proveedores" value="1" name="eliminar_proveedores">
                    <label class="custom-control-label" for="eliminar_proveedores">Eliminar proveedores.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de sucursales.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_sucursales" value="1" name="agregar_sucursales">
                    <label class="custom-control-label" for="agregar_sucursales">Agregar sucursales.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_sucursales" value="1" name="modificar_sucursales">
                    <label class="custom-control-label" for="modificar_sucursales">Modificar datos de las sucursales.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_sucursales" value="1" name="eliminar_sucursales">
                    <label class="custom-control-label" for="eliminar_sucursales">Eliminar sucursales.</label>
                  </div>
                </div>

              </div>
              <hr />
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de ventas.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_ventas" value="1" name="agregar_ventas">
                    <label class="custom-control-label" for="agregar_ventas">Realizar ventas.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cancelar_venta" value="1" name="cancelar_venta">
                    <label class="custom-control-label" for="cancelar_venta">Cancelar la venta.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo registro de asistencia.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="registrar_asistencia" value="1" name="registrar_asistencia">
                    <label class="custom-control-label" for="registrar_asistencia">Registrar asistencia.</label>
                  </div>


                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo departamentos.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_departamento" value="1" name="agregar_departamento">
                    <label class="custom-control-label" for="agregar_departamento">Agregar departamentos.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="modificar_departamento" value="1" name="modificar_departamento">
                    <label class="custom-control-label" for="modificar_departamento">Modificar departamentos.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="eliminar_departamentos" value="1" name="eliminar_departamentos">
                    <label class="custom-control-label" for="eliminar_departamentos">Eliminar departamentos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de estadística.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="estadistica" value="1" name="estadistica">
                    <label class="custom-control-label" for="estadistica">Estadísticas de la empresa.</label>
                  </div>

                </div>

              </div>
            </div>

          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="guardarUsuario" class="btn btn-success" onclick="validarNombre();">Guardar Datos</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelarUsuario">Cancelar</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal editar datos de usuario del sistema-->
  <div class="modal fade" id="ModalSistemaEditar">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Datos del usuario.</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="MbodySistemaEditar">
          <form method="post" id="form_usuarioEditar">
            <div id="DatosUsuarioEditar">

            </div>
            <hr />
            <div class="row">
              <div class="col-md-4">
                <h4>Asignar privilegios a usuario</h4>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-block" onclick="habilitarCheckbox();">Habilitar privilegios </button>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Módulo clientes.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_ClienteE" value="1" name="agregar_ClienteE">
                    <label class="custom-control-label" for="agregar_ClienteE">Agregar clientes.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_ClienteE" value="1" name="modificar_ClienteE">
                    <label class="custom-control-label" for="modificar_ClienteE">Modificar datos de los clientes.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_ClienteE" value="1" name="eliminar_ClienteE">
                    <label class="custom-control-label" for="eliminar_ClienteE">Eliminar clientes.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo compras.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_CompraE" value="1" name="agregar_CompraE">
                    <label class="custom-control-label" for="agregar_CompraE">Agregar.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_CompraE" value="1" name="modificar_CompraE">
                    <label class="custom-control-label" for="modificar_CompraE">Modificar datos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_CompraE" value="1" name="eliminar_CompraE">
                    <label class="custom-control-label" for="eliminar_CompraE">Eliminar datos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo empleados.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_EmpleadoE" value="1" name="agregar_EmpleadoE">
                    <label class="custom-control-label" for="agregar_EmpleadoE">Agregar empleados.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_empleadoE" value="1" name="modificar_empleadoE">
                    <label class="custom-control-label" for="modificar_empleadoE">Modificar datos de los empleados.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_EmpleadoE" value="1" name="eliminar_EmpleadoE">
                    <label class="custom-control-label" for="eliminar_EmpleadoE">Eliminar empleados.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de facturación electronica.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_facturacionE" value="1" name="agregar_facturacionE">
                    <label class="custom-control-label" for="agregar_facturacionE">Realizar facturación.</label>
                  </div>
                </div>

              </div>
              <hr />
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Usuarios.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_usuarioE" value="1" name="agregar_usuarioE">
                    <label class="custom-control-label" for="agregar_usuarioE">Agregar usuarios.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_usuarioE" value="1" name="modificar_usuarioE">
                    <label class="custom-control-label" for="modificar_usuarioE">Modificar datos de los usuarios.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_usuarioE" value="1" name="eliminar_usuarioE">
                    <label class="custom-control-label" for="eliminar_usuarioE">Eliminar usuarios.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de productos.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_productosE" value="1" name="agregar_productosE">
                    <label class="custom-control-label" for="agregar_productosE">Agregar productos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_productosE" value="1" name="modificar_productosE">
                    <label class="custom-control-label" for="modificar_productosE">Modificar datos de los productos.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_productosE" value="1" name="eliminar_productosE">
                    <label class="custom-control-label" for="eliminar_productosE">Eliminar productos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de proveedores.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_proveedoresE" value="1" name="agregar_proveedoresE">
                    <label class="custom-control-label" for="agregar_proveedoresE">Agregar proveedores.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_proveedoresE" value="1" name="modificar_proveedoresE">
                    <label class="custom-control-label" for="modificar_proveedoresE">Modificar datos de los proveedores.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_proveedoresE" value="1" name="eliminar_proveedoresE">
                    <label class="custom-control-label" for="eliminar_proveedoresE">Eliminar proveedores.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de sucursales.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_sucursalesE" value="1" name="agregar_sucursalesE">
                    <label class="custom-control-label" for="agregar_sucursalesE">Agregar sucursales.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="modificar_sucursalesE" value="1" name="modificar_sucursalesE">
                    <label class="custom-control-label" for="modificar_sucursalesE">Modificar datos de las sucursales.</label>
                  </div>
                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="eliminar_sucursalesE" value="1" name="eliminar_sucursalesE">
                    <label class="custom-control-label" for="eliminar_sucursalesE">Eliminar sucursales.</label>
                  </div>
                </div>

              </div>
              <hr />
              <div class="row">
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de ventas.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_ventasE" value="1" name="agregar_ventasE">
                    <label class="custom-control-label" for="agregar_ventasE">Realizar ventas.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="cancelar_ventaE" value="1" name="cancelar_ventaE">
                    <label class="custom-control-label" for="cancelar_ventaE">Cancelar la venta.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo registro de asistencia.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="registrar_asistenciaE" value="1" name="registrar_asistenciaE">
                    <label class="custom-control-label" for="registrar_asistenciaE">Registrar asistencia.</label>
                  </div>


                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo departamentos.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="agregar_departamentoE" value="1" name="agregar_departamentoE">
                    <label class="custom-control-label" for="agregar_departamentoE">Agregar departamentos.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="modificar_departamentoE" value="1" name="modificar_departamentoE">
                    <label class="custom-control-label" for="modificar_departamentoE">Modificar departamentos.</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="eliminar_departamentosE" value="1" name="eliminar_departamentosE">
                    <label class="custom-control-label" for="eliminar_departamentosE">Eliminar departamentos.</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <strong>
                    <p>Módulo de estadística.</p>
                  </strong>

                  <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input" id="estadisticaE" value="1" name="estadisticaE">
                    <label class="custom-control-label" for="estadisticaE">Estadísticas de la empresa.</label>
                  </div>

                </div>

              </div>
            </div>
          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="guardarUsuario" class="btn btn-success" onclick="obtenerNuevosDatosUsuario();">Guardar Datos</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelarUsuarioE">Cancelar</button>
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
<script src="../ajax/ajax-empleados.js"></script>
  <script src="../ajax/ajax-login.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</html>
