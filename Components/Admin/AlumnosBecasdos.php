<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1>Alumnos becados</h1>
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
              <h3 class="card-title">Tabla de alumnos becados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Matrícula</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Programa educativo</th>
                  <th>Grado</th>
                  <th>Grupo</th>
                  <th>Cuatrimestre</th>
                  <th>Beca seleccionada</th>
                  <th>Estado de la beca</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                        include("../../Php/Conexion.php");
                        $consultaDeSolicitudes = "SELECT * FROM `AlumnosBecados`;";
                        $ejeucionSQL = mysqli_query($conexion, $consultaDeSolicitudes);
                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                    ?>
                    <tr>
                      <td><?php echo $datosTabla['Matricula']; ?></td>
                      <td><?php echo $datosTabla['Nombre']; ?></td>
                      <td><?php echo $datosTabla['Apellidos']; ?></td>
                      <td><?php echo $datosTabla['Carrera']; ?></td>
                      <td><?php echo $datosTabla['Grado']; ?></td>
                      <td>Grupo:<?php echo substr($datosTabla['Grupo'],2,1); ?></td>
                      <td><?php echo substr($datosTabla['Cuatrimestre'],7,13); ?></td>
                      <td><?php echo $datosTabla['Beca']; ?></td>
                      <td><?php echo $datosTabla['estado']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                <th>Matrícula</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Programa educativo</th>
                  <th>Grado</th>
                  <th>Grupo</th>
                  <th>Cuatrimestre</th>
                  <th>Beca seleccionada</th>
                  <th>Estado de la beca</th>
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
