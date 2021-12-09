<?php
require_once("Conexion.php");
$id_beca = $_POST['ID_beca'];
$matricula = $_POST['Matricula'];
$id_solicitud = $_POST['idSolicitud'];
$id = "UTSEM_S_".rand(4268,354687);
$id_ruta = $_POST['ID_ruta'];
$documento;

$formulariowhile = mysqli_query($conexion,"SELECT * FROM `Becas_Requisistos` WHERE ID_beca = $id_beca");
while ($datos = $formulariowhile->fetch_array()) {
    $documento = $id_beca.'_'.$datos['ID_requisito'];
    $requisito = $datos['ID_requisito'];
    if (isset($_FILES[$documento])) {
        $ruta_carpeta = "../Documents/docuemntosDeSolicitudes/";
        $nombre_archivo = "Documento".$id."_".$datos['ID_requisito']."_Fecha_".date("Y-m-d") .".". pathinfo($_FILES[$documento]["name"],PATHINFO_EXTENSION);
        $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;

        $sql = mysqli_query($conexion,"UPDATE `Rutas_archivos` SET `Ruta` = '$ruta_guardar_archivo' WHERE `Rutas_archivos`.`ID_ruta` = $id_ruta;");
        if ($sql) {
            if (move_uploaded_file($_FILES[$documento]["tmp_name"],$ruta_guardar_archivo)) {
                echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=3'</script>";	
            }else {
                echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=2'</script>";	
    
            }
        }
    }else {
        echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=2'</script>";	

    }
}


?>