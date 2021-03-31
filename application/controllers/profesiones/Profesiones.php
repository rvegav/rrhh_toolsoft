<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Profesiones extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Profesion_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'profesiones'=> $this->Profesion_model->getProfesiones()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('profesiones/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Profesion_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('profesiones/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'profesion'=> $this->Profesion_model->getProfesion($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("profesiones/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

		//print_r($_POST); die();

        $NumProfesion  = $this->input->post("NumProfesion");
		$desProfesion  = $this->input->post("desProfesion");
		
		$idProfesion = $this->Profesion_model->ultimoNumero();


        $time = time();
        $fechaActual = date("Y-m-d H:i:s",$time);

        $empresa = $_SESSION["Empresa"];
        $sucursal = $_SESSION["Sucursal"];
        $idusuario = $_SESSION["idusuario"];
                
		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

		//corremos la validacion
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(
				'idprofesion'  => $idProfesion->MAXIMO,
				'numprofesion'  => $NumProfesion,
				'desprofesion'  => $desProfesion,
				'fecgrabacion' => $fechaActual,
				'idempresa' => $empresa
			);

//print_r($data); die();
            //guardamos los datos en la base de datos
            $desProfesion = trim($desProfesion);
		if($desProfesion !="" && trim($desProfesion) !="")
		{
			if($this->Profesion_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Profesion registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."profesiones/profesiones", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Profesion no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."profesiones/profesiones/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Profesion!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."profesiones/profesiones/add", "refresh");

				

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'profesion'=> $this->Profesion_model->getProfesion($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('profesiones/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idProfesion= $this->input->post("idProfesion");
		$NumProfesion= $this->input->post("NumProfesion");
		$desProfesion= $this->input->post("desProfesion");
		
		$desProfesion = trim($desProfesion);
		if($desProfesion !="" && trim($desProfesion) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desProfesion' => $desProfesion
			);


			if($this->Profesion_model->update($idProfesion,$data))
			{
				//print_r($idNivel); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."profesiones/profesiones", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."profesiones/profesiones/edit/".$idProfesion,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Profesion!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."profesiones/profesiones/edit/".$idProfesion,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Profesion_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/profesiones/profesiones", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/profesiones/profesiones", "refresh");		
	}

		
}

}