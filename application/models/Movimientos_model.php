<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	//public function getMovimientos(){
	//	$this->db->where("estempleado", "1");
		//$resultados= $this->db->get("movisueldo");
		//return $resultados->result();
	//}

	public function getTipoMovimientos($codigo= false){
		$this->db->select("idtipomovisueldo AS IDTIPOMOVI,NUMTIPOMOV,DESTIPOMOV AS DESC, SUMARESTA");
		$this->db->from("tipomovisueldo");
		if ($codigo) {
			$this->db->where('idtipomovisueldo', $codigo);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows()>0) {
			return $resultados->result();
		} else {
			return false;
		}
	}

	public function getIdMaximo(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("(CASE WHEN  max(IDMOVI) IS NULL THEN '1' ELSE max(IDMOVI) + 1 END) as MAXIMO");
		$this->db->from("movisueldo");
		$resultados= $this->db->get();
		return $resultados->result();
	}


    public function getIdDetalle(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("max(idmovidetalle) as MAXIMO");
		$this->db->from("movisueldodetalle");
		$resultados= $this->db->get();
		return $resultados->result();
	}


//este metodo es para mostrar todos los empleado
	public function getMovimientos(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("m.IDMOVI, m.NUMMOVI, m.IDTIPOMOVISUELDO,DATE_FORMAT(m.fechamovi,'%d/%m/%Y') AS FECHAMOVI,d.IDEMPLEADO,d.IMPORTE,t.destipomov AS DESTIPOMOV,t.numtipomov as NUMTIPOMOV,e.numempleado AS NUMEMPLEADO,CONCAT(Nombre, ' ', Apellido) as EMPLEADO,d.observacion as OBSERVACION");
		$this->db->from("movisueldo m");
		$this->db->join("movisueldodetalle d","m.idmovi = d.idmovi");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$this->db->join("empleado e","e.idempleado = d.idempleado");
		$resultados= $this->db->get();
		return $resultados->result();
	}


	public function getMovimientosCabecera($mes = false, $anho= false){
		$this->db->select("m.idmovi AS IDMOVI,m.nummovi AS NUMMOVI,m.idtipomovisueldo AS IDTIPOMOVISUELDO,DATE_FORMAT(m.fechamovi,'%d/%m/%Y') AS FECHAMOVI,t.destipomov AS DESTIPOMOV,t.numtipomov as NUMTIPOMOV, SUM(md.IMPORTE) AS MONTO_TOTAL");
		$this->db->from("movisueldo m");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$this->db->join('movisueldodetalle md', 'md.idmovi = m.idmovi', 'left');
		$this->db->group_by("m.idmovi,m.nummovi,m.idtipomovisueldo,DATE_FORMAT(m.fechamovi,'%d/%m/%Y'),t.destipomov,t.numtipomov");
		if ($mes && $anho) {
			$this->db->where("DATE_FORMAT(m.fechamovi,'%m')", $mes);
			$this->db->where("DATE_FORMAT(m.fechamovi,'%Y')", $anho);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows()>0) {
			return $resultados->result();
		} else {
			return false;
		}
	}
    


	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		//echo '<pre>'.print_r($data).'</pre>'; die();
		return $this->db->insert("movisueldo", $data);
	}


    public function save_detalle($data){
    	$this->db->insert("movisueldodetalle",$data);
    }


	public function lastID(){
		return $this->db->insert_id();
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	// public function getMovimiento($idMovi){
	// 	$this->db->where("idMovi",$idMovi);
	// 	$resultado= $this->db->get("movisueldo");
	// 	return $resultado->row();
	// 	//db->join()
	// }


public function getMovimiento($idMovi){
	//	$this->db->where("estempleado", "1");
		$this->db->select("m.idmovi AS IDMOVI,m.nummovi AS NUMMOVI,m.idtipomovisueldo AS IDTIPOMOVISUELDO,m.fechamovi as FECHAMOVI,t.numtipomov as NUMTIPOMOV,t.destipomov AS DESTIPOMOV");
		$this->db->from("movisueldo m");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$this->db->where("m.idMovi",$idMovi);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function descripcion_Tabla($columna,$tabla,$buscado,$variable){
	//	$this->db->where("estempleado", "1");
		$this->db->select($columna);
		$this->db->from($tabla);
		$this->db->where($buscado,$variable);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getValidacion($idMovi){
	//	$this->db->where("estempleado", "1");
		$this->db->select("count(*) as CANTIDAD");
		$this->db->from("movisueldo");
				$this->db->where("NUMMOVI",$idMovi);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getMovimientoDetalle($idMovi){
	//	$this->db->where("estempleado", "1");
		$this->db->select("d.idmovidetalle as IDMOVIDETALLE,m.idmovi AS IDMOVI,m.nummovi AS NUMMOVI,m.idtipomovisueldo AS IDTIPOMOVISUELDO,DATE_FORMAT(m.fechamovi,'%d/%m/%Y') AS FECHAMOVI,d.idempleado AS IDEMPLEADO,format(round(d.importe,0),2) AS IMPORTE,t.destipomov AS DESTIPOMOV,t.numtipomov as NUMTIPOMOV,e.idempleado as IDEMPLEADO,e.numempleado AS NUMEMPLEADO,CONCAT(Nombre, ' ', Apellido) as EMPLEADO,d.observacion as OBSERVACION,CONVERT(d.horas,UNSIGNED INTEGER) as HORAS,CONVERT(d.dias,UNSIGNED INTEGER) as DIAS");
		$this->db->from("movisueldo m");
		$this->db->join("movisueldodetalle d","m.idmovi = d.idmovi");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$this->db->join("empleado e","e.idempleado = d.idempleado");
		$this->db->where("m.idMovi",$idMovi);
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getTipoMovimiento(){
	$this->db->select("idtipomovisueldo as IDTIPOMOVISUELDO,numtipomov as NUMTIPOMOV,destipomov as DESTIPOMOV");
	$this->db->from("tipomovisueldo");
	$resultados= $this->db->get();
		return $resultados->result();
}

public function getEmpleado(){
	$this->db->select("IDEMPLEADO,CONCAT(Nombre, ' ', Apellido) as NOMBRE,NUMEMPLEADO");
	$this->db->from("empleado");
	$resultados= $this->db->get();
		return $resultados->result();
}

public function getEmpleado1(){
	$this->db->select("IDEMPLEADO as IDEMPLEADO1,CONCAT(Nombre, ' ', Apellido) AS EMPLEADO1,NUMEMPLEADO AS NUMEMPLEADO1");
	$this->db->from("empleado");
	$resultados= $this->db->get();
		return $resultados->result();
}


	//esto es para actualizar los MOVIMIENTO CABECERA
	public function update($idMovi, $data){
		//$this->db->where("idMovi", $idMovi);
		//return $this->db->update("movisueldo", $data);
		//print_r($data);die();
		$cabecera = array(
				'FECHAMOVI' => $data['FECHAMOVI'],
				'IDTIPOMOVISUELDO'=> $data['IDTIPOMOVISUELDO'],
		);


		try { 	  
			$this->db->where("idMovi", $idMovi);
			if($this->db->update("movisueldo", $cabecera)){
				for ($i=0; $i < count($data['IDEMPLEADO']); $i++) { 
					
					$detalle = array(
					    'idempleado' => $data['IDEMPLEADO'][$i],
					    'dias' => $data['DIAS'][$i],
					    'horas' => $data['HORAS'][$i],
					    'importe' => $data['IMPORTE'][$i],
					    'idmovidetalle'=> $data['IDMOVIDETALLE'][$i]
					);
					
					$this->db->where("idmovidetalle", $detalle['idmovidetalle']);
					$this->db->update("movisueldodetalle", $detalle);
					$detalle =array();
				}

				return true;

			}

		} catch (Exception $e) {
			  //alert the user.
			  return false;
		}

	}



//DETALLE 22/07/2018
	public function update1($idMoviDetalle, $data){
		$this->db->where("idmovidetalle", $idMoviDetalle);
		return $this->db->update("movisueldoDetalle", $data);

	}

	public function deleteDetalleView($idMovidetalle){
		$this->db->where("idmovidetalle", $idMovidetalle);
		return $this->db->delete("movisueldoDetalle");

	}


	public function deleteDetalle($idMovi){
		$this->db->where("idmovi", $idMovi);
		return $this->db->delete("movisueldoDetalle");

	}

	public function deleteCabecera($idMovi){
		$this->db->where("idmovi", $idMovi);
		return $this->db->delete("movisueldo");

	}

	//esto es para actualizar los MOVIMIENTO DETALLE
	public function updateDetalle($idMovi, $data){
		$this->db->where("idMovi", $idMovi);
		return $this->db->update("movisueldodetalle", $data);

	}
}