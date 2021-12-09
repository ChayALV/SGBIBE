<?php
require_once("../../Php/Conexion.php");
$id = $_POST['ID'];
$consultaDeBeca = mysqli_query($conexion,"SELECT * FROM `Becas` WHERE ID_beca = $id");
include("../../Php/ListadoDeCuatrimestres.php");
$cuatris = new Cuatrimestres();
$ciclos = $cuatris->conexionWebServices(); 
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-12">
            <div id="respuesta">

            </div>
          </div>
          <div class="col-sm-6">
            <h1>Actualización de becas</h1>
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
                <h3 class="card-title">Actualiza los datos de esta beca</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a onclick="ActualizaV()" class="btn btn-success">Regresar</a>
                <div class="col-12 mt-3">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Formulario de actualización</h3>
                        </div>
                        <form id="frmSubirImagen" action="../../Php/actualizaBeca.php" method="POST" role="form" enctype="multipart/form-data">
                            <?php while($datos = $consultaDeBeca->fetch_array()){  ?>
                            <div class="card-body">
                                <input type="text" class="form-control" id="id" name="id"  value="<?php echo $datos['ID_beca']?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre de la beca</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $datos['Nombre']?>">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de beca</label>
                                    <select class="custom-select" id="tipoBeca" name="tipoBeca">
                                        <?php 
                                        include("../../Php/Conexion.php");
                                        $consultaDeTipoDeBecas = "SELECT * FROM `Tipo_de_becas`;";
                                        $ejeucionSQL = mysqli_query($conexion, $consultaDeTipoDeBecas);
                                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                                        ?>
                                        <option value="<?php echo $datosTabla['ID_Tipo'] ?>"><?php echo $datosTabla['Tipo_de_beca'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label>Fecha de inicio</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" id="fechaDeInico" name="fechaDeInico" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php echo $datos['fecha_de_inicio']?>"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label>Fecha de finalización</label>
                                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                        <input type="text" id="fechaDeFin" id="fechaDeFin" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php echo $datos['Fecha_De_Expiracion']?>"/>
                                        <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label>Cuatrimestre</label>
                                  <select class="custom-select" id="cuatrimestre" name="cuatrimestre">
                                    <?php 
                                        foreach($ciclos as $key => $value){ 
                                            $cve_nivel = $value['cve_nivel'];
                                            if($cve_nivel == 5){
                                    ?>
                                                <option><?php echo $value['ciclo']; ?></option>
                                    <?php 
                                            }
                                        } 
                                    ?> 
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Descripción de beca</label>
                                    <textarea class="form-control" rows="3" id="descripcion" name="descripcion"><?php echo $datos['Descripcion']?></textarea>
                                </div>
                                <input type="file" name="imagen" id="imagen" accept="image/*" />
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
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
<script>
$(document).ready(function () {
    var frm = $("#frmSubirImagen");
    var btnEnviar = $("button[type=submit]");

    var textoSubir = btnEnviar.text();
    var textoSubiendo = "Cargando imágen";

    frm.bind("submit",function () {
    
        var frmData = new FormData;
        frmData.append("imagen",$("input[name=imagen]")[0].files[0]);
        frmData.append("nombre",$("#nombre").val());
        frmData.append("tipoBeca",$("#tipoBeca").val());
        frmData.append("fechaDeInico",$("#fechaDeInico").val());
        frmData.append("fechaDeFin",$("#fechaDeFin").val());
        frmData.append("descripcion",$("#descripcion").val());
        frmData.append("cuatrimestre",$("#cuatrimestre").val());
        frmData.append("id",$("#id").val());
        
  
        $.ajax({
            url: frm.attr("action"),
            type: frm.attr("method"),
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (data) {
                btnEnviar.html(textoSubiendo);
                btnEnviar.attr("disabled",true);
            },
            success: function (data) {
                btnEnviar.html(textoSubir);
                btnEnviar.attr("disabled",false);
                console.log(data);
                $('#respuesta').html(data);
                document.getElementById("frmSubirImagen").reset();
            }
        })
        .done(function(res){
          window.scrollTo( 10000,  0);
        });
        return false;
    });
});
function ActualizaV(){
    $.ajax({
        url: '../../Components/Admin/VistaDeBecas.php',
        type: 'POST',
    })
    .done(function(res){
        $('#contenido').html(res);
    })
}
</script>