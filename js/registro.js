document.addEventListener('DOMContentLoaded', () => {
  const btnRegistrarServicio = document.querySelector('#btnRegistrarServicio');

  const servicios = {
    'Cambio de embrague': {
      estimado: 3,
      operarios: 1,
    },
    'Cambio de frenos y amortiguadores': {
      estimado: 4,
      operarios: 2,
    },
    'Cambio de llanta': {
      estimado: 1,
      operarios: 1,
    },
    'Reparación de frenos': {
      estimado: 2,
      operarios: 1,
    },
    'Reparación del modulo de aceite': {
      estimado: 3,
      operarios: 1,
    },
  };

  btnRegistrarServicio.addEventListener('click', (e) => {
    e.preventDefault();
    const form = document.querySelector('#registroServicio');
    const selectServicios = document.querySelector('#servicios').value;

    const fecha = new Date();
    const fechaHoy = `${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}`;
    const data = new FormData(form);

    data.append('fechaEntrada', fechaHoy);
    data.append('duracionEstimada', servicios[selectServicios]['estimado']);
    data.append('numOperarios', servicios[selectServicios]['operarios']);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'modelo.php', true);
    xhr.onload = function () {
      if (this.status === 200 && this.readyState === 4) {
        const response = JSON.parse(xhr.responseText);
        if (response.respuesta === 'exito') {
          swal('Servicio Registrado', 'Servicio Registrado correctamente', 'success');
        } else {
          swal('Algo salio mal', 'No se pudo registrar el servicio', 'error');
        }
        console.log(response.respuesta);
      }
    };
    xhr.send(data);

    // for (var pair of data.entries()) {
    //   console.log(pair[0] + ', ' + pair[1]);
    // }
  });
});
