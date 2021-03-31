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
$date_added = $zona->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $zona->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $zona->FECGRABACION;
}
?>
<p>
	<strong>
		Id Zona:
	</strong><?php echo $zona->IDZONA;?>
</p>
<p>
	<strong>
		Nro. Zona:
	</strong><?php echo $zona->NUMZONA;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $zona->DESZONA;?>
</p>
<p>
	<strong>
		Ciudad:
	</strong><?php echo $zona->DESCIUDAD;?>
</p>
<p>
	<strong>
		Fecha de Grabacion:
	</strong><?php echo $zona->FECGRABACION;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>