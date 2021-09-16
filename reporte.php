<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  $query = "SELECT idVehiculo, tipoVehiculo, fechaEntrada, fechaSalida, fallas, servicio, numeroSerie, nombre, precio FROM VEHICULOS 
  INNER JOIN SERVICIOS ON VEHICULOS.idServicio = SERVICIOS.idServicio 
  INNER JOIN SERVICIOS_REFACCIONES ON SERVICIOS.idServicio = SERVICIOS_REFACCIONES.idServicio
  INNER JOIN REFACCIONES ON SERVICIOS_REFACCIONES.idRefaccion = REFACCIONES.numeroSerie";
  $servicios = array();

  $res = mysqli_query($con, $query);

  while ($element = $res->fetch_assoc()) {
    $servicios[$element['idVehiculo']]['idVehiculo'] = $element['idVehiculo'];
    $servicios[$element['idVehiculo']]['tipoVehiculo'] = $element['tipoVehiculo'];
    $servicios[$element['idVehiculo']]['fechaEntrada'] = $element['fechaEntrada'];
    $servicios[$element['idVehiculo']]['fechaSalida'] = $element['fechaSalida'];
    $servicios[$element['idVehiculo']]['fallas'] = $element['fallas'];
    $servicios[$element['idVehiculo']]['servicio'] = $element['servicio'];
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['numeroSerie'] = $element['numeroSerie'];
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['nombre'] = $element['nombre'];
    $servicios[$element['idVehiculo']]['refacciones'][$element['numeroSerie']]['precio'] = $element['precio'];
  }
  ?>

  <div class="container bg-white">
    <h2 class="py-4">Servicios</h2>

    <div class="table">
      <div class="row head font-weight-bold">
        <div class="col-md-1 text-center">
          <p>#</p>
        </div>
        <div class="col-md">
          <p>Fecha de Entrada</p>
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
        require_once 'includes/funciones/helpers.php' ?>
        <div class="row <?= diferencia($servicio['fechaSalida']) ?>">
          <div class="col-md-1 font-weight-bold">
            <p><?= $servicio['idVehiculo'] ?></p>
          </div>
          <div class="col-md">
            <p><?= $servicio['fechaEntrada'] ?></p>
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
          <div class="col-md text-right">
            <a href="#refaccion<?= $servicio['idVehiculo'] ?>" data-toggle="collapse" aria-expanded="false">Refacciones</a>
          </div>
        </div>

        <div class="pl-5 collapse subtable" id="refaccion<?= $servicio['idVehiculo'] ?>">
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
        </div>
      <?php endforeach; ?>

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>