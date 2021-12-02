<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Sucursales extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Sucursal_model");
		$this->load->model("Zona_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'sucursales'=> $this->Sucursal_model->getSucursales()
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('sucursales/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add(){
		$data = array(			
			'maximos' => $this->Sucursal_model->ObtenerCodigo(),
			  // 'zonas' => $this->Zona_model->getZonas()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('sucursales/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id){
		$data = array (
			'sucursal'=> $this->Sucursal_model->getSucursal($id)
		);
		//abrimos la vista view
		$this->load->view("sucursales/view", $data);
	}
	//funcion para almacenar en la bd
	public function store(){
		//recibimos las variables
		$numSucursal = $this->input->post("NumSucursal");
		$desSucursal = $this->input->post("DesSucursal");
		$direccion = $this->input->post("Direccion");
		$telefono = $this->input->post("Telefono");
		$nroPatonal = $this->input->post("NroPatronal");
		$idZona   = $this->input->post("IdZona");
		
		$idSucursal = $this->Sucursal_model->ultimoNumero();

		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);

		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];

//print_r($sucursal); die();
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
		$data = array(
			'idsucursal'  => $idSucursal->MAXIMO,
			'numsucursal'  => $numSucursal,
			'descsucursal'  => $desSucursal,
			'direccion'  => $direccion,
			'telefono'  => $telefono,
			'fecgrabacion' => $fechaActual,
			'idempresa'  => 1,
			// 'idzona' => $idZona
		);
            //guardamos los datos en la base de datos
		$desSucursal = trim($desSucursal);
		if($desSucursal !="" && trim($desSucursal) !="")
		{
			if($this->Sucursal_model->save($data)){
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Sucursal registrada correctamente!');				
				//redireccionamos y refrescamos
				redirect(base_url()."sucursales/sucursales", "refresh");
				
			}else{
				$this->session->set_flashdata('error', 'Sucursal no registrada!');
				//redireccionamos
				redirect(base_url()."sucursales/sucursales/add", "refresh");
			}
		}else{	
			$this->session->set_flashdata('error', 'Ingrese Sucursal!');
			redirect(base_url()."sucursales/sucursales/add", "refresh");
		}

	}
	
	//metodo para editar
	public function edit($id){
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'sucursal'=> $this->Sucursal_model->getSucursal($id),
			// 'zonas' => $this->Zona_model->getZonas()
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('sucursales/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{	

		$idSucursal = $this->input->post("IdSucursal");
		$numSucursal = $this->input->post("NumSucursal");
		$desSucursal = $this->input->post("DesSucursal");
		$direccion = $this->input->post("Direccion");
		$telefono = $this->input->post("Telefono");
		$nroPatonal = $this->input->post("NroPatronal");
		$idZona = $this->input->post("IdZona");
		
		$desSucursal = trim($desSucursal);
		

		if($desSucursal !="" && trim($desSucursal) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'descsucursal' => $desSucursal,
				'direccion' => $direccion,
				'telefono' => $telefono,
				// 'nropatronal' => $nroPatonal,
				// 'idzona' => $idZona
			);



			if($this->Sucursal_model->update($idSucursal,$data))
			{
				
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."sucursales/sucursales", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."sucursales/sucursales/edit/".$idSucursal,"refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Sucursal!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
			redirect(base_url()."sucursales/sucursales/edit/".$idSucursal,"refresh");



		}

	}


	public function delete($id)
	{
//print_r($id); die();
		if($this->Sucursal_model->delete($id))
		{

			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."sucursales/sucursales", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."sucursales/sucursales/","refresh");
		}

	}


}