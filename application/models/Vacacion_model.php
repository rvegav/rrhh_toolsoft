<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacacion_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getVacaciones(){
		$this->db->select("IDVACACION,IDEMPRESA,DESDE,HASTA,CANTIDADDIAS,FECGRABACION");
		$this->db->order_by("FECGRABACION", "desc");
		$resultados= $this->db->get("escalavacaciones");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("escalavacaciones", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getVacacion($id){
		$this->db->select("IDVACACION,IDEMPRESA,DESDE,HASTA,CANTIDADDIAS,FECGRABACION");
		$this->db->where("idvacacion",$id);
		$resultado= $this->db->get("escalavacaciones");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idvacacion", $id);
		return $this->db->update("escalavacaciones", $data);

	}

	public function validarExiste($num){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("escalavacaciones");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idvacacion) IS NULL THEN '1' ELSE max(idvacacion) + 1 END) as MAXIMO");
		$this->db->from("escalavacaciones");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idvacacion) IS NULL THEN '01' when (max(idvacacion) + 1) <= 9 then concat('0',(max(idvacacion) + 1)) ELSE max(idvacacion) + 1 END) as MAXIMO");
		$this->db->from("escalavacaciones");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idvacacion", $id);
		return $this->db->delete("escalavacaciones");

	}
}