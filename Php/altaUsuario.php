<?php
require_once("Conexion.php");
$id = rand(10, 265821);
$Nombre =$_POST['Nombre'];
$Apellidos =$_POST['Apellidos'];
$Cargo =$_POST['Cargo'];
$Email =$_POST['Email'];
$Password =$_POST['Password'];
$rol = $_POST['ID_rol'];


if (!empty($Nombre) AND !empty($Apellidos) AND !empty($Cargo) AND !empty($Email) AND !empty($Password)) {
    $sql = mysqli_query($conexion,"INSERT INTO `Usuarios` (`ID_usuario`, `Nombre`, `Apellidos`, `Cargo`, `Email`, `Password`, `Nivel`, `ID_rol`) 
                            VALUES ('UTSEMus$id', '$Nombre', '$Apellidos', '$Cargo', '$Email', '$Password', '0', '$rol'); ");
    if ($sql) {
        // Varios destinatarios
        $para  = $Email;

        // título
        $título = 'DATOS de acceso para ingresar a SGBIBE';

        // mensaje
        $mensaje = '
        <html>
        <head>
          <title>Gracias por usas SGBIBE estos son tus datos de acceso</title>
        </head>
        <body>
          <h1>Bienvenido a SGBIBE</h1>
          <p>¡Gracias por usas SGBIBE estos son tus datos de acceso!</p>
          <table>
            <tr>
              <th>Email</th><th>contraseña</th>
            </tr>
            <tr>
              <td><strong>'.$Email.'</strong></td><td><strong>'.$Password.'</strong></td>
            </tr>
          </table>
          <p>¡Accede al sistema picando en el siguiente enlace!</p>
          <a href="https://sgbibe.000webhostapp.com/">SGBIBE</a>
        </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Enviarlo
        mail($para, $título, $mensaje, $cabeceras);
        echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Muy bien el usuario </strong> '. $Nombre .' '. $Apellidos .' fue agregado exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        echo "<script>document.getElementById('formUsuario').reset();</script>";	

    }else{
        echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ohhh no a ocurrido un error </strong> asegúrate de llenar bien los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            
    }
} else {
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey!!!</strong> asegúrate de llenar bien los campos.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

}




?>