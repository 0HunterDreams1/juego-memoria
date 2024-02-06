function meHicisteClick(idImage, idCarta, nameCarta){
    imagen=document.getElementById(idImage);
    contador=document.getElementById("idContador");
    aciertos=document.getElementById("idAciertos");
    idImagenAux=document.getElementById("idImagenAux");
    idMaxAciertos=document.getElementById('idMaxAciertos').value;
    imagen.classList.add('imagenGrande');
    imagen.classList.add('quitaEvento');
    imagen.src="http://localhost/juego-memoria/"+nameCarta;
    if(contador.value==='0'){
        contador.value=parseInt(contador.value)+1;
        idImagenAux.value=idImage;
    }else{
        contador.value=0;
        imagenAux=document.getElementById(idImagenAux.value);
        if(imagenAux.name===nameCarta){
            aciertos.value=parseInt(aciertos.value)+1;
            imagen.classList.remove('imagenGrande');
            imagenAux.classList.remove('imagenGrande');

        }else{
            setTimeout(() => {
                intentos=document.getElementById("idIntentos");
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
        let segundos=document.getElementById("idSegundos");
        let minutos=document.getElementById("idMinutos");
        let hora=document.getElementById("idHoras");
        let intentos = document.getElementById('idIntentos').innerHTML;
        let tiempoEnCurso = hora.innerHTML+":"+minutos.innerHTML+":"+segundos.innerHTML;
        let url = "http://localhost/juego-memoria/subir-resultados-partida";
        $.ajax({
          type: "POST",
          url: url,
          data: { intentos: intentos,
                tiempoEnCurso: tiempoEnCurso,
                resultado: 'gano'},
                success: finalizar
        })
    }
    if (document.getElementById("idIntentos").innerHTML===document.getElementById("idIntentosTotales").innerHTML) {
        if(aciertos.value >= (idMaxAciertos*0.80)){
            alert('¡¡¡MUY BUENA MEMORIA!!!');
        }else if(aciertos.value >= (idMaxAciertos*0.60)){
            alert('¡¡¡BUENA MEMORIA!!!¡¡¡¡Puedes mejorar!!!!');
        }else{
            alert('¡¡¡Mala Memoria, debes practicar más!!!');
        }
        let segundos=document.getElementById("idSegundos");
        let minutos=document.getElementById("idMinutos");
        let hora=document.getElementById("idHoras");
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
function finalizar(){
      window.location.href = '';
  }