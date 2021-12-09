function AlertaLogin(){
    //Variables donde se almacena el valor del form LOGIN(index.html)
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var datos = "EmailOrMatricula="+email+"&Password="+password;
    //Funcion ajax
    $.ajax({
        url: 'Php/LogIn.php',
        type: 'POST',
        data: datos,
    })
    .done(function(res){
        $('#Respuesta-Alerta').html(res);        
    })
}