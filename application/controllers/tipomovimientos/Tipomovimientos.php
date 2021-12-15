<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Asuncion');
class Tipomovimientos extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		$this->load->model("Tipomovimiento_model");
		$this->load->model("Plancuenta_model");
	}
	//esta funcion es la primera que se ejecuta para cargar los datos
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'tipos'=> $this->Tipomovimiento_model->getTipoMovimientos_Copia(),
			'detalles'=> $this->Tipomovimiento_model->getTipoDetalle()
		);

		//print_r($data); die();
			//print("<pre>".print_r($data,true)."</pre>");

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipomovimientos/list', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{

		$data = array(			
			'maximo' => $this->Tipomovimiento_model->getIdMaximo(),
			'maximodetalle' => $this->Tipomovimiento_model->getIdDetalle(),
			'cuentacontables' => $this->Plancuenta_model->getPlancuentas(true),
			'detalles'=> $this->Tipomovimiento_model->getTipoMovimientos_Copia()
		);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipomovimientos/add', $data);
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
		$this->load->view("tipomovimientos/view", $data);

	}

	//funcion para almacenar en la bd
	public function store(){
		//recibimos las variables
		$numTipoMov   = $this->input->post("NumTipoMovimiento");
		$desTipoMov   = $this->input->post("desTipoMovimiento");
		$importe   = $this->input->post("Importe");
		$porcentaje = $this->input->post('Porcentaje');
		$idCuentaContable  = $this->input->post("IdPlanCuenta");;
		$accion  = $this->input->post("accion");
		$tipo  = $this->input->post("tipo");
		$impresion  = $this->input->post("impresion");
		$recibo  = $this->input->post("recibo");
		$libro  = $this->input->post("libro");
		$detalle = $this->input->post("TipoDetalle");

		if(is_null($libro)){
			$libro = 0;	
		}
		elseif(is_null($recibo)){
			$recibo = 0;
		}
		$idTipoMov = $this->Tipomovimiento_model->ultimoNumero();
		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);
		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$idusuario = $_SESSION["usuario"];
		//corremos la validacion
		if($tipo == 1){
			$salarioMinimo = 1; $salarioBasico = 0; $salarioTotal = 0;
		}elseif ($tipo == 2){
			$salarioMinimo = 0; $salarioBasico = 1; $salarioTotal = 0;
		}elseif ($tipo == 3){
			$salarioMinimo = 0; $salarioBasico = 0; $salarioTotal = 1;
		}elseif ($tipo == 4){
			$salarioMinimo = 0; $salarioBasico = 0; $salarioTotal = 0;
		}
		//print_r($_POST); die();
		//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
		$data = array(
			'idtipomovisueldo' => $idTipoMov->MAXIMO,
			'numtipomov' => $numTipoMov,
			'destipomov' => strtoupper($desTipoMov),
			'sumaresta' => $accion,
			'porcentaje'=> $porcentaje,
			'salariominimo' => $salarioMinimo,
			'salariobasico' => $salarioBasico,
			'totalsalario' => $salarioTotal,
			'enrecibo' => $recibo,
			'libros' => $libro,
			'idplancuenta' => $idCuentaContable,
			'fecgrabacion' => $fechaActual
		);

		// echo "<pre>";
	 //    print_r($data);
		// echo "</pre>";

	 //    die();
			//guardamos los datos en la base de datos
		if($this->Tipomovimiento_model->save($data))
		{	

			$this->save_detalle($idTipoMov->MAXIMO,$detalle,$idusuario,$empresa,$fechaActual);

			//si todo esta bien, emitimos mensaje
			$this->session->set_flashdata('success', 'Tipo de Movimiento registrado correctamente!');
			//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
			
			//redireccionamos y refrescamos
			redirect(base_url().'tipomovimientos/tipomovimientos', 'refresh');
			// 	redirect(base_url()."servicios / servicios", "refresh");
		}
		else
		{
			//si hubo errores, mostramos mensaje

			$this->session->set_flashdata('error', 'Tipo de Movimiento no registrado!');
			//redirect(base_url()."servicios", "refresh");

			//redireccionamos
			redirect("tipomovimientos/list", "refresh");
		}		

	}

	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		$data = array(
			'tipomovimientos'=>$this->Tipomovimiento_model->getTipoMovimientos($id),
			'cuentacontables'=>$this->Plancuenta_model->getPlancuentas(),
			'tipomovidetalles'=> $this->Tipomovimiento_model->getTipomovidetalle($id)
		);
		// echo "<pre>";
		// var_dump($data);
		// echo "</pre>";

		// die();
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('tipomovimientos/edit',$data);
		$this->load->view('template/footer');
	}	
	public function update(){
		// die();
		$idTipoMovi = $this->input->post('IDTIPOMOVISUELDO', TRUE);
		$numTipoMov   = $this->input->post("NumTipoMovimiento");
		$desTipoMov   = $this->input->post("desTipoMovimiento");
		$importe   = $this->input->post("Importe");
		$porcentaje = $this->input->post('Porcentaje');
		$idCuentaContable  = $this->input->post("IdPlanCuenta");;
		$accion  = $this->input->post("accion");
		$tipo  = $this->input->post("tipo");
		$impresion  = $this->input->post("impresion");
		$recibo  = $this->input->post("recibo");
		$libro  = $this->input->post("libro");
		$detalle = $this->input->post("TipoDetalle");

		if(is_null($libro)){
			$libro = 0;	
		}
		elseif(is_null($recibo)){
			$recibo = 0;
		}
		// $idTipoMov = $this->Tipomovimiento_model->ultimoNumero();
		$time = time();
		$fechaActual = date("Y-m-d H:i:s",$time);
		$empresa = $_SESSION["Empresa"];
		$sucursal = $_SESSION["Sucursal"];
		$idusuario = $_SESSION["usuario"];
		//corremos la validacion
		if($tipo == 1){
			$salarioMinimo = 1; $salarioBasico = 0; $salarioTotal = 0;
		}elseif ($tipo == 2){
			$salarioMinimo = 0; $salarioBasico = 1; $salarioTotal = 0;
		}elseif ($tipo == 3){
			$salarioMinimo = 0; $salarioBasico = 0; $salarioTotal = 1;
		}elseif ($tipo == 4){
			$salarioMinimo = 0; 
			$salarioBasico = 0;
			 $salarioTotal = 0;
		}
		//print_r($_POST); die();
		//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
		$data = array(
			'numtipomov' => $numTipoMov,
			'destipomov' => strtoupper($desTipoMov),
			'sumaresta' => $accion,
			'porcentaje'=> $porcentaje,
			'salariominimo' => $salarioMinimo,
			'salariobasico' => $salarioBasico,
			'totalsalario' => $salarioTotal,
			'enrecibo' => $recibo,
			'libros' => $libro,
			'idplancuenta' => $idCuentaContable,
			'fecgrabacion' => $fechaActual
		);

		if($this->Tipomovimiento_model->update($idTipoMovi,$data)){
                //$this->Movimientos_model->update1($IDMOVI,$data);
			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."tipomovimientos/tipomovimientos", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."tipomovimientos/tipomovimientos/edit/".$idTipoMovi);
		}
		//}
		//else
		//{	
			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
		// $this->edit($idTipoMovi);
		//}
	}


	public function update1()
	{
		$idTipoMoviDetalle= $this->input->post("IDTIPOMOVIDETALLE");
		$idTipoMovi = $this->input->post("IDTIPOMOVISUELDO");

			//indicar campos de la tabla a modificar
		$data = array(
				//CULMNAS DE LAS TABLAS / VALORES DE LAS COLUMNAS
				//'NUMMOVI'     =>  $NUMMOVI,
			'IDTIPOMOVISUELDO'  =>  $idTipoMovi,
			'IDTIPOMOVIDETALLE'     =>   $idTipoMoviDetalle
		);
		$this->Movimientos_model->update1($idTipoMoviDetalle,$data);
		if($this->Tipomovimiento_model->update1($idTipoMoviDetalle,$data)){
			$this->session->set_flashdata('success', 'Actualizado correctamente!');
			redirect(base_url()."tipomovimientos/tipomovimientos", "refresh");
		}else{
			$this->session->set_flashdata('error', 'Errores al Intentar Actualizar!');
			redirect(base_url()."tipomovimientos/tipomovimientos/edit1/".$idTipoMoviDetalle);
		}

//$this->Movimientos_model->updateSSADAS1($IDMOVIDETALLE,$data)


		//}
		//else
		//{

			//si hubieron errores, recargamos la funcion que esta mas arriba, editar y enviamos nuevamente el id como parametro
		$this->edit1($idTipoMoviDetalle);

		//}
	}
	


    //buscador 19/07/2018
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
    // hasta aca buscador






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
		}
		else
		{
			$this->session->set_flashdata('error', 'Errores al Intentar Anular!');
			redirect(base_url()."/isupport/movimientos/movimientos", "refresh");
		}
		
		
	}


	protected function save_detalle($idCab,$idTipoMov,$usuario,$idEmpresa,$fecGra){
		for ($i=0; $i < count($idTipoMov); $i++) {
			$data = array(
				'idtipomovidetalle' => $idCab,
				'idtipomovisueldo' => $idTipoMov[$i],
				'idusuario' => $usuario,
				'idempresa' => $idEmpresa,
				'fecgra' => $fecGra
			);

			$this->Tipomovimiento_model->save_detalle($data);
		}      
	}
}