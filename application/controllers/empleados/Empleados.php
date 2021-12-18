<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Empleados extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
    	// $this->load->model(array('Login', 'M_Empleados', 'M_Multas'));
		$this->load->model("Empleados_model");
		$this->load->model("Sucursal_model");
		$this->load->model("Cargo_model");
		$this->load->model("Categoria_model");
		$this->load->model("Departamentoempresa_model");
		$this->load->model("Estadocivil_model");
		$this->load->model("Cuentabancaria_model");
		$this->load->model("Ciudad_model");
		$this->load->model("Profesion_model");
		$this->load->model("Tipocuenta_model");
		$this->load->model("Tiposalario_model");
		$this->load->model("Nivelestudio_model");
		$this->load->model("Pais_model");
		$this->load->model("Cuentabancaria_model");
		$this->load->model("Hijos_model");
		$this->load->model("Usuarios_model");

		$this->data = array('correcto'=>'','alerta'=>'','error'=>'', 'datos'=>'');

	}
	public function comprobacionRoles(){
		$usuario = $this->session->userdata("DESUSUARIO");
		$idmodulo = 2;
		if (!$this->Usuarios_model->comprobarPermiso($usuario, $idmodulo)) {
			redirect(base_url());
		}
	}
	//esta funcion es la primera que se ejecuta para cargar los datos
	public function index()
	{
	$this->comprobacionRoles();	
		//cargamos un array usando el modelo
		$data = array(
			'empleados'=> $this->Empleados_model->getEmpleados());
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empleados/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$this->comprobacionRoles();

		$data = array(
			'sucursales'=> $this->Sucursal_model->getSucursales(),
			'cargos'=> $this->Cargo_model->getCargos(),
			'categorias'=> $this->Categoria_model->getCategorias(),
			'depatamentosempresas'=> $this->Departamentoempresa_model->getDepartamentoempresas(),
			'estadociviles'=> $this->Estadocivil_model->getEstadociviles(),
			// 'cuentabancarias'=> $this->Cuentabancaria_model->getCuentabancarias(),
			'ciudades'=> $this->Ciudad_model->getCiudades(),
			'profesiones'=> $this->Profesion_model->getProfesiones(),
			'tipocuentas'=> $this->Tipocuenta_model->getTipocuentas(),
			'tiposalarios'=> $this->Tiposalario_model->getTiposalarios(),
			'paises'=> $this->Pais_model->getPaises(),
			// 'nrocuentas'=> $this->Cuentabancaria_model->getCuentabancarias(),
			'nivelestudios'=> $this->Nivelestudio_model->getNivelestudios(),
			'horarios'=> $this->Empleados_model->getHorarios(),
			'maximos' => $this->Empleados_model->ObtenerCodigoEmpleado()
		);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empleados/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($idEmpleado)
	{
		$this->comprobacionRoles();
		$data = array (
			'empleados'=> $this->Empleados_model->getEmpleado($idEmpleado)
		);
		//abrimos la vista view
		$this->load->view("empleados/view", $data);
	}
	//funcion para almacenar en la bd
	public function store()
	{
		$this->comprobacionRoles();
		//recibimos las variables
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 1080;
		$config['overwrite']           = true;

		$this->load->library('upload', $config);
		$numEmpleado = $this->input->post("CodEmpleado");
		$nombre = $this->input->post("Nombre");
		$apellido = $this->input->post('Apellido');
		$observacion = $this->input->post('Observacion');
		$mensajes = $this->data;

		// //aqui se valida el formulario, reglas, primero el campo, segundo alias del campo, tercero la validacion
		$this->form_validation->set_rules("Nombre", "Nombres", "required");
		$this->form_validation->set_rules("Apellido", "Apellidos", "required");
		$this->form_validation->set_rules("CodEmpleado", "Codigo Empleado", "required");
		$this->form_validation->set_rules("Documento", "Documento de Identidad", "required");
		$this->form_validation->set_rules("Celular", "Celular", "required");
		$this->form_validation->set_rules("NumeroIPS", "Nro Ips", "required");
		$this->form_validation->set_rules("NroCuenta", "Nro Cuenta", "required");
		$this->form_validation->set_rules("Horario", "Horario", "required");
		if ($this->form_validation->run() == FALSE){
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 
			// $this->session->set_flashdata('error', validation_errors());
			// redirect(base_url()."empleados/empleados/add", "refresh");

		}else{
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$perfil ="";
			}else{
				$perfil = $this->upload->data();
				$data = file_get_contents('uploads/'.$perfil['file_name']);
				$base64 = base64_encode($data);
				$perfil = 'data:image/' . $perfil['image_type'] . ';base64,'.$base64;
			}
			$documento = $this->input->post('Documento');
			$direccion = $this->input->post("Direccion");
			$telefono   = $this->input->post("Telefono");
			$celular = $this->input->post('Celular');
			$fecha_nacimiento = $this->input->post('Nacimiento');
			$fechaIngreso = date("Y-m-d H:i:s");
			$fecha_salida = $this->input->post('Salida');
			$ruc = $this->input->post('Ruc');
			$estado_civil = $this->input->post('EstadoCivil');
			$pais = $this->input->post('Nacionalidad');
			$nivel_estudio = $this->input->post('NivelEstudio');
			$profesion = $this->input->post('Profesion');
			$ciudad = $this->input->post('Ciudad');
			$nro_cuenta = $this->input->post('NroCuenta');
			$sucursal = $this->input->post('Sucursal');
			$cargo = $this->input->post('Cargo');
			$tipo_salario = $this->input->post('TipoSalario');
			$deparmento = $this->input->post('Departamento');
			$categoria = $this->input->post('Categoria');
			$nro_ips = $this->input->post('NumeroIPS');
			$fecha_ips = $this->input->post('FechaIps');
			$nombre_hijo = $this->input->post('nombrehijo');
			$apellido_hijo = $this->input->post('apellidohijo');
			$sexohijo = $this->input->post('sexohijo');
			$fecha_nacimiento_hijo = $this->input->post('fechanachijo');
			$horario = $this->input->post('Horario');

			$data = array(
				// 'idEmpleado'  => $idEmpleado,
				'numEmpleado'  => $numEmpleado,
				'nombre'  => $nombre,
				'apellido' => $apellido, 
				'observacion' => $observacion,
				'perfil' => $perfil,
				'cedulaidentidad' => $documento,
				'direccion'  => $direccion,
				'telefono'  => $telefono, 
				'celular' => $celular, 
				'fecnacimiento' => $fecha_nacimiento,
				'fechaingreso' => $fechaIngreso,
				'fechasalida' => $fecha_salida,
				'idcivil' => $estado_civil,
				'idnacionalidad' => $pais,
				'idnivel'=> $nivel_estudio,
				'idprofesion' => $profesion,
				'idciudad' => $ciudad,
				'nrocuenta' => $nro_cuenta,
				'idsucursal' => $sucursal,
				'idcargo' => $cargo,
				'iddepartEmento' => $deparmento,
				'idcategoria' => $categoria,
				'numeroips' => $nro_ips,
				'fecingresoips' => $fecha_ips,
				'estadoempleado'  => 1,
				'fecgrabacion'=> date("Y-m-d H:i:s")
			);

			//guardamos los datos en la base de datos
			if($this->Empleados_model->save($data)){
				// var_dump($nombre_hijo);
				$empleado = $this->Empleados_model->getEmpleado(false, $numEmpleado, $nombre, $apellido);
				for ($i=0; $i < count($nombre_hijo) ; $i++) {
					if ($nombre_hijo[$i]!='') {
						$data = array(
							'idempleado'=> $empleado->IDEMPLEADO,
								// 'idempresa'=>
							'nombre'=>$nombre_hijo[$i],
							'apellido'=>$apellido_hijo[$i],
							'fecnacimiento'=> $fecha_nacimiento_hijo[$i],
							'idempresa'=> 1,
							'fecgrabacion'=> date("Y-m-d H:i:s")

						);
						if ($this->Hijos_model->save($data)) {
							$correcto = "Se ha asociado correctamente los hijos";	
						}
					} 
				}
				$data= array(
				 'idEmpleado'  => $idEmpleado,
				 'idhorario'  => $horario,
				 'idempresa' => 1,
				 'fecgrabacion' => date("Y-m-d H:i:s")
				);

				if ($this->Horario_model->saveHorarioEmpleado($data)) {
							$correcto = "Se ha asociado correctamente los Horarios";	
				}

				$this->session->set_flashdata('success', 'Empleado registrado correctamente!');
				$mensajes['correcto'] = 'correcto';
			}else{
					//si hubo errores, mostramos mensaje
				$this->session->set_flashdata('error', 'Empleados no registrado!');
				//redireccionamos
				$mensajes['error'] = 'Empleados no registrado!';
			}

		}
		echo json_encode($mensajes);
	}
	//metodo para editar
	public function edit($id)
	{
		$this->comprobacionRoles();
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'sucursales'=> $this->Sucursal_model->getSucursales(),
			'cargos'=> $this->Cargo_model->getCargos(),
			'categorias'=> $this->Categoria_model->getCategorias(),
			'depatamentosempresas'=> $this->Departamentoempresa_model->getDepartamentoempresas(),
			'estadociviles'=> $this->Estadocivil_model->getEstadociviles(),
			// 'cuentabancarias'=> $this->Cuentabancaria_model->getCuentabancarias(),
			'ciudades'=> $this->Ciudad_model->getCiudades(),
			'profesiones'=> $this->Profesion_model->getProfesiones(),
			'tipocuentas'=> $this->Tipocuenta_model->getTipocuentas(),
			'tiposalarios'=> $this->Tiposalario_model->getTiposalarios(),
			'paises'=> $this->Pais_model->getPaises(),
			// 'nrocuentas'=> $this->Cuentabancaria_model->getCuentabancarias(),
			'nivelestudios'=> $this->Nivelestudio_model->getNivelestudios(), 
			'empleado'=> $this->Empleados_model->getEmpleado($id),
			'hijos'=> $this->Hijos_model->getHijos($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empleados/edit', $data);
		$this->load->view('template/footer');
	}

	//actualizamos 

	public function update()
	{
		$this->comprobacionRoles();
		$mensajes = $this->data;
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 1080;
		$config['overwrite']           = true;
		$this->load->library('upload', $config);
		$idEmpleado = $this->input->post("CodEmpleado");
		$numEmpleado = $this->input->post("Numero");
		$nombre = $this->input->post("Nombre");
		$apellido = $this->input->post('Apellido');
		$observacion = $this->input->post('Observacion');
		$this->form_validation->set_rules("Nombre", "Nombres", "required");
		$this->form_validation->set_rules("Apellido", "Apellidos", "required");
		$this->form_validation->set_rules("CodEmpleado", "Codigo Empleado", "required");
		$this->form_validation->set_rules("Documento", "Documento de Identidad", "required");
		$this->form_validation->set_rules("Celular", "Celular", "required");
		$this->form_validation->set_rules("NumeroIPS", "Nro Ips", "required");
		$this->form_validation->set_rules("NroCuenta", "Nro Cuenta", "required");
		if ($this->form_validation->run() == FALSE){
			$mensajes['alerta'] = validation_errors('<b style="color:red"><ul><li>', '</ul></li></b>'); 
			// $this->session->set_flashdata('error', validation_errors());
			// redirect(base_url()."empleados/empleados/edit", "refresh");

		}else{
			if ( !$this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
				$perfil  ='';
			}else{
				$perfil = $this->upload->data();
				$data = file_get_contents('uploads/'.$perfil['file_name']);
				$base64 = base64_encode($data);
				$perfil = 'data:image/' . $perfil['image_type'] . ';base64,'.$base64;
			}
			$documento = $this->input->post('Documento');
			$direccion = $this->input->post("Direccion");
			$telefono   = $this->input->post("Telefono");
			$celular = $this->input->post('Celular');
			$fecha_nacimiento = $this->input->post('Nacimiento');
			$fechaIngreso = date("Y-m-d H:i:s");
			$fecha_salida = $this->input->post('Salida');
			$ruc = $this->input->post('Ruc');
			$estado_civil = $this->input->post('EstadoCivil');
			$pais = $this->input->post('Nacionalidad');
			$nivel_estudio = $this->input->post('NivelEstudio');
			$profesion = $this->input->post('Profesion');
			$ciudad = $this->input->post('Ciudad');
			$nro_cuenta = $this->input->post('NroCuenta');
			$sucursal = $this->input->post('Sucursal');
			$cargo = $this->input->post('Cargo');
			$tipo_salario = $this->input->post('TipoSalario');
			$deparmento = $this->input->post('Departamento');
			$categoria = $this->input->post('Categoria');
			$nro_ips = $this->input->post('NumeroIPS');
			$fecha_ips = $this->input->post('FechaIps');
			$fechaIngreso= date("Y-m-d H:i:s");
			$ultActualizacion= date("Y-m-d H:i:s");
			$empleado_actual = $this->Empleados_model->getEmpleado($idEmpleado);


			//indicar campos de la tabla a modificar
			$data = array(
				'idEmpleado'  => $idEmpleado,
				// 'numEmpleado'  => $numEmpleado,
				'nombre'  => $nombre,
				'apellido' => $apellido, 
				'observacion' => $observacion,
				'perfil' => $perfil,
				'cedulaidentidad' => $documento,
				'direccion'  => $direccion,
				'telefono'  => $telefono, 
				'celular' => $celular, 
				'fecnacimiento' => $fecha_nacimiento,
				'fechaingreso' => $fechaIngreso,
				'fechasalida' => $fecha_salida,
				'idcivil' => $estado_civil,
				'idnacionalidad' => $pais,
				'idnivel'=> $nivel_estudio,
				'idprofesion' => $profesion,
				'idciudad' => $ciudad,
				'nrocuenta' => $nro_cuenta,
				'idsucursal' => $sucursal,
				'idcargo' => $cargo,
				'iddepartemento' => $deparmento,
				'idcategoria' => $categoria,
				'numeroips' => $nro_ips,
				'fecingresoips' => $fecha_ips,
				'fechaIngreso'=>  $fechaIngreso,
				'fecgrabacion'=>  $ultActualizacion
			);
			$nombre_hijo = $this->input->post('nombrehijo');
			$apellido_hijo = $this->input->post('apellidohijo');
			$fecha_nacimiento_hijo = $this->input->post('fechanachijo');

			if($this->Empleados_model->update($idEmpleado,$data)){
				for ($i=0; $i < count($nombre_hijo) ; $i++) {
					if ($nombre_hijo[$i]!='') {
						$data = array(
							'idempleado'=> $idEmpleado,
							'idempresa'=>1,
							'nombre'=>$nombre_hijo[$i],
							'apellido'=>$apellido_hijo[$i],
							'fecnacimiento'=> $fecha_nacimiento_hijo[$i],
							'fecgrabacion'=> date("Y-m-d H:i:s")

						);
						if ($this->Hijos_model->save($data)) {
							$correcto = "Se ha asociado correctamente los hijos";	
						}
					} 
				}
				$this->session->set_flashdata('success', 'Actualizado correctamente!');
				$mensajes['correcto'] = 'correcto';
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
				$mensajes['error'] = 'Empleados no registrado, ya existe un Empleado con esa cedula!';
			}

		}
		echo json_encode($mensajes);
	}

	//funcion para borrar
	public function delete($idEmpleado)
	{
		$this->comprobacionRoles();
		$data = array(
			'ESTADOEMPLEADO' => '3',
		);
		// var_dump($idEmpleado);
		if($this->Empleados_model->update($idEmpleado,$data))
		{
			$this->session->set_flashdata('success', 'Anulado correctamente!');
				//retornamos a la vista para que se refresque
			echo "empleados/empleados/";

				//redirect(base_url()."servicios/servicios", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."empleados/empleados/list/".$id);
		}


	}
	public function legajos($idEmpleado)
	{
		$this->comprobacionRoles();
		$data['legajos'] = $this->Empleados_model->getLegajoEmpleado($idEmpleado);
		$data['empleado'] = $this->Empleados_model->getEmpleado($idEmpleado);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empleados/legajo', $data);
		$this->load->view('template/footer');
	}
	public function getEmpleado()
	{
		$this->comprobacionRoles();
		$idEmpleado = $this->input->post('funcionario', TRUE);
		echo json_encode($this->Empleados_model->getEmpleado($idEmpleado));
	}
	public function agregar_incidencia($idEmpleado)
	{
		$this->comprobacionRoles();
		$data['empleado'] = $this->Empleados_model->getEmpleado($idEmpleado);
		$data['tipoIncidencias'] = $this->Empleados_model->getTipoIncidencias();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('empleados/add_incidencia', $data);
		$this->load->view('template/footer');
	}

	public function getTipoIncidencia()
	{
		$this->comprobacionRoles();
		$idTipoIncidencia = $this->input->post('id');
		echo json_encode($this->Empleados_model->getTipoIncidencias($idTipoIncidencia));
	}

	public function storeIncidencia()
	{
		$this->comprobacionRoles();
		$tipo = $this->input->post('txtTipoIncidencia', TRUE);
		var_dump($tipo);
		$tipo = $this->Empleados_model->getTipoIncidencias(false, $tipo);
		$empleado = $this->input->post('empleado', TRUE);
		$fecha = $this->input->post('fecha_incidencia', TRUE);
		$obs = $this->input->post('observacion', TRUE);
		$data = array('IDEMPLEADO'=> $empleado,
			'IDEMPRESA'=>1,
			'IDTIPOINCIDENCIA' => $tipo->IDTIPOINCIDENCIA,
			'OBSERVACION'=>$obs, 
			'FECHA'=>$fecha,
			'FECGRABACION' =>date("Y-m-d H:i:s"));
		if ($this->Empleados_model->save_incidencias($data)) {
			$this->session->set_flashdata('success', 'Agregado correctamente!');
			redirect(base_url()."empleados/empleados/legajos/".$empleado, "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."empleados/empleados/legajos/".$empleado);
		}
	}
}