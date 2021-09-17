<?php require_once 'includes/funciones/sesiones.php' ?>
<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Mantenimiento</title>
  <style>
    body {
      background-image: url(https://ssl.sitew.org/images/blog/articles/fonds/e11.jpg);
      background-size: cover;
      background-position: center;

    }
  </style>
</head>

<body>

  <?php

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
          <a class="nav-link" href="<?= $_SESSION['usuario'] != '2506' ? 'registro.php' : 'reporte.php' ?>"> <?= $_SESSION['usuario'] != '2506' ? 'Registrar Servicio' : 'Reporte de Servicios' ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $_SESSION['usuario'] != '2506' ? 'operario.php' : 'inventario.php' ?>"> <?= $_SESSION['usuario'] != '2506' ? 'Servicio activo' : 'Inventario de Refacciones' ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= $_SESSION['usuario'] != '2506' ? '#' : 'operarios.php' ?>"> <?= $_SESSION['usuario'] != '2506' ? '' : 'Estatus de Operarios' ?></a>
        </li>
      </ul>
      <div class="navbar-text d-flex">
        <p class="mr-3"><?= $_SESSION['nombre'] ?></p>
        <p class="mr-5"><?= $_SESSION['usuario'] ?></p>
        <a href="login.php?cerrar_sesion=true">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: calc(100vh - 56px);">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://blogapi.uber.com/wp-content/uploads/2019/04/Cuida-de-ti-y-de-tu-veh%C3%ADculo-con-estos-6-consejos-para-el-mantenimiento-de-autos-1024x512.png" class="d-block w-100" alt="Primer slide">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://www.bardahlindustria.com/wp-content/uploads/2019/09/vehiculos_pesados_blog_bardahl.jpg" class="d-block w-100" alt="Segundo slide">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://blog.segundamano.mx/wp-content/uploads/2018/10/Blog_autopartes.jpg" class="d-block w-100 " alt="Tercer slide">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- <nav class="navbar navbar navbar-light navbar-expand-sm sticky-top" style="background-color: #e3f2fd;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.html">
      <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Uefa_champions_league_logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo UEFA">
      Equipo 5
    </a>
    <div class=" collapse navbar-collapse " id="navbarTogglerDemo01">
      <div class=" nav nav-tabs navbar-nav mr-auto ml-auto" role="tablist">
        <a class="nav-item nav-link active" href="#administrador" id="administrador-tab" data-toggle="tab">Administrador</a>
        <a class="nav-item nav-link" href="#operarios" id="operarios-tab" data-toggle="tab">Operarios</a>
      </div>
      <div class="d-flex flex-row" jusitify-content-center>
        <a href="https://www.facebook.com/" class="btn btn-outline-primary mr-2">F</a>
        <a href="https://www.youtube.com/" class="btn btn-outline-danger">Y</a>
      </div>
    </div>

  </nav>

  <div class="tab-content">
    <div class="container mt-3 tab-pane active" id="administrador">

      <div class="container mt-5">
        <label for="opciones" class="text-white"> Selecciona el proceso a realizar: </label>
        <select id="opciones">
          <option value="A"> Registro de Refacciones </option>
          <option value="B"> Registro de Operarios </option>
          <option value="C"> Historial de Servicios </option>
          <option value="D"> Inventario de Refacciones </option>
          <option value="E"> Estatus de operarios </option>

        </select><br><br>

        <p></p>
        <div class="info"></div>


        <script type="text/javascript">
          const seleccionar = document.querySelector('select');
          const parrafo = document.querySelector('p');
          const div = document.querySelector('.info');
          seleccionar.onchange = establecerClima;

          function establecerClima() {
            const eleccion = seleccionar.value;
            if (eleccion === 'A') {

              div.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend><p><label  class="text-white" >Número de Serie:<input type="text" name="numeroSerie" class="form-control my-3"/></label> </p><p><label class="text-white">Nombre de la refacción:<input type="text" name="nombre" class="form-control my-3"/></label> </p><p><label class="text-white">Proveedor: <input type="text" name="proveedor" class="form-control my-3"/></label></p> <p><label class="text-white">Precio: <input type="number" name="numero" class="form-control my-3"/></label></p> <p><input type="submit" value="enviar" class="btn btn-success"/></p></fieldset></form>';
              div.innerHTML;
            } else if (eleccion === 'B') {

              div.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend><p><label class="text-white">Id Empleado:<input type="number" name="idEmpleado" class="form-control my-3"/></label> </p><p><label class="text-white">Nombre del Operario: <input type="text" name="nombreOperario" class="form-control my-3"/></label> </p><p><label class="text-white">Estatus del Operario: <div class="input-group mb-3"><div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Opciones</label></div><select class="custom-select" id="inputGroupSelect01"><option selected>Seleccionar...</option><option value="1">En servicio</option><option value="2">Disponible</option><option value="3">Libre</option></select></div> </label></p><p><input type="submit" value="enviar" class="btn btn-success"/></p></fieldset></form>';
              div.innerHTML;
            } else if (eleccion === 'C') {

              div.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend> </fieldset></form>';
              div.innerHTML;
            } else if (eleccion === 'D') {

              div.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend> </fieldset></form>';
              div.innerHTML;
            } else if (eleccion === 'E') {

              div.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend> </fieldset></form>';
              div.innerHTML;
            } else {
              parrafo.textContent = 'NO PUSO NADA';
            }
          }
        </script>

      </div>

    </div>

    <div class="container mt-3 tab-pane fade" id="operarios">
      <div class="container mt-5">
        <label for="opciones2" class="text-white"> Selecciona el proceso a realizar: </label>
        <select id="opciones2">
          <option value="G"> Registro de Vehiculos</option>
          <option value="K"> Visualización Servicios</option>
        </select><br><br>

        <p></p>
        <div class="info2"></div>


        <script type="text/javascript">
          const seleccionar2 = document.querySelector("#opciones2");
          const parrafo2 = document.querySelector('p');
          const div2 = document.querySelector('.info2');
          seleccionar2.onchange = establecerOper;

          function establecerOper() {
            const eleccion2 = seleccionar2.value;
            if (eleccion2 === 'G') {
              window.location.href = 'registro.php';
            } else if (eleccion2 === 'K') {

              div2.innerHTML = '<form action="" method="post"><fieldset><legend class="text-white"> Ingrese datos solicitados</legend></fieldset></form>';
              div2.innerHTML;
            } else {
              parrafo2.textContent = 'NO PUSO NADA';
            }
          }
        </script>

      </div>
    </div>

  </div> -->




  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>