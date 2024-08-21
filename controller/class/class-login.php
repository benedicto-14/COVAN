<?php
include_once '../model/conexion.php';
include_once '../model/models/model-login.php';
class login{
  private $modelo;
   public function __construct() {
      $this->modelo = new loginModel();
  }

public function validarCuenta($usuario,$contraseña){
  $res= $this->modelo->consultarCuenta($usuario);
  $idUser='';
  $idEmpresa='';
  $pass='';
  $user='';
  $empresa='';
  $logo='';
  foreach ($res as $r) {
  $idUser .=''.$r['idUsuario'].'';
  $idEmpresa .=''.$r['idEmpresa'].'';
  $pass .=''.$r['contraseña'].'';
  $user .=''.$r['usuario'].'';
  $empresa .=''.$r['empresa'].'';
  $logo .=''.$r['logo'].'';
  }
  $pass_hash= $pass;
  if (password_verify($contraseña,$pass_hash)) {
      $usuario = json_encode($res);
      $usuario.='';
      echo $usuario;
      session_start();
      $_SESSION['ingreso']='YES';
      $_SESSION['usuario']=$user;
      $_SESSION['idUsuario']=$idUser;
      $_SESSION['empresa']=$empresa;
      $_SESSION['logo']=$logo;
      $_SESSION['idEmpresa']=$idEmpresa;
  }else {
      echo "Error";
  }
}
}
