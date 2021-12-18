<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Procesocierres extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		//$this->load->model("Empleados_model");
		$this->load->model("Procesocierres_model");
		$this->load->model(array('Procesocierres_model', 'Movimientos_model', 'Plancuenta_model', 'Usuarios_model'));

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	//esta funcion es la primera que se ejecuta para cargar los datos
	public function index()
	{	
		$this->comprobacionRoles();
		//cargamos un array usando el modelo
		$data = array(
			'procesocierres'=> $this->Procesocierres_model->getProcesocierre()
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('procesocierres/add', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();
		$data = array(			
			'maximos' => $this->Procesocierres_model->getIdMaximo(),
			'sucursales' => $this->Procesocierres_model->getSucursal(),
			'departamentos' => $this->Procesocierres_model->getDepartamento(),
			'empresas' => $this->Procesocierres_model->getEmpresa()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('procesocierres/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($idMovi)
	{
		$this->comprobacionRoles();
		$data = array (
			'movimientos'=> $this->Movimientos_model->getMovimientoDetalle($idMovi),
			'empleados'=>$this->Procesocierres_model->getEmpleado()
		);
		//abrimos la vista view
		$this->load->view("movimientos/view", $data);
		$IDMOVI = $this->input->post("IDMOVI");

	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		$this->form_validation->set_rules("FECHADESDE", "Fecha Desde", "required");
		$this->form_validation->set_rules("FECHAHASTA", "fecha Hasta", "required");
		if ($this->form_validation->run() == FALSE){
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 
			// $this->session->set_flashdata('error', validation_errors());
		}else{
			// $IDCIERRE   = $this->input->post("IDCIERRE");
			$DESDESUCURSAL   = $this->input->post("SUCURSAL_DESDE");
			$HASTASUCURSAL   = $this->input->post("SUCURSAL_HASTA");
			$DESDEDEPARTAMENTO   = $this->input->post("DEPARTAMENTO_DESDE");
			$HASTADEPARTAMENTO   = $this->input->post("DEPARTAMENTO_HASTA");
			$FECHADESDE   = $this->input->post("FECHADESDE");
			$FECHAHASTA   = $this->input->post("FECHAHASTA");

			$parametros['DESDESUCURSAL']= $DESDESUCURSAL;
			$parametros['HASTASUCURSAL']= $HASTASUCURSAL;
			$parametros['HASTADEPARTAMENTO']= $HASTADEPARTAMENTO;
			$parametros['DESDEDEPARTAMENTO']= $DESDEDEPARTAMENTO;
			// $parametros['FECHADESDE']= $FECHADESDE;
			// $parametros['FECHAHASTA']= $FECHAHASTA;
			$empleados = $this->Procesocierres_model->getEmpleado($parametros);
			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);
			if ($empleados) {
				$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento('SALARIO');
				$data = array('IDTIPOMOVISUELDO'  => $tipoMovimiento->IDTIPOMOVISUELDO,//MIENTRAS
					'FECHAMOVI'  => $fechaActual,
					'IDEMPRESA' => 1,
					'IDMONEDA' => 1);
				$id_movimiento = $this->Movimientos_model->save($data);
				foreach ($empleados as $empleado ) {
					$data = array(
						'idmovi' => $id_movimiento,
						'idempleado' => $empleado->IDEMPLEADO,
						'dias' => 0,
						'horas' => 0,
						'importe' => $empleado->MONTOASIGNADO,
						'FECGRABACION'=> $fechaActual
					);
					$this->Movimientos_model->save_detalle($data);
				}
				$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento('IPS');
				$data = array('IDTIPOMOVISUELDO'  => $tipoMovimiento->IDTIPOMOVISUELDO,//MIENTRAS
					'FECHAMOVI'  => $fechaActual,
					'IDEMPRESA' => 1,
					'IDMONEDA' => 1);
				$id_movimiento = $this->Movimientos_model->save($data);
				foreach ($empleados as $empleado ) {
					$total_movimientos_suma = $this->Movimientos_model->getTotalMovimientosSuma($empleado->IDEMPLEADO, $FECHADESDE, $FECHAHASTA);
					$importeIPS = $total_movimientos_suma->IMPORTE * ($tipoMovimiento->PORCENTAJE /100);
					$data = array(
						'idmovi' => $id_movimiento,
						'idempleado' => $empleado->IDEMPLEADO,
						'dias' => 0,
						'horas' => 0,
						'importe' => $importeIPS,
						'FECGRABACION'=> $fechaActual
						
					);
					$this->Movimientos_model->save_detalle($data);
				}

				//GENERA HORAS EXTRAS
				$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento('HORAS EXTRAS');
				$dataCabecera = array('IDTIPOMOVISUELDO'  => $tipoMovimiento->IDTIPOMOVISUELDO,//MIENTRAS
					'FECHAMOVI'  => $fechaActual,
					'IDEMPRESA' => 1,
					'IDMONEDA' => 1);
				$id_movimiento = $this->Movimientos_model->save($dataCabecera);

				foreach ($empleados as $empleado ) {
					$monto = $this->Procesocierres_model->getMontoHorasExtras($FECHADESDE, $FECHAHASTA,$empleado->IDEMPLEADO);
					
					$horasextras = $this->Procesocierres_model->getHorasExtras($FECHADESDE, $FECHAHASTA,$empleado->IDEMPLEADO);					
					$data = array(
						'idmovi' => $id_movimiento,
						'idempleado' => $empleado->IDEMPLEADO,
						'dias' => 0,
						'horas' => $horasextras->horasextras,
						'importe' => $monto->importehorasextras,
						'FECGRABACION'=> $fechaActual
						
					);

					if ($monto->importehorasextras > 0)
					{
						
						$this->Movimientos_model->save_detalle($data);
					}
					
				}


				foreach ($empleados as $empleado) {
					$movimientosEmpleado = $this->Movimientos_model->getMovimientosEmpleados($empleado->IDEMPLEADO, $FECHADESDE, $FECHAHASTA);
					$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento('IPS');
					$porcentajeIps=$tipoMovimiento->PORCENTAJE;
					if ($movimientosEmpleado) {
						// var_dump($movimientosEmpleado);
						// die();
						foreach ($movimientosEmpleado as $movimiento) {
							if ($movimiento->AGUINALDO !='0') {
								$data = array(
									'idempleado' => $empleado->IDEMPLEADO,
									'idsucursal' => $empleado->IDSUCURSAL,
									'FECHADESDE' => $FECHADESDE,
									'FECHAHASTA' => $FECHAHASTA,
									'IMPORTEMOV'=> $movimiento->IMPORTE,
									'NETO'=>$movimiento->IMPORTE - ($movimiento->IMPORTE * ($porcentajeIps/100))
								);
							}else{
								$data = array(
									'idempleado' => $empleado->IDEMPLEADO,
									'idsucursal' => $empleado->IDSUCURSAL,
									'FECHADESDE' => $FECHADESDE,
									'FECHAHASTA' => $FECHAHASTA,
									'IMPORTEMOV'=> $movimiento->IMPORTE,
									'NETO'=>$movimiento->IMPORTE
								);
							}
							$this->Procesocierres_model->saveProcesocierre($data);
						}
					}
				}
				//se obitiene los tipos de movimientos presentes en el mes
				$conceptosFijos = $this->Movimientos_model->getConceptoFijosActivos($FECHADESDE, $FECHAHASTA);
				if ($conceptosFijos) {
					$concepto_aux='';
					foreach ($conceptosFijos as $concepto) {
						if ($concepto_aux !=$concepto->IDTIPO) {
							$tipoMovimiento = $concepto->IDTIPO;
							$data = array('IDTIPOMOVISUELDO'  => $tipoMovimiento,//MIENTRAS
								'FECHAMOVI'  => $fechaActual,
								'IDEMPRESA' => 1,
								'IDMONEDA' => 1);
							$id_movimiento = $this->Movimientos_model->save($data);
							$concepto_aux = $concepto->IDTIPO;
						}
						$data = array(
							'idmovi' => $id_movimiento,
							'idempleado' => $concepto->IDEMPLEADO,
							'dias' => 0,
							'horas' => 0,
							'importe' => $concepto->IMPORTE,
							'FECGRABACION'=> $fechaActual
						);
						$this->Movimientos_model->save_detalle($data);
					}
				}

				$movimientos = $this->Movimientos_model->getTotalMovimientoMes($FECHADESDE, $FECHAHASTA, '+');

				if ($movimientos) {
					$data = array(
						'idempresa' =>1,
						'idsucursal' =>1,
						'idusuario' =>1,
						'fechaasiento' => $fechaActual,
						'cotizacion1' => 1,
						'cotizacion2' => 1,
						'generado' => 1,
						'fechagrabacion'=>  $fechaActual
					);
					$id_asiento = $this->Procesocierres_model->saveAsiento($data);
					foreach ($movimientos as $movimiento) {
						$montototalSuma = 0;
						$importedebe = 0;
						$importehaber = 0;
						$importedebe = $movimiento->IMPORTE;
						$data = array(
							'idplancuenta' =>$movimiento->IDPLANCUENTA,
							'idasiento' =>$id_asiento,
							'comentario' => $movimiento->DESTIPOMOV,
							'importedebe' => $importedebe,
							'importeahaber' => $importehaber
						);
						$this->Procesocierres_model->saveAsiento_detalle($data);
						if ($movimiento->AGUINALDO =='1') {
							$montototalSuma = $montototalSuma + $importedebe;
							$importedebe = 0;
							$importehaber = 0;
							$idPlancuenta = $this->Plancuenta_model->getPlancuenta(false,'APORTE PATRONAL IPS A PAGAR');
							$importedebe = ($movimiento->IMPORTE)*0.165;

							$data = array(
								'idplancuenta' =>$idPlancuenta->IDPLANCUENTA,
								'idasiento' =>$id_asiento,
								'comentario' => $idPlancuenta->DESCPLANCUENTA,
								'importedebe' => $importedebe,
								'importeahaber' => $importehaber
							);
							$this->Procesocierres_model->saveAsiento_detalle($data);
							$montototalSuma = $montototalSuma + $importedebe;
							$importedebe = 0;
							$importehaber = 0;
							$idPlancuenta = $this->Plancuenta_model->getPlancuenta(false,'APORTE RETENIDOS IPS A PAGAR');
							$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento('IPS');
							$porcentajeIps=($tipoMovimiento->PORCENTAJE)/100;
							$importehaber = ($montototalSuma)*$porcentajeIps;
							$data = array(
								'idplancuenta' =>$idPlancuenta->IDPLANCUENTA,
								'idasiento' =>$id_asiento,
								'comentario' => $idPlancuenta->DESCPLANCUENTA,
								'importedebe' => $importedebe,
								'importeahaber' => $importehaber
							);
							$this->Procesocierres_model->saveAsiento_detalle($data);
						}
						$importedebe = 0;
						$importehaber = $montototalSuma-$importehaber;
						$idPlancuenta = $this->Plancuenta_model->getPlancuenta(false,'CAJA');	

						$data = array(
							'idplancuenta' =>$idPlancuenta->IDPLANCUENTA,
							'idasiento' =>$id_asiento,
							'comentario' => $idPlancuenta->DESCPLANCUENTA,
							'importedebe' => $importedebe,
							'importeahaber' => $importehaber,
							'eliminado'=>  $fechaActual
						);
						$this->Procesocierres_model->saveAsiento_detalle($data);

					}
				}
				$movimientos = $this->Movimientos_model->getTotalMovimientoMes($FECHADESDE, $FECHAHASTA, '-');
				if ($movimientos) {
					$data = array(
						'idempresa' =>1,
						'idsucursal' =>1,
						'idusuario' =>1,
						'fechaasiento' => $fechaActual,
						'cotizacion1' => 1,
						'cotizacion2' => 1,
						'generado' => 1,
						'fechagrabacion'=>  $fechaActual
					);
					$id_asiento = $this->Procesocierres_model->saveAsiento($data);
					foreach ($movimientos as $movimiento) {
						$importedebe = 0;
						$importehaber = $movimiento->IMPORTE;
						$importedebe = 0;
						$data = array(
							'idplancuenta' =>$movimiento->IDPLANCUENTA,
							'idasiento' =>$id_asiento,
							'comentario' => $movimiento->DESTIPOMOV,
							'importedebe' => $importedebe,
							'importeahaber' => $importehaber
						);
						$this->Procesocierres_model->saveAsiento_detalle($data);
						$importedebe = $movimiento->IMPORTE;
						$importehaber = 0;
						$idPlancuenta = $this->Plancuenta_model->getPlancuenta(false,'CAJA');	

						$data = array(
							'idplancuenta' =>$idPlancuenta->IDPLANCUENTA,
							'idasiento' =>$id_asiento,
							'comentario' => $idPlancuenta->DESCPLANCUENTA,
							'importedebe' => $importedebe,
							'importeahaber' => $importehaber,
							'eliminado'=>  $fechaActual
						);
						$this->Procesocierres_model->saveAsiento_detalle($data);
					}
				}
				$this->session->set_flashdata('success', 'Se Generó con Exito');


			}
			redirect(base_url()."procesocierres/procesocierres/add","refresh");
			
		}

	}

	protected function validar_fecha_espanol($fecha,$fechahasta)
	{
		$valores = explode('-', $fecha);
		$valores1 = explode('-', $fechahasta);

		if (count($valores) == 3 && checkdate($valores[2], $valores[1], $valores[0])){
			if (count($valores1) == 3 && checkdate($valores1[1], $valores1[2], $valores1[0])){
			//print_r($valores1); die();
				return true;
			}else{
				return false;			
			}

		}else{
			return false;	
		}

	}


	protected function save_procesocierre($idcierre,$fechadesde,$fechahasta,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA)
	{

		$liquidacion =  $this->Procesocierres_model->obtenerMovimientos($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);
		try {

			for ($i=0; $i < count($liquidacion); $i++) {

				$data = array(
					'idcierre' => $idcierre,
					'idtipomovisueldo' => $liquidacion[$i]['IDTIPOMOV'],
					'horamov' => $liquidacion[$i]['HORAS'],
					'importemov' => $liquidacion[$i]['IMPORTE'],
					'fechadesde' => $fechadesde,
					'fechahasta' => $fechahasta,
					'idempresa' => $liquidacion[$i]['IDEMPRESA'],
					'idsucursal' => $liquidacion[$i]['IDSUCURSAL'],
					'idempleado' => $liquidacion[$i]['IDEMPLEADO']		    		    
				);

				$this->Procesocierres_model->saveProcesocierre($data);

			}      
			return true;

		} catch (Exception $e) {
			  //alert the user.
			return false;
		}
	}


	protected function save_asientoDetalle($idasiento,$idcierre,$fechadesde,$fechahasta,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA)
	{

		$asientos =  $this->Procesocierres_model->obtenerAiento($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

//print_r($liquidacion); die();
		try {

			for ($i=0; $i < count($asientos); $i++) {

				$data = array(
					'iddiario' => $idasiento,
					'idcuentacontable' => $asientos[$i]['IDCUENTACONTABLE'],
					'IMPORTEDEBE' => $asientos[$i]['IMPORTE']		  	    		    
				);

				$this->Procesocierres_model->saveAsiento_detalle($data);

			}      
			return true;

		} catch (Exception $e) {
			  //alert the user.
			return false;
		}
	}
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimiento($id),
			'tipoMovimientos'=>$this->Movimientos_model->getTipoMovimiento(),
			'empleados'=>$this->Movimientos_model->getEmpleado(),
			'movimientos_detalle'=> $this->Movimientos_model->getMovimientoDetalle($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/edit',compact('data'));
		$this->load->view('template/footer');
	}
	public function edit1($id)
	{
		$this->comprobacionRoles();
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimientoDetalle($id),
			'tipoMovimientos'=>$this->Movimientos_model->getTipoMovimiento(),
			'empleados'=>$this->Movimientos_model->getEmpleado()

		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/edit1', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 

	public function eliminar()
	{
		$this->comprobacionRoles();

		$DESDESUCURSAL   = $this->input->post("SUCURSAL");
		$HASTASUCURSAL   = $this->input->post("SUCURSAL1");
		$DESDEDEPARTAMENTO   = $this->input->post("DEPARTAMENTO");
		$HASTADEPARTAMENTO   = $this->input->post("DEPARTAMENTO1");
		$FECHADESDE   = $this->input->post("FECHADESDE");
		$FECHAHASTA   = $this->input->post("FECHAHASTA");
		$DESDEEMPRESA   = $this->input->post("EMPRESA");
		$HASTAEMPRESA   = $this->input->post("EMPRESA1");

		if ($this->validar_fecha_espanol($FECHADESDE,$FECHAHASTA)){
			//traemos datos para no duplicarlos /  validacion
			$cierreEliminar = $this->Procesocierres_model->obtenerCierre($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

			if($this->eliminarAsientodetalle($cierreEliminar))
			{

				if($this->eliminarAsiento($cierreEliminar)){

					if($this->eliminarCierre($cierreEliminar)){
						$this->session->set_flashdata('success', 'Eliminado correctamente!');
						redirect(base_url().'procesocierres/procesocierres/add', 'refresh');

					}else{
						$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
						redirect(base_url().'procesocierres/procesocierres/add', 'refresh'); 	
					}
				}
				else{
					$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
					redirect(base_url().'procesocierres/procesocierres/add', 'refresh'); 	
				}
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
			}
		}else{
			$this->session->set_flashdata('error', 'Ingrese Fecha correcta!');
			redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
		}
	}

	protected function eliminarAsientodetalle($idcierre)
	{

		try {

			for ($i=0; $i < count($idcierre); $i++) {

				$cierre = $idcierre[$i]['IDCIERRE'];

				$iddiario = $this->Procesocierres_model->obtenerIdDiario($cierre);


				$diario =$iddiario[0]['IDDIARIO'];

				$this->Procesocierres_model->eliminarAsientodetalle($diario);

			}      
			return true;

		} catch (Exception $e) {
			  //alert the user.
			return false;
		}
	}


	protected function eliminarAsiento($idcierre)
	{

		try {

			for ($i=0; $i < count($idcierre); $i++) {

				$this->Procesocierres_model->eliminarAsiento($idcierre[$i]['IDCIERRE']);

			}      
			return true;

		} catch (Exception $e) {
			  //alert the user.
			return false;
		}
	}

	protected function eliminarCierre($idcierre)
	{
		try {

			for ($i=0; $i < count($idcierre); $i++) {

				$this->Procesocierres_model->eliminarCierre($idcierre[$i]['IDCIERRE']);

			}      
			return true;

		} catch (Exception $e) {
			  //alert the user.
			return false;
		}
	}

	public function update1()
	{
		$this->comprobacionRoles();
		$IDMOVI= $this->input->post("IDMOVI");
		$IDMOVIDETALLE = $this->input->post("IDMOVIDETALLE");
		$EMPLEADO= $this->input->post("EMPLEADO");
		$DIAS= $this->input->post("DIAS");
		$HORAS= $this->input->post("HORAS"); 
		$IMPORTE= $this->input->post("IMPORTE");
		$OBSERVACION= $this->input->post("OBSERVACION");

		echo ($this->input->post("OBSERVACION"));

		$movimiento_actual = $this->Movimientos_model->getMovimiento($IDMOVI);
		$data = array(

			'IDMOVI'  =>  $IDMOVI,
			'IDEMPLEADO'     =>   $EMPLEADO,
			'DIAS'     =>  $DIAS,
			'HORAS'     =>  $HORAS,
			'IMPORTE'     =>  $IMPORTE,
			'OBSERVACION'     =>  $OBSERVACION
		);

		$this->Movimientos_model->update1DFSDF($IDMOVIDETALLE,$data);

		if($this->Movimientos_model->update1($IDMOVIDETALLE,$data))
		{
			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."movimientos/movimientos", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."movimientos/movimientos/edit1/".$IDMOVIDETALLE);
		}

		$this->edit1($IDMOVIDETALLE);
	}

	public function buscar()
	{     
		$this->comprobacionRoles();  
		$search_data = $this->input->post('nombre');

		$result = $this->Movimienros_model->get_autocomplete($search_data);

		if (!empty($result))
		{
			foreach ($result as $row){
				echo "<li><a href='#'>" . $row->alimento . "</a></li>";
			}     
		}
		else
		{
			echo "<li> <em> No se encuentra ... </em> </li>";
		} 
	}

	public function delete($id)
	{
		$this->comprobacionRoles();

		if($this->Movimientos_model->deletedetalle($id))
		{

			if($this->Movimientos_model->deleteCabecera($id)){
				$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					

				redirect(base_url()."/movimientos/movimientos", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url()."/movimientos/movimientos", "refresh");		
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."/movimientos/movimientos", "refresh");
		}


	}
	public function deleteView($id)
	{
		$this->comprobacionRoles();

		if($this->Movimientos_model->deleteDetalleView($id)){

			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					

			redirect(base_url()."movimientos/movimientos", "refresh");

		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."movimientos/movimientos", "refresh");
		}
	}
}