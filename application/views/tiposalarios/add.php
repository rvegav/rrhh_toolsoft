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
						Tipo de Salario  | Agregar 
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
						<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>tiposalarios/tiposalarios/store" method="POST">

                    	<div class="form-group <?php echo !empty(form_error("NumTipoSalario"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumTipoSalario">Código<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="NumTipoSalario" name="NumTipoSalario" readonly value="<?php echo $maximo->MAXIMO;?>">
                          <?php endforeach;?>
                        </div>
                    </div>


                    <div class="form-group <?php echo !empty(form_error("DesTipoSalario"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="DesTipoSalario">Tipo de Salario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="DesTipoSalario" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("DesTipoSalario"))? set_value("DesTipoSalario"):'';?>" name="DesTipoSalario" class="form-control col-md-7 col-xs-12">
                          <?php echo form_error("DesTipoSalario","<span class='help-block'>","</span>" );?>
                        </div>
                      </div>


                      <div class="form-group <?php echo !empty(form_error("Importe"))? 'has-error':'';?>">
                    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="Importe">Importe <span class="required">*</span>
                    	</label>
                    	<div class="col-md-3 col-sm-3 col-xs-3">
                          	<input type="text" class="form-control col-md-7 col-xs-12" placeholder="Ingrese Importe" name="Importe" id="Importe" onkeyup="format(this)" onchange="format(this)">
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

$(document).ready(function() {
   
    $('#send').click(function(){

    	var monto = $('#Importe').val();
/*
		if ($.trim(monto).length < 1) 
		{
			swal ( "Debe introducir el monto.");
			$("#Importe").val('');
			return false;
		}
		else
		{

			return true;
		}
*/

    });

 });
</script>