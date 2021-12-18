<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Departamentoempresas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Usuarios_model', 'Departamentoempresa_model'));
		
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
		//cargamos un array usando el modelo
		$data = array(
			'departamentoempresas'=> $this->Departamentoempresa_model->getDepartamentoempresas()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentoempresas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();

		$data = array(			
			'maximos' => $this->Departamentoempresa_model->ObtenerCodigo(),
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentoempresas/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'departamentoempresa'=> $this->Departamentoempresa_model->getDepartamentoempresa($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("departamentoempresas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		//recibimos las variables
		$this->form_validation->set_rules("desDepartamento", "Descripcion", "required");
		$this->form_validation->set_rules("NumDepartamento", "Numero", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."departamentoempresas/departamentoempresas", "refresh");

		}else{
			$NumDepartamento  = $this->input->post("NumDepartamento");
			$desDepartamento  = $this->input->post("desDepartamento");
			$idDepartamento = $this->Departamentoempresa_model->ultimoNumero();
			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);
			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];		
			$data = array(
				'idDepartemento'  => $idDepartamento->MAXIMO,
				'NumDepartamento'  => $NumDepartamento,
				'descDepartamento'  => $desDepartamento,
				'fecgrabacion' => $fechaActual,
				'idempresa'  => $empresa
			);
			
            //guardamos los datos en la base de datos
			if($this->Departamentoempresa_model->save($data)){
					//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Departamento registrado correctamente!');
					//redireccionamos y refrescamos
				redirect(base_url()."departamentoempresas/departamentoempresas", "refresh");
			}else{
						//si hubo errores, mostramos mensaje
				$this->session->set_flashdata('error', 'Departamento no registrado!');
				redirect(base_url()."departamentoempresas/departamentoempresas/add", "refresh");
			}		
		}

	}
	
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'departamentoempresa'=> $this->Departamentoempresa_model->getDepartamentoempresa($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentoempresas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$this->comprobacionRoles();
		$idDepartamento= $this->input->post("idDepartamento");
		$NumDepartamento= $this->input->post("NumDepartamento");
		$desDepartamento= $this->input->post("desDepartamento");
		
		$desDepartamento = trim($desDepartamento);
		if($desDepartamento !="" && trim($desDepartamento) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'descDepartamento' => $desDepartamento
			);
			if($this->Departamentoempresa_model->update($idDepartamento,$data)){
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."departamentoempresas/departamentoempresas", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."departamentoempresas/departamentoempresas/edit/".$idDepartamento,"refresh");
			}
		}else{
			$this->session->set_flashdata('error', 'Ingrese Departamento!');
				//redireccionamos
			redirect(base_url()."departamentoempresas/departamentoempresas/edit/".$idDepartamento,"refresh");
		}

	}

	public function delete($id){
		$this->comprobacionRoles();
		if($this->Departamentoempresa_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."departamentoempresas/departamentoempresas", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."departamentoempresas/departamentoempresas", "refresh");		
		}
	}

}