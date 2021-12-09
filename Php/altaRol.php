<?php
require_once("Conexion.php");
$id = rand(10, 265821);
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

$Solicitudes = $A == 'true' ? 'Solicitudes' : 0;
$Becados = $E == 'true' ? 'Alumnos Becados' : 0;
$Becas = $C == 'true' ? 'Becas' : 0;
$Usuarios = $V == 'true' ? 'Usuarios' : 0;
$permisosStr = $Solicitudes.','.$Becados.','.$Usuarios.','.$Becas;

if (!empty($Nombre) AND !empty($Descripcion)) {
    $sql = mysqli_query($conexion,"INSERT INTO `Roles` (`ID_rol`, `Nombre`, `Descripcion`, `permisos`, `codigoDePermisos`) 
                                    VALUES ('Rol_UTSEM_$id', '$Nombre', '$Descripcion', '$permisos', '$permisosStr');  ");
    if ($sql) {
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien el rol </strong> '. $Nombre .'fue agregado exitosamente.
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