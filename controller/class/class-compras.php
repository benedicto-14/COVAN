<?php

class controladorCompras{
    
     private $modelo;
    public function __construct() {
        $this->modelo= new modeloCompras();
        
        }
        
    public function mostrarProductos(){
    $datos=array();  
    $reg=$this->modelo->consultarProductos();
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function mostrarPrecioByProducto($id){
    $datos=array();  
    $reg=$this->modelo->consultarPrecioByProducto($id);
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function mostrarComprabyFecha($fecha){
    $datos=array();  
    $reg=$this->modelo->consultarComprabyFecha($fecha);
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function mostrarComprabyProveedor($proveedor){
    $datos=array();  
    $reg=$this->modelo->consultarComprabyProveedor($proveedor);
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function mostrarProductosbyId($id){
    $datos=array();  
    $reg=$this->modelo->consultarProductosbyId($id);
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function mostrarProveedor(){
    $datos=array();  
    $reg=$this->modelo->consultarProveedores();
    
    foreach ($reg as $r){
        $datos[]=$r;
    }
    return json_encode($datos);
    }
    public function realizarCompra($totalVenta,$proveedor, $sucursal, $productos){
 
    $reg=$this->modelo->insertarCompraProductos($totalVenta,$proveedor, $sucursal, $productos);
    
    }
    
    public function mandarStock($idProducto,$cantidad){
 
    $reg=$this->modelo->actualizarStock($idProducto,$cantidad);
    
    }
    public function mandarIdCompraP($id){
 
    $reg=$this->modelo->eliminarProductosC($id);
    
    }
    public function mandarIdGeneral($id){
 
    $reg=$this->modelo->eliminarCompraGeneral($id);
    
    }
    
}