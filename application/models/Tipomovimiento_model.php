<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipomovimiento_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	//public function getMovimientos(){
	//	$this->db->where("estempleado", "1");
		//$resultados= $this->db->get("movisueldo");
		//return $resultados->result();
	//}

	public function getTipoMovimientos($id = false){
		$this->db->select("IDTIPOMOVISUELDO,NUMTIPOMOV,DESTIPOMOV, DESCPLANCUENTA, t.IDPLANCUENTA, PORCENTAJE, SUMARESTA, ENRECIBO, SALARIOBASICO, SALARIOMINIMO, TOTALSALARIO, AGUINALDO, LIBROS, ENRECIBO");
		$this->db->from("tipomovisueldo t");
		$this->db->join('plancuentas p', 'p.IDPLANCUENTA = t.IDPLANCUENTA', 'left');
		if ($id) {
			$this->db->where('idtipomovisueldo', $id);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows()>0) {
			if ($id) {
				return $resultados->row();
			}else{
				return $resultados->result();
			}
		}else{
			return false;
		}
	}

	public function getTipoDetalle(){
		$this->db->select("D.IDTIPOMOVISUELDO,(select concat(numtipomov,' - ',destipomov) from tipomovisueldo where idtipomovisueldo = d.IDTIPOMOVISUELDO) as DESCRIPCION");
		$this->db->from("tipomovisueldo d");
		$resultados= $this->db->get();
		return $resultados->result();
	}

	public function getTipoMovimientos_Copia(){
		$this->db->select("IDTIPOMOVISUELDO,NUMTIPOMOV,DESTIPOMOV,concat(d.numplancuenta,' - ',d.descplancuenta) as CUENTACONTABLE,
			(case when t.sumaresta = '+' then 'SUMA' else 'RESTA' end) as SUMARESTA");
		$this->db->from("tipomovisueldo t");
		$this->db->join("plancuentas d", "d.idplancuenta = t.idplancuenta","left");
		$resultados= $this->db->get();
		return $resultados->result();
	}

	public function getIdMaximo(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("(CASE WHEN  max(idtipomovisueldo) IS NULL THEN '1' ELSE max(idtipomovisueldo) + 1 END) as MAXIMO");
		$this->db->from("tipomovisueldo");
		$resultados= $this->db->get();
		return $resultados->row();
	}


    public function getIdDetalle(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("max(idtipomovisueldo) as MAXIMO");
		$this->db->from("tipomovisueldo");
		$resultados= $this->db->get();
		return $resultados->result();
	}

	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(IDTIPOMOVISUELDO) IS NULL THEN '1' ELSE max(IDTIPOMOVISUELDO) + 1 END) as MAXIMO");
		$this->db->from("tipomovisueldo");
		$resultado= $this->db->get();
		return $resultado->row();
	}


	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		//echo '<pre>'.print_r($data).'</pre>'; die();
		return $this->db->insert("tipomovisueldo", $data);
	}


    public function save_detalle($data){
    	$this->db->insert("tipomovisueldo",$data);
    }


	public function lastID(){
		return $this->db->insert_id();
	}
	

public function descripcion_Tabla($columna,$tabla,$buscado,$variable){
	//	$this->db->where("estempleado", "1");
		$this->db->select($columna);
		$this->db->from($tabla);
		$this->db->where($buscado,$variable);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getValidacion($id){
	//	$this->db->where("estempleado", "1");
		$this->db->select("count(*) as CANTIDAD");
		$this->db->from("tipomovisueldo");
				$this->db->where("numtipomov",$id);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getTipomovidetalle($id){
		$this->db->from("tipomovisueldo");
		$this->db->where("idtipomovisueldo",$id);
		$resultados= $this->db->get();
		return $resultados->result();
}


	//esto es para actualizar los MOVIMIENTO CABECERA
	public function update($id, $data){
		$this->db->where("IDTIPOMOVISUELDO", $id);
		return $this->db->update("tipomovisueldo", $data);
		//print_r($data);die();
		// $cabecera = array(
		// 		'DESTIPOMOV' => $data['DESTIPOMOV'],
		// 		'SUMARESTA'=> $data['SUMARESTA'],
		// 		'ENRECIBO'=> $data['ENRECIBO'],
		// 		'LIBROS'=> $data['LIBROS'],
		// 		'IMPORTE'=> $data['IMPORTE'],
		// 		'PORCENTAJE'=> $data['PORCENTAJE'],
		// 		'SALARIOMINIMO'=> $data['SALARIOMINIMO'],	
		// 		'SALARIOBASICO'=> $data['SALARIOBASICO'],
		// 		'TOTALSALARIO'=> $data['TOTALSALARIO'],
		// );


		// try { 	  
		// 	$this->db->where("idtipomovisueldo", $id);
		// 	if($this->db->update("tipomovisueldo", $cabecera)){
		// 		for ($i=0; $i < count($data['IDTIPOMOVIDETALLE']); $i++) { 
					
		// 			$detalle = array(
		// 			    'idtipomovidetalle' => $data['IDTIPOMOVIDETALLE'][$i]
		// 			);
					
		// 			$this->db->where("idtipomovidetalle", $detalle['idtipomovidetalle']);
		// 			$this->db->update("tipomovisueldodetalle", $detalle);
		// 			$detalle =array();
		// 		}

		// 		return true;

		// 	}

		// } catch (Exception $e) {
		// 	  //alert the user.
		// 	  return false;
		// }

	}



//DETALLE 22/07/2018
	public function update1($id, $data){
		$this->db->where("idtipomovidetalle", $id);
		return $this->db->update("tipomovisueldodetalle", $data);

	}

	public function deleteDetalleView($id){
		$this->db->where("idtipomovidetalle", $id);
		return $this->db->delete("tipomovisueldodetalle");

	}


	public function deleteDetalle($id){
		$this->db->where("idtipomovisueldo", $id);
		return $this->db->delete("tipomovisueldodetalle");

	}

	public function deleteCabecera($id){
		$this->db->where("idtipomovisueldo", $id);
		return $this->db->delete("tipomovisueldo");

	}

	//esto es para actualizar los MOVIMIENTO DETALLE
	public function updateDetalle($id, $data){
		$this->db->where("idtipomovisueldo", $id);
		return $this->db->update("tipomovisueldodetalle", $data);

	}
}