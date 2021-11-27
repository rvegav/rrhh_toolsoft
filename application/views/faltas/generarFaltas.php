<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Generacion de Faltas
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12">
				<?php if($this->session->flashdata("success")): ?>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Buen Trabajo!</strong>
						<p><?php echo $this->session->flashdata("success")?></p>
					</div>

				<?php endif; ?>
				<?php if($this->session->flashdata("error")): ?>
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">
							&times;
						</button>
						<strong>¡Ocurrio un error!</strong>
						<p><?php echo $this->session->flashdata("error")?></p>
					</div>
				<?php endif; ?>
				<div class="x_panel">
					<div class="x_title">
						<h2>
							Generacion de Faltas
						</h2>
						<div class="clearfix">
						</div>
					</div>
					<div class="row">
						<div class="row">
							
							<div class="col-md-6">
								<div class="col-md-6">
									<label>Fecha Desde:</label>
									<input type="date" name="desde" id="fecha_desde" class="form-control">
								</div>
								<div class="col-md-6">
									<label>Fecha Hasta:</label>
									<input type="date" name="hasta" id="fecha_hasta" class="form-control">
								</div>
							</div>
							<div class="col-md-6" style="margin-top:23px">
								<button type="button" id="btn_consultar" class="btn btn-dark"><i class="fa fa-search"></i>Consultar Faltas</button>
								<button type="button" id="btn_faltas" class="btn btn-dark"><i class="fa fa-plus"></i>Confirmar Faltas</button>
								<button type="button" id="btn_generar" class="btn btn-dark"><i class="fa fa-check"></i>Generar Movimiento</button>
							</div>
						</div>
						<br>
						<div class="row">
							
							<div class="col-md-12">
								<table id="tab_faltas" class="table table-striped table-bordered btn-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Empleado</th>
											<th>Tipo Falta</th>
											<th>Fecha Falta</th>
											<th>Permisos</th>
											<th>Fecha Presentacion</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div> <!-- /COL  12-->
						</div>
					</div><!-- /ROW -->
				</div><!-- / content -->
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-permiso">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Justificacion de Faltas </h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form>
						<div class="form-group col-md-4">
							<label class="control-label">Permiso:</label>
							<input type="text" class="form-control" name="permiso" id="permiso">
						</div>
						<div class="form-group col-md-4">
							<label class="control-label">Fecha Falta:</label>
							<input type="text" class="form-control" name="fechaFalta" id="fechaFalta">
						</div>
						<div class="form-group col-md-4">
							<label class="control-label">Fecha Presentacion:</label>
							<input type="text" class="form-control" name="fechaPresentacion" id="fechaPresentacion">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script src="<?php echo base_url();?>assets/template/data/dataTables.min.js"></script>

<script type="text/javascript">
	var t_faltas = $('#tab_faltas').DataTable({
		"ordering": false,
		"search":false,
		'searching':true,
		'ajax':{
			"url":"consulta_faltas",
			"type":"POST",
			"data":function(data){
				data.token=$('#token').val();
				data.desde=$('#fecha_desde').val();
				data.hasta=$('#fecha_hasta').val();
			}
		},
		'columns':[
		{data:'NRO'},
		{data:'EMPLEADO'},
		{data:'TIPO_FALTA'},
		{data:'FECHA_FALTA'},
		{data:'PERMISOS'},
		{data:'FECHA_PRESENTACION'},
		{defaultContent: '<button class="btn btn-success cargar_permiso"  data-toggle="modal" title="Cargar permiso" data-target="#modal-permiso"><i class="fa fa-edit"></i></button>', "width": '20%', 'sClass':'text-center'}
		],
		"length": false,
		'language':{
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",

      // "sLoadingRecords": "Cargando...",
      "oPaginate": {
      	"sFirst":    "Primero",
      	"sLast":     "Último",
      	"sNext":     "Siguiente",
      	"sPrevious": "Anterior"
      },
      "oAria": {
      	"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      	"sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
  }
});
	$('#btn_consultar').on('click', function(){
		t_faltas.ajax.reload();
		
	});

	$('#btn_faltas').on('click', function(){
		var desde=$('#fecha_desde').val();
		var hasta=$('#fecha_hasta').val();
		console.log(desde);
		$.ajax({
			url: 'procesar_faltas',
			type: 'POST',
			data: {
				desde: desde, hasta:hasta
			}
		})
		.done(function(resp) {
			console.log(resp);
			$(this).prop( "disabled", true );
			swal({
				type:'success',
				title:'Correcto!',
				text:'Se migró correctamente',
			});
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$('#btn_generar').on('click', function(){
		var mes=$('#fecha_desde').val();
		mes = mes.split("-");
		mes = mes[1];
		console.log(mes);
		$.ajax({
			url: 'generar_movimiento',
			type: 'POST',
			data: {
				mes: mes
			}
		})
		.done(function(resp) {
			console.log(resp);
			$(this).prop( "disabled", true );
			swal({
				type:'success',
				title:'Correcto!',
				text:'Se migró correctamente',
			});
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
	$('#tab_faltas').on('change', function(){
		alert();
	});
	$('.cargar_permiso').on('click', function(e){
		e.preventDefault();
		alert();
	});

</script>