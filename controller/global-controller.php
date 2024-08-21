<?php
include_once'./class/class-proveedores.php';
include_once'../model/conexion.php';
include_once'./class/class-empleados.php';
include_once'../model/models/model-empleados.php';
include_once'class/class-clientes.php';
include_once'./class/class-departamentos.php';
include_once'./class/class-empresa.php';
include_once'./class/class-login.php';
include_once'../model/models/model-clientes.php';
include_once'./class/class-EML.php';
include_once'./class/class-facturacion.php';
include_once'./class/class-compras.php';
include_once'../model/models/model-compras.php';
include_once'./class/class-productos.php';

$cEmpleado = new controladorEmpleado();
$cFactura = new controladorFactura();
$cCompras = new controladorCompras();
$proveedor= new proveedor();
$empresa = new empresa();
$estados = new estados();
$municipio = new municipios();
$localidad = new localidades();
$departamento= new departamento();
$categoria= new categoria();
$acceder= new login();



header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; Charset=UTF-8');

//Empleado-----------------------------------------------------------------------------------
//no utilizar nombre y nombreE paras sus variables POST

if (isset($_GET['mostrarEmpleado'])){
    echo $cEmpleado->mostrarDatos($_GET['mostrarEmpleado']);    
}

if (isset($_GET['idEmpleado'])){
    echo $cEmpleado->mostrarEmpleadoUnico($_GET['idEmpleado']);
}

if(isset($_GET['estadoEmpleado'])){
    echo $cEmpleado->mostrarEstados();
}

if(isset($_GET['idestadoEmpleado'])){
     echo $cEmpleado->mostrarMunicipios($_GET['idestadoEmpleado']);
}

if(isset($_GET['idmunicipioEmpleado'])){
     echo $cEmpleado->mostrarLocalidades($_GET['idmunicipioEmpleado']);
}

if(isset($_GET['sucursalEmpleado'])){
     echo $cEmpleado->mostrarSucursales();
}
if(isset($_GET['turnoEmpleado'])){
     echo $cEmpleado->mostrarTurnos();
}

if(isset($_POST['nombre'])){
    $status=0;
    $cEmpleado->nuevoEmpleado($_POST['nombre'],$_POST['paterno'],$_POST['materno'],$_POST['estado'],$_POST['municipio'],$_POST['localidad'],$_POST['colonia'],$_POST['calle'],$_POST['cpostal'],$_POST['numeroext'],$_POST['numeroint'],$_POST['edad'],$_POST['sexo'],$_POST['curp'],$_POST['rfc'],$_POST['turno'],$_POST['sucursal'], $status);
}

if(isset($_GET['eliminarEmpleado'])){
    $cEmpleado->eliminarEmpleado($_GET['eliminarEmpleado']);
}
if(isset($_GET['nombreE'])){
    $cEmpleado->mostrarMunicipioEd($_GET['nombreE']);
}
if(isset($_GET['ultimoId'])){
     echo $cEmpleado->consultarUltimoEmpleado();
}
if(isset($_POST['nombreEditar'])){
//     echo $controlador->actualizarDatosEmpleado($_POST['nombreEditar'],$_POST['paterno'],$_POST['materno'],$_POST['curp'],$_POST['rfc'],$_POST['colonia'],$_POST['calle'],$_POST['numeroExt'],$_POST['numeroInt'],$_POST['estado'],$_POST['municipio'],$_POST['localidad'],$_POST['cpostal'],$_POST['turno'],$_POST['sexo'],$_POST['edad'],$_POST['sucursal'],$_POST['idEmpleado'],$_POST['idDomicilio']);
 $cEmpleado->actualizarDatosEmpleados($_POST['nombreEditar'],$_POST['paterno'],$_POST['materno'],$_POST['curp'],$_POST['rfc'],$_POST['turno'],$_POST['sexo'],$_POST['edad'],$_POST['sucursal'],$_POST['estado'],$_POST['municipio'],$_POST['localidad'],$_POST['idEmpleado']);
 $cEmpleado->actualizarDomicilio($_POST['idDomicilio'],$_POST['colonia'],$_POST['calle'],$_POST['numeroExt'],$_POST['NumeroInt'],$_POST['cpostal']);
}
if(isset($_POST['idsucursalEmpleado']) && isset($_POST['nombreEmpleado'])){
     echo $cEmpleado->mostrarEmpleadosbyNombre($_POST['idsucursalEmpleado'],$_POST['nombreEmpleado']);
}


