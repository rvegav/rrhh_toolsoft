<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pais_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getPaises(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("pais");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("pais", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getPais($id){
		$this->db->select("IDPAIS,NUMPAIS,DESPAIS,FECGRABACION");
		$this->db->where("idpais",$id);
		$resultado= $this->db->get("pais");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idpais", $id);
		return $this->db->update("pais", $data);

	}

	public function validarExiste($numPais){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("pais");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idpais) IS NULL THEN '1' ELSE max(idpais) + 1 END) as MAXIMO");
		$this->db->from("pais");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idpais) IS NULL THEN '01' when (max(idpais) + 1) <= 9 then concat('0',(max(idpais) + 1)) ELSE max(idpais) + 1 END) as MAXIMO");
		$this->db->from("pais");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idpais", $id);
		return $this->db->delete("pais");

	}
}