<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Archivos de Pago</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <?php
                if($this->session->flashdata("success")): ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Buen Trabajo!</strong>
                        <p><?php echo $this->session->flashdata("success")?></p>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($this->session->flashdata("error")): ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Error!</strong>
                    <p><?php echo $this->session->flashdata("error")?></p>
                </div>
            <?php endif; ?>
            <div class="x_title">
                <h2>Archivos de Pago | Generar</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li>
                        <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="frm_generar" name="prueba1" data-parsley-validate="" class="form-horizontal form-label-left" method="POST" novalidate="">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="movimiento">Por Movimiento <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select name="movimiento" id="movimiento" class="form-control">
                                    <option value="1">IPS</option>
                                    <option value="2">SALARIO</option>
                                    <option value="3">AGUINALDO</option>
                                </select>
                            </div>
                        </div>
                        <div class="mensaje"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Desde <span class="required">*</span></label>
                            <div class ="col-md-4 col-sm-6 col-xs-12">
                                <input type="date" class="form-control col-md-7 col-xs-12" name="fechadesde" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Hasta <span class="required">*</span></label>
                            <div class ="col-md-4 col-sm-6 col-xs-12">
                                <input type="date" class="form-control col-md-7 col-xs-12" name="fechahasta" required="required">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-3">
                                <button type="submit" class="btn btn-success btn-block">Generar</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- /COL  12-->
            </div><!-- /ROW -->
        </div><!-- / content -->
    </div>
</div>
</div>
<!------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    var base_url= "<?php echo base_url();?>";
    $("#frm_generar").submit(function(event) {
        event.preventDefault();
        var formDato = $(this).serialize();
        // var movi = $("#movimiento option:selected").val();
        // var desde =
        // var hasta =  
        $.ajax({
            url: base_url+'generar_archivo',
            type: 'POST',
            data: formDato,
            beforeSend: function() {
                $("#mdlAguarde").modal('show');
            }
        })
        .done(function(result) {
            var r = JSON.parse(result);
            $("#mdlAguarde").modal('hide');
            console.log(r['alerta']);
            const wrapper = document.createElement('div');
            if (r['alerta']!="") {
                var mensaje = r['alerta'];
                wrapper.innerHTML = mensaje;
                swal({
                    // buttons: true,
                    title: 'Atención!', 
                    content: wrapper,
                    icon: "warning",
                    // dangerMode: true,
                    columnClass: 'medium',
                    // theme: 'modern',
                });
            }
            if (r['error']!="") {
                wrapper.innerHTML = r['error'];
                swal({
                    icon: "error",
                    columnClass: 'medium',
                    theme: 'modern',
                    title: 'Error!',
                    content: wrapper,
                });
            }
            if (r['correcto']!="") {
                wrapper.innerHTML = r['correcto'];
                swal({
                    icon: "success",
                    columnClass: 'medium',
                    theme: 'modern',
                    title: 'Correcto!',
                    content: wrapper,
                });
                window.location = base_url+r['datos'];
            }
        }).fail(function() {
            alert("Se produjo un error, contacte con el soporte técnico");
            $("#mdlAguarde").modal('hide');
        });
        
    });

</script>