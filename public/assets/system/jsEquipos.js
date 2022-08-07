$(document).ready(function(){
    /**
     *  Se inicializa la ventana modal para agregar 
     *  equipos al catalogo.
     */
    var options = {
        "backdrop" : true
    }

    var myModal = new bootstrap.Modal(document.getElementById('bs-modal'), options);

    document.getElementById('bs-btn-modal').addEventListener('click', function (e) {
        e.preventDefault();
        myModal.show();
    });
    /**
     * FIN
     */

    inputMaskInit();
    tablaEquipos();
    $("#btn-save").on('click',function(e){
        e.preventDefault();
        validateItems();
    });
});

function inputMaskInit(){
    var eq_costo     = $("#eq-costo");
    var eq_cod     = $("#eq-cod");
    var eq_iva       = $("#eq-iva");
    var eq_pvp       = $("#eq-pvp");
    var eq_exist_min = $("#eq-exist-min");
    var eq_exist_max = $("#eq-exist-max");

    eq_iva.inputmask({
        "mask":"9.99"
    });

    eq_cod.inputmask({
        "mask" : "99999999"
    });

    eq_cod.val("00000001");
}

function edit(id){ 
    var options = { "backdrop": true }
    var myModal = new bootstrap.Modal(document.getElementById('bs-edit-modal'), options);
    $.post('?q=Equipos/formEdit',{"id":id},function(data){
        data = $.parseJSON(data);
        console.log(data);
        $('#edit_den').val(data.denominacion);
        $('#edit_mar').val(data.marcar);
        $('#edit_mod').val(data.modelo);
        $('#edit_costo').val(data.costo);
        $('#edit_iva').val(data.iva);
        $('#edit_pvp').val(data.pvp);
        $('#edit_exist_min').val(data.existencia_minima);
        $('#edit_exist_max').val(data.existencia_maxima);
        $("#btn_edit").attr("onclick","actualizarEquipo("+data.id+");");
    });
    myModal.show();
}

function Delete(id){
    $.post('?q=Equipos/deleteDivice',{"id":id},function(resp){
        if(resp == "0"){
            alert("ERROR AL ELIMINAR EQUIPO");
        }else if(resp == "1"){
            alert("EQUIPO ELIMINADO CON EXITO!");
            tablaEquipos();
        }else{
           console.log(resp);
        }
    });
}


function cargar(id){
    var options = { "backdrop": true }
    var myModal = new bootstrap.Modal(document.getElementById('bs-cargar-modal'), options);
    $.post('?q=Equipos/stockForm',{"id":id},function(data){
        data = $.parseJSON(data);
        $("#td-denominacion").text(data.denominacion);
        $("#td-marca").text(data.marcar);
        $("#td-modelo").text(data.modelo);
        $("#btn-cargar").attr("onclick", "cargarStock("+data.id+")");
    });
    myModal.show();
}

function cargarStock(id){
    var cantidad = $("#stock-input").val();
    if (cantidad == "" || cantidad.length == 0 || cantidad < 1){
        $("#stock-input").focus();
        $("#stock-input").val("");
        alert("Asegurece de llenar la existencia Correctamente.");
    }else{
        $.post('?q=Equipos/cargarStock', { "id": id, "cantidad": cantidad }, function (resp) {
            if (resp == "1") {
                alert("Existencia Cargada con Exito");
                tablaEquipos();
            } else if (resp == "0") {
                alert("Error al Cargar Existencia");
            } else {
                console.log(resp);
            }
        });
    }
}


function validateItems() {
    var eq_den          =   $("#eq-den").val();  
    var eq_mar          =   $("#eq-mar").val();
    var eq_mod          =   $("#eq-mod").val();
    var eq_costo        =   $("#eq-costo").val();
    var eq_iva          =   $("#eq-iva").val();
    var eq_pvp          =   $("#eq-pvp").val();
    var eq_exist_min    =   $("#eq-exist-min").val();
    var eq_exist_max    =   $("#eq-exist-max").val();
    var eq_prov         =   $("#eq-prov").val();
    var eq_cod          =   $("#eq-cod").val();
    if(eq_den == '' || eq_den.length == 0){
        $("#eq-den").val("");
        $("#eq-den").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO DENOMINACION CORRECTAMENTE.");
    }else if(eq_mar == '' || eq_mar.length == 0){
        $("#eq-mar").val("");
        $("#eq-mar").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO MARCA CORRECTAMENTE. ");
    } else if (eq_mod == '' || eq_mod.length == 0) {
        $("#eq-mod").val("");
        $("#eq-mod").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO MODELO CORRECTAMENTE. ");
    } else if (eq_costo == '' || eq_costo.length == 0) {
        $("#eq-costo").val("");
        $("#eq-costo").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO COSTO CORRECTAMENTE. ");
    } else if (eq_iva == '' || eq_iva.length == 0) {
        $("#eq-iva").val("");
        $("#eq-iva").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO IVA CORRECTAMENTE. ");
    } else if (eq_pvp == '' || eq_pvp.length == 0) {
        $("#eq-pvp").val("");
        $("#eq-pvp").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO PVP CORRECTAMENTE. ");
    } else if (eq_exist_min == '' || eq_exist_min.length == 0) {
        $("#eq-exist-min").val("");
         $("#eq-exist-min").focus();
         alert("ASEGURECE DE LLENAR EL CAMPO EXISTENCIA MINIMA CORRECTAMENTE.");
    } else if (eq_exist_max == '' || eq_exist_max.length == 0) {
        $("#eq-exist-max").val("");
         $("#eq-exist-max").focus();
         alert("ASEGURECE DE LLENAR EL CAMPO EXISTENCIA MAXIMA CORRECTAMENTE.");
    } else if (eq_prov == 0) {
        $("#eq-prov").val("");
        $("#eq-prov").focus();
        alert("POR FAVOR SELECCIONE A UN PROVEEDOR DE LA LISTA.");
    }else if (eq_cod == "" || eq_cod.length == 0) {
        $("#eq-cod").val("");
        $("#eq-cod").focus();
        alert("DEBE ASIGNARLE UN CODIGO AL PRODUCTO.");
    }else{
        var arr = {
            "eq_den"        : eq_den,
            "eq_mar"        : eq_mar,
            "eq_mod"        : eq_mod,
            "eq_costo"      : eq_costo,
            "eq_iva"        : eq_iva,
            "eq_pvp"        : eq_pvp,
            "eq_exist_min"  : eq_exist_min,
            "eq_exist_max"  : eq_exist_max,
            "eq_prov"       : eq_prov, 
            "eq_cod"       : eq_cod 
        }
        insert_divice(arr);
    }
}

