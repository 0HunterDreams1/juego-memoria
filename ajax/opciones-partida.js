const btn_nueva_partida = document.getElementById("id_nueva_partida");
btn_nueva_partida.addEventListener("click", ventanaOpcionesPartida, true);

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
      btn_nueva_partida.hidden=true;
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
           ¡Debe llenar todos los campos, para poder comenzar la partida!
        </div>`;
      }
      else if(data.msg === "clear"){
        mostrarJuego();
      }
    }
  });
}
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
      function setTime() {
        var totalSegundos=document.getElementById('cantSegundosContador');
        var seg=parseInt(totalSegundos.innerHTML)+1;
        totalSegundos.innerHTML=seg;
        let segundos=document.getElementById("idSegundos");
        let minutos=document.getElementById("idMinutos");
        let hora=document.getElementById("idHoras");
        segundos.innerHTML = pad(seg % 60);
        if(Number.isInteger(seg / 60)){
          minutos.innerHTML = pad(parseInt(seg / 60));
          if('Ilimitado'!=document.getElementById('idTiempoLimite').innerHTML && minutos.innerHTML===document.getElementById('idTiempoLimite').innerHTML.slice(-5,-3)){
            clearInterval(intervalo);
            alert('¡Oh no te quedaste sin tiempo!. Suerte para la próxima.');
            let intentos = document.getElementById('idIntentos').innerHTML;
            let tiempoEnCurso = hora.innerHTML+":"+minutos.innerHTML+":"+segundos.innerHTML;
            let url = "http://localhost/juego-memoria/subir-resultados-partida";
            $.ajax({
              type: "POST",
              url: url,
              data: { intentos: intentos,
                tiempoEnCurso: tiempoEnCurso,
                resultado: 'perdio'},
                success: finalizar
            })
          }
        }
        if(Number.isInteger(seg/3600)){
          hora.innerHTML = pad(parseInt(seg/3600));
        }
      }
      var intervalo = setInterval(setTime, 1000);
    }
  }
}

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}

function finalizar(){
  window.location.href = '';
}