<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zona_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getZonas(){
		$this->db->select("Z.IDZONA,Z.NUMZONA,Z.DESZONA,Z.FECGRABACION,IFNULL(C.IDCIUDAD,0) AS IDCIUDAD,IFNULL(C.DESCIUDAD,'') AS DESCIUDAD");
		$this->db->from("zona z");
		$this->db->join("ciudad c","c.idciudad = z.idciudad","left outer");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("zona", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getZona($id){
		$this->db->select("Z.IDZONA,Z.NUMZONA,Z.DESZONA,Z.FECGRABACION,IFNULL(C.IDCIUDAD,0) AS IDCIUDAD,IFNULL(C.DESCIUDAD,'') AS DESCIUDAD");
		$this->db->from("zona z");
		$this->db->join("ciudad c","c.idciudad = z.idciudad","left outer");
		$this->db->where("idzona",$id);
		$resultado= $this->db->get();
		return $resultado->row();
	}
	
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idzona", $id);
		return $this->db->update("zona", $data);

	}

	public function validarExiste($numDepartamento){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("zona");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idzona) IS NULL THEN '1' ELSE max(idzona) + 1 END) as MAXIMO");
		$this->db->from("zona");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idzona) IS NULL THEN '01' when (max(idzona) + 1) <= 9 then concat('0',(max(idzona) + 1)) ELSE max(idzona) + 1 END) as MAXIMO");
		$this->db->from("zona");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idzona", $id);
		return $this->db->delete("zona");

	}
}