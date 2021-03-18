<?php

	/** Home page controller
	*
	*
	*/
	class Home extends CI_Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('home_model');
			header('Access-Control-Allow-Origin: *');
			//header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			$method = $_SERVER['REQUEST_METHOD'];
			if($method == "OPTIONS") { die(); }

			$username = $this->session->userdata('username');
			if(!$username){
				$this->logout();
			}
		}

    public function index()
		{
			$data = array('name' => $this->session->userdata('username') , );
			$this->load->view('home/inc/header_view');
			$this->load->view('home/home_view', $data);
			$this->load->view('home/inc/footer_view');
		}
		function logout()
		{
			$this->session->sess_destroy();
			redirect('/');
		}
  }


?>
