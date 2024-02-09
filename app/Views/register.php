<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrar</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-registrar-image">
          <img class="registrar-image" src="<?php echo base_url('public/images/juego-memoria-registro.jpg') ?>" alt=""></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">¡Crear una cuenta!</h1>
              </div>
              <br>
              <form class="user" method="POST" action="<?php echo base_url(); ?>UsuarioController/registrarUsuario">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-user" id="usu_nametag" name="usu_nametag" placeholder="Nametag" autofocus value ="<?php if(isset($usu_nametag)){ echo $usu_nametag; } ?>" required>
                  <input type="email" class="form-control form-control-user" id="usu_correo" name="usu_correo"placeholder="Correo electrónico" value ="<?php if(isset($usu_correo)){ echo $usu_correo; } ?>" required>
                </div>  
                <div class="input-group mb-3">
                  <span class="input-group-text form-control form-control-user" id="basic-addon3">Fecha de nacimiento</span>
                  <input type="date" class="form-control form-control-user" id="usu_fecha" name="usu_fecha" value ="<?php if(isset($usu_fecha)){ echo $usu_fecha; } ?>" required>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-user" id="usu_password" name="usu_password" placeholder="Contraseña" value ="<?php if(isset($usu_password)){ echo $usu_password; } ?>" required>
                  <input type="password" class="form-control form-control-user" id="r_usu_password" name="r_usu_password" placeholder="Repetir contraseña" required>
                </div>
                <button class="btn btn-primary btn-user btn-block" type="submit">Registrarse</button>
              </form>
              <?php if (isset($validation)) { ?>
                      <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                      </div>
                    <?php } ?>
                    <?php if (isset($error)) { ?>
                      <div class="alert alert-danger">
                        <?php echo $error; ?>
                      </div>
                    <?php } ?>
                    <div class="text-center">
                <label> *Todos los campos son obligatorios</label>
              </div>
              <div class="text-center">
                <a class="medium" href="<?php echo base_url('LoginController/index') ?>">¿Ya tienes una cuenta? ¡Ingresa!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('js/sb-admin-2.js') ?>"></script>
</body>

</html>
