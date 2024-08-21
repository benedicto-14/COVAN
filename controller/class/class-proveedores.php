<?php
include_once '../model/conexion.php';
include_once '../model/models/model-proveedores.php';

class proveedor {
    private $modelo;
     public function __construct() {
        $this->modelo = new proveedorModel();
    }
    public function consultarproveedores() {
        $res = $this->modelo->consultarProveedores();
        $proveedores = json_encode($res);
        $proveedores.=' ';
        echo $proveedores;
    }
    public function consultarProveedor($id){
        $res = $this->modelo->consultarProveedor($id);
        $proveedor = json_encode($res);
        $proveedor.='';
        echo $proveedor;
    }
    public function insertarProveedor($nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$colonia,$calle, $cp, $exterior, $interior) {
        $res = $this->modelo->insertarProveedor($nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$colonia,$calle, $cp, $exterior, $interior);
        echo $res;
    }
    public function actualizarProveedor( $id, $nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$idDomicilio,$colonia,$calle, $cp, $exterior, $interior) {
        $res = $this->modelo->modificarProveedor($id,$nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$idDomicilio,$colonia,$calle, $cp, $exterior, $interior);
        echo $res;
    }
    public function eliminarProveedor($id){
        $res= $this->modelo->eliminarProveedor($id);
        echo $res;
    }
}
