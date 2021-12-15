<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Escala de Vacaciones
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
						Escala de Vacaciones  | Editar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>vacaciones/vacaciones/update"  method="POST">

                      <div class="form-group <?php echo !empty(form_error("Desde"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Desde">Desde <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">                        
                                <input type="number" class="form-control" id="Desde" name="Desde" value="<?php echo $vacacion->DESDE;?>" placeholder="Año Desde" min="1">
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("Hasta"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Hasta">Hasta <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" id="Hasta" placeholder="Año Hasta" required="required" name="Hasta" class="form-control col-md-7 col-xs-12" value="<?php echo $vacacion->HASTA;?>" min="1">
                          <?php echo form_error("Hasta","<span class='help-block'>","</span>" );?>
                      </div>
                        </div>
                      

                      <div class="form-group <?php echo !empty(form_error("CantidadDias"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CantidadDias">Cantidad de Dias <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" id="CantidadDias" placeholder="Cantidad de Dias" required="required" name="CantidadDias" class="form-control col-md-7 col-xs-12" value="<?php echo $vacacion->CANTIDADDIAS;?>" min="1">
                          <?php echo form_error("CantidadDias","<span class='help-block'>","</span>" );?>
                      </div>
                        </div>
                      

                      <input type="text" id="IdVacacion" style="visibility: hidden;" required="required"  readonly value="<?php echo $vacacion->IDVACACION;?>" name="IdVacacion" class="form-control col-md-7 col-xs-12">

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" id="send" class="btn btn-success">Actualizar</button>
                          <!--<button type="button" name="entrar" value="ENTER" onclick="verificar_campos()" class="btn btn-success" onclick="verificar_campos()">Actualizar</button>-->

                        </div>
                      </div>

                    </form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>

<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>

<script type="text/javascript">
$(document).ready(function() {
   	
    $('#send').click(function(){    		        
         
		var desde = $('#Desde').val();
		var hasta = $('#Hasta').val();

		if (parseInt($.trim(desde)) > parseInt($.trim(hasta))) 
		{
			swal ( "Desde no puede ser mayor que hasta, favor verifique...");
			return false;
		}

    });

 });

</script>