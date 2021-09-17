<?php

function estatusServicio($id)
{
  try {
    require_once 'includes/funciones/conexionBD.php';
    $query = "SELECT idEntrego FROM VEHICULOS WHERE idVehiculo = {$id}";
    $res = mysqli_query($con, $query);
    $id = $res->fetch_assoc();

    $bgColor = 'alert alert-error';

    if (isset($id['idEntrego'])) {
      $bgColor = 'alert alert-success';
    } else {
      $bgColor = 'alert alert-warning';
    }
  } catch (Exception $e) {
    $bgColor = $e->getMessage();
  }
  return $bgColor;
}

function estatusOperarios($estatus)
{
  $bgColor = '';
  if ($estatus == 'disponible') {
    $bgColor = 'alert alert-success';
  } else if ($estatus == 'no disponible') {
    $bgColor = 'alert alert-danger';
  } else if ($estatus == 'en servicio') {
    $bgColor = 'alert alert-warning';
  }

  return $bgColor;
}
