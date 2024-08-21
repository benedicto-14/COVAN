<?php
class departamentoModel  extends BD{
   public function consultarDepartamentos() {
        return $this->ConsultaPreparada("SELECT * FROM departamento ORDER BY idDepartamento ASC", array(1));
    }
    public function agregarDepartamento($departamento,$descripcion) {
              if($this->InsertarRegistrosPreparada("INSERT INTO departamento (departamento,descripcion) VALUES(?,?)", array($departamento,$descripcion))){
                echo 'insertado';
              }else{
                echo 'fail';
              }
  }
  public function eliminarDepartamento($id) {
     if($this->EliminarRegistro("DELETE  FROM departamento WHERE idDepartamento=?", array($id))){
       echo 'eliminado';
     }else {
       echo 'fail';
     }
  }
}
class categoriaModel extends BD{
  public function consultarCategorias() {
       return $this->ConsultaPreparada("SELECT * FROM categorias ORDER BY idCategoria ASC", array(1));
   }
   public function consultarCategoria($id) {
        return $this->ConsultaPreparada("SELECT * FROM categorias WHERE idCategoria=?", array($id));
    }
   public function agregarCategoria($clave,$categoria,$descripcion,$idDepartamento){
     if($this->InsertarRegistrosPreparada("INSERT INTO categorias (idCategoria,categoria,descripcion,idDepartamento) VALUES(?,?,?,?)", array($clave,$categoria,$descripcion,$idDepartamento))){
       echo 'insertado';
     }else {
       echo 'fail';
     }
   }
   public function modificarCategoria($clave,$categoria,$descripcion){
     if($this->InsertarRegistrosPreparada("UPDATE categorias SET categoria=?,descripcion=? WHERE idCategoria=?", array($categoria,$descripcion,$clave))){
       echo 'success';
     }else {
       echo 'fail';
     }
   }
   public function eliminarCategoria($id) {
      if($this->EliminarRegistro("DELETE  FROM categorias WHERE idCategoria=?", array($id))){
        echo 'eliminado';
      }else {
        echo 'fail';
      }
   }
}
  ?>
