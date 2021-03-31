<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getCategorias(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("categoria");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("categoria", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getCategoria($id){
		$this->db->select("IDCATEGORIA,NUMCATEGORIA,DESCATEGORIA,FECGRABACION");
		$this->db->where("idcategoria",$id);
		$resultado= $this->db->get("categoria");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idcategoria", $id);
		return $this->db->update("categoria", $data);

	}

	public function validarExiste($numCategoria){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("categoria");
		$resultados= $this->db->get();
		return $resultados->result();	
	}
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idcategoria) IS NULL THEN '1' ELSE max(idcategoria) + 1 END) as MAXIMO");
		$this->db->from("categoria");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idcategoria) IS NULL THEN '01' when (max(idcategoria) + 1) <= 9 then concat('0',(max(idcategoria) + 1)) ELSE max(idcategoria) + 1 END) as MAXIMO");
		$this->db->from("categoria");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idcategoria", $id);
		return $this->db->delete("categoria");

	}
}