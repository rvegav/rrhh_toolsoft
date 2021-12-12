<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>
        Proceso de Cierre
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
            Proceso de Cierre | Generar
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
            <form id="demo-form2" name="prueba1" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>procesocierres/procesocierres/store" method="POST" novalidate="">

                   <div class="row"> 
                            <div class="form-group col-md-2">
                                <?php foreach($maximos as $maximo):?>
                                <input type="text" class="form-control" id="IDCIERRE" name="IDCIERRE" readonly value="<?php echo $maximo->MAXIMO;?>" style="visibility: hidden;">
                                <?php endforeach;?>
                            </div>
                        </div>  

                        <div class="form-group <?php echo !empty(form_error("IDSUCURSAL"))? 'has-error':'';?>">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IDSUCURSAL">Desde Sucursal <span class="required">*</span>
                              </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select name="SUCURSAL_DESDE" id="SUCURSAL" class="form-control">
                                <option value="">Seleccione una sucursal</option>
                                <?php foreach($sucursales as $sucursal):?>
                                    <option value="<?php echo $sucursal->NUMSUCURSAL;?>"><?php echo $sucursal->DESSUCURSAL;?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group <?php echo !empty(form_error("IDSUCURSAL1"))? 'has-error':'';?>">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IDSUCURSAL1">Hasta Sucursal <span class="required">*</span>
                              </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select name="SUCURSAL_HASTA" id="SUCURSAL1" class="form-control">
                                <option value="">Seleccione una sucursal</option>
                                <?php foreach($sucursales as $sucursal):?>
                                    <option value="<?php echo $sucursal->NUMSUCURSAL;?>"><?php echo $sucursal->DESSUCURSAL;?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-group <?php echo !empty(form_error("IDDEPARTAMENTO"))? 'has-error':'';?>">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IDDEPARTAMENTO">Desde Departamento <span class="required">*</span>
                              </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select name="DEPARTAMENTO_DESDE" id="DEPARTAMENTO" class="form-control">
                                <option value="">Seleccione un departamento</option>
                                <?php foreach($departamentos as $departamento):?>
                                    <option value="<?php echo $departamento->NUMDEPARTAMENTO;?>"><?php echo $departamento->DESDEPARTAMENTO;?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group <?php echo !empty(form_error("IDDEPARTAMENTO1"))? 'has-error':'';?>">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IDDEPARTAMENTO1">Hasta Departamento <span class="required">*</span>
                              </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select name="DEPARTAMENTO_HASTA" id="DEPARTAMENTO1" class="form-control">
                                <option value="">Seleccione un departamento</option>
                                <?php foreach($departamentos as $departamento):?>
                                    <option value="<?php echo $departamento->NUMDEPARTAMENTO;?>"><?php echo $departamento->DESDEPARTAMENTO;?></option>
                                <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Desde <span class="required">*</span></label>
                              <div class ="col-md-2 col-sm-6 col-xs-12">
                                <input type="date" class="form-control col-md-7 col-xs-12" name="FECHADESDE" required="required">
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Hasta <span class="required">*</span></label>
                              <div class ="col-md-2 col-sm-6 col-xs-12">
                                <input type="date" class="form-control col-md-7 col-xs-12" name="FECHAHASTA" required="required">
                              </div>
                            </div>

                      <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <input type="submit" value="Eliminar" formaction="/isupport/procesocierres/procesocierres/eliminar/" class="btn btn-danger btn-delete" onclick="if(confirm('Desea Eliminar este periodo de Cierre?')){
                            this.form.submit();
                          }else{
                            alert('Operacion Cancelada');
                          }">
                          <button type="submit" class="btn btn-success">Generar</button>
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
                <h4 class="modal-title">Lita de Sucursales</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($sucursales)):?>

                                <?php
                                foreach($sucursales as $sucursal):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $sucursal->IDSUCURSAL;?>
                                    </td>
                                    <td>
                                        <?php echo $sucursal->NUMSUCURSAL;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $sucursal->DESSUCURSAL;?>
                                    </td>
                                    <?php $datasucursal = $sucursal->IDSUCURSAL."*".$sucursal->DESSUCURSAL."*".$sucursal->NUMSUCURSAL?>
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check" value="<?php echo $datasucursal;?>"><span class= "fa fa-check"></span></button>

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




<div class="modal fade" id="modal-default1">
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
                            <th>Codigo</th>
                            <th>Descripcion</th>
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
                                        <?php echo $departamento->IDDEPARTAMENTO;?>
                                    </td>
                                    <td>
                                        <?php echo $departamento->NUMDEPARTAMENTO;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $departamento->DESDEPARTAMENTO;?>
                                    </td>
                                    <?php $datadepartamento = $departamento->IDDEPARTAMENTO."*".$departamento->DESDEPARTAMENTO."*".$departamento->NUMDEPARTAMENTO?>
                                    <td>

                                    <button id="btn-agregar" type = "button" class="btn btn-success btn-check" value="<?php echo $datadepartamento;?>"><span class= "fa fa-check"></span></button>

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
<!------------------------------------------------------------------------------------------------->
<script type="text/javascript">

  $("#btn-agregar").on("click", function(){
  departamento = $(this).val();
  infodepartamento = departamento.split("*");
  $("#IDDEPARTAMENTO").val(infodepartamento[0]);
  $("#DESDEPARTAMENTO").val(infodepartamento[1]);
  $("#modal-default1").modal("hide");

});

  $(".btn-check").on("click", function(){
  sucursal = $(this).val();
  infosucursal = sucursal.split("*");
  $("#IDSUCURSAL").val(infosucursal[0]);
  $("#DESSUCURSAL").val(infosucursal[1]);
  $("#modal-default").modal("hide");

});

  function eliminar($campos){
  if(confirm("Esta seguro que desea eliminar este periodo de cierre?")){
    
    window.location.href = "/isupport/procesocierres/procesocierres/eliminar/" + $campos;

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

function enviarforms(){
  document.prueba1.submit();
}

</script>