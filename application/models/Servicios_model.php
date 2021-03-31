<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los servicios
	public function getServicios(){
	//	$this->db->where("estServicio", "1");
		$resultados= $this->db->get("servicio");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("servicio", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 servicio por id
	public function getServicio($id){
		$this->db->where("idServicio",$id);
		$resultado= $this->db->get("servicio");
		return $resultado->row();
	}
	//esto es para actualizar los servicios
	public function update($id, $data){
		$this->db->where("idServicio", $id);
		return $this->db->update("servicio", $data);

	}
}