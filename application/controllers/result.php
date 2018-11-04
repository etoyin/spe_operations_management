<?php
/*
* Result controller
*/
/**
 *
 */
  class Result extends CI_Controller
  {
    public function __construct()
    {
      parent:: __construct();
      $this->load->model('home_model');
    }

    public function index()
    {
      $this->load->view('home/inc/header_view');
    	$this->load->view('home/result_view', $result);
    	$this->load->view('home/inc/footer_view');
    }


  }

 ?>
