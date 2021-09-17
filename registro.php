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

  <div class="container">
    <h2 class="text-center py-4">Registro de Servicio</h2>
    <form id="registroServicio" action="pruebas.php" method="post">
      <legend> Ingrese datos solicitados</legend>
      <div class="form-group col-md-6 p-0">
        <label class="">Tipo de vehiculo:</label>
        <input type="text" name="tipoVehiculo" class="form-control my-3" name="tipoVehiculo">
      </div>
      <div class="form-group col-md-6 p-0">
        <label class="">Empleado que entrega:</label>
        <input type="text" name="empleado" class="form-control my-3" name="empleado" />
      </div>

      <div class="form-group col-md-6 p-0">
        <label class="">Fallas:</label>
        <textarea class="form-control" id="fallas" rows="3" name="fallas"></textarea>
      </div>

      <div class="form-group col-md-6 p-0">
        <label class="">Servicio a Realizar:</label>
        <select class="form-control" name="servicio" id="servicios">
          <option value="Cambio de aceite">Cambio de aceite</option>
        </select>
      </div>

      <?php include_once 'includes/funciones/conexionBD.php';
      $query = "SELECT * FROM REFACCIONES WHERE existencias > 0;";
      $res = mysqli_query($con, $query); ?>

      <?php $i = 0;
      while ($refaccion = $res->fetch_assoc()) : ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" value="<?= $refaccion['nombre'] ?>" id="ref<?= $i ?>" name="refaccion[]">
          <label class="form-check-label" for="ref<?= $i ?>"><?= $refaccion['nombre'] ?></label>
          <input type="hidden" name="serie[]" value="<?= $refaccion['numeroSerie'] ?>">
        </div>
      <?php
        $i++;
      endwhile; ?>

      <div class="form-group mt-4">
        <input type="submit" value="enviar" class="btn btn-success" id="btnRegistrarServicio" />
        <input type="hidden" name="idEmpleado" value="<?= $_SESSION['usuario'] ?>">
        <input type="hidden" name="operacion" value="registrar">
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/registro.js"></script>
</body>

</html>