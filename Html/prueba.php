<?php
session_start();
require_once("../Php/Conexion.php");
$id = $_SESSION['id_usuario'];
echo $id;
// $idRol = $_SESSION['rol'];
// $permisos = mysqli_query($conexion,"SELECT * FROM Roles WHERE ID_rol = '$idRol'");
// if (!$permisos) {
//     echo 'a ocurrido un error';
// }
// if($datos = $permisos->fetch_array()){
//     $modulos = $datos['permisos'];
//     echo $modulos;
// }
?>