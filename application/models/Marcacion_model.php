<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcacion_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getMarcacionEmpleados($empleado = false, $fecha = false){
		$this->db->select('ENTRADAAM, SALIDAAM, ENTRADAPM, SALIDAPM, IDMARCACIONEMPLEADO');
		$this->db->from('marcacionempleado');
		$this->db->where("STR_TO_DATE(ENTRADAAM, '%Y-%m-%d')=", $fecha);
		$this->db->where('IDEMPLEADO', $empleado);
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}

	public function insertMarcacion($empleado = false, $data = false, $fecha_marcacion = false){
		$marcacion = $this->getMarcacionEmpleados($empleado, $fecha_marcacion);
		if ($marcacion) {
			$this->db->where('idmarcacionempleado', $marcacion->IDMARCACIONEMPLEADO);
			return $this->db->update('marcacionempleado', $data);			
		}else{
			$id = $this->ultimoNumero();
			$this->db->set('idmarcacionempleado', $id->MAXIMO, FALSE);
			$this->db->set('IDEMPLEADO', $empleado, FALSE);
			return $this->db->insert('marcacionempleado', $data);
		}
	}
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idmarcacionempleado) IS NULL THEN '1' ELSE max(idmarcacionempleado) + 1 END) as MAXIMO");
		$this->db->from("marcacionempleado");
		$resultado= $this->db->get();
		return $resultado->row();
	}
}

/* End of file Marcacion_model.php */
/* Location: ./application/models/Marcacion_model.php */