<?php
  /**
    * ARRAYS DE OPCIONES PARA LOS MENUS
    *
    */
  /**
    * OPCIONES PARA GESTIONAR LAS EMPRESAS    
    */
  $equipos = [
    "Equipos/gestionar",
    "Equipos/ventas"
  ];
  $proveedores = [
    "Proveedores/nuevo",
    "Proveedores/listado"
  ];
  $clientes = [
    "Clientes/nuevo",
    "Clientes/listado"
  ];
  $taller = [
    "Taller/nuevo",
    "Taller/listado",
    "Taller/reportes"
  ];
  $Cfg = [
    "Cfg/Usuarios",
    "Cfg/Paises",
    "Cfg/Servicios",
    "Cfg/EstatusTickets",
    "Cfg/EstadosEquipos"
  ];
  /**
   *  Validacion de permisologia de usuaros
   */
  if($_SESSION['rol'] == 1){
    /**
     * Permisologia para Administrador del sistema
     */
    require_once "app/views/index/menuAdministrador.php";
  }else if($_SESSION['rol'] == 2){
    /**
     * Permisologia para Usuarios Normales.
     */
    require_once "app/views/index/menuNivel_I.php";
  }else{
    /**
     * Si no cumple con las condiciones regresa el inicio de 
     * session.
     */
    header("Location:?q=Home/Index");
  }
?>