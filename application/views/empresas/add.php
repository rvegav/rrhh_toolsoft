<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Empresas
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

<div class="x_title">
 <h2>
  Empresas  | Agregar 
</h2>
<ul class="nav navbar-right panel_toolbox">
  <li>
   <a class="collapse-link">
    <i class="fa fa-chevron-up">
    </i>
  </a>
</li>
<li>
 <a class="close-link">
  <i class="fa fa-close">
  </i>
</a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="row">
 <div class="col-md-12">
  <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>empresas/empresas/store" method="POST" novalidate="">
    <div class="form-group <?php echo !empty(form_error("NroDocumento"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NroDocumento">Nombre de Fantasia<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nomfantasia" required="required" value="<?php echo !empty(form_error("nomfantasia"))? set_value("nomfantasia"):'';?>" name="NroDocumento" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("nomfantasia","<span class='help-block'>","</span>" );?>
      </div>



    </div><div class="form-group <?php echo !empty(form_error("nomcontribuyente"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomcontribuyente">Nombre de Empresa <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nomcontribuyente" required="required" value="<?php echo !empty(form_error("nomcontribuyente"))? set_value("nomcontribuyente"):'';?>" name="nomcontribuyente" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("nomcontribuyente","<span class='help-block'>","</span>" );?>
      </div>
    </div>



    <div class="form-group <?php echo !empty(form_error("ruccontribuyente"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ruccontribuyente">Ruc <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="ruccontribuyente" required="required" value="<?php echo !empty(form_error("ruccontribuyente"))? set_value("ruccontribuyente"):'';?>" name="ruccontribuyente" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("ruccontribuyente","<span class='help-block'>","</span>" );?>
      </div>
    </div>



    <div class="form-group <?php echo !empty(form_error("desempresa"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desempresa">Descripcion de Empresa <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="desempresa" required="required" value="<?php echo !empty(form_error("desempresa"))? set_value("desempresa"):'';?>" name="desempresa" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("desempresa","<span class='help-block'>","</span>" );?>
      </div>
    </div>
    <div class="form-group <?php echo !empty(form_error("direccion"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Direccion <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="direccion" required="required" value="<?php echo !empty(form_error("direccion"))? set_value("direccion"):'';?>" name="direccion" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("direccion","<span class='help-block'>","</span>" );?>
      </div>
    </div>


    <div class="form-group <?php echo !empty(form_error("telefono"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Telefono <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="telefono" required="required" value="<?php echo !empty(form_error("telefono"))? set_value("telefono"):'';?>" name="telefono" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("telefono","<span class='help-block'>","</span>" );?>
      </div>
    </div>


    <div class="form-group <?php echo !empty(form_error("email"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="email" required="required" value="<?php echo !empty(form_error("email"))? set_value("email"):'';?>" name="email" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("email","<span class='help-block'>","</span>" );?>
      </div>
    </div>



    <div class="form-group <?php echo !empty(form_error("nomrepresentante"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomrepresentante">Nombre de Representante <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nomrepresentante" required="required" value="<?php echo !empty(form_error("nomrepresentante"))? set_value("nomrepresentante"):'';?>" name="nomrepresentante" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("nomrepresentante","<span class='help-block'>","</span>" );?>
      </div>
    </div>


    <div class="form-group <?php echo !empty(form_error("rucrepresentante"))? 'has-error':'';?>">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rucrepresentante">Ruc de Representante <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="rucrepresentante" required="required" value="<?php echo !empty(form_error("rucrepresentante"))? set_value("rucrepresentante"):'';?>" name="rucrepresentante" class="form-control col-md-7 col-xs-12">
        <?php echo form_error("rucrepresentante","<span class='help-block'>","</span>" );?>
      </div>
    </div>

                        <!-- <div class="form-group <?php echo !empty(form_error("claveEmpleado"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="claveEmpleado">Clave de Usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="claveEmpleado" required="required" value="<?php echo !empty(form_error("claveEmpleado"))? set_value("claveEmpleado"):'';?>" name="claveEmpleado" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("claveEmpleado","<span class='help-block'>","</span>" );?>
                        </div>
                      </div> -->


                        <!-- <div class="form-group <?php echo !empty(form_error("repiteclaveEmpleado"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="repiteclaveEmpleado">Repetir Clave de Usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="repiteclaveEmpleado" required="required" value="<?php echo !empty(form_error("repiteclaveEmpleado"))? set_value("repiteclaveEmpleado"):'';?>" name="repiteclaveEmpleado" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("repiteclaveEmpleado","<span class='help-block'>","</span>" );?>
                        </div>
                      </div> -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                    </form>

                  </div> <!-- /COL  12-->
                </div><!-- /ROW -->
              </div><!-- / content -->
            </div>
          </div>
        </div>