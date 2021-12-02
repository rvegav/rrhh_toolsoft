<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadocivil_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getEstadociviles(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("estadocivil");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("estadocivil", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getEstadocivil($id){
		$this->db->select("IDCIVIL,NUMCIVIL,DESCCIVIL,FECGRABACION");
		$this->db->where("idcivil",$id);
		$resultado= $this->db->get("estadocivil");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idcivil", $id);
		return $this->db->update("estadocivil", $data);

	}

	public function validarExiste($numCivil){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("estadocivil");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idcivil) IS NULL THEN '1' ELSE max(idcivil) + 1 END) as MAXIMO");
		$this->db->from("estadocivil");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idcivil) IS NULL THEN '01' when (max(idcivil) + 1) <= 9 then concat('0',(max(idcivil) + 1)) ELSE max(idcivil) + 1 END) as MAXIMO");
		$this->db->from("estadocivil");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idcivil", $id);
		return $this->db->delete("estadocivil");

	}
}