function insert_divice(arr) {
    $.post('?q=Equipos/insert_divice',arr,function(data){
        console.log(data);
        if(data == "1"){
            alert("EQUIPO REGISTRADO CON EXITO !");
            tablaEquipos();
        }else if(data == "0"){
            alert("ERROR AL INSERTAR EQUIPO.");
        }else if(data == "duplicate"){
            alert("EL EQUIPOS YA SE ENCUENTRA REGISTRADO EN EL SISTEMA.");
        }
    });
}

function tablaEquipos() {
    $.post('?q=Equipos/tablaEquipos',function(data){
        console.log(data);
        $("#cargar-Tabla-equipos").html(data);
        $("#equipos").dataTable();
    })
}

function editar(id){
    $.post('?q=Equipos/delete', { "cod": id }, function (msg) {
        console.log(msg);
        if (msg == "0") {
            alert("ERROR AL EDITAR EQUIPO.");
        } else if (msg == "1") {
            alert("EQUIPO MODIFICADO CON EXITO.");
        }
    });
}

function actualizarEquipo(id){
    var edit_den        = $("#edit_den").val();
    var edit_mar        = $("#edit_mar").val();
    var edit_mod        = $("#edit_mod").val();
    var edit_costo      = $("#edit_costo").val();
    var edit_iva        = $("#edit_iva").val();
    var edit_pvp        = $("#edit_pvp").val();
    var edit_exist_min  = $("#edit_exist_min").val();
    var edit_exist_max  = $("#edit_exist_max").val();
    var edit_prov       = $("#edit_prov").val();

    if (edit_den == '' || edit_den.length == 0) {
        $("#edit_den").val("");
        $("#edit_den").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO DENOMINACION CORRECTAMENTE.");
    } else if (edit_mar == '' || edit_mar.length == 0) {
        $("#edit_mar").val("");
        $("#edit_mar").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO MARCA CORRECTAMENTE. ");
    } else if (edit_mod == '' || edit_mod.length == 0) {
        $("#edit_mod").val("");
        $("#edit_mod").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO MODELO CORRECTAMENTE. ");
    } else if (edit_costo == '' || edit_costo.length == 0) {
        $("#edit_costo").val("");
        $("#edit_costo").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO COSTO CORRECTAMENTE. ");
    } else if (edit_iva == '' || edit_iva.length == 0) {
        $("#edit_iva").val("");
        $("#edit_iva").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO IVA CORRECTAMENTE. ");
    } else if (edit_pvp == '' || edit_pvp.length == 0) {
        $("#edit_pvp").val("");
        $("#edit_pvp").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO PVP CORRECTAMENTE. ");
    } else if (edit_exist_min == '' || edit_exist_min.length == 0) {
        $("#edit_exist_min").val("");
        $("#edit_exist_min").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO EXISTENCIA MINIMA CORRECTAMENTE.");
    } else if (edit_exist_max == '' || edit_exist_max.length == 0) {
        $("#edit_exist_max").val("");
        $("#edit_exist_max").focus();
        alert("ASEGURECE DE LLENAR EL CAMPO EXISTENCIA MAXIMA CORRECTAMENTE.");
    } else if (edit_prov == 0) {
        $("#edit_prov").val("");
        $("#edit_prov").focus();
        alert("POR FAVOR SELECCIONE A UN PROVEEDOR DE LA LISTA.");
    } else {
        var arr = {
            "edit_den"       : edit_den,
            "edit_mar"       : edit_mar,
            "edit_mod"       : edit_mod,
            "edit_costo"     : edit_costo,
            "edit_iva"       : edit_iva,
            "edit_pvp"       : edit_pvp,
            "edit_exist_min" : edit_exist_min,
            "edit_exist_max" : edit_exist_max,
            "edit_prov"      : edit_prov,
            "id"             : id
        }
        $.post('?q=Equipos/actualizarEquipo',arr,function(resp){
            if(resp == "1"){
                alert("Equipos Actualizado con Exito.");
            }else if(resp == "0"){
                alert("Error al Actualizar Equipo.");
            }else{
                console.log(resp);
            }
        });
    }
}
