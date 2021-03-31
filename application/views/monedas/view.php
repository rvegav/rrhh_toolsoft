<?php
$estado = 1;
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
$date_added = $moneda->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $moneda->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $moneda->FECGRABACION;
}
?>
<p>
	<strong>
		Nro. Moneda:
	</strong><?php echo $moneda->NUMMONEDA;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $moneda->DESMONEDA;?>
</p>
<p>
	<strong>
		Simbolo:
	</strong><?php echo $moneda->SIMBOLO;?>
</p>
<p>
	<strong>
		Prioridad:
	</strong><?php echo $moneda->PRIORIDAD;?>
</p>
<p>
	<strong>
		Decimales:
	</strong><?php echo $moneda->DECIMALES;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>