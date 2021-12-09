<?php 
session_start(); 
if(@!$_SESSION['correo']){
	header("location:../../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../Html/HeadAlumno.html') ?>
</head>
<body>
    <?php include('../../Html/NavBarAlumno.html') ?>
    <?php include('../../Components/User/paginaPrincipal.php') ?>
</body>
</body>
</html>