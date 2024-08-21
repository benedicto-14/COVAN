<?php
header('Content-Type: application/json');
header ('Access-Control-Allow-Origin: *');   
include_once '../../model/conexion.php';
include_once '../../model/models/model-estadisticas.php';
include_once '../class/class-log.php';
class estadisticas{
    
    private $modelo;    
    
    public function __construct() {
        $this->modelo = new estadisticasModel();        
    }
    
    public function mostrarFechas() {
        $reg1 = $this->modelo->fechasEstadisticas();
        $reg2 = $this->modelo->fechasVentas();
        $reg3 = $this->modelo->fechasCompras();
        $json = array("Ganancias"=>$reg1,"Ventas"=>$reg2,"Compras"=>$reg3);
        return json_encode($json);
    }

    public function mostraTipo(){
        $json = $this->modelo->consultarTipo();
        return json_encode($json);
    }

    public function logs(){
        $json = $this->modelo->fechasLogs();        
        return json_encode($json);
    }

    public function actualizarInfo($tipo1,$tipo2,$tipo3,$tipo4){
        $this->modelo->modificarInfo($tipo1,$tipo2,$tipo3,$tipo4);
    }

    public function mostrarEstadisticasByDate($fechaInicio,$fechaFin) {
        $json = $this->modelo->consultarEstadisticasByDate($fechaInicio,$fechaFin);                        
        return json_encode($json);
    }

    public function mostrarComprasByDate($fechaInicio,$fechaFin) {
        $reg1 = $this->modelo->consultarMasComprados($fechaInicio,$fechaFin);
        $reg2 = $this->modelo->consultarMenosComprados($fechaInicio,$fechaFin);
        $json = array("Mas"=>$reg1,"Menos"=>$reg2);
        return json_encode($json);
    }

    public function mostrarVentasByDate($fechaInicio,$fechaFin) {
        $json = $this->modelo->consultarVentasByDate($fechaInicio,$fechaFin);                        
        return json_encode($json);
    }

    public function mostrarVentasProductsByDate($fechaInicio,$fechaFin) {
        $reg1 = $this->modelo->consultarMasVendido($fechaInicio,$fechaFin);
        $reg2 = $this->modelo->consultarMenosVendido($fechaInicio,$fechaFin);
        $json = array("Mas"=>$reg1,"Menos"=>$reg2);
        return json_encode($json);
    }

    public function consultarLog($fecha) {                    
        $ruta = '../../model/logs/'.$fecha.'.txt';
        $a=array();

        if (file_exists($ruta)) {            
            $file=fopen($ruta, "r");            
            while($linea=fgets($file)) {
                if (feof($file)) break;
                $linea=substr($linea, 0, -1);
                array_push($a,$linea);                
            }
            fclose($file);

            $json = array("Registros"=>$a);
            return json_encode($json);
        }else {                        
            $json = array("Registro"=>"no encontrado");
            return json_encode($json);
        }

    }

    public function borrarLog($id,$fecha){
        $ruta = '../../model/logs/'.$fecha.'.txt';
        if (file_exists($ruta)) {                        
            
            $this->modelo->eliminarLog($id);
            unlink($ruta);
            
            $json = array("Registro"=>"Eliminado");            
            return json_encode($json);
        }else {                                    
            $json = array("Registro"=>"no encontrado");
            return json_encode($json);
        }
    }

}

$log = new Logs('Westbrook');
$controller = new estadisticas();
$nombreUser;

/*if ($_GET["nombreUser"]){
$nombreUser = $_GET["nombreUser"];
echo $nombreUser;
}*/

if (isset($_GET["fechas"])) {
    echo $controller->mostrarfechas();
}
if(isset($_GET["logs"])){
    echo $controller->logs();
}
if (isset($_GET["tipo"])){
    echo $controller->mostraTipo();
}
if (isset($_POST["info1"])){    
    $controller->actualizarInfo($_POST["info1"],$_POST["info2"],$_POST["info3"],$_POST["info4"]);
    $reg = array("Registros"=>"Modificados");
    $json = json_encode($reg);
    
    $log->logCompras('Modifico el tipo de graficas');
    //echo $nombreUser;
    /*$log->logCaja('Lebron','Modifico Graficas');
    $log->logProductos('James','Modifico Graficas');
    $log->logClientes('Juan','Modifico Graficas');
    $log->logFacturacion('Pedro','Modifico Graficas');
    $log->logCompras('Ramon','Modifico Graficas');
    $log->logProveedores('Rodolfo','Modifico Graficas');
    $log->logSucursales('Maria','Modifico Graficas');
    $log->logDepartamentos('Ana','Modifico Graficas');
    $log->logEmpleados('Mario','Modifico Graficas');
    $log->logGraficas('Pablo','Modifico Graficas');*/
    
    echo $json;
}
if (isset($_POST["fi"])){
    echo $controller->mostrarEstadisticasByDate($_POST["fi"],$_POST["ff"]);
}
if (isset($_POST["fiC"])){    
    echo $controller->mostrarComprasByDate($_POST["fiC"],$_POST["ffC"]);    
}
if (isset($_POST["fiV"])){    
    echo $controller->mostrarVentasByDate($_POST["fiV"],$_POST["ffV"]);    
}
if (isset($_POST["fiVP"])){
    echo $controller->mostrarVentasProductsByDate($_POST["fiVP"],$_POST["ffVP"]);    
}
if(isset($_GET["fechalog"])){    
    echo $controller->consultarLog($_GET["fechalog"]);    
}
if(isset($_POST["EliminarlogId"])){
    echo $controller->borrarLog($_POST["EliminarlogId"],$_POST["EliminarlogFecha"]);    
}