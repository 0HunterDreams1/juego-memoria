<div class="container py-4" style="  background: white;">
  <div class="row">
    <div class="col-18 col-sm-18 col-md-9 col-lg-9">
      <div class="row align-items-center">
          <div class="row justify-content-center">
              <h5 id="idIntentos" title="Intentos Actuales"><?php echo $partida['intentos'] ?></h5>
              <h5>/</h5>
              <h5 id="idIntentosTotales" title="Intentos Restantes"><?php echo $dificultad['cantIntentos'] ?></h5>
          </div>
          <input id="idContador" type="text" value="0" hidden>
          <input id="idAciertos" type="text" value="0" hidden>
          <input id="idMaxAciertos" type="text" value="<?php echo $dificultad['cantCartas']/2 ?>" hidden>
          <input id="idImagenAux" name ="0" type="text" value="0" hidden>
          <input id="flag" type="text" value="0" hidden>
        <div class="col-sm text-center">
          <h5>Tiempo</h5>
          <div class="row justify-content-center">
            <h5 id="idHoras">00</h5>
            <h5>:</h5>
            <h5 id="idMinutos">00</h5>
            <h5>:</h5>
            <h5 id="idSegundos">00</h5>
          </div>
        </div>
        <div class="col-sm-auto text-center">
          <button id="idPausar" type="submit" class="btn btn-warning btn-sm">Pausar</button>
          <div class="w-100"></div>
          <button id="idRendirse" type="submit" class="btn btn-danger btn-sm">Rendirse</button>
        </div>
        <div class="col-sm text-center">
          <h5>Tiempo Limite</h5>
          <h5  id="idTiempoLimite"><?php if(isset($partida['tiempoLimite'])){
            echo $partida['tiempoLimite'];
          }else{
            echo "Ilimitado";
          }?></h5>
        </div>
        <div class="col-sm">
          <h5>Partida N° <?php echo $cantPartidas?></h5>
        </div>
      </div>
      <div class="row">
      <?php foreach ($cartas as $indice => $carta) { ?>
        <div class="card cardTamanio">
            <img 
            id="<?php echo $indice ?>" 
            name="<?php echo $carta['nombreCarta'];?>" 
            src="<?php echo base_url('public/images/cartaDetras.JPG'); ?>" 
            class="card-img-top imagenCarta" 
            onClick="meHicisteClick(<?php echo $indice ?>,<?php echo $carta['idCarta']; ?>,'<?php echo $carta['nombreCarta'];?>')">
        </div>
      <?php } ?>
      </div>
    </div>
    <div class="col-3 col-sm-3 col-md-3 col-lg-3">
        <h4>Top 5 mejores tiempos</h4>
        <h5>bla BLA BLA BLA tiempos</h5>
        <h5>bla BLA BLA BLA tiempos</h5>
        <h5>bla BLA BLA BLA tiempos</h5>
        <h5>bla BLA BLA BLA tiempos</h5>
        <h5>bla BLA BLA BLA tiempos</h5>
    </div>
  </div>
</div>