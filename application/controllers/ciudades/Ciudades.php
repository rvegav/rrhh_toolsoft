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
		$this->data = array('correcto'=>'','alerta'=>'','error'=>'', 'datos'=>'');
		$this->load->model(array('Usuarios_model', 'Ciudad_model', 'Departamento_model'));

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$moduloid = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $moduloid)) {
			redirect(base_url());
		}
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		$this->comprobacionRoles();
		$data = array(
			'ciudades'=> $this->Ciudad_model->getCiudades()
		);
			//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('ciudades/list', $data);
		$this->load->view('template/footer');

	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();
		$data = array(			
			'maximos' => $this->Ciudad_model->ObtenerCodigo(),
			'departamentos' => $this->Departamento_model->getDepartamentos()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('ciudades/add', $data);
		$this->load->view('template/footer');
		

	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'ciudad'=> $this->Ciudad_model->getCiudad($id)
		);
		$this->load->view("ciudades/view", $data);
		
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();

		$mensajes= $this->data;
		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");
		$this->form_validation->set_rules("IdDepartamento", "Departamento", "required");
		$this->form_validation->set_rules("desCiudad", "Descripcion", "required");
		if ($this->form_validation->run() == FALSE){
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 

		}else{
			$NumCiudad   = $this->input->post("NumCiudad");
			$desCiudad   = $this->input->post("desCiudad");
			$idDepartamento   = $this->input->post("IdDepartamento");
			$idciudad = $this->Ciudad_model->ultimoNumero();
			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);
			$data = array(
				'idciudad'  => $idciudad->MAXIMO,
				'NumCiudad'  => $NumCiudad,
				'desCiudad'  => $desCiudad,
				'fecgrabacion' => $fechaActual,
				'idempresa'  => $empresa,
				'iddepartamento' => $idDepartamento
			);
			$desCiudad = trim($desCiudad);
			if($this->Ciudad_model->save($data)){
				$mensajes['correcto'] = 'correcto';
				$this->session->set_flashdata('success', 'Ciudad registrado correctamente!');
					// redirect(base_url()."ciudades/ciudades", "refresh");
			}else{
				$mensajes['error'] = 'Ciudad no registrado!';
				$this->session->set_flashdata('error', 'Ciudad no registrado!');
					// redirect(base_url()."ciudades/ciudades/add", "refresh");
			}
		}
		echo json_encode($mensajes);
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
			//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'ciudad'=> $this->Ciudad_model->getCiudad($id),
			'departamentos' => $this->Departamento_model->getDepartamentos()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('ciudades/edit', $data);
		$this->load->view('template/footer');
		
	}

	//actualizamos 
	
	public function update()
	{
		$this->comprobacionRoles();
		$mensajes = $this->data;
		$idCiudad= $this->input->post("idciudad");
		$NumCiudad= $this->input->post("NumCiudad");
		$desCiudad= $this->input->post("desCiudad");
		$idDepartamento= $this->input->post("IdDepartamento");
		$this->form_validation->set_rules("IdDepartamento", "Departamento", "required");
		$this->form_validation->set_rules("desCiudad", "Descripcion", "required");
		$desCiudad = trim($desCiudad);
		if ($this->form_validation->run() == FALSE){
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 

		}else{
			if($desCiudad !="" && trim($desCiudad) !="")
			{
					//indicar campos de la tabla a modificar
				$data = array(
					'desCiudad' => $desCiudad,
					'iddepartamento' => $idDepartamento
				);


				if($this->Ciudad_model->update($idCiudad,$data)){
					$mensajes['correcto'] = 'correcto';
					$this->session->set_flashdata('success', 'Actualizado correctamente!');
				}else{
					$mensajes['error'] = 'Errores al intentar Actualizar!';
					$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
					// redirect(base_url()."ciudades/ciudades/edit/".$idCiudad,"refresh");
				}
			}else{	

				$this->session->set_flashdata('error', 'Ingrese Ciudad!');

				redirect(base_url()."ciudades/ciudades/edit/".$idCiudad,"refresh");
			}
		}
		echo json_encode($mensajes);

	}


	public function delete($id)
	{
		$this->comprobacionRoles();
		if($this->Ciudad_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."ciudades/Ciudades/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."ciudades/Ciudades/","refresh");
		}
		

	}


}