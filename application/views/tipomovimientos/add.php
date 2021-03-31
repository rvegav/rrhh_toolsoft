<!-- page content -->
<style>
 
.formulario h2 {
    font-size: 16px;
    color: #001F3F;
    margin-bottom: 20px;
    margin-left: 20px;
}
 
.formulario > div {
    padding: 20px 0;
    border-bottom: 1px solid #ccc;
}

.formulario input[type="radio"]
{
    display: none;
}

.formulario .radio label
{
    color:#0774d9;
    padding: 5px 15px 5px 51px;
    display: inline-block;
    position: relative;
    font-size: 1em;
    border-radius: 3px;
    cursor: pointer;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.formulario .radio label:hover
{
    background: rgba(0,116,217,0.3);
}

.formulario .radio label:before
{
    content: "";
    width: 17px;
    height: 17px;
    display: inline-block;
    background: none;
    border: 3px solid #0774D9;
    border-radius: 50%;
    position: absolute;
    left: 17px;
    top: 4px;
}


.formulario input[type="radio"]:checked + label
{
    padding: 5px 15px;
    background: #0774D9;
    border-radius: 2px;
    color: #fff;
}

.formulario input[type="radio"]:checked + label:before
{
    display: none;
}

</style>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Tipo Movimiento
            </h3>
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-12" align="right">
                <a href="<?php echo base_url();?>tipomovimientos/tipomovimientos/add" class="btn btn-dark">
                    <i class="fa fa-plus">
                    </i> Agregar Tipo de Movimiento
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
                        Agregar movimiento
                    </h2>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>tipomovimientos/tipomovimientos/store" method="POST">
                                    <div class="form-group <?php echo !empty(form_error("NumTipoMovimiento"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NumTipoMovimiento">Código <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                          <?php foreach($maximos as $maximo):?>
                                                <input type="text" class="form-control" id="NumPais" name="NumTipoMovimiento" readonly value="<?php echo $maximo->MAXIMO;?>">
                                          <?php endforeach;?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo !empty(form_error("desTipoMovimiento"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desTipoMovimiento">Descripcion <span class="required">*</span>
                                    </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="desTipoMovimiento" placeholder="Descripcion" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("desTipoMovimiento"))? set_value("desTipoMovimiento"):'';?>" name="desTipoMovimiento" class="form-control col-md-7 col-xs-12">
                                          <?php echo form_error("desTipoMovimiento","<span class='help-block'>","</span>" );?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo !empty(form_error("Importe"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Importe">Importe <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="Importe" placeholder="Importe" required="required" name="Importe" class="form-control col-md-7 col-xs-12" onkeyup="format(this)" onchange="format(this)">
                                          <?php echo form_error("Importe","<span class='help-block'>","</span>" );?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo !empty(form_error("Porcentaje"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Porcentaje">Porcentaje <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="Porcentaje" placeholder="Porcentaje" font style="text-transform: uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase ();" required="required" value="<?php echo !empty(form_error("Porcentaje"))? set_value("Porcentaje"):'';?>" name="Porcentaje" class="form-control col-md-7 col-xs-12">
                                            <?php echo form_error("Porcentaje","<span class='help-block'>","</span>" );?>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <label class="control-label col-md-3 col-sm-6 col-xs-12" for="Plancuenta">Plan de Cuenta 
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="custom-search-input">
                                                <div class="input-group col-md-12">
                                                    <input type="hidden" name="IdPlanCuenta" id="IdPlanCuenta"> 
                                                    <input type="text" name="Plancuenta" id="Plancuenta" class="form-control col-md-7 col-xs-12" placeholder="Buscar Plan de Cuentas" disabled="disabled" />
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

                                    <div class="form-group <?php echo !empty(form_error("accion"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="accion">Accion <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-1">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="accion" value="1"> Suma
                                                </label>
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="accion" value="0"> Resta
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo !empty(form_error("tipo"))? 'has-error':'';?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">Tipo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-1">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="tipo" value="1"> Salario Minimo
                                                </label>
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="tipo" value="2"> Salario Basico
                                                </label>
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="tipo" value="3"> Total Salario
                                                </label>
                                                <label>
                                                    <input type="radio" class="flat" required="required" name="tipo" value="4"> Ninguno
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group <?php echo !empty(form_error("Impresion"))? 'has-error':'';?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Impresion">Impresion <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-1">
                                                <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" class="flat" required="required" name="recibo" value="1"> En recibo
                                                    </label>
                                                    <label>
                                                      <input type="checkbox" class="flat" name="libro" value="1"> En libro
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Importe">Seleccionar tipo de movimiento</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="select2" multiple="multiple" name="TipoDetalle[]" data-placeholder="Select a State"
                                                    style="width: 100%;">
                                               <?php foreach($detalles as $detalle):?>
                                                    <?php if($detalle->IDTIPOMOVISUELDO == $detalle->IDTIPOMOVISUELDO):?>
                                                            <option value="<?php echo $detalle->IDTIPOMOVISUELDO?>">
                                                            <?php echo $detalle->DESTIPOMOV;?></option>
                                                    <?php else:?>
                                                        <option value="<?php echo $detalle->IDTIPOMOVISUELDO;?>"><?php echo $detalle->DESTIPOMOV;?></option>
                                                <?php endif;?>
                                                <?php endforeach;?>
                                            </select>
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
                        </div>
                    </div> <!-- /COL  12-->
                </div><!-- /ROW -->
            </div><!-- / content -->
        </div>
    </div>
</div>
</div>


<!--MODAL PARA LISTADO DE BANCOS-->
<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Cuenta Contable</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numero</th>
                            <th>Descripcion</th>
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
                                <tr>
                                    <td>
                                        <?php echo $cuentacontable->IDCUENTACONTABLE;?>
                                    </td>
                                    <td>
                                        <?php echo $cuentacontable->NUMPLANCUENTA;?>
                                    </td>
                                    <td>
                                        <?php echo $cuentacontable->DESPLANCUENTA;?>
                                        
                                    </td>                                    
                                    <?php $datacuenta = $cuentacontable->IDCUENTACONTABLE."*".$cuentacontable->CUENTA."*".$cuentacontable->NUMPLANCUENTA?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check2" value="<?php echo $datacuenta;?>"><span class= "fa fa-check"></span></button>

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
    </div>
 </div>


    <!-- Modal -->
<div class="modal fade" id="modal-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class='fa fa-eye'></i> Ver Detalles de la Ciudad </h4>
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
<script>
 $(document).ready(function(){
    var base_url= "<?php echo base_url();?>";
       // alert (base_url);
        $(".btn-view").on("click", function(){
          var id= $(this).val();
          $.ajax({
            url: base_url + "ciudades/ciudades/view/" + id,
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
        //  alert(ruta);
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


 function eliminar_Copia(id){
    if(confirm("Esta seguro que desea eliminar este registro?")){
        
        window.location.href = "/isupport/ciudades/ciudades/delete/" + id;
        

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
   window.location.href = "/isupport/ciudades/ciudades/delete/" + id;
  }
});
});


$(".btn-check2").on("click", function(){
    plancuenta = $(this).val();
  infoplancuenta = plancuenta.split("*");
  $("#IdPlanCuenta").val(infoplancuenta[0]);
  $("#Plancuenta").val(infoplancuenta[1]);
  $("#modal-default2").modal("hide");
});

function format(input)
{
    var num = input.value.replace(/\./g,'');

    var monto = $('#Importe').val();

    if ($.trim(monto).length < 1) 
    {
        $("#Importe").val('');
        return false;
    }

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

</script>
