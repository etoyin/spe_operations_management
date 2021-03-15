<?php

	/** Home page controller
	*
	*
	*/
	class Login extends CI_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('Login_model');
			header('Access-Control-Allow-Origin: *');
			//header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == "OPTIONS") { die(); }
		}

/*----------------login page--------------------------*/

		public function index()
		{
			//$re = "((19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))";
			$this->load->view('home/inc/header_view');
			$this->load->view('home/login_view');
			$this->load->view('home/inc/footer_view');
		}
/*-------------------------------------------------------*/

/*===============login funtion========================*/
		public function login()
		{
			// to be sent to the browser for javascript to have access to
			//$this->output->set_content_type('application_json');
			$this->form_validation->set_rules('username', 'User name', 'required|min_length[3]');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run()==false){
			  //this result to be used by the client side(JavaScript)
			  //$this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
				$this->index();
				return false;
			}

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($this->Login_model->can_login($username, $password)){
				$session_data = array('username' => $username );
				$this->session->set_userdata($session_data);
				redirect(base_url(). 'Home');
			}else{
				$this->session->set_flashdata('error', 'Invalid username and Password');
				redirect(base_url(). '/');

			}
		}
		/*

		function dashboard()
		{
			if($this->session->userdata('username') != ''){
				//echo "<h2> Welcome-" .$this->session->userdata('username'). "</h2>";
			//	redirect(base_url(). 'Home/index');
			$data = array('name' => $this->session->userdata('username') , );
				$this->load->view('home/inc/header_view');
				$this->load->view('home/home_view', $data);
				$this->load->view('home/inc/footer_view');
			}
			else{
				redirect(base_url(). 'Login/index');
			}
		}

		function logout()
		{
			$this->session->unset_userdata('username');
			redirect(base_url(). 'Login/index');
		}*/


	}


?>
