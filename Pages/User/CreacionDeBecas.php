<?php 
session_start();
if(@!$_SESSION['correo']){
	header("location:../../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../Html/HeadAdministrador.html') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include('../../Html/NavBarAndSideBar.html') ?>
        <?php include('../../Components/Admin/CreacionDeBeca.php') ?>
        <?php include('../../Html/Footer.html') ?>
    </div>
</body>
</body>
</html>