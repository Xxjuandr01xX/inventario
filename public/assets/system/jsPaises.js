$(document).ready(function(){
    $("#bs-modal-add").on('click',function(){
        set_visible_modal('bs-modal-agregar');
    });
    set_inputMask();
    $("#btn-add-pais").on('click',function(){
        save_pais();
    });
    $("#listado-paises").dataTable();
});

function set_visible_modal(id_modal){
    var op = {
        "backdrop" : true
    };
    var modalObj = new bootstrap.Modal(document.getElementById(id_modal),op);
    modalObj.show();
}

function ModalEditNac(id){
    $.post('?q=Cfg/formEditarPais',{"id": id}, function (resp) {
        $("#cargar_ventana").html(resp);
        set_visible_modal('bs-modal-contenido');
        inputMaskEdit();
    });
}

function editarPais(id){
    var edt_cod_tel = $("#edt_cod_tel").val();
    var edt_tip_doc = $("#edt_tip_doc").val();
    var edt_des_nac = $("#edt_des_nac").val();
    if (edt_cod_tel == "" || edt_cod_tel.length == 0) {
        $("#edt_cod_tel").focus();
        $("#edt_cod_tel").val("");
        alert("Asegurece de Llenar el Campo Codigo de Telefono Correctamente.");
    } else if (edt_tip_doc == "" || edt_tip_doc.length == 0) {
        $("#edt_tip_doc").focus();
        $("#edt_tip_doc").val("");
        alert("Asegurece de Llenar el Campo Descripcion Correctamente.");
    } else if (edt_des_nac == "" || edt_des_nac.length == 0) {
        $("#edt_des_nac").focus();
        $("#edt_des_nac").val("");
        alert("Asegurece de Llenar el Campo Tipo de Documento Correctamente.");
    } else {
        var arr = {
            "id"      : id, 
            "edt_cod_tel" : edt_cod_tel, 
            "edt_tip_doc" : edt_tip_doc, 
            "edt_des_nac" : edt_des_nac
        };
        $.post('?q=Cfg/updateNacionalidades',arr,function (resp) {
            if (resp == "1") {
                alert("Pais Editado con Exito.");
                window.location.href = "?q=Cfg/Paises";
            } else if (resp == "0") {
                alert("Error al Editar Pais");
            } else {
                console.log(resp);
            }
        });
    }
}

function deleteNacionalidad(id){
    $.post('?q=Cfg/deleteNac', { "id": id }, function (resp) {
        if (resp == "1") {
            alert("Pais Eliminado con Exito.");
            window.location.href = "?q=Cfg/Paises";
        } else if (resp == "0") {
            alert("Error al Eliminar Pais");
        } else {
            console.log(resp);
        }
    });
}

function set_inputMask() {
    $("#cod_tel").inputmask({
        "mask":"+999"
    });
    $("#tip_doc").inputmask({
        "mask":"A.-"
    });
}

function inputMaskEdit(){
    $("#edt_cod_tel").inputmask({
        "mask": "+999"
    });
    $("#edt_tip_doc").inputmask({
        "mask": "A.-"
    });
}

function save_pais(){
    var cod_tel = $("#cod_tel").val();
    var tip_doc = $("#tip_doc").val();
    var des_nac = $("#des_nac").val();
    if(cod_tel == "" || cod_tel.length == 0){
        $("#cod_tel").focus();
        $("#cod_tel").val("");
        alert("Asegurece de Llenar el Campo Codigo de Telefono Correctamente.");
    }else if(des_nac == "" || des_nac.length == 0){
        $("#tip_doc").focus();
        $("#tip_doc").val("");
        alert("Asegurece de Llenar el Campo Descripcion Correctamente.");
    } else if (tip_doc == "" || tip_doc.length == 0) {
        $("#des_nac").focus();
        $("#des_nac").val("");
        alert("Asegurece de Llenar el Campo Tipo de Documento Correctamente.");
    }else{
        $.post('?q=Cfg/savePais', { "cod_tel": cod_tel, "des_nac": des_nac, "tip_doc":tip_doc},function(resp){
            if(resp == "1"){
                alert("Pais Registrado con Exito.");
                window.location.href = "?q=Cfg/Paises";
            }else if(resp == "0"){
                alert("Error al Registrar Pais");
            }else{
                console.log(resp);
            }
        });
    }
}