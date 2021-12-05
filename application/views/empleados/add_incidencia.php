<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Incidencias Para: <?php echo $empleado->EMPLEADO ?>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
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
                    <p><?php echo $this->session->flashdata("success")?></p>
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
                <p><?php echo $this->session->flashdata("error")?></p>
            </div>
        <?php endif; ?>

        <div class="x_title">
            <h2> Incidencias | Agregar </h2>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <form action="<?php echo base_url() ?>store_incidencia" method="POST" class="form-horizontal">
                <h3>Añadir detalles</h3>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="" class="control-label">Empleado:</label>
                        <input type="text" class="form-control" disabled="disabled" id="txtEmpleado" value="<?php echo $empleado->EMPLEADO ?>" required>
                        <div class="">                       
                        </div>
                    </div>                        
                    <div class="form-group col-md-3">
                        <label for="" class="control-label">Tipo de Incidencia:</label>
                        <div class="input-group">                       
                            <input type="text" class="form-control" readonly id="txtTipoIncidencia" name="txtTipoIncidencia" required>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#mdlTipoMovimiento" ><span class="fa fa-search"></span></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="Observacion">Observacion:</label>
                        <input type="text" class="form-control" placeholder="Observación" name="observacion" id="observacion">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="fecha_incidencia">Fecha Incidencia</label>
                        <input type="date" class="form-control" name="fecha_incidencia" id="fecha_incidencia">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-3">
                        <label class="control-label" for="btn-agg">&nbsp;</label>
                        <div class="input-group">
                            <button id="btn-grabar" name="empleado" type="submit" value="<?php echo $empleado->IDEMPLEADO ?>" class="btn btn-success btn-flat">Guardar Incidencia</button>
                        </div>
                    </div>
                </div>    
            </form>   
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="mdlTipoMovimiento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Busqueda Tipos de Incidencias</h4>
                </div>
                <div class="modal-body">
                    <table id="tabTipoMovimiento" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descripcion</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php

                         if(!empty($tipoIncidencias)):?>

                            <?php
                            foreach($tipoIncidencias as $tipoIncidencia):?>
                                <tr>
                                    <td>
                                        <?php echo $tipoIncidencia->NUMINCIDENCIA;?>
                                    </td>
                                    <td>
                                        <?php echo $tipoIncidencia->DESCINCIDENCIA;?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-check checktipo" value="<?php echo $tipoIncidencia->IDTIPOINCIDENCIA;?>"><span class= "fa fa-check"></span></button>
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

</div>
<?php // $this->load->view('template/footer');?>
<script type="text/javascript">
    $(".checktipo").on("click", function(){
        var id = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>getTipoIncidencia',
            data: {id:id},
        })
        .done(function (data){
            var r = JSON.parse(data);
            console.log(r);
            $('#txtTipoIncidencia').val(r.DESCINCIDENCIA);
            $("#mdlTipoMovimiento").modal("hide");
        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });

    });

</script>
