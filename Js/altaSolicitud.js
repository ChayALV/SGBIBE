$(document).ready(function () {
    var frm = $("#frmSubirImagen");
    var btnEnviar = $("button[type=submit]");

    var textoSubir = btnEnviar.text();
    var textoSubiendo = "Cargando imágen";

    frm.bind("submit",function () {
    
        var frmData = new FormData;
        frmData.append("imagen",$("input[name=imagen]")[0].files[0]);
  
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
        });
        return false;
    });
});