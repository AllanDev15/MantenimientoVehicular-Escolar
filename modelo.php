<?php

$operacion = $_POST['operacion'];

if ($operacion == 'login') {

  $empleado = $_POST[''];

  try {
    include_once 'includes/funciones/conexionBD.php';
    $stmt = $con->prepare("SELECT idEmpleado FROM OPERARIOS WHERE idEmpleado = ?");
    $stmt->bind_param('i', $empleado);
    $stmt->execute();
    $stmt->bind_result($id_empleado);
    if ($stmt->affected_rows) {
      $existe = $stmt->fetch();
      if ($existe) {
        session_start();
        $_SESSION['usuario'] = $id_empleado;
        $respuesta = array(
          'respuesta' => 'exito',
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
  $idRecibido = $_POST[''];
  $tipoVehiculo = $_POST[''];
  $fechaEntrada = $_POST[''];
  $empleado = $_POST[''];
  $fallas = $_POST[''];

  // Datos para tabla Servicios
  $servicio = $_POST[''];
  $duracionEstimada = $_POST[''];
  $idServicio;

  // Operarios
  $numOperarios = $_POST[''];
  $operarios = array();

  // Datos de las refacciones
  $numerosSerie = $_POST[''];
  $existencias = $_POST[''];

  try {
    include_once 'includes/funciones/conexionBD.php';
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

    // Insertar Servicios_Refacciones
    $stmt = $con->prepare("INSERT INTO SERVICIOS_REFACCIONES(idServicio, idRefaccion) VALUES(?, ?)");
    $stmt->bind_param('is', $idServicio, $numerosSerie);
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
    $newExistencia = $existencias - 1;
    $stmt = $con->prepare("UPDATE REFACCIONES SET existencias=? WHERE numeroSerie = ?");
    $stmt->bind_param('is', $newExistencia, $numerosSerie);
    $stmt->execute();
    if ($stmt->affected_rows <= 0) {
      $respuesta = array(
        'respuesta' => 'error'
      );
      echo json_encode($respuesta);
      exit();
    }

    $stmt->close();

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
  }
}
