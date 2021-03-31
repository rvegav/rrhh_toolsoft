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
$date_added = $tipocuenta->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $tipocuenta->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $tipocuenta->FECGRABACION;
}
?>
<p>
	<strong>
		Id Tipo de Cuenta:
	</strong><?php echo $tipocuenta->IDTIPOCUENTA;?>
</p>
<p>
	<strong>
		Nro. Tipo de Cuenta:
	</strong><?php echo $tipocuenta->NUMTIPOCUENTA;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $tipocuenta->DESTIPOCUENTA;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>