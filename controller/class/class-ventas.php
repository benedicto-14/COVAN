<?php
header('Content-Type: application/json');
header ('Access-Control-Allow-Origin: *');
include_once '../../model/conexion.php';
include_once '../../model/models/model-ventas.php';
/**
 *
 */
class controladorVentas{
   private $modelo;

   public function __construct() {
       $this->modelo = new modeloVentas();
   }

   public function consultarProductosMasVendidos(){
      $productos = $this->modelo->consultarProductosMasVendidos();
      return json_encode($productos);
   }

   public function consultarProducto($producto){
     $producto = $this->modelo->consultarProducto($producto);
     return json_encode($producto);
   }

   public function consultarProductoById($id,$cantidad){
     $producto = $this->modelo->ConsultarProductoById($id,$cantidad);
     return json_encode($producto);
   }

   public function realizarVenta($user,$subTotal,$totalVenta,$sucursal,$productos){
     $venta = $this->modelo->insertarVenta($user,$subTotal,$totalVenta,$sucursal,$productos);
     return json_encode($venta);
   }

   public function consultarCorte($user){
     $corte = $this->modelo->consultarCorte($user);
     return json_encode($corte);
   }

}

$controlador = new controladorVentas();
if(isset($_GET["productos"])){
    echo $controlador->consultarProductosMasVendidos();
}
if(isset($_GET["producto"])){
    echo $controlador->consultarProducto($_GET["producto"]);
}
if(isset($_GET["addPro"])){
    //var_dump($_GET["producto"]);
    echo $controlador->consultarProductoById($_GET["addPro"],$_GET["cantidad"]);
}
if(isset($_POST["totalVenta"])){
    $productos = json_decode($_POST["productos"]);
    echo $controlador->realizarVenta($_POST["usuario"],$_POST["subTotalVenta"],$_POST["totalVenta"],$_POST["sucursal"],$productos);
}
if(isset($_POST["corte"])){
    echo $controlador->consultarCorte($_POST["usuario"]);
}
?>
