<?php

class estadisticasModel extends BD{
    
    public function __construct() {
            
    }
        
    public function fechasEstadisticas() {
        return $this->ConsultaPreparada("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(fecha, ' ', 1), ' ', -1) AS fecha FROM estadisticas ORDER BY fecha DESC LIMIT 5", array(1));
    }

    public function fechasVentas() {
        return $this->ConsultaPreparada("SELECT MIN(fecha) as inicio, MAX(fecha) as fin FROM ventas", array(1));
    }

    public function fechasCompras(){
        return $this->ConsultaPreparada("SELECT MIN(fecha) as inicio, MAX(fecha) as fin FROM compraproveedor", array(1));
    }
    
    public function consultarEstadisticasByDate($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT inversion,ganancia,SUBSTRING_INDEX(SUBSTRING_INDEX(fecha, ' ', 1), ' ', -1) AS fecha FROM estadisticas WHERE fecha BETWEEN ? AND ?", array($fechaInicio,$fechaFin));
    }

    public function fechasLogs(){        
        return $this->ConsultaPreparada("SELECT idLog,idSucursal,fecha FROM `logs` GROUP BY fecha DESC;", array(1));
    }

    public function consultarMasComprados($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT proveedor.proveedor,producto.nombre, COUNT( compraproductos.idProducto ) AS total FROM  compraproductos 
        INNER JOIN producto ON compraproductos.idProducto=producto.idProducto INNER JOIN compraproveedor ON compraproductos.idCompraProveedor=compraproveedor.idCompraProveedor
        INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor
        WHERE compraproveedor.fecha BETWEEN ? and ?
        GROUP BY  producto.nombre
        ORDER BY total DESC LIMIT 2", array($fechaInicio,$fechaFin));
    }

    public function consultarMenosComprados($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT proveedor.proveedor,producto.nombre,compraproveedor.fecha, COUNT( compraproductos.idProducto ) AS total FROM  compraproductos 
        INNER JOIN producto ON compraproductos.idProducto=producto.idProducto INNER JOIN compraproveedor ON compraproductos.idCompraProveedor=compraproveedor.idCompraProveedor
        INNER JOIN proveedor ON compraproveedor.idProveedor=proveedor.idProveedor
        WHERE fecha BETWEEN ? AND ?
        GROUP BY  producto.nombre
        ORDER BY total,fecha ASC LIMIT 2", array($fechaInicio,$fechaFin));
    }

    public function consultarVentasByDate($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT usuarios.usuario, COUNT(ventas.idUsuario) as ventas FROM ventas 
        INNER JOIN usuarios on ventas.idUsuario = usuarios.idUsuario
        WHERE fecha BETWEEN ? AND ?
        GROUP BY ventas.idUsuario", array($fechaInicio,$fechaFin));
    }

    public function consultarMasVendido($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT producto.nombre, COUNT(ventaproducto.idProducto) AS total FROM ventaproducto 
        INNER JOIN producto ON ventaproducto.idProducto=producto.idProducto INNER JOIN ventas ON ventaproducto.idVenta=ventas.idVenta
        WHERE fecha BETWEEN ? AND ?
        GROUP BY producto.nombre
        ORDER BY total DESC LIMIT 2", array($fechaInicio,$fechaFin));
    }

    public function consultarMenosVendido($fechaInicio,$fechaFin) {
        return $this->ConsultaPreparada("SELECT producto.nombre, COUNT(ventaproducto.idProducto) AS total FROM ventaproducto 
        INNER JOIN producto ON ventaproducto.idProducto=producto.idProducto 
        INNER JOIN ventas ON ventaproducto.idVenta=ventas.idVenta
        WHERE fecha BETWEEN ? AND ?
        GROUP BY producto.nombre
        ORDER BY total,fecha ASC LIMIT 2", array($fechaInicio,$fechaFin));
    }    

    public function consultarTipo(){
        return $this->ConsultaPreparada("SELECT * FROM personalizar", array(1));
    }

    public function modificarInfo($tipo1,$tipo2,$tipo3,$tipo4){
        $this->ModificarRegistrosPreparada("UPDATE personalizar SET tipo = ? WHERE personalizar.idPersonalizar = 1;
        UPDATE personalizar SET tipo = ? WHERE personalizar.idPersonalizar = 2;
        UPDATE personalizar SET tipo = ? WHERE personalizar.idPersonalizar = 3;
        UPDATE personalizar SET tipo = ? WHERE personalizar.idPersonalizar = 4;", array($tipo1,$tipo2,$tipo3,$tipo4));
    }

    public function insertarLog($fecha){
        $this->InsertarRegistrosPreparada("INSERT INTO logs (idSucursal,fecha) VALUES(1,?);", array($fecha));
    }

    public function eliminarLog($id){
        $this->EliminarRegistro("DELETE FROM logs WHERE logs.idLog = ?", array($id));
    }

}