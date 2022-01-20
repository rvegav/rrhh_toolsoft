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
	public function getEmpleados($activo = false){
	//	$this->db->where("estempleado", "1");
		$this->db->select("CONCAT(Nombre, ' ', Apellido) as NOMBRE, NUMEMPLEADO, IDEMPLEADO, CEDULAIDENTIDAD, TELEFONO, DIRECCION, C.DESCATEGORIA AS CATEGORIA, C.MONTOASIGNADO, DATE_FORMAT(FECHAINGRESO,'%d/%m/%Y') FECHAINGRESO, ESTADOEMPLEADO ESTADO, NROCUENTA, NUMEROIPS");
		$this->db->from("empleado e");
		$this->db->join('categoria c', 'e.idcategoria = c.idcategoria');
		if ($activo) {
			$this->db->where('ESTADOEMPLEADO', '1');
		}
		$resultados= $this->db->get();
		return $resultados->result();
	}
	

	//esta es la parte para guardar en la bd
	public function save($data)
	{	
		$this->db->where('CEDULAIDENTIDAD', $data['cedulaidentidad']);
		$consulta = $this->db->get('empleado');
		if ($consulta->num_rows()==0) {
			return $this->db->insert("empleado", $data);
		}else{
			return false;
		}
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getEmpleado($id = false, $numEmpleado = false, $nombre = false, $apellido = false){
		$this->db->select('NOMBRE, APELLIDO, CONCAT(NOMBRE," ", APELLIDO) as EMPLEADO,  OBSERVACION, IDEMPLEADO, PERFIL, CEDULAIDENTIDAD, E.DIRECCION, E.TELEFONO ,CELULAR, FECHAINGRESO, FECHASALIDA, FECNACIMIENTO, NROCUENTA, C.IDCATEGORIA, C.DESCATEGORIA AS CATEGORIA, N.IDNIVEL, N.DESNIVEL AS NIVEL, P.IDPROFESION, P.DESPROFESION AS PROFESION, CIU.IDCIUDAD, CIU.DESCIUDAD AS CIUDAD, CAR.IDCARGO, CAR.DESCARGO AS CARGO, EC.IDCIVIL, EC.DESCCIVIL, S.IDSUCURSAL, S.DESCSUCURSAL AS SUCURSAL, D.IDDEPARTEMENTO, D.DESCDEPARTAMENTO AS DEPARTAMENTO, PA.IDPAIS, PA.DESPAIS, E.NUMEROIPS');
		$this->db->from('empleado e');
		$this->db->join('categoria c', 'e.idcategoria = c.idcategoria');
		$this->db->join('nivelestudio n', 'n.idnivel = e.idnivel');
		$this->db->join('profesion p', 'p.idprofesion = e.idprofesion');
		$this->db->join('ciudad ciu', 'ciu.idciudad = e.idciudad');
		$this->db->join('sucursal s', 's.idsucursal = e.idsucursal');
		$this->db->join('cargo car', 'car.idcargo = e.idcargo');
		$this->db->join('pais pa', 'pa.IDPAIS = e.IDNACIONALIDAD', 'left');
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

	public function getEmpleadosInforme($parametros = false){
		$this->db->select('NOMBRE, APELLIDO, CONCAT(NOMBRE," ", APELLIDO) as EMPLEADO,  NUMEMPLEADO, OBSERVACION, IDEMPLEADO, PERFIL, CEDULAIDENTIDAD, E.DIRECCION, E.TELEFONO ,CELULAR, DATE_FORMAT(FECHAINGRESO,"%d/%m/%Y") FECHAINGRESO, FECHASALIDA, FECNACIMIENTO, NROCUENTA, C.IDCATEGORIA, C.DESCATEGORIA AS CATEGORIA, N.IDNIVEL, N.DESNIVEL AS NIVEL, P.IDPROFESION, P.DESPROFESION AS PROFESION, CIU.IDCIUDAD, CIU.DESCIUDAD AS CIUDAD, CAR.IDCARGO, CAR.DESCARGO AS CARGO, EC.IDCIVIL, EC.DESCCIVIL, S.IDSUCURSAL, S.DESCSUCURSAL AS SUCURSAL, D.IDDEPARTEMENTO, D.DESCDEPARTAMENTO AS DEPARTAMENTO, ESTADOEMPLEADO ESTADO, e.NUMEROIPS, ec.DESCCIVIL, pa.DESPAIS');
		$this->db->from('empleado e');
		$this->db->join('categoria c', 'e.idcategoria = c.idcategoria');
		$this->db->join('nivelestudio n', 'n.idnivel = e.idnivel');
		$this->db->join('profesion p', 'p.idprofesion = e.idprofesion');
		$this->db->join('ciudad ciu', 'ciu.idciudad = e.idciudad');
		$this->db->join('sucursal s', 's.idsucursal = e.idsucursal');
		$this->db->join('pais pa', 'pa.idpais = e.IDNACIONALIDAD', 'left');
		$this->db->join('cargo car', 'car.idcargo = e.idcargo');
		// $this->db->join('pais', 'pa.field = table2.field', 'left');
		$this->db->join('estadocivil ec', 'ec.idcivil = e.idcivil');
		$this->db->join('departamentoempresa d', 'd.iddepartemento = e.iddepartemento');
		if ($parametros['empleado']!='') {
			$this->db->where('IDEMPLEADO', $parametros['empleado']);
		}
		if ($parametros['ingreso']!='') {
			$this->db->where('FECHAINGRESO',$parametros['ingreso']);
		}
		if ($parametros['salida']!='') {
			$this->db->where('FECHASALIDA',$parametros['salida']);
		}
		if ($parametros['sucursal']!='') {
			$this->db->where('s.idsucursal', $parametros['sucursal']);
		}
		if ($parametros['estado']!=''){
			$this->db->where('ESTADOEMPLEADO', $parametros['estado']);
		}
		$resultados= $this->db->get();
		if ($resultados->num_rows() >0) {
			return $resultados->result();
		}else{
			return false;
		}
	}
	
	//esto es para actualizar los empleado
	public function update($idEmpleado, $data){
		$this->db->where('CEDULAIDENTIDAD', $data['cedulaidentidad']);
		$this->db->where('IDEMPLEADO <> '.$idEmpleado);
		$consulta = $this->db->get('empleado');
		if ($consulta->num_rows()==0) {
			$this->db->where("IDEMPLEADO", $idEmpleado);
			return $this->db->update("empleado", $data);
		}else{
			return false;
		}

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
	public function getListadoSalarios($periodo){
		//acá pegas tu query
		$select ='select z.documento, z.formapago, z.importeunitario, 
		z.h_ene, 
		(z.montoasignado * h_ene) as s_ene,
		z.h_feb,
		(z.montoasignado * h_feb) as s_feb,
		z.h_mar,
		(z.montoasignado * h_mar) as s_mar,
		z.h_abril,
		(z.montoasignado * h_abril) as s_abril,
		z.h_may,
		(z.montoasignado * h_may) as s_may,
		z.h_junio,
		(z.montoasignado * h_junio) as s_junio,
		z.h_julio,
		(z.montoasignado * h_julio) as s_julio,
		z.h_agosto,
		(z.montoasignado * h_agosto) as s_agosto,
		z.h_sep,
		(z.montoasignado * h_sep) as s_sep,
		z.h_oct,
		(z.montoasignado * h_oct) as s_oct,
		z.h_nov,
		(z.montoasignado * h_nov) as s_nov,
		z.h_dic,
		(z.montoasignado * h_dic) as s_dic,
		z.aguinaldo,z.bonificaciones, 
		z.vacaciones,z.total_h, z.total_s, z.totalgeneral
		from (
		select l.CEDULAIDENTIDAD as documento,
		ca.MONTOASIGNADO,
		"MENSUAL" as formaPago,
		(ca.MONTOASIGNADO / 30) as importeunitario,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-01-01" and "'.$periodo.'-01-31") x
		where x.idempleado = l.idempleado) as h_ene,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-02-01" and "'.$periodo.'-02-28") x
		where x.idempleado = l.idempleado) as h_feb,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-03-01" and "'.$periodo.'-03-31") x
		where x.idempleado = l.idempleado) as h_mar,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-04-01" and "'.$periodo.'-04-30") x
		where x.idempleado = l.idempleado) as h_abril,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-05-01" and "'.$periodo.'-05-31") x
		where x.idempleado = l.idempleado) as h_may,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-06-01" and "'.$periodo.'-06-30") x
		where x.idempleado = l.idempleado) as h_junio,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-07-01" and "'.$periodo.'-07-31") x
		where x.idempleado = l.idempleado) as h_julio,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-08-01" and "'.$periodo.'-08-31") x
		where x.idempleado = l.idempleado) as h_agosto,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-09-01" and "'.$periodo.'-09-30") x
		where x.idempleado = l.idempleado) as h_sep,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-10-01" and "'.$periodo.'-10-31") x
		where x.idempleado = l.idempleado) as h_oct,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-11-01" and "'.$periodo.'-11-30") x
		where x.idempleado = l.idempleado) as h_nov,
		(select 
		ifnull(sum(cast((case when x.horastrabajadas > SEC_TO_TIME(x.horascorresponden) then x.horascorresponden
		else x.horastrabajadas end) as char(20))),0) as horastrabajadassinextras
		from (
		select SEC_TO_TIME(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)) as horastrabajadas,
		DAYOFWEEK(a.entradaam) as dianumero,
		ifnull((select SEC_TO_TIME(TIMESTAMPDIFF(SECOND,s.entradaam,s.salidapm))
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam) and s.idhorario = em.idhorario),"00:00:00") as horascorresponden,
		(select s.descdia
		from detallehorario s where s.dianro = DAYOFWEEK(a.entradaam)) descdia,
		a.ENTRADAAM,a.SALIDAPM,a.idempleado
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-12-01" and "'.$periodo.'-12-31") x
		where x.idempleado = l.idempleado) as h_dic,
		((select ifnull(sum(det.IMPORTE),0) from movisueldo mov
		inner join movisueldodetalle det on mov.IDMOVI = det.IDMOVI
		inner join tipomovisueldo tip on tip.IDTIPOMOVISUELDO = mov.IDTIPOMOVISUELDO
		where tip.SUMARESTA = "+"
		and mov.FECHAMOVI between "'.$periodo.'-01-01" and "'.$periodo.'-12-31"
		and det.IDEMPLEADO = l.idempleado) / 12) as aguinaldo,
		(select ifnull(sum(det.IMPORTE),0) from movisueldo mov
		inner join movisueldodetalle det on mov.IDMOVI = det.IDMOVI
		inner join tipomovisueldo tip on tip.IDTIPOMOVISUELDO = mov.IDTIPOMOVISUELDO
		where tip.IDTIPOMOVISUELDO = 6
		and mov.FECHAMOVI between "'.$periodo.'-01-01" and "'.$periodo.'-12-31"
		and det.IDEMPLEADO = l.IDEMPLEADO) as bonificaciones,
		"0" vacaciones,
		(select (SEC_TO_TIME(sum(TIMESTAMPDIFF(SECOND, a.entradaam,a.salidapm)))) as horastrabajadas
		from marcacionempleado a
		inner join horarioempleado em on em.IDEMPLEADO = a.idempleado
		where a.ENTRADAAM between "'.$periodo.'-01-01" and "'.$periodo.'-12-31"
		and a.idempleado = l.IDEMPLEADO) as total_h,
		(select ifnull(sum(det.IMPORTE),0) from movisueldo mov
		inner join movisueldodetalle det on mov.IDMOVI = det.IDMOVI
		inner join tipomovisueldo tip on tip.IDTIPOMOVISUELDO = mov.IDTIPOMOVISUELDO
		where tip.IDTIPOMOVISUELDO = 4
		and mov.FECHAMOVI between "'.$periodo.'-01-01" and "'.$periodo.'-12-31"
		and det.IDEMPLEADO = l.IDEMPLEADO) total_s,
		(select ifnull(sum(det.IMPORTE),0) from movisueldo mov
		inner join movisueldodetalle det on mov.IDMOVI = det.IDMOVI
		inner join tipomovisueldo tip on tip.IDTIPOMOVISUELDO = mov.IDTIPOMOVISUELDO
		where tip.SUMARESTA = "+"
		and mov.FECHAMOVI between "'.$periodo.'-01-01" and "'.$periodo.'-12-31"
		and det.IDEMPLEADO = l.idempleado) totalgeneral
		from empleado l
		inner join categoria ca on ca.IDCATEGORIA = l.IDCATEGORIA) z';


		//echo $select; die();

		$query = $this->db->query($select);
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function getListadoPersonasOcupadas($periodo){
		//acá pegas tu query
		$select ='select '.$periodo.' periodo,
		(select count(1)
		from empleado e
		inner join categoria s on e.idcategoria = e.idcategoria
		where s.DESCATEGORIA in("SUPERVISOR", "GERENTE")
		and e.ESTADOEMPLEADO = 1 and e.sexo = "M"
		and e.FECHAINGRESO <= "'.$periodo.'-12-31") as supjefesvarones,
		(select count(1)
		from empleado e
		inner join categoria s on e.idcategoria = e.idcategoria
		where s.DESCATEGORIA in("SUPERVISOR", "GERENTE")
		and e.ESTADOEMPLEADO = 1 and e.sexo = "F"
		and e.FECHAINGRESO <="'.$periodo.'-12-31") as supjefesmujeres,
		(select count(1) from empleado s where  s.sexo = "M" and s.ESTADOEMPLEADO = 1
		and s.FECHAINGRESO <="'.$periodo.'-12-31") empleadosvarones,
		(select count(1) from empleado s where  s.sexo = "F" and s.ESTADOEMPLEADO = 1
		and s.FECHAINGRESO <="'.$periodo.'-12-31") empleadosmujeres,
		0 obrerosvarones, 0 obrerosmujeres,
		(select count(1) from empleado s where 
		ifnull(TIMESTAMPDIFF(YEAR,s.FECNACIMIENTO,CURDATE()),0) < 18
		and s.sexo = "M" and s.ESTADOEMPLEADO = 1 and s.FECHAINGRESO <="'.$periodo.'-12-31") as menoresvarones,
		(select count(1) from empleado s where 
		ifnull(TIMESTAMPDIFF(YEAR,s.FECNACIMIENTO,CURDATE()),0) < 18
		and s.sexo = "F" and s.ESTADOEMPLEADO = 1 and s.FECHAINGRESO <="'.$periodo.'-12-31") as menoresmujeres;';


	
		
		$query = $this->db->query($select);
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function ObtenerCodigoEmpleado(){
		$this->db->select("(CASE WHEN  max(idempleado) IS NULL THEN '01' when (max(idempleado) + 1) <= 9 then concat('0',(max(idempleado) + 1)) ELSE max(idempleado) + 1 END) as MAXIMO");
		$this->db->from("empleado");
		$resultado= $this->db->get();
		return $resultado->result();
	}

	public function getLibroMayor($fechaDesde, $fechaHasta){
		//acá pegas tu query

		$select ='select s.NUMPLANCUENTA as NUMERO,s.DESCPLANCUENTA CUENTA,sum(d.IMPORTEDEBE) IMPORTEDEBE,sum(d.IMPORTEAHABER) IMPORTEHABER 
		from asiento a
		inner join asientodetalle d on a.IDASIENTO = d.IDASIENTO
		inner join plancuentas s on s.IDPLANCUENTA = d.IDPLANCUENTA
		where a.FECHAASIENTO between "'.$fechaDesde.'" and "'.$fechaHasta.'"
		group by s.NUMPLANCUENTA,s.DESCPLANCUENTA;';

		$query = $this->db->query($select);
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function getHorarios(){
	//	$this->db->where("estempleado", "1");
		$resultados= $this->db->get("horario");
		return $resultados->result();
	}
}