<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
	
	public function login($username,$password){
		$this->db->select('U.IDEMPLEADO, U.DESUSUARIO,  CONCAT_WS(\' \',NOMBRE, APELLIDO) AS EMPLEADO, E.PERFIL ');
		$this->db->from('usuario u');
		$this->db->join('empleado e', 'e.idempleado = u.idempleado');
		$this->db->where("U.desusuario", $username);
		$this->db->where("U.passusuario", $password);
		$this->db->where("U.nivelcuenta", 1);
		
		$results= $this->db->get("");

		if($results->num_rows()>0){
			return $results->row();
		}else{
			//echo "error en user y clave";
			return false;
		}
	}


	public function getEmpresas(){
	    $this->db->select("IDEMPRESA,DESEMPRESA,CONCAT(DESEMPRESA) AS EMPRESA");
		$resultados= $this->db->get("empresa");
		return $resultados->result();
	}

	public function getSucursales(){
	    $this->db->select("IDSUCURSAL,NUMSUCURSAL,DESCSUCURSAL,CONCAT(NUMSUCURSAL,' ', DESCSUCURSAL) AS SUCURSAL");
		$resultados= $this->db->get("sucursal");
		return $resultados->result();
	}
	public function getUsuarios(){
		$this->db->select("U.IDUSUARIO, U.NUMUSUARIO, E.NOMBRE, E.APELLIDO, EM.DESEMPRESA AS EMPRESA, R.DESCRIPCION AS ROL, U.FECGRABACION AS FECHA_GRABACION", false);
		$this->db->from('usuario u');
		$this->db->join('empleado e', 'e.idempleado = u.idempleado');
		$this->db->join('roldetalle rd', 'u.idusuario = rd.idusuario');
		$this->db->join('roles r', 'r.idrol = rd.idrol');
		$this->db->join('empresa em', 'em.idempresa = u.idempresa');
		$results= $this->db->get();
		if($results->num_rows()>0){
			return $results->row();
		}else{
			//echo "error en user y clave";
			return false;
		}
	}
}