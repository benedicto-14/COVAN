<?php
include_once '../model/conexion.php';
include_once '../model/models/model-sucursales.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; Charset=UTF-8');
class sucursal {
    private $modelo;
    public function __construct() {
      $this->modelo = new modeloSucursal();
  }

    //Esta función manda a llamar del modelo a todos las Sucursales
    public function consultarSucursales() {
        $res = $this->modelo->consultarSucursales();
        return json_encode($res);
    }
    //Esta función manda a llamar del modelo todos las Sucursales que conincidan con la busqueda
    public function consultarSucursalesPorBusqueda($q) {
        $res = $this->modelo->consultarSucursalesPorBusqueda($q);
        return json_encode($res);
    }
    public function consultarSucursal($id){
        $res = $this->modelo->consultarSucursal($id);
        return json_encode($res);
    }
    public function eliminarSucursal($id){
     $this->modelo->eliminarSucursal($id);
  }
  // public function verConsulta($id){
  //   $res =$this->modelo->verConsulta($id);
  //   return $res;
  // }

          public function agregarSucursal( $nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
           $this->modelo->agregarSucursal( $nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt);
  }
  public function actualizarSucursal($id,  $nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
   $this->modelo->actualizarSucursal($id,  $nombre, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt);
   }
}
