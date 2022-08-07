$(document).ready(function(){
    tablaTickets();
});

function tablaTickets(){
    $.ajax({
        "method"  : "POST",
        "url"     : "?q=Taller/getTicketTable",
        afterSend : function(){
            $("#div-cargar-tabla").html(
                '<div class = "alert alert-info" role = "alert"> Cargando Informacion...</div>'
            );
        },
        success  : function(data){
            $("#div-cargar-tabla").html(data);
            $("#listado-tickets").DataTable();
        }
    });
}

function delete_ticket(id){
    $.post('?q=Taller/EliminarTicket',{"id":id},function(resp){
        if(resp == "1"){
            alert("Incidencia Eliminada con Exito..!");
            tablaTickets();
        }else if(resp == "0"){
            alert("Error al Eliminar Incidencia...!");
        }else{
            console.log(resp);
        }
    });
}

function change(id_ticket){
    var op = {
        "backdrop" : true
    }
    var modalChange = new bootstrap.Modal(document.getElementById('bs-modal-contenido'), op);
    $.ajax({
        "method"  : "POST",
        "url"     : "?q=Taller/getFormChange",
        "data": { "id": id_ticket},
        afterSend : function(){
            modalChange.show();
            $("#cargar_ventana").html('<div class = "alert alert-info" role="alert">Cargando Informacion...</div>');
        },
        success  : function(data){
            modalChange.show();
            $("#cargar_ventana").html(data);
        }
    });
}

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

function actualizar_ticket(id){
    var fec_fin         = setLabelSql("dat_fin");
    var observacion     = $("#text-obs").val();
    var ticket_estatus  = $("#sel-est").val();
    var estado_equipo   = $("#sts-select").val();
    if(fec_fin == "" || fec_fin.length == 0){
        alert("Debe Asignar una Fecha de Culminacion para la Incidencia.");
    }else if(observacion == "" || observacion.length == 0){
        alert("Debe Agregar una Observacion a la Incidencia.");
    }else if(ticket_estatus == "" || ticket_estatus.length == 0){
         alert("Eliga un Estaus para la Incidencia.");
    }else if (estado_equipo == "" || estado_equipo.length == 0) {
        alert("Verifique el Estado en el que se Encuentra el Equipo.");
    }else{
        var arr = {
            "id"          : id,
            "fec_fin"     : fec_fin,
            "observ"      : observacion,
            "est_equipo"  : estado_equipo,
            "sts_ticket"  : ticket_estatus
        };
        $.ajax({
            "method"   : "POST",
            "url"      : "?q=TAller/actualizarTicket",
            "data"     : arr,
            beforeSend : function(){

            },
            success    : function(resp){
                if(resp == "1"){
                    alert("Ticket Actualizado con Exito!");
                    tablaTickets();
                }else if(resp == "0"){
                    alert("Error al Actualizar Ticket!");
                }else{
                    console.log(resp);
                }
            }
        });
    }
}