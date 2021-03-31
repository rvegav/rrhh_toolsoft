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
$date_added = $sucursal->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $sucursal->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $sucursal->FECGRABACION;
}
?>
<p>
	<strong>
		Nro. Sucursal:
	</strong><?php echo $sucursal->NUMSUCURSAL;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $sucursal->DESSUCURSAL;?>
</p>
<p>
	<strong>
		Zona:
	</strong><?php echo $sucursal->DESZONA;?>
</p>
<p>
	<strong>
		Direccion:
	</strong><?php echo $sucursal->DIRECCION;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $sucursal->TELEFONO;?>
</p>
<p>
	<strong>
		Nro. Registro Patronal:
	</strong><?php echo $sucursal->NROPATRONAL;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>