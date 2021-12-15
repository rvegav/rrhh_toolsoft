<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Ciudades
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
						Ciudad  | Editar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>ciudades/ciudades/update"  method="POST" novalidate="">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumCiudad">Codigo <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" id="NumCiudad" required="required" readonly value="<?php echo $ciudad->NUMCIUDAD;?>" name="NumCiudad" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desCiudad">Ciudad <span class="required">*</span>
                        </label>
                        <!--<div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="desCiudad" required="required" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $ciudad->DESCIUDAD;?>" name="desCiudad" class="form-control col-md-7 col-xs-12">
                        </div>-->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="desCiudad" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $ciudad->DESCIUDAD;?>" name="desCiudad" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="IdCiudad">Departamento 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdDepartamento" id="IdDepartamento">	
                    				<input type="text" name="Departamento" id="Departamento" class="form-control col-md-7 col-xs-12" placeholder="Buscar Departamento" disabled="disabled" />
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
                      

                      <input type="text" id="idciudad" style="visibility: hidden;" required="required"  readonly value="<?php echo $ciudad->IDCIUDAD;?>" name="idciudad" class="form-control col-md-7 col-xs-12">

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                          <a href="<?php echo base_url();?>/ciudades/ciudades/"><button type="button" class="btn btn-warning">Cancelar</button></a>

                          <!--<button type="button" name="entrar" value="ENTER" onclick="verificar_campos()" class="btn btn-success" onclick="verificar_campos()">Actualizar</button>-->

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
                <h4 class="modal-title">Lita de Departamentos</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Pais</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($departamentos)):?>

                                <?php
                                foreach($departamentos as $departamento):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $departamento->NUMDEPARTAMENTO;?>
                                    </td>
                                    <td>
                                        <?php echo $departamento->DESDEPARTAMENTO;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $departamento->DESPAIS;?>
                                    </td>
                                    <?php $datadepartamento = $departamento->IDDEPARTAMENTO."*".$departamento->DESDEPARTAMENTO."*".$departamento->NUMDEPARTAMENTO?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check2" value="<?php echo $datadepartamento;?>"><span class= "fa fa-check"></span></button>

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
    departamento = $(this).val();
  infodepartamento = departamento.split("*");
  $("#IdDepartamento").val(infodepartamento[0]);
  $("#Departamento").val(infodepartamento[2]+" - "+infodepartamento[1]);
  $("#modal-default2").modal("hide");
});

</script>