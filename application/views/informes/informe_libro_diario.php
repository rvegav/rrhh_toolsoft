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
        th{
            font-size: 15px;
        }
        td{
            font-size: 15px;
        }
    </style>
</head>
<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="<?php echo base_url().'assets/img/logo1.png'?>" width="70">
        <h3 style="margin-top: -5px">LIBRO DIARIO</h3>
        <p style="margin-top: -20px"><b>Rango Desde:</b> <?php echo $desde ?>  <b>Hasta</b>: <?php echo $hasta ?></p>
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
        <table id="tab_diario" class="" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Linea</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Detalle Asiento</th>
                    <th>Debe</th>
                    <th>Haber</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!empty($asientos)):?>
                        <?php
                        foreach($asientos as $asiento):?>
	                    	<tr>
	                    		<td>Nro: <?php echo $asiento->numasiento ?></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td>Fecha: <?php echo $asiento->fechaasiento ?></td>
	                    	</tr>
	                    	<?php $cont = 0; $totalDebe=0; $totalHaber =0; ?>
                            <?php foreach ($detallesasientos as $detalleasiento): ?>
                            	<?php $cont++ ?>
                            	<?php if ($detalleasiento->idasiento == $asiento->idasiento): ?>
                            		<?php $totalDebe = $detalleasiento->importedebe + $totalDebe?>
                            		<?php $totalHaber = $detalleasiento->importeahaber + $totalHaber?>
	                            	<tr>
	                            		<td><?php echo $cont ?></td>
	                            		<td><?php echo $detalleasiento->numplancuenta ?></td>
	                            		<td><?php echo $detalleasiento->descplancuenta ?></td>
	                            		<td></td>
	                            		<td><?php echo $detalleasiento->importedebe ?></td>
	                            		<td><?php echo $detalleasiento->importeahaber ?></td>
	                            	</tr>                            		
                            	<?php endif ?>
                            <?php endforeach ?>
                            <tr>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td><b>Total Asiento</b></td>
                            	<td><b><?php echo $totalDebe?></b></td>
                            	<td><b><?php echo $totalHaber?></b></td>
                            </tr>
                        <?php endforeach; ?>
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