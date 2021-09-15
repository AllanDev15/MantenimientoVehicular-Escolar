<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Estilos -->
    <link rel="stylesheet" href="css/styles.css">
    <title>Mantenimiento</title>
  </head>
  <body>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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
    
      <nav class="navbar navbar navbar-light navbar-expand-sm sticky-top" style="background-color: #e3f2fd;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Uefa_champions_league_logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo UEFA">
          Equipo 5
        </a>
        <div class=" collapse navbar-collapse " id="navbarTogglerDemo01">
          <div class=" nav nav-tabs navbar-nav mr-auto ml-auto" role="tablist">
            <a class="nav-item nav-link active" href="#inicio" id="inicio-tab" data-toggle="tab">Refacciones</a>
            <a class="nav-item nav-link" href="#vehiculos" id="vehiculos-tab" data-toggle="tab">Vehiculos</a>
            <a class="nav-item nav-link" href="#servicios" id="servicios-tab" data-toggle="tab">Servicios</a>
            <a class="nav-item nav-link" href="#operarios" id="operarios-tab" data-toggle="tab">Operarios</a>
          </div>
          <div class="d-flex flex-row" jusitify-content-center>
            <a href="https://www.facebook.com/" class="btn btn-outline-primary mr-2">F</a>
            <a href="https://www.youtube.com/" class="btn btn-outline-danger">Y</a>
          </div>
        </div>
    
      </nav>

      <div class="tab-content">
        <div class="container mt-3 tab-pane active" id="inicio">
            <div class="container"> 
                <form action="">
                <h1 style="color: ghostwhite;">Control de Inventarios</h1>
                <input type="text" id="numeroSerie" placeholder="Número de Serie" class="form-control my-3">
                <input type="text" id="nombre"placeholder="Nombre de Refacción" class="form-control my-3">
                <input type="text" id="proveedor" placeholder="Proveedor" class="form-control my-3">
                <input type="number" id="precio" placeholder="Precio" class="form-control my-3">
                <input type="number" id="existencias" placeholder="Existencias" class="form-control my-3">
                <input type="submit" value="enviar" class="btn btn-danger"/>
                </form>
            </div>
        </div>
          
        <div class="container mt-3 tab-pane fade" id="vehiculos">
            <div class="container">
                <form action="">
                    <input type="number" id="idVehiculo" placeholder="Id Vehiculo" class="form-control my-3">
                    <input type="number" id="idRecibo" placeholder="Id Recibo" class="form-control my-3">
                    <input type="text" id="tipoVehiculo" placeholder="Tipo de Vehiculo" class="form-control my-3">
                    <input type="datetime-local" id="fechaEntrada" class="form-control my-3">
                    <input type="text" id="empleado" placeholder="Empleado" class="form-control my-3">
                    <input type="text" id="fallas" placeholder="Fallas del Vehiculo" class="form-control my-3">
                    <input type="datetime-local" id="fechaSalida" class="form-control my-3">
                    <input type="number" id="idEntrego" placeholder="Id Entrego" class="form-control my-3">
                    <input type="number" id="idServicio" placeholder="Id Servicio" class="form-control my-3">
                    <input type="submit" value="enviar" class="btn btn-danger"/>
                </form>
            </div>
        </div>

        <div class="container mt-3 tab-pane fade" id="servicios">
            <div class="container">
                <form action="">
                    <input type="number" id="idServicio" placeholder="Id Servicio" class="form-control my-3">
                    <input type="text" id="servicio" placeholder="Nombre del Servicio" class="form-control my-3">
                    <input type="time" id="duracionEstimada" placeholder="Duracion Estimada" class="form-control my-3">
                    <input type="time" id="duracionReal" placeholder="Duracion Real" class="form-control my-3">
                    <input type="submit" value="enviar" class="btn btn-danger"/>
                </form>
            </div>
        </div>

        <div class="container mt-3 tab-pane fade" id="operarios">
            <div class="container">
                <form action="">
                <input type="number" id="idEmpleado" placeholder="Id Empleado" class="form-control my-3">
                <input type="text" id="nombreOperario" placeholder="Nombre del Operario" class="form-control my-3">
                <input type="text" id="estatusOperario" placeholder="Estatus del Operario" class="form-control my-3">
                <input type="submit" value="enviar" class="btn btn-danger"/>
            </form>
            </div>
        </div>


      </div>
      
      

     
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  </body>
</html>
