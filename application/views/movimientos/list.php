<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Movimientos para liquidacion
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>movimientos/movimientos/add"  id="prueba" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Agregar Movimiento
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
					<div class="row">
						<div class="col-md-8">
							<h2>
								<!-- Listado de Movimientos correspondiente al mes de <b><?php echo $mes; ?></b> -->
							</h2>
						</div>
						<div class="col-md-2">
							
						</div>
						
					</div>
					<div class="clearfix">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table id="tb_empleado" class="table table-responsive table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nro. Movimiento</th>
									<th>Fecha Movimiento</th>
									<th>Tipo</th>
									<th>Monto Total</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php

								//echo "Esta es mi quinta frase hecha con Php!" ;
								if(!empty($movimientos)):?>

									<?php
									foreach($movimientos as $movimiento):?>

										<!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->

										<tr>
											<td><?php echo $movimiento->IDMOVI;?></td>
											<td><?php echo $movimiento->NUMMOVI;?></td>
											<td><?php echo $movimiento->FECHAMOVI;?></td>
											<td><?php echo $movimiento->DESTIPOMOV;?></td>
											<td><?php echo $movimiento->MONTO_TOTAL;?></td>
											<td><button class="btn btn-primary listEmpleado" value="<?php echo $movimiento->IDMOVI ?>" data-toggle="modal" data-placement="top" data-target="#mdlEmpleados" title="Ver Empleados Asociados"><i class="fa fa-list"></i></button><a href="<?php echo base_url();?>movimientos/movimientos/edit/<?php echo $movimiento->IDMOVI ?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar Movimiento"><i class="fa fa-edit"></i></button></a></td>
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
<!-- Modal -->
<div class="modal fade" id="mdlEmpleados">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles de Movimientos </h4>
				</div>
				<div class="modal-body">
					<table id="tabEmpleado" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Nro. Cedula</th>
								<th>Nombre(s) y Apellido(s)</th>
								<th>Tipo Movimiento</th>
								<th>Monto</th>
								<th>Fecha Movimiento</th>
							</tr>
						</thead>
						<tbody >
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
<?php // $this->load->view('template/footer');?>
<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script type="">
	$(document).ready(function(){
		var table = $('#tb_empleado').DataTable({
				"orderCellsTop": true,
	            "language": {
	            	"lengthMenu": "Mostrar _MENU_ registros por pagina",
	            	"zeroRecords": "No se encontraron Resultados!",
	            	"searchPlaceholder": "Buscar registros",
	            	"info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
	            	"infoEmpty": "No existen registros",
	            	"infoFiltered": "(Filtrado de un total de _MAX_ registros)",
	            	"search": "Buscar:",
	            	"paginate": {
	            		"first": "Primero",
	            		"last" : "Ultimo",
	            		"next" : "Siguiente",
	            		"previous" : "Anterior"
	            	},
	            }
	        });
		var base_url= "<?php echo base_url();?>";
		$(".btn-view").on("click", function(){
			var id= $(this).val();
			$.ajax({
				url: base_url + "movimientos/movimientos/view/" + id,
				type: "POST",
				success:function(resp){

					$("#modal-view .modal-body").html(resp);

				}
			});
		})
		$(".btn-delete").on("click", function(e){
			e.preventDefault();
			var ruta= $(this).attr("href");
			$.ajax({
				url: ruta,
				type: "POST",
				success:function(resp){
					window.location.href= base_url + resp;	
				}
			});
		})

	});

	function eliminar(id){
		if(confirm("Esta seguro que desea eliminar este registro?")){

			window.location.href = "<?php echo base_url(); ?>/movimientos/movimientos/delete/" + id;
		}
	}
	$(".listEmpleado").on("click", function(){
		idmovi = $(this).val();
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()?>get_empleados_movimiento',
			data: {idmovi:idmovi},
		})
		.done(function (data){
			var resp = JSON.parse(data);
			console.log(resp);
			var html ="";
			$("#tabEmpleado tbody").html('');
			for (var i = 0; i < resp.length; i++) {
				html += '<tr>';
				html += '<td>';
				html += resp[i].CEDULAIDENTIDAD;
				html += '</td>';
				html += '<td>';
				html += resp[i].EMPLEADO;
				html += '</td>';
				html += '<td>';
				html += resp[i].TIPO;
				html += '</td>';
				html += '<td>';
				html += resp[i].IMPORTE;
				html += '</td>';
				html += '<td>';
				html += resp[i].FECHAMOVI;
				html += '</td>';
				html += '</tr>';

			}
			$("#tabEmpleado tbody").append(html);

		})
		.fail(function(){
			alert('ocurrio un error interno, contacte con Rolo');
		});

	});

</script>