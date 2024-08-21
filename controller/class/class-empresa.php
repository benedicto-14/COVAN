<?php
include_once '../model/conexion.php';
include_once '../model/models/model-empresa.php';
class empresa{
    private $modelo;
     public function __construct() {
        $this->modelo = new empresaModel();
    }
    public function buscarEmpresas($id){
      $res=$this->modelo->buscarEmpresas($id);
      echo $res;
    }
    public function buscarUsuarios($id){
      $res = $this->modelo->buscarUsuarios($id);
      echo $res;
    }

    public function registrarEmpresa($empresa,$estado,$municipio,$localidad,$colonia,$calle,$cp,$exterior,$interior,$telefono,$correo,$rfc,$usuario,$contraseña,$giro) {
        $res = $this->modelo->registrarEmpresa($empresa,$estado,$municipio,$localidad,$colonia,$calle,$cp,$exterior,$interior,$telefono,$correo,$rfc,$usuario,$contraseña,$giro);
        echo $res;
    }
    public function subirImg($imagen,$id){
      $res = $this->modelo->subirImagen($imagen, $id);
    }

    public function consultarDatos($id){
      $res = $this->modelo->consultarDatos($id);
      $datos = json_encode($res);
      $datos.="";
      echo $datos;
    }
    public function actualizarEmpresa($id,$telefono,$correo,$estado,$municipio,$localidad,$idDom,$colonia,$calle,$cp,$ext,$int){
    $res= $this->modelo->editarEmpresa($id,$telefono,$correo,$estado,$municipio,$localidad,$idDom,$colonia,$calle,$cp,$ext,$int);
    echo $res;
  }
}
