<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Cuenta Bancaria
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
						Cuenta Bancaria  | Agregar 
					</h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>cuentabancarias/cuentabancarias/store" method="POST" name="dato">


                    <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="NroCuenta">Banco 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-3 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdBanco" id="IdBanco">	
                    				<input type="text" name="Banco" id="Banco" class="form-control col-md-7 col-xs-12" placeholder="Buscar Banco" disabled="disabled"  />
                    				<span class="input-group-btn">
                        				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            				<span class="fa fa-search" aria-hidden="true">
                        					</span>
                        				</button>
                    				</span>
                				</div>
                			</div>
        				</div>        
        			</div>			
				


                <div class="form-group <?php echo !empty(form_error("NroCuenta"))? 'has-error':'';?>">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NroCuenta">Nº de cuenta <span class="required">*</span>
                    </label>
                    <div class="col-md-2 col-sm-3 col-xs-3">
                          <input type="text" id="NroCuenta" placeholder="Nro de Cuenta" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("NroCuenta"))? set_value("NroCuenta"):'';?>" name="NroCuenta" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("NroCuenta","<span class='help-block'>","</span>" );?>
                    </div>
                </div>


			    <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="TipoCuenta">Tipo de Cuenta 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdTipoCuenta" id="IdTipoCuenta">	
                    				<input type="text" name="TipoCuenta" id="TipoCuenta" class="form-control col-md-7 col-xs-12" placeholder="Buscar Tipo de Cuenta" disabled="disabled" />
                    				<span class="input-group-btn">
                        				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default1">
                            				<span class="fa fa-search" aria-hidden="true">
                        					</span>
                        				</button>
                    				</span>
                				</div>
                			</div>
        				</div>        
        			</div>			

                    
					<div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="CuentaContable">Cuenta Contable 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdCuentaContable" id="IdCuentaContable">	
                    				<input type="text" name="CuentaContable" id="CuentaContable" class="form-control col-md-7 col-xs-12" placeholder="Buscar Cuenta Contable" disabled="disabled" />
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

                  
                    <div class="container">
    					<label class="control-label col-md-3 col-sm-6 col-xs-12" for="Moneda">Moneda 
    						<span class="required">*</span>
    					</label>
    					<div class="col-md-6 col-sm-6 col-xs-12">
            				<div id="custom-search-input">
                				<div class="input-group col-md-12">
                					<input type="hidden" name="IdMoneda" id="IdMoneda">	
                    				<input type="text" name="Moneda" id="Moneda" class="form-control col-md-7 col-xs-12" placeholder="Buscar Moneda" disabled="disabled" />
                    				<span class="input-group-btn">
                        				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default3">
                            				<span class="fa fa-search" aria-hidden="true">
                        					</span>
                        				</button>
                    				</span>
                				</div>
                			</div>
        				</div>        
        			</div>			


                    <div class="form-group <?php echo !empty(form_error("Descripcion"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Descripcion">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="Descripcion" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("Descripcion"))? set_value("Descripcion"):'';?>" name="Descripcion" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("Descripcion","<span class='help-block'>","</span>" );?>                          
                        </div>
                      </div>


                  	<div class="form-group <?php echo !empty(form_error("Fecha"))? 'has-error':'';?>">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="NroCuenta">Fecha Apertura <span class="required">*</span>
                    	</label>
                    	<div class="col-md-2 col-sm-3 col-xs-3">
                          	<input type="date" class="form-control" name="Fecha" required>
                    	</div>
                	</div>

                	<div class="form-group <?php echo !empty(form_error("Importe"))? 'has-error':'';?>">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Importe">Saldo Minimo <span class="required">*</span>
                    	</label>
                    	<div class="col-md-3 col-sm-3 col-xs-3">
                          	<input type="text" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Importe" name="Importe" id="Importe" onkeyup="format(this)" onchange="format(this)">
                    	</div>
                	</div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button id="send" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                      </div>

                    </form>

					</div> <!-- /COL  12-->
				</div><!-- /ROW -->
			</div><!-- / content -->
		</div>
	</div>
</div>



<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Bancos</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($bancos)):?>

                                <?php
                                foreach($bancos as $banco):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $banco->IDBANCO;?>
                                    </td>
                                    <td>
                                        <?php echo $banco->DESBANCO;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $banco->NUMBANCO;?>
                                    </td>
                                    <?php $databanco = $banco->IDBANCO."*".$banco->DESBANCO."*".$banco->NUMBANCO?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check" id="botonBanco" name="botonBanco" value="<?php echo $databanco;?>"><span class= "fa fa-check"></span></button>

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




