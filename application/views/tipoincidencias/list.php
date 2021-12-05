<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Ciudad
			</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>ciudades/ciudades/add" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Agregar Ciudad
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
						<p><?php echo $this->session->flashdata("success")?></p>
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
						Listado de Ciudades
					</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
						</li>
						<li>
							<a class="close-link">
								<i class="fa fa-close"></i>
							</a>
						</li>
					</ul>
					<div class="clearfix">
					</div>
				</div>
				<div class="row">
					<!-- <div class="col-md-12"> -->
						<table id="tb_ciudad" class="table table-striped table-bordered btn-hover table-responsive" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Código Ciudad</th>
									<th>Descripcion</th>
									<th>Departamento</th>
									<th>Fecha de Grabacion</th>
									<th>Estado</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($ciudades)):?>
									<?php
									foreach($ciudades as $ciudad):?>
										<tr>
											<td><?php echo $ciudad->IDCIUDAD; ?></td>
											<td><?php echo $ciudad->NUMCIUDAD;?></td>
											<td><?php echo $ciudad->DESCIUDAD;?></td>
											<td><?php echo $ciudad->DESDEPARTAMENTO;?></td>
											<td><?php echo $ciudad->FECGRABACION;?></td>

											<?php
											$estado = 1;
											if($estado == 1){
												$estado2     = "Activo";$label_class = 'label-success';
											}else{
												if($estado == 2){
													$estado2     = "Inactivo";$label_class = 'label-warning';
												}else{
													$estado2     = "Anulado";$label_class = 'label-danger';
												}
											}
											;?>
											<td><span class="label <?php echo $label_class;?>"><?php echo $estado2; ?></span></td>
											<td>
												<a href="<?php echo base_url();?>ciudades/Ciudades/edit/<?php echo $ciudad->IDCIUDAD;?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
												<a href="<?php echo base_url();?>ciudades/Ciudades/delete/<?php echo $ciudad->IDCIUDAD;?>" class="btn btn-danger btn-delete eliminar"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					<!-- </div>  -->
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- </div> -->


<!-- Modal -->
<div class="modal fade" id="modal-view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles de la Ciudad </h4>
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
<!--<?php // $this->load->view('template/footer');?>-->
<script type="text/javascript" src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>

<script type="text/javascript" >
	$(document).ready(function(){
		$('#tb_ciudad thead tr').clone(true).appendTo( '#tb_ciudad thead' );
		$('#tb_ciudad thead tr:eq(1) th').each( function (i) {
			var title = $(this).text().trim();
			var col = i;
			if (col=='6' || col=='0') {
				console.log(i);
				$(this).html( '' );
			}else{
				$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );

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
		var table = $('#tb_ciudad').DataTable({
			dom: 'Bfrtip',
			"columnDefs": [
			{ "width": "15%", "targets": 6 }],
			"orderCellsTop": true,
			buttons: [{
				extend: 'pdfHtml5',
				text: 'Generar PDF',
				title:'Listado de Ciudades' ,
				exportOptions: {
					columns: [0,1,2,3,4,5 ]
				}, 
				customize: function ( doc ) {
					var d = new Date();
					d = d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear()+ ' ' + d.getHours()+':'+d.getMinutes()+':'+d.getSeconds() ;
					var info = [];
					info[0] = {text: d , alignment: 'right', margin:[20,20,20] };
					info[1] = {text: table.page.info().page+1 +' de '+ table.page.info().pages, alignment: 'right', margin:[0,0,20] };

					var fechaHora = []

					var objFooter = {};

					// objFooter['columns'] = info;
					// objHeader['columns'] = fechaHora;
					doc['footer']=info[1];
					doc['header']=info[0];
					doc['style']= {
						header: {
							fontSize: 22,
							bold: true, 
							color: '#eb3434'
						},
						anotherStyle: {
							italics: true,
							alignment: 'right'
						}
					};
					// doc.content.table.withs(100, '*', 200, '*');
					// console.log(table.page.info());
					// doc.content[1].table.width = ['100'];
					var content = doc.content[1].table.body;
					var colCount = new Array();
					$.each(content, function(i){
						if (i != '0') {
							var col = doc.content[1].table.body[i];
							$.each(col, function(j){
								doc.content[1].table.body[i][j].fillColor = 'white';
								doc.content[1].table.body[i][j].text = doc.content[1].table.body[i][j].text.toUpperCase();
							})
						}else{
							var col = doc.content[1].table.body[i];
							$.each(col, function(j){
								// colCount.push('*');
								doc.content[1].table.body[i].borderColor = 'red';
								// doc.content[1].table.body[i][j].color = 'red';
								// doc.content[1].table.body[i][j].bold = true;
								doc.content[1].table.body[i][j].fillColor = '#373737'
								console.log(doc.content[1].table.body[i][j].text);
							})

						}
					});
					doc.content[1].table.widths = ['auto', 'auto', 'auto', '*', '*', '*'];
					console.log(doc.content[1].table.body);

					// console.log(doc.content[1].table);
					doc.content.splice( 1, 0, {
						margin: [ 0, 0, 0, 12 ],
						alignment: 'center',
						image: 'data:image/jpeg;base64,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',
						width: 80, 
						height: 80
					} );
}
                // Data URL generated by http://dataurl.net/#dataurlmaker

            }], 
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
		url: base_url + "ciudades/ciudades/view/" + id,
		type: "POST",
		success:function(resp){
			$("#modal-view .modal-body").html(resp);
		}
	});
})
})

function eliminar_Copia(id){
	if(confirm("Esta seguro que desea eliminar este registro?")){

		window.location.href = "/isupport/ciudades/ciudades/delete/" + id;


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
