<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feriado_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getFeriados(){
		$this->db->select("IDFERIADO,IDEMPRESA,FECHAFERIADO AS FECHA,DESCFERIADO AS MOTIVO,FECGRABACION");
		$this->db->order_by("FECGRABACION", "asc");
		$resultados= $this->db->get("feriados");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("feriados", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getFeriado($id){
		$this->db->select("IDFERIADO,IDEMPRESA,FECHAFERIADO as FECHA,DESCFERIADO AS MOTIVO,FECGRABACION");
		$this->db->where("idferiado",$id);
		$resultado= $this->db->get("feriados");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idferiado", $id);
		return $this->db->update("feriados", $data);

	}

	public function validarExiste($num){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("feriados");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idferiado) IS NULL THEN '1' ELSE max(idferiado) + 1 END) as MAXIMO");
		$this->db->from("feriados");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idferiado) IS NULL THEN '01' when (max(idferiado) + 1) <= 9 then concat('0',(max(idferiado) + 1)) ELSE max(idferiado) + 1 END) as MAXIMO");
		$this->db->from("feriados");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idferiado", $id);
		return $this->db->delete("feriados");

	}
}