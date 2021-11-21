  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo base_url()?>" class="brand-link"> 
      <span class="brand-text font-weight-light">TOOLSOFT</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="user-profile"><img src="<?php echo $this->session->userdata("PERFIL") ?>" width="100px" height="100px"></a>
          <p class="d-block" style="color:white;font-size:12px"><?php echo  $this->session->userdata("NOMBRE")?></p>
          <p class="d-block" style="color:white;font-size:12px">ÚLTIMA CONEXIÓN:</p>
        </div>
      </div>
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget ="treeview" role="menu" data-accordion ="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-table"></i>
              <p>
                Archivos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>ciudades" class="nav-link">
                  <p>Ciudades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>paises/paises" class="nav-link">
                  <p>Paises</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>departamentos/departamentos" class="nav-link">
                  <p></p>Departamentos
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>departamentoempresas/departamentoempresas" class="nav-link">
                  <p>Departamentos de la Empresa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>nivelestudios/nivelestudios" class="nav-link">
                  <p>Nivel Estudio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>profesiones/profesiones" class="nav-link">
                  <p>Profesion</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>bancos/bancos" class="nav-link">
                  <p>Banco</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>tipocuentas/tipocuentas" class="nav-link">
                  <p>Tipo de Cuenta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>sucursales/sucursales" class="nav-link">
                  <p>Sucursal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>cargos/cargos" class="nav-link">
                  <p>Cargo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>categorias/categorias" class="nav-link">
                  <p>Categoria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>tiposalarios/tiposalarios" class="nav-link">
                  <p>Tipo de Salario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>estadociviles/estadociviles" class="nav-link">
                  <p>Estado Civil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>vacaciones/vacaciones" class="nav-link">
                  <p>Escala de Vacaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>feriados/feriados" class="nav-link">
                  <p>Feriados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>monedas/monedas" class="nav-link">
                  <p>Moneda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>tipomovimientos/tipomovimientos" class="nav-link">
                  <p>Tipo de Movimiento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>empresas/empresas" class="nav-link">
                  <p>Empresa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url()?>" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                Empleados
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>empleados/empleados" class="nav-link">
                  <p>Empleados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>empleados/empleados" class="nav-link">
                  <p>Legajo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url()?>" class="nav-link">
              <i class="fa fa-desktop"></i>
              <p>
                Liquidación de Salario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>movimientos/movimientos" class="nav-item">
                  <p>Movimientos de Salario</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>procesocierres/procesocierres/add" class="nav-item">
                  <p>Generar Proceso de Cierre</p>
                </a>
              </li>     
            </ul>
          </li>    
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="fa fa-edit"></i> 
              <p>
                Gestión de usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>roles/Roles" class="nav-link">
                  <p>Gestionar Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>Usuarios/Usuario/add" class ="nav-link">
                  <p>Registrar Usuarios</p>
                </a>
              </li>                    
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="fa fa-bar-chart-o"></i>
              <p> Gestionar pagos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="chartjs.html">
                  <p>Generacion de archivo de salario</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="chartjs2.html">
                  <p>Generacion de archivo de aguinaldo</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="chartjs2.html">
                  <p>Generacion de archivo de Ips</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="fa fa-clone"></i>
              <p>Generar informes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="fixed_sidebar.html">
                  <p>Lista de Empleados</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="fixed_footer.html">
                  <p>Listado de Sueldos y Jornales</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="fixed_footer.html">
                  <p>Resumen de personas ocupadas</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="fixed_footer.html">
                  <p>Listado de Hijos</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="fixed_footer.html">
                  <p>Salario Resumen</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="fa fa-bar-chart-o"></i>
              <p>Gestionar Contabilidad 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>plancuentas/plancuentas">
                  <p>Cuenta Contable</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>informediarios/informediarios/add">
                  <p>Informe Diario</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="chartjs2.html">
                  <p>Libro Diario detalle</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    
  <!-- <div class="sidebar-footer hidden-small">
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
/top navigation -->