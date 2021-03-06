document.addEventListener('DOMContentLoaded', () => {
  const btnLogin = document.querySelector('#btnLogin');

  btnLogin.addEventListener('click', (e) => {
    e.preventDefault();

    const form = document.querySelector('#formLogin');
    const inputId = document.querySelector('#inputId');

    const data = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'modelo.php', true);
    xhr.onload = function () {
      if (this.status === 200 && this.readyState === 4) {
        const response = JSON.parse(xhr.responseText);
        if (response.respuesta === 'exito') {
          swal('Login exitoso', `Bienvenido ${response.nombre}`, 'success');
          setTimeout(() => {
            window.location.href = 'index.php';
          }, 2000);
        } else {
          swal('Algo salio mal', 'No existe ningun usuario con ese numero de empleado', 'error');
        }
      }
    };
    xhr.send(data);
  });
});
