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
              let resultado='perdio';
              enviarDatosPartida(resultado);
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
function rendirse(){
  if (confirm('¿Seguro que desea rendirse?')){
    let resultado= 'abandono';
    enviarDatosPartida(resultado);
  }
}

function meHicisteClick(idImage, nameCarta){
  let imagen=document.getElementById(idImage);
  let contador=document.getElementById("idContador");
  let aciertos=document.getElementById("idAciertos");
  let idImagenAux=document.getElementById("idImagenAux");
  let idMaxAciertos=document.getElementById('idMaxAciertos').value;
  imagen.classList.add('imagenGrande');
  imagen.classList.add('quitaEvento');
  imagen.src="http://localhost/juego-memoria/"+nameCarta;
  if(contador.value==='0'){
      contador.value=parseInt(contador.value)+1;
      idImagenAux.value=idImage;
  }else{
    contador.value=0;
    let imagenAux=document.getElementById(idImagenAux.value);
    if(imagenAux.name===imagen.name){
      aciertos.value=parseInt(aciertos.value)+1;
      document.getElementById(parseInt(idImage)).innerHTML="true";
      document.getElementById(parseInt(idImagenAux.value)).innerHTML="true";
      imagen.classList.remove('imagenGrande');
      imagenAux.classList.remove('imagenGrande');
    }else{
      setTimeout(() => {
        let intentos=document.getElementById("idIntentos");
        intentos.innerHTML=parseInt(intentos.innerHTML)+1;
        imagen.src="http://localhost/juego-memoria/public/images/cartaDetras.JPG";
        imagenAux.src="http://localhost/juego-memoria/public/images/cartaDetras.JPG";
        imagen.classList.remove('imagenGrande');
        imagen.classList.remove('quitaEvento');
        imagenAux.classList.remove('imagenGrande');
        imagenAux.classList.remove('quitaEvento');
      }, 500);
    }
            
  }
  if(aciertos.value===idMaxAciertos){
    alert('¡¡¡EXCELENTE MEMORIA!!!');
    let resultado='gano';
    enviarDatosPartida(resultado); 
  }
  if (document.getElementById("idIntentos").innerHTML===document.getElementById("idIntentosTotales").innerHTML) {
    if(aciertos.value >= (idMaxAciertos*0.80)){
        alert('¡¡¡MUY BUENA MEMORIA!!!');
    }else if(aciertos.value >= (idMaxAciertos*0.60)){
      alert('¡¡¡BUENA MEMORIA!!!¡¡¡¡Puedes mejorar!!!!');
    }else{
      alert('¡¡¡Mala Memoria, debes practicar más!!!');
    }
    let resultado='perdio';
    enviarDatosPartida(resultado);    
  }
}

function guardar(){
  if (confirm('¿Seguro que desea guardar la partida, para retomarla luego?')){
    let resultado = 'guardar';
    enviarDatosPartida(resultado);
    }
  }
  
function enviarDatosPartida(resul){
  let posiciones = [];
  if (resul==='guardar') {
    let cartas=document.querySelectorAll("[id*='-carta']");
    let idCarta;
    let encontrado;
    for (let index = 0; index < cartas.length; index++) {
      idCarta= document.getElementById(index+'-carta').name;
      encontrado=document.getElementById(index).innerHTML;
      posiciones.push({ "idCarta" : idCarta, "encontrado": encontrado})
    }
  }
  let idPartida = document.getElementById('idPartida').value;
  let segundos=document.getElementById("idSegundos");
  let minutos=document.getElementById("idMinutos");
  let hora=document.getElementById("idHoras");
  let intentos = document.getElementById('idIntentos').innerHTML;
  let aciertos=document.getElementById("idAciertos");
  let tiempoEnCurso = hora.innerHTML+":"+minutos.innerHTML+":"+segundos.innerHTML;
  let url = "http://localhost/juego-memoria/subir-resultados-partida";
  $.ajax({
    type: "POST",
    url: url,
    data: { intentos: intentos,
      tiempoEnCurso: tiempoEnCurso,
      aciertos: aciertos.value,
      idPartida: idPartida,
      'posiciones': JSON.stringify(posiciones),
      resultado: resul},
      success: finalizar
  })
}
function finalizar(){
  window.location.href = '';
}