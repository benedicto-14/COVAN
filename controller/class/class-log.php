<?php 

include_once '../../model/conexion.php';
include_once '../../model/models/model-estadisticas.php';

class Logs {
    
    private $modelo;
    private $usuario;

    public $caja = '<i class="fas fa-cash-register" style="color: #6DF6A6; font-size:20px;"></i>';
    public $producto = '<i class="fas fa-cubes" style="color: #EAED2F; font-size:20px;"></i>';
    public $cliente = '<i class="fas fa-users" style="color: #90F0ED; font-size:20px;"></i>';
    public $facturacion = '<i class="fas fa-file" style="color: #D8D8D8; font-size:20px;"></i>';
    public $compras = '<i class="fas fa-shopping-cart" style="color: #A4A4A4; font-size:20px;"></i>';
    public $proveedores = '<i class="fas fa-dolly" style="color: #84A6F1; font-size:20px;"></i>';
    public $sucursales = '<i class="fas fa-store-alt" style="color: #FF8686; font-size:20px;"></i>';
    public $departamentos = '<i class="fas fa-columns" style="color: #EDC68B; font-size:20px;"></i>';
    public $empelados = '<i class="fas fa-address-card" style="color: #848ED1; font-size:20px;"></i>';
    public $estadisticas = '<i class="fas fa-poll" style="color: #FEA8FF; font-size:20px;"></i>';    
    
    public function __construct($user) {
        date_default_timezone_set('America/Mexico_City');
        $this->path="../../model/logs/";
        $this->fecha=date("Y-m-d");
        $this->hora=date("g:i a");
        $this->ip=$_SERVER['REMOTE_ADDR'];
        $this->usuario = $user;
        $this->modelo = new estadisticasModel();
    }

    public function ingresarlog($seccion,$actividad) {
        $ruta=$this->path.$this->fecha.".txt";

        if (file_exists($ruta)) {
            $file=fopen($ruta, "a");            
            fwrite($file, $this->hora." ".$seccion." ".$this->usuario." ".$actividad." desde la siguiente IP:".$this->ip. PHP_EOL);
        } else {                        
            $this->modelo->insertarLog($this->fecha);
            $file=fopen($ruta, "w");            
            fwrite($file, $this->hora." ".$seccion." ".$this->usuario." ".$actividad." desde la siguiente IP:".$this->ip. PHP_EOL);
            fclose($file);
        }
    }    

    public function logCaja($actividad){
        $this->ingresarlog($this->caja,$actividad);
    }
    
    public function logProductos($actividad){
        $this->ingresarlog($this->producto,$actividad);
    }
    
    public function logClientes($actividad){
        $this->ingresarlog($this->cliente,$actividad);
    }

    public function logFacturacion($actividad){
        $this->ingresarlog($this->facturacion,$actividad);
    }

    public function logCompras($actividad){
        $this->ingresarlog($this->compras,$actividad);
    }

    public function logProveedores($actividad){
        $this->ingresarlog($this->proveedores,$actividad);
    }

    public function logSucursales($actividad){
        $this->ingresarlog($this->sucursales,$actividad);
    }

    public function logDepartamentos($actividad){
        $this->ingresarlog($this->departamentos,$actividad);
    }

    public function logEmpleados($actividad){
        $this->ingresarlog($this->empelados,$actividad);
    }

    public function logGraficas($actividad){
        $this->ingresarlog($this->estadisticas,$actividad);
    }

}

?>