<?php 
include("../../Php/Conexion.php");
$id = $_GET['ID_rol'];
$sql = mysqli_query($conexion,"SELECT * FROM Roles WHERE ID_rol = '$id'");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div id="Respuesta">
          
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Actualizacion de roles</h1>
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
                  <h3 class="card-title">Actualizacion de rol</h3>
                </div>
                <form action="" method="post" id="formUsuario">
                    <?php while($datos = $sql->fetch_array()){ ?>
                    <div class="card-body">
                    <a href="roles.php" class="btn btn-success">Regresar</a>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre del Rol</label>
                            <input type="text" class="form-control" id="Nombre" placeholder="Introduce el nombre" value="<?php echo $datos['Nombre'] ?>">
                        </div>
                        <input type="hidden" id="id" name="id" value="<?php echo $datos['ID_rol'] ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Breve descripción</label>
                            <input type="text" class="form-control" id="descripcion" placeholder="Introduce los apellidos" value="<?php echo $datos['Descripcion'] ?>">
                        </div>
                        <div class="form-group">
                          <p>Modulos permitidos por el usuario</p>
                          <div class="">
                            <?php $solicitudes = substr($datos['permisos'],0,1) != 0 ? 'checked' : '' ; ?>
                            <input class="" type="checkbox" id="Crear" value="1" <?php echo $solicitudes ?>>
                            <label for="customCheckbox3" class="">Solicitudes</label>
                          </div>
                          <div class="">
                            <?php $Becados = substr($datos['permisos'],1,1) != 0 ? 'checked' : '' ; ?>
                            <input class="" type="checkbox" id="Visualizar" value="2" <?php echo $Becados ?>>
                            <label for="customCheckbox4" class="">Alumnos becados</label>
                          </div>
                          <div class="">
                            <?php $Becas = substr($datos['permisos'],2,1) != 0 ? 'checked' : '' ; ?>
                            <input class="" type="checkbox" id="Actualizar" value="3" <?php echo $Becas ?>>
                            <label for="customCheckbox1" class="">Becas</label>
                          </div>
                          <div class="">
                            <?php $Usuarios = substr($datos['permisos'],3,1) != 0 ? 'checked' : '' ; ?>
                            <input class="" type="checkbox" id="Eliminar" value="4" <?php echo $Usuarios ?>>
                            <label for="customCheckbox2" class="">Creacion de usuarios</label>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="actualizaRol();" class="btn btn-success">Actualizar</button>
                    </div>
                    <?php } ?>
                </form>
            </div>
            <!-- /.card -->
        </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

<script>
    function actualizaRol(){
    var nombre = document.getElementById('Nombre').value;
    var id = document.getElementById('id').value;
    var descripcion = document.getElementById('descripcion').value;
    var pActualizar = document.getElementById('Actualizar').checked
    var pEliminar = document.getElementById('Eliminar').checked
    var pCrear = document.getElementById('Crear').checked
    var pVisualizar = document.getElementById('Visualizar').checked
    
    var datos = "Nombre="+nombre+"&Descripcion="+descripcion+"&ID="+id;
    var permisos = "A="+pCrear+"&E="+pVisualizar+"&C="+pActualizar+"&V="+pEliminar;
    var datosMasPermisos = datos+'&'+permisos;
    $.ajax({
        type: "POST",
        url: "../../Php/actualizaRol.php",
        data: datosMasPermisos,
    })
    .done(function(res){
        $('#Respuesta').html(res);
        setTimeout(function(){
            //Código a ejecutar
        },1500);
    });
}
</script>