<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class Empresas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Empresas_model");
		$this->load->model("Usuarios_model");
		
	}
	//esta funcion es la primera que se cargar
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$moduloid = 1;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $moduloid)) {
			redirect(base_url());
		}
	}
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'empresas'=> $this->Empresas_model->getEmpresas(),
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empresas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empresas/add');
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'empresas'=> $this->Empresas_model->getEmpresa($id)
		);
		//abrimos la vista view
		$this->load->view("empresas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		//recibimos las variables

        $nomfantasia   = $this->input->post("nomfantasia");
		$nomcontribuyente   = $this->input->post("nomcontribuyente");
		$ruccontribuyente   = $this->input->post("ruccontribuyente");
		$desempresa   = $this->input->post("desempresa");
		$direccion   = $this->input->post("direccion");
		$telefono   = $this->input->post("telefono");
		$email   = $this->input->post("email");
		$nomrepresentante   = $this->input->post("nomrepresentante");
		$rucrepresentante   = $this->input->post("rucrepresentante");
		$fecgra = date("Y-m-d H:i:s");

		//aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		$this->form_validation->set_rules("desempresa", "Desempresa", "required|is_unique[empresas.desempresa]");

		//corremos la validacion
		if($this->form_validation->run())
		{
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
			$data = array(
				'nomfantasia'  => $nomfantasia,
				'nomcontribuyente'  => $nomcontribuyente,
				'desempresa'  => $desempresa,
				'direccion'  => $direccion,
				'telefono'  => $telefono,
				'email'  => $email,
				'nomrepresentante'  => $nomrepresentante,
				'rucrepresentante'  => $rucrepresentante,
				'fecgra'=> $fecgra
				
			);
			//guardamos los datos en la base de datos
			if($this->Empresas_model->save($data))
			{
				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Empresa registrada correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect('empresas/empresas', 'refresh');
				// 	redirect(base_url()."servicios / servicios", "refresh");
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Empresa no registrada!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect("empresas/list", "refresh");
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
			'empresa'=> $this->Empresas_model->getEmpresas($id),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empresas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$codempresa= $this->input->post("codempresa");
		$nomfantasia= $this->input->post("nomfantasia");
		$nomcontribuyente= $this->input->post("nomcontribuyente");
		$ruccontribuyente= $this->input->post("ruccontribuyente");
		$desempresa= $this->input->post("desempresa");
		$direccion= $this->input->post("direccion");
		$telefono= $this->input->post("telefono");
		$email= $this->input->post("email");
		$nomrepresentante= $this->input->post("nomrepresentante"); 	 	
		$rucrepresentante= $this->input->post("rucrepresentante");	
		$fecgra= date("Y-m-d H:i:s");
		
	
		//traemos datos para no duplicarlos
		$empresas_actual = $this->Empresas_model->getEmpresas($codempresa);

		if($desempresa == $empresa_actual->desempresa)
		{
			$unique = '';
		}
		else
		{	
			//si encontro datos, emitira mensaje que ya existe.. llamando a tabla y luego campo
			$unique = '|is_unique[empresa.desempresa]';
		}
		//validar
		$this->form_validation->set_rules("desempresa", "Nombre", "required".$unique);

		if($this->form_validation->run())
		{
			//indicar campos de la tabla a modificar
			$data = array(
				'nomfantasia'     =>  $nomfantasia,
				'nomcontribuyente'     =>  $nomcontribuyente,
				'ruccontribuyente'     =>  $ruccontribuyente,
				'desempresa'     =>  $desempresa,
				'direccion'     =>  $direccion,
				'telefono'=>  $telefono,
				'email'=>  $email,
				'nomrepresentante'=>  $nomrepresentante,
				'fecgra'=>  $fecgra
			);
			if($this->Empresas_model->update($codempresa,$data))
			{
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."empresa/empresa", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."empresas/empresas/edit/".$codempresa);
			}
		}
		else
		{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
			$this->edit($codempresa);
		}
	}
	
	//funcion para borrar
	public function delete($id){
		$data = array(
		'estadoempresa' => '3',
		);
		if($this->Empresas_model->update($id,$data))
			{
				$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
				echo "empresas/empresas/";

				//redirect(base_url()."servicios/servicios", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
				redirect(base_url()."empresas/empresas/list/".$id);
			}
		
		
	}
}