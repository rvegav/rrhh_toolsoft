<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Zona
			</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
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
				<?php if($this->session->flashdata("error")): ?>
				<div class="alert alert-danger" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						&times;
					</button>
					<strong>
						¡Error!
					</strong>
					<p>
						<?php echo $this->session->flashdata("error")?>
					</p>
				</div>
				<?php endif; ?>
				
				<div class="x_title">
					<h2>
						Zona  | Agregar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>zonas/zonas/store" method="POST">

                    	<div class="form-group <?php echo !empty(form_error("NumZona"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumZona">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="NumZona" name="NumZona" readonly value="<?php echo $maximo->MAXIMO;?>">
                          <?php endforeach;?>
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("DesZona"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesZona">Zona <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesZona" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("DesZona"))? set_value("DesZona"):'';?>" name="DesZona" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("DesZona","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                      <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="IdCiudad">Ciudad 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdCiudad" id="IdCiudad">	
                    				<input type="text" name="Ciudad" id="Ciudad" class="form-control col-md-7 col-xs-12" placeholder="Buscar Ciudad" disabled="disabled" />
                    				<span class="input-group-btn">
                        				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">
                            				<span class="fa fa-search" aria-hidden="true">
                        					</span>
                        				</button>
                    				</span>
                				</div>
                			</div>
        				</div>        
        			</div>		


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                    </form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>


<!--MODAL PARA LISTADO DE CUENTAS CONTABLES-->
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Ciudades</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($ciudades)):?>

                                <?php
                                foreach($ciudades as $ciudad):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $ciudad->NUMCIUDAD;?>
                                    </td>
                                    <td>
                                        <?php echo $ciudad->DESCIUDAD;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $ciudad->DESDEPARTAMENTO;?>
                                    </td>
                                    <?php $dataciudad = $ciudad->IDCIUDAD."*".$ciudad->DESCIUDAD."*".$ciudad->NUMCIUDAD?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check2" value="<?php echo $dataciudad;?>"><span class= "fa fa-check"></span></button>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script type="text/javascript">

$(".btn-check2").on("click", function(){
    ciudad = $(this).val();
  infociudad = ciudad.split("*");
  $("#IdCiudad").val(infociudad[0]);
  $("#Ciudad").val(infociudad[2]+" - "+infociudad[1]);
  $("#modal-default2").modal("hide");
});

</script>