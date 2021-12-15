<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Incidencias extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}	
		$this->load->model("Incidencia_model");
		$this->load->model("Departamento_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		// if ($this->session->userdata('login')) {
		$data = array(
			'incidencias'=> $this->Incidencia_model->getTipoIncidencias()
		);
			//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipoincidencias/list', $data);
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
			'maximo' => $this->Incidencia_model->obtenerUltimoNro()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipoincidencias/add', $data);
		$this->load->view('template/footer');
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}
	//funcion vista
	public function view($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {
		$data = array (
			'ciudad'=> $this->Incidencia_model->getCiudad($id)
		);
		$this->load->view("tipoincidencias/view", $data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	public function store()
	{
		// if ($this->session->userdata('sist_conex')=="A") {

		$NumIncidencia   = $this->input->post("numIncidencia");
		$descripcion = $this->input->post("descTipoIncidencia");

		$idTipoIncidencia = $this->Incidencia_model->ObtenerCodigo();

		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$this->form_validation->set_rules("numIncidencia", "Nro de Incidencia", "required");
		$this->form_validation->set_rules("descTipoIncidencia", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url()."tipoincidencias/Incidencias/add", "refresh");
		}else{

			$data = array(
				'IDTIPOINCIDENCIA'  => $idTipoIncidencia->MAXIMO,
				'NUMINCIDENCIA'  => $NumIncidencia,
				'DESCINCIDENCIA'  => $descripcion,
				'FECGRABACION' => $fechaActual
			);
			if($this->Incidencia_model->save($data))
			{
				$this->session->set_flashdata('success', 'Tipo de Incidencia registrado correctamente!');
				redirect(base_url()."tipo_incidencia", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Tipo de Incidencia no registrado!');
				redirect(base_url()."tipoincidencias/Incidencia/add", "refresh");
			}
		}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }


	}

	//metodo para editar
	public function edit($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {
			//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'incidencia'=> $this->Incidencia_model->getTipoIncidencias($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipoincidencias/edit', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}

	//actualizamos 

	public function update()
	{
		// if ($this->session->userdata('sist_conex')=="A") {

		$idTipoIncidencia = $this->input->post('tipoincidenciasId');
		$NumIncidencia   = $this->input->post("numIncidencia");
		$descripcion = $this->input->post("descTipoIncidencia");
		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);
		$this->form_validation->set_rules("numIncidencia", "Nro de Incidencia", "required");
		$this->form_validation->set_rules("descTipoIncidencia", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url()."tipoincidencias/Incidencias/add", "refresh");
		}else{

			$data = array(
				'NUMINCIDENCIA'  => $NumIncidencia,
				'DESCINCIDENCIA'  => $descripcion,
				'FECGRABACION' => $fechaActual
			);
			if($this->Incidencia_model->update($data, $idTipoIncidencia))
			{
					//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."tipo_incidencia", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."tipoincidencias/Incidencias/edit/".$idCiudad,"refresh");
			}
		}

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


	public function delete($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {
		if($this->Incidencia_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."tipoincidencias/Incidencias/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."tipoincidencias/Incidencias/","refresh");
		}

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


}