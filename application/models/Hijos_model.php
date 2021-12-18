<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hijos_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getHijos($id_padre = false){
		$this->db->select('idhijo, nombre, apellido, fecnacimiento, idempleado');
		$this->db->from('hijos');
		if ($id_padre) {
			$this->db->where('idempleado', $id_padre);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	public function getHijosEmpleadoSucursal($id_padre = false, $sucursal = false){
		$this->db->select('idhijo, CONCAT(h.NOMBRE," ", h.APELLIDO) NOMBRE_HIJO, h.fecnacimiento FECHA_NACIMIENTO_HIJO, e.IDEMPLEADO, CONCAT(e.NOMBRE," ", e.APELLIDO) as NOMBRE_PADRE, e.CEDULAIDENTIDAD CEDULA_PADRE');
		$this->db->from('hijos h');
		$this->db->join('empleado e', 'e.idempleado = h.idempleado');
		if ($id_padre) {
			$this->db->where('e.IDEMPLEADO', $id_padre);
		}
		if ($sucursal) {
			$this->db->where('e.IDSUCURSAL', $sucursal);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	public function save($data){
		$this->db->where('idempleado', $data['idempleado']);
		$this->db->where('idempresa', $data['idempresa']);
		$this->db->where('nombre', $data['nombre']);
		$this->db->where('apellido', $data['apellido']);
		$this->db->where('fecnacimiento', $data['fecnacimiento']);
		$consulta = $this->db->get('hijos');
		if ($consulta->num_rows() ==0) {
			return $this->db->insert("hijos", $data);
		}else{
			return false;
		}

	}
}

/* End of file  */
/* Location: ./application/models/ */