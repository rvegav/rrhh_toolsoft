<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Categorias extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Usuarios_model', 'Categoria_model'));
		
	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	//esta funcion es la primera que se cargar
	public function index()
	{
	$this->comprobacionRoles();	
		$data = array(
			'categorias'=> $this->Categoria_model->getCategorias()
		);

			//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('categorias/list', $data);
		$this->load->view('template/footer');
		//cargamos un array usando el modelo
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();
		$data = array(			
			'maximos' => $this->Categoria_model->ObtenerCodigo(),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('categorias/add', $data);
		$this->load->view('template/footer');
		

	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'categoria'=> $this->Categoria_model->getCategoria($id)
		);

			//print_r($data); die();
			//abrimos la vista view
		$this->load->view("categorias/view", $data);
		
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		
		//recibimos las variables
		$NumCategoria  = $this->input->post("NumCategoria");
		$desCategoria  = $this->input->post("desCategoria");
		$montoAsignado = $this->input->post("montoAsignado");

		$idCategoria = $this->Categoria_model->ultimoNumero();


		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$usuario = $_SESSION["usuario"];


		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

		$data = array(
			'idcategoria'  => $idCategoria->MAXIMO,
			'numcategoria'  => $NumCategoria,
			'descategoria'  => $desCategoria,
			'montoasignado'  => $montoAsignado,
			'fecgrabacion' => $fechaActual,
			'idempresa'  => $empresa
		);

//print_r($data); die();
            //guardamos los datos en la base de datos
		$desCategoria = trim($desCategoria);
		if($desCategoria !="" && trim($desCategoria) !="")
		{
			if($this->Categoria_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Categoria registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";

				//redireccionamos y refrescamos
				redirect(base_url()."categorias/categorias", "refresh");

			}
			else
			{
					//si hubo errores, mostramos mensaje

				$this->session->set_flashdata('error', 'Categoria no registrado!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
				redirect(base_url()."categorias/categorias/add", "refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Categoria!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."categorias/categorias/add", "refresh");



		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
			//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'categoria'=> $this->Categoria_model->getCategoria($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('categorias/edit', $data);
		$this->load->view('template/footer');
		
	}

	//actualizamos 
	
	public function update()
	{
		$this->comprobacionRoles();
		
		$idCategoria= $this->input->post("idcategoria");
		$NumCategoria= $this->input->post("NumCargo");
		$desCategoria= $this->input->post("desCategoria");
		$montoAsignado = $this->input->post("montoAsignado");

		$desCategoria = trim($desCategoria);
		if($desCategoria !="" && trim($desCategoria) !="")
		{
				//indicar campos de la tabla a modificar
			$data = array(
				'desCategoria' => $desCategoria,
				'montoasignado' => $montoAsignado
			);


			if($this->Categoria_model->update($idCategoria,$data))
			{
					//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."categorias/categorias", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."categorias/categorias/edit/".$idCategoria,"refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Categoria!');
					//redirect(base_url()."servicios", "refresh");

					//redireccionamos
			redirect(base_url()."categorias/categorias/edit/".$idCategoria,"refresh");



		}

	}

	public function delete($id){
		$this->comprobacionRoles();

		if($this->Categoria_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."categorias/categorias", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."categorias/categorias", "refresh");		
		}


		
	}

}