<?php //print_r($data); die();  ?>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Movimiento
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
                <h2>  Movimiento  | Editar </h2>
                <div class="clearfix"></div>
            </div>

            <form action="<?php echo base_url();?>movimientos/movimientos/update" method="POST" class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-2">
                            <label for="" class="control-label">Numero:</label>

                            <input type="text" class="form-control" id="NUMMOVI" name="NUMMOVI" readonly value="<?php echo $data['movimientos'][0]->NUMMOVI;?>">
                            <input type="hidden" class="form-control" id="IDMOVI" name="IDMOVI" readonly value="<?php echo $data['movimientos'][0]->IDMOVI;?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="" class="control-label">Tipo de Movimiento:</label>
                            <input type="hidden" name="IDTIPOMOVISUELDO" id="IDTIPOMOVISUELDO" value="<?php echo $data['movimientos'][0]->IDTIPOMOVISUELDO;?>">
                            <input type="text" readonly disabled class="form-control" id="DESTIPOMOV" value="<?php echo $data['movimientos'][0]->DESTIPOMOV;?>">
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="" class="control-label">Fecha:</label>
                            <input type="date" class="form-control" name="FECHAMOVI" required value="<?php echo $data['movimientos'][0]->FECHAMOVI;?>">
                            <span class="input-group-btn"></span>
                        </div>
                    </div>
                </div>
                <div class="x_title">
                    <h2>  Detalles del Movimiento </h2>
                    <div class="clearfix"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tbmovimientos" class="table table-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Dias</th>
                                    <th>Horas</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data)):?>
                                    <?php foreach($data['movimientos_detalle'] as $i => $item):  ?>
                                    <tr>
                                        <td>
                                           <input type="hidden" name="IDMOVIDETALLE[<?php echo $i; ?>]" 
                                           id="<?php echo $i.'IDMOVIDETALLE'; ?>" value="<?php echo $item->IDMOVIDETALLE;?>">

                                           <select name="EMPLEADO[<?php echo $i; ?>]" id="<?php echo $i.'EMPLEADO'; ?>" class="form-control">
                                               <?php foreach($data['empleados'] as $j => $empleado1){   ?>
                                                <?php if($empleado1->IDEMPLEADO == $item->IDEMPLEADO): ?>
                                                    <option value="<?php echo $empleado1->IDEMPLEADO?>" <?php echo 'selected'; ?>>
                                                        <?php echo $empleado1->NOMBRE;?></option>
                                                    <?php else:?>
                                                        <option value="<?php echo $empleado1->IDEMPLEADO;?>"><?php echo $empleado1->NOMBRE;?></option>
                                                    <?php endif;?>
                                                <?php }?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="DIAS[<?php echo $i; ?>]" 
                                            id="<?php echo $i.'DIAS'; ?>" value="<?php echo $item->DIAS;?>" class="form-control">                                       
                                        </td>
                                        <td>

                                            <input type="text" name="HORAS[<?php echo $i; ?>]" 
                                            id="<?php echo $i.'HORAS'; ?>" value="<?php echo $item->HORAS;?>" class="form-control">  
                                        </td>
                                        <td>
                                            <input type="text" name="IMPORTE[<?php echo $i; ?>]" 
                                            id="<?php echo $i.'IMPORTE'; ?>" value="<?php echo $item->IMPORTE;?>" class="form-control">  
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-10">
                            <button id="btn-grabar" type="submit" class="btn btn-success btn-flat">Guardar</button>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Lista de Tipos de Movimiento</h4>
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
                            <?php
                            foreach($data['tipoMovimientos'] as $i => $empleado) : ?>
                                <tr>
                                    <td><?php echo $empleado->IDTIPOMOVISUELDO;?></td>
                                    <td><?php echo $empleado->DESTIPOMOV;?></td>
                                    <td><?php echo $empleado->NUMTIPOMOV;?></td>
                                    <?php $dataempleado = $empleado->IDTIPOMOVISUELDO."*".$empleado->DESTIPOMOV."*".$empleado->NUMTIPOMOV?>
                                    <td><button type = "button" class="btn btn-success btn-check" value="<?php echo $dataempleado;?>"><span class= "fa fa-check"></span></button></td>
                                </tr>
                            <?php endforeach; ?>
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

    <?php // $this->load->view('template/footer');?>
    <script type="text/javascript">
     $(document).ready(function(){
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
            //esto lee el boton eliminar y envia via ajax
            $(".btn-delete").on("click", function(e){
                e.preventDefault();

                var ruta= $(this).attr("href");
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

            $(".btn-check").on("click", function(){
                empleado = $(this).val();
                infoempleado = empleado.split("*");
                $("#IDTIPOMOVISUELDO").val(infoempleado[0]);
                $("#DESTIPOMOV").val(infoempleado[1]);
                $("#modal-default").modal("hide");
            });



            $("#btn-agregar").on("click", function(){
             console.log($("select#EMPLEADO1").val());

             var empleado = $("SELECT#EMPLEADO1 option:selected").val() ;
             html += '</tr>';
           // console.log(html);
           $("#tbmovimientos tbody").append(html);

           $("select#EMPLEADO1").val("");
           $("#DIAS").val("");
           $("#HORAS").val("");
           $("#IMPORTE").val("");
          /*}else{
            alert("seleccione un tipo movimiento")
        }*/
    });

        })      

    </script>
