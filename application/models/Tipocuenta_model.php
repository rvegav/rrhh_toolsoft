<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipocuenta_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getTipocuentas(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("tipocuenta");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("tipocuenta", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getTipocuenta($id){
		$this->db->select("IDTIPOCUENTA,NUMTIPOCUENTA,DESTIPOCUENTA,FECGRABACION");
		$this->db->where("idtipocuenta",$id);
		$resultado= $this->db->get("tipocuenta");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idtipocuenta", $id);
		return $this->db->update("tipocuenta", $data);

	}

	public function validarExiste($numTipocuenta){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("tipocuenta");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idtipocuenta) IS NULL THEN '1' ELSE max(idtipocuenta) + 1 END) as MAXIMO");
		$this->db->from("tipocuenta");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idtipocuenta) IS NULL THEN '01' when (max(idtipocuenta) + 1) <= 9 then concat('0',(max(idtipocuenta) + 1)) ELSE max(idtipocuenta) + 1 END) as MAXIMO");
		$this->db->from("tipocuenta");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idtipocuenta", $id);
		return $this->db->delete("tipocuenta");

	}
}