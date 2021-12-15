<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class pagos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Empleados_model', 'Movimientos_model'));
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
			$desde = $this->input->post('fechadesde', TRUE);
			$hasta = $this->input->post('fechahasta', TRUE);
			// $mensajes['correcto'] = '<b style="color:green"> Todo bien hasta acá</b>';
			if ($movimiento=='1') {
				$concepto = 'IPS';
			}elseif ($movimiento =='2') {
				$concepto = 'SALARIO';
			}else{
				$concepto = 'AGUINALDO';
			}
			$file = fopen($concepto.".txt", "w");
			$empleados = $this->Empleados_model->getEmpleados(true);
			foreach ($empleados as $empleado) {
				$monto = 0;
				if ($concepto =='SALARIO') {
					$total_movimientos_suma = $this->Movimientos_model->getTotalMovimientosSuma($empleado->IDEMPLEADO, $desde, $hasta, false);
					$total_movimientos_resta = $this->Movimientos_model->getTotalMovimientosResta($empleado->IDEMPLEADO, $desde, $hasta);
					$monto = $total_movimientos_suma->IMPORTE - $total_movimientos_resta->IMPORTE;
					$nroCuenta = $empleado->NROCUENTA;
				}
				if ($concepto =='IPS') {
					$monto = $this->Movimientos_model->getTotalMovimientos($empleado->IDEMPLEADO, $desde, $hasta, $concepto);
					$monto = $monto->IMPORTE;
					$nroCuenta = $empleado->NUMEROIPS;
				}
				if ($concepto=='AGUINALDO') {
					$tipoMovimientos = $this->Movimientos_model->getTipoMovimientos(false, false, '+');
					foreach ($tipoMovimientos as $tipoMovimiento) {
						$concepto = $tipoMovimiento->DESC;
						$total_por_tipo = $this->Movimientos_model->getTotalMovimientos($empleado->IDEMPLEADO, $desde, $hasta, $concepto);
						$monto = $monto + ($total_por_tipo->IMPORTE/12)*$total_por_tipo->CANTIDAD;
					}
					$nroCuenta = $empleado->NROCUENTA;
					$concepto = 'AGUINALDO';
				}
				fwrite($file, $empleado->CEDULAIDENTIDAD.','.$nroCuenta.','.$monto.PHP_EOL);
			}
			fclose($file);
			$mensajes['correcto'] =$concepto;
		}
		echo json_encode($mensajes);

	}
	public function descargaArchivos($name){
		var_dump($name);
		$fileName = $name.".txt";
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