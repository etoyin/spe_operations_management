<?php


	/**
	* 
	*/
	class User extends CI_Controller
	{
		
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('user_model');
		}
		public function get_param(){
			$data = $this->user_model->get('s_1980');
			print_r(sizeof($data));


		}

		
	}

?>