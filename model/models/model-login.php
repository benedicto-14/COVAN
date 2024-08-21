<?php
class loginModel  extends BD{
  public function consultarCuenta($usuario) {
       return $this->ConsultaPreparada("SELECT usuarios.idUsuario,usuarios.usuario, usuarios.contraseña, empresa.idEmpresa, empresa.empresa,empresa.logo FROM usuarios INNER JOIN empresa ON usuarios.idEmpresa=empresa.idEmpresa WHERE usuario=?", array($usuario));
   }
 }
 ?>
