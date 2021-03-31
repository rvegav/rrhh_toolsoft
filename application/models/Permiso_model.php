<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permiso_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function save($data)
	{
		return $this->db->insert("permisos", $data);
	}
	public function ultimoInsert(){
		$this->db->select('MAX(idpermiso) AS IDPERMISO');
		$this->db->from('permisos');
		$resultado = $this->db->get();
		return $resultado->row();
	}
	public function save_permiRoles($data){
		return $this->db->insert("permiroles", $data);
	}
	public function getPermisosRol($idRol){
		$this->db->select('M.DESMODULO, PA.DESPANTALLA, P.PERSELECT, P.PERUPDATE, P.PERDELETE, P.PERINSERT');
		$this->db->from('ROLES R');
		$this->db->join('PERMIROLES PR', 'PR.IDROL = R.IDROL');
		$this->db->join('PERMISOS P', 'P.IDPERMISO = PR.IDPERMISO');
		$this->db->join('PANTALLA PA', 'PA.IDPANTALLA = P.IDPANTALLA');
		$this->db->join('MODULO M', 'M.IDMODULO = PA.IDMODULO');
		$this->db->where('R.IDROL', $idRol);
		$resultado = $this->db->get();
		if($resultado->num_rows()>0){
			return $resultado->result();
		}else{
			//echo "error en user y clave";
			return false;
		}

	}
}

/* End of file Permiso_model.php */
/* Location: ./application/models/Permiso_model.php */