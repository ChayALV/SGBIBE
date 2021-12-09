function validarPassword (p1, p2){
    var p1 = document.getElementById('Contraseña').value;
    var p2 = document.getElementById('ConfirContraseña').value;
    
    if(p1 === p2){
        return true;
    }else{
        return false;
    }
}
function envioDeDatos(){
    var nombre = document.getElementById('Nombre').value;
    var apellidos = document.getElementById('Apellidos').value;
    var caro = document.getElementById('Cargo').value;
    var email = document.getElementById('Email').value;
    var password = document.getElementById('Contraseña').value;
    var passwordConfirm = document.getElementById('ConfirContraseña').value;
    var rol = document.getElementById('ID_rol').value;

    
    var validacion = validarPassword(password ,passwordConfirm);
    if(validacion){
        var datos = "Nombre="+nombre+"&Apellidos="+apellidos+"&Cargo="+caro+"&Email="+email+"&Password="+password+"&ID_rol="+rol;
        $.ajax({
            type: "POST",
            url: "../../Php/altaUsuario.php",
            data: datos,
        })
        .done(function(res){
            $('#Respuesta').html(res);
            setTimeout(function(){
                location.reload();
            },1500);
        });
    }else{
        document.getElementById('Respuesta').innerHTML=`
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!!!</strong> las contrasenas no coinciden.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;
    }
}