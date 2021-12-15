<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Nivelestudios extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Nivelestudio_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'nivelestudios'=> $this->Nivelestudio_model->getNivelestudios()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('nivelestudios/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

		$data = array(			
			'maximos' => $this->Nivelestudio_model->ObtenerCodigo(),
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('nivelestudios/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'nivelestudio'=> $this->Nivelestudio_model->getNivelestudio($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("nivelestudios/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

		//print_r($_POST); die();

		$NumNivel   = $this->input->post("NumNivel");
		$desNivel   = $this->input->post("desNivel");
		
		$idNivel = $this->Nivelestudio_model->ultimoNumero();


		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		// $empresa = $_SESSION["Empresa"];
		// $sucursal = $_SESSION["Sucursal"];
		// $idusuario = $_SESSION["idusuario"];

		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

		//corremos la validacion
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

		$data = array(
			'idnivel'  => $idNivel->MAXIMO,
			'numnivel'  => $NumNivel,
			'desnivel'  => $desNivel,
			'fecgrabacion' => $fechaActual,
			// 'idusuario' => $idusuario
		);
            //guardamos los datos en la base de datos
		$desNivel = trim($desNivel);
		if($desNivel !="" && trim($desNivel) !="")
		{
			if($this->Nivelestudio_model->save($data))
			{
				$this->session->set_flashdata('success', 'Nivel de Estudio registrado correctamente!');				
				//redireccionamos y refrescamos
				redirect(base_url()."nivelestudios/nivelestudios", "refresh");
				
			}
			else{
				$this->session->set_flashdata('error', 'Nivel de Estudio no registrado!');				
				//redireccionamos
				redirect(base_url()."nivelestudios/nivelestudios/add", "refresh");
			}
		}
		else{
			$this->session->set_flashdata('error', 'Ingrese Nivel de Estudio!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."nivelestudios/nivelestudios/add", "refresh");
		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'nivelestudio'=> $this->Nivelestudio_model->getNivelestudio($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('nivelestudios/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idNivel= $this->input->post("idNivel");
		$NumNivel= $this->input->post("NumNivel");
		$desNivel= $this->input->post("desNivel");
		
		$desNivel = trim($desNivel);
		if($desNivel !="" && trim($desNivel) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desNivel' => $desNivel
			);
			if($this->Nivelestudio_model->update($idNivel,$data)){
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."nivelestudios/nivelestudios", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."nivelestudios/nivelestudios/edit/".$idNivel,"refresh");
			}
		}
		else{	
			$this->session->set_flashdata('error', 'Ingrese Nivel de Estudio!');
			redirect(base_url()."nivelestudios/nivelestudios/edit/".$idNivel,"refresh");
		}

	}

	public function delete($id){	
		if($this->Nivelestudio_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."nivelestudios/nivelestudios", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."nivelestudios/nivelestudios", "refresh");		
		}

		
	}

}