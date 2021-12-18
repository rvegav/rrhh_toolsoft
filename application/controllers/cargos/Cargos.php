<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Cargos extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}		
		$this->load->model(array('Usuarios_model', 'Cargo_model'));

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idpantalla = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idpantalla)) {
			redirect(base_url());
		}
	}
	public function index()
	{	
		$this->comprobacionRoles();
		$data = array(
			'cargos'=> $this->Cargo_model->getCargos()
		);

			//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('cargos/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();
		$data = array(			
			'maximos' => $this->Cargo_model->ObtenerCodigo(),
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('cargos/add', $data);
		$this->load->view('template/footer');
	}
	//funcion vista
	public function view($id)
	{
		$this->comprobacionRoles();
		$data = array (
			'cargo'=> $this->Cargo_model->getCargo($id)
		);
		$this->load->view("cargos/view", $data);

	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		$NumCargo   = $this->input->post("NumCargo");
		$desCargo   = $this->input->post("desCargo");

		$idCargo = $this->Cargo_model->ultimoNumero();


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
			'idcargo'  => $idCargo->MAXIMO,
			'numcargo'  => $NumCargo,
			'descargo'  => $desCargo,
			'fecgrabacion' => $fechaActual,
			'idempresa'  => $empresa,
			'idusuario' => $usuario
		);
            //guardamos los datos en la base de datos
		$desCargo = trim($desCargo);
		if($desCargo !="" && trim($desCargo) !="")
		{
			if($this->Cargo_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Cargo registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";

				//redireccionamos y refrescamos
				redirect(base_url()."cargos/cargos", "refresh");

			}
			else
			{
					//si hubo errores, mostramos mensaje

				$this->session->set_flashdata('error', 'Cargo no registrado!');
				//redirect(base_url()."servicios", "refresh");

				//redireccionamos
				redirect(base_url()."cargos/cargos/add", "refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Cargo!');
				//redireccionamos
			redirect(base_url()."cargos/cargos/add", "refresh");

		}

	}
	
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
		$data = array(
			'cargo'=> $this->Cargo_model->getCargo($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('cargos/edit', $data);
		$this->load->view('template/footer');

	}

	
	public function update()
	{
		$this->comprobacionRoles();	
		$idCargo= $this->input->post("idcargo");
		$NumCargo= $this->input->post("NumCargo");
		$desCargo= $this->input->post("desCargo");

		$desCargo = trim($desCargo);
		if($desCargo !="" && trim($desCargo) !="")
		{
				//indicar campos de la tabla a modificar
			$data = array(
				'desCargo' => $desCargo
			);


			if($this->Cargo_model->update($idCargo,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."cargos/cargos", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."cargos/cargos/edit/".$idCargo,"refresh");
			}
		}
		else
		{	

			$this->session->set_flashdata('error', 'Ingrese Cargo!');

					//redireccionamos
			redirect(base_url()."cargos/cargos/edit/".$idCargo,"refresh");
		}
	}

	public function delete($id){
		$this->comprobacionRoles();

		if($this->Cargo_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."/cargos/cargos", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."/cargos/cargos", "refresh");		
		}
		
	}

}