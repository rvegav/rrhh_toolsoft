<style>
  .wizard {
    margin: 20px auto;
    background: #fff;
  }

  .wizard .nav-tabs {
    position: relative;
    margin: 20px auto;
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
  }

  .wizard > div.wizard-inner {
    position: relative;
  }

  .connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
  }

  .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
  }

  span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 35px;
  }
  span.round-tab i{
    color:#555555;
  }
  .wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;

  }
  .wizard li.active span.round-tab i{
    color: #5bc0de;
  }

  span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
  }

  .wizard .nav-tabs > li {
    width: 16%;
  }

  .wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
  }

  .wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
  }

  .wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
  }

  .wizard .nav-tabs > li a:hover {
    background: transparent;
  }

  .wizard .tab-pane {
    position: relative;
    padding-top: 50px;
  }

  .wizard h3 {
    margin-top: 0;
  }

  @media( max-width : 585px ) {

    .wizard {
      width: 90%;
      height: auto !important;
    }

    span.round-tab {
      font-size: 16px;
      width: 50px;
      height: 50px;
      line-height: 50px;
    }

    .wizard .nav-tabs > li a {
      width: 50px;
      height: 50px;
      line-height: 50px;
    }

    .wizard li.active:after {
      content: " ";
      position: absolute;
      left: 35%;
    }
  }

  .imagenredonda{     
    width:180px;
    height:180px;
    border-radius:150px;
  }


  .select2
  {
    background-color: #fff;
    border: 0 solid #aaa;
    border-radius: 0
  }
</style>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Empleados
			</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
       <?php
       if($this->session->flashdata("success")): ?>
         <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">
           &times;
         </button>
         <strong>
           ¡Buen Trabajo!
         </strong>
         <p>
           <?php echo $this->session->flashdata("success")?>
         </p>
       </div>
     </div>
   <?php endif; ?>
   <?php if($this->session->flashdata("error")): ?>
    <div class="alert alert-danger" role="alert">
     <button type="button" class="close" data-dismiss="alert">
      &times;
    </button>
    <strong>
      ¡Error!
    </strong>
    <p>
      <?php echo $this->session->flashdata("error")?>
    </p>
  </div>
