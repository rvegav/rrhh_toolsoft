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
						Empresa  | Editar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>empresas/empresas/update"  method="POST" novalidate="">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="codempresa">Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="codempresa" required="required"  readonly value="<?php echo $empresa->codempresa;?>" name="codempresa" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      
                      <div class="form-group <?php echo !empty(form_error("nomfantasia"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nomfantasia">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nomfantasia" required="required" value="<?php echo !empty(form_error("nomfantasia"))? set_value("nomfantasia"):$empresa->nomfantasia;?>" name="nomfantasia" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("nomfantasia","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>

                     <!-- <div class="form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
	                        <div class="col-md-9 col-sm-9 col-xs-12">
	                          <div class="">
	                            <label>
	                            	<?php
										$estado= $empleado->estadoEmpleado;
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
	                               <select class="form-control" id="estadoEmpleado" name="estadoEmpleado" value="<?php echo $estado;?>" required>
										<option value="1" <?php echo $selected; ?>>Activo</option>
										<option value="2" <?php echo $selected2; ?>>Inactivo</option>
										<option value="3" <?php echo $selected3; ?>>Anulado</option>
								  	</select>
	                            </label>
	                          </div>
	                        </div>
                      </div> --> 
                      
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