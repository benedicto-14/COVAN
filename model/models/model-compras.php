<?php
class modeloCompras extends BD{
    
    public function consultarProductos(){
        return $this->ConsultaPreparada("SELECT idCompraProveedor,DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, hora, totalCompra, proveedor.proveedor FROM compraproveedor INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor ORDER BY idCompraProveedor DESC LIMIT 10",array(1));
   }
   
   public function consultarProductosbyId($id){
        return $this->ConsultaPreparada("SELECT idCompraProducto, compraproductos.idProducto, cantidad, costo, 	subTotal, compraproductos.idCompraProveedor, producto.nombre, 
compraproveedor.fecha, compraproveedor.hora, compraproveedor.totalCompra, proveedor.proveedor  FROM compraproductos
	INNER JOIN producto ON compraproductos.idProducto=producto.idProducto
	INNER JOIN compraproveedor ON compraproductos.idCompraProveedor=compraproveedor.idCompraProveedor
	INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor WHERE compraproductos.idCompraProveedor=?",array($id));
   }
   
   public function consultarProveedores(){
       $id=1;
        return $this->ConsultaPreparada("SELECT * from proveedor WHERE idEmpresa = ?",array($id));
   }
   
   public function consultarComprabyFecha($fecha){
      
       return $this->ConsultaPreparada("SELECT idCompraProveedor,DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, hora, totalCompra, proveedor.proveedor FROM compraproveedor INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor WHERE fecha = ? ORDER BY idCompraProveedor DESC LIMIT 10",array($fecha));
       
   }
   public function consultarComprabyProveedor($proveedor){
      
       return $this->ConsultaPreparada("SELECT idCompraProveedor,DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, hora, totalCompra, proveedor.proveedor FROM compraproveedor INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor  WHERE proveedor LIKE ? ORDER BY idCompraProveedor DESC LIMIT 10",array("%$proveedor%"));
       
   }
   
    
     public function insertarCompraProductos($totalVenta,$proveedor, $sucursal, $productos){
      $this->open();
      try {
          $this->conn->beginTransaction();
          $this->InsertarRegistrosPreparada("INSERT INTO compraproveedor (idProveedor, idSucursal, fecha, hora, totalCompra) VALUES(?,?,CURDATE(),CURTIME(),?)",
                                          array($proveedor,$sucursal,$totalVenta));
          $idcompra = $this->ConsultaPreparada("SELECT MAX(idCompraProveedor) AS idcompra FROM compraproveedor", array(1));
          foreach ($productos as $producto) {
              
              $this->InsertarRegistrosPreparada("INSERT INTO compraproductos (idProducto,cantidad,costo,subTotal,idCompraProveedor) VALUES(?,?,?,?,?)",
                                            array($producto->producto,$producto->cantidad,$producto->precio,$producto->total,$idcompra[0]["idcompra"]));
              
              $this->ModificarRegistrosPreparada("UPDATE producto SET stock=stock + ? WHERE idProducto=?", array($producto->cantidad,$producto->producto));
          }
          return $this->conn->commit();
      } catch (Exception $e){
          echo 'Algo fallo: ',  $e->getMessage();
          return $this->conn->rollBack();
     }
  }
  
  public function actualizarStock($idProducto,$cantidad){
      $this->ModificarRegistrosPreparada("UPDATE producto SET stock = stock - ? WHERE idProducto=?", array($cantidad,$idProducto));
  }
  
  public function eliminarProductosC($id){
      $this->EliminarRegistro("DELETE FROM compraproductos WHERE idCompraProveedor = ?", array($id));
  }
  public function eliminarCompraGeneral($id){
      $this->EliminarRegistro("DELETE FROM compraproveedor WHERE idCompraProveedor = ?", array($id));
  }
   
   
    
    
}