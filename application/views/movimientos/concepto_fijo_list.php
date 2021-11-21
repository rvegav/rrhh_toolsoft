<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Conceptos Fijos Activos
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>add_concepto_fijo"  id="prueba" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Agregar Concepto
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
					<div class="col-md-10">
						<h2>
							Listado de Conceptos Fijos
						</h2>
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
									<th>Tipo</th>
									<th>Monto Total</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php

								if(!empty($conceptos)):?>

									<?php
									$cont=0;
									foreach($conceptos as $concepto):?>
										<tr>
											<?php $cont++ ?>
											<td><?php echo $cont;?></td>
											<td><?php echo $concepto->TIPOMOVIMIENTO;?></td>
											<td><?php echo $concepto->IMPORTE_TOTAL;?></td>
											<td><button class="btn btn-primary listEmpleado" data-placement="top" data-toggle="modal" data-target="#mdlEmpleados" value="<?php echo $concepto->IDTIPO ?>"title="Ver Empleados Asociados"><i class="fa fa-list"></i></button><a href="<?php echo base_url();?>edit_conceptos/<?php echo $concepto->IDTIPO;?>"><button class="btn btn-success" data-placement="top" title="Editar Movimiento"><i class="fa fa-edit"></i></button></a></td>
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
				</div>
				<div class="modal-body">
					<table id="tabEmpleado" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Nro. Cedula</th>
								<th>Nombre(s) y Apellido(s)</th>
								<th>Monto</th>
								<th>Desde</th>
								<th>Hasta</th>
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
		<script type="text/javascript">
			$(document).ready(function(){
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
			$(".listEmpleado").on("click", function(){
        tipo = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>get_empleados_conceptos',
            data: {tipo:tipo},
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
            	html += resp[i].IMPORTE;
           		html += '</td>';
           		html += '<td>';
            	html += resp[i].DESDE;
           		html += '</td>';
           		html += '<td>';
            	html += resp[i].HASTA;
           		html += '</td>';
            	html += '</tr>';

            }
           $("#tabEmpleado tbody").append(html);

        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });

    });
			function eliminar(id){
				if(confirm("Esta seguro que desea eliminar este registro?")){

					window.location.href = "/isupport/movimientos/movimientos/delete/" + id;


		/*$.ajax({
            url: "/isupport/movimientos/movimientos/delete/" + id,
            type: "GET",
            success:function(resp){
              //$("#modal-view .modal-body").html(resp);
              alert('Registro Eliminado correctamente');
            //alert(resp);
            }
          });*/
        }
      }


    </script>