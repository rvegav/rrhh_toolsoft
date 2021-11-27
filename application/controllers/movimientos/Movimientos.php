<?php
date_default_timezone_set('America/Santiago');
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public $date;
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}
        // $this->date = new Datetime();
		$this->date = new Datetime('2021-11-01');
		$this->load->model("Empleados_model");
		$this->load->model("Movimientos_model");
	}
	//esta funcion es la primera que se ejecuta para cargar los datos
	public function index()
	{	
		//cargamos un array usando el modelo
		$fecha = strftime("%B, %Y", $this->date->getTimestamp());
		$mes =strftime("%m", $this->date->getTimestamp());
		$anho = strftime("%Y", $this->date->getTimestamp());
		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimientosCabecera($mes, $anho),
			'empleados'=>$this->Empleados_model->getEmpleados(),
			'mes'=> $fecha
		);
		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{
		$data = array(			
			'empleados' => $this->Empleados_model->getEmpleados(),
			'maximos' => $this->Movimientos_model->getIdMaximo(),
			'empleados1' => $this->Movimientos_model->getEmpleado1(),
			'tipoMovimientos' => $this->Movimientos_model->getTipoMovimientos(),
			'maximodetalle' => $this->Movimientos_model->getIdDetalle()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view($idMovi)
	{
		$data = array (
			'movimientos'=> $this->Movimientos_model->getMovimientoDetalle($idMovi),
			'empleados'=>$this->Movimientos_model->getEmpleado()
		);
		//abrimos la vista view
		$this->load->view("movimientos/view", $data);

       //prueba de vista para detalles

		$IDMOVI = $this->input->post("IDMOVI");

		//hasta aca


	}
	public function store(){
		$TIPOMOVIMIENTO   = $this->input->post("txtTipoMovi");
		$idTipoMovi = $this->Movimientos_model->getTipoMovimientos(false, $TIPOMOVIMIENTO);
		$FECHAMOVI   = $this->input->post("fechamovi");
		$empleados   = $this->input->post("empleados");
		$dias   = $this->input->post("dias");
		$horas   = $this->input->post("horas");
		$importes   = $this->input->post("importes");
		// $this->form_validation->set_rules("NUMMOVI", "NUMMOVI", "required|is_unique[MOVISUELDO.NUMMOVI]");
		//corremos la validacion
		// if($this->form_validation->run()){
			$data = array(
				'IDTIPOMOVISUELDO'  => $idTipoMovi->IDTIPOMOVI,//MIENTRAS
				'FECHAMOVI'  => $FECHAMOVI,
				'IDEMPRESA' => 1,
				'IDMONEDA' => 1
			);
			$id = $this->Movimientos_model->save($data);
			if($id>0){
				if ($this->save_detalle($id,$empleados,$dias,$horas,$importes)) {
					$this->session->set_flashdata('success', 'Movimiento registrado correctamente!');
					redirect(base_url().'movimientos/movimientos', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Movimiento no registrado! por acá');
					//redirect(base_url()."servicios", "refresh");
					redirect("movimientos/movimientos", "refresh");	
				}

			}else{
				$this->session->set_flashdata('error', 'Movimiento no registrado!');
				//redirect(base_url()."servicios", "refresh");
				redirect("movimientos/movimientos", "refresh");
			}
		// }else{
		// 	$this->session->set_flashdata('error', 'Movimiento no registrado!');
		// 		//redirect(base_url()."servicios", "refresh");
		// 		redirect("movimientos/list", "refresh");
		// }

	}


	protected function save_detalle($idmovi,$empleados,$dias,$horas,$importe){
		for ($i=0; $i < count($importe); $i++) {
			$data = array(
				'idmovi' => $idmovi,
				'idempleado' => $empleados[$i],
				'dias' => $dias[$i],
				'horas' => $horas[$i],
				'importe' => $importe[$i]
			);

			$this->Movimientos_model->save_detalle($data);

		}      

	}



	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		//print_r($id); die();
		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimiento($id),
			'tipoMovimientos'=>$this->Movimientos_model->getTipoMovimientos(),
			'empleados'=>$this->Movimientos_model->getEmpleado(),
			'movimientos_detalle'=> $this->Movimientos_model->getMovimientoDetalle($id)


		);

        //print_r($data); die();

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/edit',compact('data'));
		$this->load->view('template/footer');
	}


	public function edit1($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model

		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimientoDetalle($id),
			'tipoMovimientos'=>$this->Movimientos_model->getTipoMovimiento(),
			'empleados'=>$this->Movimientos_model->getEmpleado()

		);

        //print_r($data);

		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/edit1', $data);
		$this->load->view('template/footer');
	} 

	public function update()
	{

		$IDMOVI= $this->input->post("IDMOVI");
		$NUMMOVI= $this->input->post("NUMMOVI");
		$NUMTIPOMOV= $this->input->post("IDTIPOMOVISUELDO");
		$FECHAMOVI= $this->input->post("FECHAMOVI"); 
		$EMPLEADO   = $this->input->post("EMPLEADO");
		$DIAS   = $this->input->post("DIAS");
		$HORAS   = $this->input->post("HORAS");
		$IMPORTE   = $this->input->post("IMPORTE");
		$IDMOVIDETALLE = $this->input->post("IDMOVIDETALLE");

		//traemos datos para no duplicarlos /  validacion
		$movimiento_actual = $this->Movimientos_model->getMovimiento($IDMOVI);


       //$this->form_validation->set_rules("NUMMOVI", "NUMMOVI", "required|is_unique[MOVISUELDO.NUMMOVI]");


        //if($this->form_validation->run())
		//{

			//indicar campos de la tabla a modificar
		$data = array(
			'FECHAMOVI'  =>   $FECHAMOVI,
			'IDTIPOMOVISUELDO'     =>  $NUMTIPOMOV,
			'IDEMPLEADO' => $EMPLEADO,
			'DIAS' => $DIAS,
			'HORAS' => $HORAS,
			'IMPORTE' => $IMPORTE, 
			'IDMOVIDETALLE' => $IDMOVIDETALLE		
		);


		if($this->Movimientos_model->update($IDMOVI,$data))
		{

			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."movimientos/movimientos", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."movimientos/movimientos/edit/".$IDMOVI);
		}
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
		$this->edit($IDMOVI);
		//}
	}

	public function update1()
	{
		$IDMOVI= $this->input->post("IDMOVI");
		$IDMOVIDETALLE = $this->input->post("IDMOVIDETALLE");
		$EMPLEADO= $this->input->post("EMPLEADO");
		$DIAS= $this->input->post("DIAS");
		$HORAS= $this->input->post("HORAS"); 
		$IMPORTE= $this->input->post("IMPORTE");
		$OBSERVACION= $this->input->post("OBSERVACION");

		echo ($this->input->post("OBSERVACION"));

		//traemos datos para no duplicarlos /  validacion
		$movimiento_actual = $this->Movimientos_model->getMovimiento($IDMOVI);
			//indicar campos de la tabla a modificar
		$data = array(
				//CULMNAS DE LAS TABLAS / VALORES DE LAS COLUMNAS
				//'NUMMOVI'     =>  $NUMMOVI,
			'IDMOVI'  =>  $IDMOVI,
			'IDEMPLEADO'     =>   $EMPLEADO,
			'DIAS'     =>  $DIAS,
			'HORAS'     =>  $HORAS,
			'IMPORTE'     =>  $IMPORTE,
			'OBSERVACION'     =>  $OBSERVACION
		);

		$this->Movimientos_model->update1DFSDF($IDMOVIDETALLE,$data);

		if($this->Movimientos_model->update1($IDMOVIDETALLE,$data))
		{
			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."movimientos/movimientos", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."movimientos/movimientos/edit1/".$IDMOVIDETALLE);
		}

