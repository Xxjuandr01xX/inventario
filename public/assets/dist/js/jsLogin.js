$(document).ready(function(){
    __Constructor();
});

function __Constructor() {
    $("#btn-submit").on('click', function (e) {
        /**
         * Evento para inicio de session
         */
        e.preventDefault();
        __LogIn();
    });
}

let __LogIn = () => {
    var username = $("#input-username").val();
    var password = $("#input-password").val();
    if (username == "" || username.length == 0){
        $("#input-username").val("");
        $("#input-username").focus();
        alert("DEBE LLENAR EL CAMPO NOMBRE DE USUARIO CORRECTAMENTE !!");
    } else if (password == "" || password.length == 0){
        $("#input-password").val("");
        $("#input-password").focus();
        alert("DEBE LLENAR EL CAMPO CONTRASEÑA CORRECTAMENTE !!");
    }else{
        $.ajax({
            url: "?q=Home/verificar",
            method : "POST",
            data   : {
                "user" : username,
                "pass" : password
            },
            beforeSend: function(){
                alert_top_info("cargar-alerta", "CARGANDO !!"); 
            }
        }).done(function(msg){
            console.log(msg);
            if (msg == "0") {
                alert_top_danger("cargar-alerta", "DATOS INCORRECTOS VERIFIQUE !!");
            } else if (msg == "1"){
                $("#cargar-alerta").html("");
                alert_top_success("cargar-alerta", "DATOS CORRECTOS, INICIANDO SESSION !!");
               // __Url("Dashboard","Index");
               window.location.href = "?q=Dashboard/Index";
            }
        });
    }
}