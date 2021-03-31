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
$date_added = $banco->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $banco->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $banco->FECGRABACION;
}
?>
<p>
	<strong>
		Id Banco:
	</strong><?php echo $banco->IDBANCO;?>
</p>
<p>
	<strong>
		Nro. Banco:
	</strong><?php echo $banco->NUMBANCO;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $banco->DESBANCO;?>
</p>
<p>
	<strong>
		Direccion:
	</strong><?php echo $banco->DIRECCION;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $banco->TELEFONO;?>
</p>
<p>
	<strong>
		Correo Electronico:
	</strong><?php echo $banco->EMAIL;?>
</p>
<p>
	<strong>
		Web:
	</strong><?php echo $banco->WEB;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>