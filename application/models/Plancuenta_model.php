<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plancuenta_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getPlancuentas($imputable = false){
	//	$this->db->where("estempleado", "1");
		if ($imputable) {
			$this->db->where('ASENTABLE', 'S');
		}
		$resultados= $this->db->get("plancuentas");
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		// return true;
		return $this->db->insert("plancuentas", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getPlancuenta($id = false, $desc = false){
		$this->db->select("p.IDPLANCUENTA,p.NUMPLANCUENTA,p.TIPOCUENTA, p.ASENTABLE, p.NIVELCUENTA,p.DESCPLANCUENTA,p.FECHAGRABACION,p.IDPLANCUENTA_PADRE, pa.DESCPLANCUENTA DESCPLANCUENTA_PADRE");
		$this->db->from('plancuentas p');
		$this->db->join('plancuentas pa ', 'p.IDPLANCUENTA_PADRE = pa.IDPLANCUENTA', 'left');
		if ($id) {
			$this->db->where("p.IDPLANCUENTA",$id);
		}
		if ($desc) {
			$this->db->where("p.DESCPLANCUENTA",$desc);
		}
		$resultado= $this->db->get();
		if ($id or $desc) {
			return $resultado->row();
		}
		return $resultado->result();
	}
	//esto es para actualizar los empleado
	public function update($id, $data){

		$this->db->where("idplancuenta", $id);
		return $this->db->update("plancuentas", $data);

	}

	public function validarExiste($numPlancuenta){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("plancuentas");
		$this->db->where("numplancuenta",$numPlancuenta);
		$resultado= $this->db->get();
		return $resultado->row();
	}

    public function validarExisteCopia($idPlancuenta){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("plancuentas");
		$this->db->where("idplancuenta",$idPlancuenta);
		$resultado= $this->db->get();
		return $resultado->row();
	}

//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(idplancuenta) IS NULL THEN '1' ELSE max(idplancuenta) + 1 END) as MAXIMO");
		$this->db->from("plancuentas");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(idplancuenta) IS NULL THEN '01' when (max(idplancuenta) + 1) <= 9 then concat('0',(max(idplancuenta) + 1)) ELSE max(idplancuenta) + 1 END) as MAXIMO");
		$this->db->from("plancuentas");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($id){
		$this->db->where("idplancuenta", $id);
		return $this->db->delete("plancuentas");

	}
	public function obtenerCuentaPadre($cuenta_padre = false){
		$this->db->select('DESCPLANCUENTA AS CUENTA, IDPLANCUENTA, NUMPLANCUENTA', FALSE);
		$this->db->from('PLANCUENTAS');
		if ($cuenta_padre) {
			$this->db->where('IDCUENTA_PADRE' , $cuenta_padre);
		}

		$resultado= $this->db->get();
		if ($resultado->num_rows()>0) {
			return $resultado->result();
		}else{
			return false;
		}
	}
}