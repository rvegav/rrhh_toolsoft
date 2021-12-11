<style type="text/css">
	body{
		margin-top: 50px;
		font-family: sans-serif;
		font-size: 10px;
		padding: 0px 50px;
	}
	img{
		height: 70px;
	}
	#th-1{
		padding-bottom: 8px;
		text-align: center;
		
	}
	#tbl{
		max-width: 100%;
		width: 100%;
		border:none;
		line-height: 30px;
	}
	.pt-1{
		padding-top: 1px;
	}
	.pt-4{
		padding-top: 12px;
	}
	.pt-5{
		padding-top: 30px;
	}
	.margen{
		padding-left: 150px;
	}
	.font-12{
		font-size: 12px;
	}
	.font-14{
		font-size: 14px;
	}
	.font-16{
		font-size: 16px;
	}
	.foot{
		/*height: 4rem;*/
		background-color: red;
	}
	.bg-gray{
		background-color: gray;
		padding-top: 15px;
		color: white;
	}
	div {
		position: fixed; 
		bottom: 0cm; 
		left: 0cm; 
		right: 0cm;
		height: 3cm;
		text-align: center;
		line-height: 0.75cm;
		font-weight: 600;
		font-style: italic;
		padding: 0px 50px;
		/*border-top: solid;*/
		/*border-top: solid;*/
	}
	.justify{
		text-align: justify;
	}
</style>
<table id="tbl">
	<thead>
		<tr>
			<th id="th-1" colspan="8"><img src="<?php echo base_url().'assets/img/logo1.png'?>"></th>
			
		</tr>
		<tr>
			<th colspan="8" style="text-align: center ;">LISTADO DE EMPLEADOS </th>
		</tr>
	</thead>
</table>
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
			
		<?php $cont++;	} ?>
		<?php endif; ?>

	</tbody>
</table>
<div style="">
	<hr style="background: #000000;">
	TOOLSOFT
	<table>
		<tfoot>
		<tr>
			<th>
				Fecha de Emisión: <b><?php echo $fecha; ?></b><br>
			</th>
		</tr>
		</tfoot>
	</table>
</div>
<script type="text/php">
    if (isset($pdf))
    {
        $x = 550;
        $y = 934;
        $text = "{PAGE_NUM} de {PAGE_COUNT}";
        $font = $fontMetrics->get_font("helvetica", "bold");
        $size = 8;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>