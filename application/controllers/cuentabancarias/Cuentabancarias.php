<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Cuentabancarias extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->library(array('form_validation'));
		
		$this->load->model("Cuentabancaria_model");
		$this->load->model("Banco_model");
		$this->load->model("Tipocuenta_model");
		$this->load->model("Plancuenta_model");
		$this->load->model("Moneda_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		// if ($this->session->userdata('sist_conex')=="A") {
			//cargamos un array usando el modelo
			$data = array(
				'cuentas'=> $this->Cuentabancaria_model->getCuentabancarias()
			);

	//print_r($data); die();

			//llamamos a las vistas para mostrar
			$this->load->view('template/head');
			$this->load->view('template/menu');
			$this->load->view('cuentabancarias/list', $data);
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
				'maximos' => $this->Cuentabancaria_model->ObtenerCodigo(),
				'bancos' => $this->Banco_model->getBancos(),
				'tipocuentas' => $this->Tipocuenta_model->getTipocuentas(),
				'cuentacontables' => $this->Plancuenta_model->getPlancuentas(),
				'monedas' => $this->Moneda_model->getMonedas()
			);

	//print_r($data); die();

			$this->load->view('template/head');
			$this->load->view('template/menu');
			$this->load->view('cuentabancarias/add', $data);
			$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}
	//funcion vista
	public function view($id)
	{
		if ($this->session->userdata('sist_conex')=="A") {
			$id = explode(".", $id);
			
			$numCuenta = $id[0];
			$idbanco =  $id[1];

			$data = array(
				'cuenta' => $this->Cuentabancaria_model->getCuentabancaria($numCuenta,$idbanco)
			);

			//print_r($data); die();
			//abrimos la vista view
			$this->load->view("cuentabancarias/view", $data);

		}else {
			redirect(base_url(),'refresh');
		}
	}
	//funcion para almacenar en la bd
	public function store()
	{
		if ($this->session->userdata('sist_conex')=="A") {

	        //recibimos las variables
	        //print_r($_POST); die();
			$num = $this->input->post("NroCuenta");
			$idBanco = $this->input->post("IdBanco");
			$idTipoCuenta = $this->input->post("IdTipoCuenta");
			$idCuentacontable = $this->input->post("IdCuentaContable");
			$descripcion = $this->input->post("Descripcion");
			$fechaApertura = $this->input->post("Fecha");
			$saldoInicial = $this->input->post("Importe");
			$idMoneda = $this->input->post("IdMoneda");		
			
			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);

			$fecGrabacion = $this->input->post("FecGrabacion");		

			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];
			$usuario = $_SESSION["usuario"];		
			
				//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(				
				'numcuenta'  => $num,
				'idbanco' => $idBanco,
				'idtipocuenta' => $idTipoCuenta,
				'idCuentacontable' => $idCuentacontable,
				'descripcion' => $descripcion,
				'fechapertura' => $fechaApertura,
				'saldoinicial' => number_format($saldoInicial,3,'','.'),
				'idmoneda' => $idMoneda,
				'idempresa' => $empresa,
				'fecgrabacion'=> $fechaActual			
			);

	//print_r($data); die();

			$result = $this->validar($idBanco,$num,$idTipoCuenta,$idCuentacontable,$idMoneda,$descripcion,$fechaApertura,$saldoInicial);

			if($result == 1)
			{
				
				if($this->Cuentabancaria_model->save($data))
				{

					//si todo esta bien, emitimos mensaje
					$this->session->set_flashdata('success', 'Cuenta Bancaria registrado correctamente!');
					//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
					//print_r($_POST); die();
					//redireccionamos y refrescamos
					redirect(base_url()."cuentabancarias/cuentabancarias", "refresh");
					
				}
				else
				{
					//print_r($_POST); die();
						//si hubo errores, mostramos mensaje
					
					$this->session->set_flashdata('error', 'Cuenta Bancaria no registrado!');
					//redirect(base_url()."servicios", "refresh");
					
					//redireccionamos
					redirect(base_url()."cuentabancarias/cuentabancarias/add", "refresh");
				}
			}
			else
			{
	          	//$this->session->set_flashdata('error', 'Cuenta Bancaria ya existe!');
					//redirect(base_url()."servicios", "refresh");
				
					//redireccionamos
				redirect(base_url()."cuentabancarias/cuentabancarias/add", "refresh");
			}
		}else {
			redirect(base_url(),'refresh');
		}


	}


	//metodo para editar
	public function edit($id)
	{

		if ($this->session->userdata('sist_conex')=="A") {
			//print_r($id); die();
			//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model		
			$id = explode(".", $id);

			$numCuenta = $id[0];
			$idbanco =  $id[1];

			$data = array(
				'cuenta'=> $this->Cuentabancaria_model->getCuentabancaria($numCuenta,$idbanco),
				'cuentacontables' => $this->Plancuenta_model->getPlancuentas(),
			);

			//print_r($data); die();

			$this->load->view('template/head');
			$this->load->view('template/menu');
			$this->load->view('cuentabancarias/edit', $data);
			$this->load->view('template/footer');

		}else {
			redirect(base_url(),'refresh');
		}
	}


	//actualizamos 
	
	public function update()
	{
		if ($this->session->userdata('sist_conex')=="A") {
			$num = $this->input->post("NroCuenta");
			$idBanco = $this->input->post("IdBanco");
			$idTipoCuenta = $this->input->post("IdTipoCuenta");
			$idCuentacontable = $this->input->post("IdCuentaContable");
			$descripcion = $this->input->post("Descripcion");
			$fechaApertura = $this->input->post("Fecha");
			$saldoInicial = $this->input->post("Importe");
			$idMoneda = $this->input->post("IdMoneda");		

			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];
			$usuario = $_SESSION["usuario"];

        //print_r($_POST); die();

		//indicar campos de la tabla a modificar
			$data = array(								
				'idCuentacontable' => $idCuentacontable,
				'descripcion' => $descripcion,				
				'saldoinicial' => number_format($saldoInicial,3,'','.')
			);

			$result = $this->datosCorrectos($idBanco,$num,$idTipoCuenta,$idCuentacontable,$idMoneda,$descripcion,$fechaApertura,
				$saldoInicial);


			if($result == 1)
			{          	

				if($this->Cuentabancaria_model->update($num,$idBanco,$data))
				{

					$this->session->set_flashdata('success', 'Actualizado correctamente!');
					redirect(base_url()."cuentabancarias/cuentabancarias", "refresh");
				}
				else
				{
					$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
					redirect(base_url()."cuentabancarias/cuentabancarias/edit/".$num.".".$idBanco,"refresh");
				}	
			}
			else
			{
          		//redireccionamos
				redirect(base_url()."cuentabancarias/cuentabancarias/edit/".$num.".".$idBanco,"refresh");
			}       

		}else {
			redirect(base_url(),'refresh');
		}


	}
	
	

	public function delete($id){
		if ($this->session->userdata('sist_conex')=="A") {
			$id = explode(".", $id);

			$numCuenta = $id[0];
			$idbanco =  $id[1];
			
			if($this->Cuentabancaria_model->delete($numCuenta,$idbanco)){
				$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
				redirect(base_url()."/cuentabancarias/cuentabancarias", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url()."/cuentabancarias/cuentabancarias", "refresh");		
			}		
		
		}else {
			redirect(base_url(),'refresh');
		}

	}

	public function validar($idbanco,$numcuenta,$tipocuenta,$cuentacontable,$moneda,$descripcion,$fecha,$saldo)
	{
	//Validar si la cuenta ya existe
		$existeCuentaBancaria =$this->Cuentabancaria_model->existeCuenta($idbanco,$numcuenta);   
  //Validar si existe el plan de cuenta
		$cantContable = $this->Plancuenta_model->validarExisteCopia(trim($cuentacontable));
  //Validar la descripcion que contenga contenido
		if(strlen(trim($descripcion)) < 1)
		{
			$this->session->set_flashdata('error', 'Debe ingresar una descripcion!');
			return false;
		}
		elseif ($existeCuentaBancaria->cantidad > 0) 
		{
			$this->session->set_flashdata('error', 'La cuenta ya existe, favor verificar...!');
			return false;
		}
		elseif ($cantContable->cantidad < 1) 
		{
			$this->session->set_flashdata('error', 'El plan de cuenta seleccionado no existe, favor verificar...!');
			return false;
		}
		elseif ($this->Moneda_model->validarExiste(trim($moneda)) < 1) 
		{
			$this->session->set_flashdata('error', 'La moneda seleccionada no existe, favor verificar...!');
			return false;
		}
		elseif ($saldo <= 0) 
		{
			$this->session->set_flashdata('error', 'Debe ingresar el saldo de la cuenta!');
			return false;
		}
		else
		{
			return true;
		}

	}

	public function datosCorrectos($idbanco,$numcuenta,$tipocuenta,$cuentacontable,$moneda,$descripcion,$fecha,$saldo)
	{
		$cantContable = $this->Plancuenta_model->validarExisteCopia(trim($cuentacontable));

		if(strlen(trim($descripcion)) < 1)
		{
			$this->session->set_flashdata('error', 'Debe ingresar una descripcion!');
			return false;
		}  
		elseif ($cantContable->cantidad < 1) 
		{
			$this->session->set_flashdata('error', 'El plan de cuenta seleccionado no existe, favor verificar...!');
			return false;
		}
		elseif ($this->Moneda_model->validarExiste(trim($moneda)) < 1) 
		{
			$this->session->set_flashdata('error', 'La moneda seleccionada no existe, favor verificar...!');
			return false;
		}
		elseif ($saldo <= 0) 
		{
			$this->session->set_flashdata('error', 'Debe ingresar el saldo de la cuenta!');
			return false;
		}
		else
		{
			return true;
		}
	}


}