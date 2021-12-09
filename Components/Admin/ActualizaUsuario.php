<?php
require_once("../../Php/Conexion.php");
$sql = mysqli_query($conexion,"SELECT * FROM Roles");
$id = $_GET['idUsuario'];
$usuario = mysqli_query($conexion,"SELECT * FROM `Usuarios` WHERE `Usuarios`.`ID_usuario` = '$id';");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
          
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Actualización de usuario</h1>
            <a href="PaginaCreacionUsuarios.php">
                <button type="button" class="btn btn-success">Regresar</button>
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="d-flex justify-content-center">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Actualización de usuarios</h3>
                </div>
                <form action="../../Php/actualizaUsuario.php" method="post">
                    <div class="card-body">
                        <?php while ($datos = $usuario->fetch_array()){ ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" name="Nombre" placeholder="Introduce el nombre" value="<?php echo $datos['Nombre'] ?>">
                            <input type="hidden" class="form-control" name="ID" placeholder="Introduce el nombre" value="<?php echo $datos['ID_usuario'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Apellidos</label>
                            <input type="text" class="form-control" name="Apellidos" placeholder="Introduce los apellidos" value="<?php echo $datos['Apellidos'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cargo</label>
                            <input type="text" class="form-control" name="Cargo" placeholder="Introduce el cargo" value="<?php echo $datos['Cargo'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="Email" placeholder="Introduce el email" value="<?php echo $datos['Email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Rol de usuario</label>
                            <select class="custom-select" id="ID_rol" name="ID_rol">
                                <?php 
                                  while($datosR=$sql->fetch_array()){
                                ?>
                                <option value="<?php echo $datosR['ID_rol'] ?>"><?php echo $datosR['Nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contraseña</label>
                            <input type="password" class="form-control" name="Contraseña" placeholder="Introduce la contraseña" value="<?php echo $datos['Password'] ?>">
                        </div>
                    <?php } ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

