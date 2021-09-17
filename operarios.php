<?php require_once 'includes/funciones/sesiones.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Operarios</title>
</head>

<body class="bg-light">

  <?php
  include_once 'includes/funciones/conexionBD.php';
  $query = "SELECT * FROM OPERARIOS";
  $res = mysqli_query($con, $query);
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top d-flex justify-content-between">
    <a class="navbar-brand" href="index.php">
      <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Uefa_champions_league_logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo UEFA">
      Plazco
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="reporte.php">Reporte de Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inventario.php">Inventario de Refacciones</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="operarios.php">Estatus de Operarios</a>
        </li>
      </ul>
      <div class="navbar-text d-flex">
        <p class="mr-3"><?= $_SESSION['nombre'] ?></p>
        <p class="mr-5"><?= $_SESSION['usuario'] ?></p>
        <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <div class="container bg-white">
    <h2 class="py-4">Operarios</h2>
    <div class="row">
      <?php while ($operarios = $res->fetch_assoc()) :
        require_once 'includes/funciones/helpers.php' ?>
        <div class="col-md-4">
          <div class="card p-0 <?= estatusOperarios($operarios['estatus']) ?>">
            <div class="card-header d-flex justify-content-between">
              <div class="text-dark font-weight-bold"><?= $operarios['nombre'] ?></div>
              <div><?= $operarios['idEmpleado'] ?></div>
            </div>
            <div class="card-body text-dark">
              <?= ucfirst($operarios['estatus']) ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>