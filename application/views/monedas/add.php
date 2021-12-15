<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Moneda
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
						Moneda  | Agregar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>monedas/monedas/store" method="POST" name="dato">

                    <div class="form-group <?php echo !empty(form_error("NumMoneda"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumMoneda">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="NumMoneda" name="NumMoneda" readonly value="<?php echo $maximo->MAXIMO;?>">
                          <?php endforeach;?>
                        </div>
                    </div>

                    <div class="form-group <?php echo !empty(form_error("DesMoneda"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesMoneda">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesMoneda" placeholder="Moneda" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(	form_error("DesMoneda"))? set_value("DesMoneda"):'';?>" name="DesMoneda" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("DesMoneda","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>

                     <div class="form-group <?php echo !empty(form_error("Simbolo"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Simbolo">Simbolo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Simbolo" placeholder="Simbolo" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("Simbolo"))? set_value("Simbolo"):'';?>" name="Simbolo" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Simbolo","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>

				<div class="form-group">
                    
                </div>

                <!-- Default unchecked -->
                <div class="form-group">
                	<div class="form-check">
                		<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Decimal">Decimales 
                			<span class="required">*</span>
                    	</label>
                		<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="custom-control custom-checkbox">
    							<input type="checkbox" class="custom-control-input" name="Decimal" id="Decimal">
							</div>
						</div>
					</div>
				</div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button id="send" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                    </form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script> 

<script type="text/javascript">
$(document).ready(function() {

    $('#send').click(function(){    	
		//alert($('#name').val().length);
        if ($('#NumCuentacontable').val().length < 1) 
        {
			swal ( "Debe introducir el Codigo de la cuenta." ) ;
			return false;
		}

		if ($('#NumCuentacontable').val().length < 14) {
			swal ( "Debe introducir el Codigo de la cuenta correcto." ) ;
			return false;
		}

		if ($('#desPlancuenta').val().length < 1) {
			swal ( "Debe introducir la Descripcion de la cuenta." ) ;
			return false;
		}
		
    });
});

$("#NumCuentacontable").mask("9.99.99.99.999");
</script>