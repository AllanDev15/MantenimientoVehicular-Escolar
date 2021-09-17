<?php require_once 'includes/funciones/sesiones.php' ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Operarios</title>
</head>

<body class="bg-light">
  <?php
  $idEmpleado = $_SESSION['usuario'];
  include_once 'includes/funciones/conexionBD.php';
  $query = "SELECT idVehiculo, servicio, fallas, tipoVehiculo, fechaEntrada, duracionEstimada, fechaSalida, numeroSerie, REFACCIONES.nombre, proveedor
  FROM VEHICULOS
  INNER JOIN SERVICIOS ON VEHICULOS.idServicio = SERVICIOS.idServicio
  INNER JOIN OPERARIOS_SERVICIOS ON SERVICIOS.idServicio = OPERARIOS_SERVICIOS.idServicio
  INNER JOIN OPERARIOS ON OPERARIOS_SERVICIOS.idEmpleado = OPERARIOS.idEmpleado
  INNER JOIN SERVICIOS_REFACCIONES ON SERVICIOS.idServicio = SERVICIOS_REFACCIONES.idServicio
  INNER JOIN REFACCIONES ON SERVICIOS_REFACCIONES.idRefaccion = REFACCIONES.numeroSerie
  WHERE OPERARIOS_SERVICIOS.idEmpleado = {$idEmpleado} AND idEntrego IS NULL; ";
  $res = mysqli_query($con, $query);
  $servicio = array();
  $rows = '';

  if ($res->num_rows > 0) {
    $rows = 'si';
    while ($element = $res->fetch_assoc()) {
      $servicio[0]['idVehiculo'] = $element['idVehiculo'];
      $servicio[0]['servicio'] = $element['servicio'];
      $servicio[0]['fallas'] = $element['fallas'];
      $servicio[0]['tipoVehiculo'] = $element['tipoVehiculo'];
      $servicio[0]['fechaEntrada'] = $element['fechaEntrada'];
      $servicio[0]['duracionEstimada'] = $element['duracionEstimada'];
      $servicio[0]['fechaSalida'] = $element['fechaSalida'];
      // Refacciones 
      $servicio[0]['refacciones'][$element['numeroSerie']]['numeroSerie'] = $element['numeroSerie'];
      $servicio[0]['refacciones'][$element['numeroSerie']]['nombre'] = $element['nombre'];
      $servicio[0]['refacciones'][$element['numeroSerie']]['proveedor'] = $element['proveedor'];
    }
  } else {
    $rows = 'no';
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
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registrar Servicio</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="operario.php">Servicio activo</a>
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
    <h2 class="py-4">Servicio</h2>
    <?php if ($rows == 'si') : ?>
      <form id="servicioOperario" action="pruebas.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputIdVehiculo"># Servicio</label>
            <input type="text" class="form-control" id="inputIdVehiculo" name="idVehiculo" value="<?= $servicio[0]['idVehiculo'] ?>" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="inputServicio">Tipo de Servicio</label>
            <input type="text" class="form-control" id="inputServicio" value="<?= $servicio[0]['servicio'] ?>" disabled>
          </div>
        </div>

        <div class="form-group">
          <label for="inputFallas">Fallas</label>
          <textarea class="form-control" id="inputFallas" rows="3" disabled><?= $servicio[0]['fallas'] ?></textarea>
        </div>

        <div class="form-group">
          <label for="inputTipoVehiculo">Tipo de Vehiculo</label>
          <input type="text" class="form-control" id="inputTipoVehiculo" value="<?= $servicio[0]['tipoVehiculo'] ?>" disabled>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputFechaEntrada">Fecha de Entrada</label>
            <input type="text" class="form-control" id="inputFechaEntrada" value="<?= $servicio[0]['fechaEntrada'] ?>" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="inputDuracionEstimada">Duración Estimada</label>
            <input type="text" class="form-control" id="inputDuracionEstimada" value="<?= $servicio[0]['duracionEstimada'] ?> dias" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="inputFechaSalida">Fecha de Salida</label>
            <input type="text" class="form-control" id="inputFechaSalida" value="<?= $servicio[0]['fechaSalida'] ?>" disabled>
          </div>
        </div>

        <h3>Refacciones</h3>
        <?php foreach ($servicio[0]['refacciones'] as $refaccion) : ?>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputNumeroSerie<?= $refaccion['numeroSerie'] ?>">Numero de Serie</label>
              <input type="text" class="form-control" id="inputNumeroSerie<?= $refaccion['numeroSerie'] ?>" value="<?= $refaccion['numeroSerie'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="inputRefaccion<?= $refaccion['numeroSerie'] ?>">Refaccion</label>
              <input type="text" class="form-control" id="inputRefaccion<?= $refaccion['numeroSerie'] ?>" value="<?= $refaccion['nombre'] ?>" disabled>
            </div>
            <div class="form-group col-md-4">
              <label for="inputPrecio<?= $refaccion['numeroSerie'] ?>">Proveedor</label>
              <input type="text" class="form-control" id="inputPrecio<?= $refaccion['numeroSerie'] ?>" value="<?= $refaccion['proveedor'] ?>" disabled>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="form-group mt-4">
          <input class="btn btn-primary" id="btnRegistrarEntrega" type="submit" value="Registrar Entrega">
          <input type="hidden" name="operacion" value="registrarEntrega">
          <input type="hidden" name="idEmpleado" value="<?= $idEmpleado ?>">
        </div>
      </form>
    <?php elseif ($rows == 'no') : ?>
      <div class="alert alert-success">
        No tienes servicios asignados
      </div>
    <?php endif; ?>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/operario.js"></script>
</body>

</html>