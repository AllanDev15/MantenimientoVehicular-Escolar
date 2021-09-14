<?php 

$operacion = $_POST['operacion'];

if($operacion == 'login') {

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

}

?>