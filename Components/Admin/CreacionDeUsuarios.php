<?php
require_once("../../Php/Conexion.php");
$sql = mysqli_query($conexion,"SELECT * FROM Roles");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
          
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
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
                  <h3 class="card-title">Registro de usuarios</h3>
                </div>
                <form action="" method="post" id="formUsuario">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" placeholder="Introduce el nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellidos</label>
                            <input type="text" class="form-control" id="Apellidos" placeholder="Introduce los apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cargo</label>
                            <input type="text" class="form-control" id="Cargo" placeholder="Introduce el cargo" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="Email" placeholder="Introduce el email" required>
                        </div>
                        <div class="form-group">
                            <label>Rol de usuario</label>
                            <select class="custom-select" id="ID_rol" name="ID_rol">
                                <?php 
                                  while($datos=$sql->fetch_array()){
                                ?>
                                <option value="<?php echo $datos['ID_rol'] ?>"><?php echo $datos['Nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contraseña</label>
                            <input type="password" class="form-control" id="Contraseña" placeholder="Introduce la contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirme contraseña</label>
                            <input type="password" class="form-control" id="ConfirContraseña" placeholder="Confirma la contraseña" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="envioDeDatos();" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-8">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">usuarios</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID de usuario</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Cargo</th>
                  <th>Email</th>
                  <th>Contraseña</th>
                  <th>Rol</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="recarga">
                    <?php 
                        include("../../Php/Conexion.php");
                        $consultaDeUsuario = "SELECT Usuarios.ID_usuario, Usuarios.Nombre, Usuarios.Apellidos, Usuarios.Cargo, Usuarios.Email , Usuarios.Password, Roles.Nombre AS rol FROM `Usuarios` 
                                                  INNER JOIN Roles ON Usuarios.ID_rol = Roles.ID_rol ORDER BY ID_usuario ASC; ;";
                        $ejeucionSQL = mysqli_query($conexion, $consultaDeUsuario);
                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                    ?>
                    <tr>
                      <td><?php echo $datosTabla['ID_usuario']; ?></td>
                      <td><?php echo $datosTabla['Nombre']; ?></td>
                      <td><?php echo $datosTabla['Apellidos']; ?></td>
                      <td><?php echo $datosTabla['Cargo']; ?></td>
                      <td><?php echo $datosTabla['Email']; ?></td>
                      <td><?php echo $datosTabla['Password']; ?></td>
                      <td><?php echo $datosTabla['rol']; ?></td>
                      <td>
                        <a href="actualizaUsuario.php?idUsuario=<?php echo $datosTabla['ID_usuario']; ?>">
                        <button type="button" class="btn btn-success">Actualizar</button>
                      </a>
                        <button type="button" onclick="eliminaUsuario('<?php echo $datosTabla['ID_usuario']; ?>')" class="btn btn-danger">Elimina</button>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID de usuario</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Cargo</th>
                  <th>Email</th>
                  <th>Contraseña</th>
                  <th>Rol</th>
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
<script>
function eliminaUsuario(id){
 var datos = "ID="+id;
 $.ajax({
   type: "POST",
   url: "../../Php/eliminacionDeUsusarios.php",
   data: datos,
 })
 .done(function(res){
   $('#Respuesta').html(res);
   setTimeout(function(){
                location.reload();
            },1500);
 });
}

</script>
