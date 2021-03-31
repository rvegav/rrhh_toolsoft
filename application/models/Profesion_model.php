<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesion_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getProfesiones(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("profesion");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("profesion", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getProfesion($id){
		$this->db->select("IDPROFESION,NUMPROFESION,DESPROFESION,FECGRABACION");
		$this->db->where("idprofesion",$id);
		$resultado= $this->db->get("profesion");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idprofesion", $id);
		return $this->db->update("profesion", $data);

	}

	public function validarExiste($numPais){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("profesion");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idprofesion) IS NULL THEN '1' ELSE max(idprofesion) + 1 END) as MAXIMO");
		$this->db->from("profesion");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idprofesion) IS NULL THEN '01' when (max(idprofesion) + 1) <= 9 then concat('0',(max(idprofesion) + 1)) ELSE max(idprofesion) + 1 END) as MAXIMO");
		$this->db->from("profesion");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idprofesion", $id);
		return $this->db->delete("profesion");

	}
}