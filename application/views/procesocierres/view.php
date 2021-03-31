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
										Empleado
									</th>
									<th>
										Dias
									</th>
									<th>
										Horas
									</th>

									<th>
										Importe
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
                                 <!--  <?php print_r($movimientos) ;?>-->
                                 

								<tr>
									<td>
										<?php echo $movimiento->NUMMOVI;?>
									</td>
									<td>
										<?php echo $movimiento->EMPLEADO;?>
									</td>
									<td>
										<?php echo $movimiento->DIAS;?>
									</td>
									<td>
										<?php echo $movimiento->HORAS;?>
									</td>
									
									<td>
										<?php echo $movimiento->IMPORTE;?>
									</td>


									
									<td>

										<!-- <button type="button" class="btn btn-primary btn-view" data-toggle="modal" data-target="#modal-view" value="<?php echo $movimiento->IDMOVI;?>">
											<i class="fa fa-eye">
											</i> -->
										</button>
										<!-- <a href="<?php echo base_url();?>movimientos/movimientos/edit1/<?php echo $movimiento->IDMOVI;?>" class="btn btn-warning">
											<i class="fa fa-pencil">
											</i>
										</a> -->

										<a href="#" onclick="eliminarView(<?php echo $movimiento->IDMOVIDETALLE ?>)" class="btn btn-danger btn-delete">
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
              $("#modal-view .modal-body").html(resp);
            //alert(resp);
            }
          });
        })
        	//esto lee el boton eliminar 
        	y envia via ajax
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
		});
});   


function eliminarView(id){
	if(confirm("Esta seguro que desea eliminar este detalle?")){
		
		window.location.href = "/isupport/movimientos/movimientos/deleteView/" + id;

		
	}
}    	


</script>