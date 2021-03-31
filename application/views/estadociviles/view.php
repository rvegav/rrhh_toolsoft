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
$date_added = $estadocivil->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $estadocivil->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $estadocivil->FECGRABACION;
}
?>
<p>
	<strong>
		Id Estado Civil:
	</strong><?php echo $estadocivil->IDCIVIL;?>
</p>
<p>
	<strong>
		Nro. Estado Civil:
	</strong><?php echo $estadocivil->NUMCIVIL;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $estadocivil->DESCIVIL;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>