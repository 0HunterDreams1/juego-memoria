<div class="container py-4" style="  background: white;">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
      <p>elegiste la dificultad: <?php echo $dificultad['nivelDificultad']; ?></p>
      <p>Intentos restantes: <?php echo $partida['intentosRestantes']; ?></p>
      <p>Tiempo Limite: <?php echo $partida['tiempoLimite']; ?></p>
      <p>Tipo Cartas: <?php echo $partida['tipoCarta']; ?></p>
      <?php foreach ($cartas as $indice => $carta) { ?>
        <p>Id Carta: <?php echo $carta['idCarta']; ?></p>
        <p>Ubicacion carta: <?php echo $carta['nombreCarta']; ?></p>
      <?php } ?>
    </div>

  </div>


</div> 