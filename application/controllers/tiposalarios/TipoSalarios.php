<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Tiposalarios extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Tiposalario_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'tiposalarios'=> $this->Tiposalario_model->getTiposalarios()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tiposalarios/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Tiposalario_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tiposalarios/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'tiposalario'=> $this->Tiposalario_model->getTiposalario($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("tiposalarios/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables


        $NumTiposalario = $this->input->post("NumTipoSalario");
		$desTiposalario = $this->input->post("DesTipoSalario");
		$importe = $this->input->post("Importe");
		
		$idTiposalario = $this->Tiposalario_model->ultimoNumero();


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
				'idtiposalario'  => $idTiposalario->MAXIMO,
				'numtiposalario'  => $NumTiposalario,
				'destiposalario'  => $desTiposalario,
				'importe' => $importe,
				'fecgrabacion' => $fechaActual,
				'idempresa'  => $empresa
			);

		
            //guardamos los datos en la base de datos
            $desTiposalario = trim($desTiposalario);
		if($desTiposalario !="" && trim($desTiposalario) !="")
		{
			if($this->Tiposalario_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Tipo de Salario registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."tiposalarios/tiposalarios", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Tipo de Salario no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."tiposalarios/tiposalarios/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Tipo de Salario!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."tiposalarios/tiposalarios/add", "refresh");			

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'tiposalario'=> $this->Tiposalario_model->getTiposalario($id)
		);

		//print_r($data); die();


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tiposalarios/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idTipoSalario = $this->input->post("IdTipoSalario");
		$NumTiposalario = $this->input->post("NumTipoSalario");
		$desTiposalario = $this->input->post("DesTipoSalario");
		$importe = $this->input->post("Importe");

		$desTiposalario = trim($desTiposalario);
		if($desTiposalario !="" && trim($desTiposalario) !="")
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'destiposalario' => $desTiposalario,
				'importe' => $importe
			);


			if($this->Tiposalario_model->update($idTipoSalario,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."tiposalarios/tiposalarios", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."tiposalarios/tiposalarios/edit/".$idTipoSalario,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese Tipo de Salario!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."tiposalarios/tiposalarios/edit/".$idTipoSalario,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Tiposalario_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/tiposalarios/tiposalarios", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/tiposalarios/tiposalarios", "refresh");		
	}

		
}

}