<?php
require_once("Conexion.php");
$id = $_POST['ID'];
$sql = mysqli_query($conexion,"DELETE FROM `Usuarios` WHERE `Usuarios`.`ID_usuario` = '$id'");
if ($sql) {
    echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien el usuarios </strong> fue eliminado exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}else{
    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ohhh a ocurrido un error </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
}
?>