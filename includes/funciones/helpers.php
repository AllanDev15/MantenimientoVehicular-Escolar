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
