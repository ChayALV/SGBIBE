<?php
require_once("../../Php/Conexion.php");
$consultaDeCategoriaBeca = mysqli_query($conexion,"SELECT * FROM `Tipo_de_becas`");

?>
<div id="contenido">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div id="Respuesta">
        </div>
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1>Becas</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vista general de las distintas becas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php while ($TiposDeBeca = $consultaDeCategoriaBeca->fetch_array()) {?>
                  <h1><?php echo $TiposDeBeca['Tipo_de_beca'] ?></h1>
                  <div class="row">
                      <?php 
                        $tipo = $TiposDeBeca['ID_Tipo'];
                        $consultaDeBecas = mysqli_query($conexion,"SELECT * FROM `Becas` WHERE ID_Tipo = $tipo"); 
                        while ($Becas = $consultaDeBecas->fetch_array()) {
                      ?>
                        <div class="col-3">
                          <div class="card" style="width: 20rem;">
                            <img src="../<?php echo $Becas['IMG_portado'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h3 class=""><strong><?php echo $Becas['Nombre'] ?></strong></h3>
                              <h5 class="">Vigencia: <strong><?php echo $Becas['fecha_de_inicio'] ?></strong> a <strong><?php echo $Becas['Fecha_De_Expiracion'] ?></strong></h5>
                              <h5><strong>Cuatrimestre: </strong><?php echo $Becas['cuatrimestre'] ?></h5>
                              <p class="card-text"><?php echo substr($Becas['Descripcion'], 0 ,151) ?>.</p>
                              <a onclick="ActualizaV(<?php echo $Becas['ID_beca'] ?>)" class="btn btn-success">Editar</a>
                                <?php 
                                  if($Becas['estado'] == 'Activa'){
                                    $estado = '<a href="../../Php/desactivaBeca.php?ID='.$Becas['ID_beca'].'&ESTADO='.$Becas['estado'].'" class="btn btn-danger">Desactivar</a>';
                                    echo $estado;
                                  }else{
                                    $estado = '<a href="../../Php/desactivaBeca.php?ID='.$Becas['ID_beca'].'&ESTADO='.$Becas['estado'].'" class="btn btn-warning">Activar</a>';
                                    echo $estado;
                                  }
                                ?>
                                <a onclick="EliminarB(<?php echo $Becas['ID_beca'] ?>)" class="btn btn-danger">Eliminar</a>
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
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.container-wraper -->
</div>
</div>

<script>
  function ActualizaV(ID){
    var datos = "ID="+ID;
    $.ajax({
        url: '../../Components/Admin/formActualiza.php',
        type: 'POST',
        data: datos,
    })
    .done(function(res){
        $('#contenido').html(res);
    })
}
function EliminarB(ID){
    var datos = "ID="+ID;
    $.ajax({
        url: '../../Php/eliminaBeca.php',
        type: 'POST',
        data: datos,
    })
    .done(function(res){
        $('#Respuesta').html(res);
        window.scrollTo( 10000,  0);
        setTimeout(function(){
                location.reload();
            },1500);
    })
}
</script>


