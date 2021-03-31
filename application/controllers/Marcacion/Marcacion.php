<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('Marcaciones/Mapa');
		$this->load->view('template/footer');
	}
	public function get(){
		var_dump($_POST);
	}

}
	