<?php
$servername = "localhost";
$username = "root";
$password = "passworsd";
$bd = "sgdbibe";
$mat = 'GABC7118';
$passwordAlumno = md5($mat);
// Conexion
$conexion = new mysqli($servername, $username, $password, $bd);
// Check connection
if ($conexion->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo $passwordAlumno;
}
//echo "Connected successfully"
?>
