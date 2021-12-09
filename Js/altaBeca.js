var requerimientos = [];
$(document).ready(function () {
    var frm = $("#frmSubirImagen");
    var btnEnviar = $("button[type=submit]");

    var textoSubir = btnEnviar.text();
    var textoSubiendo = "Cargando imágen";

    frm.bind("submit",function () {
        var frmData = new FormData;
        frmData.append("imagen",$("input[name=imagen]")[0].files[0]);
        frmData.append("nombre",$("#nombre").val());
        frmData.append("tipoBeca",$("#tipoBeca").val());
        frmData.append("fechaDeInico",$("#fechaDeInico").val());
        frmData.append("fechaDeFin",$("#fechaDeFin").val());
        frmData.append("descripcion",$("#descripcion").val());
        frmData.append("cuatrimestre",$("#cuatrimestre").val());
        frmData.append("link",$("#link").val());
        frmData.append("arrayDeRequerimientos", JSON.stringify(requerimientos));
        
  
        $.ajax({
            url: frm.attr("action"),
            type: frm.attr("method"),
            data: frmData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function (data) {
                btnEnviar.html(textoSubiendo);
                btnEnviar.attr("disabled",true);
            },
            success: function (data) {
                btnEnviar.html(textoSubir);
                btnEnviar.attr("disabled",false);
                console.log(data);
                document.getElementById("frmSubirImagen").reset();
            }
        })
        .done(function(res){
            window.scrollTo( 10000,  0);
            location.href='Becas.php'
        });
        return false;
    });
});

function TablaDeRequemientos(){
    function ObjRequerimiento(nombre, tipo){
        this.Nombre = nombre;
        this.Tipo = tipo; 
    }
    var nombreRequermiento = document.getElementById('nombreRequerimiento').value;
    var tipoRequemiento = document.getElementById('tipoRequerimiento').value;
    nuevoRequerimiento = new ObjRequerimiento(nombreRequermiento, tipoRequemiento);
    document.getElementById("requerimientos").reset();
    agregar();
    tabla();
}
function agregar(){
    requerimientos.push(nuevoRequerimiento);
}
function tabla(){
    document.getElementById('tabla').innerHTML =``;
    requerimientos.forEach(function(data, index){
        document.getElementById('tabla').innerHTML +=`
        <tr>
            <td>${data.Nombre}</td>
            <td>${data.Tipo}</td>
            <td><button type="button" onclick="eliminar(${index});" class="btn btn-danger">Eliminar</button></td>
        </tr>`;
    });
}
function eliminar(i){
    requerimientos.splice(i,1);
    tabla();
}
function envidoDeDato(){

}