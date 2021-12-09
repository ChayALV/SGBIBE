<?php
require_once("../../Library/NuSoap/nusoap.php");
class Cuatrimestres
{
    public function conexionWebServices(){
         $cliente = new nusoap_client("https://mi-escuelamx.com/ws/wsUTSEM/Datos.asmx?wsdl",'wsdl','','','','');
        $error = $cliente->getError(); 
        if ($error) {
            echo "Hubo un errror en el sistema :".$error."...";
        } 
        $resultado = $cliente->call('Ciclos');
        $data = $resultado['CiclosResult']['diffgram']['NewDataSet']['Ciclos'];
        //print_r($data);
        return $data;
    }
}
?>

