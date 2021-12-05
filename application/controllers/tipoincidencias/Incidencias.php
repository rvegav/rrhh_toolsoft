<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ciudades extends CI_Controller
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
				'incidencias'=> $this->Incidencia_model->getIncidencias()
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
				'maximos' => $this->Incidencia_model->ObtenerCodigo()
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

			//print_r($data); die();
			//abrimos la vista view
			$this->load->view("tipoincidencias/view", $data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	//funcion para almacenar en la bd
	public function store()
	{
		// if ($this->session->userdata('sist_conex')=="A") {

			$NumIncidencia   = $this->input->post("numero");
			$descripcion = $this->input->post("descripcion");

			$idTipoIncidencia = $this->Incidencia_model->ultimoNumero();

			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);

			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];
		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
			$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");
			$data = array(
				'IDTIPOINCIDENCIA'  => $idciudad->MAXIMO,
				'NumCiudad'  => $NumCiudad,
				'desCiudad'  => $desCiudad,
				'fecgrabacion' => $fechaActual
			);
            //guardamos los datos en la base de datos
			$desCiudad = trim($desCiudad);
			if($desCiudad !="" && trim($desCiudad) !="")
			{
				if($this->Incidencia_model->save($data))
				{
				//si todo esta bien, emitimos mensaje
					$this->session->set_flashdata('success', 'Ciudad registrado correctamente!');
					redirect(base_url()."tipoincidencias/tipoincidencias", "refresh");
				}
				else
				{
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Ciudad no registrado!');
					redirect(base_url()."tipoincidencias/tipoincidencias/add", "refresh");
				}
			}
			else
			{	
				$this->session->set_flashdata('error', 'Ingrese Ciudad!');
				//redireccionamos
				redirect(base_url()."tipoincidencias/tipoincidencias/add", "refresh");
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
				'ciudad'=> $this->Incidencia_model->getCiudad($id),
				'departamentos' => $this->Departamento_model->getDepartamentos()
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
		
			$idCiudad= $this->input->post("idciudad");
			$NumCiudad= $this->input->post("NumCiudad");
			$desCiudad= $this->input->post("desCiudad");
			$idDepartamento= $this->input->post("IdDepartamento");
			
			$desCiudad = trim($desCiudad);
			if($desCiudad !="" && trim($desCiudad) !="")
			{
				//indicar campos de la tabla a modificar
				$data = array(
					'desCiudad' => $desCiudad,
					'iddepartamento' => $idDepartamento
				);


				if($this->Incidencia_model->update($idCiudad,$data))
				{
					//print_r($idCiudad); die();
					$this->session->set_flashdata('success', 'Actualizado correctamente!');
					redirect(base_url()."tipoincidencias/tipoincidencias", "refresh");
				}
				else
				{
					$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
					redirect(base_url()."tipoincidencias/tipoincidencias/edit/".$idCiudad,"refresh");
				}
			}
			else
			{	

				$this->session->set_flashdata('error', 'Ingrese Ciudad!');
					//redireccionamos
				redirect(base_url()."tipoincidencias/tipoincidencias/edit/".$idCiudad,"refresh");
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
				redirect(base_url()."tipoincidencias/tipoincidencias/", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."tipoincidencias/tipoincidencias/","refresh");
			}
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


}