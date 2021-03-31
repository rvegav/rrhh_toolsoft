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
$date_added = $categoria->FECGRABACION;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act = $categoria->FECGRABACION;
if($date_act == "")
{
	$date_act = "Sin Datos";
}
else
{
//$date_act = date('d-M-Y H:i:s', strtotime($date_act));
$date_act = $categoria->FECGRABACION;
}
?>
<p>
	<strong>
		Id Categoria:
	</strong><?php echo $categoria->IDCATEGORIA;?>
</p>
<p>
	<strong>
		Nro. Categoria:
	</strong><?php echo $categoria->NUMCATEGORIA;?>
</p>
<p>
	<strong>
		Descripcion:
	</strong><?php echo $categoria->DESCATEGORIA;?>
</p>
<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>