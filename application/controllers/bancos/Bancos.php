<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Bancos extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model(array('Usuarios_model', 'Banco_model'));
		
	}

	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idpantalla = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idpantalla)) {
			redirect(base_url());
		}
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		$this->comprobacionRoles();
		$data = array(
			'bancos'=> $this->Banco_model->getBancos()
		);
		//cargamos un array usando el modelo
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('bancos/list', $data);
		$this->load->view('template/footer');

		//llamamos a las vistas para mostrar
	}
	
	//funcion add para mostrar vistas
	public function add(){
		$this->comprobacionRoles();

		$data = array(			
			'maximos' => $this->Banco_model->ObtenerCodigo(),
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('bancos/add', $data);
		$this->load->view('template/footer');



	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'banco'=> $this->Banco_model->getBanco($id)
		);

			//print_r($data); die();
			//abrimos la vista view
		$this->load->view("bancos/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		$NumBanco   = $this->input->post("NumBanco");
		$desBanco   = $this->input->post("desBanco");
		$direccion   = $this->input->post("direccion");
		$telefono   = $this->input->post("telefono");
		$web   = $this->input->post("web");
		$email   = $this->input->post("email");

		$idBanco = $this->Banco_model->ultimoNumero();


		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$usuario = $_SESSION["usuario"];



		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

		$data = array(
			'idbanco'  => $idBanco->MAXIMO,
			'numbanco'  => $NumBanco,
			'desbanco'  => $desBanco,
			'direccion'  => $direccion,
			'web' => $web,
			'email' => $email,
			'fecgrabacion' => $fechaActual,
			'idempresa'  => $empresa
		);
		$desBanco = trim($desBanco);
		if($desBanco !="" && trim($desBanco) !="")
		{
			if($this->Banco_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Banco registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ??Gracias!.');</script > ";

				//redireccionamos y refrescamos
				redirect(base_url()."bancos/bancos", "refresh");

			}
			else
			{
					//si hubo errores, mostramos mensaje

				$this->session->set_flashdata('error', 'Banco no registrado!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
				redirect(base_url()."bancos/bancos/add", "refresh");
			}
		}else{	
			$this->session->set_flashdata('error', 'Ingrese Banco!');
				//redireccionamos
			redirect(base_url()."bancos/bancos/add", "refresh");
		}


	}
	
	public function edit($id)
	{
		$this->comprobacionRoles();
		$data = array(
			'banco'=> $this->Banco_model->getBanco($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('bancos/edit', $data);
		$this->load->view('template/footer');
	}
	
	public function update()
	{

		$this->comprobacionRoles();
		$idBanco = $this->input->post("idbanco");
		$NumBanco = $this->input->post("NumBanco");
		$desBanco = $this->input->post("desBanco");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$web = $this->input->post("web");
		$email = $this->input->post("email");

		$desBanco = trim($desBanco);
		if($desBanco !="" && trim($desBanco) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desBanco' => $desBanco,
				'direccion' => $direccion,
				'telefono' => $telefono,
				'web' => $web,
				'email' => $email
			);


			if($this->Banco_model->update($idBanco,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."bancos/bancos", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."bancos/bancos/edit/".$idBanco,"refresh");
			}
		}else{	

			$this->session->set_flashdata('error', 'Ingrese Banco!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."bancos/bancos/edit/".$idBanco,"refresh");
		}

	}

	public function delete($id){
		$this->comprobacionRoles();
		if($this->Banco_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."/bancos/bancos", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."/bancos/bancos", "refresh");		
		}

		
	}

}