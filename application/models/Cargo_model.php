<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getCargos(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("cargo");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("cargo", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getCargo($id){
		$this->db->select("IDCARGO,NUMCARGO,DESCARGO,FECGRABACION");
		$this->db->where("idcargo",$id);
		$resultado= $this->db->get("cargo");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idcargo", $id);
		return $this->db->update("cargo", $data);

	}

	public function validarExiste($numCargo){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("cargo");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idcargo) IS NULL THEN '1' ELSE max(idcargo) + 1 END) as MAXIMO");
		$this->db->from("cargo");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idcargo) IS NULL THEN '01' when (max(idcargo) + 1) <= 9 then concat('0',(max(idcargo) + 1)) ELSE max(idcargo) + 1 END) as MAXIMO");
		$this->db->from("cargo");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idcargo", $id);
		return $this->db->delete("cargo");

	}
}