<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Feriados extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		
		$this->load->model("Feriado_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'feriados'=> $this->Feriado_model->getFeriados()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('feriados/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Feriado_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('feriados/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'feriado'=> $this->Feriado_model->getFeriado($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("feriados/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

        $fecha = $this->input->post("Fecha");
		$motivo = $this->input->post("Motivo");
		
		$idFeriado = $this->Feriado_model->ultimoNumero();


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
				'idferiado'  => $idFeriado->MAXIMO,
				'idempresa'  => $empresa,
				'fechaferiado'  => $fecha,
				'descferiado'  => $motivo,
				'fecgrabacion' => $fechaActual
			);

		if(trim($motivo) != "" && !is_null($motivo) && $this->ValidarFecha($fecha))
		{
			if($this->Feriado_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Feriado registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url()."feriados/feriados", "refresh");
				
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Feriado no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url()."feriados/feriados/add", "refresh");
			}
	    }
		else
		{	
			    
                $this->session->set_flashdata('error', 'Complete todos los campos!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."feriados/feriados/add", "refresh");			

		}
		

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'feriado'=> $this->Feriado_model->getFeriado($id)
		);	


		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('feriados/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idFeriado = $this->input->post("IdFeriado");
		$fecha = $this->input->post("Fecha");
		$motivo = $this->input->post("Motivo");


		if(trim($motivo) != "" && !is_null($motivo) && $this->ValidarFecha($fecha))
		{

			//indicar campos de la tabla a modificar
			$data = array(
				'fechaferiado' => $fecha,
				'descferiado' => $motivo
			);

			if($this->Feriado_model->update($idFeriado,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."feriados/feriados", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."feriados/feriados/edit/".$idFeriado,"refresh");
			}
		}
		else
		{	
			    
                $this->session->set_flashdata('error', 'Ingrese datos solicitados!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
			redirect(base_url()."feriados/feriados/edit/".$idFeriado,"refresh");

				

		}

	}

public function delete($id){
		
	if($this->Feriado_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/feriados/feriados", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/feriados/feriados", "refresh");		
	}

		
}


public function ValidarFecha($fecha)
{		
	$valores = explode('-', $fecha);	
	if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
		return true;
    }
    else
    {
    	return false;    	
    }	
}

}