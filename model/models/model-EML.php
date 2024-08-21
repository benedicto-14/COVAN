<?php
class emlModel  extends BD{
    //Funciones empresa
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
?>
