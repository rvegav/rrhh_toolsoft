<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursal_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getSucursales(){
		$this->db->select("S.IDSUCURSAL,S.NUMSUCURSAL,S.DESCSUCURSAL,IFNULL(S.DIRECCION,'') AS DIRECCION,IFNULL(S.TELEFONO,'') AS TELEFONO,S.FECGRABACION");
		$this->db->from("sucursal s");
		// $this->db->join("zona z", "s.idzona = z.idzona","left outer");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("sucursal", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getSucursal($id){
		
		$this->db->select("S.IDSUCURSAL,S.NUMSUCURSAL,S.DESSUCURSAL,IFNULL(S.DIRECCION,'') AS DIRECCION,IFNULL(S.TELEFONO,'') AS TELEFONO,S.FECGRABACION,IFNULL(S.IDZONA,0) AS IDZONA,IFNULL(Z.DESZONA,'') AS DESZONA,IFNULL(S.NROPATRONAL,'') AS NROPATRONAL");
		$this->db->from("sucursal s");
		$this->db->join("zona z", "s.idzona = z.idzona","left outer");
		$this->db->where("s.idsucursal",$id);
		$resultado= $this->db->get();
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idsucursal", $id);
		return $this->db->update("sucursal", $data);

	}

	public function delete($id){
		$this->db->where("idsucursal", $id);
		return $this->db->delete("sucursal");

	}

	public function validarExiste($numSucursal){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("sucursal");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idsucursal) IS NULL THEN '1' ELSE max(idsucursal) + 1 END) as MAXIMO");
		$this->db->from("sucursal");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idsucursal) IS NULL THEN '01' when (max(idsucursal) + 1) <= 9 then concat('0',(max(idsucursal) + 1)) ELSE max(idsucursal) + 1 END) as MAXIMO");
		$this->db->from("sucursal");
		$resultado= $this->db->get();
		return $resultado->result();
	}
}