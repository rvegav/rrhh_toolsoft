<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentoempresa_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getDepartamentoempresas(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("departamentoempresa");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("departamentoempresa", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getDepartamentoempresa($id){
		$this->db->select("IDDEPARTAMENTO,NUMDEPARTAMENTO,DESDEPARTAMENTO,IDEMPRESA,FECGRABACION");
		$this->db->where("iddepartamento",$id);
		$resultado= $this->db->get("departamentoempresa");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("iddepartamento", $id);
		return $this->db->update("departamentoempresa", $data);

	}

	public function validarExiste($numDepartamento){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("departamentoempresa");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(iddepartamento) IS NULL THEN '1' ELSE max(iddepartamento) + 1 END) as MAXIMO");
		$this->db->from("departamentoempresa");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(iddepartamento) IS NULL THEN '01' when (max(iddepartamento) + 1) <= 9 then concat('0',(max(iddepartamento) + 1)) ELSE max(iddepartamento) + 1 END) as MAXIMO");
		$this->db->from("departamentoempresa");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("iddepartamento", $id);
		return $this->db->delete("departamentoempresa");

	}
}