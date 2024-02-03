<div class="container py-4" style="  background: white;">
  <div class="row">
    <!-- seccion del formulario! -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

      <h2 id="id_titulo_dificultad" class="my-3">Elegir dificultad:</h2>

      <form id="form-dificultad" class="user">
        <fieldset id="idCampos">
          <div class="form-group">
            <label class="font-weight-bold">*Seleccionar dificultad:
              <select id="idDificultad"
                class="form-control form-control-user custom-select py-3 my-2 h-50 w-50 text-center font-weight-bold"
                name="tipo-dificultad">
                <option selected>---</option>
                <option value="baja">baja</option>
                <option value="media">media</option>
                <option value="alta">alta</option>
              </select>
            </label>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">*Seleccionar tipo de cartas:
              <select id="idTipoCartas"
                class="form-control form-control-user custom-select py-3 my-2 h-50 w-50 text-center font-weight-bold"
                name="tipo-cartas">
                <option selected>---</option>
                <option value="tanques">tanques</option>
                <option value="aviones">aviones</option>
                <option value="animales">animales</option>
              </select>
            </label>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">*Seleccionar tiempo:
              <select id="idCantTiempo"
                class="form-control form-control-user custom-select py-3 my-2 h-50 w-50 text-center font-weight-bold"
                name="cant-tiempo">
                <option selected>---</option>
                <option value="5">5 minutos</option>
                <option value="10">10 minutos</option>
                <option value="20">20 minutos</option>
                <option value="sin_tiempo">Sin tiempo</option>
              </select>
            </label>
          </div>
        </fieldset>
        <button id="idEnviar" type="submit" class="d-inline btn btn-primary btn-lg m-2">Comenzar</button>
      </form>
      <div>
        <span class="small my-2">*campos obligatorios</span>
      </div>
      <div id="respuesta" class="mt-3">
      </div>
    </div>
    <!-- seccion de los detalles! -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

      <div class="border border-warning bg-gradient-primary w-75 h-auto">
        <h2 class="p-1 my-2 font-weight-bold text-white text-center">Detalles de dificultad:</h2>
        <hr>
        <div id="detalles">
        <p class="p-2 small text-white text-center">No seleccionaste una dificultad</p>
        </div>

      </div>

    </div>

  </div>


</div>