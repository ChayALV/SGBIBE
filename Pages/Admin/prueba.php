<?php
session_start();
if(@!$_SESSION['correo']){
	header("location:../../index.html");
}
if ($_SESSION['nivel']==1) {
    header("location:../User/PaginaAlumno.php");
}
require_once("../../Php/Conexion.php");
$idRol = $_SESSION['rol'];
$permisos = mysqli_query($conexion,"SELECT * FROM Roles WHERE ID_rol = '$idRol'");
if (!$permisos) {
    echo 0000;
}
if($datos = $permisos->fetch_array()){
    $modulos = $datos['permisos'];
    echo $modulos;
}
?>