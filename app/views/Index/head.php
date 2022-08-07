<?php
  if ($_SESSION['user'] == null || $_SESSION['rol'] == null || $_SESSION['mail'] == null) {
    header('Location:?q=Home/Index');
  }else{
?>
<!Doctype html>
<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema para Control de Inventario. 2021">
    <meta name="author" content="Ing. Juan D. Rincon U - 2021">
    <title>Dashboard Template · Bootstrap v5.0</title>
    <link rel="stylesheet" type="text/css" href="public/icons/font/bootstrap-icons.css">
    <!-- Bootstrap core CSS -->
    <link href="public/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/dashboard.css">
    <link rel="stylesheet" type="text/css" href="public/plugins/DataTables/datatables.css">
    <script type="text/javascript" src="public/jquery.min.js"></script>
    <script type="text/javascript" src="public/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/dashboard.js"></script>
    <script type="text/javascript" src="public/plugins/DataTables/datatables.js"></script>
    <style>
      .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
      }
      
        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
        font-size: 3.5rem;
        }

        li.nav-item>a.nav-link:hover{
          border-left: 2px solid #3090FB !important;
          background-color: rgba(56, 90, 122, 0.8) !important;
          color: #fff;
        }
      }
    </style>
</head>

<?php } ?>

