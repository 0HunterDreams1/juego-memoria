const btn_opciones_partida = document.getElementById("id_opciones_partida");
btn_opciones_partida.addEventListener("click", ventanaOpcionesPartida, true);

function ventanaOpcionesPartida() {
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open(
    "GET",
    "http://localhost/juego-memoria/GestionController/opcionesPartida",
    true
    );
    xhr.send();
    
    function estadoIdeal() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let respuesta = xhr.responseText;
      
      let contenedor = document.getElementById("contenido");
      contenedor.innerHTML = respuesta;
      const dificultad = document.getElementById("idDificultad");
      const detalles = document.getElementById("detalles");
      const formDificultad = document.getElementById("form-dificultad");
      formDificultad.addEventListener(
        "submit",
        (e) => {
          enviarOpcionesPartida(e);
        },
        true
        );
      dificultad.addEventListener("change",
      (e) => {
        if(dificultad.value == "---")
        {
          detalles.innerHTML = `<p class="p-2 small text-white text-center">No seleccionaste una dificultad</p>`;
        }
        if(dificultad.value == "baja")
          {
            detalles.innerHTML = `
              <p class="p-2 small text-white text-center">Dificultad baja</p>
              <p class="p-2 small text-white text-center">Cantidad de intentos: 24</p>
              <p class="p-2 small text-white text-center">Cantidad de cartas: 8</p>`;
          }
          if(dificultad.value == "media"){
            detalles.innerHTML = `
              <p class="p-2 small text-white text-center">Dificultad media</p>
              <p class="p-2 small text-white text-center">Cantidad de intentos: 40</p>
              <p class="p-2 small text-white text-center">Cantidad de cartas: 16</p>`;
          }
          if (dificultad.value == "alta") {
            detalles.innerHTML = `
              <p class="p-2 small text-white text-center">Dificultad alta</p>
              <p class="p-2 small text-white text-center">Cantidad de intentos: 64</p>
              <p class="p-2 small text-white text-center">Cantidad de cartas: 32</p>`;
          }
      }
      ,
      true);
    }
  }
}

function enviarOpcionesPartida(e) {
  const msj = document.getElementById("respuesta");
  e.preventDefault();
  var datos = new FormData(e.target);
  let url = "http://localhost/juego-memoria/subir-opciones-partida";
  fetch(url, {
    method: 'POST',
    body: datos
  })
  .then((res) => res.json())
  .then((data) => {
    if (data.code !== "500") {
      if (data.msg === "error") {
        msj.innerHTML = `
        <div id="noti" class="alert alert-danger w-50" role="alert">
           ¡Llenar todos los campos obligatorios!
        </div>`;
      }
      else if(data.msg === "clear"){
        console.log(data);
        let boton = document.getElementById("idEnviar");
        boton.disabled = true;
        msj.innerHTML = `
        <div id="noti" class="alert alert-success" role="alert">
           ¡Configuracion de partida lista, ya puedes jugar!
        </div>`;
      }
    }
  });
}
    