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
				<h2>Listado de Hijos | Generar</h2>
				<div class="clearfix"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form id="frm_generar" name="frm_generar" data-parsley-validate="" class="form-horizontal form-label-left" method="POST" action="<?php echo base_url() ?>informe_empleado" novalidate="">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="movimiento">Empleado:</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<select name="empleado" id="empleado" class="form-control">
									<option value="">Seleccionar Empleado</option>
									<?php foreach ($empleados as $empleado): ?>
										<option value="<?php echo $empleado->IDEMPLEADO?>"><?php echo $empleado->NOMBRE ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="mensaje"></div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Sucursal: </label>
							<div class ="col-md-4 col-sm-6 col-xs-12">
								<select name="sucursal" id="sucursal" class="form-control">
									<option value="">Seleccionar Sucursal</option>
									<?php foreach ($sucursales as $sucursal): ?>
										<option value="<?php echo $sucursal->IDSUCURSAL?>"><?php echo $sucursal->DESCSUCURSAL ?></option>
									<?php endforeach ?>
								</select>
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
	// $("#frm_generar").submit(function(event) {
	// 	event.preventDefault();
	// 	var formDato = $(this).serialize();
 //        $.ajax({
 //        	url: base_url+'informe_empleado',
 //        	type: 'POST',
 //        	data: formDato,
 //        	beforeSend: function() {
 //        		$("#mdlAguarde").modal('show');
 //        	}
 //        })
 //        .done(function(result) {
 //        	var r = JSON.parse(result);
 //        	$("#mdlAguarde").modal('hide');
 //        	const wrapper = document.createElement('div');
 //        	if (r['alerta']!="") {
 //        		var mensaje = r['alerta'];
 //        		wrapper.innerHTML = mensaje;
 //        		swal({
 //                    // buttons: true,
 //                    title: 'Atención!', 
 //                    content: wrapper,
 //                    icon: "warning",
 //                    // dangerMode: true,
 //                    columnClass: 'medium',
 //                    // theme: 'modern',
 //                });
 //        	}
 //        	if (r['error']!="") {
 //        		wrapper.innerHTML = r['error'];
 //        		swal({
 //        			icon: "error",
 //        			columnClass: 'medium',
 //        			theme: 'modern',
 //        			title: 'Error!',
 //        			content: wrapper,
 //        		});
 //        	}
 //        	if (r['correcto']!="") {
 //        		wrapper.innerHTML = r['correcto'];
 //        		swal({
 //        			icon: "success",
 //        			columnClass: 'medium',
 //        			theme: 'modern',
 //        			title: 'Correcto!',
 //        			content: wrapper,
 //        		});
 //        		window.location = base_url+r['datos'];
 //        	}
 //        }).fail(function() {
 //        	alert("Se produjo un error, contacte con el soporte técnico");
 //        	$("#mdlAguarde").modal('hide');
 //        });
 
 //    });

</script>