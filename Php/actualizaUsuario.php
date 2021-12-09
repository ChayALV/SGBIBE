<?php
require_once("Conexion.php");

$ID = $_POST['ID'];
$Nombre = $_POST['Nombre'];
$Apellidos = $_POST['Apellidos'];
$Cargo = $_POST['Cargo'];
$Email = $_POST['Email'];
$ID_rol = $_POST['ID_rol'];
$Contraseña = $_POST['Contraseña'];

$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `Nombre` = '$Nombre' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");
$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `Apellidos` = '$Apellidos' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");
$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `Cargo` = '$Cargo' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");
$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `Email` = '$Email' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");
$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `Password` = '$Contraseña' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");
$sql = mysqli_query($conexion,"UPDATE `Usuarios` SET `ID_rol` = '$ID_rol' WHERE `Usuarios`.`ID_usuario` = '$ID'; ");


// Varios destinatarios
$para  = $Email;

// título
$título = 'NUEVAS NOTICIAS';

// mensaje
$mensaje = '
<html>
<head>
<title>Actualización de datos</title>
</head>
<body>
<h1>SGBIBE te notifica</h1>
<p>¡Estos son tus nuevos datos de acceso!</p>
<table>
<tr>
<th>Email</th><th>contraseña</th>
</tr>
<tr>
<td><strong>'.$Email.'</strong></td><td><strong>'.$Contraseña.'</strong></td>
</tr>
</table>
<table>
<tr>
<th>Nombre</th><th>Apellidos</th><th>Cargo</th>
</tr>
<tr>
<td><strong>'.$Nombre.'</strong></td><td><strong>'.$Apellidos.'</strong></td><td><strong>'.$Cargo.'</strong></td>
</tr>
</table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Enviarlo
mail($para, $título, $mensaje, $cabeceras);

echo "<script>location.href='../Pages/Admin/PaginaCreacionUsuarios.php'</script>";	
?>