//$this->Movimientos_model->updateSSADAS1($IDMOVIDETALLE,$data)


		//}
		//else
		//{

			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
		$this->edit1($IDMOVIDETALLE);

		//}
	}
	public function buscar(){       
		$search_data = $this->input->post('nombre');

		$result = $this->Movimienros_model->get_autocomplete($search_data);

		if (!empty($result))
		{
			foreach ($result as $row){
				echo "<li><a href='#'>" . $row->alimento . "</a></li>";
			}     
		}
		else
		{
			echo "<li> <em> No se encuentra ... </em> </li>";
		} 
	}
	//funcion para borrar
	public function delete($id){

		if($this->Movimientos_model->deletedetalle($id))
		{

			if($this->Movimientos_model->deleteCabecera($id)){
				$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					

				redirect(base_url()."/movimientos/movimientos", "refresh");
			}else{
				$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url()."/movimientos/movimientos", "refresh");		
			}

				//retornamos a la vista para que se refresque
				//echo "empleados/empleados/";

				//redirect(base_url()."servicios/servicios", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."/movimientos/movimientos", "refresh");
		}


	}



	public function deleteView($id){

		if($this->Movimientos_model->deleteDetalleView($id))
		{

			$this->session->set_flashdata('success', 'Registro eliminado correctamente!');					

			redirect(base_url()."/movimientos/movimientos", "refresh");

				//retornamos a la vista para que se refresque
				//echo "empleados/empleados/";

				//redirect(base_url()."servicios/servicios", "refresh");
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."/isupport/movimientos/movimientos", "refresh");
		}
	}
	public function obtenerTipoMovimiento(){
		$codigo = $this->input->post('tipo');
		$tipo = $this->Movimientos_model->getTipoMovimientos($codigo);
		echo json_encode($tipo);
	}

	public function list_concepto(){
		$data = array(
			'conceptos'=> $this->Movimientos_model->getConceptoFijos()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/concepto_fijo_list', $data);
		$this->load->view('template/footer');
	}

	public function add_concepto(){
		$data = array(			
			'empleados' => $this->Empleados_model->getEmpleados(),
			'tipoMovimientos' => $this->Movimientos_model->getTipoMovimientos(),
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/concepto_fijo_add', $data);
		$this->load->view('template/footer');
	}
	public function storeConceptoFijos(){
		$empleados = $this->input->post('empleados', TRUE);
		$tipos = $this->input->post('tipo', TRUE);
		$importes = $this->input->post('importes', TRUE);
		$desde = $this->input->post('desde', TRUE);
		$hasta = $this->input->post('hasta', TRUE);
		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);
		for ($i=0; $i <count($empleados) ; $i++) { 
			$data['IDEMPLEADO'] = $empleados[$i];
			$data['IDSUCURSAL'] = 1;
			$data['IDEMPRESA'] = 1;
			$data['IDTIPOMOVISUELDO'] = $tipos[$i];
			$data['IDMONEDA'] = 1;
			$data['IMPORTE'] = $importes[$i];
			$data['FECDESDE'] = $desde[$i];
			$data['FECHASTA'] = $hasta[$i];
			$data['OBSERVACION'] = "";
			$data['FECGRABACION'] = $fechaActual;
			$data['ESTADO'] = 'A';

			if (!$this->Movimientos_model->insertConceptosFijos($data)) {
				$this->session->set_flashdata('error', 'Ha ocurrido un error durante la operacion!');					
				redirect(base_url()."concepto_fijo", "refresh");
			}
		}
		$this->session->set_flashdata('success', 'Se ha registrado correctamente!');					
		redirect(base_url()."concepto_fijo", "refresh");
	}
	public function getEmpleadoConceptos(){
        	//retorna los empleados por tipo de movimiento
		$tipo = $this->input->post('tipo', TRUE);
		echo json_encode($this->Movimientos_model->getEmpleadoConceptos($tipo));
	}
	public function editConcepto($id){

		$data = array(			
			'empleados' => $this->Empleados_model->getEmpleados(),
			'conceptoEmpleados'=> $this->Movimientos_model->getEmpleadoConceptos($id)
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('movimientos/concepto_fijo_edit', $data);
		$this->load->view('template/footer');
	}

	public function getConceptoFijos(){
		$id = $this->input->post('concepto', TRUE);
		echo json_encode($this->Movimientos_model->getEmpleadoConceptos(false, $id));
	}

	public function updateConceptoFijo(){
		$id = $this->input->post('id');
		$desde = $this->input->post('desde', TRUE);
		$hasta = $this->input->post('hasta', TRUE);
		$importe = $this->input->post('importe', TRUE);
		if (!$this->Movimientos_model->updateConceptoFijo($importe, $desde, $hasta, $id)) {
			echo json_encode("error");
		}else{
			echo json_encode("correcto");
		}
	}
	public function deleteConceptoFijo(){
		$id = $this->input->post('id', TRUE);
		if (!$this->Movimientos_model->deleteConceptoFijo($id)) {
			echo json_encode("error");
		}else{
			echo json_encode("correcto");
		}
	}
	public function getEmpleadoMovimentos(){
		$idMovi = $this->input->post('idmovi', TRUE);
		echo json_encode($this->Movimientos_model->getEmpleadosMovimiento($idMovi));
	}
}