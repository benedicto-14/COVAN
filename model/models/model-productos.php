<?php
/**
 * Description of modelo-productos
 *
 * @author
 */
class modeloProducto extends BD{

  public function consultarProductos(){
      return $this->ConsultaPreparada("SELECT idProducto,nombre,producto.descripcion,precioMenudeo,stock,categorias.categoria
                                       FROM producto
                                       INNER JOIN categorias ON producto.idCategoria=categorias.idCategoria
                                       LIMIT 5", array(1));
  }
  public function filtrarProducto($p){
      return $this->ConsultaPreparada("SELECT idProducto,nombre,producto.descripcion,precioMenudeo,stock,categorias.categoria
                                       FROM producto
                                       INNER JOIN categorias ON producto.idCategoria=categorias.idCategoria WHERE nombre LIKE ? OR producto.descripcion LIKE ? OR codigoBarras LIKE ?", array("%$p%","%$p%","%$p%"));
  }

  public function modificarProveedor($id,$nombre, $telefono, $rfc, $email, $estado, $municipio, $localidad, $idDomicilio,$colonia,$calle, $cp, $exterior, $interior) {
       $this->InsertarRegistrosPreparada("CALL editarProveedor (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($id,$nombre, $telefono, $rfc, $email,
           $estado, $municipio, $localidad, $idDomicilio,$colonia,$calle, $cp, $exterior, $interior,1));
   }

   public function consultarDepartamentos(){
            return $this->ConsultaPreparada("SELECT * FROM departamento;",array(1));
       }

       public function consultarCategorias($idDepartamento){
           return $this->ConsultaPreparada("SELECT * from categorias WHERE 	idDepartamento=?;", array($idDepartamento));
       }

       public function consultarMedida(){
           return $this->ConsultaPreparada("SELECT * from medida;", array(1));
       }

       public function insertarProducto($codigoBarras,$nombre,$precioVenta,$precioMayoreo,$descripcion,$iva,$ieps,$medida,$categoria) {
           $this->InsertarRegistrosPreparada("INSERT INTO producto(codigoBarras,nombre,precioMenudeo,precioMayoreo,descripcion,iva,ieps,idMedida,idCategoria) VALUES (?,?,?,?,?,?,?,?,?)", array($codigoBarras,$nombre,$precioVenta,$precioMayoreo,$descripcion,$iva,$ieps,$medida,$categoria));
       }

}
?>
