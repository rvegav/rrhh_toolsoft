<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Horario_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los empleado
	public function getHorarios(){
		$this->db->select("IDHORARIO, DESCHORARIO");
		$this->db->from("horario");
		$resultados= $this->db->get();
		if ($resultados->num_rows()>0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("horario", $data);
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
//obtener el ultimo id mas 1
	public function ultimoNumero(){
	    $this->db->select("(CASE WHEN  max(IDHORARIO) IS NULL THEN '1' ELSE max(IDHORARIO) + 1 END) as MAXIMO");
		$this->db->from("horario");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function ObtenerCodigo(){
	    $this->db->select("(CASE WHEN  max(IDHORARIO) IS NULL THEN '01' when (max(IDHORARIO) + 1) <= 9 then concat('0',(max(IDHORARIO) + 1)) ELSE max(IDHORARIO) + 1 END) as MAXIMO");
		$this->db->from("horario");
		$resultado= $this->db->get();
		return $resultado->row();
	}

	public function getHorarioEmpleado($empleado = false, $dia= false){
		$this->db->select('D.ENTRADAAM, D.SALIDAAM, D.ENTRADAPM, D.SALIDAPM, HE.IDEMPLEADO', FALSE);
		$this->db->from('horarioempleado he');
		$this->db->join('horario h', 'h.IDHORARIO = he.IDHORARIO');
		$this->db->join('detallehorario d', 'd.IDHORARIO = h.IDHORARIO');
		$this->db->where('he.IDEMPLEADO', $empleado);
		$this->db->where('d.dianro', $dia);
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}
	public function getNroDía($fecha){
		$sql = 'SELECT DAYOFWEEK("'.$fecha.'") AS NRODIA from dual';
		$resultado = $this->db->query($sql);
		
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}
	public function getDetalleHorario($id){
		$this->db->select('D.DESCDIA, D.DIANRO, D.ENTRADAAM, D.SALIDAAM, D.ENTRADAPM, D.SALIDAPM', FALSE);
		$this->db->from('detallehorario D');
		$this->db->where('D.IDHORARIO', $id);
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			return $resultado->result();
		}else{
			return false;
		}
	}
}

/* End of file  */
/* Location: ./application/models/ */