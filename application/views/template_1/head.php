<!DOCTYPE html> 
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title> RRHH | Toolsoft</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">    
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  
  <!-- desde acá -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> -->
  <!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
  <!-- Tell the browser to be responsive to screen width -->
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstra.min.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/adminlte.min.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/AdminLTE_1.min.css"> -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontastic.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/nprogress/nprogress.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/build/css/custom.min.css"> -->
  <!-- Theme style -->
  <!-- DataTables -->  
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables/dataTables.bootstrap.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/alt/AdminLTE-select2.min.css"> -->

  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/green.css"> -->
  <!-- <link href="<?php echo base_url();?>assets/nprogress/nprogress.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->
  <!-- <link href="<?php echo base_url();?>assets/dropzone/dist/min/dropzone.min.css" rel="stylesheet"> -->

  <!-- Bootstrap core CSS -->
  
  <!-- hasta aca -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/nprogress/nprogress.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/build/css/custom.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/AdminLTE_1.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/datatables/dataTables.bootstrap.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/alt/AdminLTE-select2.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/green.css">
  <link href="<?php echo base_url();?>assets/nprogress/nprogress.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
  <!-- jQuery -->


  <script src="<?php echo base_url();?>assets/template/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/sweetalert.min.js"></script>
  <script src="<?php echo base_url();?>assets/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
  <script src="<?php echo base_url();?>assets/nprogress/nprogress.js"></script>
  <script src="<?php echo base_url();?>assets/fastclick/lib/fastclick.js"></script>    
  <script src="<?php echo base_url();?>assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo base_url();?>assets/dropzone/dist/min/dropzone.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendors/validator/validator.js"></script>


  <!-- PNotify 
  <link href="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/template/switchery/dist/switchery.min.css" rel="stylesheet"> 
-->
</head>
<body class="hold-transition sidebar-mini">
  <?php $CI =& get_instance();?>
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>logout" role="button">Cerrar Sesión
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

  <!-- <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>" class="site_title"><i class="fa fa-paw"></i> <span>RRHH</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info 
            <div class="profile">
              <div   class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>Usuario</h2>
              </div>
            </div>
            /menu profile quick info -->
            <!-- <hr> -->
