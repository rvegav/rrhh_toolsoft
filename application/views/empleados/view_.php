<?php
//$estado = $empleados->estadoEmpleado;
$estado = 1
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
$date_added = $empleado->fechaIngreso;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
$date_act   = $empleado->ultActualizacion;
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
		Id Empleado:
	</strong><?php echo $empleados->idEmpleado;?>
</p>
<p>
	<strong>
		Nro. Documento:
	</strong><?php echo $empleados->numEmpleado;?>
</p>
<p>
	<strong>
		Nombre:
	</strong><?php echo $empleados->nomEmpleado;?>
</p>
<p>
	<strong>
		Direccion:
	</strong><?php echo $empleados->dirEmpleado;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $empleados->telEmpleado;?>
</p>

<p>
	<strong>
		Estado:
	</strong>
	<span class="label <?php echo $label_class;?>">
		<?php echo $estado2; ?>
	</span>
</p>