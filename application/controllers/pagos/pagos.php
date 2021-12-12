<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pagos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Empleados_model'));
		$this->data = array('correcto'=>'','alerta'=>'','error'=>'', 'datos'=>'');


	}

	public function index()
	{
		
	}

	public function cargarPantalla(){
		$data = array(
			'empleados'=> $this->Empleados_model->getEmpleados()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('pagos/generacion_archivo', $data);
		$this->load->view('template/footer');
	}

	public function generarArchivo(){
		$mensajes = $this->data;
		$this->form_validation->set_rules('movimiento', 'Tipo de Movimiento', 'required|trim|in_list[1,2,3]');
		$this->form_validation->set_rules('fechadesde', 'Fecha Desde', 'required');
		$this->form_validation->set_rules('fechahasta', 'Fecha Hasta', 'required');
		if ($this->form_validation->run()==false) {
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 
		}else {
			$movimiento = $this->input->post('movimiento', TRUE);
			$desde = $this->input->post('desde', TRUE);
			$hasta = $this->input->post('hasta', TRUE);
			$mensajes['correcto'] = '<b style="color:green"> Todo bien hasta acá</b>';
			if ($movimiento=='1') {
				$concepto = 'IPS';
			}elseif ($movimiento =='2') {
				$concepto = 'SALARIO';
			}else{
				$concepto = 'AGUINALDO';
			}
			$file = fopen($concepto.".txt", "w");
			$empleados = $this->Empleados_model->getEmpleadosActivos();
			foreach ($empleados as $empleado) {
				fwrite($file, $empleado->CEDULA.','. PHP_EOL);
				// code...
			}
			fclose($file);
			$mensajes['datos'] ="SALARIO.txt";
		}
		echo json_encode($mensajes);

	}
	public function descargarArchivos($name){
		$fileName = "SALARIO.txt";
		$filePath = FCPATH.'/'.$fileName;
		if(!empty($fileName) && file_exists($filePath)){
    			// Define headers
				// header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=".$fileName);
			header("Content-Type: text/txt");
			header("Content-Transfer-Encoding: binary");
			ob_clean();
			flush();
   				// Read the file
			readfile($filePath);
			exit;
		}else{
			echo 'El archivo no existe.';
		}
	}

}

/* End of file pagos.php */
/* Location: ./application/controllers/pagos.php */