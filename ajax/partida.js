function meHicisteClick(idImage,idCarta, carta){
    imagen=document.getElementById(idImage);
    contador=document.getElementById("idContador");
    aciertos=document.getElementById("idAciertos");
    idImagenAux=document.getElementById("idImagenAux");
    imagen.classList.add('imagenGrande');
    if(contador.value==='0'){
        contador.value=parseInt(contador.value)+1;
        idImagenAux.value=idImage;
    }else{
        console.log("estoy en la segunda imagen");
        console.log("idImage del anterior: "+idImagenAux.value);
        contador.value=0;
        imagenAux=document.getElementById(idImagenAux.value);
        if(imagenAux.name===idCarta){
            console.log("Son iguales");
            aciertos.value=parseInt(aciertos.value)+1;
            imagen.className="card-img-top imagenCarta";
            imagenAux.className="card-img-top imagenCarta";
            imagen.disabled=true;
            imagenAux.disabled=true;
        }else{
            console.log("No son iguales");
            intentos=document.getElementById("idIntentos");
            intentos.innerHTML=parseInt(intentos.innerHTML)+1;
            // .imagenCarta{
            //     width:195px;
            //     height:240px;
            //     background-size: cover;
            // }
            // .imagenCarta:hover{
            //     transform:scale(1.2);
            // }
            imagen.classList.remove('imagenGrande');
            imagenAux.classList.remove('imagenGrande');
        }
    }
    console.log("me hiciste click y el id es: "+idCarta+" y su ubicacion es :"+carta);
    console.log("cantidad clicks: "+contador.value+", aciertos:"+aciertos.value);
}