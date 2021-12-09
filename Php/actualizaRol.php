<?php
require_once("Conexion.php");
$id = $_POST['ID'];
$Nombre =$_POST['Nombre'];
$Descripcion =$_POST['Descripcion'];
$A =$_POST['A'];
$E =$_POST['E'];
$C =$_POST['C'];
$V =$_POST['V'];

$Actualizar = $A == 'true' ? 1 : 0;
$Eliminar = $E == 'true' ? 2 : 0;
$Crear = $C == 'true' ? 3 : 0;
$Visusalizar = $V == 'true' ? 4 : 0;

$permisos = $Actualizar.$Eliminar.$Crear.$Visusalizar;

$Solicitudes = $A == 'true' ? 'Solicitudes' : '';
$Becados = $E == 'true' ? 'Alumnos Becados' : '';
$Becas = $C == 'true' ? 'Becas' : '';
$Usuarios = $V == 'true' ? 'Usuarios' : '';
$permisosStr = $Solicitudes.','.$Becados.','.$Usuarios.','.$Becas;

if (!empty($Nombre) AND !empty($Descripcion)) {
    $sql = mysqli_query($conexion,"UPDATE `Roles` SET `Nombre` = '$Nombre' WHERE `Roles`.`ID_rol` = '$id';");
    $sql1 = mysqli_query($conexion,"UPDATE `Roles` SET `Descripcion` = '$Descripcion' WHERE `Roles`.`ID_rol` = '$id';");
    $sql2 = mysqli_query($conexion,"UPDATE `Roles` SET `permisos` = '$permisos' WHERE `Roles`.`ID_rol` = '$id';");
    $sql3 = mysqli_query($conexion,"UPDATE `Roles` SET `codigoDePermisos` = '$permisosStr' WHERE `Roles`.`ID_rol` = '$id';");
    if ($sql AND $sql1 AND $sql2 AND $sql3) {
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien el rol </strong> '. $Nombre .' fue agregado exitosamente.
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