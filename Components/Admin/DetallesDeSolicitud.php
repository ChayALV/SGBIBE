<?php
require_once("../../Php/Conexion.php");
$idSolicitud = $_POST['IDsolicitud'];
$rutasDeArchivo = mysqli_query($conexion,"SELECT * FROM `requisitosByNombre` WHERE ID_solicitud = '$idSolicitud'");
$datosDelAlumno = mysqli_query($conexion,"SELECT * FROM `solicitudesV` WHERE ID_solicitud = '$idSolicitud'");
$email ='';
?>
<div id="respuesta"></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-6">
            <h1>Solicitudes de beca más recientes</h1>
            <a href="PaginaSolicitudes.php">
                <button class="btn btn-success mt-2">Volver</button>
            </a>
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
              <h3 class="card-title">Detalles de solicitud</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h1>Informacion del alumno</h1>
                <?php while ($datosAlumno = $datosDelAlumno->fetch_array()) {?>
                        <h3><strong>Matricula:</strong><?php echo $datosAlumno['Matricula'] ?> </h3>
                        <h3><strong>Nombre:</strong><?php echo $datosAlumno['NombreAlumno'] ?> <?php echo $datosAlumno['Apellidos'] ?> </h3>
                        <h3><strong>Grado:</strong> <?php echo $datosAlumno['Grado'] ?> <strong>Grupo:</strong> <?php echo substr($datosAlumno['Grupo'],2,1) ?></h3>
                        <h3><strong>Cuatrimestre:</strong><?php echo substr($datosAlumno['Cuatrimestre'],8,12) ?> </h3>
                        <h3><strong>Carrera:</strong><?php echo $datosAlumno['Carrera'] ?></h3>
                        <h3><strong>Email: </strong><?php echo $datosAlumno['Email'] ?></h3>
                        <?php $email = $datosAlumno['Email'] ?>
                    <hr class="my-3">
                    <h1>Beca solcitada</h1>
                    <h3><strong>Nombre de la beca:</strong> <?php echo $datosAlumno['Nombre'] ?> </h3>
                    <h3><strong>Fecha de vencimiento:</strong> <?php echo $datosAlumno['Fecha_De_Expiracion'] ?> </h3>
                    <h3><strong>Fecha de solicitud:</strong> <?php echo $datosAlumno['fecha_de_solicitud'] ?> </h3>
                    <h3><strong>Estado de la beca:</strong> <?php echo $datosAlumno['Valor'] ?></h3>
                <?php }?>
                <hr class="my-3">
                <h1>Documentos subidos</h1>
                <?php while ($rutas = $rutasDeArchivo->fetch_array()) {?>
                    <div class="col-12 mb-1">
                        <a class="btn btn-success btn-lg" href="../<?php echo $rutas['Ruta'] ?>" download="<?php echo $rutas['Nombre'] ?>_<?php echo $rutas['Solicitud'] ?>"><?php echo $rutas['Nombre'] ?></a>
                    </div>
                    <div class="col-12 mb-3">
                    <div class="form-check">
                            <input class="form-check-input" type="checkbox" onchange="agregaDoc('<?php echo $rutas['Nombre'] ?>')" value="<?php echo $rutas['Nombre'] ?>" id="<?php echo $rutas['Nombre'] ?>">
                            <label class="form-check-label" for="flexCheckDefault">
                                <h5>Reportar documento</h5>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" id="idSolicitud" value="<?php echo $rutas['ID_solicitud'] ?>">
                <?php }?>
                <div class="">
                    <h1>Agrega un Comentario</h1>
                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Comentario ..."></textarea>
                    </div>
                    <button class="btn btn-success mt-2" onclick="envioDeDatos()">Reportar Solicitud</button>
                </div>
                <hr class="my-4">

                <button type="button" onclick="aceptarOrRechazar('<?php echo $idSolicitud ?>',1, '<?php echo $email ?>')" class="btn btn-success">Aprobar Beca</button>
                <button type="button" onclick="aceptarOrRechazar('<?php echo $idSolicitud ?>',0, '<?php echo $email ?>')" class="btn btn-danger">Rechazar Beca</button>

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
<script>
var datosDeSolicitus = [];
var idsRutas = [];
function envioDeDatos(){
    function ObjDatos(idDoc, idSolicitud, comentario,){
        this.idDoc = idDoc;
        this.idSolicitud = idSolicitud;
        this.comentario = comentario;
    }
    var solicitudID = document.getElementById('idSolicitud').value;
    var comentContent = document.getElementById('descripcion').value;
    nuevosDatos = new ObjDatos(idsRutas,solicitudID,comentContent);
    agregarDato();
    $.ajax({
        type: "POST",
        url: "../../Php/ActualizaSolicitudAdmin.php",
        data: {'array': JSON.stringify(datosDeSolicitus)}
    })
    .done(function(res){
        $('#respuesta').html(res); 
        datosDeSolicitus = [];
        window.scrollTo( 10000,  0);

    });
}
function agregarDato(){
    datosDeSolicitus.push(nuevosDatos);
}
function agregaDoc(idR){
    var idRuta = document.getElementById(idR).checked;
    var Ruta = document.getElementById(idR).value;
    if (idRuta) {
        idsRutas.push(idR);
    }else{
        eliminaDelArray(idsRutas, idR)
    }
    console.log(datosDeSolicitus);
}
function eliminaDelArray(arr, item){
    var i = arr.indexOf( item );
    if (i !== -1) {
        arr.splice(i,1);
        console.log(arr);
    }
}
function aceptarOrRechazar(id,estado, email){
    var datos = "ID="+id+"&Estado="+estado+"&EMAIL="+email;
    $.ajax({
      type: "POST",
      url: "../../Php/RechazoAndAprovacion.php",
      data: datos
    })
    .done(function(res){
      $("#respuesta").html(res); 
      window.scrollTo( 10000,  0);
    });
  }
</script>