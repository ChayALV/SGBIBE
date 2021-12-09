<?php
session_start();
$matricula = $_SESSION['matricula'];
$id = $_POST['ID'];
$img = $_POST['IMG'];
require_once("../../Php/Conexion.php");
$consultaDeBeca = mysqli_query($conexion,"SELECT * FROM `Becas` WHERE ID_beca = $id");
$consultaDeRequisitosDeBeca = mysqli_query($conexion,"SELECT * FROM `Becas_Requisistos` WHERE ID_beca = $id");
$formulariowhile = mysqli_query($conexion,"SELECT * FROM `Becas_Requisistos` WHERE ID_beca = $id");
?>
<div class="overflow">
    <img class="uno" src="../<?php echo $img ?>" width="100%">
</div>
<div class="card mt-2 bordesRedondeados mb-3">
    <div class="card-body">
        <div class="p-3 mt-3">
            <button class="btn btn-success bordesRedondeados" onclick="volver();"> Volver</button>
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
                <?php if (empty($datosDeBeca['Link'])) { ?>
                    <h3> formulario de registro</h3>
                    <form method="POST" enctype="multipart/form-data" action="../../Php/prueba.php">
                        <input type="hidden" name="ID_beca" value="<?php echo $datosDeBeca['ID_beca'] ?>">
                        <input type="hidden" name="Matricula" value="<?php echo $matricula ?>">
                        <?php
                            while($formulario = $formulariowhile->fetch_array()){
                        ?>
                        <div class="mb-2">
                            <label for="email" class="form-label"><?php echo $formulario['Nombre'] ?></label>
                            <div class="input-group">
                                <input type="file" class="form-control" name="<?php echo $datosDeBeca['ID_beca'] ?>_<?php echo $formulario['ID_requisito'] ?>" required aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04"><?php echo $formulario['Nombre'] ?></button>
                            </div>
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-success bordesRedondeados"> Solicitar BECA </button>
                    </form>
                <?php }else {?>
                    <h3>El proceso para solicitar esta beca es en el siguiente LINK</h3>
                    <a href="<?php echo $datosDeBeca['Link'] ?>"> Haz click aqui para continuar con el proceso</a>
                <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<script>
    function volver(){
        setTimeout(function(){
                location.reload();
                //Código a ejecutar
            },5);
    }
</script>