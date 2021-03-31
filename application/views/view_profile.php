<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA  | Registro </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css">
   <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/template/AdminLTE.min.css">
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login"><b>SISTEMA </b>  | J.R Ingeniería</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Registrarse en el Sistema</p>
    <?php
      $ok=$this->session->flashdata('success');
       if (isset($_SESSION['success'])) {?>
      <div class="alert alert-success"><?php echo $ok;?></div>
    <?php } ?>
    <?php echo validation_errors('<div class="alert alert-danger">','</div>');?>
    <form action="registro" method="POST">
          <div class="form-group has-feedback">
            <label>Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre y Apellido" name="name" id="name" >
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <label>Login</label>
            <input type="text" class="form-control" placeholder="Ingrese usuario" name="username" id="username" >
            <span class="fa fa-user form-control-feedback"></span>
          </div>

           <div class="form-group has-feedback">
             <label>Email</label>
            <input type="email"  placeholder="Email Valido por Favor" class="form-control" name="email" id="email" >
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
                <label>Password</label>
            <input type="password" class="form-control" placeholder="Clave Secreta" name="password" id="password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
                <label>Repite Password</label>
            <input type="password" class="form-control" placeholder="Clave Secreta" name="password2" id="password">
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <button type="submit" class="btn btn-success btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <button type="reset" class="btn btn-primary btn-block btn-flat">Limpiar</button>
            </div><!-- /.col -->
          </div>
        </form>
<!-- jQuery -->
    <script src="<?php echo base_url();?>assets/template/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/template/nprogress/nprogress.js"></script>
   <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/template/build/js/custom.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
