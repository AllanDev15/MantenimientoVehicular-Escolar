<?php

function diferencia($fechaFin)
{
  $fin = strtotime($fechaFin);
  $hoy = strtotime(date('Y-m-d'));
  $dif = $hoy - $fin;
  $dias = $dif / 86400;

  if ($dias == 0) {
    return 'alert alert-warning';
  } else if ($dias < 0) {
    return 'alert alert-danger';
  } else if ($dias > 0) {
    return 'alert alert-success';
  }
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
