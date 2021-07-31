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
					Cuenta Contable  | Agregar 
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
					<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>plancuentas/plancuentas/store" method="POST" novalidate="" name="dato">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subCuenta">Cuenta Padre <span class="required">*</span></label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<select class="form-control" id="cuentaPadre" name="cuentaPadre">
									<option value="">Cuenta Superior</option>
									<?php foreach ($cuentas_padre as $cuenta): ?>
										<option value="<?php echo $cuenta->IDPLANCUENTA ?>"><?php echo $cuenta->NUMPLANCUENTA ?> - <?php echo $cuenta->CUENTA?></option>
									<?php endforeach ?>
								</select>
								
							</div>
						</div>
						<div class="form-group <?php echo !empty(form_error("NumCuentacontable"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumCuentacontable">Código de la Cuenta<span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" name="NumCuentacontable" id = "NumCuentacontable" class="form-control" data-inputmask="'mask': 9.99.99.99.999" pattern="[1-9]" placeholder="X.XX.XX.XX.XXX" > 
							</div>
						</div>

						<div class="form-group <?php echo !empty(form_error("desPlancuenta"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="desPlancuenta">Descripcion <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="desPlancuenta" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("desPlancuenta"))? set_value("desPlancuenta"):'';?>" name="desPlancuenta" class="form-control col-md-7 col-xs-12">
								<?php echo form_error("desPlancuenta","<span class='help-block'>","</span>" );?>
							</div>
						</div>

						<div class="form-group">
							<div class="form-check form-check-inline">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="imputable">Imputable <span class="required">*</span>
								</label>
								<div class="col-md-2">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="radio" class="form-check-input" id="materialInline1" name="rad_imputable" value="S">
										<label class="form-check-label" for="materialInline1">Si</label>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="radio" class="form-check-input" id="materialInline2" name="rad_imputable" value="N" checked>
										<label class="form-check-label" for="materialInline2">No</label>
									</div>
								</div>
							</div> 
						</div>



						<div class="form-group <?php echo !empty(form_error("nivel"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nivel">Nivel <span class="required">*</span>
							</label>
							<div class="col-xs-1">
								<input type="number" id="nivel" placeholder="Nivel" required="required" value="<?php echo !empty(form_error("nivel"))? set_value("nivel"):'';?>" name="nivel" class="form-control col-md-7 col-xs-12">
								<?php echo form_error("nivel","<span class='help-block'>","</span>" );?>
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

			if ($('#NumCuentacontable').val().length < 1) {
				swal ( "Debe introducir el Codigo de la cuenta." ) ;
				return false;
			}

			// if ($('#NumCuentacontable').val().length < 14) {
			// 	swal ( "Debe introducir el Codigo de la cuenta correcto." ) ;
			// 	return false;
			// }

			if ($('#desPlancuenta').val().length < 1) {
				swal ( "Debe introducir la Descripcion de la cuenta." ) ;
				return false;
			}

		});
		$('#nivel').val(1);

		console.log($("#cuentaPadre").val());
	});
	
	$("#cuentaPadre").on('change', function(){
		var cuenta = $(this).val();
		if(cuenta){
			$.ajax({
				type:'POST',
				url:'getPlanCuenta',
				data:{cuenta: cuenta},
				})
			.done(function (resp){
				var valorespuesta=JSON.parse(resp);
				console.log(valorespuesta);
				$('#NumCuentacontable').val(valorespuesta.NUMPLANCUENTA);
				$('#nivel').val(parseInt(valorespuesta.NIVELCUENTA) + 1)
				$("#nivel").prop('readonly', true);
			})
			.fail(function(){
				alert('ocurrio un error interno, contacte con el Soporte Técnico');
			});
		}else{
			$('#nivel').val(1);
			$("#nivel").prop('readonly', false);
			$('#NumCuentacontable').val('');

		}
	});
	$("#NumCuentacontable").mask("9.99.99.99.999");
</script>