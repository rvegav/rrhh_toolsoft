<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class Horario extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Horario_model");
		$this->load->model("Usuarios_model");
		
		// if (!$this->session->userdata("login")){
		// 	redirect(base_url());
		// }
	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	public function index(){	
		// if ($this->session->userdata('login')) {
		$data = array(
			'horarios'=> $this->Horario_model->getHorarios()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('horario/list', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();
		$data = array(			
			'maximo' => $this->Horario_model->ObtenerCodigo()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('horario/add', $data);
		$this->load->view('template/footer');
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}
	//funcion vista
	public function viewDetalle()
	{
		$this->comprobacionRoles();
		$id = $this->input->post('id', TRUE);
		$data =$this->Horario_model->getDetalleHorario($id);
		echo json_encode($data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();

		$this->form_validation->set_rules("descHorario", "Descripcion", "required");
		$this->form_validation->set_rules("entrada_am", "Hora Entrada AM", "required");
		$this->form_validation->set_rules("salida_am", "Hora Salida AM", "required");
		$this->form_validation->set_rules("entrada_pm", "Hora Entrada PM", "required");
		$this->form_validation->set_rules("salida_pm", "Hora Salida PM", "required");
		$this->form_validation->set_rules("detalleHorario", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."horario/Horario", "refresh");

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

			if($this->Horario_model->save($data)){
				$this->session->set_flashdata('success', 'Horario registrado correctamente!');
				foreach ($detalles as $detalle ) {
					$data = array(
						'idhorario'=> $horaId, 
						'dianro'=> $detalle['nro'],
						'descdia'=> $detalle['desc']
					);
					if ($this->Horario_model->saveDetalle($data)) {
						redirect(base_url()."horario/Horario", "refresh");
					}else{
						$this->session->set_flashdata('error', 'Detalle no registrado!');
						redirect(base_url()."horario/Horario/add", "refresh");
					}
				}
			}
			else{
				$this->session->set_flashdata('error', 'Horario no registrado!');
				redirect(base_url()."horario/Horario/add", "refresh");
			}
		}
	}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	public function edit($id)
	{
		$this->comprobacionRoles();

		$data = array(
			'horario'=> $this->Horario_model->getHorario($id),
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
		$this->comprobacionRoles();

		$this->form_validation->set_rules("descHorario", "Descripcion", "required");
		$this->form_validation->set_rules("entrada_am", "Hora Entrada AM", "required");
		$this->form_validation->set_rules("salida_am", "Hora Salida AM", "required");
		$this->form_validation->set_rules("entrada_pm", "Hora Entrada PM", "required");
		$this->form_validation->set_rules("salida_pm", "Hora Salida PM", "required");
		$this->form_validation->set_rules("detalleHorario", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."horario/Horario", "refresh");

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
			if($this->Horario_model->update($horaId,$data)){
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."horario/Horario", "refresh");
				$data = array(
					'idhorario'=> $horaId, 
					'dianro'=> $detalle['nro'],
					'descdia'=> $detalle['desc']
				);
				if ($this->Horario_model->updateDetalle($data)) {
					redirect(base_url()."horario/Horario", "refresh");
				}else{
					$this->session->set_flashdata('error', 'Detalle no registrado!');
					redirect(base_url()."horario/Horario/add", "refresh");
				}
			}
			else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."horario/Horario/edit/".$horaId,"refresh");
			}
		}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


	public function delete($id){
		$this->comprobacionRoles();
		if($this->Horario_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."horario/Horario/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."horario/Horario/","refresh");
		}

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


}

/* End of file  */
/* Location: ./application/controllers/ */