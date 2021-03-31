<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plancuenta_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getPlancuentas(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("IDCUENTACONTABLE,NUMPLANCUENTA,TIPOCUENTA,(case when ASENTABLE = 0 then 'NO' else 'SI' END) AS ASENTABLE,NIVELCUENTA,SUBCUENTA,DESPLANCUENTA,FECHAGRABACION,concat(NUMPLANCUENTA,' - ',DESPLANCUENTA) as CUENTA");
		$resultados= $this->db->get("cuentacontable");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("cuentacontable", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getPlancuenta($id){
		$this->db->select("IDCUENTACONTABLE,NUMPLANCUENTA,TIPOCUENTA,ASENTABLE,NIVELCUENTA,SUBCUENTA,DESPLANCUENTA,FECHAGRABACION, (case when asentable = 0 then 'NO' else 'SI' end) as IMPONIBLE");
		$this->db->where("idcuentacontable",$id);
		$resultado= $this->db->get("cuentacontable");
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("idcuentacontable", $id);
		return $this->db->update("cuentacontable", $data);

	}

	public function validarExiste($numPlancuenta){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("cuentacontable");
		$this->db->where("numplancuenta",$numPlancuenta);
		$resultado= $this->db->get();
		return $resultado->row();
	}


    public function validarExisteCopia($idPlancuenta){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("cuentacontable");
		$this->db->where("idcuentacontable",$idPlancuenta);
		$resultado= $this->db->get();
		return $resultado->row();
	}

//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idcuentacontable) IS NULL THEN '1' ELSE max(idcuentacontable) + 1 END) as MAXIMO");
		$this->db->from("cuentacontable");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idcuentacontable) IS NULL THEN '01' when (max(idcuentacontable) + 1) <= 9 then concat('0',(max(idcuentacontable) + 1)) ELSE max(idcuentacontable) + 1 END) as MAXIMO");
		$this->db->from("cuentacontable");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idcuentacontable", $id);
		return $this->db->delete("cuentacontable");

	}
}