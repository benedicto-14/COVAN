<?php
include_once '../model/conexion.php';
include_once '../model/models/model-productos.php';

class controladorProducto{
    private $modelo;

  public function __construct() {
        $this->modelo = new modeloProducto();
  }

  public function consultarProductos(){
    $producto = $this->modelo->consultarProductos();
    return json_encode($producto);
  }

  public function filtrarProducto($producto){
  $producto = $this->modelo->filtrarProducto($producto);
  return json_encode($producto);
}

  public function actualizarProducto( $id, $nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$idDomicilio,$colonia,$calle, $cp, $exterior, $interior) {
        $res = $this->modelo->modificarProveedor($id,$nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$idDomicilio,$colonia,$calle, $cp, $exterior, $interior);
    }


  public function consultarDepartamentos() {
        $departamento=$this->modelo->consultarDepartamentos();
        return json_encode($departamento);
        }

            public function consultarCategorias($idDepartamento) {
                $categoria=$this->modelo->consultarCategorias($idDepartamento);
                return json_encode($categoria);
            }

            public function consultarMedida() {
                $medida=$this->modelo->consultarmedida();
                return json_encode($medida);
            }

            public function insertarProducto($codigoBarras,$nombre,$precioVenta,$precioMayoreo,$descripcion,$iva,$ieps,$medida,$categoria) {
                $producto= $this->modelo->insertarProducto($codigoBarras,$nombre,$precioVenta,$precioMayoreo,$descripcion,$iva,$ieps,$medida,$categoria);
            }



}
?>
