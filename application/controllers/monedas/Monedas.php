<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Monedas extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
        parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

        $this->load->library(array('form_validation'));
		
		$this->load->model("Moneda_model");
	}
	//esta funcion es la primera que se cargar
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'monedas'=> $this->Moneda_model->getMonedas()
		);

//print_r($data); die();

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('monedas/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

$data = array(			
			  'maximos' => $this->Moneda_model->ObtenerCodigo(),
			  );

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('monedas/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($id)
	{
		$data = array (
			'moneda'=> $this->Moneda_model->getMoneda($id)
		);

		//print_r($data); die();
		//abrimos la vista view
		$this->load->view("monedas/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{

        //recibimos las variables
		//print_r($_POST); die();
        $numMoneda = $this->input->post("NumMoneda");
		$desMoneda = $this->input->post("DesMoneda");
		$simbolo = $this->input->post("Simbolo");		
		$prioridad = $this->input->post("inlineMaterialRadiosExample");		
		
		$idMoneda = $this->Moneda_model->ultimoNumero();


        if(!$this->input->post("Decimal"))
        {
        	$decimal = "0";
        }
        else
        {
        	$decimal = "1";	
        }

        //print_r($decimal); die();

        $time = time();
        $fechaActual = date("Y-m-d H:i:s",$time);

        $empresa = $_SESSION["Empresa"];
        $sucursal = $_SESSION["Sucursal"];
        $usuario = $_SESSION["usuario"];		
		
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada

			$data = array(
				'idmoneda'  => $idMoneda->MAXIMO,
				'nummoneda'  => $numMoneda,
				'desmoneda'  => $desMoneda,
				'simbolo' => $simbolo,
				'decimales'  => $decimal,
				'prioridad' => $prioridad,
				'fecgrabacion' => $fechaActual
			);

			$existe = $this->Moneda_model->validarExiste($numMoneda);
			$existeSimbolo = $this->Moneda_model->validarSimbolo($simbolo, $idMoneda->MAXIMO);
			
			//Valida que no exista ni el num ni el simbolo
          if($existe->cantidad == "0" && $existeSimbolo->cantidad == "0")
          {

          	if($this->Moneda_model->save($data))
			{

				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Moneda registrada correctamente!');
				redirect(base_url()."monedas/monedas", "refresh");
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Moneda no registrada!');
				
				//redireccionamos
				redirect(base_url()."monedas/monedas/add", "refresh");
			}
          }
          else
          {
          		$this->session->set_flashdata('error', 'Moneda ya existe!');
				
				//redireccionamos
				redirect(base_url()."monedas/monedas/add", "refresh");
          }
			

	}
	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'moneda'=> $this->Moneda_model->getMoneda($id)
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('monedas/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 
	
	public function update()
	{
		$idMoneda= $this->input->post("IdMoneda");
		$numMoneda= $this->input->post("NumMoneda");
		$desMoneda= $this->input->post("DesMoneda");
		$simbolo= $this->input->post("Simbolo");
		$prioridad= $this->input->post("inlineMaterialRadiosExampl");

		//print_r($_POST); die();

		if(!$this->input->post("Decimal"))
        {
        	$decimal = "0";
        }
        else
        {
        	$decimal = "1";	
        }
		
		//indicar campos de la tabla a modificar
		$data = array(
				'desmoneda' => $desMoneda,
				'simbolo' => $simbolo,
				'decimales' => $decimal,
				'prioridad' => $prioridad
		);

		$existeSimbolo = $this->Moneda_model->validarSimbolo($simbolo, $idMoneda);
		//print_r($existeSimbolo); die();
		//Valida que no exista ni el num ni el simbolo
        if($existeSimbolo->cantidad == "0")
        {

		  if($this->Moneda_model->update($idMoneda,$data))
			{
				//print_r($idCiudad); die();
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				redirect(base_url()."monedas/monedas", "refresh");
			}
			else
			{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				redirect(base_url()."monedas/monedas/edit/".$idMoneda,"refresh");
			}		
		 }
         else
         {
         	$this->session->set_flashdata('error', 'Simbolo ya existe!');
			
			//redireccionamos
			redirect(base_url()."monedas/monedas/edit/".$idMoneda,"refresh");
         }

	}

public function delete($id){
		
	if($this->Moneda_model->delete($id)){
		$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					
		redirect(base_url()."/monedas/monedas", "refresh");
	}
	else
	{
		$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
		redirect(base_url()."/monedas/monedas", "refresh");		
	}

		
}


}