<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiposalario_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getTiposalarios(){
		$this->db->select("IDTIPOSALARIO,NUMTIPOSALARIO,DESTIPOSALARIO,FORMAT(cast(IFNULL(IMPORTE,0) as UNSIGNED), 0, 'de_DE') AS IMPORTE,FECGRABACION");
		$resultados= $this->db->get("tiposalario");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("tiposalario", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getTiposalario($id){
		$this->db->select("IDTIPOSALARIO,NUMTIPOSALARIO,DESTIPOSALARIO,FORMAT(cast(IFNULL(IMPORTE,0) as UNSIGNED), 0, 'de_DE') AS IMPORTE,FECGRABACION");
		$this->db->where("idtiposalario",$id);
		$resultado= $this->db->get("tiposalario");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idtiposalario", $id);
		return $this->db->update("tiposalario", $data);

	}

	public function validarExiste($num){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("tiposalario");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idtiposalario) IS NULL THEN '1' ELSE max(idtiposalario) + 1 END) as MAXIMO");
		$this->db->from("tiposalario");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idtiposalario) IS NULL THEN '01' when (max(idtiposalario) + 1) <= 9 then concat('0',(max(idtiposalario) + 1)) ELSE max(idtiposalario) + 1 END) as MAXIMO");
		$this->db->from("tiposalario");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idtiposalario", $id);
		return $this->db->delete("tiposalario");

	}
}