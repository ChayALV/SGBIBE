<?php
require_once("../../Php/Conexion.php");
$matricula = $_SESSION['matricula'];
$postulacionesDelAlumno = mysqli_query($conexion,"SELECT * FROM `solicitudesV` WHERE Matricula = '$matricula'");
?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <?php  
                if (isset($_GET['std'])) {
                   if ($_GET['std']==1) {
                       echo '
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Te has postulado exitosamente</strong>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                       </div>';
                   }else {
                       if ($_GET['std']==1) {
                            echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Haz actualizado tu postulacion exitosamente</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                       } else {
                           echo '
                           <div class="alert alert-success alert-dismissible fade show" role="alert">
                           <strong>Ohhh... no algo salio mal</strong> intentalo de nuevo
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
                       }
                   }
                }
            ?>
            <div id="Alerta"></div>
            <?php if ($postulacionesDelAlumno->num_rows === 0) {?>
                <div class="jumbotron jumbotron-fluid bg-white p-3 bordesRedondeados">
                    <div class="container">
                        <h1 class="display-4">No tienes postulaciones</h1>
                        <p class="lead">Postulase a una beca.</p>
                    </div>
                </div>
            <?php }else {?>
                <?php while ($postulaciones = $postulacionesDelAlumno->fetch_array()) {
                        if ($postulaciones['ID_estado'] == 1 ) {
                            $estado = "aceptado";
                        }else {
                            if ($postulaciones['ID_estado'] == 2) {
                                $estado = "enEspera";
                            }else {
                                if ($postulaciones['ID_estado'] == 3) {
                                    $estado = "rechazado";
                                }else {
                                    if ($postulaciones['ID_estado'] == 4) {
                                        $estado = "calcelado";
                                    }else{
                                        if ($postulaciones['ID_estado'] == 5) {
                                            $estado = "revisado";
                                        }
                                    }
                                }
                            }
                        }
                ?>
                    <div class="jumbotron p-3 mb-3  <?php echo $estado ?> bordesRedondeados">
                        <h1 class="display-4">Postulación para la beca: <strong><?php echo $postulaciones['Nombre'] ?></strong> </h1>
                        <p class="lead"> <strong>Fecha de postulación: </strong> <?php echo $postulaciones['fecha_de_solicitud'] ?> | <strong>Fecha de expiración: </strong> <?php echo $postulaciones['Fecha_De_Expiracion'] ?> | <strong>Estado de la postulación: </strong> <?php echo $postulaciones['Valor'] ?></p>
                        <hr class="my-4">
                        <h3>Comentarios:</h3>
                        <p><?php echo $comentarios = $postulaciones['Comentarios'] == '' ? 'No hay comentarios': $postulaciones['Comentarios'];  ?></p>
                        <p class="lead">
                            <?php if ($postulaciones['ID_estado'] == 4) {?>
                                <a class="btn btn-success btn-lg" href="PaginaAlumno.php" role="button">Volver a postularme</a>
                            <?php }else{ ?>
                                <a class="btn btn-success btn-lg" href="editarPostulacion.php?idSol=<?php echo $postulaciones['ID_solicitud'] ?>&IMG=<?php echo $postulaciones['IMG_portado'] ?>&IDB=<?php echo $postulaciones['ID_beca'] ?>" role="button">Mirar postulacion</a>
                                <a class="btn btn-danger btn-lg" onclick="canselarSolicitud('<?php echo $postulaciones['ID_solicitud'] ?>')" role="button">Cancelar postulación</a>
                            <?php } ?>
                        </p>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<script>
function canselarSolicitud(idS){
    var datos = 'ID='+idS;
    $.ajax({
        type: "POST",
        url: "../../Php/cancelarSolicitud.php",
        data: datos
    })
    .done(function(res){
        $('#Alerta').html(res);
        setTimeout(function(){
                location.reload();
                //Código a ejecutar
            },1500);
    })
    ;
}
</script>
