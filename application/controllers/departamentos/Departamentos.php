<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Departamentos extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}
		$this->load->model(array('Usuarios_model', 'Pais_model', 'Departamento_model'));

	}
	public function index()
	{	
		
		//cargamos un array usando el modelo
		$data = array(
			'departamentos'=> $this->Departamento_model->getDepartamentos()			
		);

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentos/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

		$data = array(			
			'maximos' => $this->Departamento_model->ObtenerCodigo(),
			'paises' => $this->Pais_model->GetPaises()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentos/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data['idmodulo'] = '1';
		$data['idpantalla'] = '3';
		$data['usuario'] = $this->session->userdata("DESUSUARIO");
		$data['insert'] = '';
		$data['delete'] = '';
		$data['select'] = '1';
		$data['update'] = '';
		$this->comprobacionRoles($data);
		$this->comprobacionRoles();
		$data = array (
			'departamento'=> $this->Departamento_model->getDepartamento($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("departamentos/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		
		//recibimos las variables

		//print_r($_POST); die();

		$NumDepartamento  = $this->input->post("NumDepartamento");
		$desDepartamento  = $this->input->post("desDepartamento");
		$idPais = $this->input->post("IdPais");
		
		$idDepartamento = $this->Departamento_model->ultimoNumero();


		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$usuario = $_SESSION["usuario"];

		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

		//corremos la validacion
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

		$data = array(
			'idDepartamento'  => $idDepartamento->MAXIMO,
			'NumDepartamento'  => $NumDepartamento,
			'desDepartamento'  => $desDepartamento,
			'fecgrabacion' => $fechaActual,
			'idusuario'  => $usuario,
			'idpais' => $idPais
		);

//print_r($data); die();
            //guardamos los datos en la base de datos
		$desDepartamento = trim($desDepartamento);
		if($desDepartamento !="" && trim($desDepartamento) !="")
		{
			if($this->Departamento_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Departamento registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."departamentos/departamentos", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje

				$this->session->set_flashdata('error', 'Departamento no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."departamentos/departamentos/add", "refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Departamento!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."departamentos/departamentos/add", "refresh");



		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'departamento'=> $this->Departamento_model->getDepartamento($id),
			'paises' => $this->Pais_model->GetPaises()
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('departamentos/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		
		$idDepartamento= $this->input->post("idDepartamento");
		$NumDepartamento= $this->input->post("NumDepartamento");
		$desDepartamento= $this->input->post("desDepartamento");
		$idPais = $this->input->post("IdPais");
		
		$desDepartamento = trim($desDepartamento);
		if($desDepartamento !="" && trim($desDepartamento) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desDepartamento' => $desDepartamento,
				'idpais' => $idPais
			);


			if($this->Departamento_model->update($idDepartamento,$data))
			{
				//print_r($idDepartamento); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."departamentos/departamentos", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."departamentos/departamentos/edit/".$idDepartamento,"refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Departamento!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."departamentos/departamentos/edit/".$idDepartamento,"refresh");



		}

	}

	public function delete($id)
	{
		
   	//print_r($id); die();
		
		if($this->Departamento_model->delete($id)){

			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."departamentos/departamentos", "refresh");

		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."departamentos/departamentos", "refresh");		

		}

		
	}

}