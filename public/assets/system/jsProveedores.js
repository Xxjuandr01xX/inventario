$(document).ready(function(){
    var q = $_GET('q');
    switch(q){
        case 'Proveedores/listado':
            /**
             * Funcion para inicializar la tabla.
             */
            proveedoresTable();
        break;

        case 'Proveedores/nuevo':
            $("#input-rif").inputmask({
                "mask": " A - 999999999"
            });

            $("#input-tel").inputmask({
                "mask": " (9999) - 9999999"
            });
            $("#save-proveedor").on('click',function(e){
                e.preventDefault();
                __Save();
            })
        break;

        case 'Proveedores/editar':
            $("#input-rif").inputmask({
                "mask": " A - 999999999"
            });

            $("#input-tel").inputmask({
                "mask": " (9999) - 9999999"
            });

            $("#edit-proveedor").on('click', function (e) {
                e.preventDefault();
                __Edit();
            })

        break;

        default:
        break;
    }
});

function btn_edit(id){
    window.location.href = "?q=Proveedores/editar&cod="+id;
}

function btn_delete(id){
    $.post('?q=Proveedores/delete',{"cod":id},function(msg){
        console.log(msg);
        if (msg == '1') {
            alert_top_success('cargarAlertas',"PROVEEDOR ELIMINADO CON EXITO.");
            proveedoresTable();
        }else if(msg == '0'){
            alert_top_success('cargarAlerts',"ERROR AL ELIMINAR PROVEEDOR.");
        }
    });
}

function proveedoresTable(){
    $.post('?q=Proveedores/proveedoresTable',function(msg){
        if (msg != '0') {
            console.log(msg);
            $("#cargar_tabla_Proveedores").html(msg);
            $("#prov-table").dataTable();
        }else{
            alert_top_danger('cargarAlertas','NO HAY INFORMACION PARA MOSTRAR.');
        }
    });
}



function __Save(){
    var nac     = $('#select-pais').val();
    var rif     = $('#input-rif').val();
    var den     = $('#input-den').val();
    var tel     = $('#input-tel').val();
    var mail    = $('#input-mail').val();
    var dir     = $('#textArea-dir').val();
    if (nac == 0) {
        alert("DEBE SELECCIONAR UN PAIS.");
    }else if(rif == ''    || rif.length == 0  || /^\s+$/.rif){
        $('#input-rif').focus();
        $('#input-rif').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO RIF CORRECTAMENTE.");
    } else if (den == ''  || den.length == 0  || /^\s+$/.den) {
        $('#input-den').focus();
        $('#input-den').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO DENOMINACION CORRECTAMENTE.");
    } else if (tel == ''  || tel.length == 0  || /^\s+$/.tel) {
        $('#input-tel').focus();
        $('#input-tel').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO TELEFONO CORRECTAMENTE.");
    } else if (mail == '' || mail.length == 0 || /^\s+$/.mail) {
        $('#input-mail').focus();
        $('#input-mail').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO CORREO ELECTRONICO CORRECTAMENTE.");
    }else if(dir == ''    || dir.length == 0  || /^\s+$/.dir){
        $('#textArea-dir').focus();
         $('#textArea-dir').val("");
         alert("ASEGURECE DE LLENAR EL CAMPO DIRECCION CORRECTAMENTE.");
    }else{
        var obj = {
            "nac"  : nac,
            "rif"  : rif,
            "den"  : den,
            "tel"  : tel,
            "mail" : mail,
            "dir"  : dir
        }
        $.ajax({
            "method"  : "POST",
            "url"     : "?q=Proveedores/guardarProveedor",
            "data"    : obj,
            afterSend : function(){
                $("#cargarAlertas").html('<div class="alert alert-info " role="alert">CARGANDO....</div>');
                $("#cargarAlertas").slideDown(1000);
                $("#cargarAlertas").slideUp(2000);
            },
            success   : function(msg){
                console.log(msg);
                if (msg == '0') {
                    alert("ERROR AL REGISTRAR PROVEEDOR.");
                }else if(msg == '1'){
                    alert("PROVEEDOR REGISTRADO CON EXITO.");
                }else if(msg == 'duplicate'){
                    alert('EL PROVEEDOR YA HA SIDO REGISTRADO');
                }
            }
        });
    }
}

function __Edit(){
    var nac = $('#select-pais').val();
    var rif = $('#input-rif').val();
    var den = $('#input-den').val();
    var tel = $('#input-tel').val();
    var mail = $('#input-mail').val();
    var dir = $('#textArea-dir').val();
    if (nac == 0) {
        alert("DEBE SELECCIONAR UN PAIS.");
    } else if (rif == '' || rif.length == 0 || /^\s+$/.rif) {
        $('#input-rif').focus();
        $('#input-rif').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO RIF CORRECTAMENTE.");
    } else if (den == '' || den.length == 0 || /^\s+$/.den) {
        $('#input-den').focus();
        $('#input-den').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO DENOMINACION CORRECTAMENTE.");
    } else if (tel == '' || tel.length == 0 || /^\s+$/.tel) {
        $('#input-tel').focus();
        $('#input-tel').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO TELEFONO CORRECTAMENTE.");
    } else if (mail == '' || mail.length == 0 || /^\s+$/.mail) {
        $('#input-mail').focus();
        $('#input-mail').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO CORREO ELECTRONICO CORRECTAMENTE.");
    } else if (dir == '' || dir.length == 0 || /^\s+$/.dir) {
        $('#textArea-dir').focus();
        $('#textArea-dir').val("");
        alert("ASEGURECE DE LLENAR EL CAMPO DIRECCION CORRECTAMENTE.");
    } else {
        var obj = {
            "id" : $_GET('cod'),
            "nac": nac,
            "rif": rif,
            "den": den,
            "tel": tel,
            "mail": mail,
            "dir": dir
        }
        $.ajax({
            "method": "POST",
            "url": "?q=Proveedores/editarProveedor",
            "data": obj,
            afterSend: function () {
                $("#cargarAlertas").html('<div class="alert alert-info " role="alert">CARGANDO....</div>');
                $("#cargarAlertas").slideDown(1000);
                $("#cargarAlertas").slideUp(2000);
            },
            success: function (msg) {
                console.log(msg);
                if (msg == '0') {
                    alert("ERROR AL REGISTRAR PROVEEDOR.");
                } else if (msg == '1') {
                    alert("PROVEEDOR REGISTRADO CON EXITO.");
                }
            }
        });
    }
}