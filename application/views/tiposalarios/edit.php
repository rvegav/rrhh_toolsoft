<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Tipo de Salario
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
						Tipo de Salario  | Editar 
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
					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>tiposalarios/tiposalarios/update"  method="POST" novalidate="">

                      <div class="form-group <?php echo !empty(form_error("NumTipoSalario"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumTipoSalario">Codigo<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">                        
                                <input type="text" class="form-control" id="NumTipoSalario" name="NumTipoSalario" readonly value="<?php echo $tiposalario->NUMTIPOSALARIO;?>">
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("DesTipoSalario"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesTipoSalario">Tipo de Salario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesTipoSalario" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" name="DesTipoSalario" class="form-control col-md-7 col-xs-12" value="<?php echo $tiposalario->DESTIPOSALARIO;?>">
                          <?php echo form_error("DesTipoSalario","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                      <div class="form-group <?php echo !empty(form_error("Importe"))? 'has-error':'';?>">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Importe">Importe <span class="required">*</span>
                    	</label>
                    	<div class="col-md-3 col-sm-3 col-xs-3">
                          	<input type="text" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Importe" name="Importe" id="Importe" onkeyup="format(this)" onchange="format(this)" value="<?php echo $tiposalario->IMPORTE;?>">
                    	</div>
                	</div>
                      

                      <input type="text" id="IdTipoSalario" style="visibility: hidden;" required="required"  readonly value="<?php echo $tiposalario->IDTIPOSALARIO;?>" name="IdTipoSalario" class="form-control col-md-7 col-xs-12">

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Resetear</button>
                          <button type="submit" class="btn btn-success">Actualizar</button>
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
<script>
	/*function verificar_campos(){
		var text= document.forms[0].desCiudad.value.length;
		if(text==0){
			document.forms[0].desCiudad.focus();
			alert("Debes ingresar el nombre de la Ciudad")
			return false;
		}
		else
		{
			document.forms[0].submit();
		}
	}*/

</script>