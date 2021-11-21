<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Ciudades extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Ciudad_model");
		$this->load->model("Departamento_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		// if ($this->session->userdata('login')) {
			$data = array(
				'ciudades'=> $this->Ciudad_model->getCiudades()
			);
			//llamamos a las vistas para mostrar
			$this->load->view('template/head');
			$this->load->view('template/menu_copia');
			$this->load->view('ciudades/list', $data);
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
				'maximos' => $this->Ciudad_model->ObtenerCodigo(),
				'departamentos' => $this->Departamento_model->getDepartamentos()
			);

			$this->load->view('template/head');
			$this->load->view('template/menu');
			$this->load->view('ciudades/add', $data);
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
				'ciudad'=> $this->Ciudad_model->getCiudad($id)
			);

			//print_r($data); die();
			//abrimos la vista view
			$this->load->view("ciudades/view", $data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	//funcion para almacenar en la bd
	public function store()
	{
		// if ($this->session->userdata('sist_conex')=="A") {

			$NumCiudad   = $this->input->post("NumCiudad");
			$desCiudad   = $this->input->post("desCiudad");
			$idDepartamento   = $this->input->post("IdDepartamento");

			$idciudad = $this->Ciudad_model->ultimoNumero();

			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);

			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];
		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
			$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");
			$data = array(
				'idciudad'  => $idciudad->MAXIMO,
				'NumCiudad'  => $NumCiudad,
				'desCiudad'  => $desCiudad,
				'fecgrabacion' => $fechaActual,
				'idempresa'  => $empresa,
				'iddepartamento' => $idDepartamento
			);
            //guardamos los datos en la base de datos
			$desCiudad = trim($desCiudad);
			if($desCiudad !="" && trim($desCiudad) !="")
			{
				if($this->Ciudad_model->save($data))
				{
				//si todo esta bien, emitimos mensaje
					$this->session->set_flashdata('success', 'Ciudad registrado correctamente!');
					redirect(base_url()."ciudades/ciudades", "refresh");
				}
				else
				{
					//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Ciudad no registrado!');
					redirect(base_url()."ciudades/ciudades/add", "refresh");
				}
			}
			else
			{	
				$this->session->set_flashdata('error', 'Ingrese Ciudad!');
				//redireccionamos
				redirect(base_url()."ciudades/ciudades/add", "refresh");
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
				'ciudad'=> $this->Ciudad_model->getCiudad($id),
				'departamentos' => $this->Departamento_model->getDepartamentos()
			);
			$this->load->view('template/head');
			$this->load->view('template/menu');
			$this->load->view('ciudades/edit', $data);
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


				if($this->Ciudad_model->update($idCiudad,$data))
				{
					//print_r($idCiudad); die();
					$this->session->set_flashdata('success', 'Actualizado correctamente!');
					redirect(base_url()."ciudades/ciudades", "refresh");
				}
				else
				{
					$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
					redirect(base_url()."ciudades/ciudades/edit/".$idCiudad,"refresh");
				}
			}
			else
			{	

				$this->session->set_flashdata('error', 'Ingrese Ciudad!');
					//redireccionamos
				redirect(base_url()."ciudades/ciudades/edit/".$idCiudad,"refresh");
			}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


	public function delete($id)
	{
		// if ($this->session->userdata('sist_conex')=="A") {
			if($this->Ciudad_model->delete($id)){
				$this->session->set_flashdata('success', 'Eliminado correctamente!');
				redirect(base_url()."ciudades/Ciudades/", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."ciudades/Ciudades/","refresh");
			}
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}


}