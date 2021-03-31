<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivelestudio_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getNivelestudios(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("nivelestudio");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("nivelestudio", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getNivelestudio($id){
		$this->db->select("IDNIVEL,NUMNIVEL,DESNIVEL,FECGRABACION");
		$this->db->where("idnivel",$id);
		$resultado= $this->db->get("nivelestudio");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idnivel", $id);
		return $this->db->update("nivelestudio", $data);

	}

	public function validarExiste($numPais){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("nivelestudio");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idnivel) IS NULL THEN '1' ELSE max(idnivel) + 1 END) as MAXIMO");
		$this->db->from("nivelestudio");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idnivel) IS NULL THEN '01' when (max(idnivel) + 1) <= 9 then concat('0',(max(idnivel) + 1)) ELSE max(idnivel) + 1 END) as MAXIMO");
		$this->db->from("nivelestudio");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idnivel", $id);
		return $this->db->delete("nivelestudio");

	}
}