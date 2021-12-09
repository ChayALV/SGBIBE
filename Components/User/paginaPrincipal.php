<?php
$matricula = $_SESSION['matricula'];
require_once("../../Php/Conexion.php");
$consultaDeCategoriaBeca = mysqli_query($conexion,"SELECT * FROM `Tipo_de_becas`");
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-12"  id="contenedor">
            <?php include('../../Components/User/MensajeAlumno.php') ?>
            <div class="card mt-2 bordesRedondeados">
              <div class="p-3">
                <h1 class="display-4">Becas disponibles</h1>
              </div>
              <div class="card-body" >
                <?php while ($TiposDeBeca = $consultaDeCategoriaBeca->fetch_array()) {?>
                    <hr class="my-4">
                  <h1>Becas del tipo: <?php echo $TiposDeBeca['Tipo_de_beca'] ?></h1>
                  <div class="row">
                      <?php 
                        $tipo = $TiposDeBeca['ID_Tipo'];
                        $consultaDeBecas = mysqli_query($conexion,"SELECT * FROM `Becas` WHERE ID_Tipo = $tipo AND estado = 'Activa'"); 
                        while ($Becas = $consultaDeBecas->fetch_array()) {
                      ?>
                      <div class="col-3 " id="tarjeta">
                          <div class="card " style="width: 20rem;">
                            <img src="../<?php echo $Becas['IMG_portado'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h3 class=""><strong><?php echo $Becas['Nombre'] ?></strong></h3>
                              <h5 class="">Vigencia: <strong><?php echo $Becas['fecha_de_inicio'] ?></strong> a <strong><?php echo $Becas['Fecha_De_Expiracion'] ?></strong></h5>
                              <h5><strong>Cuatrimestre: </strong><?php echo $Becas['cuatrimestre'] ?></h5>
                              <p class="card-text"><?php echo substr($Becas['Descripcion'], 0 ,151) ?>.</p>
                              <a onclick="solicitudBeca(<?php echo $Becas['ID_beca'] ?>, '<?php echo $Becas['IMG_portado'] ?>')" class="btn btn-success">Solicitar</a>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                  </div>
                <?php } ?>
                <!-- /.ROW -->
              </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
</div>
<script>
    function solicitudBeca(idDeBeca, imagen){
        //Variables donde se almacena el valor del form LOGIN(index.html)
        var datos = "ID="+idDeBeca+"&IMG="+imagen;
        //Funcion ajax
        $.ajax({
            url: '../../Components/User/solicitudDeBeca.php',
            type: 'POST',
            data: datos,
        })
        .done(function(res){
            $('#contenedor').html(res);        
        })
    }
</script>