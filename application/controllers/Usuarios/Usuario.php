<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Empleados_model");
		$this->load->model("Usuarios_model", "Rol_model");

	}

	public function index()
	{
		$data['usuarios'] = $this->Usuarios_model->getUsuarios();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('usuarios/list', $data);
		$this->load->view('template/footer');
	}
	public function add(){
		$data['empleados'] = $this->Empleados_model->getEmpleados();
		// $data['roles']= $this->Rol_model->; 
		// var_dump($data);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('usuarios/add', $data);
		$this->load->view('template/footer');
	}
}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */