<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// si no esta logueado redireccionar a base url
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
	}

	public function index()
	{	
		//si ya esta logueado, que me cargue el controlador Dashboard
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('template/dashboard');
		$this->load->view('template/footer');
	}
}
