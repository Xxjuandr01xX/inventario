/* globals Chart:false, feather:false */
/*
(function () {
  'use strict'

  feather.replace()

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      datasets: [{
        data: [
          15339,
          21345,
          18483,
          24003,
          23489,
          24092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()
*/

function set_active_menu(itemId,submenuId){
  $("#"+itemId).on('click',function(e){
    e.preventDefault();
    if($("#"+submenuId).css('display') == "flex" || $("#"+submenuId).css('display') == "block"){
      $("#"+submenuId).slideUp();
    }else if($("#"+submenuId).css('display') == "none"){
      $("#"+submenuId).slideDown();
      $("#"+submenuId).css({
        "display":"block"
      });
    }
   });
}

function set_desactive_menu(arrayId){
  for (var i = 0; i < arrayId.length;i++) {
    $("#"+arrayId[i]).css({
      "display": "none"
    });
  }
}

function __dataTable__(id){
  $("#"+id).DataTable();
}

function alert_info(idComponent,mensaje,on_off){
  if(on_off == 1){
     $("#"+idComponent).attr("class","alert alert-info mt-2");
     $("#"+idComponent).text(mensaje);
     $("#"+idComponent).slideDown();
     $("#"+idComponent).css({
      "display" : "block"
     });
  }else if(on_off == 0){
    $("#"+idComponent).text(mensaje);
    $("#"+idComponent).slideUp();
    $("#"+idComponent).attr("class","component-off");
    $("#"+idComponent).css({
      "display" : "none"
     });
  }
}

function alert_success(idComponent,mensaje,on_off){
  if(on_off == 1){
     $("#"+idComponent).attr("class","alert alert-success mt-2");
     $("#"+idComponent).text(mensaje);
     $("#"+idComponent).slideDown();
     $("#"+idComponent).css({
      "display" : "block"
     });
  }else if(on_off == 0){
    $("#"+idComponent).text(mensaje);
    $("#"+idComponent).slideUp();
    $("#"+idComponent).attr("class","component-off");
    $("#"+idComponent).css({
      "display" : "none"
     });
  }
}

function alert_danger(idComponent,mensaje,on_off){
  if(on_off == 1){
     $("#"+idComponent).attr("class","alert alert-danger mt-2");
     $("#"+idComponent).text(mensaje);
     $("#"+idComponent).slideDown();
     $("#"+idComponent).css({
      "display" : "block"
     });
  }else if(on_off == 0){
    $("#"+idComponent).text(mensaje);
    $("#"+idComponent).slideUp();
    $("#"+idComponent).attr("class","component-off");
    $("#"+idComponent).css({
      "display" : "none"
     });
  }
}

function alert_warning(idComponent,mensaje,on_off){
  if(on_off == 1){
     $("#"+idComponent).attr("class","alert alert-warning mt-2");
     $("#"+idComponent).text(mensaje);
     $("#"+idComponent).slideDown();
     $("#"+idComponent).css({
      "display" : "block"
     });
  }else if(on_off == 0){
    $("#"+idComponent).text(mensaje);
    $("#"+idComponent).slideUp();
    $("#"+idComponent).attr("class","component-off");
    $("#"+idComponent).css({
      "display" : "none"
     });
  }
}

$(document).ready(function(){

  /**
    * Para menus y submenus.
    */
   var submenus = [
     "submenu1", 
     "submenu2", 
     "submenu3", 
     "submenu4",
     "submenu5",
     "submenu6"
   ];
  set_desactive_menu(submenus);

  set_active_menu("enlace","submenu1");
  set_active_menu("enlace2","submenu2");
  set_active_menu("enlace3","submenu3");
  set_active_menu("enlace4","submenu4");
  set_active_menu("enlace5", "submenu5");
  set_active_menu("enlace6", "submenu6");

  __dataTable__("dashboardDataTable");
});