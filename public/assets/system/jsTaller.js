$(document).ready(function(){
    inputMaskInit();
    $("#btn_cli").on('click',function(e){
        e.preventDefault();
        ModalClientes();
    });
    $("#btn_usr").on('click',function(e){
        e.preventDefault();
        ModalUsuarios();
    });
    $("#btn_sts").on('click',function(e){
        e.preventDefault();
        ModalStatusEquipo();
    });
    $("#btn_save_ticket").on('click',function(e){
        e.preventDefault();
        newTicket();
    });
});

function setLabelSql(id){
    var value   = document.getElementById(id).value;
    var date    = value.split("/");
    var dateSql = null;
    if(value == "" || value.length == 0){
        alert("Asegurece de Llenar el campo de Fecha.");
    }else{
        dateSql = date[2]+"-"+date[1]+"-"+date[0];
    }
    return dateSql;
}

function newTicket(){
    var des_ticket     = $("#ta-des").val();
    var dni_cliente    = getDniCliente();
    var username       = getUsernameBtn();
    var desde          = setLabelSql("fec_ini");
    var tipo_servicio  = $("#sel_serv").val();
    var  des_equipo    = $("#des_eqp").val();
    var  nro_equipo    = $("#nro_eqp").val();
    var btn_estado     = getEstadoEquipo();
    var costo_servicio = $("#cos_ser").val();
    
    if(des_ticket == "" || des_ticket.length == 0){
        $("#ta-des").focus();
        $("#ta-des").val("");
        alert("Asegurece de Llenar el Campo Descripcion del Ticket.");
    }else if(des_equipo == "" || des_equipo.length == 0){
        $("#des_eqp").val("");
        $("#des_eqp").focus();
        alert("Asegurece de Colocar la Descripcion del Equipo a Reparar.");
    }else if(nro_equipo == "" || nro_equipo.length == 0){
        $("#nro_eqp").val("");
        $("#nro_eqp").focus();
        alert("Asegurece de Colocar la Cantidad de Equipos a Reparar.");
    }else if(costo_servicio == "" || costo_servicio.length == 0){
        $("#cos_ser").val("");
        $("#cos_ser").focus();
        alert("Asegurece de Colocar un Costo al Soporte.");
    }else{
        var Arr = {
            "des_ticket"    : des_ticket,
            "cli_ticket"    : dni_cliente,
            "usr_ticket"    : username,
            "fec_ini"       : desde,
            "serv_ticket"   : tipo_servicio,
            "des_equipo"    : des_equipo,
            "nro_equipo"    : nro_equipo,
            "est_equipo"    : btn_estado,
            "cos_servicio"  : costo_servicio,
        };
        $.ajax({
            "url"    : "?q=Taller/newTicket",
            "method" : "POST",
            "data"   : Arr,
            afterSend: function(){
                $("#cargarAlertas").html('<div class="alert alert-primary" role="alert">'+
                                            'Procesando ...'+
                                        '</div >');
            },
            success : function(data){
                console.log(data);
                if(data == "1"){
                    alert("Ticket Creado con Exito..!");
                    inputReformat();
                }else if(data == "0"){
                    alert("Error al Crear Ticket..!");
                }
            }
        });
    }
}

function inputMaskInit(){
    $("#fec_ini").inputmask({
        "mask" : "99/99/9999"
    });
    $("#fec_fin").inputmask({
        "mask" : "99/99/9999"
    }); 
}

function getDniCliente(){
    var btn_text    = document.getElementById('btn_cli').innerText;
    var dni_nombre  = btn_text.split("-");
    var arrced      = dni_nombre[1].split(":");
    return arrced[0];
}

function getUsernameBtn(){
    var btn_text = document.getElementById('btn_usr').innerText;
    var username = btn_text.split("-");
    return username[1];
}

function getEstadoEquipo(){
    var btn_text = document.getElementById('btn_sts').innerText;
    var estado = btn_text.split("-");
    return estado[1];
}

function ModalUsuarios(){
    var op = {
        "backdrop" : true
    };
    var modalUsuarios = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),op);
    $.post('?q=Taller/setModalUsuarios',function(data){
        $("#cargar_ventana").html(data);
        $("#lista-usuarios").css("width","100%");
        $("#lista-usuarios").DataTable();
        modalUsuarios.show();
    });
}

function btnUsuarios(id){
    $.post('?q=Taller/setBtnUsuario',{"id":id},function(data){
        $("#btn_usr").html(data);
        $("#btn_usr").attr("class","btn btn-warning btn-sm p-3 rounded-0");
    });
}

function ModalClientes(){
    var op = {
        "backdrop" : true
    };
    var modalClientes = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),op);
    $.post('?q=Taller/setModalClientes',function(data){
        $("#cargar_ventana").html(data);
        $("#lista-clientes").css("width","100%");
        $("#lista-clientes").DataTable();
        modalClientes.show();
    });
}

function btnCliente(id){
    $.post('?q=Taller/setBtnCliente',{"id":id},function(data){
        $("#btn_cli").html(data);
        $("#btn_cli").attr("class","btn btn-warning btn-sm p-3 rounded-0");
    });
}

function ModalStatusEquipo(){
    var op ={
        "backdrop" : true
    }
    var modalSts = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),op);
    $.post('?q=Taller/setModalStatusEq',function(data){
       $("#cargar_ventana").html(data);
        $("#lista-sts").css("width","100%");
        $("#lista-sts").DataTable();
        modalSts.show();
    });
}

function btnStatusEquipo(id){
     $.post('?q=Taller/setBtnStatusEquipo',{"id":id},function(data){
        $("#btn_sts").html(data);
        $("#btn_sts").attr("class","btn btn-info btn-sm p-2 rounded-0");
    });
}

function inputReformat(){
    $("#ta-des").val("");
    $("#sel_serv").val("");
    $("#des_eqp").val("");
    $("#nro_eqp").val("");
    $("#cos_ser").val("");
    $("#fec_ini").val("");
    $("#fec_fin").val("");
    $("#btn_usr").attr("class", "btn btn-outline-warning btn-sm p-3 rounded-0");
    $("#btn_cli").attr("class", "btn btn-outline-warning btn-sm p-3 rounded-0");
    $("#btn_sts").attr("class", "btn btn-outline-info btn-sm p-2 rounded-0");
    $("#btn_usr").html(
        "<span class = 'bi-person-circle'></span> -- Asignar Soportista --"
    );
    $("#btn_cli").html(
        "<span class = 'bi-person-circle'></span> -- Seleccione Cliente --"
    );
    $("#btn_sts").html(
        "<span class = 'bi-person-circle'></span> -- Seleccione Estatus --"
    );

}