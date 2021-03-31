<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Zonas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model("Zona_model");
		$this->load->model("Ciudad_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'zonas'=> $this->Zona_model->getZonas()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('zonas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Zona_model->ObtenerCodigo(),
			  'ciudades' => $this->Ciudad_model->GetCiudades()
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('zonas/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'zona'=> $this->Zona_model->getZona($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("zonas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

		//print_r($_POST); die();

        $numZona  = $this->input->post("NumZona");
		$desZona  = $this->input->post("DesZona");
		$idCiudad  = $this->input->post("IdCiudad");
		
		$idZona = $this->Zona_model->ultimoNumero();


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
				'idzona'  => $idZona->MAXIMO,
				'numzona'  => $numZona,
				'deszona'  => $desZona,
				'idciudad' => $idCiudad,
				'fecgrabacion' => $fechaActual
			);

		//print_r($data); die();
            //guardamos los datos en la base de datos
            $desZona = trim($desZona);
		if($desZona !="" && trim($desZona) !="")
		{
			if($this->Zona_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Zona registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."zonas/zonas", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Zona no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."zonas/zonas/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Zona!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."zonas/zonas/add", "refresh");

				

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'zona'=> $this->Zona_model->getZona($id),
			'ciudades' => $this->Ciudad_model->GetCiudades()
		);


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('zonas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idZona= $this->input->post("IdZona");
		$numZona= $this->input->post("NumZona");
		$desZona= $this->input->post("DesZona");
		$idCiudad = $this->input->post("IdCiudad");
		

		$desZona = trim($desZona);
		if($desZona !="" && trim($desZona) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'deszona' => $desZona,
				'idciudad' => $idCiudad
			);

		//print_r($data); die();

			if($this->Zona_model->update($idZona,$data))
			{
				//print_r($idDepartamento); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."zonas/zonas", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."zonas/zonas/edit/".$idZona,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Zona!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."zonas/zonas/edit/".$idZona,"refresh");

				

		}

	}

   public function delete($id){
   	//print_r($id); die();
		
	  if($this->Zona_model->delete($id)){

		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."zonas/zonas", "refresh");
		
	  }
	  else
	  {
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."zonas/zonas", "refresh");		

	  }

		
}

}