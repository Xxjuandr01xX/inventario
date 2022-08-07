$(document).ready(function(){
    $("#bs-modal-add").on('click',function(){
        set_visible_modal('bs-modal-agregar');
    });
    $("#btn-add-servicio").on('click', function () {
        newService();
    });
});

function set_visible_modal(id_modal) {
    var op = {
        "backdrop": true
    };
    var modalObj = new bootstrap.Modal(document.getElementById(id_modal), op);
    modalObj.show();
}

function newService() {
    var den_service = $("#den_service").val();
    if (den_service == "" || den_service.length == 0){
        $("#den_service").focus();
        $("#den_service").val("");
        alert("Asegurece de Llenar el Campo Denominacion del Servicio Correctamente.");
    }else{
        $.post("?q=Cfg/newService",{"den_service": den_service},function(resp){
            if(resp == "1"){
                alert("Servicio Agregado con Exito.");
                window.location.href = "?q=Cfg/Servicios";
            }else if(resp == "0"){
                alert("Error al Agregar Servicio.");
            }else{
                console.log($resp);
            }
        });
    }
}