<?php
/**
 *
 */
class modeloVentas extends BD{

  public function consultarProductosMasVendidos() {
      return $this->ConsultaPreparada("SELECT producto.idProducto,producto.nombre,producto.descripcion,producto.precioMenudeo,producto.stock,COUNT(ventaproducto.idProducto) AS total FROM ventaproducto
                    INNER JOIN producto ON ventaproducto.idProducto=producto.idProducto
                    GROUP BY producto.nombre
                    ORDER BY total DESC LIMIT 6", array(1));
  }

  public function consultarProducto($p){
      return $this->ConsultaPreparada("SELECT * FROM producto
                    WHERE nombre LIKE ? OR descripcion LIKE ? OR codigoBarras LIKE ? LIMIT 6", array("%$p%","%$p%","%$p%"));
  }

  public function consultarProductoById($id,$cantidad){
      $stock = $this->ConsultaPreparada("SELECT stock FROM producto WHERE idProducto=?", array($id));
      if($cantidad<=$stock[0]["stock"]){
        return $this->ConsultaPreparada("SELECT * FROM producto WHERE idProducto=?", array($id));
      }else {
        return FALSE;
      }
  }

  public function insertarVenta($user,$subTotal,$totalVenta,$sucursal,$productos){
      $this->open();
      try {
          $this->conn->beginTransaction();
          $this->InsertarRegistrosPreparada("INSERT INTO ventas(idUsuario,fecha,hora,subTotal,totalVenta,idFormaPago,idMetodoPago,idSucursal) VALUES(?,CURDATE(),CURTIME(),?,?,?,?,?)",
                                          array($user,$subTotal,$totalVenta,"01","PUE",$sucursal));
          $venta = $this->ConsultaPreparada("SELECT MAX(idVenta) AS venta FROM ventas", array(1));
          foreach ($productos as $producto) {
              $subTotalPro = $producto->subTotal - $producto->totalIeps;
              $this->InsertarRegistrosPreparada("INSERT INTO ventaproducto(idProducto,cantidad,subTotal,iva,ieps,idVenta) VALUES(?,?,?,?,?,?)",
                                            array($producto->producto,$producto->cantidad,$subTotalPro,$producto->totalIva,$producto->totalIeps,$venta[0]["venta"]));
              $this->ModificarRegistrosPreparada("UPDATE producto SET stock=stock - ? WHERE idProducto=?", array($producto->cantidad,$producto->producto));
          }
          $this->conn->commit();
          return $venta[0]["venta"];
      } catch (Exception $e){
          echo 'Algo fallo: ',  $e->getMessage();
          return $this->conn->rollBack();
     }
  }

  public function consultarCorte($user) {
        return $this->ConsultaPreparada("SELECT departamento.departamento, SUM(ventaproducto.subTotal+ventaproducto.ieps+ventaproducto.iva) AS total FROM  ventas
                      INNER JOIN ventaproducto ON ventas.idVenta=ventaproducto.idVenta
                      INNER JOIN producto ON ventaproducto.idProducto=producto.idProducto
                      INNER JOIN categorias ON producto.idCategoria=categorias.idCategoria
                      INNER JOIN departamento ON categorias.idDepartamento=departamento.idDepartamento
                      WHERE ventas.idUsuario=? AND ventas.fecha=CURDATE()
                      GROUP BY departamento.departamento",
                      array($user));
  }
}

?>
