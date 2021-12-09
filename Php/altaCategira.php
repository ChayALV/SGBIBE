<?php
require_once("Conexion.php");
$id = rand(113, 165464);
$Nombre =$_POST['Nombre'];

if (!empty($Nombre)) {
    $sql = mysqli_query($conexion,"INSERT INTO `Tipo_de_becas` (`ID_Tipo`, `Tipo_de_beca`) 
                                VALUES ($id, '$Nombre'); ");
    if ($sql) {
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien la categoria </strong> '. $Nombre .' fue agregado exitosamente.
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