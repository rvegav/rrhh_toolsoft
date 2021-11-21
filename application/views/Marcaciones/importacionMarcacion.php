<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Importacion de Marcaciones de Empleados
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
			<main role="main" class="inner cover">
				<form >				
					<div class="row">
						<div class="col-md-2 col-sm-3 col-xs-12 profile_left">
							<div class="form-group">
								<span class="btn btn-primary btn-file" id="confirmar">
									Subir archivo <input type="file" name="userfile" id="file-input">
								</span>
								<br/>
							</div>                    
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<button class="btn btn-success" type="button" id="confirmarDatos">Confirmar Datos</button>
						</div>
					</div>

				</form>
				<div id="contenido_archivo" style="height:350px">
					<table class="table table-responsive" id="tab_marcacion">
						<thead>
							<tr>
								<th class="text-center">Empleado</th>
								<th class="text-center">Fecha de Marcacion</th>
								<th class="text-center">Entrada/Salida</th>
							</tr>
						</thead>
						<tbody id="tab_marcacion_body"></tbody>
					</table>
				</div>
			</main>
		</div>
	</div>
</div>
<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
<script type="text/javascript">
	$("#file-input").change(function(){
		var file = $("#file-input").val();
		if(file!=''){
			console.log($("#file-input").prop('files')[0]);
			var file = $("#file-input").prop('files')[0];
			var form_data = new FormData();
			form_data.append('userfile', file);
			$.ajax({
				url: 'procesar_carga',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				data: form_data,
				beforeSend: function(xhr) {

					var h = '<p>Se está procesando el archivo '+file['name']+'</p><img src="./assets/img/Spinner.gif" width="50">';

					$("#mensajeProceso").html(h);
				},
				xhr: function(){
					var xhr = $.ajaxSettings.xhr() ;
					xhr.onprogress = function(event){
						console.log(event);
					};
					xhr.upload.onprogress = function(evt){
						console.log('progress', evt.loaded/evt.total*100)
					};
					xhr.upload.onload = function(){
						console.log('DONE!')
					};
					return xhr ;
				},
			})
			.done(function(resp) {
				var res = JSON.parse(resp);
				console.log(res);
				var html ='';
				var entradaSalida ='';
				for (var i = 0; i < res.length; i++) {

					html+='<tr>';
					html+='<td class="text-center">'+res[i].EMPLEADO+'</td>';
					html+='<td class="text-center">'+res[i].FECHA_MARCACION+'</td>';
					if (res[i].AM_PM=='EA') {
						entradaSalida = 'ENTRADA DIARIA';
					}
					if (res[i].AM_PM=='SA') {
						entradaSalida = 'SALIDA ALMUERZO';
					}
					if (res[i].AM_PM=='EP') {
						entradaSalida = 'ENTRADA ALMUERZO';
					}
					if (res[i].AM_PM=='SP') {
						entradaSalida = 'SALIDA DIARIA';
					}
					html+='<td class="text-center">'+entradaSalida+'</td>';
					html+='</tr>';
				}
				$('#tab_marcacion_body').html(html);
				$('#tab_marcacion').DataTable({
					'lengthMenu':[[10, 15, 20], [10, 15, 20]],
					'paging':true,
					'info':true,
					'filter':true,
					'stateSave':true,
					'processing':true,
					'searching':true,
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
					},
				});
				$("#mensajeProceso").hide();

				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		}else{
			alert('Debe seleccionar un archivo');
		}
	});
	$("#confirmarDatos").on('click', function(){
		$.ajax({
			url: 'insert_marcacion',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
		})
		.done(function(resp) {
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
</script>