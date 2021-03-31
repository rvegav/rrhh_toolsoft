<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentabancaria_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getCuentabancarias(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("B.NUMCUENTA, C.IDCUENTACONTABLE,BA.IDBANCO,B.IDTIPOCUENTA,B.IDEMPRESA,B.DESCRIPCION,date_format(B.FECHAPERTURA,'%d/%m/%Y') as FECHAPERTURA, FORMAT(cast(IFNULL(B.SALDOINICIAL,0) as UNSIGNED), 0, 'de_DE') AS SALDOINICIAL,B.IDMONEDA,(M.SIMBOLO) AS MONEDA,CONCAT(C.NUMPLANCUENTA,' - ',C.DESPLANCUENTA) AS DESPLANCUENTA,
			 T.NUMTIPOCUENTA,T.DESTIPOCUENTA, BA.NUMBANCO, BA.DESBANCO");
		$this->db->from("cuentabancarias b");
		$this->db->join("moneda m","m.idmoneda = b.idmoneda");
		$this->db->join("tipocuenta t","t.idtipocuenta = b.idtipocuenta");
		$this->db->join("banco ba","ba.idbanco = b.idbanco");
		$this->db->join("cuentacontable c","c.idcuentacontable = b.idcuentacontable");
		$resultados= $this->db->get();
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("cuentabancarias", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getCuentabancaria($numCuenta,$idBanco){
		$this->db->select("B.NUMCUENTA, C.IDCUENTACONTABLE,BA.IDBANCO,B.IDTIPOCUENTA,B.IDEMPRESA,B.DESCRIPCION,date_format(B.FECHAPERTURA,'%Y-%m-%d') as FECHAPERTURA,FORMAT(cast(IFNULL(B.SALDOINICIAL,0) as UNSIGNED), 0, 'de_DE') AS SALDOINICIAL,B.IDMONEDA,CONCAT(M.SIMBOLO,' - ',M.DESMONEDA) AS MONEDA,CONCAT(C.NUMPLANCUENTA,' - ',C.DESPLANCUENTA) AS DESPLANCUENTA,
			 T.NUMTIPOCUENTA,T.DESTIPOCUENTA, BA.NUMBANCO, BA.DESBANCO");
		$this->db->from("cuentabancarias b");
		$this->db->join("moneda m","m.idmoneda = b.idmoneda");
		$this->db->join("tipocuenta t","t.idtipocuenta = b.idtipocuenta");
		$this->db->join("banco ba","ba.idbanco = b.idbanco");
		$this->db->join("cuentacontable c","c.idcuentacontable = b.idcuentacontable");
		$this->db->where("b.numcuenta",$numCuenta);
		$this->db->where("ba.idbanco",$idBanco);
		$resultado= $this->db->get();
		return $resultado->row();
	}
	//esto es para actualizar los empleado
	public function update($numCuenta,$idBanco, $data){
		$this->db->where("numcuenta", $numCuenta);
		$this->db->where("idbanco", $idBanco);
		return $this->db->update("cuentabancarias", $data);

	}

	public function validarExiste($num,$idbanco){
	    $this->db->select("count(*) as cantidad");
		$this->db->from("cuentabancarias");
		$this->db->where("numcuenta",$num);
		$this->db->where("idbanco",$idbanco);
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN max(numcuenta) IS NULL THEN '01' when (max(numcuenta) + 1) <= 9 then concat('0',(max(numcuenta) + 1)) ELSE max(numcuenta) + 1 END) as MAXIMO");
		$this->db->from("cuentabancarias");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function delete($num,$idbanco){
		$this->db->where("numcuenta", $num);
		$this->db->where("idbanco", $idbanco);
		return $this->db->delete("cuentabancarias");

	}

	public function existeCuenta($idbanco,$cuenta)
	{
		$this->db->select("count(*) as cantidad");
		$this->db->from("cuentabancarias");
		$this->db->where("numcuenta",$cuenta);
		$this->db->where("idbanco",$idbanco);
		$resultado= $this->db->get();
		return $resultado->row();

	}
}