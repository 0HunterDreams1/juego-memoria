<div class="container py-4" style="  background: white;">
  <div class="row">
    <div class="col-18 col-sm-18 col-md-9 col-lg-9">
      <div class="row">
        <div class="col-sm">
          <h5>Nro de Intentos / Intentos total</h5>
          <div class="row">
            <h5 id="idIntentos"><?php echo $partida['intentos'] ?></h5>
            <h5>/</h5>
            <h5 id="idIntentosTotales"><?php echo $dificultad['cantIntentos'] ?></h5>
          </div>
          
          <input id="idContador" type="text" value="0" hidden>
          <input id="idAciertos" type="text" value="0" hidden>
          <input id="idImagenAux" type="text" value="0" hidden>
        </div>
        <div class="col-sm">
          <h5>Tiempo</h5>
          <h5>00:00:00</h5>
        </div>
        <div class="col-sm">
          <h5>Tiempo Limite</h5>
          <h5>00:05:00</h5>
        </div>
        <div class="col-sm">
          <h5>Partida N° <?php echo $cantPartidas?></h5>
        </div>
      </div>
      <div class="row">
        <div class="card cardTamanio">
            <img id="1" name="<?php echo $cartas['1']['idCarta'];?>" src="<?php echo base_url('public/images/tanques/tanque_03.jpg'); ?>" class="card-img-top imagenCarta" onClick="meHicisteClick(1,<?php echo $cartas['1']['idCarta'];?>,'<?php echo $cartas['1']['nombreCarta'];?>')">
        </div>
        <div class="card cardTamanio">
            <img id="2" name="<?php echo $cartas['2']['idCarta'];?>" src="<?php echo base_url('public/images/tanques/tanque_02.jpg'); ?>" class="card-img-top imagenCarta" onClick="meHicisteClick(2,<?php echo $cartas['2']['idCarta'];?>,'<?php echo $cartas['2']['nombreCarta'];?>')">
        </div>
      </div>
    </div>
    <div class="col-5 col-sm-5 col-md-3 col-lg-3">
        <h2>Top 5 mejores tiempos</h2>
        <h3>bla BLA BLA BLA tiempos</h3>
        <h3>bla BLA BLA BLA tiempos</h3>
        <h3>bla BLA BLA BLA tiempos</h3>
        <h3>bla BLA BLA BLA tiempos</h3>
        <h3>bla BLA BLA BLA tiempos</h3>
    </div>
  </div>
</div> 