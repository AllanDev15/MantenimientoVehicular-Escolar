<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Inventario de Refacciones</title>
</head>

<body class="bg-light">

  <?php
  include_once 'includes/funciones/conexionBD.php';
  $query = "SELECT * FROM REFACCIONES";
  $res = mysqli_query($con, $query);
  ?>

  <div class="container bg-white">
    <h2 class="py-4">Inventario de Refacciones</h2>
    <table class="table table-striped">
      <thead>
        <th>Numero de Serie</th>
        <th>Nombre</th>
        <th>Proveedor</th>
        <th>Precio</th>
        <th>Existencias</th>
      </thead>
      <tbody>
        <?php while ($refacciones = $res->fetch_assoc()) : ?>
          <tr>
            <th><?= $refacciones['numeroSerie'] ?></th>
            <td><?= $refacciones['nombre'] ?></td>
            <td><?= $refacciones['proveedor'] ?></td>
            <td><?= $refacciones['precio'] ?></td>
            <td><?= $refacciones['existencias'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>