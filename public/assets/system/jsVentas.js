$(document).ready(function(){
    Init();

    $("#btn_add_client").on('click',function(e){
        e.preventDefault();
        ventanaListaClientes();
    });

    $("#btn-modal-add").on('click',function(e){
        e.preventDefault();
        ventanaAgregarProductos();
    });

    $("#btn_sale").on('click',function(e){
        e.preventDefault();
        procesarCompra();
    });
});

function Init(){
    $("#add_item").css("display","none");
    $("#row_table").css("display","none");
    $("#btn_sale").css("display","none");
}

function setBtnCliente(id){
    var options = {
        "backdrop": true
    };
    var modalListaClientes = new bootstrap.Modal(document.getElementById('bs-modal-contenido'), options);

    $.post('?q=Equipos/setBtnCliente',{"id":id},function(data){
        data = $.parseJSON(data);
        console.log(data);
        $("#btn_add_client").html("<span class = 'bi-person-fill'></span> DNI: "+data.dni_nro+" - "+data.nombre+" "+data.apellido);
        $("#btn_add_client").attr("class","btn btn-success p-4 rounded-0 mt-5");
        $("#add_item").css("display", "flex");
        $("#row_table").css("display", "flex");
        $("#btn_sale").css("display", "block");
    });
}

function ventanaAgregarProductos(){
    var options = {
        "backdrop": true
    };
    var modalListaProductos = new bootstrap.Modal(document.getElementById('bs-modal-contenido'), options);
    $.post('?q=Equipos/ventanaEquipos',function(resp){
        $("#cargar_ventana").html(resp);
        $("#listaProductos").css({
                "width"      : "100%",
                "margin-top" :"8px"
            });
        $("#listaProductos>tbody>tr").css({
            "text-align"      : "center"
        });
        $("#listaProductos").DataTable();
        modalListaProductos.show();
    });
}

function cantidadProducto(id){
     var options = {
        "backdrop": true
    };
    var bs_modal_cantidad = new bootstrap.Modal(document.getElementById('bs-modal-contenido'), options);
    $.post('?q=Equipos/formCargarCantidad',{"id":id},function(data){
        $("#cargar_ventana").html(data);
        bs_modal_cantidad.show();
    });
}

function calcularPresio(codigo,presio){
    var rows           = document.getElementsByName('rows[]');
    var celdasCodigo   = document.getElementsByName('cod[]');
    
    var filasCantidad = document.getElementsByName('cant[]');
    var filasPresiott = document.getElementsByName('pres[]');

    var input_cantidad = $("#input-cantidad").val();
    var precio_tt      = input_cantidad*presio;

    $.post('?q=Equipos/verificarCantidad', { "cod": codigo, "cantidad": input_cantidad},function(resp){
        if(resp == "1"){
            for (var i = 0; i < rows.length; i++) {
                if(celdasCodigo[i].innerHTML == codigo){
                    filasCantidad[i].innerHTML = input_cantidad;              
                    filasPresiott[i].innerHTML = precio_tt;            
                }
            }
        }else if(resp == "0"){
            alert("la cantidad requerida no debe exceder la existencia.");
        }else{
            console.log(resp);
        }
    });
}

function excluirDeLista(codigo){
    var rows         = document.getElementsByName('rows[]');
    var celdasCodigo = document.getElementsByName('cod[]');
    for (var i = 0; i < rows.length; i++) {
        if (celdasCodigo[i].innerHTML == codigo) {
            $("tr[name='rows[]']")[i].remove();
        }
    }
}

function setInRow(id,codigo){
    var rows         = document.getElementsByName('rows[]');
    var celdasCodigo = document.getElementsByName('cod[]');
    if(rows.length == 0){
        $.post('?q=Equipos/setInRow', { "id": id }, function (data) {
            $("#rows_prod").append(data);
            console.log(data);
        });
    }else{
        for (var i = 0; i < rows.length;i++) {
            if (celdasCodigo[i].innerHTML == codigo){
                alert("No se Puede Agregar el Mismo Equipo Dos Veces.");
            }else{
                $.post('?q=Equipos/setInRow', { "id": id }, function (data) {
                    $("#rows_prod").append(data);
                    console.log(data);
                });
            }
        }
    }
}

