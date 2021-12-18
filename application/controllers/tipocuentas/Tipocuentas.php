<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Tipocuentas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model("Usuarios_model");
		
		$this->load->model("Tipocuenta_model");
	}
	//esta funcion es la primera que se cargar
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	public function index()
	{
	$this->comprobacionRoles();	
		//cargamos un array usando el modelo
		$data = array(
			'tipocuentas'=> $this->Tipocuenta_model->getTipocuentas()
		);

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipocuentas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();

		$data = array(			
			'maximos' => $this->Tipocuenta_model->ObtenerCodigo(),
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipocuentas/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'tipocuenta'=> $this->Tipocuenta_model->getTipocuenta($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("tipocuentas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		//recibimos las variables

		//print_r($_POST); die();

		$NumTipocuenta   = $this->input->post("NumTipocuenta");
		$desTipocuenta   = $this->input->post("desTipocuenta");
		
		$idTipocuenta = $this->Tipocuenta_model->ultimoNumero();


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
			'idtipocuenta'  => $idTipocuenta->MAXIMO,
			'numtipocuenta'  => $NumTipocuenta,
			'destipocuenta'  => $desTipocuenta,
			'fecgrabacion' => $fechaActual
		);

//print_r($data); die();
            //guardamos los datos en la base de datos
		$desTipocuenta = trim($desTipocuenta);
		if($desTipocuenta !="" && trim($desTipocuenta) !="")
		{
			if($this->Tipocuenta_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Tipo de Cuenta registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."tipocuentas/tipocuentas", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje

				$this->session->set_flashdata('error', 'Tipo de cuenta no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."tipocuentas/tipocuentas/add", "refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese el Tipo de Cuenta!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."tipocuentas/tipocuentas/add", "refresh");



		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'tipocuenta'=> $this->Tipocuenta_model->getTipocuenta($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipocuentas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$this->comprobacionRoles();
		$idTipocuenta= $this->input->post("idtipocuenta");
		$NumTipocuenta= $this->input->post("NumTipocuenta");
		$desTipocuenta= $this->input->post("desTipocuenta");
		
		$desTipocuenta = trim($desTipocuenta);
		if($desTipocuenta !="" && trim($desTipocuenta) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desTipocuenta' => $desTipocuenta
			);


			if($this->Tipocuenta_model->update($idTipocuenta,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."tipocuentas/tipocuentas", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."tipocuentas/tipocuentas/edit/".$idTipocuenta,"refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Tipo de Cuenta!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."tipocuentas/tipocuentas/edit/".$idTipocuenta,"refresh");



		}

	}

	public function delete($id)
	{
		$this->comprobacionRoles();
		
		if($this->Tipocuenta_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."/tipocuentas/tipocuentas", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."/tipocuentas/tipocuentas", "refresh");		
		}

		
	}

}