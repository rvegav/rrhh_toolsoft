<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	//COMENTADO 13/07/2018
	// public function getEmpleados(){
	// //	$this->db->where("estempleado", "1");
	// 	$resultados= $this->db->get("empleado");
	// 	return $resultados->result();
	// }
	

//EJEMPLO DE CONSULTA A BASE ESPECIFICANDO COLUMNAS Y UTILIZANDO UNIONES(JOIN)
	public function getEmpleados(){
	//	$this->db->where("estempleado", "1");
		$this->db->select("CONCAT(Nombre, ' ', Apellido) as NOMBRE, NUMEMPLEADO, IDEMPLEADO, CEDULAIDENTIDAD, TELEFONO, DIRECCION, C.DESCATEGORIA AS CATEGORIA, C.MONTOASIGNADO, FECHAINGRESO");
		$this->db->from("empleado e");
		$this->db->join('categoria c', 'e.idcategoria = c.idcategoria');
		$this->db->where('ESTADOEMPLEADO <> 3');
		$resultados= $this->db->get();
		return $resultados->result();
	}
	

	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("empleado", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getEmpleado($id = false, $numEmpleado = false, $nombre = false, $apellido = false){
		$this->db->select('NOMBRE, APELLIDO, CONCAT(NOMBRE," ", APELLIDO) as EMPLEADO,  OBSERVACION, IDEMPLEADO, PERFIL, CEDULAIDENTIDAD, E.DIRECCION, E.TELEFONO ,CELULAR, FECHAINGRESO, FECHASALIDA, FECNACIMIENTO, NROCUENTA, C.IDCATEGORIA, C.DESCATEGORIA AS CATEGORIA, N.IDNIVEL, N.DESNIVEL AS NIVEL, P.IDPROFESION, P.DESPROFESION AS PROFESION, CIU.IDCIUDAD, CIU.DESCIUDAD AS CIUDAD, CAR.IDCARGO, CAR.DESCARGO AS CARGO, EC.IDCIVIL, EC.DESCCIVIL, S.IDSUCURSAL, S.DESCSUCURSAL AS SUCURSAL, D.IDDEPARTEMENTO, D.DESCDEPARTAMENTO AS DEPARTAMENTO');
		$this->db->from('empleado e');
		$this->db->join('categoria c', 'e.idcategoria = c.idcategoria');
		$this->db->join('nivelestudio n', 'n.idnivel = e.idnivel');
		$this->db->join('profesion p', 'p.idprofesion = e.idprofesion');
		$this->db->join('ciudad ciu', 'ciu.idciudad = e.idciudad');
		$this->db->join('sucursal s', 's.idsucursal = e.idsucursal');
		$this->db->join('cargo car', 'car.idcargo = e.idcargo');
		// $this->db->join('pais', 'pa.field = table2.field', 'left');
		$this->db->join('estadocivil ec', 'ec.idcivil = e.idcivil');
		$this->db->join('departamentoempresa d', 'd.iddepartemento = e.iddepartemento');
		if ($id) {
			$this->db->where('IDEMPLEADO', $id);
		}
		if ($numEmpleado) {
			$this->db->where('NUMEMPLEADO', $numEmpleado);
		}
		if ($nombre) {
			$this->db->where('NOMBRE', $nombre);
		}
		if ($apellido) {
			$this->db->where('APELLIDO', $apellido);
		}

		$resultado= $this->db->get();
		return $resultado->row();
	}
	
	//esto es para actualizar los empleado
	public function update($idEmpleado, $data){
		$this->db->where("IDEMPLEADO", $idEmpleado);
		return $this->db->update("empleado", $data);

	}

	//obtiene las incidencias de los empleados
	public function getLegajoEmpleado($id){
		$this->db->select('em.nombre, em.apellido, l.idlegajo, ti.descincidencia incidencia, DATE_FORMAT(l.fecha,"%d/%m/%Y") fecha, l.observacion, DATE_FORMAT(l.fecgrabacion,"%d/%m/%Y")fecgrabacion, l.imagen');
		$this->db->from('empleado em');
		$this->db->join('legajo l', 'em.idempleado = l.idempleado');
		$this->db->join('tipoincidencia ti', 'l.idtipoincidencia = ti.idtipoincidencia');
		$this->db->join('empresa e', 'l.idempresa = e.idempresa');
		$this->db->where('em.idempleado', $id);
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	public function save_incidencias($data){
		return $this->db->insert('legajo', $data);
	}
	public function getTipoIncidencias($id = false, $desc = false){
		$this->db->select('IDTIPOINCIDENCIA, NUMINCIDENCIA, DESCINCIDENCIA');
		$this->db->from('tipoincidencia');
		if ($id) {
			$this->db->where('IDTIPOINCIDENCIA', $id);
		}
		if ($desc) {
			$this->db->where('DESCINCIDENCIA', $desc);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			if ($id or $desc) {
				return $resultados->row();
			}
			return $resultados->result();
		}else{
			return false;
		}
	}
}