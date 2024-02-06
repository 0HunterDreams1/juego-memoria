<?php
$user_session = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Juego memoria - Home</title>
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('/css/estiloManual.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <!-- Custom styles for this page -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>GestionController/index">
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Juego memoria</div>
      </a>


      <!-- Divider -->
      <hr class="sidebar-divider my-0">



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Acciones
      </div>


      <!--  componentes -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-play"></i>
          <span>Jugar</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <?php if(isset($ultimaPartida) AND (isset($estadoPartida) AND $estadoPartida['descripcion'] === 'pausado')){?>
                <a id="id_nueva_partida" class="collapse-item" href="#" hidden> <i class="fas fa-cog"></i> Nueva partida</a>
                <a id="id_reanudar_partida" class="collapse-item" href="#"> <i class="fas fa-undo-alt"></i> Reanudar partida </a>
              <?php }else {?>
                <a id="id_nueva_partida" class="collapse-item" href="#"> <i class="fas fa-cog"></i> Nueva partida</a>
                <a id="id_reanudar_partida" class="collapse-item" href="#" hidden> <i class="fas fa-undo-alt"></i> Reanudar partida </a>
              <?php }?>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a id="id_historial" class="nav-link" href="#">
        <i class="fas fa-history"></i>
          <span>Historial partidas</span></a>
      </li>
      <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
      <!--  componentes -->

      <!-- Botones para las acciones -->
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="background-image: url(<?php echo base_url('public/images/tanques/tanque_01.jpg'); ?>); background-size:cover; " class="mt-0">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-0 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">
                  <?php echo '+1';?>
                </span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alertas
                </h6>
                  <?php if(isset($ultimaPartida) AND (isset($estadoPartida) AND $estadoPartida['descripcion'] === 'pausado')){?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                        <div class="icon-circle bg-warning">
                          <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">¡Tienes una partida pendiente! Presiona Jugar y luego reanudar partida. Buena suerte</div>
                      </div>
                    </a>
                <?php }else{?>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">¡Dale a nueva partida!</div>
                    </div>
                  </a>
                <?php }?>
              </div>
            </li>
            
            <div class="topbar-divider d-none d-sm-block"></div>
            <label id="cantSegundosContador" hidden>0</label>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $user_session->usu_nametag; ?></span>
                <i class="fas fa-user"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a id="idModificarPerfil" class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Modificar perfil
                  </a>
                  <a id="idBajaUsuario" class="dropdown-item" href="#">
                    <i class="fas fa-ban fa-sm fa-fw mr-2 text-gray-400"></i></i>
                    Darme de baja
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>UsuarioController/salirDelSistema">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>
          
        </nav>
        <div id="avisos"></div>
        <!-- Begin Page Content Body -->
        <div id="contenido" class="container-fluid">
          <!--------------------------------------mensajes de los modales ---------------------------------------------------->
          
          <div id="notificaciones" class="column text-center" style="background: white;">
            <?php if (isset($ultimaPartida) AND (isset($estadoPartida) AND $estadoPartida['descripcion'] != 'pausado')) {?>
              <h1 class="my-3">¡Bienvenido <?php echo $user_session->usu_nametag; ?>!</h1>
              <h2 class="my-3">Tu ultima partida fue el: <?php echo $ultimaPartida['fecha_Finalizado']; ?></h2>
              <h2 class="my-3">El resultado fue: Usted <?php echo $estadoPartida['descripcion']; ?></h2>
            <?php }else if (isset($estadoPartida) AND (isset($estadoPartida) AND $estadoPartida['descripcion'] === 'pausado')){?>
              <h1 class="my-3">¡Bienvenido <?php echo $user_session->usu_nametag; ?>!</h1>
              <h2 class="my-3">Tu ultima partida quedo pendiente desde: <?php echo $ultimaPartida['fecha_Inicio']; ?></h2>
              <h2 class="my-3">El resultado: Aún no esta concluido</h2>
            <?php }else {?>
              <h1 class="my-3">¡Bienvenido <?php echo $user_session->usu_nametag; ?>!</h1>
              <h2 class="my-3">¡Aún no has jugado una partida!</h2>
            <?php }?>
          </div>   
        </div>
        <!-- End of Main Content -->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Juego memoria 2024</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('js/demo/datatables-demo.js') ?>"></script>
  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('ajax/modificar-usuario.js') ?>"></script>
  <script src="<?php echo base_url('ajax/baja-usuario.js') ?>"></script>
  <script src="<?php echo base_url('ajax/opciones-partida.js') ?>"></script>
  <script src="<?php echo base_url('ajax/partida.js') ?>"></script>
  <script src="<?php echo base_url('ajax/modales.js') ?>"></script>
</body>

</html>