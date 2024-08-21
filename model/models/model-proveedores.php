<?php
class proveedorModel  extends BD{
   public function consultarProveedores() {
        return $this->ConsultaPreparada("SELECT * FROM proveedor ORDER BY proveedor ASC", array(1));
    }
    public function consultarProveedor($id) {
        return $this->ConsultaPreparada("SELECT idProveedor,proveedor,proveedor.telefono,proveedor.rfc,proveedor.correo,"
                . "estados.idEstado,estados.estado,municipios.idMunicipio,municipios.municipio,localidades.idLocalidad,localidades."
                . "localidad,domicilio.idDomicilio,domicilio.colonia,domicilio.calle,domicilio.codigoPostal,domicilio.numeroExt,domicilio."
                . "numeroInt,empresa.empresa FROM proveedor INNER JOIN estados ON proveedor.idEstado=estados.idEstado INNER JOIN"
                . " municipios ON proveedor.idMunicipio=municipios.idMunicipio INNER JOIN localidades ON proveedor.idLocalidad=localidades.idLocalidad"
                . " INNER JOIN domicilio ON proveedor.idDomicilio= domicilio.idDomicilio INNER JOIN empresa ON proveedor.idEmpresa=empresa.idEmpresa WHERE idProveedor=?", array($id));
    }
    public function insertarProveedor($nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad,$colonia,$calle, $cp, $exterior, $interior) {
        $this->InsertarRegistrosPreparada("CALL insertarProveedor (?,?,?,?,?,?,?,?,?,?,?,?,?)", array($nombre, $telefono, $rfc, $email,
            $estado, $municipio, $localidad,$colonia,$calle, $cp, $exterior, $interior,1));
        $insertado="insertado";
        return $insertado;
    }
    public function modificarProveedor($id,$nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad, $idDomicilio,$colonia,$calle, $cp, $exterior, $interior) {
        $this->InsertarRegistrosPreparada("CALL editarProveedor (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($id,$nombre, $telefono, $rfc, $email,
            $estado, $municipio, $localidad, $idDomicilio,$colonia,$calle, $cp, $exterior, $interior,1));
            $modificado="modificado";
            return $modificado;
    }
    public function eliminarProveedor($id) {
        $this->EliminarRegistro("DELETE  FROM proveedor WHERE idProveedor=?", array($id));
        $eliminado="eliminado";
        return $eliminado;
    }
    //Terminan funciones de proveedor

    public function consultarEstados(){
         return $this->ConsultaPreparada("SELECT * FROM estados;",array(1));
    }
    public function consultarMunicipios($idEstado){
        return $this->ConsultaPreparada("SELECT * from municipios WHERE idEstado=?;", array($idEstado));
    }
     public function consultarLocalidades($idMunicipio){
        return $this->ConsultaPreparada("SELECT * from localidades WHERE idMunicipio=?;", array($idMunicipio));
    }
}
