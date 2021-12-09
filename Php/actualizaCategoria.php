<?php
require_once("Conexion.php");
$id = $_POST['idCategoria'];
$nombre = $_POST['Nombre'];

if (!empty($id) AND !empty($nombre)) {
    $sql = mysqli_query($conexion,"UPDATE `Tipo_de_becas` SET `Tipo_de_beca` = '$nombre' WHERE `Tipo_de_becas`.`ID_Tipo` = $id;");
    if ($sql) {
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien la categoría </strong> '. $nombre .' fue actualizada exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        echo "<script>document.getElementById('formUsuario').reset();</script>";	

    }else{
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ohhh no a ocurrido un error </strong> asegúrate de llenar bien los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
    }
} else {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey!!!</strong> asegúrate de llenar bien los campos.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

}
?>