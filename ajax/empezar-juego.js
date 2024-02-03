const btnEmpezar = document.getElementById("id_empezar");
btnEmpezar.addEventListener("click", mostrarJuego, true);

function mostrarJuego() {
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open(
    "GET",
    "http://localhost/juego-memoria/GestionController/empezarJuego",
    true
    );
    xhr.send();

  function estadoIdeal() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          let respuesta = xhr.responseText;
          let contenedor = document.getElementById('contenido');
          contenedor.innerHTML = respuesta;

      }
  }
}

    