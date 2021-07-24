<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Cuenta Contable
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
					Cuenta Contable  | Editar 
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
					<form id="demo-form2" class="form-horizontal form-label-left" action="<?php echo base_url();?>plancuentas/plancuentas/update"  method="POST" novalidate="">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumPlanCuenta">Codigo <span class="required">*</span></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" id="NumPlanCuenta" required="required" readonly value="<?php echo $cuenta->NUMPLANCUENTA;?>" name="NumPlanCuenta" class="form-control">
							</div>
						</div>


						<div class="form-group <?php echo !empty(form_error("subCuenta"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subCuenta">Sub-Cuenta<span class="required">*</span></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" id="subCuenta" placeholder="Sub-Cuenta" style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo $cuenta->DESCPLANCUENTA;?>" name="subCuenta" class="form-control">
							<?php echo form_error("subCuenta","<span class='help-block'>","</span>" );?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="DESPLANCUENTA	">Descripcion <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="desPlanCuenta" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $cuenta->DESCPLANCUENTA;?>" name="desPlanCuenta" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<div class="form-check form-check-inline">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="imputable">Imputable <span class="required">*</span>
								</label>
								<div class="col-md-2">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="radio" class="form-check-input" id="materialInline1" name="inlineMaterialRadiosExample" value="1" <?php echo set_value('asentable', $cuenta->ASENTABLE) == 'S' ? "checked" : "";?>>
										<label class="form-check-label" for="materialInline1">Si</label>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="radio" class="form-check-input" id="materialInline2" name="inlineMaterialRadiosExample" value="0" <?php echo set_value('asentable', $cuenta->ASENTABLE) == 'N' ? "checked" : "";?>>
										<label class="form-check-label" for="materialInline2">No</label>
									</div>
								</div>
							</div> 
						</div>

						<div class="form-group <?php echo !empty(form_error("nivel"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nivel">Nivel <span class="required">*</span>
							</label>
							<div class="col-xs-1">
								<input type="number" id="nivel" placeholder="Nivel" required="required" value="<?php echo $cuenta->NIVELCUENTA;?>" name="nivel" class="form-control col-md-7 col-xs-12">
								<?php echo form_error("nivel","<span class='help-block'>","</span>" );?>
							</div>
						</div>
						<input type="text" id="idcuentacontable" style="visibility: hidden;" required="required"  readonly value="<?php echo $cuenta->IDPLANCUENTA;?>" name="idcuentacontable" class="form-control col-md-7 col-xs-12">

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