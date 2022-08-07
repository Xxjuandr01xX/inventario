$(document).ready(function(){
    inputDateInit();
    $("#btn_buscar").on('click',function(e){
        e.preventDefault();
        buscarFacturas();
    });
});

function inputDateInit(){
    $("#date_ini").inputmask({
        "mask":"99/99/9999"
    });
    $("#date_fin").inputmask({
        "mask":"99/99/9999"
    });
}

function inputTosql(inputId){
    var input = document.getElementById(inputId).value;
    var arr   = input.split("/");
    return arr[2]+"-"+arr[1]+"-"+arr[0];
}

function buscarFacturas(){
    var fech_ini = inputTosql('date_ini');
    var fech_fin = inputTosql('date_fin');
    if (fech_ini == "" || fech_ini.length == 0) {
        alert("Debe llenar el campo Fecha de Inicio correctamente.");
        $("#date_ini").val("");
        $("#date_ini").focus();
    } else if (fech_fin == "" || fech_fin.length == 0){
        alert("Debe llenar el campo Fecha de Fin correctamente.");
        $("#date_fin").val("");
        $("#date_fin").focus();
    }else{
        $.post('?q=Equipos/buscarFacturas',{"ini":fech_ini,"fin":fech_fin},function(data){
            console.log(data);
            $("#contenido_facturas").html(data);
            //$("#lista-facturas").DataTable();
            lanzar_tabla_facturas(true);
        });
    }
}

function lanzar_tabla_facturas(boolean){
    if(boolean == true){
        $("#table_seccion").slideDown();
    }else if(boolean == false){
        $("#table_seccion").animate({
            "display":"none"
        });       
    }
}

function ver_detalle(id){
    var op = {
        "backdrop" : true
    };
    var bsModalDetalle = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),op);
    $.post('?q=Equipos/detalleFactura',{"id_factura":id},function(data){
        $("#cargar_ventana").html(data);
        bsModalDetalle.show();
    });
}