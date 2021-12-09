<?php
session_start();
if(@!$_SESSION['correo']){
	header("location:../../index.html");
}
$matricula = $_SESSION['matricula'];
$idS = $_GET['idSol'];
$id = $_GET['IDB'];
$img = $_GET['IMG'];
require_once("../../Php/Conexion.php");
$consultaDeBeca = mysqli_query($conexion,"SELECT * FROM `Becas` WHERE ID_beca = $id");
$consultaDeRequisitosDeBeca = mysqli_query($conexion,"SELECT * FROM `Becas_Requisistos` WHERE ID_beca = $id");
$formulariowhile = mysqli_query($conexion,"SELECT * FROM `requisitosByNombre` WHERE ID_solicitud = '$idS'");
$consultaDeSolicitud = mysqli_query($conexion,"SELECT * FROM `Solicitudes` WHERE ID_solicitud = '$idS'");
$rutasDeArchivo = mysqli_query($conexion,"SELECT * FROM `requisitosByNombre` WHERE ID_solicitud = '$idS'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../Html/HeadAlumno.html') ?>
</head>
<body>
    <?php include('../../Html/NavBarAlumno.html') ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <div class="overflow">
        <img class="uno" src="../<?php echo $img ?>" width="100%">
    </div>
    <div class="card mt-2 bordesRedondeados mb-3">
        <div class="card-body">
            <div class="p-3 mt-3">
                <a href="VistaDePsotulaciones.php">
                    <button class="btn btn-success bordesRedondeados"> Volver</button>
                </a>
                <?php
                if($datosDeBeca = $consultaDeBeca->fetch_array()){
                ?>
                <h1 class="display-4"><?php echo $datosDeBeca['Nombre'] ?></h1>
                <h3>Vigencia: <?php echo $datosDeBeca['fecha_de_inicio'] ?> a <?php echo $datosDeBeca['Fecha_De_Expiracion'] ?></h3>
                <h5><?php echo $datosDeBeca['Descripcion'] ?></h5>
                <h3>Requisitos para la beca:</h3>
                <?php
                    while($datosDeRequisitos = $consultaDeRequisitosDeBeca->fetch_array()){
                ?>
                    <br>
                    <h6><strong>└ <?php echo $datosDeRequisitos['Nombre'] ?></strong> en formato: <strong><?php echo $datosDeRequisitos['Tipo'] ?></strong></h6>
                <?php } ?>
                <br>
                <h3>Comentarios</h3>
                <?php if ($postulaciones = $consultaDeSolicitud->fetch_array()) {?>
                    <p><?php echo $comentarios = $postulaciones['Comentarios'] == '' ? 'No hay comentarios': $postulaciones['Comentarios'];  ?></p>
                <?php }?>
                <?php if (empty($datosDeBeca['Link'])) { ?>
                    <h3>Docuemtos subidos para esta beca</h3>
                    <?php while ($rutas = $rutasDeArchivo->fetch_array()) {?>
                        <a class="btn btn-success btn-lg" href="../<?php echo $rutas['Ruta'] ?>" download="<?php echo $rutas['Nombre'] ?>_<?php echo $rutas['Solicitud'] ?>"><?php echo $rutas['Nombre'] ?></a>
                    <?php }?>
                    <br>
                    <br>
                    <h3>Actualiza los documentos</h3>
                        <?php
                            while($formulario = $formulariowhile->fetch_array()){
                        ?>
                        <form method="POST" enctype="multipart/form-data" action="../../Php/actualizaSolicitud.php">
                        <input type="hidden" name="ID_ruta" value="<?php echo $formulario['ID_ruta'] ?>">
                        <input type="hidden" name="ID_beca" value="<?php echo $datosDeBeca['ID_beca'] ?>">
                        <input type="hidden" name="Matricula" value="<?php echo $matricula ?>">
                        <input type="hidden" name="idSolicitud" value="<?php echo $idS ?>">
                        <div class="mb-2">
                            <label for="email" class="form-label"><?php echo $formulario['Nombre'] ?></label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="<?php echo $datosDeBeca['ID_beca'] ?>_<?php echo $formulario['ID_requisito'] ?>" required aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btn-outline-secondary" type="button"  id="inputGroupFileAddon04"><?php echo $formulario['Nombre'] ?></button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success bordesRedondeados"> Actualizar </button>
                    </form>
                        <?php } ?>
                <?php }else {?>
                    <h3>El proceso para solicitar esta beca es en el siguiente LINK</h3>
                    <a href="<?php echo $datosDeBeca['Link'] ?>"> Haz click aqui para continuar con el proceso</a>
                <?php }?>
            <?php }?>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</body>
</html>