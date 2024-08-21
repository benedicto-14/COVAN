<?php
class modeloFacturar extends BD{
    
    public function consultarCliente($nombre,$paterno,$materno) {
        return $this->ConsultaPreparada("SELECT * from clientes WHERE nombre = ? AND apellidoPaterno = ? AND apellidoMaterno = ?;",array($nombre,$paterno,$materno));
        
    }
    public function consultarProductos($id) {
        return $this->ConsultaPreparada("SELECT cantidad, producto.idMedida, producto.idCategoria, ventaproducto.subTotal, ventaproducto.iva, ventaproducto.ieps, ventas.idVenta, producto.nombre AS Nombre, ventas.subTotal As subtotalGeneral, ventas.totalVenta FROM ventaproducto INNER JOIN ventas ON ventaproducto.idVenta = ventas.idVenta INNER JOIN producto ON ventaproducto.idProducto = producto.idProducto where ventaproducto.idVenta=?;",array($id));
        
    }
    
}