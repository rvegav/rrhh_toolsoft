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
        

        /* Define now the real margins of every page in the PDF */
        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;

        }

        /* Define the header rules */
        header {
            position: fixed;
            top: 1cm;
            left: 1cm;
            right: 1cm;
            height: 2cm;
            text-align: center;
            /margin-bottom: 1cm;/
        }

        /* Define the footer rules */
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
        <h3 style="margin-top: -5px">Listado de Sueldos y Jornales</h3>
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
                    <th style="font-size: 11px">Documento</th>
                    <th style="font-size: 11px">Forma de Pago</th>
                    <th style="font-size: 11px">Importe Unitario</th>
                    <th style="font-size: 11px">H_ene</th>
                    <th style="font-size: 11px">S_ene</th>
                    <th style="font-size: 11px">H_feb</th>
                    <th style="font-size: 11px">S_feb</th>
                    <th style="font-size: 11px">H_marzo</th>
                    <th style="font-size: 11px">S_marzo</th>
                    <th style="font-size: 11px">H_abril</th>
                    <th style="font-size: 11px">S_abril</th>
                    <th style="font-size: 11px">H_mayo</th>
                    <th style="font-size: 11px">S_mayo</th>
                    <th style="font-size: 11px">H_junio</th>
                    <th style="font-size: 11px">S_junio</th>
                    <th style="font-size: 11px">H_julio</th>
                    <th style="font-size: 11px">S_julio</th>
                    <th style="font-size: 11px">H_agosto</th>
                    <th style="font-size: 11px">S_agosto</th>
                    <th style="font-size: 11px">H_sep</th>
                    <th style="font-size: 11px">S_sep</th>
                    <th style="font-size: 11px">H_oct</th>
                    <th style="font-size: 11px">S_oct</th>
                    <th style="font-size: 11px">H_nov</th>
                    <th style="font-size: 11px">S_nov</th>
                    <th style="font-size: 11px">H_dic</th>
                    <th style="font-size: 11px">S_dic</th>                    
                    <th style="font-size: 11px">Aguinaldo</th>
                    <th style="font-size: 11px">Bonificacion</th>
                    <th style="font-size: 11px">Vacaciones</th>
                    <th style="font-size: 11px">Total_H</th>
                    <th style="font-size: 11px">Total_S</th>
                    <th style="font-size: 11px">Total General</th>
                </tr>
            </thead>
            <tbody>
                <!-- aca  recorres tu select segun la variable que mandaste en el controlador Informes.php-->
                <?php
                if(!empty($sueldos)):?>
                    <?php
                    foreach($sueldos as $sueldo):?>
                        <tr>
                            <td style="font-size: 11px"><?php echo $sueldo->documento;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->formapago;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->importeunitario;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_ene;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_ene;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_feb;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_feb;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_mar;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_mar;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_abril;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_abril;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_may;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_may;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_junio;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_junio;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_julio;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_julio;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_agosto;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_agosto;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_sep;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_sep;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_oct;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_oct;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_nov;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_nov;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->h_dic;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->s_dic;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->aguinaldo;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->bonificaciones;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->vacaciones;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->total_h;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->total_s;?></td>
                            <td style="font-size: 11px"><?php echo $sueldo->totalgeneral;?></td>
               style="font-size: 15px"          </tr>
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