<?php
require_once("Conexion.php");
$IdBeca = $_GET['ID'];
$estado = $_GET['ESTADO'];
if ($estado == 'Activa') {
    $sql1=mysqli_query($conexion, "UPDATE `Becas` SET `estado` = 'Pausada' WHERE `Becas`.`ID_beca` = $IdBeca; ");
    header("location:../Pages/Admin/Becas.php");
}else {
    if ($estado == 'Pausada') {
        $sql1=mysqli_query($conexion, "UPDATE `Becas` SET `estado` = 'Activa' WHERE `Becas`.`ID_beca` = $IdBeca; ");
        header("location:../Pages/Admin/Becas.php");
    }
}

?>