function setTableInArray(name) {
    var html_component = document.getElementsByName(name + "[]");
    var result = [];
    for (var i = 0; i < html_component.length; i++) {
        result[i] = html_component[i].innerHTML;
    }
    return result;
}



function procesarCompra(){
    var rows = document.getElementsByName('rows[]');
    var op = {
        "backdrop":true
    }

    var modal_procesar = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),op);

    if(rows.length == 0){
        $("#cargar_ventana").html(
            '<div class = "row clearfix d-flex justify-content-center">'+
                '<div class = "col-md-8">'+
                    '<h1 class = "display-1 text-center text-warning"><span class = "bi-shield-exclamation"></span></h1></br>'+
                    '<h4 class = " text-center text-secondary">No hay Equipos en la Tabla.</h4>' +
                '</div>'+
            '</div>');
        
        modal_procesar.show();
    } else if (rows.length > 0){
        var codigos          = setTableInArray("cod");
        var cantidades       = setTableInArray("cant");
        var p_totales        = setTableInArray("pres");
        var btnClientesText  = $("#btn_add_client").text();
        var arrCliente       = btnClientesText.split(":");
        var cliente          = arrCliente[1].split("-");
        var ced_ide          = cliente[0];
        if(codigos.length == 0){
            alert("Debe Llnar la Tabla de Articulos.");
        }else if(cantidades.length == 0){
            alert("Debe Llnar la Tabla de Articulos.");
        }else if(p_totales.length == 0){
            alert("Debe Llnar la Tabla de Articulos.");
        }else{
            var arr = {
                "cedula"      : ced_ide,
                "codigos"     : codigos,
                "cantidades"  : cantidades,
                "totales"     : p_totales
            };
            $.post('?q=Equipos/proesarCompra',arr,function(resp){
                console.log(resp);
                if (resp == "1") {
                    $("#cargar_ventana").html(
                        '<div class = "row clearfix d-flex justify-content-center">' +
                            '<div class = "col-md-8">' +
                                '<h1 class = "display-1 text-center text-success"><span class = "bi-shield-check"></span></h1></br>' +
                                '<h4 class = " text-center text-secondary">Compra Efectuada con Exito!!.</h4>' +
                            '</div>' +
                        '</div>');
                    modal_procesar.show();
                    resetPage();
                }else if(resp == "0"){
                    $("#cargar_ventana").html(
                        '<div class = "row clearfix d-flex justify-content-center">' +
                            '<div class = "col-md-8">' +
                                '<h1 class = "display-1 text-center text-danger"><span class = "bi-shield-x"></span></h1></br>' +
                                '<h4 class = " text-center text-secondary">Error al Realizar su Compra</h4>' +
                            '</div>' +
                        '</div>');
                    modal_procesar.show();
                }
            });
        }
    }
}


function resetPage(){
    var rows         = document.getElementsByName('rows[]');
    for (var i = 0; i < rows.length; i++) {
        $("tr[name='rows[]']")[i].remove();
    }
    $("#add_item").css("display","none");
    $("#row_table").css("display","none");
    $("#btn_sale").css("display","none");
    $("#btn_add_client").html("<span class = 'bi-person-fill'></span> - SELECCIONAR CLIENTE - ");
    $("#btn_add_client").attr("class","btn btn-outline-success p-4 rounded-0 mt-5");
}


function ventanaListaClientes(){
    var options = {
        "backdrop":true
    };
    var modalListaClientes = new bootstrap.Modal(document.getElementById('bs-modal-contenido'),options);
    $.ajax({
        "method"  : "POST",
        "url"     : "?q=Equipos/listaClientes",
        afterSend : function(){
            $("#cargar_ventana").html();
        },
        success   : function(data){
            $("#cargar_ventana").html(data);
            $("#listaClientes").css({
                "width"      : "100%",
                "margin-top" :"8px"
            });
            $("#listaClientes").DataTable();
            modalListaClientes.show();
        }
    });

}