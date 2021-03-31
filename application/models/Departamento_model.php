<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getDepartamentos(){
		$this->db->select("D.IDDEPARTAMENTO,D.NUMDEPARTAMENTO,D.DESDEPARTAMENTO,D.IDUSUARIO,D.FECGRABACION,IFNULL(D.IDPAIS,0) AS IDPAIS,
			IFNULL(P.DESPAIS,'') AS DESPAIS");		
		$this->db->from("departamento d");
		$this->db->join("pais p","p.idpais = d.idpais","left outer");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("departamento", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getDepartamento($id){
		$this->db->select("D.IDDEPARTAMENTO,D.NUMDEPARTAMENTO,D.DESDEPARTAMENTO,D.IDUSUARIO,D.FECGRABACION,IFNULL(D.IDPAIS,0) AS IDPAIS,
			IFNULL(P.DESPAIS,'') AS DESPAIS");		
		$this->db->from("departamento d");
		$this->db->join("pais p","p.idpais = d.idpais","left outer");
		$this->db->where("iddepartamento",$id);
		$resultado= $this->db->get();
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("iddepartamento", $id);
		return $this->db->update("departamento", $data);

	}

	public function validarExiste($numDepartamento){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("departamento");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(iddepartamento) IS NULL THEN '1' ELSE max(iddepartamento) + 1 END) as MAXIMO");
		$this->db->from("departamento");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(iddepartamento) IS NULL THEN '01' when (max(iddepartamento) + 1) <= 9 then concat('0',(max(iddepartamento) + 1)) ELSE max(iddepartamento) + 1 END) as MAXIMO");
		$this->db->from("departamento");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("iddepartamento", $id);
		return $this->db->delete("departamento");

	}
}