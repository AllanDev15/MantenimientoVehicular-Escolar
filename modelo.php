<?php

$operacion = $_POST['operacion'];
include_once 'includes/funciones/conexionBD.php';

if ($operacion == 'login') {

  $empleado = $_POST['idEmpleado'];

  try {
    $stmt = $con->prepare("SELECT idEmpleado, nombre FROM OPERARIOS WHERE idEmpleado = ?");
    $stmt->bind_param('i', $empleado);
    $stmt->execute();
    $stmt->bind_result($id_empleado, $nombreEmpleado);
    if ($stmt->affected_rows) {
      $existe = $stmt->fetch();
      if ($existe) {
        session_start();
        $_SESSION['usuario'] = $id_empleado;
        $_SESSION['nombre'] = $nombreEmpleado;
        $respuesta = array(
          'respuesta' => 'exito',
          'nombre' => $nombreEmpleado
        );
      } else {
        $respuesta = array(
          'respuesta' => 'no_existe',
        );
      }
    }
    $stmt->close();
    $con->close();
  } catch (Exception $e) {
    $respuesta = array(
      'error' => $e->getMessage(),
    );
  }

  echo json_encode($respuesta);
} else if ($operacion == 'registrar') {
  // Datos para tabla Vehiculos
  $idRecibido = $_POST['idEmpleado'];
  $tipoVehiculo = $_POST['tipoVehiculo'];
  $fechaEntrada = $_POST['fechaEntrada'];
  $empleado = $_POST['empleado'];
  $fallas = $_POST['fallas'];

  // Datos para tabla Servicios
  $servicio = $_POST['servicio'];
  $duracionEstimada = $_POST['duracionEstimada'];
  $idServicio;

  // Operarios
  $numOperarios = $_POST['numOperarios'];
  $operarios = array();

  // Datos de las refacciones





  $usaRefaccion = 'no';
  if (isset($_POST['refaccion'])) {
    $refacciones = $_POST['refaccion'];
    $series = $_POST['serie'];
    $final = array();

    $usaRefaccion = 'si';
    $i = 0;
    foreach ($refacciones as $re) {
      $final[$i]['numeroSerie'] = $series[$i];
      $i++;
    }
  } else {
    $usaRefaccion = 'no';
  }



  try {
    // Insertar Servicio
    $stmt = $con->prepare("INSERT INTO SERVICIOS(servicio, duracionEstimada) VALUES(?, ?)");
    $stmt->bind_param('si', $servicio, $duracionEstimada);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $idServicio = $stmt->insert_id;
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      echo json_encode($respuesta);
      exit();
    }
    $stmt->close();

    if ($usaRefaccion == 'si') {
      foreach ($final as $ref) {
        // Insertar Servicios_Refacciones
        $stmt = $con->prepare("INSERT INTO SERVICIOS_REFACCIONES(idServicio, idRefaccion) VALUES(?, ?)");
        $stmt->bind_param('is', $idServicio, $ref['numeroSerie']);
        $stmt->execute();
        if ($stmt->affected_rows <= 0) {
          $respuesta = array(
            'respuesta' => 'error'
          );
          echo json_encode($respuesta);
          exit();
        }

        $stmt->close();

        // Restar existencias a la refaccion utilizada
        $stmt = $con->prepare("UPDATE REFACCIONES SET existencias=existencias-1 WHERE numeroSerie = ?");
        $stmt->bind_param('s', $ref['numeroSerie']);
        $stmt->execute();
        if ($stmt->affected_rows <= 0) {
          $respuesta = array(
            'respuesta' => 'error'
          );
          echo json_encode($respuesta);
          exit();
        }

        $stmt->close();
      }
    }

    // Seleccionar operarios disponibles
    $query = "SELECT idEmpleado FROM OPERARIOS WHERE estatus='disponible'";
    $res = mysqli_query($con, $query);
    $operarios = array();

    while ($element = $res->fetch_assoc()) {
      $operarios[] = $element['idEmpleado'];
    }

    for ($i = 0; $i < $numOperarios; $i++) {
      // Asignar operarios al servicio
      $stmt = $con->prepare("INSERT INTO OPERARIOS_SERVICIOS(idServicio, idEmpleado) VALUES(?, ?)");
      $stmt->bind_param('ii', $idServicio, $operarios[$i]);
      $stmt->execute();
      if ($stmt->affected_rows <= 0) {
        $respuesta = array(
          'respuesta' => 'error'
        );
        echo json_encode($respuesta);
        exit();
      }
      $stmt->close();

      // Actualizar estatus
      $stmt = $con->prepare("UPDATE OPERARIOS SET estatus = 'en servicio' WHERE idEmpleado=?");
      $stmt->bind_param('i', $operarios[$i]);
      $stmt->execute();
      if ($stmt->affected_rows <= 0) {
        $respuesta = array(
          'respuesta' => 'error'
        );
        echo json_encode($respuesta);
        exit();
      }
      $stmt->close();
    }


    // Calcular la fecha de salida tomando la fecha de entrada y la duracion estimada
    $entrada = new DateTime($fechaEntrada);
    $dias = 'P' . $duracionEstimada . 'D';
    $salida = $entrada->add(new DateInterval($dias));
    $fechaSalida = $salida->format('Y-m-d');

    // Insertar registro del vehiculo
    $stmt = $con->prepare("INSERT INTO VEHICULOS(idRecibido, tipoVehiculo, fechaEntrada, empleado, fallas, fechaSalida, idServicio) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssssi', $idRecibido, $tipoVehiculo, $fechaEntrada, $empleado, $fallas, $fechaSalida, $idServicio);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $respuesta = array(
        'respuesta' => 'exito',
        'idRegistrado' => $stmt->insert_id
      );
    }

    $stmt->close();

    echo json_encode($respuesta);
  } catch (Exception $e) {
    $respuesta = array(
      'error' => $e->getMessage(),
    );
    echo json_encode($respuesta);
  }
} else if ($operacion == 'registrarEntrega') {
  $idVehiculo = $_POST['idVehiculo'];
  $idEmpleado = $_POST['idEmpleado'];
  $fechaSalida = $_POST['fechaSalida'];

  try {
    $stmt = $con->prepare("UPDATE VEHICULOS SET fechaSalida = ?, idEntrego = ? WHERE idVehiculo = ?");
    $stmt->bind_param('sii', $fechaSalida, $idEmpleado, $idVehiculo);
    $stmt->execute();
    if ($stmt->affected_rows <= 0) {
      $respuesta = array(
        'respuesta' => 'error'
      );
      echo json_encode($respuesta);
      exit;
    }
    $stmt->close();
    $stmt = $con->prepare("UPDATE OPERARIOS SET estatus = 'disponible' WHERE idEmpleado = ?");
    $stmt->bind_param('i', $idEmpleado);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $respuesta = array(
        'respuesta' => 'exito'
      );
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
    }
  } catch (Exception $e) {
    $respuesta = array(
      'error' => $e->getMessage()
    );
  }

  echo json_encode($respuesta);
}
