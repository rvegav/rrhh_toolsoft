<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Cargo
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>cargos/cargos/add" class="btn btn-dark">
					<i class="fa fa-plus">
					</i> Usuarios
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
						Lista de Usuarios
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
									<th>#</th>
									<th>Empleado</th>
									<th>Usuario</th>
									<th>Rol</th>
									<th>Empresa</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($usuarios)):?>
								<?php
								foreach($usuarios as $usuario):?>
								<tr>
									<td><?php echo $usuario->IDUSUARIO; ?></td>
									<td><?php echo $usuario->NOMBRE .' '. $usuario->APELLIDO;?></td>
									<td><?php echo $usuario->ROL;?></td>
									<td><?php echo $usuario->EMPRESA;?></td>
									<td><?php echo $usuario->FECHA_GRABACION;?></td>
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

										<button type="button" class="btn btn-primary btn-view" data-toggle="modal" data-target="#modal-view" value="<?php echo $cargo->IDCARGO;?>">
											<i class="fa fa-eye">
											</i>
										</button>
										<a href="<?php echo base_url();?>cargos/cargos/edit/<?php echo $cargo->IDCARGO;?>" class="btn btn-warning">
											<i class="fa fa-pencil">
											</i>
										</a>
										<a href="#" id="<?=$cargo->IDCARGO;?>" class="btn btn-danger btn-delete eliminar">
											<i class="fa fa-trash-o">
											</i>
										</a>
										
									</td>
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


	<!-- Modal -->
<div class="modal fade" id="modal-view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles del Cargo </h4>
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
<script>
 $(document).ready(function(){
 	var base_url= "<?php echo base_url();?>";
       // alert (base_url);
        $(".btn-view").on("click", function(){
          var id= $(this).val();
          $.ajax({
            url: base_url + "cargos/cargos/view/" + id,
            type: "POST",
            success:function(resp){
              $("#modal-view .modal-body").html(resp);
            //alert(resp);
            }
          });
        })
        	//esto lee el boton eliminar y envia via ajax
         $(".btn-delete").on("click", function(e){
			e.preventDefault();
			//alert("borrando");
			var ruta= $(this).attr("href");
		//	alert(ruta);
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


 function eliminar__(id){
	if(confirm("Esta seguro que desea eliminar este registro?")){
		
		window.location.href = "/isupport/cargos/cargos/delete/" + id;
		

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
var id = $(this).attr('id');
swal({
  title: "Atención",
  text: "Esta seguro de eliminarlo de forma permanente",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   window.location.href = "/isupport/cargos/cargos/delete/" + id;
  }
});
});


</script>