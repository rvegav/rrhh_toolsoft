
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-table"></i> Archivos <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url();?>ciudades/ciudades">Ciudades</a></li>
          <li><a href="<?php echo base_url();?>paises/paises">Paises</a></li>
          <li><a href="<?php echo base_url();?>departamentos/departamentos">Departamentos</a></li>
          <li><a href="<?php echo base_url();?>departamentoempresas/departamentoempresas">Departamentos de la Empresa</a></li>
          <li><a href="<?php echo base_url();?>nivelestudios/nivelestudios">Nivel Estudio</a></li>
          <li><a href="<?php echo base_url();?>profesiones/profesiones">Profesion</a></li>
          <li><a href="<?php echo base_url();?>bancos/bancos">Banco</a></li>
          <!-- <li><a href="<?php echo base_url();?>cuentabancarias/cuentabancarias">Cuenta Bancaria</a></li> -->
          <li><a href="<?php echo base_url();?>tipocuentas/tipocuentas">Tipo de Cuenta</a></li>
          <li><a href="<?php echo base_url();?>sucursales/sucursales">Sucursal</a></li>
          <li><a href="<?php echo base_url();?>cargos/cargos">Cargo</a></li>
          <li><a href="<?php echo base_url();?>categorias/categorias">Categoria</a></li>
          <li><a href="<?php echo base_url();?>tiposalarios/tiposalarios">Tipo de Salario</a></li>
          <li><a href="<?php echo base_url();?>estadociviles/estadociviles">Estado Civil</a></li>
          <li><a href="<?php echo base_url();?>vacaciones/vacaciones">Escala de Vacaciones</a></li>
          <li><a href="<?php echo base_url();?>feriados/feriados">Feriados</a></li>
          <li><a href="<?php echo base_url();?>monedas/monedas">Moneda</a></li>
          <li><a href="<?php echo base_url();?>tipomovimientos/tipomovimientos">Tipo de Movimiento</a></li>
          <li><a href="<?php echo base_url();?>empresas/empresas">Empresa</a></li>
<!--           <li><a href="<?php echo base_url();?>empresas/empresas">Conceptos de Salario</a></li>
          <li><a href="<?php echo base_url();?>empresas/empresas">Hijos</a></li>
          <li><a href="<?php echo base_url();?>empresas/empresas">Tipos de Incidencias</a></li>
          <li><a href="<?php echo base_url();?>empresas/empresas">Horarios</a></li>   -->
        </ul>
      </li>
      <li><a><i class="fa fa-table"></i> Empleados <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url();?>empleados/empleados">Empleados</a></li>
          <li><a href="<?php echo base_url();?>empleados/empleados">Legajo</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-desktop"></i> Liquidaci??n de Salario <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url();?>">Importacion de Marcaciones</a></li>
          <li><a href="<?php echo base_url();?>">Generacion de faltas</a></li>
          <li><a href="<?php echo base_url();?>movimientos/movimientos">Movimientos de Salario</a></li>
          <li><a href="<?php echo base_url();?>procesocierres/procesocierres/add">Generar Proceso de Cierre</a></li>     
        </ul>
      </li>    
      <li><a><i class="fa fa-edit"></i> Gesti??n de usuarios <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url();?>roles/Roles">Gestionar Roles</a></li>
          <li><a href="<?php echo base_url();?>Usuarios/Usuario/add">Registrar Usuarios</a></li>                    
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart-o"></i> Gestionar pagos <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="chartjs.html">Generacion de archivo de salario</a></li>
          <li><a href="chartjs2.html">Generacion de archivo de aguinaldo</a></li>
          <li><a href="chartjs2.html">Generacion de archivo de Ips</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-clone"></i>Generar informes <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="fixed_sidebar.html">Lista de Empleados</a></li>
          <li><a href="fixed_footer.html">Listado de Sueldos y Jornales</a></li>
          <li><a href="fixed_footer.html">Resumen de personas ocupadas</a></li>
          <li><a href="fixed_footer.html">Listado de Hijos</a></li>
          <li><a href="fixed_footer.html">Salario Resumen</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart-o"></i>Gestionar Contabilidad <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?php echo base_url();?>plancuentas/plancuentas">Cuenta Contable</a></li>
          <li><a href="<?php echo base_url();?>informediarios/informediarios/add">Informe Diario</a></li>
          <li><a href="chartjs2.html">Libro Diario detalle</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Config">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>

  <a data-toggle="tooltip" data-placement="top" id="fullscreen" title="Pantalla Completa, ESC para Salir">
    <span class="glyphicon glyphicon-fullscreen" onclick="launchFullScreen(document.documentElement);" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Bloquear Sistema">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a href="<?php echo base_url();?>auth/logout" data-toggle="tooltip" data-placement="top" title="Salir">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
</div>
</div>


<div class="top_nav">
  <div class="nav_menu">

    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $this->session->userdata("PERFIL") ?>">
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;"><?php echo  $this->session->userdata("NOMBRE")?></a></li>
            <li><a href="javascript:;"> Perfil</a></li>
            <li><a href="javascript:;">Ayuda</a></li>
            <li><a href="<?php echo base_url();?>auth/logout"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
</div>
<!-- /top navigation -->
