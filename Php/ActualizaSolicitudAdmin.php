<?php
require_once("Conexion.php");
$data = json_decode($_POST['array']);
foreach($data as $clave=>$valor){
    if(empty($data[$clave]->comentario) AND empty($data[$clave]->idDoc)){
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Nada por hacer</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }else{
        $rutas = $data[$clave]->idDoc;
        $idSolicitud = $data[$clave]->idSolicitud;
        $comentario = $data[$clave]->comentario;
        $sql= mysqli_query($conexion,"UPDATE `Solicitudes` SET `Comentarios` = '$comentario' WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud'; ");
        $sql2= mysqli_query($conexion,"UPDATE `Solicitudes` SET `ID_estado` = '5' WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud';");
        if(!empty($data[$clave]->idDoc)){
            foreach($rutas as $index=>$value){
                $sql = mysqli_query($conexion,"SELECT Solicitudes.Comentarios FROM `Solicitudes` WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud'; ");
                if (!$sql) {
                    echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Algo salio mal</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';            
                }
                if ($cometarioAnterio = $sql->fetch_array()) {
                    $comentarioFinal = $cometarioAnterio['Comentarios'].' (Este documento tiene conflictos: '.$value.')';
                    $sql= mysqli_query($conexion,"UPDATE `Solicitudes` SET `Comentarios` = '$comentarioFinal' WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud'; ");
                    
                }
            }
        }
        if ($sql) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Has reportado fallas en esta solicitud con exito</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    
}
?>