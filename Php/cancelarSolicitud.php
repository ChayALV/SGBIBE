<?php
require_once("Conexion.php");
$idS = $_POST['ID'];

$SQL= mysqli_query($conexion,"UPDATE `Solicitudes` SET `ID_estado` = '4' WHERE `Solicitudes`.`ID_solicitud` = '$idS'; ");
if ($SQL) {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Haz cancelado tu postulación</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'
    ;
}
?>