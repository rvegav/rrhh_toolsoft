<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faltas_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function insertFaltasEmpleados($data){
		$this->db->insert('faltasempleados', $data);
		if ($this->db->affected_rows()>0) {
			return true;
		}
	}
	public function save($data)
	{
		return $this->db->insert("faltas", $data);
	}
	
	//esto es para actualizar los empleado
	public function update($id, $data){
		$this->db->where("IDHORARIO", $id);
		return $this->db->update("horario", $data);

	}

	public function delete($id){
		$this->db->where("IDHORARIO", $id);
		return $this->db->delete("horario");
	}
	public function ObtenerCodigo(){
		$this->db->select("(CASE WHEN  max(idbanco) IS NULL THEN '01' when (max(idbanco) + 1) <= 9 then concat('0',(max(idbanco) + 1)) ELSE max(idbanco) + 1 END) as MAXIMO");
		$this->db->from("banco");
		$resultado= $this->db->get();
		return $resultado->result();
	}


	public function getTipoFaltas($id=false, $desc = false){
		$this->db->select('idfaltas, descfaltas', FALSE);
		$this->db->from('faltas');
		if ($id) {
			$this->db->where('idfalta', $id, FALSE);
		}
		if ($desc) {
			$this->db->where('descfaltas', $desc);
		}
		$consulta = $this->db->get();
		if ($consulta->num_rows()>0) {
			return $consulta->row();
		}else {
			return false;
		}
	}

	public function getFaltasEmpleados($desde=false, $hasta=false, $mes = false, $permisos = false){
		$this->db->select('e.NOMBRE, e.APELLIDO, t.descpermisos PERMISO, f.descfaltas TIPO_FALTA', FALSE);
		$this->db->from('faltasempleados fe');
		$this->db->join('faltas f', 'f.idfaltas = fe.idfalta');
		$this->db->join('empleado e', 'e.idempleado = fe.idempleado');
		$this->db->join('tipopermisos t', 't.idtipopermisos = fe.idtipopermisos', 'left');

		if ($desde && $hasta) {
			$this->db->where('STR_TO_DATE(fe.fechafalta, \'%Y-%m-%d \') between \''.$desde.'\' and \''.$hasta.'\'');
		}
		if ($mes) {
			$this->db->where('DATE_FORMAT(fe.fechafalta,\'%m\')', $mes);
		}
		if($permiso){
			$this->db->where('permiso is NULL', NULL, FALSE);
		}
		$consulta = $this->db->get();
		if ($consulta->num_rows()>0) {
			return $consulta->result();
		}else {
			return false;
		}
	}
	public function getFaltaEmpleado($empleado = false, $fecha = false){
		$this->db->select('fe.idempleado, fe.idfaltasempleados', FALSE);
		$this->db->from('faltasempleados fe');
		if ($empleado) {
			$this->db->where('fe.idempleado', $empleado);
		}
		if ($fecha) {
			$this->db->where('fe.fechafalta', $fecha);
		}

		$consulta = $this->db->get();
		if ($consulta->num_rows()>0) {
			return $consulta->row();
		}else {
			return false;
		}
	}
	public function getTotalFaltasEmpleado($empleado = false, $mes = false, $tipo){
		$this->db->select('count(f.idempleado) as cant_faltas, f.idempleado, f.idfalta');
		$this->db->from('faltasempleados f');
		$this->db->where('f.idempleado', $empleado);
		$this->db->where('DATE_FORMAT(f.fechafalta,\'%m\')', $mes);
		$this->db->where('f.idfalta', $tipo);
		$this->db->group_by('f.idempleado');
		$consulta = $this->db->get();
		if ($consulta->num_rows()>0) {
			return $consulta->row();
		}else {
			return false;
		}

	}
	public function idFaltaEmpleados(){
	    $this->db->select("(CASE WHEN  max(idfaltasempleados) IS NULL THEN '1' ELSE max(idfaltasempleados) + 1 END) as MAXIMO");
		$this->db->from("faltasempleados");
		$resultado= $this->db->get();
		return $resultado->row();
	}
	public function insertFaltaEmpleado($data){
		$faltas = $this->getFaltaEmpleado($data['IDEMPLEADO'], $data['FECHAFALTA']);
		if ($faltas) {
			$this->db->where('idFaltaEmpleadosa', $faltas->idFaltaEmpleados);
			return $this->db->update('faltasempleados', $data);
		}else{
			$id = $this->idFaltaEmpleados();
			$this->db->set('idfaltasempleados', $id->MAXIMO, FALSE);
			return $this->db->insert('faltasempleados', $data);

		}
	}
}

/* End of file  */
/* Location: ./application/models/ */