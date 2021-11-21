<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Liquidacion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Empleados_model', 'Faltas_model', 'Movimientos_model'));
	}
	
	public function insertMovimientoAusencia(){
		$mes = $this->input->post('mes', TRUE);
		$empleados = $this->Empleados_model->getEmpleados();

		$faltas = $this->Faltas_model->getFaltasEmpleados(false, false, $mes);

		if ($faltas) {
			$data['FECHAMOVI'] = date("Y-m-d");
			$data['IDMONEDA'] = 1;
			$data['IDEMPRESA'] = 1;
			$tipoMovimiento = $this->Movimientos_model->getTipoMovimiento(false, 'DESCUENTO AUSENCIA');
			$data['IDTIPOMOVISUELDO'] = $tipoMovimiento->IDTIPOMOVISUELDO;
			$data['FECGRABACION'] = date("Y-m-d");
			$movimiento = $this->Movimientos_model->save($data);
		}
		if (isset($movimiento)) {
			foreach ($empleados as $empleado) {
				$tipo_falta = $this->Faltas_model->getTipoFaltas(false, 'AUSENCIA');
				$faltaEmpleado = $this->Faltas_model->getTotalFaltasEmpleado($empleado->IDEMPLEADO, $mes, $tipo_falta->idfaltas );
				if ($faltaEmpleado) {
					$jornal = $empleado->MONTOASIGNADO/30;
					$monto_falta = $faltaEmpleado->cant_faltas * $jornal;
					$datos['IDEMPLEADO'] = $empleado->IDEMPLEADO;
					$datos['IMPORTE'] = $monto_falta;
					$datos['IDMOVI']= $movimiento;
					$datos['OBSERVACION'] = '';
					$datos['GENERADO'] = 1;
					$datos['FECGRABACION'] = date("Y-m-d");
					$detalle = $this->Movimientos_model->save_detalle($datos);			
				}
			}
		}
	}

}