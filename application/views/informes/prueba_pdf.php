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
            left: 1cm;
            right: 1cm;
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
        <hr>
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
        <table id="tb_empleado" style="margin-top: 10px" class="" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Nro Patronal</th>
                    <th>Nro. Doc.</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado Civil</th>
                    <th>Fecha Nacimiento</th>
                    <th>Nacionalidad</th>
                    <th>Domicilio</th>
                    <th>Hijos Menores</th>
                    <th>Cargo</th>
                    <th>Profesion</th>
                    <th>Fecha de Entrada</th>
                    <th>Fecha de Salida</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($empleados)):?>
                    <?php
                    foreach($empleados as $empleado):?>
                        <?php $cont=0; ?>
                        <?php foreach ($hijos as $hijo): ?>

                            <?php if ($hijo->idempleado == $empleado->IDEMPLEADO): ?>
                                <?php
                                $time = time();
                                $fechaActual = date("Y-m-d H:i:s",$time);
                                $dateDifference = abs(strtotime($hijo->fecnacimiento) - strtotime($fechaActual));
                                $years  = floor($dateDifference / (365 * 60 * 60 * 24));
                                if ($years<18) {
                                    $cont++;
                                } 
                                ;?>
                            <?php endif ?>
                        <?php endforeach ?>
                        <tr>
                            <td><?php echo $empleado->NUMEROIPS;?></td>
                            <td><?php echo $empleado->CEDULAIDENTIDAD;?></td>
                            <td><?php echo $empleado->NOMBRE;?></td>
                            <td><?php echo $empleado->APELLIDO;?></td>
                            <td><?php echo $empleado->DESCCIVIL;?></td>
                            <td><?php echo $empleado->FECNACIMIENTO;?></td>
                            <td><?php echo $empleado->DESPAIS;?></td>
                            <td><?php echo $empleado->DIRECCION;?></td>
                            <td><?php echo $cont ?></td>
                            <td><?php echo $empleado->CARGO;?></td>
                            <td><?php echo $empleado->PROFESION;?></td>
                            <td><?php echo $empleado->FECHAINGRESO;?></td>
                            <td><?php echo $empleado->FECHASALIDA;?></td>

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

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
        <script type="text/php">

            if (isset($pdf))
            {
                $x = 950;
                $y = 580;
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