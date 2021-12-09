<?php
session_start();
//Clase de validacion (FuncionAutenticacion.php)
require_once("FuncionAutenticacion.php");
//Variables de accesos
$emailOrMatricula = $_POST['EmailOrMatricula'];
$password         = $_POST['Password'];
// validacion
$logIN = new AutenticacionDeUsuarios($emailOrMatricula, $password);
$datosDeUsuarios = $logIN->validacionOinsercion();
if (gettype($datosDeUsuarios) == 'array') {
    echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Bienvenido</strong> '.$emailOrMatricula.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    //redireccionamiendo
    if ($datosDeUsuarios['Nivel'] == 0) {
         //variables de sesion
         $_SESSION['id_usuario'] = $datosDeUsuarios['ID_usuario']; 
         $_SESSION['rol'] = $datosDeUsuarios['ID_rol'];
         $_SESSION['nivel'] = $datosDeUsuarios['Nivel'];
         $_SESSION['correo'] = $datosDeUsuarios['Email'];
        echo "<script>location.href='Pages/Admin/PaginaSolicitudes.php'</script>";	
    }elseif($datosDeUsuarios['Nivel'] == 1){
         //variables de sesion
         $_SESSION['nivel'] = $datosDeUsuarios['Nivel'];
         $_SESSION['matricula'] = $datosDeUsuarios['Matricula'];
         $_SESSION['correo'] = $datosDeUsuarios['Email'];
        echo "<script>location.href='Pages/User/PaginaAlumno.php'</script>";	
    }
} else {
    if ($datosDeUsuarios == 1001) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>El email es incorrecto</strong> '.$emailOrMatricula.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }elseif($datosDeUsuarios == 1002){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>La contraceña es incorrecta</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }elseif($datosDeUsuarios == 2001){
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>La matricula es incorrecta</strong> '.$emailOrMatricula.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }elseif($datosDeUsuarios == 2002){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>La contraceña es incorrecta</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>