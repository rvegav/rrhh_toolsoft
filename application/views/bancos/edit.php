<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>
				Banco
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
						Banco  | Editar 
					</h2>

					<div class="clearfix"></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url();?>bancos/bancos/update"  method="POST" novalidate="">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumCargo">Codigo <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" id="NumBanco" required="required" readonly value="<?php echo $banco->NUMBANCO;?>" name="NumBanco" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desBanco">Descripcion <span class="required">   *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="desCargo" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $banco->DESBANCO;?>" name="desBanco" class="form-control col-md-7 col-xs-12">
                        </div>
                     </div>
                     
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Direccion <span class="required">   *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="direccion" placeholder="Direccion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $banco->DIRECCION;?>" name="direccion" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono">Telefono <span class="required">   *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono" placeholder="Telefono" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $banco->TELEFONO;?>" name="telefono" class="form-control col-md-7 col-xs-12">
                        </div>
                   </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo Electronico <span class="required">   *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" placeholder="Email" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $banco->EMAIL;?>" name="email" class="form-control col-md-7 col-xs-12">
                        </div>
                     </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="web">Direccion Web <span class="required">   *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="web" placeholder="Web" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" value="<?php echo $banco->WEB;?>" name="web" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                    
                      

                      <input type="text" id="idbanco" style="visibility: hidden;" required="required"  readonly value="<?php echo $banco->IDBANCO;?>" name="idbanco" class="form-control col-md-7 col-xs-12">

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