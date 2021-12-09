<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
          
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles de usuario</h1>
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
                  <h3 class="card-title">Registro de rol</h3>
                </div>
                <form action="" method="post" id="formUsuario">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre del Rol</label>
                            <input type="text" class="form-control" id="Nombre" placeholder="Introduce el nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Breve descripcion</label>
                            <input type="text" class="form-control" id="descripcion" placeholder="Introduce los apellidos" required>
                        </div>
                        <div class="form-group">
                          <p>Modulos permitidos por el usuario</p>
                          <div class="">
                            <input class="" type="checkbox" id="Crear" value="3">
                            <label for="customCheckbox3" class="">Solicitudes</label>
                          </div>
                          <div class="">
                            <input class="" type="checkbox" id="Visualizar" value="4">
                            <label for="customCheckbox4" class="">Alumnos becados</label>
                          </div>
                          <div class="">
                            <input class="" type="checkbox" id="Actualizar" value="1">
                            <label for="customCheckbox1" class="">Becas</label>
                          </div>
                          <div class="">
                            <input class="" type="checkbox" id="Eliminar" value="2">
                            <label for="customCheckbox2" class="">Creacion de usuarios</label>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="altaRol();" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-8">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID del rol</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Código de permisos</th>
                  <th>Permisos</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody id="recarga">
                    <?php 
                        include("../../Php/Conexion.php");
                        $consultaDeUsuario = "SELECT * FROM `Roles`;";
                        $ejeucionSQL = mysqli_query($conexion, $consultaDeUsuario);
                        while($datosTabla=mysqli_fetch_array($ejeucionSQL)){
                    ?>
                    <tr>
                      <td><?php echo $datosTabla['ID_rol']; ?></td>
                      <td><?php echo $datosTabla['Nombre']; ?></td>
                      <td><?php echo $datosTabla['Descripcion']; ?></td>
                      <td><?php echo $datosTabla['permisos']; ?></td>
                      <td><?php echo $datosTabla['codigoDePermisos']; ?></td>
                      <td>
                        <a href="actualizaRoles.php?ID_rol=<?php echo $datosTabla['ID_rol']; ?>">
                          <button type="button" class="btn btn-success">Actualizar</button>
                        </a>
                        <button type="button" onclick="eliminaRol('<?php echo $datosTabla['ID_rol']; ?>')" class="btn btn-danger">Elimina</button>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID del rol</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Código de permisos</th>
                  <th>Permisos</th>
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
function altaRol(){
    var nombre = document.getElementById('Nombre').value;
    var descripcion = document.getElementById('descripcion').value;
    var pActualizar = document.getElementById('Actualizar').checked
    var pEliminar = document.getElementById('Eliminar').checked
    var pCrear = document.getElementById('Crear').checked
    var pVisualizar = document.getElementById('Visualizar').checked
    
    var datos = "Nombre="+nombre+"&Descripcion="+descripcion;
    var permisos = "A="+pActualizar+"&E="+pEliminar+"&C="+pCrear+"&V="+pVisualizar;
    var datosMasPermisos = datos+'&'+permisos;
    $.ajax({
        type: "POST",
        url: "../../Php/altaRol.php",
        data: datosMasPermisos,
    })
    .done(function(res){
        $('#Respuesta').html(res);
        setTimeout(function(){
            //Código a ejecutar
        },1500);
    });
}
function eliminaRol(id){
    var datos = "ID="+id;
    $.ajax({
        type: "POST",
        url: "../../Php/eliminaRol.php",
        data: datos,
    })
    .done(function(res){
        $('#Respuesta').html(res);
        setTimeout(function(){
            //Código a ejecutar
        },1500);
    });
}
</script>
