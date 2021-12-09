<?php
require_once("Conexion.php");
$id = $_POST['idCategoria'];

if (!empty($id)) {
    $sql = mysqli_query($conexion,"DELETE FROM `Tipo_de_becas` WHERE `Tipo_de_becas`.`ID_Tipo` = $id;");
    if ($sql) {
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien la categoría </strong> '. $id .' fue eliminada exitosamente.
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