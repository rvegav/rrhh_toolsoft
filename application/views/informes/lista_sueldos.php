<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Generacion de Informes</h3>
		</div>
	</div>
	<!-- <div class="clearfix"></div> -->
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php if($this->session->flashdata("success")): ?>
				<div class="x_panel">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Buen Trabajo!</strong>
						<p><?php echo $this->session->flashdata("success")?></p>
					</div>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata("error")): ?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>¡Error!</strong>
					<p><?php echo $this->session->flashdata("error")?></p>
				</div>
			<?php endif; ?>
			<div class="x_title">
				<h2>Listado de sueldos y Jornales| Generar</h2>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form id="frm_generar" name="frm_generar" data-parsley-validate="" class="form-horizontal form-label-left" method="POST" action="<?php echo base_url() ?>informe_sueldo" novalidate="">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="movimiento">Periodo:</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input type="Text" name="Periodo" class="form-control">
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-4 col-md-offset-3">
								<button type="submit" class="btn btn-success btn-block">Generar</button>
							</div>
						</div>
					</form>
				</div> <!-- /COL  12-->
			</div><!-- /ROW -->
		</div><!-- / content -->
	</div>
</div>
</div>
<!------------------------------------------------------------------------------------------------->
<script type="text/javascript">
	var base_url= "<?php echo base_url();?>";

</script>