<!--MODAL PARA LISTADO DE TIPOS DE CUENTAS-->
<div class="modal fade" id="modal-default1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Tipo de Cuentas</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($tipocuentas)):?>

                                <?php
                                foreach($tipocuentas as $tipocuenta):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $tipocuenta->IDTIPOCUENTA;?>
                                    </td>
                                    <td>
                                        <?php echo $tipocuenta->DESTIPOCUENTA;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $tipocuenta->NUMTIPOCUENTA;?>
                                    </td>
                                    <?php $datatipocuenta = $tipocuenta->IDTIPOCUENTA."*".$tipocuenta->DESTIPOCUENTA."*".$tipocuenta->NUMTIPOCUENTA?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check1" id="botonCuenta" name="botonCuenta" value="<?php echo $datatipocuenta;?>"><span class= "fa fa-check"></span></button>

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




<!--MODAL PARA LISTADO DE CUENTAS CONTABLES-->
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Cuentas Contables</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($cuentacontables)):?>

                                <?php
                                foreach($cuentacontables as $cuentacontable):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $cuentacontable->IDCUENTACONTABLE;?>
                                    </td>
                                    <td>
                                        <?php echo $cuentacontable->DESPLANCUENTA;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $cuentacontable->NUMPLANCUENTA;?>
                                    </td>
                                    <?php $datacuentacontable = $cuentacontable->IDCUENTACONTABLE."*".$cuentacontable->DESPLANCUENTA."*".$cuentacontable->NUMPLANCUENTA?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check2" value="<?php echo $datacuentacontable;?>"><span class= "fa fa-check"></span></button>

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




<!--MODAL PARA LISTADO DE MONEDAS-->
<div class="modal fade" id="modal-default3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Monedas</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripcion</th>
                            <th>Simbolo</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($monedas)):?>

                                <?php
                                foreach($monedas as $moneda):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $moneda->IDMONEDA;?>
                                    </td>
                                    <td>
                                        <?php echo $moneda->DESMONEDA;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $moneda->NUMMONEDA;?>
                                    </td>
                                    <?php $datamoneda = $moneda->IDMONEDA."*".$moneda->DESMONEDA."*".$moneda->NUMMONEDA?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check3" value="<?php echo $datamoneda;?>"><span class= "fa fa-check"></span></button>

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>

<script type="text/javascript">

function format(input)
{
	var num = input.value.replace(/\./g,'');
	if(!isNaN(num))
	{
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	} 
	else
	{ 
		swal ( "Solo puede ingresar valores numericos." ) ;
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}


$(".btn-check").on("click", function(){
    banco = $(this).val();
  infobanco = banco.split("*");
  $("#IdBanco").val(infobanco[0]);
  $("#Banco").val(infobanco[1]);
  $("#modal-default").modal("hide");

});

$(".btn-check1").on("click", function(){
    tipocuenta = $(this).val();
  infotipocuenta = tipocuenta.split("*");
  $("#IdTipoCuenta").val(infotipocuenta[0]);
  $("#TipoCuenta").val(infotipocuenta[1]);
  $("#modal-default1").modal("hide");
});

$(".btn-check2").on("click", function(){
    cuentacontable = $(this).val();
  infocuentacontable = cuentacontable.split("*");
  $("#IdCuentaContable").val(infocuentacontable[0]);
  $("#CuentaContable").val(infocuentacontable[2]+" - "+infocuentacontable[1]);
  $("#modal-default2").modal("hide");
});

$(".btn-check3").on("click", function(){
    moneda = $(this).val();
  infomoneda = moneda.split("*");
  $("#IdMoneda").val(infomoneda[0]);
  $("#Moneda").val(infomoneda[2]+ " - "+infomoneda[1]);
  $("#modal-default3").modal("hide");
});

$(document).ready(function() {
   
    $('#send').click(function(){    	
		
        if ($('#IdBanco').val().length < 1) {
			swal ( "Debe seleccionar el Banco." ) ;
			return false;
		}

		if ($('#NroCuenta').val().length < 1) {
			swal ( "Debe ingresar Numero de Cuenta." ) ;
			return false;
		}

		if ($('#IdTipoCuenta').val().length < 1) {
			swal ( "Debe introducir el Tipo de Cuenta." ) ;
			return false;
		}

		if ($('#IdCuentaContable').val().length < 1) {
			swal ( "Debe introducir la Cuenta Contable." ) ;
			return false;
		}


		if ($('#IdMoneda').val().length < 1) {
			swal ( "Debe introducir la Moneda." ) ;
			return false;
		}
		
         var inputValue = $('#Descripcion').val();        

		if ($.trim(inputValue).length < 1) 
		{
			swal ( "Debe introducir la Descripcion." ) ;
			return false;
		}

		var monto = $('#Importe').val();

		if ($.trim(monto).length < 1) 
		{
			swal ( "Debe introducir el monto.");
			$("#Importe").val('');
			return false;
		}

    });

 });

</script>
