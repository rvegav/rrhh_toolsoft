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
						Escala de Vacaciones  | Agregar 
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
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>vacaciones/vacaciones/store" method="POST">

                    	<div class="form-group <?php echo !empty(form_error("Desde"))? 'has-error':'';?>">
                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Desde">Desde<span class="required">*</span>
                        	</label>
                        	<div class="col-md-2 col-sm-2 col-xs-12">
                          		<input type="number" id="Desde" placeholder="Año desde" min="1" required="required" value="<?php echo !empty(form_error("Desde"))? set_value("Desde"):'';?>" name="Desde" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Desde","<span class='help-block'>","</span>" );?>
                        	</div>
                    	</div>


                    <div class="form-group <?php echo !empty(form_error("Hasta"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Hasta">Hasta <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" id="Hasta" placeholder="Año hasta" min="1" required="required" value="<?php echo !empty(form_error("Hasta"))? set_value("Hasta"):'';?>" name="Hasta" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Hasta","<span class='help-block'>","</span>" );?>
                        </div>
                    </div>


            		<div class="form-group <?php echo !empty(form_error("CantidadDias"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CantidadDias">Cantidad de dias <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" id="CantidadDias" placeholder="Cantidad de dias" min="1" required="required" value="<?php echo !empty(form_error("CantidadDias"))? set_value("CantidadDias"):'';?>" name="CantidadDias" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("CantidadDias","<span class='help-block'>","</span>" );?>
                        </div>
                    </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" id="send" class="btn btn-success">Guardar</button>
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