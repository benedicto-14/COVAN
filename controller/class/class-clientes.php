<?php
include_once '../model/conexion.php';
include_once '../model/models/model-clientes.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; Charset=UTF-8');
class cliente {
    private $modelo;
    public function __construct() {
      $this->modelo = new modeloCliente();
  }

    //Esta función manda a llamar del modelo a todos los clientes
    public function consultarClientes() {
        $res = $this->modelo->consultarClientes();
        return json_encode($res);
    }
    //Esta función manda a llamar del modelo todos los clientes que conincidan con la busqueda
    public function consultarClientesPorBusqueda($q) {
        $res = $this->modelo->consultarClientesPorBusqueda($q);
        return json_encode($res);
    }
    public function consultarCliente($id){

        $res = $this->modelo->consultarCliente($id);
        return json_encode($res);
    }
    public function eliminarCliente($id){
     $this->modelo->eliminarCliente($id);
  }

          public function agregarCliente($rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
           $this->modelo->agregarCliente($rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt);
  }
  public function actualizarCliente($id, $rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt){
   $this->modelo->actualizarCliente($id, $rfc, $nombre, $apellido, $apellido2, $telefono, $correo, $colonia, $calle, $idEstado, $idMunicipio, $idLocalidad, $codigoPostal, $numeroExt, $numeroInt);
  }

}
