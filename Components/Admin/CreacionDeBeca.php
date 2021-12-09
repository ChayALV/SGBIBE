<?php
include("../../Php/ListadoDeCuatrimestres.php");
$cuatris = new Cuatrimestres();
$ciclos = $cuatris->conexionWebServices();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crea una beca</h1>
          </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>La lista de requerimientos de beca debe tener minimo un elemento para evitar problemas a futuro </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Creación de becas</h3>
                </div>
                <form id="frmSubirImagen" action="../../Php/altaBeca.php" method="POST" role="form" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre de la beca</label>
                            <input type="text" class="form-control" id="nombre" required name="nombre" placeholder="Introduce el nombre">
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
                          <label>Fecha de incio</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" id="fechaDeInico" required name="fechaDeInico" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label>Fecha de finalización</label>
                            <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                <input type="text" id="fechaDeFin" required id="fechaDeFin" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
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
                            <label for="exampleInputEmail1">(Opcional)El proceso de registro se ara en:</label>
                            <input type="text" class="form-control" id="link"  name="link" placeholder="Introduce el link de la plataforma">
                        </div>
                         <div class="form-group">
                            <label>Descripción de beca</label>
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripción ..."></textarea>
                        </div>
                        <input type="file" name="imagen" id="imagen" required accept="image/*" />
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-success" onclick="VistaPrebia();">Vista previa</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-4">
          <!-- /.card -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Requerimientos de beca</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="tabla_usuaarios">
              <form action="" method="post" id="requerimientos">
                <div class="row">
                    <div class="col-5">
                      <input type="text" class="form-control" id="nombreRequerimiento" placeholder="Nombre">
                    </div>
                    <div class="col-4">
                      <input type="text" class="form-control" id="tipoRequerimiento" placeholder="Formato">
                    </div>
                    <div class="col-3">
                      <button type="button" onclick="TablaDeRequemientos();" class="btn btn-success">Agregar</button>
                    </div>
                </div>
              </form>
              <table class="mt-3 table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Formato</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="tabla">
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <th>Formato</th>
                    <th>Opciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-4">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Vista previa</h3>
                </div>
                <div class="card-body" id="VistaPrevia">
                    <h3>Vista previa</h3>
                </div>
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <script>
   $(function () {
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    $('#reservationdate1').datetimepicker({
        format: 'L'
    });
  });
  </script>
