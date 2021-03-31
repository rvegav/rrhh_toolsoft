<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hijos_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getHijos($id_padre){
		$this->db->select('idhijo, nombre, apellido, fecnacimiento');
		$this->db->from('hijos');
		$this->db->where('idemppledo', $id_padre);
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	public function save($data){
		return $this->db->insert("hijos", $data);
	}
}

/* End of file  */
/* Location: ./application/models/ */