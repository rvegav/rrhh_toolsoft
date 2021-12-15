<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Movimientos
			</h3>
		</div>
	</div>
	<div class="clearfix">
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-12" align="right">
				<a href="<?php echo base_url();?>movimientos/movimientos/add" class="btn btn-dark">
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
					<h2>
						Lista de Movimientos
					</h2>
					
					<div class="clearfix">
					</div>
				</div>

                  

				<div class="row">
					<div class="col-md-12">


                           <!--prueba cabecera -->
                       
                       <!--hasta aca la prueba de cabecera-->

						<table id="example2" class="table table-striped table-bordered btn-hover">
							<thead>
								<tr>
									<th>
										#
									</th>
									<th>
										Numero de Movi
									</th>
									<th>
										Fecha de Movimiento
									</th>
									<th>
										Tipo de Movimiento
									</th>

								
									
									<th>
										Opciones
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//echo "Esta es mi quinta frase hecha con Php!" ;
								if(!empty($movimientos)):?>

								<?php
								foreach($movimientos as $movimiento):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                  <!--<?php print_r($movimientos) ;?>-->
                                 

								<tr>
									<td>
										<?php echo $movimiento->IDMOVI;?>
									</td>
									<td>
										<?php echo $movimiento->NUMMOVI;?>
										
									</td>
									<td>
										<?php echo $movimiento->FECHAMOVI;?>

									</td>
									<td>
										<?php echo $movimiento->DESTIPOMOV;?>
									</td>
									
									
									<td>

										 <button type="button" class="btn btn-primary btn-view" data-toggle="modal" data-target="#modal-view" value="<?php echo $movimiento->IDMOVI;?>">
											<i class="fa fa-eye">
											</i>
										</button> 

                                        
										<a href="<?php echo base_url();?>movimientos/movimientos/edit/<?php echo $movimiento->IDMOVI;?>" class="btn btn-warning">
											<i class="fa fa-pencil">
											</i>
										</a>
										<a href="#" onclick="eliminar(<?php echo $movimiento->IDMOVI; ?>);" class="btn btn-danger btn-delete">

										<!--<a href="<?php //echo base_url();?>movimientos/movimientos/delete/<?php //echo $movimiento->IDMOVI;?>" class="btn btn-danger btn-delete">-->
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
</div>
	<!-- Modal -->
<div class="modal fade" id="modal-view">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles de Movimientos </h4>
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
 	var base_url= "<?php echo base_url();?>";
       // alert (base_url);
        $(".btn-view").on("click", function(){
          var id= $(this).val();
          $.ajax({
            url: base_url + "movimientos/movimientos/view/" + id,
            type: "POST",
            success:function(resp){
              //$("#modal-view .modal-body").html(resp);
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


// PROPIEDAD CLIK DE EDITAR
  //        $(".btn-warning").on("click", function(e){
		// 	e.preventDefault();
		// 	//alert("borrando");
		// 	var ruta= $(this).attr("href");
		// //	alert(ruta);
		// 	$.ajax({
		// 		url: ruta,
		// 		type: "POST",
		// 		success:function(resp){
		// 			//se redirige a base url con la respuesta
		// 			window.location.href= base_url + resp;	
		// 			//alert(base_url + resp);

		// 				}
		// 		});
		// })
         //HASTA ACA BOTON EDITAR

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