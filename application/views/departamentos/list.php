<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Departamento 
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>departamentos/departamentos/add" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Agregar 
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
						Lista de Departamentos
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
						<table id="example2" class="table table-striped table-bordered btn-hover">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Código Departamento
									</th>
									<th>
										Descripcion
									</th>
									<th>
										Pais
									</th>
									<th>
										Fecha de Grabacion
									</th>
									<th>
										Estado
									</th>
									<th>
										Opciones
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($departamentos)):?>
									<?php
									foreach($departamentos as $departamento):?>
										<tr>
											<td>
												<?php echo $departamento->IDDEPARTAMENTO; ?>
											</td>
											<td>
												<?php echo $departamento->NUMDEPARTAMENTO;?>
											</td>
											<td>
												<?php echo $departamento->DESDEPARTAMENTO;?>
											</td>
											<td>
												<?php echo $departamento->DESPAIS;?>
											</td>
											<td>
												<?php echo $departamento->FECGRABACION;?>
											</td>

											<?php
									//$estado = $empleado->estadoEmpleado;
											$estado = 1;
											if($estado == 1)
											{
												$estado2     = "Activo";$label_class = 'label-success';
											}
											else
											{
												if($estado == 2)
												{
													$estado2     = "Inactivo";$label_class = 'label-warning';
												}
												else
												{
													$estado2     = "Anulado";$label_class = 'label-danger';
												}
											}

											;?>
											<td>
												<span class="label <?php echo $label_class;?>">
													<?php echo $estado2; ?>
												</span>
											</td>
											<td>
												<button type="button" class="btn btn-primary btn-view" data-toggle="modal" data-target="#modal-view" value="<?php echo $departamento->IDDEPARTAMENTO;?>"><i class="fa fa-eye"></i></button><a href="<?php echo base_url();?>departamentos/departamentos/edit/<?php echo $departamento->IDDEPARTAMENTO;?>" class="btn btn-warning">
													<i class="fa fa-edit"></i></a><a href="<?php echo base_url();?>departamentos/departamentos/delete/<?php echo $departamento->IDDEPARTAMENTO;?>" id="<?=$departamento->IDDEPARTAMENTO;?>" class="btn btn-danger btn-delete eliminar"><i class="fa fa-trash"></i>
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles del Departamento </h4>
			</div>
			<div class="modal-body">
				<!--en esta parte se carga los datos de la vista view-->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script>
	$(document).ready(function(){
		var base_url= "<?php echo base_url();?>";
       // alert (base_url);
       $(".btn-view").on("click", function(){
       	var id= $(this).val();
       	$.ajax({
       		url: base_url + "departamentos/departamentos/view/" + id,
       		type: "POST",
       		success:function(resp){
       			$("#modal-view .modal-body").html(resp);
       		}
       	});
       })

   })

	$(".eliminar").click(function(e){
		e.preventDefault();
		var id = $(this).attr('href');
		swal({
			title: "Atención",
			text: "Esta seguro de eliminarlo de forma permanente",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				window.location.href = id;
			}
		});
	});



</script>