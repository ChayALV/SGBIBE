<?php  
$mat = 'GABC7118';
$passwordAlumno = md5($mat);
?>
<div class="content-wrapper" id="contenido">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1>Solicitudes de beca más recientes</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
        <div id="respuesta">
        </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabla de solicitudes</h3>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID de la solicitud</th>
                  <th>Matricula</th>
                  <th>Nombre del alumno</th>
                  <th>Beca</th>
                  <th>Fecha de solicitud</th>
                  <th>Fecha de expiración de la beca</th>
                  <th>Estado</th>
                  <th>Comentarios</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                        include("../../Php/Conexion.php");
                        $consultaDeSolicitudes = "SELECT * FROM `solicitudesV`;";
                        $ejeucionSQL = mysqli_query($conexion, $consultaDeSolicitudes);
                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                    ?>
                    <tr>
                      <td><?php echo $datosTabla['ID_solicitud']; ?></td>
                      <td><?php echo $datosTabla['Matricula']; ?></td>
                      <td><?php echo $datosTabla['NombreAlumno']; ?> <?php echo $datosTabla['Apellidos']; ?></td>
                      <td><?php echo $datosTabla['Nombre']; ?></td>
                      <td><?php echo $datosTabla['fecha_de_solicitud']; ?></td>
                      <td><?php echo $datosTabla['Fecha_De_Expiracion']; ?></td>
                      <td><?php echo $datosTabla['Valor']; ?></td>
                      <td><?php echo $datosTabla['Comentarios']; ?></td>
                      <td>
                        <button type="button" onclick="detalleDeSolicitud('<?php echo $datosTabla['ID_solicitud']; ?>')" class="btn btn-primary">ver detalles</button>
                        <button type="button" onclick="aceptarOrRechazar('<?php echo $datosTabla['ID_solicitud']; ?>',1, '<?php echo $datosTabla['Email']; ?>')" class="btn btn-success">aceptar</button>
                        <button type="button" onclick="aceptarOrRechazar('<?php echo $datosTabla['ID_solicitud']; ?>',0, '<?php echo $datosTabla['Email']; ?>')" class="btn btn-danger">Rechazar</button>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                <th>ID de la solicitud</th>
                  <th>Matrícula</th>
                  <th>Nombre del alumno</th>
                  <th>Beca</th>
                  <th>Fecha de solicitud</th>
                  <th>Fecha de expiración de la beca</th>
                  <th>Estado</th>
                  <th>Comentarios</th>
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
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.container-wraper -->
</div>
<script>
  function detalleDeSolicitud (idSolicitud){
    var datos = "IDsolicitud="+idSolicitud;
    $.ajax({
      type: "POST",
      url: "../../Components/Admin/DetallesDeSolicitud.php",
      data: datos
    })
    .done(function(res){
      $("#contenido").html(res);
      
    });
  }
  function aceptarOrRechazar(id,estado,email){
    var datos = "ID="+id+"&Estado="+estado+"&EMAIL="+email;
    $.ajax({
      type: "POST",
      url: "../../Php/RechazoAndAprovacion.php",
      data: datos
    })
    .done(function(res){
      $("#respuesta").html(res);
      location.reload(); 
    });
  }
</script>
