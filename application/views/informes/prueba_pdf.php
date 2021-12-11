<html>
<head>
    <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
        @page {
            margin: 0cm 0cm;
        }
        

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;

        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 1cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            /*margin-bottom: 1cm;*/
        }

        /** Define the footer rules **/
        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 1cm; 
            right: 1cm;
            height: 2cm;
        }
        img{
            height: 50px;
        }

/*        #pagina:after {
            content: counter(page);
        }*/
    </style>
</head>
<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="<?php echo base_url().'assets/img/logo1.png'?>" width="70">
        <h3 style="margin-top: -5px">Listado de Empleado</h3>
        <!-- <h5 style="margin-top: -20px">otra cosa</h5> -->
    </header>

    <footer>
        <div style="">
            <hr style="background: #000000;">
            TOOLSOFT
            <table>
                <tfoot>
                    <tr>
                        <th>
                            Fecha de Emisión: <b id="pagina"><?php echo $fecha; ?></b><br> 
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <table id="tb_empleado" class="" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>#</th>
                    <th>Nro. Doc.</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th>Agregado el</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($empleados)):?>
                    <?php $cont =0; ?>
                    <?php while ($cont <30) {?>
                        // code...
                        <?php
                        foreach($empleados as $empleado):?>
                            <tr>
                                <td><?php echo $empleado->NUMEMPLEADO;?></td>
                                <td><?php echo $empleado->CEDULAIDENTIDAD;?></td>
                                <td><?php echo $empleado->EMPLEADO;?></td>
                                <td><?php echo $empleado->TELEFONO;?></td>
                                <td><?php echo $empleado->DIRECCION;?></td>
                                <td><?php echo $empleado->CATEGORIA;?></td>

                                <?php
                                $estado = $empleado->ESTADO;
                                if($estado == 1)
                                {
                                    $estado2     = "Activo";$label_class = 'label-success';
                                }
                                else
                                {
                                    if($estado == 2)
                                    {
                                        $estado2     = "Inactivo";$label_class = 'label-warning';
                                    }
                                    else
                                    {
                                        $estado2     = "Anulado";$label_class = 'label-danger';
                                    }
                                }
                                ?>
                                <td><span class="label <?php echo $label_class;?>"><?php echo $estado2; ?></span></td>
                                <td><?php echo $empleado->FECHAINGRESO;?></td>

                            </tr>
                        <?php endforeach; ?>

                        <?php $cont++;  } ?>
                    <?php endif; ?>

                </tbody>
            </table>
            <script type="text/php">
                
                if (isset($pdf))
                {
                    $x = 550;
                    $y = 980;
                    $text = "{PAGE_NUM} de {PAGE_COUNT}";
                    $font = $fontMetrics->get_font("helvetica", "bold");
                    $size = 10;
                    $color = array(0,0,0);
                    $word_space = 0.0;  //  default
                    $char_space = 0.0;  //  default
                    $angle = 0.0;   //  default
                    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
                }
            </script>
        </main>
    </body>
    </html>