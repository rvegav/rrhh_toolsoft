<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');

class Faltas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array('Horario_model', 'Empleados_model', 'Marcacion_model', 'Faltas_model'));
		$this->data = array('correcto'=>'','alerta'=>'','error'=>'', 'datos'=>'');
		$this->load->model("Usuarios_model");
		

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 3;
		// if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
		// 	redirect(base_url());
		// }
	}
	public function index()
	{	
		// if ($this->session->userdata('login')) {
		$this->comprobacionRoles();
		$data = array(
			'tiposFaltas'=> $this->Faltas_model->getTipoFaltas(), 
			'maximo' => $this->Faltas_model->ObtenerCodigo()
		);
		$this->data = array('correcto'=>'','alerta'=>'','error'=>'', 'datos'=>'');

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/list', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
	
		$data = array(			
			'maximo' => $this->Faltas_model->ObtenerCodigo()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/add', $data);
		$this->load->view('template/footer');
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}
	//funcion vista
	public function viewDetalle($id)
	{
	
		$data = array (
			'ciudad'=> $this->Faltas_model->getCiudad($id)
		);
		$this->load->view("faltas/view", $data);
		
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}
	//funcion para almacenar en la bd
	public function store()
	{
	


	}
		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	public function edit($id)
	{
	

		$data = array(
			'horario'=> $this->Faltas_model->getHorario($id),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('horario/edit', $data);
		$this->load->view('template/footer');

		// }else {
		// 	redirect(base_url(),'refresh');
		// }
	}

	//actualizamos 

	public function update(){
	

	}


	public function delete($id)
	{
	
		if($this->Faltas_model->delete($id)){
			$this->session->set_flashdata('success', 'Eliminado correctamente!');
			redirect(base_url()."faltas/Faltas/", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."faltas/Faltas/","refresh");
		}

		// }else {
		// 	redirect(base_url(),'refresh');
		// }

	}

	public function viewGenerarFaltas()
	{
		$this->comprobacionRoles();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('faltas/generarFaltas');
		$this->load->view('template/footer');
	}
	public function generacionFaltas()
	{
		$this->comprobacionRoles();

		$mensajes = $this->data;
		$data = $this->input->post('datos', TRUE);
		if (!$data){
			$mensajes['alerta'] = 'alerta';

			// redirect(base_url()."horario/Horario", "refresh");
		}else{
			foreach ($data as $dato) {
				if ($dato[4]!='' or $dato[3]!='') {
					$data = array (
						'idempleado' =>$dato[0],
						'fechafalta'=>$dato[2],
						'permiso'=>$dato[3],
						'fechapermiso'=>$dato[4]
					);
				}else{
					$data = array (
						'idempleado' =>$dato[0],
						'fechafalta'=>$dato[2],
					);
				}
				if ($this->Faltas_model->insertFaltasEmpleados($data, $dato[1])) {
					$mensajes['correcto'] = 'correcto';
				}else{
					$mensajes['error'] = 'error';
				}

			}
		}
		echo json_encode($mensajes);
	}
	
	public function consultarFaltas()
	{
		$this->comprobacionRoles();
		
		$fecha_desde = $this->input->post('desde', TRUE);
		$fecha_hasta = $this->input->post('hasta', TRUE);
		$empleados = $this->Empleados_model->getEmpleados();
		$item= 0;
		$datos = array();
		foreach ($empleados as $empleado) {
			$fecha_desde_aux = $fecha_desde;
			if ($fecha_desde && $fecha_hasta) {
				$fecha_incorporacion = $empleado->FECHAINGRESO;
				if ($fecha_incorporacion>$fecha_desde_aux) {
					$fecha_desde_aux = $fecha_incorporacion;
				}
				$array = array();
				while ($fecha_desde_aux<= $fecha_hasta) {
					$tipoFalta='';
					$dia_numero = $this->Horario_model->getNroDía($fecha_desde_aux);
					$horario = $this->Horario_model->getHorarioEmpleado($empleado->IDEMPLEADO, $dia_numero->NRODIA);
					if ($horario) {
						$marcacion  = $this->Marcacion_model->getMarcacionEmpleados($empleado->IDEMPLEADO, $fecha_desde_aux);
						if ($marcacion) {
							$entrada_am = explode(' ', $marcacion->ENTRADAAM);
							$salida_am = explode(' ', $marcacion->SALIDAAM);
							$entrada_pm = explode(' ', $marcacion->ENTRADAPM);
							$salida_pm = explode(' ', $marcacion->SALIDAPM);
							if (count($entrada_am)>1) {
								if (strtotime($entrada_am[1])>strtotime($horario->ENTRADAAM)) {
									$tipoFalta = ' LLEGADA TARDIA';
									$item ++;
								}
							}else{
								$tipoFalta = 'AUSENCIA ENTRADA AM';
								$item ++;
							}
							if ($tipoFalta !='') {
								$array['NRO']=$item;
								$array['DOCUMENTO']=$empleado->CEDULAIDENTIDAD;
								$array['EMPLEADO']=$empleado->NOMBRE;
								$array['IDEMPLEADO']=$empleado->IDEMPLEADO;
								$array['TIPO_FALTA']=$tipoFalta;
								$f= date_create($fecha_desde_aux);
								$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
								$array['PERMISOS']='';
								$array['FECHA_PRESENTACION']='';
								$datos[] = $array;
								$tipoFalta='';
							}
							if (count($salida_am)>1) {
								if (strtotime($salida_pm[1])<strtotime($horario->SALIDAPM)) {
									$tipoFalta = 'SALIDA TEMPRANA';
									$item ++;
								}
							}else{
								$tipoFalta = 'AUSENCIA SALIDA AM';
								$item ++;

							}
							if ($tipoFalta !='') {
								$array['NRO']=$item;
								$array['DOCUMENTO']=$empleado->CEDULAIDENTIDAD;

								$array['EMPLEADO']=$empleado->NOMBRE;
								$array['IDEMPLEADO']=$empleado->IDEMPLEADO;

								$array['TIPO_FALTA']=$tipoFalta;
								$f= date_create($fecha_desde_aux);
								$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
								$array['PERMISOS']='';
								$array['FECHA_PRESENTACION']='';
								$datos[] = $array;
								$tipoFalta='';
							}
							if (count($entrada_pm)==1) {
								$tipoFalta = 'AUSENCIA ENTRADA PM';
								$item++;
							}
							if ($tipoFalta !='') {
								$array['NRO']=$item;
								$array['DOCUMENTO']=$empleado->CEDULAIDENTIDAD;
								$array['EMPLEADO']=$empleado->NOMBRE;
								$array['IDEMPLEADO']=$empleado->IDEMPLEADO;

								$array['TIPO_FALTA']=$tipoFalta;
								$f= date_create($fecha_desde_aux);
								$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
								$array['PERMISOS']='';
								$array['FECHA_PRESENTACION']='';
								$datos[] = $array;
								$tipoFalta='';
							}
							if (count($salida_pm)==1) {
								$tipoFalta = 'AUSENCIA SALIDA PM';
								$item++;
							}
							if ($tipoFalta !='') {
								$array['NRO']=$item;
								$array['DOCUMENTO']=$empleado->CEDULAIDENTIDAD;
								$array['EMPLEADO']=$empleado->NOMBRE;
								$array['IDEMPLEADO']=$empleado->IDEMPLEADO;

								$array['TIPO_FALTA']=$tipoFalta;
								$f= date_create($fecha_desde_aux);
								$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
								$array['PERMISOS']='';
								$array['FECHA_PRESENTACION']='';
								$datos[] = $array;
								$tipoFalta='';
							}
						}else{
							$tipoFalta = 'AUSENCIA';
							$item ++;
						}
									// echo "<pre>";
									// print_r ($tipoFalta);
									// echo "</pre>";
						if ($tipoFalta !='') {
							$array['NRO']=$item;
							$array['DOCUMENTO']=$empleado->CEDULAIDENTIDAD;
							$array['EMPLEADO']=$empleado->NOMBRE;
							$array['IDEMPLEADO']=$empleado->IDEMPLEADO;
							$array['TIPO_FALTA']=$tipoFalta;
							$f= date_create($fecha_desde_aux);
							$array['FECHA_FALTA']=date_format($f,"d/m/Y") ;
							$array['PERMISOS']='';
							$array['FECHA_PRESENTACION']='';
							$datos[] = $array;
							$tipoFalta='';
						}

					}
					$fecha_desde_aux= date("Y-m-d",strtotime($fecha_desde_aux."+ 1 days"));
				}

				$data['data'] = $datos;
			}else{
				$data['data']= [];
			}
		}
		echo json_encode($data);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */