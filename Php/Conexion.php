<?php
$servername = "localhost";
$username = "root";
$password = "password";
$bd = "sgdbibe";
// Conexion
$conexion = new mysqli($servername, $username, $password, $bd);
// Check connection
if ($conexion->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully"
?>
