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
        <h3 style="margin-top: -5px">Listado de Hijos</h3>
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
                    <th>Id Empleado</th>
                    <th>Documento del Empleado</th>
                    <th>Nombre Empleado</th>
                    <th>Nombre Hijo</th>
                    <th>Fecha Nacimiento</th>
                    <th>Edad</th>
                </tr>
            </thead>
            <tbody>
                <!-- aca  recorres tu select segun la variable que mandaste en el controlador Informes.php-->
                <?php
                if(!empty($hijos)):?>
                    <?php
                    foreach($hijos as $hijo):?>
                        <?php 
                        $time = time();
                        $fechaActual = date("Y-m-d H:i:s",$time);
                        $dateDifference = abs(strtotime($hijo->FECHA_NACIMIENTO_HIJO) - strtotime($fechaActual));
                        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
                        ?>
                        <tr>
                            <td><?php echo $hijo->IDEMPLEADO;?></td>
                            <td><?php echo $hijo->CEDULA_PADRE;?></td>
                            <td><?php echo $hijo->NOMBRE_PADRE;?></td>
                            <td><?php echo $hijo->NOMBRE_HIJO;?></td>
                            <td><?php echo $hijo->FECHA_NACIMIENTO_HIJO;?></td>
                            <td><?php echo $years;?></td>

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