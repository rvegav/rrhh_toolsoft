<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informediarios extends CI_Controller
{
	//solo el constructor, para llamar a las clases
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")){
			redirect(base_url());
		}

		//$this->load->model("Empleados_model");
		$this->load->model("Informediarios_model");
	}
	//esta funcion es la primera que se ejecuta para cargar los datos
	public function index()
	{	
		//cargamos un array usando el modelo
		$data = array(
			'procesocierres'=> $this->Procesocierres_model->getProcesocierre()
			    );        

		//llamamos a las vistas para mostrar
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('procesocierres/add', $data);
		$this->load->view('template/footer');
	}
	
	//funcion add para mostrar vistas
	public function add()
	{



$data = array(			
			'cuentas' => $this->Informediarios_model->getCuentaContable(),
			// 'empresas' => $this->Informediarios_model->getEmpresa()
			);
		$this->load->view('template/head');
		$this->load->view('template/menu');
		$this->load->view('Informediarios/add', $data);
		$this->load->view('template/footer');

	}
	//funcion vista
	public function view()
	{

    	$NUMERO   = $this->input->post("NUMERO");    
		$FECHADESDE   = $this->input->post("FECHADESDE");
		$FECHAHASTA   = $this->input->post("FECHAHASTA");
		$DESDEEMPRESA   = $this->input->post("EMPRESA");
		$HASTAEMPRESA   = $this->input->post("EMPRESA1");


//print_r($_POST); die();
if ($this->validar_fecha_espanol($FECHADESDE,$FECHAHASTA)){

	if(empty($NUMERO)){

		$data = array (
			'diarios'=> $this->Informediarios_model->getInformeDiario($FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA)
		);
		//print_r($data); die();
		$this->load->view('template/head');
		$this->load->view('template/menu');
        $this->load->view("Informediarios/view", $data);
		$this->load->view('template/footer');
	
	}
	else
	{
     $data = array (
			'diarios'=> $this->Informediarios_model->getInformeDiario1($NUMERO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA)
		);
		//print_r($data); die();
		$this->load->view('template/head');
		$this->load->view('template/menu');
        $this->load->view("Informediarios/view", $data);
		$this->load->view('template/footer');
	}
		
}
else
{
	$this->session->set_flashdata('error', 'Ingrese Fecha correcta!');

              redirect(base_url().'informediarios/informediarios/add', 'refresh');
}


	}
	//funcion para almacenar en la bd
	public function store()
	{

//print_r($_POST); die();

		//recibimos las variables

		$IDCIERRE   = $this->input->post("IDCIERRE");
        $DESDESUCURSAL   = $this->input->post("SUCURSAL");
        $HASTASUCURSAL   = $this->input->post("SUCURSAL1");
		$DESDEDEPARTAMENTO   = $this->input->post("DEPARTAMENTO");
		$HASTADEPARTAMENTO   = $this->input->post("DEPARTAMENTO1");
		$FECHADESDE   = $this->input->post("FECHADESDE");
		$FECHAHASTA   = $this->input->post("FECHAHASTA");
		$DESDEEMPRESA   = $this->input->post("EMPRESA");
		$HASTAEMPRESA   = $this->input->post("EMPRESA1");

			//print_r($DIAS); die();
			//aqui el arreglo, nombre de los campos de la tabla en la bd y las variables previamente cargada
        if ($IDCIERRE == 1){
	        $IDCIERRE = $IDCIERRE + 100;
           }
	

    if ($this->validar_fecha_espanol($FECHADESDE,$FECHAHASTA)){

    	$existe = $this->Procesocierres_model->existeCierre($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

    	//print_r($existe); die();

    	$variableexiste = $existe[0]['CANTIDAD'];

        if($variableexiste == 0){

        
      	
			//guardamos los datos en la base de datos
			if($this->save_procesocierre($IDCIERRE,$FECHADESDE,$FECHAHASTA,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA))
			{	

                  $maximo = $this->Procesocierres_model->getIdAsiento();

                  $idmaximo = $maximo[0]['MAXIMO'];


                  $data = array(
				'iddiario'  =>   $idmaximo,
				'idcierre'  =>  $IDCIERRE,
				'idusuario' => 1,
				'idempresa' => 1,
				'numasiento' => 0 + $idmaximo,
				'fechaasiento' => $FECHAHASTA,
				'generado'	 => 1		
			    );



				if($this->Procesocierres_model->saveAsiento($data)){ //CABECERA DE ASIENTOS CONTABLES 16/08/2018

					if($this->save_asientoDetalle($idmaximo,$IDCIERRE,$FECHADESDE,$FECHAHASTA,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA)) //DETALLES DE ASIENTOS CONTABLES 16/08/2018
			    {	



				//si todo esta bien, emitimos mensaje
				$this->session->set_flashdata('success', 'Proceso generado correctamente!');
				//echo " < script > alert('Servicio Agregado, ¡Gracias!.');</script > ";
				
				//redireccionamos y refrescamos
				redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
				// 	redirect(base_url()."servicios / servicios", "refresh");
				}
			  }
			}
			else
			{
					//si hubo errores, mostramos mensaje
					
				$this->session->set_flashdata('error', 'Movimiento no registrado!');
				//redirect(base_url()."servicios", "refresh");
				
				//redireccionamos
				redirect(base_url().'procesocierres/procesocierres/add', "refresh");
			}

    }
	else
	{
              $this->session->set_flashdata('error', 'Ya existe un proceso de cierre en este periodo!');

              redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
	}
}
else
{
              $this->session->set_flashdata('error', 'Ingrese Fecha correcta!');

              redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
}

}

protected function validar_fecha_espanol($fecha,$fechahasta){
	$valores = explode('-', $fecha);
	$valores1 = explode('-', $fechahasta);
//	print_r($valores);
//print_r($valores1); die();
	if (count($valores) == 3 && checkdate($valores[2], $valores[1], $valores[0])){
//print_r($valores1); die();
		if (count($valores1) == 3 && checkdate($valores1[1], $valores1[2], $valores1[0])){
			//print_r($valores1); die();
		return true;
		}
		else
		{
	     return false;			
		}
		
	}
	else
	{
	return false;	
	}
	
}


protected function save_procesocierre($idcierre,$fechadesde,$fechahasta,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA){
	
		$liquidacion =  $this->Procesocierres_model->obtenerMovimientos($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

//print_r($liquidacion); die();
try {

	for ($i=0; $i < count($liquidacion); $i++) {
 
$data = array(
			'idcierre' => $idcierre,
		    'idtipomovisueldo' => $liquidacion[$i]['IDTIPOMOV'],
		    'horamov' => $liquidacion[$i]['HORAS'],
		    'importemov' => $liquidacion[$i]['IMPORTE'],
		    'fechadesde' => $fechadesde,
		    'fechahasta' => $fechahasta,
		    'idempresa' => $liquidacion[$i]['IDEMPRESA'],
            'idsucursal' => $liquidacion[$i]['IDSUCURSAL'],
            'idempleado' => $liquidacion[$i]['IDEMPLEADO']		    		    
		);

        $this->Procesocierres_model->saveProcesocierre($data);

	}      
     	return true;

	} catch (Exception $e) {
			  //alert the user.
		return false;
	}
}


protected function save_asientoDetalle($idasiento,$idcierre,$fechadesde,$fechahasta,$DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA){
	
		$asientos =  $this->Procesocierres_model->obtenerAiento($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

//print_r($liquidacion); die();
try {

	for ($i=0; $i < count($asientos); $i++) {
 
$data = array(
			'iddiario' => $idasiento,
		    'idcuentacontable' => $asientos[$i]['IDCUENTACONTABLE'],
		    'IMPORTEDEBE' => $asientos[$i]['IMPORTE']		  	    		    
		);

        $this->Procesocierres_model->saveAsiento_detalle($data);

	}      
     	return true;

	} catch (Exception $e) {
			  //alert the user.
		return false;
	}
}





	
	//metodo para editar
	public function edit($id)
	{
		//recargamos datos en array, usando el modelo. ver en modelo, Servicios_model
		//print_r($id); die();
		$data = array(
			'movimientos'=> $this->Movimientos_model->getMovimiento($id),
			'tipoMovimientos'=>$this->Movimientos_model->getTipoMovimiento(),
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





	//actualizamos 
	
	public function eliminar()
	{

        $DESDESUCURSAL   = $this->input->post("SUCURSAL");
        $HASTASUCURSAL   = $this->input->post("SUCURSAL1");
		$DESDEDEPARTAMENTO   = $this->input->post("DEPARTAMENTO");
		$HASTADEPARTAMENTO   = $this->input->post("DEPARTAMENTO1");
		$FECHADESDE   = $this->input->post("FECHADESDE");
		$FECHAHASTA   = $this->input->post("FECHAHASTA");
		$DESDEEMPRESA   = $this->input->post("EMPRESA");
		$HASTAEMPRESA   = $this->input->post("EMPRESA1");
			//print_r($data); die();

if ($this->validar_fecha_espanol($FECHADESDE,$FECHAHASTA)){
	

		//traemos datos para no duplicarlos /  validacion
		$cierreEliminar = $this->Procesocierres_model->obtenerCierre($DESDESUCURSAL,$HASTASUCURSAL,$DESDEDEPARTAMENTO,$HASTADEPARTAMENTO,$FECHADESDE,$FECHAHASTA,$FECHADESDE,$FECHAHASTA,$DESDEEMPRESA,$HASTAEMPRESA);

	if($this->eliminarAsientodetalle($cierreEliminar))
	{

              if($this->eliminarAsiento($cierreEliminar)){

                 if($this->eliminarCierre($cierreEliminar)){
                   $this->session->set_flashdata('success', 'Eliminado correctamente!');
				   redirect(base_url().'procesocierres/procesocierres/add', 'refresh');

                 }
                 else
                 {
                 	$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				    redirect(base_url().'procesocierres/procesocierres/add', 'refresh'); 	
                 }

              }
              else
              {
             $this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url().'procesocierres/procesocierres/add', 'refresh'); 	
              }
            
		}
		else
		{
				$this->session->set_flashdata('error', 'Errores al Intentar Eliminar!');
				redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
		}
}
else
{
                $this->session->set_flashdata('error', 'Ingrese Fecha correcta!');
			redirect(base_url().'procesocierres/procesocierres/add', 'refresh');
}


			
		//}
	}



protected function eliminarAsientodetalle($idcierre){

try {

	for ($i=0; $i < count($idcierre); $i++) {

$cierre = $idcierre[$i]['IDCIERRE'];

		$iddiario = $this->Procesocierres_model->obtenerIdDiario($cierre);


$diario =$iddiario[0]['IDDIARIO'];
 
        $this->Procesocierres_model->eliminarAsientodetalle($diario);

	}      
     	return true;

	} catch (Exception $e) {
			  //alert the user.
		return false;
	}
}


protected function eliminarAsiento($idcierre){

try {

	for ($i=0; $i < count($idcierre); $i++) {
 
        $this->Procesocierres_model->eliminarAsiento($idcierre[$i]['IDCIERRE']);

	}      
     	return true;

	} catch (Exception $e) {
			  //alert the user.
		return false;
	}
}

protected function eliminarCierre($idcierre){

//print_r($idcierre); die();
try {

	for ($i=0; $i < count($idcierre); $i++) {
 
        $this->Procesocierres_model->eliminarCierre($idcierre[$i]['IDCIERRE']);

	}      
     	return true;

	} catch (Exception $e) {
			  //alert the user.
		return false;
	}
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

			//print_r($data);

			
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
		// $data = array(
		// 'idmovi' => $id,
		// );

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
		// $data = array(
		// 'idmovi' => $id,
		//print_r($id);	die();

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




}