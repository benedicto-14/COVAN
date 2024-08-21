<?php
/**
 * Description of 
 *
 */
class modeloEmpleado extends BD{
    
   public function consultarEmpleado($idS) {
       
        return $this->ConsultaPreparada("SELECT idEmpleado, estiloEliminar,empleado,apellidoPaterno,apellidoMaterno,estados.idEstado,municipios.idMunicipio,localidades.idLocalidad,estados.estado,municipios.municipio,localidades.localidad,domicilio.colonia,
domicilio.calle,domicilio.codigoPostal,domicilio.numeroExt,domicilio.numeroInt,sexos.sexo,edad,curp,rfc,sucursal.sucursal,turno.turno, empleados.idDomicilio  FROM empleados INNER JOIN estados ON empleados.idEstado=estados.idEstado INNER JOIN municipios ON empleados.idMunicipio=municipios.idMunicipio INNER JOIN localidades ON empleados.idLocalidad=localidades.idLocalidad INNER JOIN domicilio ON empleados.idDomicilio=domicilio.idDomicilio INNER JOIN sexos ON empleados.idSexo=sexos.idSexo INNER JOIN sucursal ON empleados.idSucursal=sucursal.idSucursal INNER JOIN turno ON empleados.idTurno=turno.idTurno WHERE empleados.idSucursal=? ORDER BY idEmpleado;", array($idS));
    }
    
    public function consultarDatosGenerales($id){
        return $this->ConsultaPreparada("SELECT idEmpleado,DATE_FORMAT(fechaDeAlta, '%d-%m-%Y') AS fecha, statusUsuario ,empleados.idSexo AS sex,estiloEliminar,empleado,apellidoPaterno,apellidoMaterno,estados.idEstado,municipios.idMunicipio,localidades.idLocalidad,turno.idTurno,sucursal.idSucursal,estados.estado,municipios.municipio,localidades.localidad,estados.estado,municipios.municipio,localidades.localidad,domicilio.colonia,
domicilio.calle,domicilio.codigoPostal,domicilio.numeroExt,domicilio.numeroInt,sexos.sexo,edad,curp,rfc,sucursal.sucursal,turno.turno, empleados.idDomicilio FROM empleados INNER JOIN estados ON empleados.idEstado=estados.idEstado INNER JOIN municipios ON empleados.idMunicipio=municipios.idMunicipio INNER JOIN localidades ON empleados.idLocalidad=localidades.idLocalidad INNER JOIN domicilio ON empleados.idDomicilio=domicilio.idDomicilio INNER JOIN sexos ON empleados.idSexo=sexos.idSexo INNER JOIN sucursal ON empleados.idSucursal=sucursal.idSucursal INNER JOIN turno ON empleados.idTurno=turno.idTurno WHERE idEmpleado=?;", array($id));
    }
    
    public function insertarEmpleado($nombre, $paterno, $materno, $estado,$municipio,$localidad,$colonia,$calle,$codigoPostal,$numeroExt,$numeroInt, $edad, $sexo,$curp, $rfc, $idTurno, $idSucursal, $status ) {
    $year=date("Y");
   $mes=date("m");
   $dia=date("d");
   $fecha= $year."-".$mes."-".$dia;
        $this->InsertarRegistrosPreparada("CALL insertarEmpleado(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($nombre, $paterno, $materno, $estado,$municipio,$localidad,$colonia,$calle,$codigoPostal,$numeroExt,$numeroInt, $edad, $sexo,$curp, $rfc, $idTurno, $idSucursal, $status, $fecha));
    }
    public function insertarDireccion($colonia, $calle, $codigoP, $numeroExt, $numeroInt){
        
    }
    public function consultarDatos($tabla){
         return $this->ConsultaPreparada("SELECT * from" + $tabla +";",array(1));
    }


    public function consultarEstados(){
        return $this->ConsultaPreparada("SELECT * from estados;",array(1));
    }
    public function consultarSucursales(){
        return $this->ConsultaPreparada("SELECT * from sucursal;",array(1));
    }
    public function consultarTurnos(){
        return $this->ConsultaPreparada("SELECT * from turno;",array(1));
    }
    public function consultarMunicipios($estado){
        return $this->ConsultaPreparada("SELECT * from municipios WHERE idEstado=?;",array($estado));
    }
    public function consultarLocalidades($municipio){
        return $this->ConsultaPreparada("SELECT * from localidades WHERE idMunicipio=?;",array($municipio));
    }
    public function actualizarDatosDomicilio($idDomicilio, $colonia, $calle,$numeroExt,$numeroInt,$cpostal) {
        $this->ModificarRegistrosPreparada("UPDATE domicilio SET colonia=?, calle=?, numeroExt=?, numeroInt=?, codigoPostal=?  WHERE idDomicilio=?", array($colonia, $calle,$numeroExt,$numeroInt,$cpostal,$idDomicilio));
    }
    public function actualizarEmpleado($nombre,$paterno,$materno,$curp,$rfc,$turno,$sexo,$edad,$sucursal,$estado,$municipio,$localidad,$idEmpleado) {
        $this->ModificarRegistrosPreparada("UPDATE empleados SET empleado=?, apellidoPaterno=?, apellidoMaterno=?, curp=?, rfc=?, idTurno=?, idSexo=?, edad=?, idSucursal=?, idEstado=?, idMunicipio=?, idLocalidad=? WHERE idEmpleado=?", array($nombre,$paterno,$materno,$curp,$rfc,$turno,$sexo,$edad,$sucursal,$estado,$municipio,$localidad,$idEmpleado));
    }
//    public function eliminarE($id,$estilo) {
//        return $this->EliminarRegistro("DELETE  FROM empleados WHERE idEmpleado=?", array($id));
//    }
    public function eliminarE($id,$estilo) {
        return $this->ModificarRegistrosPreparada("UPDATE  empleados SET estiloEliminar=? WHERE idEmpleado=?", array($estilo,$id));
    }
    public function eliminarU($id,$usuario) {
        return $this->ModificarRegistrosPreparada("UPDATE  usuarios SET usuario=? WHERE idEmpleado=?", array($usuario,$id));
    }
    
    public function eliminarD($id) {
        return $this->EliminarRegistro("DELETE  FROM domicilio WHERE idDomicilio=?", array($id));
    }
    public function eliminarA($id) {
        return $this->EliminarRegistro("DELETE  FROM registroasistencia WHERE idEmpleado=?", array($id));
    }
    
    public function consultarUltimoId() {
        return $this->ConsultaPreparada("SELECT idDomicilio from domicilio ORDER BY idDomicilio DESC LIMIT 1",array(1));
    }
    public function consultarPrivilegios($id) {
        return $this->ConsultaPreparada("SELECT * FROM tipousuario WHERE idTipoUsuario=?",array($id));
    }    
    public function agregarNuevoUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario,$idEmpresa) {
        $this->InsertarRegistrosPreparada("INSERT INTO usuarios (usuario,pass,idTipoUsuario,idEmpleado,idEmpresa) VALUES (?,?,?,?,?)", array($usuario, $pass,$tipoUsuario,$idEmpleadoU,$idEmpresa));
    }
    
    public function actualizarStatus($id, $status) {
        return $this->ModificarRegistrosPreparada("UPDATE empleados SET statusUsuario=? WHERE idEmpleado=?", array($status,$id));
    }
    
    public function consultarDatosUsuario($id) {
        return $this->ConsultaPreparada("SELECT *, tipoUsuario, tipousuario.idTipoUsuario AS idTipo FROM usuarios INNER JOIN tipousuario ON usuarios.idTipoUsuario=tipousuario.idTipoUsuario WHERE idEmpleado=?",array($id));
    }
    
    public function agregarPrivilegios($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario) {
        $this->InsertarRegistrosPreparada("INSERT INTO privilegios (idEmpleado,seleccionar,insertar,actualizar,eliminar,idModulo) VALUES (?,?,?,?,?,?)", array($idUsuario,$consultar,$insertar,$modificar,$eliminar,$idModulo));
    }
    public function consultarPrivilegiosU($id) {
        return $this->ConsultaPreparada("SELECT * FROM privilegios WHERE idEmpleado=?",array($id));
    }
    public function modificarUsuario($usuario, $pass, $idEmpleadoU,$tipoUsuario) {
        $this->ModificarRegistrosPreparada("UPDATE usuarios SET usuario =? ,pass =? ,idTipoUsuario =? WHERE idEmpleado=? ", array($usuario, $pass,$tipoUsuario ,$idEmpleadoU));
    }
    public function modificarPrivilegios($consultar, $insertar, $modificar, $eliminar,$idModulo, $idUsuario) {
        $this->ModificarRegistrosPreparada("UPDATE privilegios SET seleccionar =? ,insertar =? ,actualizar =?,eliminar =? WHERE idEmpleado=? AND idModulo =?", array($consultar, $insertar, $modificar, $eliminar,$idUsuario,$idModulo));
    }
    
    public function consultarNombreUsuario($nombre,$idEmpresa) {
        return $this->ConsultaPreparada("SELECT usuario FROM usuarios WHERE usuario=? AND idEmpresa=?",array($nombre,$idEmpresa ));
    }
     public function consultarEmpleadobyNombre($idS,$nombre) {
       
        return $this->ConsultaPreparada("SELECT idEmpleado, estiloEliminar,empleado,apellidoPaterno,apellidoMaterno,estados.idEstado,municipios.idMunicipio,localidades.idLocalidad,estados.estado,municipios.municipio,localidades.localidad,domicilio.colonia,
domicilio.calle,domicilio.codigoPostal,domicilio.numeroExt,domicilio.numeroInt,sexos.sexo,edad,curp,rfc,sucursal.sucursal,turno.turno, empleados.idDomicilio  FROM empleados INNER JOIN estados ON empleados.idEstado=estados.idEstado INNER JOIN municipios ON empleados.idMunicipio=municipios.idMunicipio INNER JOIN localidades ON empleados.idLocalidad=localidades.idLocalidad INNER JOIN domicilio ON empleados.idDomicilio=domicilio.idDomicilio INNER JOIN sexos ON empleados.idSexo=sexos.idSexo INNER JOIN sucursal ON empleados.idSucursal=sucursal.idSucursal INNER JOIN turno ON empleados.idTurno=turno.idTurno WHERE empleados.idSucursal=? AND empleado LIKE ? OR apellidoPaterno LIKE ? OR apellidoMaterno LIKE ?;", array($idS, "%$nombre%", "%$nombre%", "%$nombre%"));
    }
    
    
    
    
   
}