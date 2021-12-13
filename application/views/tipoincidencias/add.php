<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Tipo Incidencias
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
					Tipo de Incidencias  | Agregar 
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
					<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>tipoincidencias/Incidencias/store" method="POST">
						<div class="form-group <?php echo !empty(form_error("NumCiudad"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numIncidencia">Código Incidencia<span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" class="form-control" id="codigo" name="codigo" readonly value="">
							</div>
						</div>
						<div class="form-group <?php echo !empty(form_error("NumCiudad"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numIncidencia">Numero Incidencia<span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<input type="text" class="form-control" id="numIncidencia" name="numIncidencia" readonly value="<?php echo $maximo->MAXIMO;?>">
							</div>
						</div>


						<div class="form-group <?php echo !empty(form_error("desCiudad"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="descTipoIncidencia">Descripcion <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="descTipoIncidencia" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("desCiudad"))? set_value("desCiudad"):'';?>" name="descTipoIncidencia" class="form-control col-md-7 col-xs-12">
								<?php echo form_error("desCiudad","<span class='help-block'>","</span>" );?>
							</div>
						</div>
						<div class="ln_solid"></div>
						<br>
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

<!-- /.modal -->
<script type="text/javascript">

	$(".btn-check2").on("click", function(){
		departamento = $(this).val();
		infodepartamento = departamento.split("*");
		$("#IdDepartamento").val(infodepartamento[0]);
		$("#Departamento").val(infodepartamento[2]+" - "+infodepartamento[1]);
		$("#modal-default2").modal("hide");
	});

</script>