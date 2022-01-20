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
	
	//esta funcion es la primera que se cargar
	public function index()
	{	
		
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
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '1';
		$data['delete'] = '';
		$data['select'] = '';
		$data['update'] = '';
		$this->comprobacionRoles($data);
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
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '';
		$data['delete'] = '';
		$data['select'] = '1';
		$data['update'] = '';
		$this->comprobacionRoles($data);
		$data = array (
			'ciudad'=> $this->Ciudad_model->getCiudad($id)
		);
		$this->load->view("ciudades/view", $data);
		
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '1';
		$data['delete'] = '';
		$data['select'] = '';
		$data['update'] = '';
		$this->comprobacionRoles($data);

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
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '';
		$data['delete'] = '';
		$data['select'] = '1';
		$data['update'] = '';
		$this->comprobacionRoles($data);
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
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '';
		$data['delete'] = '';
		$data['select'] = '';
		$data['update'] = '1';
		$this->comprobacionRoles($data);
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
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '2';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '';
		$data['delete'] = '1';
		$data['select'] = '';
		$data['update'] = '';
		$this->comprobacionRoles($data);
		if($this->Ciudad_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."ciudades/Ciudades/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."ciudades/Ciudades/","refresh");
		}
		

	}


}