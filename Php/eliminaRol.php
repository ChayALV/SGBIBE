<?php
require_once("Conexion.php");
$id = $_POST['ID'];

$sql = mysqli_query($conexion, "DELETE FROM `Roles` WHERE `Roles`.`ID_rol` = '$id';");
if ($sql) {
    echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien el rol </strong> fue agregado exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}else{
    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Muy bien el rol </strong> fue agregado exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
?>