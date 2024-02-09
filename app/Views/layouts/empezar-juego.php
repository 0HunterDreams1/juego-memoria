<div class="card">
    <div class="card-header col-sm-12">
      <div class="row align-items-center">
          <div class="row ml-3 justify-content-center">
              <h5 id="idIntentos" title="Intentos Actuales"><?php echo $partida['intentos'] ?></h5>
              <h5>/</h5>
              <h5 id="idIntentosTotales" title="Intentos Restantes"><?php echo $dificultad['cantIntentos'] ?></h5>
          </div>
          <input id="idContador" type="text" value="0" hidden>
          <input id="idPartida" type="text" value="<?php echo $partida['idPartida'];?>" hidden>
          <input id="idAciertos" type="text" value="<?php echo $partida['aciertos'];?>" hidden>
          <input id="idMaxAciertos" type="text" value="<?php echo $dificultad['cantCartas']/2; ?>" hidden>
          <input id="idImagenAux" name ="0" type="text" value="0" hidden>
          <label id="cantSegundosContador" type="text" hidden><?php echo $cantSegundos; ?></label>
        <div class="col-sm text-center">
          <h5>Tiempo</h5>
          <div class="row justify-content-center">
            <h5 id="idHoras"><?php echo substr($partida['tiempoEnCurso'],0,2);?></h5>
            <h5>:</h5>
            <h5 id="idMinutos"><?php echo substr($partida['tiempoEnCurso'],3,2);?></h5>
            <h5>:</h5>
            <h5 id="idSegundos"><?php echo substr($partida['tiempoEnCurso'],6,2);?></h5>
          </div>
        </div>
        <div class="col-sm-auto text-center">
          <button id="idGuardar" type="submit" class="btn btn-warning btn-sm" onClick="guardar()">Guardar</button>
          <div class="w-100"></div>
          <button id="idRendirse" type="submit" class="btn btn-danger btn-sm" onClick="rendirse()">Rendirse</button>
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
    </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-9">
        <div class="row">
          <?php if($partida['idEstadoPartida']==='1'){
            foreach ($cartasGuardadas as $indice => $cartaGuardada) { 
              if($cartaGuardada['encontrado']==='1'){?>
                <div class="card cardTamanio<?php echo $dificultad['cantCartas']; ?>">
                <img
                id="<?php echo $indice.'-carta'; ?>" 
                name="<?php echo $cartaGuardada['idCarta'];?>"
                src="<?php echo base_url($cartaGuardada['nombreCarta']); ?>" 
                class="card-img-top quitaEvento imgTamanio<?php echo $dificultad['cantCartas']; ?>" 
                onClick="meHicisteClick('<?php echo $indice.'-carta'; ?>','<?php echo $cartaGuardada['nombreCarta'];?>')">
              </div>
                <p id="<?php echo $indice;?>" hidden>true</p>
              <?php }else{?>
                <div class="card cardTamanio<?php echo $dificultad['cantCartas']; ?>">
                <img 
                id="<?php echo $indice.'-carta'; ?>" 
                name="<?php echo $cartaGuardada['idCarta'];?>"
                src="<?php echo base_url('public/images/cartaDetras.JPG'); ?>" 
                class="card-img-top imgTamanio<?php echo $dificultad['cantCartas']; ?>" 
                onClick="meHicisteClick('<?php echo $indice.'-carta'; ?>','<?php echo $cartaGuardada['nombreCarta'];?>')">
                </div>
                <p id="<?php echo $indice;?>" hidden>false</p>
                <?php } ?> 
            <?php }
          }else {
            foreach ($cartas as $indice => $carta) { ?>
              <div class="card cardTamanio<?php echo $dificultad['cantCartas']; ?>">
                  <img 
                  id="<?php echo $indice.'-carta'; ?>" 
                  name="<?php echo $carta['idCarta'];?>"
                  src="<?php echo base_url('public/images/cartaDetras.JPG'); ?>" 
                  class="card-img-top imgTamanio<?php echo $dificultad['cantCartas']; ?>" 
                  onClick="meHicisteClick('<?php echo $indice.'-carta'; ?>','<?php echo $carta['nombreCarta'];?>')">
              </div>
              <p id="<?php echo $indice;?>" hidden>false</p>
            <?php }}?>
        </div>
      </div>
      <div class="col-sm-3">
        <table class="table table-info table-striped table-sm" style="text-align:center">
          <thead>
            <tr>
              <td colspan="4">TOP 5</td>
            </tr>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Finalizado</th>
              <th scope="col">Tiempo</th>
              <th scope="col">Dificultad</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($mejoresPartidas)){
              foreach ($mejoresPartidas as $i => $mejorPartida) { ?>
              <tr>
                <th scope="row"><?php echo (int)$i+1;?></th>
                <td><?php echo $mejorPartida['fecha_Finalizado'];?></td>
                <td><?php echo $mejorPartida['tiempoEnCurso'];?></td>
                <td><?php echo $mejorPartida['nivelDificultad'];?></td>
              </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>