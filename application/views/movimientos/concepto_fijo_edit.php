<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Conceptos Fijos
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
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
                <h2> Conceptos Fijos  | Editar </h2>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <form action="edit_concepto_fijos" method="POST" class="form-horizontal">
                    <h3>Añadir detalles</h3>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="" class="control-label">Empleado:</label>
                            <div class="input-group">                       
                                <input type="text" class="form-control" disabled="disabled" id="txtEmpleado" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#mdlEmpleados" ><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>                        
                        <div class="form-group col-md-2">
                            <label for="" class="control-label">Tipo de Movimiento:</label>
                            <div class="input-group">                       
                                <input type="text" class="form-control" disabled="disabled" id="txtTipoMovi" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#mdlTipoMovimiento"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label" for="btn-importe">&nbsp;</label>
                            <div class="input-group mt-5">
                                <span class="input-group-addon">Importe:</span>
                                <input type="text" class="form-control" placeholder="Importe" name="importe" id= "importe">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label" for="btn-desde">&nbsp;</label>
                            <div class="input-group">
                                <span class="input-group-addon">Desde:</span>
                                <input type="date" class="form-control" name="desde" id="desde">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="control-label" for="btn-hasta">&nbsp;</label>
                            <div class="input-group">
                                <span class="input-group-addon">Hasta:</span>
                                <input type="date" class="form-control" name="hasta" id="hasta">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <label class="control-label" for="btn-agg">&nbsp;</label>
                        <div class="input-group">
                            <button id="btn-agregar" type="button" class="btn btn-success btn-flat"><span class="fa fa-plus"></span> Agregar Detalle</button>
                            <button id="btn-grabar" type="submit" class="btn btn-success btn-flat"><span class="fa fa-check"></span> Guardar Concepto</button>
                            <button id="btn-actualizar" type="button" class="btn btn-success btn-flat"><span class="fa fa-check"></span> Actualizar Concepto</button>
                            <button id="btn-volver" type="button" class="btn btn-success btn-flat"><span class="fa fa-arrow-left"></span>Volver al Listado</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tbmovimientos" class="table table-responsive table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Empleado</th>
                                        <th>Movimiento</th>
                                        <th>Importe</th>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th>Accion</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($conceptoEmpleados as $conceptoEmpleado): ?>
                                        <tr>
                                            <td><?php echo $conceptoEmpleado->EMPLEADO?></td>
                                            <td><?php echo $conceptoEmpleado->TIPOMOVIMIENTO?></td>
                                            <td><?php echo $conceptoEmpleado->IMPORTE?></td>
                                            <td><?php echo $conceptoEmpleado->DESDE?></td>
                                            <td><?php echo $conceptoEmpleado->HASTA?></td>
                                            <td><button type="button" class="btn btn-primary editConcepto" value="<?php echo $conceptoEmpleado->IDCONCEPTOFIJO ?>"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-remove-movimiento" value="<?php echo $conceptoEmpleado->IDCONCEPTOFIJO ?>"><i class="fa fa-trash"></i></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>       
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="mdlEmpleados">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Busqueda Empleados</h4>
                        </div>
                        <div class="modal-body">
                            <table id="tabEmpleado" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nro. Empleado</th>
                                        <th>Nro. Cedula</th>
                                        <th>Nombre(s) y Apellido(s)</th>
                                        <th>Categoria</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php

                                   if(!empty($empleados)):?>

                                    <?php
                                    foreach($empleados as $empleado):?>
                                       <tr>
                                        <td><?php echo $empleado->NUMEMPLEADO;?></td>
                                        <td><?php echo $empleado->CEDULAIDENTIDAD;?></td>
                                        <td><?php echo $empleado->NOMBRE;?></td>
                                        <td><?php echo $empleado->CATEGORIA;?></td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-check checkFuncionario" id="checkFuncionario" value="<?php echo $empleado->IDEMPLEADO;?>"><span class= "fa fa-check"></span></button>
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
    <div class="modal fade" id="mdlTipoMovimiento">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Busqueda Tipos de Movimientos</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tabTipoMovimiento" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descripcion</th>
                                    <th>SumaResta</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php

                               if(!empty($tipoMovimientos)):?>

                                <?php
                                foreach($tipoMovimientos as $tipoMovimiento):?>
                                   <tr>
                                    <td>
                                        <?php echo $tipoMovimiento->NUMTIPOMOV;?>
                                    </td>
                                    <td>
                                        <?php echo $tipoMovimiento->DESC;?>

                                    </td>
                                    <td>
                                        <?php echo $tipoMovimiento->SUMARESTA;?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-check checktipo" value="<?php echo $tipoMovimiento->IDTIPOMOVI;?>"><span class= "fa fa-check"></span></button>

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
    var nroFila;
    $(document).ready(function(){
        $("#btn-actualizar").hide();
        var base_url= "<?php echo base_url();?>";
        $(".btn-view").on("click", function(){
          var id= $(this).val();
          $.ajax({
            url: base_url + "movimientos/movimientos/view/" + id,
            type: "POST",
            success:function(resp){
                $("#modal-view .modal-body").html(resp);
            }
        });
      })
    });
    $(".btn-remove-movimiento").on("click", function(){
        id = $(this).val();
        nroFila = $(this).parents('tr')[0].rowIndex;
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>delete_concepto_fijo',
            data: {id:id},
        })
        .done(function (data){
            document.getElementById("tbmovimientos").deleteRow(nroFila);

        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });
        cant--;
    });
    $(".checktipo").on("click", function(){
        tipo = $(this).val();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>obtener_tipo_movimiento',
            data: {tipo:tipo},
        })
        .done(function (data){
            var r = JSON.parse(data);
            console.log(r);
            $('#txtTipoMovi').val(r[0].DESC);
            $("#mdlTipoMovimiento").modal("hide");
        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });

    });
    var tipo;
    var funcionario;
    $(".checkFuncionario").on("click", function(){
        funcionario = $(this).val();
        console.log(funcionario);
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>getEmpleado',
            data: {funcionario:funcionario},
        })
        .done(function (data){
            var r = JSON.parse(data);
            console.log(r);
            $('#txtEmpleado').val(r.EMPLEADO);
            $("#mdlEmpleados").modal("hide");
        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });

    });
    var cant = $("#tbmovimientos tr").length-1;
    $("#btn-agregar").on("click", function(){
        if ($("#importe").val()!='' && $("#txtEmpleado").val()!='' && $('#txtTipoMovi').val()!='' && $('#desde').val()!='' && $('#hasta').val()!='') {
           cant++;
           html = '<tr>';
           html += '<td>';
           html += '<input type="hidden"  name="empleados[]" value="'+ funcionario + '" >'
           html += $("#txtEmpleado").val();
           html += '</td>';
           html += '<td>';
           html += '<input type="hidden"  name="tipo[]" value="'+ tipo + '" >'
           html += $("#txtTipoMovi").val();
           html += '</td>';
           html += '<td>';
           html += '<input type="hidden" name="importes[]" value="'+ $("#importe").val() + '" >'
           html += $("#importe").val();
           html += '</td>';
           html += '<td>';
           html += '<input type="hidden" name="desde[]" value="'+ $("#desde").val() + '" required>'
           html += $("#desde").val();
           html += '</td>';
           html += '<td>';
           html += '<input type="hidden" name="hasta[]" value="'+ $("#hasta").val() + '" required>'
           html += $("#hasta").val();
           html += '</td>';
           html += "<td><button type='button' class='btn btn-danger btn-remove-movimiento' value ="+cant+"><span class='fa fa-remove'></span></button></td>";
           html += '</tr>';
           $("#tbmovimientos tbody").append(html);
           $('#txtEmpleado').prop("disabled", false);
           $("#txtEmpleado").val("");
           $('#txtEmpleado').prop("disabled", true);
           $('#txtTipoMovi').prop("disabled", false);
           $("#txtTipoMovi").val("");
           $('#txtTipoMovi').prop("disabled", true);
           $("#importe").val("");
           $("#desde").val("");
           $("#hasta").val(""); 
        }else{
            swal({
                title: "Atención",
                text: "Los campos son requeridos",
                icon: "warning",
            });
        }
        $(".btn-remove-movimiento").on("click", function(){
            fila = $(this).val();
            var id = 
            $.ajax({
                type:'POST',
                url:'<?php echo base_url()?>delete_concepto_fijo',
                data: {id:id},
            })
            .done(function (data){
                document.getElementById("tbmovimientos").deleteRow(fila);

            })
            .fail(function(){
                alert('ocurrio un error interno, contacte con Rolo');
            });
            cant--;
        });
    });
    $('.editConcepto').on("click", function(){
        conceptoid = $(this).val();
        nroFila = $(this).parents('tr')[0].rowIndex;
        // document.getElementById("tbmovimientos").deleteRow(nroFila);
        // var nroFila = $(this).parents('tr');
        $("#btn-actualizar").show();
        $("#btn-grabar").hide();
        $("#btn-actualizar").val(conceptoid);
        console.log(nroFila);
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>get_concepto_fijo',
            data: {concepto:conceptoid},
        })
        .done(function (data){
            var r = JSON.parse(data);
            console.log(r);
            $("#txtEmpleado").val(r[0].EMPLEADO);
            $("#txtTipoMovi").val(r[0].TIPOMOVIMIENTO);
            $("#importe").val(r[0].IMPORTE);
            var desde = r[0].DESDE.split("/").reverse().join("-");
            var hasta = r[0].HASTA.split("/").reverse().join("-");
            $("#desde").val(desde);
            $("#hasta").val(hasta); 
        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });

    });
    $("#btn-actualizar").on("click", function(){
        id = $(this).val();
        var desde = $("#desde").val();
        var hasta = $("#hasta").val();
        var importe = $("#importe").val();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>update_concepto_fijos',
            data: {id:id, desde:desde, hasta:hasta, importe:importe},
        })
        .done(function (data){
            var r = JSON.parse(data);
            row = document.getElementsByTagName('table')[0].rows;
            var desde = $("#desde").val().split("-").reverse().join("/");
            var hasta = $("#hasta").val().split("-").reverse().join("/");
            row[nroFila].cells[0].innerHTML =$("#txtEmpleado").val();
            row[nroFila].cells[1].innerHTML =$("#txtTipoMovi").val();
            row[nroFila].cells[2].innerHTML =$("#importe").val();
            row[nroFila].cells[3].innerHTML =desde;
            row[nroFila].cells[4].innerHTML =hasta;
            $("#btn-grabar").show();
            $("#txtEmpleado").val('');
            $("#txtTipoMovi").val('');
            $("#importe").val('');
            $("#desde").val('');
            $("#desde").val('');
            $("#btn-actualizar").hide();

        })
        .fail(function(){
            alert('ocurrio un error interno, contacte con Rolo');
        });
    });
    $("#btn-volver").on("click", function(){
        window.location.href = "<?php echo base_url();?>concepto_fijo";
    });


</script>
