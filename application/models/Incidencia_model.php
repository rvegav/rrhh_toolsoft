<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencia_model extends CI_Model {
	public function getTipoIncidencias($id = false){
		$this->db->select('IDTIPOINCIDENCIA, NUMINCIDENCIA, DESCINCIDENCIA, DATE_FORMAT(FECGRABACION,"%d/%m/%Y") FECHAGRABACION');
		$this->db->from('tipoincidencia');
		if ($id) {
			$this->db->where('IDTIPOINCIDENCIA', $id);
		}
		$resultado = $this->db->get();
		if ($resultado->num_rows()>0) {
			if ($id) {
				return $resultado->row();
			}
			return $resultado->result();
		}else{
			return false;
		}
	}
	public function save($data){
		return $this->db->insert('tipoincidencia', $data);
	}
	public function update($data, $id){
		$this->db->where('IDTIPOINCIDENCIA', $id);
		return $this->db->update('tipoincidencia', $data);

	}
	public function obtenerUltimoNro(){
	    $this->db->select("(CASE WHEN  max(NUMINCIDENCIA) IS NULL THEN '01' when (max(NUMINCIDENCIA) + 1) <= 9 then concat('0',(max(NUMINCIDENCIA) + 1)) ELSE max(NUMINCIDENCIA) + 1 END) as MAXIMO");
		$this->db->from("tipoincidencia");
		$resultado= $this->db->get();
		return $resultado->row();
	}
	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(IDTIPOINCIDENCIA) IS NULL THEN '1' ELSE max(IDTIPOINCIDENCIA) + 1 END) as MAXIMO");
		$this->db->from("tipoincidencia");
		$resultado= $this->db->get();
		return $resultado->row();
	}
	public function delete($id){
		$this->db->where("IDTIPOINCIDENCIA", $id);
		return $this->db->delete("tipoincidencia");
	}

}