//if(isset($_GET['idprivilegios'])){
//    echo $cEmpleado->obtenerPrivilegiosUsuario($_GET['idprivilegios']);
//}

if(isset($_POST['idEmpleadoUsuario'])){
    $agregarC; $modificarC; $eliminarC; $agregarCom; $modificarCom; $eliminarCom; $agregarE; $modificarE; $eliminarE;
    $agregarFac; $agregarU; $modificarU; $eliminarU; $agregarP; $modificarP; $eliminarP; $agregarProv; $modificarProv;
    $eliminarProv; $agregarS; $eliminarS; $modificarS; $agregarV; $cancelarV; $registrarA; $agregarD; $modificarD; $eliminarD; $estadistica;

    $status=1;
    if(isset($_POST['estadistica'])){
         $estadistica=$_POST['estadistica'];
    }else{
        $estadistica=0;
    }

    if(isset($_POST['agregar_departamento'])){
         $agregarD=$_POST['agregar_departamento'];
    }else{
        $agregarD=0;
    }
    if(isset($_POST['modificar_departamento'])){
         $modificarD=$_POST['modificar_departamento'];
    }else{
        $modificarD=0;
    }
    if(isset($_POST['eliminar_departamentos'])){
         $eliminarD=$_POST['eliminar_departamentos'];
    }else{
        $eliminarD=0;
    }
    if(isset($_POST['agregar_Cliente'])){
         $agregarC=$_POST['agregar_Cliente'];
    }else{
        $agregarC=0;
    }
    if(isset($_POST['modificar_Cliente'])){
         $modificarC=$_POST['modificar_Cliente'];
    }else{
        $modificarC=0;
    }
    if(isset($_POST['eliminar_Cliente'])){
         $eliminarC=$_POST['eliminar_Cliente'];
    }else{
        $eliminarC=0;
    }
    if(isset($_POST['agregar_Compra'])){
         $agregarCom=$_POST['agregar_Compra'];
    }else{
        $agregarCom=0;
    }
    if(isset($_POST['modificar_Compra'])){
         $modificarCom=$_POST['modificar_Compra'];
    }else{
        $modificarCom=0;
    }
    if(isset($_POST['eliminar_Compra'])){
         $eliminarCom=$_POST['eliminar_Compra'];
    }else{
        $eliminarCom=0;
    }
    if(isset($_POST['agregar_Empleado'])){
         $agregarE=$_POST['agregar_Empleado'];
    }else{
        $agregarE=0;
    }
    if(isset($_POST['modificar_empleado'])){
         $modificarE=$_POST['modificar_empleado'];
    }else{
        $modificarE=0;
    }
    if(isset($_POST['eliminar_Empleado'])){
         $eliminarE=$_POST['eliminar_Empleado'];
    }else{
        $eliminarE=0;
    }
    if(isset($_POST['agregar_facturacion'])){
         $agregarFac=$_POST['agregar_facturacion'];
    }else{
        $agregarFac=0;
    }
    if(isset($_POST['agregar_usuario'])){
         $agregarU=$_POST['agregar_usuario'];
    }else{
        $agregarU=0;
    }
    if(isset($_POST['modificar_usuario'])){
         $modificarU=$_POST['modificar_usuario'];
    }else{
        $modificarU=0;
    }
    if(isset($_POST['eliminar_usuario'])){
         $eliminarU=$_POST['eliminar_usuario'];
    }else{
        $eliminarU=0;
    }
    if(isset($_POST['agregar_productos'])){
         $agregarP=$_POST['agregar_productos'];
    }else{
        $agregarP=0;
    }
    if(isset($_POST['modificar_productos'])){
         $modificarP=$_POST['modificar_productos'];
    }else{
        $modificarP=0;
    }
    if(isset($_POST['eliminar_productos'])){
         $eliminarP=$_POST['eliminar_productos'];
    }else{
        $eliminarP=0;
    }
    if(isset($_POST['agregar_proveedores'])){
         $agregarProv=$_POST['agregar_proveedores'];
    }else{
        $agregarProv=0;
    }
    if(isset($_POST['modificar_proveedores'])){
         $modificarProv=$_POST['modificar_proveedores'];
    }else{
        $modificarProv=0;
    }
    if(isset($_POST['eliminar_proveedores'])){
         $eliminarProv=$_POST['eliminar_proveedores'];
    }else{
        $eliminarProv=0;
    }
    if(isset($_POST['agregar_sucursales'])){
         $agregarS=$_POST['agregar_sucursales'];
    }else{
        $agregarS=0;
    }
    if(isset($_POST['modificar_sucursales'])){
         $modificarS=$_POST['modificar_sucursales'];
    }else{
        $modificarS=0;
    }
    if(isset($_POST['eliminar_sucursales'])){
         $eliminarS=$_POST['eliminar_sucursales'];
    }else{
        $eliminarS=0;
    }
    if(isset($_POST['agregar_ventas'])){
         $agregarV=$_POST['agregar_ventas'];
    }else{
        $agregarV=0;
    }
    if(isset($_POST['cancelar_venta'])){
         $cancelarV=$_POST['cancelar_venta'];
    }else{
        $cancelarV=0;
    }
    if(isset($_POST['registrar_asistencia'])){
         $registrarA=$_POST['registrar_asistencia'];
    }else{
        $registrarA=0;
    }

    $idEmpresa=1;

    $cEmpleado->datosUsuario($_POST['usuario'],$_POST['pass'],$_POST['idEmpleadoUsuario'],$_POST['tipoUsuario'],$idEmpresa);

    $cEmpleado->actualizarStatusEmpleado($_POST['idEmpleadoUsuario'], $status);

    $cEmpleado->privilegios(1,$agregarV,0,$cancelarV, 1,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1,$agregarP, $modificarP, $eliminarP,2,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1,$agregarC, $modificarC, $eliminarC,3,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1,$agregarE, $modificarE, $eliminarE,4,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $agregarProv, $modificarProv, $eliminarProv,5,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $agregarS, $modificarS, $eliminarS,6,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $agregarD, $modificarD, $eliminarD,7,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios($estadistica, 0,0,0,12,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1,$agregarCom, $modificarCom, $eliminarCom,8,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $agregarFac, 0,0,9,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $agregarU, $modificarU, $eliminarU,10,$_POST['idEmpleadoUsuario']);
    $cEmpleado->privilegios(1, $registrarA, 0, 0,11,$_POST['idEmpleadoUsuario']);
}

if(isset($_GET['idUsuarioSitema'])){
    echo $cEmpleado->mostrarDatosUsuario($_GET['idUsuarioSitema']);
}
if(isset($_GET['idPrivilegiosU'])){
    echo $cEmpleado->mostrarPrivilegiosUsuario($_GET['idPrivilegiosU']);
}

if(isset($_POST['usuarioE']) && isset($_POST['idEmpleadoUsuarioE']) && isset($_POST['passE']) && isset($_POST['tipoUsuarioE'])){
    $agregarC; $modificarC; $eliminarC; $agregarCom; $modificarCom; $eliminarCom; $agregarE; $modificarE; $eliminarE;
    $agregarFac; $agregarU; $modificarU; $eliminarU; $agregarP; $modificarP; $eliminarP; $agregarProv; $modificarProv;
    $eliminarProv; $agregarS; $eliminarS; $modificarS; $agregarV; $cancelarV; $registrarA; $agregarD; $modificarD; $eliminarD; $estadistica;

    if(isset($_POST['estadisticaE'])){
         $estadistica=$_POST['estadisticaE'];
    }else{
        $estadistica=0;
    }

    if(isset($_POST['agregar_departamentoE'])){
         $agregarD=$_POST['agregar_departamentoE'];
    }else{
        $agregarD=0;
    }
    if(isset($_POST['modificar_departamentoE'])){
         $modificarD=$_POST['modificar_departamentoE'];
    }else{
        $modificarD=0;
    }
    if(isset($_POST['eliminar_departamentosE'])){
         $eliminarD=$_POST['eliminar_departamentosE'];
    }else{
        $eliminarD=0;
    }
    if(isset($_POST['agregar_ClienteE'])){
         $agregarC=$_POST['agregar_ClienteE'];
    }else{
        $agregarC=0;
    }
    if(isset($_POST['modificar_ClienteE'])){
         $modificarC=$_POST['modificar_ClienteE'];
    }else{
        $modificarC=0;
    }
    if(isset($_POST['eliminar_ClienteE'])){
         $eliminarC=$_POST['eliminar_ClienteE'];
    }else{
        $eliminarC=0;
    }
    if(isset($_POST['agregar_CompraE'])){
         $agregarCom=$_POST['agregar_CompraE'];
    }else{
        $agregarCom=0;
    }
    if(isset($_POST['modificar_CompraE'])){
         $modificarCom=$_POST['modificar_CompraE'];
    }else{
        $modificarCom=0;
    }
    if(isset($_POST['eliminar_CompraE'])){
         $eliminarCom=$_POST['eliminar_CompraE'];
    }else{
        $eliminarCom=0;
    }
    if(isset($_POST['agregar_EmpleadoE'])){
         $agregarE=$_POST['agregar_EmpleadoE'];
    }else{
        $agregarE=0;
    }
    if(isset($_POST['modificar_empleadoE'])){
         $modificarE=$_POST['modificar_empleadoE'];
    }else{
        $modificarE=0;
    }
    if(isset($_POST['eliminar_EmpleadoE'])){
         $eliminarE=$_POST['eliminar_EmpleadoE'];
    }else{
        $eliminarE=0;
    }
    if(isset($_POST['agregar_facturacionE'])){
         $agregarFac=$_POST['agregar_facturacionE'];
    }else{
        $agregarFac=0;
    }
    if(isset($_POST['agregar_usuarioE'])){
         $agregarU=$_POST['agregar_usuarioE'];
    }else{
        $agregarU=0;
    }
    if(isset($_POST['modificar_usuarioE'])){
         $modificarU=$_POST['modificar_usuarioE'];
    }else{
        $modificarU=0;
    }
    if(isset($_POST['eliminar_usuarioE'])){
         $eliminarU=$_POST['eliminar_usuarioE'];
    }else{
        $eliminarU=0;
    }
    if(isset($_POST['agregar_productosE'])){
         $agregarP=$_POST['agregar_productosE'];
    }else{
        $agregarP=0;
    }
    if(isset($_POST['modificar_productosE'])){
         $modificarP=$_POST['modificar_productosE'];
    }else{
        $modificarP=0;
    }
    if(isset($_POST['eliminar_productosE'])){
         $eliminarP=$_POST['eliminar_productosE'];
    }else{
        $eliminarP=0;
    }
    if(isset($_POST['agregar_proveedoresE'])){
         $agregarProv=$_POST['agregar_proveedoresE'];
    }else{
        $agregarProv=0;
    }
    if(isset($_POST['modificar_proveedoresE'])){
         $modificarProv=$_POST['modificar_proveedoresE'];
    }else{
        $modificarProv=0;
    }
    if(isset($_POST['eliminar_proveedoresE'])){
         $eliminarProv=$_POST['eliminar_proveedoresE'];
    }else{
        $eliminarProv=0;
    }
    if(isset($_POST['agregar_sucursalesE'])){
         $agregarS=$_POST['agregar_sucursalesE'];
    }else{
        $agregarS=0;
    }
    if(isset($_POST['modificar_sucursalesE'])){
         $modificarS=$_POST['modificar_sucursalesE'];
    }else{
        $modificarS=0;
    }
    if(isset($_POST['eliminar_sucursalesE'])){
         $eliminarS=$_POST['eliminar_sucursalesE'];
    }else{
        $eliminarS=0;
    }
    if(isset($_POST['agregar_ventasE'])){
         $agregarV=$_POST['agregar_ventasE'];
    }else{
        $agregarV=0;
    }
    if(isset($_POST['cancelar_ventaE'])){
         $cancelarV=$_POST['cancelar_ventaE'];
    }else{
        $cancelarV=0;
    }
    if(isset($_POST['registrar_asistenciaE'])){
         $registrarA=$_POST['registrar_asistenciaE'];
    }else{
        $registrarA=0;
    }



    $cEmpleado->datosUsuarioEditar($_POST['usuarioE'],$_POST['passE'],$_POST['idEmpleadoUsuarioE'],$_POST['tipoUsuarioE']);



    $cEmpleado->privilegiosE(1,$agregarV,0,$cancelarV, 1,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1,$agregarP, $modificarP, $eliminarP,2,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1,$agregarC, $modificarC, $eliminarC,3,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1,$agregarE, $modificarE, $eliminarE,4,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $agregarProv, $modificarProv, $eliminarProv,5,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $agregarS, $modificarS, $eliminarS,6,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $agregarD, $modificarD, $eliminarD,7,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE($estadistica, 0,0,0,12,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1,$agregarCom, $modificarCom, $eliminarCom,8,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $agregarFac, 0,0,9,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $agregarU, $modificarU, $eliminarU,10,$_POST['idEmpleadoUsuarioE']);
    $cEmpleado->privilegiosE(1, $registrarA, 0, 0,11,$_POST['idEmpleadoUsuarioE']);
}
if(isset($_POST['validarNombreE']) && isset($_POST['idEmpresa'])){
//    $idEmpresa=1;
    echo $cEmpleado->validarNombreU($_POST['validarNombreE'], $_POST['idEmpresa']);
}


//Clientes--------------Inicia-------------------Clientes---------------Inicia-----------------------Clientes//



//Esta decisión permite saber que información se envia del input (busqueda)
if(isset($_POST["clientes"])){
  if($_POST["clientes"]!=""){
    $clientes = new cliente;
    echo $clientes->consultarClientesPorBusqueda($_POST["clientes"]);
  }else{
    if($_POST["clientes"]==""){
    $clientes= new cliente;
    echo $clientes->consultarClientes();
  }
  }
}

if(isset ($_POST["eliminarCliente"])){
    $id=$_POST["eliminarCliente"];
    $cliente= new cliente;
    $cliente->eliminarCliente($id);
    echo  $_POST["eliminarCliente"];

}

if(isset ($_POST["agregarCliente"])){
    $cliente= new cliente;
    $cliente->agregarCliente(
      $_POST["rfcCliente"],
      $_POST["nombreCliente"],
      $_POST["apellidoPaternoCliente"],
      $_POST["apellidoMaternoCliente"],
      $_POST["telefonoCliente"],
      $_POST["correoCliente"],
      $_POST["coloniaCliente"],
      $_POST["calleCliente"],
      $_POST["idEstadoCliente"],
      $_POST["idMunicipioCliente"],
      $_POST["idLocalidadCliente"],
      $_POST["cpCliente"],
      $_POST["numExtCliente"],
      $_POST["numIntCliente"]
    );
    echo true;
}

if(isset ($_POST["actualizarCliente"])){
    $cliente= new cliente;
    $cliente->actualizarCliente(
      $_POST["idCliente"],
      $_POST["rfcCliente"],
      $_POST["nombreCliente"],
      $_POST["apellidoPaternoCliente"],
      $_POST["apellidoMaternoCliente"],
      $_POST["telefonoCliente"],
      $_POST["correoCliente"],
      $_POST["coloniaCliente"],
      $_POST["calleCliente"],
      $_POST["idEstadoCliente"],
      $_POST["idMunicipioCliente"],
      $_POST["idLocalidadCliente"],
      $_POST["cpCliente"],
      $_POST["numExtCliente"],
      $_POST["numIntCliente"]
    );
    echo true;
}


if(isset ($_POST["consultarCliente"] ) && isset($_POST['consultarCliente']) != ""){
    $id=$_POST["consultarCliente"];
    $cliente= new cliente;
    echo $cliente->consultarCliente($id);
}

//Clientes--------------Termina-------------------Clientes---------------Termina----------------------Clientes//


//Sucursales------------Inicia-------------------Sucursales-------------Inicia----------------------Sucursales//

//Esta decisión permite saber que información se envia del input (busqueda)
if(isset($_POST["sucursales"])){
  if($_POST["sucursales"]!=""){
    $sucursales = new sucursal;
    echo $sucursales->consultarSucursalesPorBusqueda($_POST["sucursales"]);
  }else{
    if($_POST["sucursales"]==""){
    $sucursales= new sucursal;
    echo $sucursales->consultarSucursales();
  }
  }
}

if(isset ($_POST["eliminarSucursal"])){
    $id=$_POST["eliminarSucursal"];
    $sucursal= new sucursal;
    $sucursal->eliminarSucursal($id);
    echo  $_POST["eliminarSucursal"];

}

if(isset ($_POST["agregarSucursal"])){
    $sucursal= new sucursal;
    $sucursal->agregarSucursal(
      $_POST["nombreSucursal"],
      $_POST["telefonoSucursal"],
      $_POST["correoSucursal"],
      $_POST["coloniaSucursal"],
      $_POST["calleSucursal"],
      $_POST["idEstadoSucursal"],
      $_POST["idMunicipioSucursal"],
      $_POST["idLocalidadSucursal"],
      $_POST["cpSucursal"],
      $_POST["numExtSucursal"],
      $_POST["numIntSucursal"]
    );
    echo true;
}

if(isset ($_POST["actualizarSucursal"])){
    $sucursal= new sucursal;
    $sucursal->actualizarSucursal(
      $_POST["idSucursal"],
      $_POST["nombreSucursal"],
      $_POST["telefonoSucursal"],
      $_POST["correoSucursal"],
      $_POST["coloniaSucursal"],
      $_POST["calleSucursal"],
      $_POST["idEstadoSucursal"],
      $_POST["idMunicipioSucursal"],
      $_POST["idLocalidadSucursal"],
      $_POST["cpSucursal"],
      $_POST["numExtSucursal"],
      $_POST["numIntSucursal"]
    );
    echo true;
}


if(isset ($_POST["consultarSucursal"] ) && isset($_POST['consultarSucursal']) != ""){
    $id=$_POST["consultarSucursal"];
    $sucursal= new sucursal;
    echo $sucursal->consultarSucursal($id);
}

// $sucursal= new sucursal;
// $res = $sucursal->verConsulta(17);
// echo gettype ($res);

//Sucursales------------Termina-------------------Sucursales-------------Termina----------------------Sucursales//

//Facturación---------------------------------------------------------------------------------------------------------------------------->
if(isset($_POST['nombreCF'])&& isset($_POST['paternoCF']) && isset($_POST['maternoCF'])){

   echo $cFactura->mostrarCliente($_POST['nombreCF'],$_POST['paternoCF'],$_POST['maternoCF']);
}

if(isset($_POST['idByProductosF'])){
    echo $cFactura->mostrarProductos($_POST['idByProductosF']);
}


//Termina facturación---------------------------------------------------------------------------------------------------------------------------------->

//Compras---------------------------------------------------------------------------------------------------------------------------->
if(isset($_GET['productosCompras'])){

    if($_GET['productosCompras']=="general"){
         echo $cCompras->mostrarProductos();
    }


}
if(isset($_GET['fechaCompras'])){


         echo $cCompras->mostrarComprabyFecha($_GET['fechaCompras']);



}
if(isset($_GET['proveedorCompras'])){


         echo $cCompras->mostrarComprabyProveedor($_GET['proveedorCompras']);



}
if(isset($_GET['idCompras'])){

   echo $cCompras->mostrarProductosbyId($_GET['idCompras']);
}

if(isset($_GET['productoPrecioC'])){

   echo $cCompras->mostrarPrecioByProducto($_GET['productoPrecioC']);
}

if (isset($_GET["proveedorC"])){
    echo $cCompras->mostrarProveedor();
}
if (isset($_POST["totalVentaCompra"]) && isset($_POST['productosCompra']) && isset($_POST['proveedorCompra']) && isset($_POST['sucursalCompra'])){

     $productos = json_decode($_POST["productosCompra"]);
    //var_dump($productos);
    //var_dump($_POST["productos"]);
     $cCompras->realizarCompra($_POST["totalVentaCompra"], $_POST['proveedorCompra'], $_POST['sucursalCompra'],$productos);

}

if(isset($_POST['idProductoC']) && isset($_POST['cantidadPC'])){
    $cCompras->mandarStock($_POST['idProductoC'],$_POST['cantidadPC']);
}
if(isset($_POST['idCompraProductosC'])){
    $cCompras->mandarIdCompraP($_POST['idCompraProductosC']);
}
if(isset($_POST['idCompraGeneral'])){
    $cCompras->mandarIdGeneral($_POST['idCompraGeneral']);
}


//Termina Compras---------------------------------------------------------------------------------------------------------------------------------->

//*************************INICIAN LA SECCIÓN PRODUCTS***********************************************
$controlador = new controladorProducto();

if(isset($_GET["productos"])){
    echo $controlador->consultarProductos();
}
if(isset($_GET["producto"])){
    echo $controlador->filtrarProducto($_GET["producto"]);
}

if(isset($_GET["departamento"])){
  echo $controlador->consultarDepartamentos();
}

if (isset($_GET["categoria"])){
    echo $controlador->consultarCategorias($_GET["categoria"]);
}

if (isset($_GET["medida"])){
    echo $controlador->consultarMedida();
}

if (isset($_POST["addProduct"])){
     $categoria=$_POST["categoria"];
     $iva=0;
     $ipes=0;
     if ($categoria == 50111500) {
    $iva=0;
}else{
  $iva=16;
}
    $controlador->insertarProducto(
     $_POST["codigoBarras"],
     $_POST["nombre"],
     $_POST["precioVenta"],
     $_POST["precioMayoreo"],
     $_POST["descripcion"],
     $iva,
     $_POST["ieps"],
     $_POST["medida"],
     $_POST["categoria"]
            );
}



if (isset($_POST["updateProduct"])){

    $controlador->actualizarProducto(
     $_POST["updateProduct"],
     $_POST["serie"],
     $_POST["producto"],
     $_POST["preciomin"],
     $_POST["preciomax"],
     $_POST["descripcion"],
     $_POST["stock"],
     $_POST["departamento"],
     $_POST["categoria"],
     $_POST["medida"]
            );
}
//*************************TERMINA LA SECCIÓN PRODUCTS***********************************************
if(isset($_POST["proveedores"])){
    $proveedor->consultarProveedores();
}
if(isset ($_POST["idProveedor"])){
    $id=$_POST["idProveedor"];
    $proveedor->consultarProveedor($id);
}
if (isset($_POST["agregarProveedor"])){
    $proveedor->insertarProveedor(
     $_POST["nombre"],
     $_POST["telefono"],
     $_POST["rfc"],
     $_POST["email"],
     $_POST["estado"],
     $_POST["municipio"],
     $_POST["localidad"],
     $_POST["colonia"],
     $_POST["calle"],
     $_POST["cp"],
     $_POST["exterior"],
     $_POST["interior"]
            );
}
if (isset($_POST["updateProvider"])){
    $proveedor->actualizarProveedor(
     $_POST["updateProvider"],
     $_POST["nombre"],
     $_POST["telefono"],
     $_POST["rfc"],
     $_POST["email"],
     $_POST["estado"],
     $_POST["municipio"],
     $_POST["localidad"],
     $_POST["idDomicilio"],
     $_POST["colonia"],
     $_POST["calle"],
     $_POST["cp"],
     $_POST["exterior"],
     $_POST["interior"]
            );
}
if(isset($_GET["eliminarProveedor"])){
$proveedor->eliminarProveedor($_GET["eliminarProveedor"]);
}
if(isset($_GET["estado"])){
    $estados->consultarEstados();
}

if (isset($_GET["municipio"])){
    $idEstado=$_GET["municipio"];
    $municipio->consultarMunicipios($idEstado);
}

if(isset($_GET["localidad"])){
    $idMunicipio= $_GET['localidad'];
    $localidad->consultarLocalidades($idMunicipio);
}

if(isset($_POST["departamentos"])){
    $departamento->consultarDepartamentos();
}
if(isset($_POST['agregarDepartamento'])){
  $departamento->agregarDepartamento(
    $_POST['departamento'],
    $_POST['descripcion']
  );
}
if(isset($_POST['eliminarDepartamento'])){
  $departamento->eliminarDepartamento(
    $_POST['eliminarDepartamento']
  );
}
if(isset($_POST["categorias"])){
    $categoria->consultarCategorias();
}
if(isset($_POST["categoria"])){
    $categoria->consultarCategoria( $_POST["categoria"]);
}
if(isset($_POST['insertarCategoria'])){
  $categoria->agregarCategoria(
    $_POST['clave'],
    $_POST['categoria'],
    $_POST['descripcion'],
    $_POST['idDepartamento']
  );
}
if(isset($_POST['editarCategoria'])){
  $categoria->modificarCategoria(
    $_POST['clave'],
    $_POST['categoria'],
    $_POST['descripcion']
  );
}
if(isset($_POST['eliminarCategoria'])){
  $departamento->eliminarCategoria(
    $_POST['eliminarCategoria']
  );
}

if (isset($_POST["registrarEmpresa"])){
    $password = password_hash($_POST["contraseña"],PASSWORD_DEFAULT);
    $empresa->registrarEmpresa(
     $_POST["razonSocial"],
     $_POST["estado"],
     $_POST["municipio"],
     $_POST["localidad"],
     $_POST["colonia"],
     $_POST["calle"],
     $_POST["cp"],
     $_POST["exterior"],
     $_POST["interior"],
     $_POST["telefono"],
     $_POST["email"],
     $_POST["rfc"],
     $_POST["usuario"],
     $password,
     $_POST["giro"]
            );
}
if(isset($_POST['acceder'])){
$acceder->validarCuenta(
  $_POST['usuario'],
  $_POST['contraseña']
);
}

if(isset($_GET['cerrar'])){
  session_start();
	session_destroy();
  echo 'destroy';
}
if(isset($_POST['buscarEmpresas'])){
  $nombre=$_POST['name'];
  $empresa->buscarEmpresas($nombre);
}
if(isset($_POST['buscarUsuarios'])){
  $nombre=$_POST['user'];
  $empresa->buscarUsuarios($nombre);
}

if(isset($_FILES['file-upload'])){
  $id=$_POST['img'];
  define('LIMITE', 5000000);
  define('ARREGLO', serialize(array('image/jpg', 'image/jpeg', 'image/gif', 'image/png')));
   $PERMITIDOS = unserialize(ARREGLO); //Usar unserialize para obtener el arreglo
   if ($_FILES["file-upload"]["error"] > 0) {
               echo'error de archivo';
           }else {
                if (in_array($_FILES['file-upload']['type'], $PERMITIDOS) && $_FILES['file-upload']['size'] <= LIMITE * 1024) {
                    $rutaEnServidor = "C:/xampp/htdocs/COVAN/controller/" . $_FILES['file-upload']['name'];
                    $ruta = "http://localhost:8081/Covan/controller/" . $_FILES['file-upload']['name'];
                    if (!file_exists($ruta)) {
                        $resultado = move_uploaded_file($_FILES['file-upload']['tmp_name'], $rutaEnServidor);
                        if ($resultado) {
                        $empresa->subirImg($ruta,$id);
                        }
                    }
                }
            }
 }

 if(isset($_POST['datosEmpresa'])){
   $empresa->consultarDatos($_POST['datosEmpresa']);
 }
 if (isset($_POST["editarEmpresa"])){
     $empresa->actualizarEmpresa(
      $_POST["editarEmpresa"],
      $_POST["telefono"],
      $_POST["email"],
      $_POST["estado"],
      $_POST["municipio"],
      $_POST["localidad"],
      $_POST["idDomicilio"],
      $_POST["colonia"],
      $_POST["calle"],
      $_POST["cp"],
      $_POST["exterior"],
      $_POST["interior"]
             );
 }


 ?>
