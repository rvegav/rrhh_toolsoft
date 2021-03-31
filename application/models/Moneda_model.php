<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moneda_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getMonedas(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("IDMONEDA,NUMMONEDA,DESMONEDA,SIMBOLO,FECGRABACION, (case when DECIMALES = 0 then 'NO' else 'SI' END) AS DECIMALES");
		$resultados= $this->db->get("moneda");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("moneda", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getMoneda($id){
		$this->db->select("IDMONEDA,NUMMONEDA,DESMONEDA,SIMBOLO,FECGRABACION, (case when DECIMALES = 0 then 'NO' else 'SI' END) AS DECIMALES");
		$this->db->where("idmoneda",$id);
		$resultado= $this->db->get("moneda");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idmoneda", $id);
		return $this->db->update("moneda", $data);

	}

	public function validarExiste($num){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("moneda");
		$this->db->where("nummoneda",$num);
		$resultado= $this->db->get();
		return $resultado->row();
	}


    public function validarSimbolo($simbolo,$id){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("moneda");
		$this->db->where("simbolo",trim($simbolo));
		$this->db->where("idmoneda !=",trim($id));
		$resultado= $this->db->get();
		return $resultado->row();
	}

//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idmoneda) IS NULL THEN '1' ELSE max(idmoneda) + 1 END) as MAXIMO");
		$this->db->from("moneda");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idmoneda) IS NULL THEN '01' when (max(idmoneda) + 1) <= 9 then concat('0',(max(idmoneda) + 1)) ELSE max(idmoneda) + 1 END) as MAXIMO");
		$this->db->from("moneda");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idmoneda", $id);
		return $this->db->delete("moneda");

	}
}