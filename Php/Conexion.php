<?php
$servername = "localhost";
$username = "id18072695_chay123";
$password = "P~DL3Q{NozFU4p6p";
$bd = "id18072695_sgdbibe";
// Conexion
$conexion = new mysqli($servername, $username, $password, $bd);
// Check connection
if ($conexion->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully"
?>