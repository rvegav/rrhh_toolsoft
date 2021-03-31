<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Paises extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Pais_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'paises'=> $this->Pais_model->getPaises()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('paises/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Pais_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('paises/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'pais'=> $this->Pais_model->getPais($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("paises/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

		//print_r($_POST); die();

        $NumPais   = $this->input->post("NumPais");
		$desPais   = $this->input->post("desPais");
		
		$idPais = $this->Pais_model->ultimoNumero();


        $time = time();
        $fechaActual = date("Y-m-d H:i:s",$time);

        $empresa = $_SESSION["Empresa"];
        $sucursal = $_SESSION["Sucursal"];

		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		//$this->form_validation->set_rules("NumCiudad", "NumCiudad", "required|is_unique[ciudad.numCiudad]");

		//corremos la validacion
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(
				'idpais'  => $idPais->MAXIMO,
				'numpais'  => $NumPais,
				'despais'  => $desPais,
				'fecgrabacion' => $fechaActual,
				// 'idempresa'  => $empresa
			);

//print_r($data); die();
            //guardamos los datos en la base de datos
            $desPais = trim($desPais);
		if($desPais !="" && trim($desPais) !="")
		{
			if($this->Pais_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Pais registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."paises/paises", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Pais no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."paises/paises/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Pais!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."paises/paises/add", "refresh");

				

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'pais'=> $this->Pais_model->getPais($id)
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('paises/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idPais= $this->input->post("idpais");
		$NumPais= $this->input->post("NumPais");
		$desPais= $this->input->post("desPais");
		
		$desPais = trim($desPais);
		if($desPais !="" && trim($desPais) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desPais' => $desPais
			);


			if($this->Pais_model->update($idPais,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."paises/paises", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."paises/paises/edit/".$idPais,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Pais!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."paises/paises/edit/".$idPais,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Pais_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/paises/paises", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/paises/paises", "refresh");		
	}

		
}

}