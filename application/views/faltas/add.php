}<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Tipo Faltas
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
					Tipo Faltas  | Agregar 
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
					<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>ciudades/ciudades/store" method="POST">

						<div class="form-group <?php echo !empty(form_error("NumCiudad"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumCiudad">Código Tipo Falta<span class="required">*</span>
							</label>
							<div class="col-md-2 col-sm-2 col-xs-12">
								
								<input type="text" class="form-control" id="NumCiudad" name="NumCiudad" readonly value="<?php echo $maximo->MAXIMO;?>">
							</div>
						</div>


						<div class="form-group <?php echo !empty(form_error("desCiudad"))? 'has-error':'';?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="desCiudad">Descripcion Tipo Falta <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="desCiudad" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("desCiudad"))? set_value("desCiudad"):'';?>" name="desCiudad" class="form-control col-md-7 col-xs-12">
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
<div class="modal fade" id="modal-default2">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Lista de Ciudades</h4>
			</div>
			<div class="modal-body">
				<table id="example2" class="table table-responsive table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Pais</th>
							<th>Opcion</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(!empty($departamentos)):?>
							<?php
							foreach($departamentos as $departamento):?>
								<tr>
									<td><?php echo $departamento->NUMDEPARTAMENTO;?></td>
									<td><?php echo $departamento->DESDEPARTAMENTO;?></td>
									<td><?php echo $departamento->DESPAIS;?></td>
									<?php $datadepartamento = $departamento->IDDEPARTAMENTO."*".$departamento->DESDEPARTAMENTO."*".$departamento->NUMDEPARTAMENTO."*".$departamento->DESPAIS?>
									<td><button type = "button" class="btn btn-success btn-check2" value="<?php echo $datadepartamento;?>"><span class= "fa fa-check"></span></button></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
			</div>
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