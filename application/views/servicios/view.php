<?php
$estado = $servicios->estServicio;
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
$date_added = $servicios->fechaCreacion;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act   = $servicios->ultActualizacion;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
	$date_act = date('d-M-Y H:i:s', strtotime($date_act));

}
?>
<p>
	<strong>
		Id Servicio:
	</strong><?php echo $servicios->idServicio;?>
</p>
<p>
	<strong>
		Detalle Servicio:
	</strong><?php echo $servicios->desServicio;?>
</p>
<p>
	<strong>
		Fecha Alta:
	</strong><?php echo $date_added;?>
</p>

<p>
	<strong>
		Ult. Actualizacion:
	</strong><?php echo $date_act;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>