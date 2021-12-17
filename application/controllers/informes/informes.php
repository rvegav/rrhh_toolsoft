<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class informes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Empleados_model', 'Sucursal_model', 'Procesocierres_model', 'Hijos_model'));
		// $this->dompdf = new Dompdf();
		$this->load->library('pdf');
		$options = new Dompdf\Options();
		$options->setIsRemoteEnabled(true);
		$options->setIsPhpEnabled(true);
		$this->dompdf = new Dompdf\Dompdf($options);
	}

	public function listaEmpleados(){
		$data = array('empleados'=> $this->Empleados_model->getEmpleados(),
			'sucursales'=> $this->Sucursal_model->getSucursales());
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('informes/lista_empleados', $data);
		$this->load->view('template/footer');
	}
	public function listaSueldos(){
		$meses = array( ['id'=>1, 'NOMBRE' => 'ENERO'],
						['id'=>2, 'NOMBRE' => 'FEBRERO'],
						['id'=>3, 'NOMBRE' => 'MARZO'],
						['id'=>4, 'NOMBRE' => 'ABRIL'],
						['id'=>5, 'NOMBRE' => 'MAYO'],
						['id'=>6, 'NOMBRE' => 'JUNIO'],
						['id'=>7, 'NOMBRE' => 'JULIO'],
						['id'=>8, 'NOMBRE' => 'AGOSTO'],
						['id'=>9, 'NOMBRE' => 'SEPTIEMBRE'],
						['id'=>10, 'NOMBRE' => 'OCTUBRE'],
						['id'=>11, 'NOMBRE' => 'NOVIEMBRE'],
						['id'=>12, 'NOMBRE' => 'DICIEMBRE'],
						['id'=>13, 'NOMBRE' => 'AGUINALDO'] );
		$data = array('empleados'=> $this->Empleados_model->getEmpleados(),
			'sucursales'=> $this->Sucursal_model->getSucursales(), 'meses'=>$meses);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('informes/lista_sueldos', $data);
		$this->load->view('template/footer');
	}
	public function resumenSueldos(){
		$meses = array( ['id'=>1, 'NOMBRE' => 'ENERO'],
						['id'=>2, 'NOMBRE' => 'FEBRERO'],
						['id'=>3, 'NOMBRE' => 'MARZO'],
						['id'=>4, 'NOMBRE' => 'ABRIL'],
						['id'=>5, 'NOMBRE' => 'MAYO'],
						['id'=>6, 'NOMBRE' => 'JUNIO'],
						['id'=>7, 'NOMBRE' => 'JULIO'],
						['id'=>8, 'NOMBRE' => 'AGOSTO'],
						['id'=>9, 'NOMBRE' => 'SEPTIEMBRE'],
						['id'=>10, 'NOMBRE' => 'OCTUBRE'],
						['id'=>11, 'NOMBRE' => 'NOVIEMBRE'],
						['id'=>12, 'NOMBRE' => 'DICIEMBRE'],
						['id'=>13, 'NOMBRE' => 'AGUINALDO'] );
		$data = array('empleados'=> $this->Empleados_model->getEmpleados(),
			'sucursales'=> $this->Sucursal_model->getSucursales(), 'meses'=>$meses);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('informes/resumen_sueldo', $data);
		$this->load->view('template/footer');
	}
	public function resumenOcupadas(){
		$data = array('empleados'=> $this->Empleados_model->getEmpleados(),
			'sucursales'=> $this->Sucursal_model->getSucursales());
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('informes/resumen_ocupadas', $data);
		$this->load->view('template/footer');
	}
	public function listadoHijos(){
		$data = array('empleados'=> $this->Empleados_model->getEmpleados(),
			'sucursales'=> $this->Sucursal_model->getSucursales());
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('informes/lista_hijos', $data);
		$this->load->view('template/footer');
	}
	public function informeEmpleado(){
		$archivo = 'reporte'.date('dmY');
		$fecha = date("d/m/Y H:i:s");
		$parametros['ingreso'] = $this->input->post('fechaIngreso', TRUE);
		$parametros['salida'] = $this->input->post('fechaEgreso', TRUE);
		$parametros['empleado'] = $this->input->post('empleado', TRUE);
		$parametros['sucursal'] = $this->input->post('sucursal', TRUE);
		$parametros['estado'] = $this->input->post('estado', TRUE);
		$data = array('empleados'=> $this->Empleados_model->getEmpleadosInforme($parametros), 'hijos'=>$this->Hijos_model->getHijos(),
			'fecha' =>$fecha);
		$cuerpo = $this->load->view('informes/reporte_lista_empleado', $data, TRUE);
		$this->dompdf->load_html($cuerpo);
		$this->dompdf->set_paper('Legal','landscape');

		// $this->load->view('informes/prueba_pdf', $data);

		$this->dompdf->render();


		if ($stream=TRUE) {
			$this->dompdf->stream("$archivo", array("Attachment" => 0));
		} else {
			return $this->dompdf->output();
		}
		
	}
	public function resumenEmpleado(){
		$archivo = 'reporte'.date('dmY');
		$fecha = date("d/m/Y H:i:s");
		$parametros['ingreso'] = $this->input->post('fechaIngreso', TRUE);
		$parametros['salida'] = $this->input->post('fechaEgreso', TRUE);
		$parametros['empleado'] = $this->input->post('empleado', TRUE);
		$parametros['sucursal'] = $this->input->post('sucursal', TRUE);
		$parametros['estado'] = $this->input->post('estado', TRUE);
		$data = array('empleados'=> $this->Empleados_model->getEmpleadosInforme($parametros),
			'fecha' =>$fecha);
		$cuerpo = $this->load->view('informes/reporte_resumen_empleado', $data, TRUE);
		$this->dompdf->load_html($cuerpo);
		$this->dompdf->set_paper('Legal','portrait');

		// $this->load->view('informes/prueba_pdf', $data);

		$this->dompdf->render();


		if ($stream=TRUE) {
			$this->dompdf->stream("$archivo", array("Attachment" => 0));
		} else {
			return $this->dompdf->output();
		}
		
	}
	public function informeSueldo(){
		$archivo = 'reporte'.date('dmY');
		$fecha = date("d/m/Y H:i:s");
		$empleado = $this->input->post('empleado', TRUE);
		$mesdesde = $this->input->post('desde', TRUE);
		$meshasta = $this->input->post('hasta', TRUE);
		$sucursal = $this->input->post('sucursal', TRUE);
		// Acá se me manda las variables
		$data = array('sueldos'=> $this->Empleados_model->getListadoSalarios($parametros),
			'fecha' =>$fecha);
		$cuerpo = $this->load->view('informes/reporte_informe_sueldo', $data, TRUE);
		$this->dompdf->load_html($cuerpo);
		$this->dompdf->set_paper('Legal','portrait');

		// $this->load->view('informes/prueba_pdf', $data);

		$this->dompdf->render();


		if ($stream=TRUE) {
			$this->dompdf->stream("$archivo", array("Attachment" => 0));
		} else {
			return $this->dompdf->output();
		}
		
	}
	public function resumenSalario(){
		$archivo = 'reporte'.date('dmY');
		$fecha = date("d/m/Y H:i:s");
		$parametros['ingreso'] = $this->input->post('fechaIngreso', TRUE);
		$parametros['salida'] = $this->input->post('fechaEgreso', TRUE);
		$parametros['empleado'] = $this->input->post('empleado', TRUE);
		$parametros['sucursal'] = $this->input->post('sucursal', TRUE);
		$parametros['estado'] = $this->input->post('estado', TRUE);
		$data = array('empleados'=> $this->Empleados_model->getEmpleadosInforme($parametros),
			'fecha' =>$fecha);
		$cuerpo = $this->load->view('informes/reporte_resumen_salario', $data, TRUE);
		$this->dompdf->load_html($cuerpo);
		$this->dompdf->set_paper('Legal','portrait');

		// $this->load->view('informes/prueba_pdf', $data);

		$this->dompdf->render();


		if ($stream=TRUE) {
			$this->dompdf->stream("$archivo", array("Attachment" => 0));
		} else {
			return $this->dompdf->output();
		}
		
	}
	public function informeHijos(){
		$archivo = 'reporte'.date('dmY');
		$fecha = date("d/m/Y H:i:s");
		$empleado = $this->input->post('empleado');
		$sucursal = $this->input->post('sucursal');
		$data = array('hijos'=> $this->Hijos_model->getHijosEmpleadoSucursal($empleado, $sucursal),
			'fecha' =>$fecha);
		$cuerpo = $this->load->view('informes/reporte_listado_hijos', $data, TRUE);
		$this->dompdf->load_html($cuerpo);
		$this->dompdf->set_paper('Legal','portrait');

		// $this->load->view('informes/prueba_pdf', $data);

		$this->dompdf->render();


		if ($stream=TRUE) {
			$this->dompdf->stream("$archivo", array("Attachment" => 0));
		} else {
			return $this->dompdf->output();
		}
		
	}
	public function informeLibroDiario(){
		$this->form_validation->set_rules("FECHADESDE", "Fecha Desde", "required");
		$this->form_validation->set_rules("FECHAHASTA", "Fecha Hasta", "required");
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url()."informediarios/informediarios/add", "refresh");

		}else{
			$archivo = 'reporte'.date('dmY');
			$fecha = date("d/m/Y H:i:s");
			$desde = $this->input->post('FECHADESDE', TRUE);
			$hasta = $this->input->post('FECHAHASTA', TRUE);
			$desde=date_format(date_create($desde),"d/m/Y");;
			$hasta=date_format(date_create($hasta),"d/m/Y");;
			$data = array('asientos'=> $this->Procesocierres_model->getAsiento($desde,$hasta),
				'detallesasientos'=>$this->Procesocierres_model->getAsientoDetalle($desde, $hasta),
				'fecha' =>$fecha,
				'desde' => $desde,
				'hasta' =>$hasta);
			$cuerpo = $this->load->view('informes/informe_libro_diario', $data, TRUE);
			$this->dompdf->load_html($cuerpo);
			$this->dompdf->set_paper('Legal','portrait');

			// $this->load->view('informes/prueba_pdf', $data);

			$this->dompdf->render();


			if ($stream=TRUE) {
				$this->dompdf->stream("$archivo", array("Attachment" => 0));
			} else {
				return $this->dompdf->output();
			}
			

		}
	}
}

/* End of file informes.php */
/* Location: ./application/controllers/informes.php */