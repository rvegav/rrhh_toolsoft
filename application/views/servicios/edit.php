<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Servicios
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
				<div class="alert alert-success" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						&times;
					</button>
					<strong>
						¡Buen Trabajo!
					</strong>
					<p>
						<?php echo $this->session->flashdata("error")?>
					</p>
				</div>
				<?php endif; ?>
				
				<div class="x_title">
					<h2>
						Servicios  | Editar 
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
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>servicios/servicios/update"  method="POST" novalidate="">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idServicio">Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="idServicio" required="required"  readonly value="<?php echo $servicio->idServicio;?>" name="idServicio" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      
                      <div class="form-group <?php echo !empty(form_error("desServicio"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desServicio">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="desServicio" required="required" value="<?php echo !empty(form_error("desServicio"))? set_value("desServicio"):$servicio->desServicio;?>" name="desServicio" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("desServicio","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>

                      <div class="form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
	                        <div class="col-md-9 col-sm-9 col-xs-12">
	                          <div class="">
	                            <label>
	                            	<?php
										$estado= $servicio->estServicio;
										$selected="";
										$selected2="";
										$selected3="";
										if ($estado=="1")
										{
											$selected="selected";
										}elseif ($estado=="2")
										{
											$selected2="selected";
										}else
										{
											$selected3="selected";
										}
									?>
	                               <select class="form-control" id="estServicio" name="estServicio" value="<?php echo $estado;?>" required>
										<option value="1" <?php echo $selected; ?>>Activo</option>
										<option value="2" <?php echo $selected2; ?>>Inactivo</option>
										<option value="3" <?php echo $selected3; ?>>Anulado</option>
								  	</select>
	                            </label>
	                          </div>
	                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>