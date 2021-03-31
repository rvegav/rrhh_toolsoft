<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

		public function index()
	{
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('template/dashboard');
		$this->load->view('template/footer');
	}
}
