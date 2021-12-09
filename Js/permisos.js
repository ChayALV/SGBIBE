var req = new XMLHttpRequest(); 
req.onload = function() {
  permisos = this.responseText;
  var solicitudes = permisos.substr(0,1);
  var alumnosBecados = permisos.substr(1,1);
  var becas = permisos.substr(2,1);
  var creacionDeUsuarios = permisos.substr(3,1);
  if (solicitudes == 0) {
    document.getElementById('solicitudes').style.visibility = "hidden"; // hide
  }
   if (alumnosBecados == 0) {
    document.getElementById('alumnosBecados').style.visibility = "hidden"; // hide
  }
   if (becas == 0) {
    document.getElementById('becas').style.visibility = "hidden"; // hide
  }
   if (creacionDeUsuarios == 0) {
    document.getElementById('creacionUsuarios').style.visibility = "hidden"; // hide
  }else{
    console.log('nada por hacer');
  }
};
req.open("get", "prueba.php", true); 
req.send();