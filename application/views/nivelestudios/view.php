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
$date_added = $nivelestudio->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $nivelestudio->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $nivelestudio->FECGRABACION;
}
?>
<p>
	<strong>
		Id:
	</strong><?php echo $nivelestudio->IDNIVEL;?>
</p>
<p>
	<strong>
		Nro. Nivel de Estudio:
	</strong><?php echo $nivelestudio->NUMNIVEL;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $nivelestudio->DESNIVEL;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>