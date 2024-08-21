<?php
include_once '../model/conexion.php';
include_once '../model/models/model-departamentos.php';

class departamento {
    private $modelo;
     public function __construct() {
        $this->modelo = new departamentoModel();
    }
    public function consultarDepartamentos() {
        $res = $this->modelo->consultarDepartamentos();
        $departamentos = json_encode($res);
        $departamentos.='';
        echo $departamentos;
    }
    public function agregarDepartamento($departamento,$descripcion){
      $res = $this->modelo->agregarDepartamento($departamento,$descripcion);
      echo $res;
    }
    public function eliminarDepartamento($id){
      $res = $this->modelo->eliminarDepartamento($id);
      echo $res;
    }
  }

class categoria{
  private $modelo;
  public function __construct(){
    $this->modelo = new categoriaModel();
  }
  public function  consultarCategorias(){
    $res = $this->modelo->consultarCategorias();
    $categorias = json_encode($res);
    $categorias.='';
    echo $categorias;
  }
  public function  consultarCategoria($id){
    $res = $this->modelo->consultarCategoria($id);
    $categorias = json_encode($res);
    $categorias.='';
    echo $categorias;
  }
  public function agregarCategoria($clave,$categoria,$descripcion,$idDepartamento){
    $res = $this->modelo->agregarCategoria($clave,$categoria,$descripcion,$idDepartamento);
    echo $res;
  }
  public function modificarCategoria($clave,$categoria,$descripcion){
    $res = $this->modelo->modificarCategoria($clave,$categoria,$descripcion);
    echo $res;
  }
  public function eliminarCategoria($id){
    $res = $this->modelo->eliminarCategoria($id);
    echo $res;
  }
}
  ?>
