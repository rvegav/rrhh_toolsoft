<?php
//$estado = $empleados->estadoEmpleado;
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
$date_added = $empleados->FECHAINGRESO;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
//$date_act   = $empleados->ultActualizacion;
$date_act = date('d-M-Y H:i:s', strtotime($date_added));
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
		Código Empleado:
	</strong><?php echo $empleados->NUMEMPLEADO;?>
</p>
<p>
	<strong>
		Nombre:
	</strong><?php echo $empleados->NOMBRE;?>
</p>
<p>
	<strong>
		APELLIDO:
	</strong><?php echo $empleados->APELLIDO;?>
</p>
<p>
	<strong>
		Direccion:
	</strong><?php echo $empleados->DIRECCION;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $empleados->TELEFONO;?>
</p>

<p>
	<strong>
		Fecha Inngreso:
	</strong><?php echo $empleados->FECHAINGRESO;?>
</p>

<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>