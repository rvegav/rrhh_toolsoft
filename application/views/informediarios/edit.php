<?php //print_r($data); die();  ?>

<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Movimientos
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
                            ?Buen Trabajo!
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
                        ?Error!
                    </strong>
                    <p>
                        <?php echo $this->session->flashdata("error")?>
                    </p>
                </div>
            <?php endif; ?>
                
            <div class="x_title">
                <h2>  Movimientos  | Editar </h2>
                    <div class="clearfix"></div>
            </div>
            <div class="row">
                <form action="<?php echo base_url();?>movimientos/movimientos/update" method="POST" class="form-horizontal">
                    <div class="col-md-12">
                       <div class="row"> 
                            <div class="form-group col-md-2">
                                <label for="" class="control-label">Numero:</label>
                                
                                <input type="text" class="form-control" id="NUMMOVI" name="NUMMOVI" readonly value="<?php echo $data['movimientos'][0]->NUMMOVI;?>">
                                <input type="hidden" class="form-control" id="IDMOVI" name="IDMOVI" readonly value="<?php echo $data['movimientos'][0]->IDMOVI;?>">
                            </div>
                        </div>         
                        
                        <div class="row">
                            <div class="form-group col-md-3">
                            <label for="" class="control-label">Tipo de Movimiento:</label>
                            <input type="hidden" name="IDTIPOMOVISUELDO" id="IDTIPOMOVISUELDO" value="<?php echo $data['movimientos'][0]->IDTIPOMOVISUELDO;?>">
                            <div class="input-group">                       
                                <input type="text" class="form-control" disabled="disabled" id="DESTIPOMOV" value="<?php echo $data['movimientos'][0]->DESTIPOMOV;?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                </span>
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="" class="control-label">Fecha:</label>
                                <input type="date" class="form-control" name="FECHAMOVI" required value="<?php echo $data['movimientos'][0]->FECHAMOVI;?>">
                                <span class="input-group-btn">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <table id="tbmovimientos" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Dias</th>
                                    <th>Horas</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($data)):?>

                                <?php foreach($data['movimientos_detalle'] as $i => $item):  ?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                  <!--<?php //print_r($movimientos) ;?>-->
                                 

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
                    <!-- <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Empleado:</span>
                                <select name="EMPLEADO1_detalle" id="EMPLEADO1" class="form-control">
                                <?php //foreach($data['empleados'] as $j => $empleado1):?>
                                    <option value="<?php //echo $empleado1->IDEMPLEADO;?>"><?php //echo $empleado1->NOMBRE;?></option>
                                <?php //endforeach;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Dias:</span>
                                <input type="text" class="form-control" placeholder="Dias" name="DIAS_detalle" id= "DIAS">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Horas:</span>
                                <input type="text" class="form-control" placeholder="Horas" name="HORAS_detalle" value="0.00" id="HORAS">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Importe:</span>
                                <input type="text" class="form-control" placeholder="Importe" name="IMPORTE_detalle" id="IMPORTE">
                            </div>
                        </div>

                    </div> -->
                            
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <div class="form-group col-md-3">
                                <button id="btn-agregar" type="button" class="btn btn-success btn-flat"><span class="fa fa-plus"></span> Agregar</button>
                            </div> -->

                            <div class="form-group col-md-3">
                                <button id="btn-grabar" type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </div>
                    </div> 
                </form>

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
                        <td>
                            <?php echo $empleado->IDTIPOMOVISUELDO;?>
                        </td>
                        <td>
                            <?php echo $empleado->DESTIPOMOV;?>
                            
                        </td>
                        <td>
                            <?php echo $empleado->NUMTIPOMOV;?>
                        </td>
                        <?php $dataempleado = $empleado->IDTIPOMOVISUELDO."*".$empleado->DESTIPOMOV."*".$empleado->NUMTIPOMOV?>
                                          
                    
                        <td>

                                    <button type = "button" class="btn btn-success btn-check" value="<?php echo $dataempleado;?>"><span class= "fa fa-check"></span></button>

                                    </td>
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
       // alert (base_url);
        $(".btn-view").on("click", function(){
          var id= $(this).val();
          $.ajax({
            url: base_url + "movimientos/movimientos/view/" + id,
            type: "POST",
            success:function(resp){
              //$("#modal-view .modal-body").html(resp);
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


$(".btn-check").on("click", function(){
    empleado = $(this).val();
  infoempleado = empleado.split("*");
  $("#IDTIPOMOVISUELDO").val(infoempleado[0]);
  $("#DESTIPOMOV").val(infoempleado[1]);
  $("#modal-default").modal("hide");

//

//}


});


/*
$("#btn-grabar").on("click", function(){
   $IDMOVI   = $this->input->post("IDMOVI");

        $NUMMOVI   = $this->input->post("NUMMOVI");


        $FECHAMOVI   = $this->input->post("FECHAMOVI");
        $IDEMPLEADO   = $this->input->post("IDEMPLEADO"); 

});*/

// PROPIEDAD CLIK DE EDITAR
  //        $(".btn-warning").on("click", function(e){
        //  e.preventDefault();
        //  //alert("borrando");
        //  var ruta= $(this).attr("href");
        // //   alert(ruta);
        //  $.ajax({
        //      url: ruta,
        //      type: "POST",
        //      success:function(resp){
        //          //se redirige a base url con la respuesta
        //          window.location.href= base_url + resp;  
        //          //alert(base_url + resp);

        //              }
        //      });
        // })
         //HASTA ACA BOTON EDITAR


         $("#btn-agregar").on("click", function(){
          //data = ui.item.IDEMPLEADO1 + "*"+ ui.item.DIAS +"*"+ui.item.HORAS +"*"+ ui.item.IMPORTE; 
   //        select:function(event, ui){
   //   data = ui.item.id+ "*"+ ui.item.NUMMOVI+ "*"+ ui.item.label+ "*"+ ui.item.DESTIPOMOV;
   //   $("#btn-agregar"),val(data);
   // }

//data = ui.item.IDEMPLEADO1 + "*"+ ui.item.DIAS +"*"+ui.item.HORAS +"*"+ ui.item.IMPORTE; 
  //      $("#btn-agregar").val(data);

//echo("ingreso al boton");
          //if(data != '') {
           // infomovimiento = data.split("*");

           console.log($("select#EMPLEADO1").val());

           var empleado = $("SELECT#EMPLEADO1 option:selected").val() ;

            // html = '<tr>';
            // html += '<td>';
            // html += '<select name="EMPLEADO[]" id="EMPLEADO" class="form-control">';
            // html += '<?php //foreach($data['empleados'] as $j => $empleado1){   ?>';

            // html += '<option value="<?php //echo $empleado1->IDEMPLEADO?>" '+ if() +'>';
            // html += '<input type="hidden" id="EMPLEADO1" name="EMPLEADO1[]" value="'+ $("SELECT#EMPLEADO1 option:selected").val() + '" >';
            // html += '<?php //echo $empleado1->NOMBRE;?></option>';
            // html += '<?php //else:?>';
            // html += '<option value="<?php //echo $empleado1->IDEMPLEADO;?>"><?php //echo $empleado1->NOMBRE;?></option>';
            // html += '<?php //endif;?>';
            // html += '<?php //}?>';
            // html += '</select>';
            // html += '</td>';
            // html += '<td>';
            // html += '<input type="number" class="form-control"  name="DIAS[]" value="'+ $("#DIAS").val() + '" >';
            // html += '</td>';
            // html += '<td>';
            // html += '<input type="number" class="form-control" name="HORAS[]" value="'+ $("#HORAS").val() + '" >';
            // html += '</td>';
            // html += '<td>';
            // html += '<input type="number" class="form-control" name="IMPORTE[]" value="'+ $("#IMPORTE").val() + '" >';
            // html += '</td>';


                

       /*     html += "<td>"+infomovimiento[2]+"</td>"
            html += "<td><input type='hiden' name= 'DIAS[]' value ='"+infomovimiento[3]+"'>"+infomovimiento[3]+"</td>";
            html += "<td>"+infomovimiento[4]+"</td>"
            html += "<td><input type='text' name= 'HORAS[]' value=0></td>";
            html += "<td><input type='hiden' name= 'IMPORTE[]' value='"+infomovimiento[3]+"'><p>"+infomovimiento[3]+"</p></td>";
            html += "<td><button type = 'button' class='btn btn-danger btn-remove-movimiento'><span class = 'fa fa-remove'></span></button></td>";*/
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
