<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
          
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorías</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Registro de una nueva categoría</h3>
                </div>
                <form action="" method="post" id="formUsuario">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre de la nueva categoría</label>
                            <input type="text" class="form-control" id="Nombre" placeholder="Introduce el nombre" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="envioDeDatosC();" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-8">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categorías</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID de categoría</th>
                  <th>Nombre</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="recarga">
                    <?php 
                        include("../../Php/Conexion.php");
                        $consultaDeUsuario = "SELECT * FROM `Tipo_de_becas` ORDER BY Tipo_de_beca ASC;";
                        $ejeucionSQL = mysqli_query($conexion, $consultaDeUsuario);
                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                    ?>
                    <tr>
                      <td><?php echo $datosTabla['ID_Tipo']; ?></td>
                      <td><input type="text" name="" value="<?php echo $datosTabla['Tipo_de_beca']; ?>" id="nombreCat<?php echo $datosTabla['ID_Tipo']; ?>"></td>
                      <td>
                        <button type="button" onclick="actualizaCategoria(<?php echo $datosTabla['ID_Tipo']; ?>)" class="btn btn-success">Actualizar</button>
                        <button type="button" onclick="eliminarCategoria(<?php echo $datosTabla['ID_Tipo']; ?>)" class="btn btn-danger">Elimina</button>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID de categoría</th>
                  <th>Nombre</th>
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

