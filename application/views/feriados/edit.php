<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Feriados
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
							?Buen Trabajo!
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
						?Error!
					</strong>
					<p>
						<?php echo $this->session->flashdata("error")?>
					</p>
				</div>
				<?php endif; ?>
				
				<div class="x_title">
					<h2>
						Feriados  | Editar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>feriados/feriados/update"  method="POST">

							<div class="form-group <?php echo !empty(form_error("Fecha"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Fecha">Fecha<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="date" id="Fecha" placeholder="Ingrese Fecha" min="1" required="required" value="<?php echo $feriado->FECHA;?>" name="Fecha" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Fecha","<span class='help-block'>","</span>" );?>
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("Motivo"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Motivo">Motivo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Motivo" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo $feriado->MOTIVO;?>" name="Motivo" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Motivo","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                      <input type="text" id="IdFeriado" style="visibility: hidden;" required="required"  readonly value="<?php echo $feriado->IDFERIADO;?>" name="IdFeriado" class="form-control col-md-7 col-xs-12">

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Actualizar</button>
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

<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script> 

<script type="text/javascript">
$(document).ready(function() {
   
    $('#send').click(function(){

    	var motivo = $('#Motivo').val(); 

		if ($.trim(motivo).length < 1) 
		{
			swal ( "Favor ingrese motivo del feriado" ) ;
			return false;
		}

    });

 });

</script>

