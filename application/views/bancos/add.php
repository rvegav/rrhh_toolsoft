<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Bancos
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
						Banco  | Agregar 
					</h2>
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>bancos/bancos/store" method="POST" novalidate="">

                    	<div class="form-group <?php echo !empty(form_error("NumBanco"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumBanco">Código Banco<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="NumBanco" name="NumBanco" readonly value="<?php echo $maximo->MAXIMO;?>">
                          <?php endforeach;?>
                        </div>
                    </div>


                      <div class="form-group <?php echo !empty(form_error("desBanco"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desBanco">Banco <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="desBanco" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("desBanco"))? set_value("desBanco"):'';?>" name="desBanco" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("desCargo","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>



                     <div class="form-group <?php echo !empty(form_error("direccion"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Direccion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="direccion" placeholder="Direccion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("direccion"))? set_value("direccion"):'';?>" name="direccion" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("direccion","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                     <div class="form-group <?php echo !empty(form_error("telefono"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Telefono <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono" placeholder="Telefono" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("telefono"))? set_value("telefono"):'';?>" name="telefono" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("telefono","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                     <div class="form-group <?php echo !empty(form_error("email"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electronico <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" placeholder="email" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("email"))? set_value("email"):'';?>" name="email" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("email","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                     <div class="form-group <?php echo !empty(form_error("web"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="web">Direccion Web <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="web" placeholder="Direccion Web" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("web"))? set_value("web"):'';?>" name="web" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("web","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


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
