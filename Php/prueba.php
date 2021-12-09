<?php
require_once("Conexion.php");
$id_beca = $_POST['ID_beca'];
$matricula = $_POST['Matricula'];
$id = "UTSEM_S_".rand(4268,354687);
$documento;
$fecha = date("Y-m-d");
$formulariowhile = mysqli_query($conexion,"SELECT * FROM `Becas_Requisistos` WHERE ID_beca = $id_beca");

$altaSolicitud = mysqli_query($conexion, "INSERT INTO `Solicitudes` (`ID_solicitud`, `Matricula`, `ID_beca`, `ID_estado`, `Comentarios`, `fecha_de_solicitud`) 
                                        VALUES ('$id', '$matricula', '$id_beca', '2', '', '$fecha'); ");

if ($altaSolicitud) {
    while ($datos = $formulariowhile->fetch_array()) {
        $documento = $id_beca.'_'.$datos['ID_requisito'];
        $requisito = $datos['ID_requisito'];
        if (isset($_FILES[$documento])) {
            $ruta_carpeta = "../Documents/docuemntosDeSolicitudes/";
            $nombre_archivo = "Documento".$id."_".$datos['ID_requisito']."_Fecha_".date("Y-m-d") .".". pathinfo($_FILES[$documento]["name"],PATHINFO_EXTENSION);
            $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
            if (move_uploaded_file($_FILES[$documento]["tmp_name"],$ruta_guardar_archivo)) {
                $altaRuta = mysqli_query($conexion, "INSERT INTO `Rutas_archivos` (`ID_ruta`, `ID_solicitud`, `Ruta`, `ID_requisito`) VALUES (NULL, '$id', '$ruta_guardar_archivo', $requisito); ");
                echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=1'</script>";	
            }else {
                echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=2'</script>";	

            }
        }else {
            echo "<script>location.href='../Pages/User/VistaDePsotulaciones.php?std=2'</script>";	

        }
    }
}

?>