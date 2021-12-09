<?php
require_once("Conexion.php");
$id = $_POST['ID'];
$sql = mysqli_query($conexion,"DELETE FROM `Becas` WHERE `Becas`.`ID_beca` = $id ");
if ($sql) {
    echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Beca eliminada</strong> exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    ';
}else{
    echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ohh noo</strong> a ocurrido un error.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    ';
}
?>