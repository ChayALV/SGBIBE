<?php
require_once("Conexion.php");
$idSolicitud = $_POST['ID'];
$estado = $_POST['Estado'];
$Email = $_POST['EMAIL'];
if ($estado == 1) {
    $sql = mysqli_query($conexion,"UPDATE `Solicitudes` SET `ID_estado` = '1' WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud'; ");
    if ($sql) {
        echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Muy bien la solicitud </strong> fue aprobada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                // Varios destinatarios
                $para  = $Email;

                // título
                $título = 'BUENAS NOTICIAS';

                // mensaje
                $mensaje = '
                <html>
                <head>
                <title>SGBIBE te notifica</title>
                </head>
                <body>
                <h1>SGBIBE te notifica</h1>
                <p>¡Que tu solicitud para la beca ha sido aprobada con éxito!</p>
                <p>Puedes ir al sistema para corroborarlo </p>
                </body>
                </html>
                ';

                // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Enviarlo
                mail($para, $título, $mensaje, $cabeceras);
    }else{
        echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ohhh a ocurrido un error </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
if ($estado == 0) {
    $sql = mysqli_query($conexion,"UPDATE `Solicitudes` SET `ID_estado` = '3' WHERE `Solicitudes`.`ID_solicitud` = '$idSolicitud';");
    if ($sql) {
        echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Muy bien la solicitud </strong> fue denegada exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

                // Varios destinatarios
                $para  = $Email;

                // título
                $título = 'NOTICIAS';

                // mensaje
                $mensaje = '
                <html>
                <head>
                <title>SGBIBE te notifica</title>
                </head>
                <body>
                <h1>SGBIBE te notifica</h1>
                <p>¡Que tu solicitud para la beca ha sido rechazada!</p>
                <p>Puedes ir al sistema para corroborarlo </p>
                </body>
                </html>
                ';

                // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Enviarlo
                mail($para, $título, $mensaje, $cabeceras);
    }else{
        echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ohhh a ocurrido un error </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>