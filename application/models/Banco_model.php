<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banco_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getBancos(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("banco");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("banco", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getBanco($id){
		$this->db->select("IDBANCO,NUMBANCO,DESBANCO,DIRECCION,WEB,TELEFONO,EMAIL,FECGRABACION");
		$this->db->where("idbanco",$id);
		$resultado= $this->db->get("banco");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idbanco", $id);
		return $this->db->update("banco", $data);

	}

	public function validarExiste($numBanco){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("banco");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idbanco) IS NULL THEN '1' ELSE max(idbanco) + 1 END) as MAXIMO");
		$this->db->from("banco");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idbanco) IS NULL THEN '01' when (max(idbanco) + 1) <= 9 then concat('0',(max(idbanco) + 1)) ELSE max(idbanco) + 1 END) as MAXIMO");
		$this->db->from("banco");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idbanco", $id);
		return $this->db->delete("banco");

	}
}