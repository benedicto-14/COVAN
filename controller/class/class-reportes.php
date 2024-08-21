<?php
  header('Content-Type: application/json');
  header ('Access-Control-Allow-Origin: *');
  include_once '../../model/conexion.php';
  include_once '../../model/models/model-reportes.php';

  /**
   *
   */
  class controladorReportes{
    private $modelo;

    public function __construct() {
        $this->modelo = new modeloReportes();
    }

    public function consultarDatosEmpresa($sucursal){
      $empresa = $this->modelo->consultarDatosEmpresa($sucursal);
      return json_encode($empresa);
    }

    public function consultarVentas($sucursal,$fecha1,$fecha2){
      $ventas = $this->modelo->consultarVentas($sucursal,$fecha1,$fecha2);
      return json_encode($ventas);
    }

    public function consultarVenta($vent){
      $venta = $this->modelo->consultarVentasDescripcion($vent);
      return json_encode($venta);
    }

    public function consultarCompras($sucursal,$fecha1,$fecha2){
      $compras = $this->modelo->consultarCompras($sucursal,$fecha1,$fecha2);
      return json_encode($compras);
    }

    public function consultarCompra($compr){
      $compra = $this->modelo->consultarComprasDescripcion($compr);
      return json_encode($compra);
    }
  }

  $controlador = new controladorReportes();
  if(isset($_GET["sucursal"])){
    //var_dump($controlador->consultarDatosEmpresa());
     echo $controlador->consultarDatosEmpresa($_GET["sucursal"]);
  }

  if(isset($_GET["ventas"])){
    //var_dump($controlador->consultarDatosEmpresa());
     echo $controlador->consultarVentas(1,$_GET["fecha1"],$_GET["fecha2"]);
  }

  if(isset($_GET["venta"])){
     echo $controlador->consultarVenta($_GET["venta"]);
  }

  if(isset($_GET["compras"])){
    echo $controlador->consultarCompras(1,$_GET["fecha1"],$_GET["fecha2"]);
  }

  if(isset($_GET["compra"])){
    echo $controlador->consultarCompra($_GET["compra"]);
  }

?>
