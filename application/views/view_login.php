<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA  | Identificación </title>
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
<style>
  body{
    background-size: 100% 100%;
  }
  div >.login-box-body {
    opacity: 0.5;
    background-color: #595A5C;
  }
  div >.login-box-body:hover {
    opacity: 1;
  }

</style>
<body class="hold-transition login-page" style="background-image: url('<?php echo base_url()?>assets/img/fondo5.jpg'); background-size: 100% 100%;">
  <div class="login-box" >
    <div class="login-logo">
      <a href="#" style="color: white"><b>SISTEMA </b>  | RRHH</a>
      <div class="row">
        <div class="col-md-3 col-md-offset-2" >
          <img src="<?php echo base_url()?>assets/img/logo.png" width="220" height="180">
        </div>
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" >
      <p class="login-box-msg"><b>Identificarse para Iniciar Sesión</p>
        <?php if ($this->session->flashdata("error")): ?>
          <div class="alert alert-danger">
            <p><?php  echo $this->session->flashdata("error")?></p> 
          </div>
        <?php endif; ?>
        <form action="auth/login" method="post">
          <div class="form-group has-feedback">
            <!--   <label>Usuario</label> -->
            <input type="text" name="username" class="form-control" placeholder="Usuario">
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
           <!--     <label>Clave</label> -->
           <input type="password" name="password" class="form-control" placeholder="Contraseña">
           <span class="fa fa-lock form-control-feedback"></span>
         </div>
         <!-- /.col -->
         <div class="col-xs-12">
          <button type="submit" name="login" class="btn btn-success btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </form>
<!-- /.col
    <div class="social-auth-links text-center">
      <p>- O Bien -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Inicie Sesión usando Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Inicie Sesión usando Google+</a>
    </div>
    <!-- /.social-auth-links -->
    <br>  
    <!-- /.social-auth-links 
    
      <a href="reset"class="text-center"> <i class="fa fa-lock fa-fw"></i> Olvide mi Clave</a><br>  -->
  <!--  <a href="register" class="text-center"> <i class="fa fa-user fa-fw"></i> Registrarme como nuevo Usuario</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
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
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/template/iCheck/icheck.min.js"></script>
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