<?php

class modeloReportes extends BD {
      public function consultarVentas($sucursal,$fecha1,$fecha2){
          return  $this->ConsultaPreparada(
            "SELECT idVenta,usuarios.usuario,fecha,hora,totalVenta,sucursal.sucursal FROM ventas
            INNER JOIN usuarios ON ventas.idUsuario=usuarios.idUsuario
            INNER JOIN sucursal ON ventas.idSucursal=sucursal.idSucursal WHERE ventas.idSucursal = ? AND fecha BETWEEN ? AND ?",
            array($sucursal,$fecha1,$fecha2)
         );
      }

      public function consultarVentasDescripcion($venta){
          return  $this->ConsultaPreparada(
            "SELECT cantidad,producto.nombre,producto.descripcion,medida.medida,producto.precioMenudeo,subTotal+ventaproducto.iva+ventaproducto.ieps as subTotal
             FROM ventaproducto
             INNER JOIN producto ON ventaproducto.idProducto=producto.idProducto
             INNER JOIN medida ON producto.idMedida=medida.idMedida WHERE idVenta=?",
             array($venta)
          );
      }

      public function consultarCompras($sucursal,$fecha1,$fecha2){
          return $this->consultaPreparada("SELECT idCompraProveedor,proveedor.proveedor,fecha,hora,totalCompra FROM compraproveedor
            INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor
            INNER JOIN sucursal ON compraproveedor.idSucursal=sucursal.idSucursal WHERE compraproveedor.idSucursal = ? AND fecha BETWEEN ? AND ?",
            array($sucursal,$fecha1,$fecha2)
          );
      }

      public function consultarComprasDescripcion($compra){
          return $this->consultaPreparada("SELECT producto.nombre,producto.descripcion,cantidad,costo,subTotal FROM compraproductos
            INNER JOIN producto ON compraproductos.idProducto=producto.idProducto WHERE idCompraProveedor=?",
            array($compra)
          );
      }

      public function consultarDatosEmpresa($sucursal){
          return $this->ConsultaPreparada(
             "SELECT empresa.empresa,sucursal,estados.estado,municipios.municipio,localidades.localidad,domicilio.calle,domicilio.numeroExt,domicilio.codigoPostal,sucursal.telefono
              FROM sucursal
              INNER JOIN empresa ON sucursal.idEmpresa=empresa.idEmpresa
              INNER JOIN estados ON sucursal.idEstado=estados.idEstado
              INNER JOIN municipios ON sucursal.idMunicipio=municipios.idMunicipio
              INNER JOIN localidades ON sucursal.idLocalidad=localidades.idLocalidad
              INNER JOIN domicilio ON sucursal.idDomicilio=domicilio.idDomicilio WHERE idSucursal=?",
             array($sucursal)
          );

      }
  }
?>
