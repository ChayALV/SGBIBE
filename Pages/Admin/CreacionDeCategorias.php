<?php session_start(); 
if(@!$_SESSION['correo']){
	header("location:../../index.html");
}
if ($_SESSION['nivel']==1) {
    header("location:../User/PaginaAlumno.php");
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
        <?php include('../../Components/Admin/categorias.php') ?>
        <?php include('../../Html/Footer.html') ?>
    </div>
</body>
</body>
</html>