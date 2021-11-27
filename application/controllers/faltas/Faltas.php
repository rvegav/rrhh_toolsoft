<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faltas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Horario_model', 'Empleados_model', 'Marcacion_model', 'Faltas_model'));
	}
	public function index(){	
		// if ($this->session->userdata('login')) {
		$data = array(
			'tiposFaltas'=> $this->Faltas_model->getTipoFaltas()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/list', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		// if ($this->session->userdata('sist_conex')=="A") {
		$data = array(			
			'maximo' => $this->Faltas_model->ObtenerCodigo()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/add', $data);
		$this->load->view('template/footer');
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}
	//funcion vista
	public function viewDetalle($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {
		$data = array (
			'ciudad'=> $this->Faltas_model->getCiudad($id)
		);
		$this->load->view("faltas/view", $data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	//funcion para almacenar en la bd
	public function store()
	{
		// if ($this->session->userdata('sist_conex')=="A") {

		$this->form_validation->set_rules("descHorario", "Descripcion", "required");
		$this->form_validation->set_rules("entrada_am", "Hora Entrada AM", "required");
		$this->form_validation->set_rules("salida_am", "Hora Salida AM", "required");
		$this->form_validation->set_rules("entrada_pm", "Hora Entrada PM", "required");
		$this->form_validation->set_rules("salida_pm", "Hora Salida PM", "required");
		$this->form_validation->set_rules("detalleHorario", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."faltas/Faltas", "refresh");

		}else{
			$horaId   = $this->input->post("numHora");
			$descHorario = $this->input->post("descHorario");
			$entrada_am = $this->input->post('entrada_am', TRUE);
			$entrada_pm = $this->input->post('entrada_pm', TRUE);
			$salida_am = $this->input->post('salida_am', TRUE);
			$salida_pm = $this->input->post('salida_pm', TRUE);
			$detalles = $this->input->post('detalle', TRUE);
			$data = array(
				'idhorario'  => $horaId,
				'deschorario'  => trim($descHorario),
				'entrada_am' => $entrada_am,
				'entrada_pm' => $entrada_pm,
				'salida_pm' => $salida_pm,
				'salida_am' => $salida_am

			);

			if($this->Faltas_model->save($data)){
				$this->session->set_flashdata('success', 'Horario registrado correctamente!');
				foreach ($detalles as $detalle ) {
					$data = array(
						'idhorario'=> $horaId, 
						'dianro'=> $detalle['nro'],
						'descdia'=> $detalle['desc']
					);
					if ($this->Faltas_model->saveDetalle($data)) {
						redirect(base_url()."faltas/Faltas", "refresh");
					}else{
						$this->session->set_flashdata('error', 'Detalle no registrado!');
						redirect(base_url()."faltas/Faltas/add", "refresh");
					}
				}
			}
			else{
				$this->session->set_flashdata('error', 'Horario no registrado!');
				redirect(base_url()."faltas/Faltas/add", "refresh");
			}
		}
	}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	public function edit($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {

		$data = array(
			'horario'=> $this->Faltas_model->getHorario($id),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('horario/edit', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}

	//actualizamos 

	public function update(){
		// if ($this->session->userdata('sist_conex')=="A") {

		$this->form_validation->set_rules("descHorario", "Descripcion", "required");
		$this->form_validation->set_rules("entrada_am", "Hora Entrada AM", "required");
		$this->form_validation->set_rules("salida_am", "Hora Salida AM", "required");
		$this->form_validation->set_rules("entrada_pm", "Hora Entrada PM", "required");
		$this->form_validation->set_rules("salida_pm", "Hora Salida PM", "required");
		$this->form_validation->set_rules("detalleHorario", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."faltas/Faltas", "refresh");

		}else{
			$horaId   = $this->input->post("numHora");
			$descHorario = $this->input->post("descHorario");
			$entrada_am = $this->input->post('entrada_am', TRUE);
			$entrada_pm = $this->input->post('entrada_pm', TRUE);
			$salida_am = $this->input->post('salida_am', TRUE);
			$salida_pm = $this->input->post('salida_pm', TRUE);
			$detalle = $this->input->post('detalle', TRUE);
			$data = array(
				'idhorario'  => $horaId,
				'deschorario'  => trim($descHorario),
				'entrada_am' => $entrada_am,
				'entrada_pm' => $entrada_pm,
				'salida_pm' => $salida_pm,
				'salida_am' => $salida_am

			);
			if($this->Faltas_model->update($horaId,$data)){
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."faltas/Faltas", "refresh");
				$data = array(
					'idhorario' => $horaId, 
					'dianro'=> $detalle['nro'],
					'descdia' => $detalle['desc']
				);
				if ($this->Faltas_model->updateDetalle($data)) {
					redirect(base_url()."faltas/Faltas", "refresh");
				}else{
					$this->session->set_flashdata('error', 'Detalle no registrado!');
					redirect(base_url()."faltas/Faltas/add", "refresh");
				}
			}
			else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."faltas/Faltas/edit/".$horaId,"refresh");
			}
		}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


	public function delete($id){
		// if ($this->session->userdata('sist_conex')=="A") {
		if($this->Faltas_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."faltas/Faltas/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."faltas/Faltas/","refresh");
		}

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}

	public function viewGenerarFaltas(){
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/generarFaltas');
		$this->load->view('template/footer');
	}
	public function generacionFaltas(){

		$this->form_validation->set_rules("desde", "Desde", "required");
		$this->form_validation->set_rules("hasta", "Hasta", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."horario/Horario", "refresh");

		}else{
			$fecha_desde = $this->input->post('desde', TRUE);
			$fecha_hasta = $this->input->post('hasta', TRUE);
			$empleados = $this->Empleados_model->getEmpleados();
			foreach ($empleados as $empleado) {
				$fecha_desde_aux = $fecha_desde;
				while ($fecha_desde_aux<= $fecha_hasta) {
					$dia_numero = $this->Horario_model->getNroDía($fecha_desde_aux);
					$horario = $this->Horario_model->getHorarioEmpleado($empleado->IDEMPLEADO, $dia_numero->NRODIA);
					if ($horario) {
						$marcacion  = $this->Marcacion_model->getMarcacionEmpleados($empleado->IDEMPLEADO, $fecha_desde_aux);
						if ($marcacion) {
							$entrada_am = explode(' ', $marcacion->ENTRADAAM);
							$salida_am = explode(' ', $marcacion->SALIDAAM);
							$entrada_pm = explode(' ', $marcacion->ENTRADAPM);
							$salida_pm = explode(' ', $marcacion->SALIDAPM);
							if (strtotime($entrada_am[1])>strtotime($horario->ENTRADAAM)) {
								$tipoFalta = $this->Faltas_model->getTipoFaltas(false, 'LLEGADA TARDIA');
							}
							if (strtotime($salida_pm[1])<strtotime($horario->SALIDAPM)) {
								$tipoFalta = $this->Faltas_model->getTipoFaltas(false, 'SALIDA TEMPRANA');
							}

							
						}else{
							$tipoFalta = $this->Faltas_model->getTipoFaltas(false, 'AUSENCIA');
						}
						$data['IDEMPLEADO'] = $empleado->IDEMPLEADO;
						$data['IDFALTA'] = $tipoFalta->idfaltas;
						$data['FECHAFALTA'] = $fecha_desde_aux;
						if ($this->Faltas_model->insertFaltaEmpleado($data)) {
							$resultado = 'se inserto correctamente';
						}else{
							$resultado = 'error al insertar';
						}
					}
					$fecha_desde_aux= date("Y-m-d",strtotime($fecha_desde_aux."+ 1 days"));

				}
				
			}
			return true;
		}
	}
	
	public function consultarFaltas(){
		$fecha_desde = $this->input->post('desde', TRUE);
		$fecha_hasta = $this->input->post('hasta', TRUE);
		$empleados = $this->Empleados_model->getEmpleados();
		$item= 0;
		$datos = array();
		foreach ($empleados as $empleado) {
			$fecha_desde_aux = $fecha_desde;
			if ($fecha_desde && $fecha_hasta) {
				$fecha_incorporacion = $empleado->FECHAINGRESO;
				if ($fecha_incorporacion>$fecha_desde_aux) {
					$fecha_desde_aux = $fecha_incorporacion;
				}
				$array = array();
				while ($fecha_desde_aux<= $fecha_hasta) {
					$tipoFalta='';
					$dia_numero = $this->Horario_model->getNroDía($fecha_desde_aux);
					$horario = $this->Horario_model->getHorarioEmpleado($empleado->IDEMPLEADO, $dia_numero->NRODIA);
					if ($horario) {
						$marcacion  = $this->Marcacion_model->getMarcacionEmpleados($empleado->IDEMPLEADO, $fecha_desde_aux);
						if ($marcacion) {
							$entrada_am = explode(' ', $marcacion->ENTRADAAM);
							$salida_am = explode(' ', $marcacion->SALIDAAM);
							$entrada_pm = explode(' ', $marcacion->ENTRADAPM);
							$salida_pm = explode(' ', $marcacion->SALIDAPM);
							if (strtotime($entrada_am[1])>strtotime($horario->ENTRADAAM)) {
								$tipoFalta = $tipoFalta.' LLEGADA TARDIA';
								$resultado = 'error al insertar';
								$item ++;
							}
							if (strtotime($salida_pm[1])<strtotime($horario->SALIDAPM)) {
								$tipoFalta = 'SALIDA TEMPRANA';
								$item ++;
							}

						}else{
							$tipoFalta = 'AUSENCIA';
							$item ++;
						}
						if ($tipoFalta !='') {
							$array['NRO']=$item;
							$array['EMPLEADO']=$empleado->NOMBRE;
							$array['TIPO_FALTA']=$tipoFalta;
							$f= date_create($fecha_desde_aux);
							$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
							$array['PERMISOS']='';
							$array['FECHA_PRESENTACION']='';
							$datos[] = $array;
						}

					}
					$fecha_desde_aux= date("Y-m-d",strtotime($fecha_desde_aux."+ 1 days"));
				}

				$data['data'] = $datos;
			}else{
				$data['data']= [];
			}
		}
		echo json_encode($data);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */