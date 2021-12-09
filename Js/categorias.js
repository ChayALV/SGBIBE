function envioDeDatosC() {
  var nombre = document.getElementById("Nombre").value;
  var datos = "Nombre=" + nombre;
  console.log(nombre);
  $.ajax({
    type: "POST",
    url: "../../Php/altaCategira.php",
    data: datos,
  }).done(function (res) {
    $("#Respuesta").html(res);
    setTimeout(function () {
      location.reload();
      //Código a ejecutar
    }, 1500);
  });
}
function eliminarCategoria(idCategoria) {
  var categoria = "idCategoria=" + idCategoria;
  $.ajax({
    type: "POST",
    url: "../../Php/eliminaCategoria.php",
    data: categoria,
  }).done(function (res) {
      setTimeout(function () {
          location.reload();
          //Código a ejecutar
        }, 500);
    $("#Respuesta").html(res);
  });
}
function actualizaCategoria(idCategoria){
    var nombreCategoria = document.getElementById('nombreCat'+idCategoria).value;
    var datos = "idCategoria="+idCategoria+"&Nombre="+nombreCategoria;
    console.log(datos);
    $.ajax({
        type: "POST",
        url: "../../Php/actualizaCategoria.php",
        data: datos,
      }).done(function (res) {
        $("#Respuesta").html(res);
        });
}