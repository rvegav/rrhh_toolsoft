<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Asientos del periodo
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
               
                    <div class="clearfix"></div>
            </div>
            <div class="row">
                <form action="<?php echo base_url();?>informediarios/informediarios/view" method="POST" class="form-horizontal">
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">
                        <table id="tbmovimientos" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Asiento Nº</th>
                                    <th>Fecha</th>
                                    <th>Cuenta Contable</th>
                                    <th>Debe</th>
                                    <th>Haber</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($diarios)):?>

                                <?php
                                foreach($diarios as $diario):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                  <!--<?php print_r($movimientos) ;?>-->
                                 

                                <tr>
                                    <td>
                                        <?php echo $diario->NUMASIENTO;?>
                                    </td>
                                    <td>
                                        <?php echo $diario->FECHAASIENTO;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $diario->PLANCUENTA;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $diario->IMPORTEDEBE;?>

                                    </td>
                                    <td>
                                        <?php echo $diario->IMPORTEHABER;?>
                                    </td>

                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
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
                <h4 class="modal-title">Lita de Tipos de Movimientos</h4>
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
                     <!--  <?php print_r($empleados);?>-->
                                <?php
                                
                                //echo "Esta es mi quinta frase hecha con Php!" ;
                                if(!empty($empleados)):?>

                                <?php
                                foreach($empleados as $empleado):?>
                                  
                                 <!-- SIRVE PARA MOSTRAR LOS DATOS DE UN ARRAY -->
                                 <!--<?php print_r($empleados) ;?>-->
                                 <!-- <?php print_r($empleado) ;?>-->
                                <tr>
                                    <td>
                                        <?php echo $empleado->IDEMPLEADO;?>
                                    </td>
                                    <td>
                                        <?php echo $empleado->NOMBRE;?>
                                        
                                    </td>
                                    <td>
                                        <?php echo $empleado->NUMEMPLEADO;?>
                                    </td>
                                    <?php $dataempleado = $empleado->IDEMPLEADO."*".$empleado->NOMBRE."*".$empleado->NUMEMPLEADO?>
                                                      
                                
                                    <td>

                                    <button type = "button" class="btn btn-success btn-check" value="<?php echo $dataempleado;?>"><span class= "fa fa-check"></span></button>

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
  $("#IDEMPLEADO").val(infoempleado[0]);
  $("#EMPLEADO").val(infoempleado[1]);
  $("#modal-default").modal("hide");

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

           html = '<tr>';
            html += '<td>';
            html += '<input type="hidden" id="EMPLEADO1" name="EMPLEADO1[]" value="'+ $("SELECT#EMPLEADO1 option:selected").val() + '" >'
            html += $("SELECT#EMPLEADO1 option:selected").text();
            html += '</td>';
            html += '<td>';
            html += '<input type="hidden"  name="DIAS[]" value="'+ $("#DIAS").val() + '" >'
            html += $("#DIAS").val();
            html += '</td>';
            html += '<td>';
            html += '<input type="hidden" name="HORAS[]" value="'+ $("#HORAS").val() + '" >'
            html += $("#HORAS").val();
            html += '</td>';
            html += '<td>';
            html += '<input type="hidden" name="IMPORTE[]" value="'+ $("#IMPORTE").val() + '" required>'
            html += $("#IMPORTE").val();
            html += '</td>';


                

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
