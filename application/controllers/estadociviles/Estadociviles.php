<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Estadociviles extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Estadocivil_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'estadociviles'=> $this->Estadocivil_model->getEstadociviles()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('estadociviles/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Estadocivil_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('estadociviles/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'estadocivil'=> $this->Estadocivil_model->getEstadocivil($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("estadociviles/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

		//print_r($_POST); die();

        $NumCivil   = $this->input->post("NumCivil");
		$desCivil   = $this->input->post("desCivil");
		
		$idCivil = $this->Estadocivil_model->ultimoNumero();


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
				'idcivil'  => $idCivil->MAXIMO,
				'numcivil'  => $NumCivil,
				'DESCCIVIL'  => $desCivil,
				'fecgrabacion' => $fechaActual
			);

//print_r($data); die();
            //guardamos los datos en la base de datos
            $desCivil = trim($desCivil);
		if($desCivil !="" && trim($desCivil) !="")
		{
			if($this->Estadocivil_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Estado Civil registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."estadociviles/estadociviles", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Estado Civil no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."estadociviles/estadociviles/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Estado Civil!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."estadociviles/estadociviles/add", "refresh");

				

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'estadocivil'=> $this->Estadocivil_model->getEstadocivil($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('estadociviles/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idCivil= $this->input->post("idcivil");
		$NumCivil= $this->input->post("NumCivil");
		$desCivil= $this->input->post("desCivil");
		
		$desCivil = trim($desCivil);
		if($desCivil !="" && trim($desCivil) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'DESCCIVIL' => $desCivil
			);


			if($this->Estadocivil_model->update($idCivil,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."estadociviles/estadociviles", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."estadociviles/estadociviles/edit/".$idCivil,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Estado Civil!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."estadociviles/estadociviles/edit/".$idCivil,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Estadocivil_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/estadociviles/estadociviles", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/estadociviles/estadociviles", "refresh");		
	}

		
}

}