<?php
include_once '../model/conexion.php';
include_once '../model/models/model-facturacion.php';
class controladorFactura{


    private $modelo;
    public function __construct() {
        $this->modelo= new modeloFacturar();

        }


    public function mostrarCliente($nombre,$paterno,$materno){
    $datos=array();
    $reg=$this->modelo->consultarCliente($nombre,$paterno,$materno);

    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
     public function mostrarProductos($id){
    $datos=array();
    $reg=$this->modelo->consultarProductos($id);

    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
//
//    public function mostrarEmpleadoUnico($id){
//      $datos=array();
//    $reg=$this->modelo->consultarDatosGenerales($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//    public function mostrarEstados(){
//      $datos=array();
//    $reg=$this->modelo->consultarEstados();
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
//    public function mostrarMunicipios($id){
//    $datos=array();
//    $reg=$this->modelo->consultarMunicipios($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
//    public function mostrarLocalidades($id) {
//        $datos=array();
//    $reg=$this->modelo->consultarLocalidades($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//    public function mostrarSucursales() {
//        $datos=array();
//    $reg=$this->modelo->consultarSucursales();
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
//    public function mostrarTurnos() {
//        $datos=array();
//    $reg=$this->modelo->consultarTurnos();
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
//    public function nuevoEmpleado($nombre, $paterno, $materno, $estado,$municipio,$localidad,$colonia,$calle,$codigoPostal,$numeroExt,$numeroInt, $edad, $sexo,$curp, $rfc, $idTurno, $idSucursal, $status) {
//      $reg=$this->modelo->insertarEmpleado($nombre, $paterno, $materno, $estado,$municipio,$localidad,$colonia,$calle,$codigoPostal,$numeroExt,$numeroInt, $edad, $sexo,$curp, $rfc, $idTurno, $idSucursal,$status);
//    }
//
//    public function eliminarEmpleado($id) {
//       $usuario="";
//       $estilo="display:none";
//        $reg=$this->modelo->eliminarE($id,$estilo);
//        $reg=$this->modelo->eliminarU($id,$usuario);
//    }
//    public function eliminarDomicilio($id) {
//        $reg=$this->modelo->eliminarD($id);
//    }
//    public function eliminarAsistencia($id) {
//        $reg=$this->modelo->eliminarA($id);
//    }
//    public function consultarUltimoEmpleado() {
//        $datos=array();
//    $reg=$this->modelo->consultarUltimoId();
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
////    public function actualizarDatosEmpleado($nombre, $paterno, $materno,$curp, $rfc, $colonia,$calle,$numeroExt,$numeroInt,$estado,$municipio,$localidad,$codigoPostal,$idTurno,$sexo,$edad,$idSucursal,$idEmpleado,$idDomicilio) {
////      $reg=$this->modelo->actualizarEmpleado($idEmpleado,$nombre, $paterno, $materno, $estado,$municipio,$localidad,$idDomicilio,$colonia,$calle,$codigoPostal,$numeroExt,$numeroInt, $edad, $sexo,$curp, $rfc, $idTurno, $idSucursal);
////   }
//
//    public function actualizarDatosEmpleados($nombre,$paterno,$materno,$curp,$rfc,$turno,$sexo,$edad,$sucursal,$estado,$municipio,$localidad,$idEmpleado) {
//      $reg=$this->modelo->actualizarEmpleado($nombre,$paterno,$materno,$curp,$rfc,$turno,$sexo,$edad,$sucursal,$estado,$municipio,$localidad,$idEmpleado);
//    }
//    public function actualizarDomicilio($idDomicilio, $colonia, $calle,$numeroExt,$numeroInt,$cpostal) {
//      $reg=$this->modelo->actualizarDatosDomicilio($idDomicilio, $colonia, $calle,$numeroExt,$numeroInt,$cpostal);
//    }
//
//    public function obtenerPrivilegiosUsuario($id) {
//    $datos=array();
//    $reg=$this->modelo->consultarPrivilegios($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//
//    }
//
////    public function datosUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario, $agregarC, $modificarC, $eliminarC, $agregarCom, $modificarCom, $eliminarCom, $agregarE, $modificarE, $eliminarE, $agregarF, $agregarU, $modificarU, $eliminarU, $agregarP, $modificarP, $eliminarP, $agregarProv, $modificarProv, $eliminarProv, $agregarSu, $modificarSu, $eliminarSu, $agregarVe, $cancelarVe, $registrarA) {
////        $reg=$this->modelo->agregarNuevoUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario, $agregarC, $modificarC, $eliminarC, $agregarCom, $modificarCom, $eliminarCom, $agregarE, $modificarE, $eliminarE, $agregarF, $agregarU, $modificarU, $eliminarU, $agregarP, $modificarP, $eliminarP, $agregarProv, $modificarProv, $eliminarProv, $agregarSu, $modificarSu, $eliminarSu, $agregarVe, $cancelarVe, $registrarA);
////    }
//
//    public function datosUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario ) {
//        $reg=$this->modelo->agregarNuevoUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario);
//    }
//
//    public function actualizarStatusEmpleado($id, $status) {
//         $reg=$this->modelo->actualizarStatus($id, $status);
//    }
//
//    public function mostrarDatosUsuario($id){
//    $datos=array();
//    $reg=$this->modelo->consultarDatosUsuario($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
//
//    public function privilegios($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario ) {
//        $reg=$this->modelo->agregarPrivilegios($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario);
//    }
//    public function privilegiosE($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario ) {
//        $reg=$this->modelo->modificarPrivilegios($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario);
//    }
//    public function datosUsuarioEditar($usuario, $pass, $idEmpleadoU,$tipoUsuario ) {
//        $reg=$this->modelo->modificarUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario);
//    }
//
//    public function mostrarPrivilegiosUsuario($id){
//    $datos=array();
//    $reg=$this->modelo->consultarPrivilegiosU($id);
//
//    foreach ($reg as $r){
//        $datos[]=$r;
//    }
//    return json_encode($datos);
//    }
}