<?php endif; ?>
<div class="row">
  <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" enctype="multipart/form-data" action="<?php echo base_url()?>empleados/empleados/store" method="POST" name="dato">
    <section>
      <dxiv class="wizard">
        <div class="wizard-inner">
          <div class="connecting-line"></div>
          <ul class="nav nav-tabs" role="tablist">

            <li role="presentation" class="active">
              <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Paso 1">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-user"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Paso 2">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-pencil"></i>
                </span>
              </a>
            </li>
            <li role="presentation" class="disabled">
              <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Paso 3">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-lock"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Paso 4">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-plus"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Paso 5">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-th-list"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Completado">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-ok"></i>
                </span>
              </a>
            </li>
          </ul>
        </div>

        <form role="form">
          <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="step1">
              <h3>Paso 1 - Generales</h3>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->
                        <img class="card-img-top imagenredonda" id="imgSalida" src="<?php echo base_url();?>assets/perfil.png">
                      </div>
                    </div>
                    <h5 class="card-title">Sube una foto</h5>
                    <div class="form-group">
                      <span class="btn btn-primary btn-file">
                        Subir archivo <input type="file" name="userfile" id="file-input">
                      </span>
                      <br />
                    </div>
                    <br />                     

                  </div>

                  <div class="col-md-7 col-sm-7 col-xs-12">

                    <div class="form-group <?php echo !empty(form_error("CodEmpleado"))? 'has-error':'';?>">
                      <label class="control-label control-label col-md-3 col-sm-3 col-xs-12" for="CodEmpleado">Código Empleado<span class="required">*</span>
                      </label>
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control" id="CodEmpleado" name="CodEmpleado">
                      </div>
                    </div>

                    <div class="form-group <?php echo !empty(form_error("Nombre"))? 'has-error':'';?>">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nombre">Nombres <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input id="Nombre" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" name="Nombre" placeholder="Nombres" type="text">
                      </div>
                    </div>

                    <div class="form-group <?php echo !empty(form_error("Apellido"))? 'has-error':'';?>">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Apellido">Apellidos 
                        <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" id="Apellido" placeholder="Apellidos" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Apellido" class="form-control col-md-7 col-xs-12">
                        <?php echo form_error("Apellido","<span class='help-block'>","</span>" );?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observacion <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" id="Observacion" name="Observacion" placeholder="Observacion"></textarea>
                      </div>
                    </div>

                  </div>
                  
                </div>
              </div>


              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
              </ul>
            </div>


            <div class="tab-pane" role="tabpanel" id="step2">
              <h3>Paso 2 - Personales</h3>

              <div class="row">
                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">C.I. 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="Documento" placeholder="Documento de Identidad" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Documento" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Documento","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Nacimiento
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="date" id="Nacimiento" placeholder="Nacimiento" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Nacimiento" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Nacimiento","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>


                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="Direccion" placeholder="Direccion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Direccion" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Direccion","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Ingreso 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="date" id="Ingreso" placeholder="Fecha de Ingreso" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Ingreso" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Ingreso","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>                                                        

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="Telefono" placeholder="Telefono" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Telefono" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Telefono","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Salida 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="date" id="Salida" placeholder="Fecha de Salida" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Salida" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Salida","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Celular  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="Celular" placeholder="Celular" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Celular" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Celular","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="row">
                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">RUC  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="Ruc" placeholder="Ruc" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="Ruc" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Ruc","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de Estudio  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">                                      
                      <select class="form-control select2" style="width: 100%;" name="NivelEstudio" id="NivelEstudio">
                        <?php foreach($nivelestudios as $nivelestudio):?>
                          <?php if($nivelestudio->IDNIVEL == $nivelestudio->IDNIVEL):?>
                            <option value="<?php echo $nivelestudio->IDNIVEL?>">
                              <?php echo $nivelestudio->DESNIVEL;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $nivelestudio->IDNIVEL;?>"><?php echo $nivelestudio->DESNIVEL;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>



                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado Civil  
                    <span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control select2" style="width: 100%;" name="EstadoCivil" id="EstadoCivil">
                      <?php foreach($estadociviles as $estadocivil):?>
                        <?php if($estadocivil->IDCIVIL == $estadocivil->IDCIVIL):?>
                          <option value="<?php echo $estadocivil->IDCIVIL?>">
                            <?php echo $estadocivil->DESCCIVIL;?>
                          </option>
                          <?php else:?>
                            <option value="<?php echo $estadocivil->IDCIVIL;?>"><?php echo $estadocivil->DESCIVIL;?>
                          </option>
                        <?php endif;?>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Profesion  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Profesion" id="Profesion">
                        <?php foreach($profesiones as $profesion):?>
                          <?php if($profesion->IDPROFESION == $profesion->IDPROFESION):?>
                            <option value="<?php echo $profesion->IDPROFESION?>">
                              <?php echo $profesion->DESPROFESION;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $profesion->IDPROFESION;?>"><?php echo $profesion->DESPROFESION;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nacionalidad  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Pais" id="Pais">
                        <?php foreach($paises as $pais):?>
                          <?php if($pais->IDPAIS == $pais->IDPAIS):?>
                            <option value="<?php echo $pais->IDPAIS?>">
                              <?php echo $pais->DESPAIS;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $pais->IDPAIS;?>"><?php echo $pais->DESPAIS;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?> 
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Ciudad  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Ciudad" id="Ciudad">
                        <?php foreach($ciudades as $ciudad):?>
                          <?php if($ciudad->IDCIUDAD == $ciudad->IDCIUDAD):?>
                            <option value="<?php echo $ciudad->IDCIUDAD?>">
                              <?php echo $ciudad->DESCIUDAD;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $ciudad->IDCIUDAD;?>"><?php echo $ciudad->DESCIUDAD;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?> 
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" id="sexo" name="sexo">
                        <option value="1">MASCULINO</option>
                        <option value="2">FEMENINO</option>
                      </select>
                      <?php echo form_error("Sexo","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="row">


                <div class='col-sm-6'>
                  <div class="container">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NroCuenta">Nro. Cuenta 
                      <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div id="custom-search-input">
                        <div class="input-group col-md-12 ">
                          <input type="hidden" name="IdNroCuenta" id="IdNroCuenta">
                          <input type="text" name="NroCuenta" id="NroCuenta" class="form-control col-md-7 col-xs-12" placeholder="Buscar Numero de Cuenta" disabled="disabled" />
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                              <span class="fa fa-search" aria-hidden="true">
                              </span>
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>



              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="step3">
              <h3>Paso 3 - Laborales</h3>
              <div class="row">
                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sucursal 
                    <span class="required">:</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control select2" style="width: 100%;" name="Sucursal" id="Sucursal">
                      <?php foreach($sucursales as $sucursal):?>
                        <?php if($sucursal->IDSUCURSAL == $sucursal->IDSUCURSAL):?>
                          <option value="<?php echo $sucursal->IDSUCURSAL?>">
                            <?php echo $sucursal->DESCSUCURSAL;?>
                          </option>
                          <?php else:?>
                            <option value="<?php echo $sucursal->IDSUCURSAL;?>"><?php echo $sucursal->DESSUCURSAL;?>
                          </option>
                        <?php endif;?>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Departamento" id="Departamento">
                        <?php foreach($depatamentosempresas as $departempresa):?>
                          <?php if($departempresa->IDCARGO == $departempresa->IDEMPRESA):?>
                            <option value="<?php echo $departempresa->IDEMPRESA?>">
                              <?php echo $cargo->DESDEPARTEMENTO;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $departempresa->IDDEPARTEMENTO;?>"><?php echo $departempresa->DESCDEPARTAMENTO;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Cargo" id="Cargo">
                        <?php foreach($cargos as $cargo):?>
                          <?php if($cargo->IDCARGO == $cargo->IDCARGO):?>
                            <option value="<?php echo $cargo->IDCARGO?>">
                              <?php echo $cargo->DESCARGO;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $cargo->IDCARGO;?>"><?php echo $cargo->DESCARGO;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="Categoria" id="Categoria">
                        <?php foreach($categorias as $categoria):?>
                          <?php if($categoria->IDCATEGORIA == $categoria->IDCATEGORIA):?>
                            <option value="<?php echo $categoria->IDCATEGORIA?>">
                              <?php echo $categoria->DESCATEGORIA;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $categoria->IDCATEGORIA;?>"><?php echo $categoria->DESCATEGORIA;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Salario  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control select2" style="width: 100%;" name="TipoSalario" id="TipoSalario">
                        <?php foreach($tiposalarios as $tiposalario):?>
                          <?php if($tiposalario->IDTIPOSALARIO == $tiposalario->IDTIPOSALARIO):?>
                            <option value="<?php echo $tiposalario->IDTIPOSALARIO?>">
                              <?php echo $tiposalario->DESTIPOSALARIO;?>
                            </option>
                            <?php else:?>
                              <option value="<?php echo $tiposalario->IDTIPOSALARIO;?>"><?php echo $tiposalario->DESTIPOSALARIO;?>
                            </option>
                          <?php endif;?>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                </div>

              </div>

              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                <li><button type="button" class="btn btn-primary btn-info-full next-step">Siguiente</button></li>
              </ul>
            </div>

            <div class="tab-pane" role="tabpanel" id="step4">
              <h3>Paso 4 - IPS</h3>
              <div class="row">
                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero  
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="Numero" placeholder="Número" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="NumeroIps" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("Numero","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>
                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Ingreso 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="date" id="FechaIps" placeholder="Fecha de Ingreso en IPS" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"  name="FechaIps" class="form-control col-md-7 col-xs-12">
                      <?php echo form_error("FechaIps","<span class='help-block'>","</span>" );?>
                    </div>
                  </div>
                </div>

                <div class='col-sm-6'>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Bonificacion 
                    <span class="required">:</span>
                  </label>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="checkbox" class="flat" name="Bonificacion" value="1" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                </div>

              </div>

              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                <li><button type="button" class="btn btn-default next-step">Omitir</button></li>
                <li><button type="button" class="btn btn-primary btn-info-full next-step">Siguiente</button></li>
              </ul>
            </div>

            <div class="tab-pane" role="tabpanel" id="step5">
              <h3>Paso 5 - Hijos</h3>
              <div class="row">

                <div class="container">
                  <div class="row clearfix">
                    <div class="col-md-12 column">
                      <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                          <tr >
                            <th class="text-center">
                              #
                            </th>
                            <th class="text-center">
                              Nombre(s)
                            </th>
                            <th class="text-center">
                              Apellido(s)
                            </th>
                            <th class="text-center">
                              Sexo
                            </th>
                            <th class="text-center">
                              Fecha de Nacimiento
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr id='addr0'>
                            <td>
                              1
                            </td>
                            <td>
                              <input type="text" name='nombrehijo[]'  placeholder='Nombre(s)' class="form-control" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"/>
                            </td>
                            <td>
                              <input type="text" name='apellidohijo[]'  placeholder='Apellido(s)' class="form-control" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();"/>
                            </td>
                            <td>
                              <select class="form-control" id="sexohijo[]" name="sexohijo[]">
                                <option value="1">MASCULINO</option>
                                <option value="2">FEMENINO</option>
                              </select>
                            </td>
                            <td>
                              <input type="date" name='fechanachijo[]' placeholder='Fecha de Nacimiento' class="form-control"/>
                            </td>
                          </tr>
                          <tr id='addr1'></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <ul class="list-inline pull-right">
                   <li><a id="add_row" class="btn btn-default pull-left">Agregar Registro</a></li>
                   <li><a id='delete_row' class="pull-right btn btn-default">Eliminar Registro</a></li>
                 </ul>
               </div>

             </div>
             <ul class="list-inline pull-right">
              <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
              <li><button type="button" class="btn btn-default next-step">Omitir</button></li>
              <li><button type="button" class="btn btn-primary btn-info-full next-step">Siguiente</button></li>
            </ul>
          </div>

          <div class="tab-pane" role="tabpanel" id="complete">
            <h3>Completado</h3>
            <p>Se comppleto con exito todos los pasos!.</p>
            <ul class="list-inline pull-right">                                
              <li>
                <button type="submit" class="btn btn-success">Guardar</button>
              </button>
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </form>
  </div>
</section>
</form>
</div>
</div>
</div>
</div>
<style type="text/css">
  .btn-file {
    position: relative;
    overflow: hidden;
  }
  .btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
  }
</style>
</div>

<!--MODAL PARA LISTADO DE CUENTAS CONTABLES-->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Lista de Ciudades</h4>
        </div>
        <div class="modal-body">
          <table id="example2" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Nro Cuenta</th>
                <th>Tipo de Cuenta</th>
                <th>Banco</th>
                <th>Opcion</th>
              </tr>
            </thead>
            <tbody>
             <!--  <?php print_r($empleados);?>-->
             <?php

                                //echo "Esta es mi quinta frase hecha con Php!" ;
             if(!empty($nrocuentas)):?>

              <?php $i = 1;?>
              <?php
              foreach($nrocuentas as $nrocuenta):?>

               <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
               <!--<?php print_r($empleados) ;?>-->
               <!-- <?php print_r($empleado) ;?>-->
               <tr>
                <td>
                  <?php echo $i++;?>
                </td>
                <td>
                  <?php echo $nrocuenta->NUMCUENTA;?>
                </td>
                <td>
                  <?php echo $nrocuenta->DESTIPOCUENTA;?>

                </td>
                <td>
                  <?php echo $nrocuenta->DESBANCO;?>
                </td>
                <?php $datanrocuenta = $nrocuenta->NUMCUENTA."*".$nrocuenta->DESTIPOCUENTA."*".$nrocuenta->DESBANCO."*".$nrocuenta->IDTIPOCUENTA."*".$nrocuenta->IDBANCO?>


                <td>

                  <button type = "button" class="btn btn-success btn-check" value="<?php echo $datanrocuenta;?>"><span class= "fa fa-check"></span></button>

                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  $(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

      var $target = $(e.target);

      if ($target.parent().hasClass('disabled')) {
        return false;
      }
    });

    $(".next-step").click(function (e) {

      var $active = $('.wizard .nav-tabs li.active');
      $active.next().removeClass('disabled');
      nextTab($active);

    });
    $(".prev-step").click(function (e) {

      var $active = $('.wizard .nav-tabs li.active');
      prevTab($active);

    });


    var i=1;
    $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='nombrehijo[]' type='text' placeholder='Nombres' class='form-control input-md' font style='text-transform: uppercase;' onkeyup='javascript:this.value = this.value.toUpperCase ();'  /> </td<td><input type='text' name='apellidohijo[]'  placeholder='Apellido(s)' class='form-control' font style= ¿text-transform: uppercase;' onkeyup='javascript:this.value = this.value.toUpperCase ();'/></td>td><select class='form-control' id='sexohijo[]' name='sexohijo[]'><option>Masculino</option><option>Femenino</option></select></td><td><input  name='fechanachijo[]' type='date' placeholder='Fecha de Nacimiento'  class='form-control input-md'></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
    });
    $("#delete_row").click(function(){
     if(i>1){
       $("#addr"+(i-1)).html('');
       i--;
     }
   });

  });

  function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
  }
  function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
  }


  $(window).load(function(){

   $(function() {
    $('#file-input').change(function(e) {
      addImage(e); 
    });

    function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;

      if (!file.type.match(imageType))
       return;

     var reader = new FileReader();
     reader.onload = fileOnload;
     reader.readAsDataURL(file);
   }

   function fileOnload(e) {
    var result=e.target.result;
    $('#imgSalida').attr("src",result);
  }
});

 });


  $(".btn-check").on("click", function(){
    nrocuenta = $(this).val();
    infonrocuenta = nrocuenta.split("*");
    $("#IdNroCuenta").val(infonrocuenta[0]+" - "+infonrocuenta[3]+" - "+infonrocuenta[4]);
    $("#Nrocuenta").val(infonrocuenta[2]+" - "+infonrocuenta[1]);
    $("#modal-default").modal("hide");


    var t = $('#example2').DataTable( {
      "columnDefs": [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
      } ],
      "order": [[ 1, 'asc' ]]
    } );
    
    t.on( 'order.dt search.dt', function () {
      t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
      } );
    } ).draw();

  });

</script>
