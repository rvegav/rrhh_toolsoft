<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informediarios_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	//public function getMovimientos(){
	//	$this->db->where("estempleado", "1");
		//$resultados= $this->db->get("movisueldo");
		//return $resultados->result();
	//}

	public function getTipoMovimientos(){
		$this->db->select("idtipomovisueldo AS IDEMPLEADO,NUMTIPOMOV AS NUMEMPLEADO,DESTIPOMOV AS NOMBRE");
		$this->db->from("tipomovisueldo");
		$resultados= $this->db->get();
		return $resultados->result();
	}

	public function getIdMaximo(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("(CASE WHEN  max(IDCIERRE) IS NULL THEN '1' ELSE max(IDCIERRE) + 1 END) as MAXIMO");
		$this->db->from("procesocierre");
		$resultados= $this->db->get();
		return $resultados->result();
	}

	public function getIdAsiento(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("(CASE WHEN  max(IDDIARIO) IS NULL THEN '1' ELSE max(IDDIARIO) + 1 END) as MAXIMO");
		$this->db->from("diario");
		$resultados= $this->db->get();
		return $resultados->result_array();
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
		$this->db->select("m.idmovi AS IDMOVI,m.nummovi AS NUMMOVI,m.idtipomovisueldo AS IDTIPOMOVISUELDO,DATE_FORMAT(m.fechamovi,'%d/%m/%Y') AS FECHAMOVI,d.idempleado AS IDEMPLEADO,d.importe AS IMPORTE,t.destipomov AS DESTIPOMOV,t.numtipomov as NUMTIPOMOV,e.numempleado AS NUMEMPLEADO,CONCAT(Nombre, ' ', Apellido) as EMPLEADO,d.observacion as OBSERVACION");
		$this->db->from("movisueldo m");
		$this->db->join("movisueldodetalle d","m.idmovi = d.idmovi");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$this->db->join("empleado e","e.idempleado = d.idempleado");
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getMovimientosCabecera(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("m.idmovi AS IDMOVI,m.nummovi AS NUMMOVI,m.idtipomovisueldo AS IDTIPOMOVISUELDO,DATE_FORMAT(m.fechamovi,'%d/%m/%Y') AS FECHAMOVI,t.destipomov AS DESTIPOMOV,t.numtipomov as NUMTIPOMOV");
		$this->db->from("movisueldo m");
		$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
		$resultados= $this->db->get();
		return $resultados->result();
	}
    
public function obtenerMovimientos($desdesucursal,$hastasucursal,$desdedepartamento,$hastadepartamento,$fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
$this->db->select("m.idmovi AS IDMOVI,m.idtipomovisueldo AS IDTIPOMOV,m.fechamovi as FECHAMOVI,dp.numdepartamento as NUMDEPARTAMENTO,dp.iddepartamento as IDDEPARTAMENTO, dp.desdepartamento AS DESDEPARTAMENTO,s.idsucursal as IDSUCURSAL,sum(d.importe) as IMPORTE,sum(d.horas) as HORAS,sum(d.dias) as DIAS,e.idempleado as IDEMPLEADO,e.idempresa AS IDEMPRESA");
$this->db->from("movisueldo m");
$this->db->join("movisueldodetalle d","m.idmovi = d.idmovi");
$this->db->join("empleado e","e.idempleado = d.idempleado");
$this->db->join("sucursal s","s.idsucursal = e.idsucursal");
$this->db->join("departamentoempresa dp","dp.iddepartamento = e.iddepartamento");
$this->db->where("FECHAMOVI >= '$fechadesde' AND FECHAMOVI <= '$fechahasta'");
$this->db->group_by("m.idtipomovisueldo,e.idempleado");
$resultados= $this->db->get();
return $resultados->result_array();
}





public function obtenerCierre($desdesucursal,$hastasucursal,$desdedepartamento,$hastadepartamento,$fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
	$this->db->select("p.idcierre as IDCIERRE");
$this->db->DISTINCT("p.idcierre");
$this->db->from("procesocierre p");
$this->db->join("empleado e","e.idempleado = p.idempleado");
$this->db->join("sucursal s","s.idsucursal = e.idsucursal");
$this->db->join("departamentoempresa dp","dp.iddepartamento = e.iddepartamento");
$this->db->join("empresa em","em.idempresa = p.idempresa");
$this->db->where("fechadesde >= '$fechadesde' AND fechahasta <= '$fechahasta'");
$this->db->where("s.numsucursal >= '$desdesucursal' AND s.numsucursal <= '$hastasucursal'");
$this->db->where("dp.numdepartamento >= '$desdedepartamento' AND numdepartamento <= '$hastadepartamento'");
$this->db->where("p.fechadesde >= '$fechadesde' AND p.fechahasta <= '$fechahasta'");
$resultados= $this->db->get();
return $resultados->result_array();
}


public function existeCierre($desdesucursal,$hastasucursal,$desdedepartamento,$hastadepartamento,$fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
$this->db->select("COUNT(p.idcierre) as CANTIDAD");
$this->db->from("procesocierre p");
$this->db->join("empleado e","e.idempleado = p.idempleado");
$this->db->join("sucursal s","s.idsucursal = e.idsucursal");
$this->db->join("departamentoempresa dp","dp.iddepartamento = e.iddepartamento");
$this->db->join("empresa em","em.idempresa = p.idempresa");
$this->db->where("fechadesde >= '$fechadesde' AND fechahasta <= '$fechahasta'");
$this->db->where("s.numsucursal >= '$desdesucursal' AND s.numsucursal <= '$hastasucursal'");
$this->db->where("dp.numdepartamento >= '$desdedepartamento' AND numdepartamento <= '$hastadepartamento'");
$this->db->where("p.fechadesde >= '$fechadesde' AND p.fechahasta <= '$fechahasta'");
$resultados= $this->db->get();
return $resultados->result_array();
}



public function obtenerIdDiario($idCierre){
	$this->db->select("iddiario as IDDIARIO");
$this->db->DISTINCT("iddiario");
$this->db->from("diario");
$this->db->where("idcierre",$idCierre);
$resultados= $this->db->get();
return $resultados->result_array();
}



public function obtenerAiento($desdesucursal,$hastasucursal,$desdedepartamento,$hastadepartamento,$fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
$this->db->select("m.idmovi AS IDMOVI,m.idtipomovisueldo AS IDTIPOMOV,m.fechamovi as FECHAMOVI,dp.numdepartamento as NUMDEPARTAMENTO,dp.iddepartamento as IDDEPARTAMENTO, dp.desdepartamento AS DESDEPARTAMENTO,sum(d.importe) as IMPORTE,sum(d.horas) as HORAS,sum(d.dias) as DIAS,t.idcuentacontable as IDCUENTACONTABLE");
$this->db->from("movisueldo m");
$this->db->join("movisueldodetalle d","m.idmovi = d.idmovi");
$this->db->join("tipomovisueldo t","m.idtipomovisueldo = t.idtipomovisueldo");
$this->db->join("empleado e","e.idempleado = d.idempleado");
$this->db->join("sucursal s","s.idsucursal = e.idsucursal");
$this->db->join("departamentoempresa dp","dp.iddepartamento = e.iddepartamento");
$this->db->where("FECHAMOVI >= '$fechadesde' AND FECHAMOVI <= '$fechahasta'");
$this->db->group_by("t.idcuentacontable");
$resultados= $this->db->get();
return $resultados->result_array();
}


	
	//esta es la parte para guardar en la bd
	public function saveProcesocierre($data)
	{
		//echo '<pre>'.print_r($data).'</pre>'; die();
		return $this->db->insert("procesocierre", $data);
	}

	public function saveAsiento($data)
	{
		//echo '<pre>'.print_r($data).'</pre>'; die();
		return $this->db->insert("diario", $data);
	}

	public function saveAsiento_detalle($data)
	{
		//echo '<pre>'.print_r($data).'</pre>'; die();
		return $this->db->insert("diariodetalle", $data);
	}



	public function lastID(){
		return $this->db->insert_id();
	}


	public function eliminarAsientodetalle($idasiento){
		$this->db->where("iddiario",$idasiento);
		return $this->db->delete("diariodetalle");
	}

	public function eliminarAsiento($idcierre){
		$this->db->where("idcierre",$idcierre);
		return $this->db->delete("diario");
	}

		public function eliminarCierre($idcierre){
		$this->db->where("idcierre",$idcierre);
		return $this->db->delete("procesocierre");
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


public function getInformeDiario($fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
	//	$this->db->where("estempleado", "1");
		$this->db->select("d.iddiario as IDDIARIO,d.numasiento AS NUMASIENTO, d.fechaasiento as FECHAASIENTO,dt.IDPLANCUENTA AS IDCUENTACONTALE,ifnull(dt.importedebe,0) AS IMPORTEDEBE,ifnull(dt.importeahaber,0) AS IMPORTEHABER,CONCAT(C.NUMPLANCUENTA,' ',C.DESCPLANCUENTA) AS PLANCUENTA");
		$this->db->from("diario d");
		$this->db->join("diariodetalle dt","dt.iddiario = d.iddiario");
		$this->db->join("plancuentas c","c.IDPLANCUENTA = dt.IDPLANCUENTA");
		$this->db->join("empresa e", "e.idempresa = d.idempresa");
		$this->db->where("e.numempresa >= $desdeempresa and e.numempresa <= $hastaempresa");
		$this->db->where("d.fechaasiento >= '$fechadesde' and d.fechaasiento <= '$fechahasta'");
		$resultados= $this->db->get();
		return $resultados->result();
	}


public function getInformeDiarioPrueba($fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
	//	$this->db->where("estempleado", "1");
		$query = $this->db->query("select d.iddiario as IDDIARIO, d.numasiento AS NUMASIENTO, d.fechaasiento as FECHAASIENTO, 0 AS IDCUENTACONTALE, 0 AS IMPORTEDEBE, 0 AS IMPORTEHABER, '' AS PLANCUENTA 
FROM diario d JOIN empresa e ON e.idempresa = d.idempresa  where e.numempresa >= $desdeempresa and e.numempresa <= $hastaempresa and d.fechaasiento >= '$fechadesde' and d.fechaasiento <= '$fechahasta'  union select 0 as IDDIARIO, '' AS NUMASIENTO, '' as FECHAASIENTO, dt.idcuentacontable AS IDCUENTACONTALE, ifnull(dt.importedebe, 0) AS IMPORTEDEBE, ifnull(dt.importeahaber, 0) AS IMPORTEHABER, CONCAT(C.NUMPLANCUENTA, ' ', C.DESPLANCUENTA) AS PLANCUENTA 
FROM diario d
JOIN diariodetalle dt ON dt.iddiario = d.iddiario 
JOIN cuentacontable c ON c.IDCUENTACONTALE = dt.IDCUENTACONTABLE 
JOIN empresa e ON e.idempresa = d.idempresa where e.numempresa >= $desdeempresa and e.numempresa <= $hastaempresa and d.fechaasiento >= '$fechadesde' and d.fechaasiento <= '$fechahasta'");
		return $query->result();
	}


//CON FILTRO DE NUMERO DE ASIENTO
public function getInformeDiario1($numero,$fechadesde,$fechahasta,$desdeempresa,$hastaempresa){
	//	$this->db->where("estempleado", "1");
		$this->db->select("d.iddiario as IDDIARIO,d.numasiento AS NUMASIENTO, d.fechaasiento as FECHAASIENTO,dt.idcuentacontable AS IDCUENTACONTALE,ifnull(dt.importedebe,0) AS IMPORTEDEBE,ifnull(dt.importeahaber,0) AS IMPORTEHABER,CONCAT(C.NUMPLANCUENTA,' ',C.DESPLANCUENTA) AS PLANCUENTA");
		$this->db->from("diario d");
		$this->db->join("diariodetalle dt","dt.iddiario = d.iddiario");
		$this->db->join("cuentacontable c","c.IDCUENTACONTALE = dt.IDCUENTACONTABLE");
		$this->db->join("empresa e", "e.idempresa = d.idempresa");
		$this->db->where("e.numempresa >= $desdeempresa and e.numempresa <= $hastaempresa");
		$this->db->where("d.fechaasiento >= '$fechadesde' and d.fechaasiento <= '$fechahasta'");
		$this->db->where("d.numasiento = $numero");
		$resultados= $this->db->get();
		return $resultados->result();
	}

public function getTipoMovimiento(){
	$this->db->select("idtipomovisueldo as IDTIPOMOVISUELDO,numtipomov as NUMTIPOMOV,destipomov as DESTIPOMOV");
	$this->db->from("tipomovisueldo");
	$resultados= $this->db->get();
		return $resultados->result();
}

public function getDepartamento(){
	$this->db->select("iddepartamento as IDDEPARTAMENTO,numdepartamento as NUMDEPARTAMENTO,concat(numdepartamento, ' ', desdepartamento) as DESDEPARTAMENTO");
	$this->db->from("departamentoempresa");
	$resultados= $this->db->get();
		return $resultados->result();
}


public function getEmpresa(){
	$this->db->select("idempresa as IDEMPRESA,numempresa as NUMEMPRESA,desempresa as DESEMPRESA");
	$this->db->from("empresa");
	$resultados= $this->db->get();
		return $resultados->result();
}


public function getCuentaContable(){
	$this->db->select("NUMPLANCUENTA,CONCAT(NUMPLANCUENTA, ' ' ,DESCPLANCUENTA) AS DESPLANCUENTA");
	$this->db->from("plancuentas");
	$resultados= $this->db->get();
		return $resultados->result();
}


public function getSucursal(){
	$this->db->select("idsucursal as IDSUCURSAL,numsucursal as NUMSUCURSAL,concat(numsucursal, ' ' ,dessucursal) as DESSUCURSAL");
	$this->db->from("sucursal");
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