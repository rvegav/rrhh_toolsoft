<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class Servicios extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Servicios_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'servicios'=> $this->Servicios_model->getServicios(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('servicios/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('servicios/add');
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'servicios'=> $this->Servicios_model->getServicio($id)
		);
		//abrimos la vista view
		$this->load->view("servicios/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables
		$desServicio   = $this->input->post("desServicio");
		$fechaCreacion = date("Y-m-d H:i:s");

		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		$this->form_validation->set_rules("desServicio", "Descripcion", "required|is_unique[servicio.desServicio]");

		//corremos la validacion
		if($this->form_validation->run())
		{
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
			$data = array(
				'desServicio'  => $desServicio,
				'fechaCreacion'=> $fechaCreacion,
				'estServicio'  => "1"
			);
			//guardamos los datos en la base de datos
			if($this->Servicios_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Servicio registrado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect('servicios/servicios', 'refresh');
				// 	redirect(base_url()."servicios / servicios", "refresh");
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Servicio no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect("servicios/list", "refresh");
			}
		}
		else
		{
			//	redirect('servicios / servicios', 'refresh');
			//si hubo errores en la validacion, rellamamos al metodo add mas arriba detallado
			$this->add();
		}

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'servicio'=> $this->Servicios_model->getServicio($id),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('servicios/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idServicio      = $this->input->post("idServicio");
		$desServicio     = $this->input->post("desServicio");
		$estServicio     = $this->input->post("estServicio");
		$fechaUpdate     = date("Y-m-d H:i:s");
	
		//traemos datos para no duplicarlos
		$servicio_actual = $this->Servicios_model->getServicio($idServicio);

		if($desServicio == $servicio_actual->desServicio)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[servicio.desServicio]';
		}
		//validar
		$this->form_validation->set_rules("desServicio", "Descripcion", "required".$unique);

		if($this->form_validation->run())
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'desServicio'     =>  $desServicio,
				'estServicio'     =>  $estServicio,
				'ultActualizacion'=>  $fechaUpdate
			);
			if($this->Servicios_model->update($idServicio,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."servicios/servicios", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."servicios/servicios/edit/".$idServicio);
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->edit($idServicio);
		}
	}
	
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estServicio' => '3',
		);
		if($this->Servicios_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
				echo "servicios/servicios/";

				//redirect(base_url()."servicios/servicios", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
				redirect(base_url()."servicios/servicios/list/".$id);
			}
		
		
	}
}