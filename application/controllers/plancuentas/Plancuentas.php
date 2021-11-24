<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Plancuentas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->library(array('form_validation'));
		
		$this->load->model("Plancuenta_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'cuentas'=> $this->Plancuenta_model->getPlancuentas()
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('plancuentas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$data = array(			
			'maximos' => $this->Plancuenta_model->ObtenerCodigo(),
			'cuentas_padre'=> $this->Plancuenta_model->obtenerCuentaPadre());
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('plancuentas/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'cuenta'=> $this->Plancuenta_model->getPlancuenta($id)
		);

		$this->load->view("plancuentas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{

		// if ($this->session->userdata('pantalla')=='S' and  $this->session->userdata('accion') = 'S') {
		
		$this->form_validation->set_rules('NumCuentacontable', 'Numero de Cuenta', 'required');
		$this->form_validation->set_rules('desPlancuenta', 'Descripcion de la Cuenta', 'trim|required');
		$this->form_validation->set_rules('nivel', 'Nivel', 'required|numeric');
		$this->form_validation->set_rules('rad_imputable', 'Imputable', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors('<div class="error">', '</div>'));
			redirect(base_url()."plancuentas/plancuentas/add");
		} else {
			$NumPlancuenta   = $this->input->post("NumCuentacontable");
			$desPlancuenta   = $this->input->post("desPlancuenta");
			$asentable = $this->input->post("rad_imputable");
			$nivel = $this->input->post("nivel");
			$cuentaPadre = $this->input->post("cuentaPadre");
			$idPlancuenta = $this->Plancuenta_model->ultimoNumero();
			$time = time();
			$fechaActual = date("Y-m-d H:i:s",$time);
			$empresa = $_SESSION["Empresa"];
			$sucursal = $_SESSION["Sucursal"];
			$usuario = $_SESSION["usuario"];		

			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(
				'idPlancuenta'  => $idPlancuenta->MAXIMO,
				'numplancuenta'  => $NumPlancuenta,
				'descplancuenta'  => $desPlancuenta,
				'asentable'  => $asentable,
				'nivelcuenta' => $nivel,
				'fechagrabacion' => $fechaActual,
				'idempresa' => $empresa,
				'idsucursal' => $sucursal,
				'tipocuenta' => 0, 
				'idplancuenta_padre'=> $cuentaPadre

			);

			$existe = $this->Plancuenta_model->validarExiste($NumPlancuenta);
			if($existe->cantidad == "0"){
				if($this->Plancuenta_model->save($data)){
				//si todo esta bien, emitimos mensaje
					$this->session->set_flashdata('success', 'Plan de Cuentas registrado correctamente!');
				//redireccionamos y refrescamos
					redirect(base_url()."plancuentas/plancuentas", "refresh");
				}else{
				//si hubo errores, mostramos mensaje
					$this->session->set_flashdata('error', 'Plan de Cuentas no registrado!');				
				//redireccionamos
					redirect(base_url()."plancuentas/plancuentas/add", "refresh");
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Cuenta Contable ya existe!');
				redirect(base_url()."plancuentas/plancuentas/add", "refresh");
			}

		}

		// }

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'cuenta'=> $this->Plancuenta_model->getPlancuenta($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('plancuentas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idPlancuenta= $this->input->post("idcuentacontable");
		$NumPlancuenta= $this->input->post("NumPlancuenta");
		$desPlancuenta= $this->input->post("desPlanCuenta");
		$subCuenta= $this->input->post("subCuenta");
		$asentable= $this->input->post("inlineMaterialRadiosExample");
		$nivel= $this->input->post("nivel");

		//print_r($_POST); die();
		
			//indicar campos de la tabla a modificar
		$data = array(
			'desPlancuenta' => $desPlancuenta,
			'subcuenta' => $subCuenta,
			'asentable' => $asentable,
			'nivelcuenta' => $nivel
		);

		if($this->Plancuenta_model->update($idPlancuenta,$data))
		{
				//print_r($idCiudad); die();
			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."plancuentas/plancuentas", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."plancuentas/plancuentas/edit/".$idPlancuenta,"refresh");
		}		

	}

	public function delete($id){
		
		if($this->Plancuenta_model->delete($id)){
			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
			redirect(base_url()."/plancuentas/plancuentas", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
			redirect(base_url()."/plancuentas/plancuentas", "refresh");		
		}

		
	}
	public function getPlancuenta(){
		$id = $this->input->post('cuenta', TRUE);
		echo json_encode($this->Plancuenta_model->getPlancuenta($id));
	}

}