<?php
include_once '../model/conexion.php';
include_once '../model/models/model-EML.php';
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; Charset=UTF-8');
class estados{
    private $modelo;
    public function consultarEstados() {
    $this->modelo = new emlModel();
    $res= $this->modelo->consultarEstados();
    $estados = json_encode($res);
    $estados.="";
    echo $estados;
    }
}

class municipios{
    private $modelo;
    public function consultarMunicipios($idEstado) {
        $this->modelo = new emlModel();
        $res=  $this->modelo->consultarMunicipios($idEstado);
        $municipios = json_encode($res);
        $municipios.="";
        echo $municipios;
    }
}

class localidades{
    private $modelo;
    public function consultarLocalidades($idMunicipio){
        $this->modelo = new emlModel();
        $res = $this->modelo->consultarLocalidades($idMunicipio);
        $localidades = json_encode($res);
        $localidades.="";
        echo $localidades;
    }
}
?>
