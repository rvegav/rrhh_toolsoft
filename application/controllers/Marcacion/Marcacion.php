<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Marcacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Horario_model', 'Empleados_model', 'Marcacion_model'));
		$this->load->model("Usuarios_model");
		

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 3;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	public function index()
	{
		$this->comprobacionRoles();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('Marcaciones/Mapa');
		$this->load->view('template/footer');
	}
	public function cargaImportacion()
	{
		$this->comprobacionRoles();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('Marcaciones/importacionMarcacion');
		$this->load->view('template/footer');
	}
	public function procesarArchivo()
	{
		$this->comprobacionRoles();
		$name_file=$_FILES['userfile']['name'];
		$this->session->set_userdata('namearchivo',$name_file);
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'csv|xlsx|xls|txt|pdf';
		$config['max_size']             = 2048;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['overwrite']            = true;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$registros = $this->ReadFile();
			$datos = array();
			$array = array();
			if ($registros) {
				foreach ($registros as $registro) {
					$campos = explode('|', $registro);
					$empleado = $this->Empleados_model->getEmpleado($campos[0]);
					$array['EMPLEADO']= $empleado->EMPLEADO;
					$fecha = $campos[1].' '.$campos[2];
					$f= date_create($fecha);
					$array['FECHA_MARCACION']= date_format($f,"d/m/Y h:i:s") ;
					$array['AM_PM']= $campos[3];
					$datos[]=$array;
				}
				$data= $datos;
			}else{
				$data= [];
			}
			return $this->output->set_output(json_encode($data));

		}
	}

	public function insertarMarcaciones()
	{
		$this->comprobacionRoles();
		$registros = $this->ReadFile();
		$datos = array();
		$fecha = '';
		if ($registros) {				
			foreach ($registros as $registro) {
				$campos = explode('|', $registro);
				$fecha = $campos[1];

				$empleado = $this->Empleados_model->getEmpleado($campos[0]);
				// $array['EMPLEADO']= $empleado->EMPLEADO;
				$fecha_marcacion = $campos[1].' '.$campos[2];
				if ($campos[3] == 'EA') {
					$array['ENTRADAAM']= $fecha_marcacion ;
				}
				if ($campos[3] == 'SA') {
					$array['SALIDAAM']= $fecha_marcacion ;
				}
				if ($campos[3] == 'EP') {
					$array['ENTRADAPM']= $fecha_marcacion ;
				}
				if ($campos[3] == 'SP') {
					$array['SALIDAPM']= $fecha_marcacion ;
				}
				$this->Marcacion_model->insertMarcacion($empleado->IDEMPLEADO, $array, $campos[1]);
			}
			return true;
		}
		
	}
	private function ReadFile()
	{
		// if ($this->session->userdata('sist_conex')=="A") {
		$name_file=$this->session->userdata('namearchivo');
		$directorio = './uploads/';
		$ficheros  = scandir($directorio, 1);
		$posicion='';
		while ($nombre_archivo = current($ficheros)) {
			if ($nombre_archivo == $name_file) {
				$posicion=key($ficheros);
			}
			next($ficheros);
		}
		$file=file_get_contents($directorio.$ficheros[$posicion]);
		$registros= explode(PHP_EOL, $file);
		return $registros;
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	
}
