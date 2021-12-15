<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Monedas
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
						Monedas  | Editar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>monedas/monedas/update"  method="POST" novalidate="">

					<div class="form-group <?php echo !empty(form_error("NumMoneda"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumMoneda">Codigo <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">                          
                                <input type="text" class="form-control" id="NumMoneda" readonly name="NumMoneda" value="<?php echo $moneda->NUMMONEDA;?>">                          
                        </div>
                    </div>

                    <div class="form-group <?php echo !empty(form_error("DesMoneda"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesMoneda">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesMoneda" placeholder="Moneda" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo $moneda->DESMONEDA;?>" name="DesMoneda" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("DesMoneda","<span class='help-block'>","</span>" );?>
                        </div>
                    </div>

                    <div class="form-group <?php echo !empty(form_error("Simbolo"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Simbolo">Simbolo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Simbolo" placeholder="Simbolo" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo $moneda->SIMBOLO;?>" name="Simbolo" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Simbolo","<span class='help-block'>","</span>" );?>
                        </div>
                    </div>

                    <div class="form-group">
                     <div class="form-check form-check-inline">
                     	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="imputable">Prioridad <span class="required">*</span>
                        </label>
					</div>
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

                      
                    <input type="text" id="IdMoneda" style="visibility: hidden;" required="required"  readonly value="<?php echo $moneda->IDMONEDA;?>" name="IdMoneda" class="form-control col-md-7 col-xs-12">

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