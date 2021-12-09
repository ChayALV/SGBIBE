function VistaPrebia(){
    //variables 
    var nombre = document.getElementById('nombre').value;
    var tipoDeBeca = document.getElementById('tipoBeca').value;
    var descripcion = document.getElementById('descripcion').value;
    var fechaInici = document.getElementById('fechaDeInico').value;
    var fechaFin = document.getElementById('fechaDeFin').value;

    var archivo = document.getElementById("imagen").files[0];
    
    
    document.getElementById('VistaPrevia').innerHTML = `
    <div class="card" style="width: 18rem;">
    <img id="img" class="card-img-top" alt="...">
    <div class="card-body">
    <h3 class=""><strong>${nombre}</strong></h3>
    <h5 class="">Vigencia: <strong>${fechaInici}</strong> a <strong>${fechaFin}</strong></h5>
    <p class="card-text">${descripcion.substr(0, 150)}.</p>
    <a href="#" class="btn btn-success">Solicitar beca</a>
    </div>
    </div>
    `;
    
    var reader = new FileReader();
    if (imagen) {
        reader.readAsDataURL(archivo );
        reader.onloadend = function () {
        document.getElementById("img").src = reader.result;
        }
    }
}