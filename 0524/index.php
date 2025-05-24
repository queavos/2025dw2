<?php
/*
session_start();
require_once '../05/24/lib/Autenticacion.php';
$auth = new Autenticacion();
$auth->autorizar(pagina: "index.php"); */
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MiniZoo Juan XXIII</title>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css" />
   <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
</head>
<body>

  <!-- ENCABEZADO -->
  <?php include 'fragmentos/header.php'; ?>

  <!-- SECCIÓN PRINCIPAL -->
 

  <!-- PIE DE PÁGINA -->
  <?php 
  include 'fragmentos/footer.php';
  
  ?>

  <!-- JavaScript -->
  


<script src="./js/page.js"></script>
<script src="./js/script.js"></script>
</body>
</html>