<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Legajo del Empleado: <?php echo $legajos[0]->nombre.' '.$legajos[0]->apellido ?>
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>empleados/empleados/add" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Agregar nueva incidencia
				</a>
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
			<?php
			if($this->session->flashdata("error")): ?>
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
			<div class="x_panel">
				<div class="x_title">
					<h2>
						Lista de Incidencias
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
					<div class="clearfix">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table id="tb_empleado" class="table table-striped table-bordered btn-hover" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo Documento</th>
									<th>Tipo Incidencia</th>
									<th>Fecha de Incidencia</th>
									<th>Agregado el</th>
									<th>Observacion</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($legajos)):?>
									<?php
									foreach($legajos as $legajo):?>
										<!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
										<tr>
											<td><?php echo $legajo->idlegajo;?></td>
											<td><?php echo $legajo->documento;?></td>
											<td><?php echo $legajo->incidencia;?></td>
											<td><?php echo $legajo->fecha;?></td>
											<td><?php echo $legajo->fecgrabacion;?></td>
											<td><?php echo $legajo->observacion;?></td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>
</div>
</div>
<?php // $this->load->view('template/footer');?>