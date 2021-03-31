<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Vacaciones extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Vacacion_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'vacaciones'=> $this->Vacacion_model->getVacaciones()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('vacaciones/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Vacacion_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('vacaciones/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'vacacion'=> $this->Vacacion_model->getVacacion($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("vacaciones/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

        $desde = $this->input->post("Desde");
		$hasta = $this->input->post("Hasta");
		$cantidadDias = $this->input->post("CantidadDias");
		
		$idVacacion = $this->Vacacion_model->ultimoNumero();


        $time = time();
        $fechaActual = date("Y-m-d H:i:s",$time);

        $empresa = $_SESSION["Empresa"];
        $sucursal = $_SESSION["Sucursal"];
        $usuario = $_SESSION["usuario"];

        //print_r($_POST); die();

		//corremos la validacion
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(
				'idvacacion'  => $idVacacion->MAXIMO,
				'idempresa'  => $empresa,
				'desde'  => $desde,
				'hasta'  => $hasta,
				'cantidaddias' => $cantidadDias,
				'fecgrabacion' => $fechaActual
			);

		//print_r($desde.$hasta.$cantidadDias); die();

		if($desde > 0 && $hasta > 0 && $cantidadDias > 0)
		{
			if($this->Vacacion_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Escala de Vacaciones registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."vacaciones/vacaciones", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Escala de Vacaciones no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."vacaciones/vacaciones/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Complete todos los campos!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."vacaciones/vacaciones/add", "refresh");			

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'vacacion'=> $this->Vacacion_model->getVacacion($id)
		);

		//print_r($data); die();


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('vacaciones/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idVacacion = $this->input->post("IdVacacion");
		$desde = $this->input->post("Desde");
		$hasta = $this->input->post("Hasta");
		$cantidadDias = $this->input->post("CantidadDias");

		if($desde > 0 && $hasta > 0 && $cantidadDias > 0)
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desde' => $desde,
				'hasta' => $hasta,
				'cantidaddias' => $cantidadDias
			);


			if($this->Vacacion_model->update($idVacacion,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."vacaciones/vacaciones", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."vacaciones/vacaciones/edit/".$idVacacion,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese datos solicitados!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."vacaciones/vacaciones/edit/".$idVacacion,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Vacacion_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/vacaciones/vacaciones", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/vacaciones/vacaciones", "refresh");		
	}

		
}

}