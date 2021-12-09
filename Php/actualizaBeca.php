<?php
require_once("Conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipoBeca'];
$fechaI = $_POST['fechaDeInico'];
$fechaF = $_POST['fechaDeFin'];
$descripcio = $_POST['descripcion'];
$cuatrimestre = $_POST['cuatrimestre'];

$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `Nombre` = '$nombre' WHERE `Becas`.`ID_beca` = $id;");
$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `Descripcion` = '$descripcio' WHERE `Becas`.`ID_beca` = $id;");
$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `ID_Tipo` = '$tipo' WHERE `Becas`.`ID_beca` = $id;");
$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `fecha_de_inicio` = '$fechaI' WHERE `Becas`.`ID_beca` = $id;");
$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `Fecha_De_Expiracion` = '$fechaF' WHERE `Becas`.`ID_beca` = $id;");
$sql1=mysqli_query($conexion, "UPDATE `Becas` SET `cuatrimestre` = '$cuatrimestre' WHERE `Becas`.`ID_beca` = $id;");

if (!empty($_FILES["imagen"]["name"])) {
    $ruta_carpeta = "../Source/Baners_beca/";
    $nombre_archivo = "Baner_beca_".$id."_".date("dHis") .".". pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
    $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
    if(move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_guardar_archivo)){
        $sql1=mysqli_query($conexion, "UPDATE `Becas` SET `IMG_portado` = '$ruta_guardar_archivo' WHERE `Becas`.`ID_beca` = $id;");
    }
}
echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muuuy bien!</strong> se han actualizado los datos de la beca.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
';
?>