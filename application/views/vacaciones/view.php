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
$date_added = $vacacion->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $vacacion->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $vacacion->FECGRABACION;
}
?>

<p>
	<strong>
		Desde (Años):
	</strong><?php echo $vacacion->DESDE;?>
</p>
<p>
	<strong>
		Hasta (Años):
	</strong><?php echo $vacacion->HASTA;?>
</p>
<p>
	<strong>
		Cantidad de Dias:
	</strong><?php echo $vacacion->CANTIDADDIAS;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>