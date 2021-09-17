<?php require_once 'includes/funciones/sesiones.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Reportes</title>

  <style>
    .table .col-md,
    .table .col-md-1 {
      padding: 1rem;
    }

    .subtable .col-md-2 {
      padding: .75rem;
    }

    .subtable .head .col-md-2 {
      border-bottom: 1px solid #dee2e6;
    }

    .table p {
      margin: 0px;
    }
  </style>
</head>

<body class="bg-light">

  <?php
  include_once 'includes/funciones/conexionBD.php';
  $query = "SELECT idVehiculo, Receptores.nombre as 'recibido', tipoVehiculo, fechaEntrada, fechaSalida, fallas, servicio, numeroSerie, REFACCIONES.nombre, precio, OPERARIOS.idEmpleado, OPERARIOS.nombre as 'nombreOperario' FROM VEHICULOS 
  INNER JOIN OPERARIOS as Receptores ON idRecibido = Receptores.idEmpleado
  INNER JOIN SERVICIOS ON VEHICULOS.idServicio = SERVICIOS.idServicio 
  INNER JOIN SERVICIOS_REFACCIONES ON SERVICIOS.idServicio = SERVICIOS_REFACCIONES.idServicio
  INNER JOIN REFACCIONES ON SERVICIOS_REFACCIONES.idRefaccion = REFACCIONES.numeroSerie
  INNER JOIN OPERARIOS_SERVICIOS ON SERVICIOS.idServicio = OPERARIOS_SERVICIOS.idServicio
  INNER JOIN OPERARIOS ON OPERARIOS_SERVICIOS.idEmpleado = OPERARIOS.idEmpleado;";
  $servicios = array();

  $res = mysqli_query($con, $query);

  while ($element = $res->fetch_assoc()) {
    $servicios[$element['idVehiculo']]['idVehiculo'] = $element['idVehiculo'];
    $servicios[$element['idVehiculo']]['recibido'] = $element['recibido'];
    $servicios[$element['idVehiculo']]['tipoVehiculo'] = $element['tipoVehiculo'];
    $servicios[$element['idVehiculo']]['fechaEntrada'] = $element['fechaEntrada'];
    $servicios[$element['idVehiculo']]['fechaSalida'] = $element['fechaSalida'];
    $servicios[$element['idVehiculo']]['fallas'] = $element['fallas'];
    $servicios[$element['idVehiculo']]['servicio'] = $element['servicio'];
    // Refacciones 
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['numeroSerie'] = $element['numeroSerie'];
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['nombre'] = $element['nombre'];
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['precio'] = $element['precio'];
    // Operarios
    $servicios[$element['idVehiculo']]['operarios'][$element['idEmpleado']]['idEmpleado'] = $element['idEmpleado'];
    $servicios[$element['idVehiculo']]['operarios'][$element['idEmpleado']]['nombreOperario'] = $element['nombreOperario'];
  }
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
        <li class="nav-item active">
          <a class="nav-link" href="reporte.php">Reporte de Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inventario.php">Inventario de Refacciones</a>
        </li>
        <li class="nav-item">
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
    <h2 class="py-4">Servicios</h2>

    <div class="table">
      <div class="row head font-weight-bold bg-dark text-white">
        <div class="col-md-1 text-center">
          <p>#</p>
        </div>
        <div class="col-md">
          <p>Fecha de Entrada</p>
        </div>
        <div class="col-md">
          <p>Recibio</p>
        </div>
        <div class="col-md">
          <p>Vehiculo</p>
        </div>
        <div class="col-md">
          <p>Fallas</p>
        </div>
        <div class="col-md">
          <p>Servicio</p>
        </div>
        <div class="col-md">
          <p>Fecha de Salida</p>
        </div>
        <div class="col-md text-center">
          <p>Refacciones</p>
        </div>
      </div>

      <?php foreach ($servicios as $servicio) :
        // require_once 'includes/funciones/helpers.php';
        require_once 'includes/funciones/conexionBD.php';
        $query = "SELECT idEntrego FROM VEHICULOS WHERE idVehiculo = {$servicio['idVehiculo']}";
        $res = mysqli_query($con, $query);
        $id = $res->fetch_assoc();

        $bgColor = 'alert';

        if (isset($id['idEntrego'])) {
          $bgColor = 'alert alert-success';
        } else {
          $bgColor = 'alert alert-warning';
        }
      ?>
        <div class="row <?= $bgColor ?>">
          <div class="col-md-1 font-weight-bold">
            <p><?= $servicio['idVehiculo'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['fechaEntrada'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['recibido'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['tipoVehiculo'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['fallas'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['servicio'] ?></p>
          </div>
          <div class="col-md text-center">
            <p><?= $servicio['fechaSalida'] ?></p>
          </div>
          <div class="col-md text-center h3">
            <a class="text-muted" href="#refaccion<?= $servicio['idVehiculo'] ?>" data-toggle="collapse" aria-expanded="false"><i class="fas fa-tools"></i></a>
          </div>
        </div>

        <div class="pl-5 collapse subtable" id="refaccion<?= $servicio['idVehiculo'] ?>">
          <!-- Refacciones -->
          <div class="row head font-weight-bold">
            <div class="col-md-2">
              <p># Serie</p>
            </div>
            <div class="col-md-2">
              <p>Nombre</p>
            </div>
            <div class="col-md-2">
              <p>Precio</p>
            </div>
          </div>
          <?php foreach ($servicio['refacciones'] as $refaccion) : ?>
            <div class="row">
              <div class="col-md-2">
                <p><?= $refaccion['numeroSerie'] ?></p>
              </div>
              <div class="col-md-2">
                <p><?= $refaccion['nombre'] ?></p>
              </div>
              <div class="col-md-2">
                <p><?= $refaccion['precio'] ?></p>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Fin Refacciones -->
          <!-- Operarios -->
          <div class="row head font-weight-bold">
            <div class="col-md-2">
              <p># Operario</p>
            </div>
            <div class="col-md-2">
              <p>Nombre</p>
            </div>
          </div>
          <?php foreach ($servicio['operarios'] as $operario) : ?>
            <div class="row">
              <div class="col-md-2">
                <p><?= $operario['idEmpleado'] ?></p>
              </div>
              <div class="col-md-2">
                <p><?= $operario['nombreOperario'] ?></p>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Fin Operarios -->
        </div>
      <?php endforeach; ?>

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>