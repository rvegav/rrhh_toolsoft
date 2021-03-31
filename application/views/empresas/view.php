<?php
$estado = $empresas->estadoEmpleado;
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
$date_added = $empresas->fecgra;
$date_added = date('d-M-Y H:i:s', strtotime($date_added));
/*$date_act   = $empresas->ultActualizacion;
*/if($date_act == "")
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
		Id Empresa:
	</strong><?php echo $empresas->codempresa;?>
</p>
<p>
	<strong>
		Nombre de Fantasia:
	</strong><?php echo $empresas->nomfantasia;?>
</p>
<p>
	<strong>
		Nombre de Contribuyente:
	</strong><?php echo $empleados->numcontribuyente;?>
</p>
<p>
	<strong>
		Direccion:
	</strong><?php echo $empresas->ruc;?>
</p>
<p>
	<strong>
		Telefono:
	</strong><?php echo $empresas->desempresa;?>
</p>
<p>
	<strong>
		Usuario:
	</strong><?php echo $empresas->direccion;?>
</p>
<p>
	<strong>
		Cargo:
	</strong><?php echo $empresas->telefono;?>
</p>
<p>
	<strong>
		Departamento:
	</strong><?php echo $empresas->email;?>
</p>
<p>
	<strong>
		Fecha Inngreso:
	</strong><?php echo $date_added;?>
</p>
<p>
	<strong>
		Ult. Actualizacion:
	</strong><?php echo $date_act;?>
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