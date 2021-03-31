<style type="text/css">
	.my-custom-scrollbar {
		position: relative;
		height: 100px;
		overflow: auto;
	}
	.table-wrapper-scroll-y {
		display: block;
	}
</style>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Usuarios
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
					Usuarios  | Agregar 
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
					<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="" method="POST" novalidate="">

						<div class="form-group">
							<div class="row">
								<div class="col-md-3" >
									<div class="col-md-10 col-md-offset-1">
										
										<h3>Perfil de Usuario</h3>
									</div>

									<div class="profile_img">
										<div id="crop-avatar">
											<!-- Current avatar -->
											<img class="card-img-top imagenredonda" id="imgSalida" src="<?php echo base_url();?>assets/perfil.png">
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-6">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Empleado:</label>
											<div class="input-group">
												<input type="hidden" name="empleado[]" id="empleadoCi" >
												<input type="text" name="empleado[]" id="empleado" placeholder="Buscar Empleado" class="form-control" disabled="disabled" />
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-empleado">
														<i class="fa fa-search" aria-hidden="true">
															
														</i>
													</button>
												</span>
											</div>

										</div>
										<div class="col-md-6">
											<label class="control-label col-md-5 col-sm-5 col-xs-12">Nombre de Usuario:</label>
											<div class="input-group">
												<input class="form-control" type="text" name="username" placeholder="Usuario">
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="form-group col-md-6">
													<div class="input-group">
														<span class="input-group-addon">Roles:</span>
														<select name="EMPLEADO1_detalle" id="modulo" class="form-control select2">
															<?php foreach($roles as $rol):?>
																<option value="<?php echo $rol->idrol;?>"><?php echo $rol->descripcion;?></option>
															<?php endforeach;?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<button class="btn btn-block"><i class="fa fa-plus"></i></button>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="table-wrapper-scroll-y my-custom-scrollbar">
														<table class="table table-responsive table-bordered">
															<thead>
																<tr>
																	<th>Item</th>
																	<th>Rol</th>
																	<th>Accion</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																	<td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
																<tr>
																	<td>1</td>
																	<td>Admin</td>
																</tr>
															</tbody>
														</table>
														
													</div>
													
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												
												<label class="control-label col-md-5 col-sm-5 col-xs-12">Contraseña Generada:</label>
												<div class="input-group">
													<input class="form-control" type="text" name="username">
												</div>
												<div class="row">
													<div class="col-md-5 col-md-offset-5">
														<button class="btn btn-success btn-block ">Generar Contraseña</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="reset" class="btn btn-primary">Resetear</button>
									<button type="submit" class="btn btn-success">Guardar Usuario</button>
								</div>
							</div>

						</form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>
<div class="modal fade" id="modal-empleado">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Lista de Empleados</h4>
				</div>
				<div class="modal-body">
					<table id="example2" class="table table-responsive table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Nro. Cedula</th>
								<th>Nombre</th>
								<th>Opcion</th>
							</tr>
						</thead>
						<tbody>
							<!--  <?php print_r($empleados);?>-->
							<?php

                                //echo "Esta es mi quinta frase hecha con Php!" ;
							if(!empty($empleados)):?>

								<?php
								foreach($empleados as $empleado):?>
									<tr>
										<td>
											<?php echo $empleado->CEDULAIDENTIDAD;?>
										</td>
										<td>
											<?php echo $empleado->NOMBRE;?>

										</td>
										<?php $dataEmpleado = $empleado->CEDULAIDENTIDAD.'*'.$empleado->NOMBRE?>

										<td>
											<button type = "button" class="btn btn-success btn-check2" value="<?php echo $dataEmpleado;?>"><span class= "fa fa-check"></span></button>
										</td>
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
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<script type="text/javascript">
		$(".btn-check2").on("click", function(){
			var empleado = $(this).val();
			infoEmpleado = empleado.split("*");
			$('#empleado').val(infoEmpleado[1]);
			$('#empleadoCi').val(infoEmpleado[0]);
			$("#modal-empleado").modal("hide");
		});
	</script>