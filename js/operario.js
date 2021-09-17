document.addEventListener('DOMContentLoaded', () => {
  const btnRegistrarEntrega = document.querySelector('#btnRegistrarEntrega');

  btnRegistrarEntrega.addEventListener('click', (e) => {
    e.preventDefault();
    const form = document.querySelector('#servicioOperario');
    const id = document.querySelector('#inputIdVehiculo');

    const fecha = new Date();
    const fechaHoy = `${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}`;
    const data = new FormData(form);

    data.append('idVehiculo', id.value);
    data.append('fechaSalida', fechaHoy);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'modelo.php', true);
    xhr.onload = function () {
      if (this.status === 200 && this.readyState === 4) {
        const response = JSON.parse(xhr.responseText);
        if (response.respuesta === 'exito') {
          swal('Servicio Terminado', 'Entrega registrada exitosamente', 'success');
          setTimeout(() => {
            window.location.href = 'operario.php';
          }, 3000);
        } else {
          swal('Algo salio mal', 'No se pudo registrar la entrega', 'error');
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
