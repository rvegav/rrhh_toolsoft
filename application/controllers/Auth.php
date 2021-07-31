<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	
	//funcion indice, abrir la vista login
	public function index()
	{
		//si ya esta logueado, que me cargue el controlador Dashboard
		if($this->session->userdata("login")){
			redirect(base_url()."dashboard");
		}else{
			//si login es !true, entonces q me diriga al login

            $data = array(
			'empresas'=> $this->Usuarios_model->getEmpresas(),
		    'sucursales'=> $this->Usuarios_model->getSucursales());

			$this->load->view('view_login', $data);
			
		}
	}
	
	public function login()
	{
			//otra manera de recibir los datos via post
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$empresa = $this->input->post("Empresa");
			$sucursal = $this->input->post("Sucursal");
            //session_start();
            $_SESSION["Empresa"]=1;
            $_SESSION["Sucursal"]=1;

			//print_r($_POST); die();

			//$res= $this->Usuarios_model->login($username, sha1($password));
			$res= $this->Usuarios_model->login($username, $password);


			// if($empresa == "0")
			// {
   //              $this->session->set_flashdata('error', 'Debe seleccionar una Empresa!');				
			// 	redirect(base_url());
			// }
			// else if($sucursal == "0")
			// {
			// 	$this->session->set_flashdata('error', 'Debe seleccionar una Sucursal');			 	
   //              redirect(base_url());
			// }
			// else
			// {
		
			  if(!$res){
					$this->session->set_flashdata('error', 'Problemas al iniciar Sesion, error en usuario o clave');
				 	//si no hay datos que me recargue login
					redirect(base_url());
			  }else{

			  	    $_SESSION["usuario"]= $res->IDUSUARIO;
				//si existe datos, que me cargue las variables de sesion
					$data= array(
					'IDEMPLEADO' => $res->IDEMPLEADO,
					'DESUSUARIO' => $res->DESUSUARIO,
					'NOMBRE' => $res->EMPLEADO,
					'PERFIL' => $res->PERFIL,
					'login'			=> TRUE
					);
					$this->session->set_userdata($data);
					$this->session->set_flashdata('success', 'Usuario registrado correctamente!');
					//y me rediriga al controlador Dashboard
					redirect(base_url()."dashboard");
				}
			// }
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	public function register()
	{

		if(isset($_POST['username']))
		{

			$this->form_validation->set_rules('password', 'Clave', 'required|min_length[6]');
			$this->form_validation->set_rules('password2', 'Repetir Clave', 'required|min_length[6]|matches[password]');

			//SI ESTA BIEN VALIDADO
			if($this->form_validation->run() == TRUE)
			{
				//agregar usuario en base de datos
				$data = array(
					'nomEmpleado'  =>	$_POST['name'] ,
					'username'     =>	$_POST['username'] ,
					//'email' =>$_POST['email'] ,
					'claveEmpleado'=>	md5($_POST['password'])
				);
				$this->db->insert('empleado', $data);
				$this->session->set_flashdata('success', 'Usuario registrado correctamente!');
				redirect("Auth/register", "refresh");
			}
		}
		$this->load->view('view_register');
		//abrir vista
	}
// public function ProcesoLogin()
// 	{
// 		$usuario = $this->input->post('usuario');
// 		$password = $this->input->post('password');
// 		$comprobar = $this->Login->ComprobacionCredenciales($usuario,$password);

// 		if ($comprobar!=false) {

// 			$data = array(
// 				'sist_conex' => 'A',
// 				'sist_funcod' => $comprobar->EMPL_COD,
// 				'sist_funnom' => $comprobar->FUNC,
// 				'sist_ofidesc' => $comprobar->ESOR_DESC,
// 				'sist_sededesc' => $comprobar->SEDE_DESC,
// 				'sist_estsede' => $comprobar->ESSE_ID,
// 				'sist_role' => $comprobar->USSI_ROL_ID,
// 				'sist_usuid'	=> $comprobar->USUF_ID,
// 				'sist_usuname'	=> $comprobar->USUF_NOMBRE,
// 				'sist_ultconx' => $comprobar->ULTI_CONX,
// 				'sist_depsupe' => $comprobar->DEPE_SUPE,
// 				'sist_sedeco' => $comprobar->SEDE_COD,
// 				'sist_estorg' => $comprobar->ESOR_COD,
// 				'sist_cargo' => $comprobar->CARGO
// 			);


// 			$this->session->set_userdata($data);
// 			$this->Login->update_estado_usuario_activo();
// 			$this->Login->update_estado_sistrol_activo();
// 			echo json_encode("correcto");
// 		}else{
// 			echo json_encode("incorrecto");
// 		}
// 	}

	 // if ($this->session->userdata('sist_conex')=="A") {
  //     echo $this->templates->render('modulos::v_opc_descmul');
  //   }else {
  //     redirect(base_url(),'refresh');
  //   }
	
}