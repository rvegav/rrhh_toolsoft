<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudad_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getCiudades(){
		$this->db->select("C.IDCIUDAD,C.NUMCIUDAD,C.DESCIUDAD,C.FECGRABACION,IFNULL(C.IDDEPARTAMENTO,0) AS IDDEPARTAMENTO,IFNULL(D.DESDEPARTAMENTO,'') AS DESDEPARTAMENTO");
		$this->db->from("ciudad c");
		$this->db->join("departamento d", "d.iddepartamento = c.iddepartamento","left outer");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("ciudad", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getCiudad($id){
		$this->db->select("C.IDCIUDAD,C.NUMCIUDAD,C.DESCIUDAD,C.FECGRABACION,IFNULL(C.IDDEPARTAMENTO,0) AS IDDEPARTAMENTO,IFNULL(D.DESDEPARTAMENTO,'') AS DESDEPARTAMENTO");
		$this->db->from("ciudad c");
		$this->db->join("departamento d", "d.iddepartamento = c.iddepartamento","left outer");
		$this->db->where("c.idciudad",$id);
		$resultado= $this->db->get();
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idCiudad", $id);
		return $this->db->update("ciudad", $data);

	}

	public function delete($id){
		$this->db->where("idCiudad", $id);
		return $this->db->delete("ciudad");
	}

	public function validarExiste($numCiudad){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("ciudad");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idciudad) IS NULL THEN '1' ELSE max(idciudad) + 1 END) as MAXIMO");
		$this->db->from("ciudad");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idciudad) IS NULL THEN '01' when (max(idciudad) + 1) <= 9 then concat('0',(max(idciudad) + 1)) ELSE max(idciudad) + 1 END) as MAXIMO");
		$this->db->from("ciudad");
		$resultado= $this->db->get();
		return $resultado->result();
	}
}