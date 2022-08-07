$(document).ready(function(){
    var q = $_GET('q');
    switch (q) {
        case 'Clientes/nuevo':
            input_init();  
            $("#btn-save").on('click', function (e) {
                e.preventDefault();
                __sendDataClientes();
            });      
            break;

        case 'Clientes/listado':
            __dataTableInit();
            break;

        case 'Clientes/editar':
            input_init();
            $("#btn-edit").on('click', function (e) {
                e.preventDefault();
                __UpdateClientes();
            });
            break;
    
        default:
            console.log('NULL OPERATION....')
            break;
    }
});

function eliminarClliente(id){
    $.post("?q=Clientes/eliminarCliente",{"id":id},function(msg){
        console.log(msg);
        if(msg == "0"){
            alert_top_danger("cargarAlertas","ERROR AL ELIMINAR CLIENTES");
        }else if (msg == "1"){
            $("#cargarAlertas").css('display','none');
            $("#cargarAlertas").html('<div class="alert alert-success " role="alert">El cliente se ha eliminado con Exito.</div>');
            $("#cargarAlertas").slideDown(1000);
            __dataTableInit();
        }
    });
}


function __formEditar(id){
    window.location.href = '?q=Clientes/editar&cod='+id;
}

function input_init(){
    $("#input-telefono").inputmask({
        "mask": "(9999) - 9999999"
    });
}

function __dataTableInit(){
    $.ajax({
        url       : "?q=Clientes/tablaClientes",
        method    : 'POST',
        afterSend : function(msg){
            alert_top_warning('cargar_tabla_clientes','CARGANDO DATOS....');
        },
        success    : function(msg){
            $("#cargar_tabla_clientes").html(msg);
            $('#clientesTable').dataTable();
        }
    });
}


function __UpdateClientes(){
    var nacionalidad = $("#select_pais").val();
    var cedula       = $("#input-cedula").val();
    var nombre       = $("#input-nombre").val();
    var apellido     = $("#input-apellido").val();
    var telefono     = $("#input-telefono").val();
    var correo       = $("#input-email").val();
    var direccion    = $("#input-direccion").val(); 

    if (nacionalidad == "" || nacionalidad.length == 0 || /^\s+$/.nacionalidad) {
        alert("DEBE SELECCIONAR UN PAIS.");
    } else if (cedula == "" || cedula.length == 0 || /^\s+$/.cedula) {
        $("#input-cedula").val("");
        $("#input-cedula").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo cedula correctamente.")
    } else if (nombre == "" || nombre.length == 0 || /^\s+$/.nombre) {
        $("#input-nombre").val("");
        $("#input-nombre").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo nombre correctamente.")
    } else if (apellido == "" || apellido.length == 0 || /^\s+$/.apellido) {
        $("#input-apellido").val("");
        $("#input-apellido").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo apellido correctamente.")
    } else if (telefono == "" || telefono.length == 0 || /^\s+$/.telefono) {
        $("#input-telefono").val("");
        $("#input-telefono").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo telefono correctamente.")
    } else if (correo == "" || correo.length == 0 || /^\s+$/.correo) {
        $("#input-correo").val("");
        $("#input-correo").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo correo correctamente.")
    } else if (direccion == "" || direccion.length == 0 || /^\s+$/.direccion) {
        $("#input-direccion").val("");
        $("#input-direccion").focus();
        alert_top_warning("cargarAlertas", "Debe llenar el campo direccion correctamente.")
    } else {
        var campos = {
            "nacionalidad"  : nacionalidad,
            "cedula"        : cedula,
            "nombre"        : nombre,
            "apellido"      : apellido,
            "telefono"      : telefono,
            "correo"        : correo,
            "direccion"     : direccion
        }
        $.ajax({
            method: "POST",
            url: "?q=Clientes/editarClientes",
            data: campos,
            afterSend: function (msg) {
                alert_top_info("cargarAlertas", "CARGANDO INFORMACION.");
            },
            success: function (msg) {
                if(msg == "0"){
                    alert_top_danger("cargarAlertas", "Error al modificar informacion.");
                } else if (msg == "1"){
                    alert_top_success("cargarAlertas", "Informacion modificada con Exito.");
                    window.location.href = "?q=Clientes/listado";
                }
            }
        });
    }
}

function __sendDataClientes(){
    var nacionalidad = $("#select_pais").val();
    var cedula       = $("#input-cedula").val();
    var nombre       = $("#input-nombre").val();
    var apellido     = $("#input-apellido").val();
    var telefono     = $("#input-telefono").val();
    var correo       = $("#input-email").val();
    var direccion    = $("#input-direccion").val();
    if (nacionalidad == "" || nacionalidad.length == 0 || /^\s+$/.nacionalidad) {
        alert("DEBE SELECCIONAR UN PAIS.");
    }else if(cedula == "" || cedula.length == 0 || /^\s+$/.cedula){
        $("#input-cedula").val("");
         $("#input-cedula").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo cedula correctamente.")
    } else if (nombre == "" || nombre.length == 0 || /^\s+$/.nombre) {
        $("#input-nombre").val("");
        $("#input-nombre").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo nombre correctamente.")
    } else if (apellido == "" || apellido.length == 0 || /^\s+$/.apellido) {
        $("#input-apellido").val("");
        $("#input-apellido").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo apellido correctamente.")
    } else if (telefono == "" || telefono.length == 0 || /^\s+$/.telefono) {
        $("#input-telefono").val("");
         $("#input-telefono").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo telefono correctamente.")
    } else if (correo == "" || correo.length == 0 || /^\s+$/.correo) {
        $("#input-correo").val("");
        $("#input-correo").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo correo correctamente.")
    } else if (direccion == "" || direccion.length == 0 || /^\s+$/.direccion) {
        $("#input-direccion").val("");
        $("#input-direccion").focus();
        alert_top_warning("cargarAlertas","Debe llenar el campo direccion correctamente.")
    }else{
        var campos = {
            "nacionalidad" :nacionalidad,
            "cedula"       :cedula,
            "nombre"       :nombre,
            "apellido"     :apellido,
            "telefono"     :telefono,
            "correo"       :correo,
            "direccion"    :direccion
        }
        $.ajax({
            method: "POST",
            url   : "?q=Clientes/save",
            data: campos,
            afterSend: function(msg) {
                alert_top_info("cargarAlertas","CARGANDO INFORMACION.");
            },
            success : function (msg) {
                alert_top_success("cargarAlertas","Informacion registrada con exito.");
                window.location.href = "?q=Clientes/listado";
            }
        });
    }
}

function limpiar() {
    $("#select_pais").val();
    $("#input-cedula").val("");
    $("#input-nombre").val("");
    $("#input-apellido").val("");
    $("#input-telefono").val("");
    $("#input-email").val("");
    $("#input-direccion").val("");
}