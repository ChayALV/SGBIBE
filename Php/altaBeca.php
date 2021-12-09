<?php
require_once("Conexion.php");

$id = rand(113, 1113);
$nombre = $_POST['nombre'];
$tipo = $_POST['tipoBeca'];
$fechaI = $_POST['fechaDeInico'];
$fechaF = $_POST['fechaDeFin'];
$descripcio = $_POST['descripcion'];
$cuatrimestre = $_POST['cuatrimestre'];
$link = $_POST['link'];

if (empty($link)) {
    $link = NULL;
}
$arrayDeRequerimientos = json_decode($_POST['arrayDeRequerimientos']);

$ruta_carpeta = "../Source/Baners_beca/";
$nombre_archivo = "Baner_beca_".$id."_".date("dHis") .".". pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;

$sql = mysqli_query($conexion,"INSERT INTO `Becas` (`ID_beca`, `Nombre`, `Descripcion`, `ID_Tipo`, `IMG_portado`, `fecha_de_inicio`, `Fecha_De_Expiracion`, `estado`, `Link`, `cuatrimestre`) 
                            VALUES ($id, '$nombre', '$descripcio', $tipo, '$ruta_guardar_archivo', '$fechaI', '$fechaF', 'Activa', '$link', '$cuatrimestre'); ");

if ($sql) {
    if(move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_guardar_archivo)){
            foreach($arrayDeRequerimientos as $clave=>$valor){
                $nombreT = $arrayDeRequerimientos[$clave]->Nombre;
                $tipoT = $arrayDeRequerimientos[$clave]->Tipo;
                $sql = mysqli_query($conexion,"INSERT INTO `Becas_Requisistos` (`ID_requisito`, `ID_beca`, `Nombre`, `Tipo`) 
                                            VALUES (NULL, '$id', '$nombreT', '$tipoT'); ");
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>La beca ha sido registrada exitosamente </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }else{
        echo "no se pudo cargar";
    }
}else{
    echo "a ocurrido un error";
}

?>