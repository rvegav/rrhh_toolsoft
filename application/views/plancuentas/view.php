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
$date_added = $cuenta->FECHAGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $cuenta->FECHAGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $cuenta->FECHAGRABACION;
}
?>
<p>
	<strong>
		Id Cuenta:
	</strong><?php echo $cuenta->IDCUENTACONTABLE;?>
</p>
<p>
	<strong>
		Nro. Cuentaa:
	</strong><?php echo $cuenta->NUMPLANCUENTA;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $cuenta->DESPLANCUENTA;?>
</p>
<p>
	<strong>
		Imponible:
	</strong><?php echo $cuenta->IMPONIBLE;?>
</p>
<p>
	<strong>
		Nivel de Cuenta:
	</strong><?php echo $cuenta->NIVELCUENTA;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>