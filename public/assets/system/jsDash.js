$(document).ready(function(){
    $("#cargar-dataTable").dataTable();
    $("#btn-proveedores").on('click',function(e){
        e.preventDefault();
        __Proveedores();
    });
    $("#btn-clientes").on('click',function(e){
        e.preventDefault();
        __Clientes();
    });
});
function __Proveedores(){
    window.location.href = "?q=Proveedores/listado";
}
function __Clientes(){
    window.location.href = "?q=Clientes/listado";
}


