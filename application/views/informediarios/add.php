<div class="right_col" role="main">
  <div class="page-title">
    <div class="title_left">
      <h3>
        Informe
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
            Infome de Libro Diario | Generar
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
            <form id="demo-form2" name="prueba1" data-parsley-validate="" class="form-horizontal form-label-left" action="<?php echo base_url()?>informediarios/informediarios/view" method="POST" novalidate="">

                        
                      <div class="form-group <?php echo !empty(form_error("NUMERO"))? 'has-error':'';?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="NUMERO">Nº de Asiento <span class="required"></span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input type="text" id="NUMERO" value="<?php echo !empty(form_error("NUMERO"))? set_value("NUMERO"):'';?>" name="NUMERO" class="form-control col-md-7 col-xs-6">
                          <?php echo form_error("NUMERO","<span class='help-block'>","</span>" );?>
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
                           <button type="reset" class="btn btn-primary">Resetear</button>
                           <button type="submit" class="btn btn-success">Visualizar</button>
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


</script>