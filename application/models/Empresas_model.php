<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getEmpresas(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("empresa");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("empresa", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getEmpresa($id){
		$this->db->where("codempresa",$id);
		$resultado= $this->db->get("empresa");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("codempresa", $id);
		return $this->db->update("empresa", $data);

	}
}