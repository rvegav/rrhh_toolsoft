<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Sucursal
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
						Sucursal  | Agregar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>sucursales/sucursales/store" method="POST">

                    	<div class="form-group <?php echo !empty(form_error("NumSucursal"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumSucursal">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="NumSucursal" name="NumSucursal" readonly value="<?php echo $maximo->MAXIMO;?>">
                          <?php endforeach;?>
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("desSucursal"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesSucursal">Sucursal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesSucursal" placeholder="Ingrese Sucursal" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("DesSucursal"))? set_value("DesSucursal"):'';?>" name="DesSucursal" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("DesSucursal","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>

                    <!--   <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="IdDepartamento">Zona 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdZona" id="IdZona">	
                    				<input type="text" name="Zona" id="Zona" class="form-control col-md-7 col-xs-12" placeholder="Buscar Zona" disabled="disabled" />
                    				<span class="input-group-btn">
                        				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">
                            				<span class="fa fa-search" aria-hidden="true">
                        					</span>
                        				</button>
                    				</span>
                				</div>
                			</div>
        				</div>        
        			</div>	 -->	


                    <div class="form-group <?php echo !empty(form_error("Direccion"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Direccion">Direccion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Direccion" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo !empty(form_error("Direccion"))? set_value("Direccion"):'';?>" name="Direccion" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Direccion","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                      <div class="form-group <?php echo !empty(form_error("Telefono"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Telefono">Telefono <span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Telefono" placeholder="TELEFONO" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo !empty(form_error("Telefono"))? set_value("Telefono"):'';?>" name="Telefono" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Telefono","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                       <!-- <div class="form-group <?php echo !empty(form_error("NroPatronal"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Telefono">Nro Registro Patronal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="NroPatronal" placeholder="Ingrese nro Patronal" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("NroPatronal"))? set_value("NroPatronal"):'';?>" name="NroPatronal" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("NroPatronal","<span class='help-block'>","</span>" );?>
                        </div>
                      </div> -->


                      

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
                <h4 class="modal-title">Lita de Zonas</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Zona</th>
                            <th>Ciudad</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($zonas)):?>

                                <?php
                                foreach($zonas as $zona):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $zona->NUMZONA;?>
                                    </td>
                                    <td>
                                        <?php echo $zona->DESZONA;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $zona->DESCIUDAD;?>
                                    </td>
                                    <?php $datazona = $zona->IDZONA."*".$zona->DESZONA."*".$zona->NUMZONA."*".$zona->DESCIUDAD?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check2" value="<?php echo $datazona;?>"><span class= "fa fa-check"></span></button>

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
    zona = $(this).val();
  infozona = zona.split("*");
  $("#IdZona").val(infozona[0]);
  $("#Zona").val(infozona[2]+" - "+infozona[1]);
  $("#modal-default2").modal("hide");
});

</script>