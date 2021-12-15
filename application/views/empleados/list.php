<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Empleados
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
					</i> Agregar Empleado
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
						Lista de Empleados
					</h2>
					
					<div class="clearfix">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table id="tb_empleado" class="table table-responsive table-striped table-bordered" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nro. Doc.</th>
									<th>Nombre</th>
									<th>Telefono</th>
									<th>Direccion</th>
									<th>Categoria</th>
									<th>Estado</th>
									<th>Agregado el</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php

								//echo "Esta es mi quinta frase hecha con Php!" ;
								if(!empty($empleados)):?>

									<?php
									foreach($empleados as $empleado):?>
										<tr>
											<td><?php echo $empleado->NUMEMPLEADO;?></td>
											<td><?php echo $empleado->CEDULAIDENTIDAD;?></td>
											<td><?php echo $empleado->NOMBRE;?></td>
											<td><?php echo $empleado->TELEFONO;?></td>
											<td><?php echo $empleado->DIRECCION;?></td>
											<td><?php echo $empleado->CATEGORIA;?></td>

											<?php
											$estado = $empleado->ESTADO;
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
											?>
											<td><span class="label <?php echo $label_class;?>"><?php echo $estado2; ?></span></td>
											<td><?php echo $empleado->FECHAINGRESO;?></td>
											<td><a href="<?php echo base_url()?>empleados/empleados/legajos/<?php echo $empleado->IDEMPLEADO ?>" class="btn btn-primary btn-view"><i class="fa fa-eye"></i></a><a href="<?php echo base_url();?>empleados/empleados/edit/<?php echo $empleado->IDEMPLEADO;?>" class="btn btn-warning"><i class="fa fa-edit"></i>
											</a><a href="<?php echo base_url();?>empleados/empleados/delete/<?php echo $empleado->IDEMPLEADO;?>" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a></td>
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
<div class="modal fade" id="modal-view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles del  Empleados </h4>
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
<?php // $this->load->view('template/footer');?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tb_empleado thead tr').clone(true).appendTo( '#tb_empleado thead' );
		$('#tb_empleado thead tr:eq(1) th').each( function (i) {
			var title = $(this).text().trim();
			var col = i;
			if (col=='8' || col=='0') {
				console.log(i);
				$(this).html( '' );
			}else{

				$(this).html( '<div class="input-group input-group-sm" style="width:100%"><input class="column-filter form-control input-sm input-search" type="text" id="documento_filter" placeholder="'+title+'" style="min-width:80px" value=""><span class="input-group-addon limpiar"><i class="fa fa-times"></i></span></div>');

				$( 'input', this ).on( 'keyup change', function () {
					if ( table.column(i).search() !== this.value ) {
						table
						.column(i)
						.search( this.value )
						.draw();
					}
				} );
			}		
		});
		var table = $('#tb_empleado').DataTable({
			"columnDefs": [
			{ "width": "10%", "targets": 8 }],
			"orderCellsTop": true,
			"searching": false, 
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
       // alert (base_url);
       $(".btn-view").on("click", function(){
       	var id= $(this).val();
       	$.ajax({
       		url: base_url + "empleados/empleados/view/" + id,
       		type: "POST",
       		success:function(resp){
       			$("#modal-view .modal-body").html(resp);

       		}
       	});
       })
        	//esto lee el boton eliminar y envia via ajax
        	$(".btn-delete").on("click", function(e){
        		e.preventDefault();
			//alert("borrando");
			var ruta= $(this).attr("href");
			$.ajax({
				url: ruta,
				type: "POST",
				success:function(resp){
					//se redirige a base url con la respuesta
					window.location.href= base_url + resp;	
					//alert(base_url + resp);
				}
			});
		})
        })    	

    </script>
    <style type="text/css">
    	thead input {
    		width: 120%;
    		align-content: center;
    	}
    </style>