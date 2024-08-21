<?php
class empresaModel  extends BD{

   public function registrarEmpresa($empresa,$estado,$municipio,$localidad,$colonia,$calle,$cp,$exterior,$interior,$telefono,$correo,$rfc,$sello,$contraseña,$giro){
     if($this->InsertarRegistrosPreparada("CALL insertarEmpresa (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",array($empresa,$estado,$municipio,$localidad,$colonia,$calle,$cp,$exterior,$interior,$telefono,$correo,$rfc,$usuario,$contraseña,1,$giro))){
       echo 'insertado';
     }else{
       echo 'fail';
     }
   }

public function subirImagen($imagen,$id){
  if($this->InsertarRegistrosPreparada("UPDATE empresa SET logo=(?) WHERE idEmpresa=?", array($imagen, $id))){
   echo 'subida';
 }else{
   echo 'fail';
 }
}
   public function consultarCuenta($usuario) {
        return $this->ConsultaPreparada("SELECT usuarios.idUsuario,usuarios.usuario, usuarios.contraseña, empresa.idEmpresa, empresa.empresa,empresa.logo FROM usuarios INNER JOIN empresa ON usuarios.idEmpresa=empresa.idEmpresa WHERE usuario=?", array($usuario));
    }

   public function buscarEmpresas($name){
     if($this->ConsultaPreparada("SELECT empresa FROM empresa WHERE empresa=?", array($name))){
       echo 'encontrado';
     }else{
       echo 'fail';
     }
   }

   public function buscarUsuarios($name){
     if($this->ConsultaPreparada("SELECT usuario FROM usuarios WHERE usuario=?", array($name))){
       echo 'encontrado';
     }else {
       echo 'fail';
     }
   }
   public function consultarDatos($id){
    return $this->ConsultaPreparada("CALL consultarEmpresa(?)", array($id));
   }

   public function editarEmpresa($id,$telefono,$correo,$estado,$municipio,$localidad,$idDom,$colonia,$calle,$cp,$ext,$int){
     return $this->InsertarRegistrosPreparada("CALL editarEmpresa(?,?,?,?,?,?,?,?,?,?,?,?)", array($id,$telefono,$correo,$estado,$municipio,$localidad,$idDom,$colonia,$calle,$cp,$ext,$int));
   }
  }
  ?>
