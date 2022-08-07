$(document).ready(function(){
    $("#bs-modal-add").on('click',function(){
        setVisibleModalAdd();
    });
    setTableUsuarios();
    $("#btn-add-usuario").on('click',function(){
        saveNewUser();
    });
});

function setTableUsuarios(){
    $.ajax({
        "url"     : "?q=Cfg/tablaUsuarios",
        "method"  : "POST",
        afterSend : function(){
            $("#cargar_tabla_usuarios").html('<div class = "alert alert-info" role = "alert">Cargando Informacion....</div>')
        },
        success   : function(data){
            $("#cargar_tabla_usuarios").html(data);
            $("#listado-usuarios").DataTable();
            $("#listado-usuarios").css("width","100%");
        }
    });
}

function deleteUser(id){
    $.post('?q=Cfg/eliminarUsuario',{"id":id},function(resp){
        if(resp == "1"){
            alert("Usuario Eliminado con Exito");
            setTableUsuarios();
        }else if(resp == "0"){
            alert("Error al Eliminar Usuario");
        }else{
            console.log(resp);
        }
    });
}

function setVisibleModalAdd() {
    var op = {
        "backdrop" : true
    };
    var bs_modal_add = new bootstrap.Modal(document.getElementById('bs-modal-agregar'),op);
    bs_modal_add.show();
}

function modalEdit(id){
    var op = {
        "backdrop": true
    };
    var modalEdit = new bootstrap.Modal(document.getElementById('bs-modal-contenido'), op);
    $.post('?q=Cfg/formEditUser',{"id":id},function(resp){
        $("#cargar_ventana").html(resp);
        modalEdit.show();
    });
}

function updateUser(id){
    var username = $("#ed_username").val();
    var userpass = $("#ed_userpass").val();
    var usermail = $("#ed_usermail").val();
    var userrol  = $("#rol-select").val();
    if(username == "" || username.length == 0){
        $("#ed_username").vail("");
        $("#ed_username").focus();
        alert("Asegurece de Llenar el Campo Nombre de Usuario Correctamente.");
    }else if(userpass == "" || userpass.length == 0){
        $("#ed_userpass").vail("");
        $("#ed_userpass").focus();
        alert("Asegurece de Llenar el Campo Contraseña Correctamente.");
    } else if (usermail == "" || usermail.length == 0) {
        $("#ed_usermail").vail("");
        $("#ed_usermail").focus();
        alert("Asegurece de Llenar el Campo Correo Electronico Correctamente.");
    } else if (userrol == 0) {
        alert("Seleccione un Tipo de Permisologia Valido.");
    }else{
        var arr = {
            "id"       : id,
            "username" : username,
            "userpass" : userpass,
            "usermail" : usermail,
            "userrol"  : userrol            
        };
        $.post('?q=Cfg/updateUser', arr, function (resp) {
            if (resp == "1") {
                alert("Usuario Actualizado con Exito.");
                setTableUsuarios();
            } else if (resp == "0") {
                alert("Error al Actualizar Usuario.");
            } else {
                console.log(resp);
            }
        });
    }
}

function saveNewUser(){
    var username = $("#user-name").val();
    var userpass = $("#user-pass").val();
    var usermail = $("#user-mail").val();
    var userrol =  $("#user-rol").val();
    if(username == "" || username.length == 0){
        $("#user-name").vail("");
        $("#user-name").focus();
        alert("Asegurece de Llenar el Campo Nombre de Usuario Correctamente.");
    }else if(userpass == "" || userpass.length == 0){
        $("#user-pass").vail("");
        $("#user-pass").focus();
        alert("Asegurece de Llenar el Campo Contraseña Correctamente.");
    } else if (usermail == "" || usermail.length == 0) {
        $("#user-mail").vail("");
        $("#user-mail").focus();
        alert("Asegurece de Llenar el Campo Correo Electronico Correctamente.");
    } else if (userrol == 0) {
        alert("Seleccione un Tipo de Permisologia Valido.");
    }else{
        var arr = {
            "username" : username,
            "userpass" : userpass,
            "usermail" : usermail,
            "userrol"  : userrol
        };
        $.ajax({
            "url"    : "?q=Cfg/setNewUser",
            "method" : "POST",
            "data"   : arr,
            success  : function(data){
                if(data == "1"){
                    alert("Usuario Creado con Exito...!");
                    setTableUsuarios();
                }else if(data == "0"){
                    alert("Error al Crear Usuario...!");
                }else{
                    console.log(data);
                }
            }
        });
    }
}