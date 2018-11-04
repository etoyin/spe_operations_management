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
		}
		public function index()
		{

			//$re = "((19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))";


			$this->load->view('home/inc/header_view');
			$this->load->view('home/home_view');
			$this->load->view('home/inc/footer_view');

		}

//		public $result;

		public function evaluate()
		{
		  // to be sent to the browser for javascript to have acess to
		  $this->output->set_content_type('application_json');

		  $this->form_validation->set_rules('appointDate', 'Date of appointment', 'required|exact_length[10]');
		  $this->form_validation->set_rules('levelAppoint', 'Level of appointment', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Level in this field'));
		  $this->form_validation->set_rules('stepAppoint', 'Step of appointment', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Step in this field'));

		  if (isset($_POST['datePromotion']) and isset($_POST['levelProm']) ) {
		    $this->form_validation->set_rules('datePromotion[]', 'Date of Promotion', 'required|exact_length[10]');
		    $this->form_validation->set_rules('levelProm[]', 'Level of Promotion', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Promotion Level in this field'));
		    //$this->form_validation->set_rules('levelProm', 'Level of Promotion', 'required|numeric');
		  }

		  //$this->load->helper('url')
		if($this->form_validation->run()==false){
		  //this result to be used by the client side(JavaScript)
		  $this->output->set_output(json_encode(['result' => 0, 'error' => $this->form_validation->error_array()]));
			return false;
		  }



			//die('Not ready');
		  //remember toset prev_level to $_post['datepromotion'][i] in every iteration

		  $appointDate = $this->input->post('appointDate');
		  $levelAppoint = $this->input->post('levelAppoint');
		  $stepAppoint = $this->input->post('stepAppoint');
			//$dob = $this->input->post('dob');


		  //$_POST['datePromotion'][0];

		  function noPromStepcounter($start, $stepcounter){
		    while (strtotime($start) < strtotime('2007-03-31')) {
					if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1989-1-1')) {
						switch ($stepcounter) {
							// Case 1 actually, the increment will take effect after this switch statement
							case 0:
								if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1988-7-1')) {
									$stepcounter = $stepcounter + 0;
									$start = '1989-1-1';
								}
								if (strtotime($start) >= strtotime('1988-7-1') and strtotime($start) < strtotime('1989-1-1')) {
									$stepcounter = $stepcounter + 1;
									$start = '1989-7-1';
								}
								break;
							// same as in case 0
							case 1:
								$stepcounter = $stepcounter + 0;
								$start = '1989-1-1';
								break;
							case 2:
								$stepcounter = $stepcounter + 0;
								$start = '1989-7-1';
								break;
							case 3:
								$stepcounter = $stepcounter - 1;
								$start = '1989-1-1';
								break;
							case 4:
								$stepcounter = $stepcounter - 1;
								$start = '1989-7-1';
								break;
							case 5:
								$stepcounter = $stepcounter - 2;
								$start = '1989-1-1';
								break;
							case 6:
								$stepcounter = $stepcounter - 2;
								$start = '1989-7-1';
								break;
							//default:
								# code...
								//break;
						}
						continue;
					}

		      if(strtotime($start) >= strtotime('1989-1-1')){
		        //$year = 1989;
		        for ($year=1989; $year <= 2007; $year++) {
		          if (strtotime($start) == strtotime("$year-1-1") and strtotime($start) == strtotime("$year-7-1")) {
		            break;
		          }
		          if(strtotime($start) > strtotime("$year-1-1") and strtotime($start) < strtotime("$year-7-1") ){
		            $start = "$year-1-1";
		            break;
		          }
		          if(strtotime($start) > strtotime("$year-7-1") and strtotime($start) <= strtotime("$year-12-31") ){
		            $start = "$year-7-1";
		            break;
		          }
		        }
		      }
		      $stepcounter = $stepcounter + 1;
		      $start = date("Y-m-d", strtotime('+1 year', strtotime($start)));
		    }
		    return $stepcounter;
		  }

		  function stepcounter($start, $date_of_promotion, $stepcounter, $prev_level, $level_at_promotion, $data, $appointDate){
				//$appointDate = $this->input->post('appointDate');
		    while(strtotime($start) < strtotime($date_of_promotion)){
				// for those that got appointment in 1988

		      if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1989-1-1') and strtotime($start) == strtotime($appointDate)) {
		        switch ($stepcounter) {
		          case 0:
		            if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1988-7-1')) {
		              $stepcounter = $stepcounter + 0;
		              $start = '1989-1-1';
		            }
		            if (strtotime($start) >= strtotime('1988-7-1') and strtotime($start) < strtotime('1989-1-1')) {
		              $stepcounter = $stepcounter + 1;
		              $start = '1989-7-1';
		            }
		            break;
		          case 1:
		            $stepcounter = $stepcounter + 0;
		            $start = '1989-1-1';
		            break;
		          case 2:
		            $stepcounter = $stepcounter + 0;
		            $start = '1989-7-1';
		            break;
		          case 3:
		            $stepcounter = $stepcounter - 1;
		            $start = '1989-1-1';
		            break;
		          case 4:
		            $stepcounter = $stepcounter - 1;
		            $start = '1989-7-1';
		            break;
		          case 5:
		            $stepcounter = $stepcounter - 2;
		            $start = '1989-1-1';
		            break;
		          case 6:
		            $stepcounter = $stepcounter - 2;
		            $start = '1989-7-1';
		            break;
		          //default:
		            # code...
		            //break;
		        }
		        continue;
		      }

		      if(strtotime($start) >= strtotime('1989-1-1')){
		        //$year = 1989;
		        for ($year=1989; $year <= 2007; $year++) {
		          if (strtotime($start) == strtotime("$year-1-1") or strtotime($start) == strtotime("$year-7-1")) {
		            break;
		          }
		          if(strtotime($start) > strtotime("$year-1-1") and strtotime($start) < strtotime("$year-7-1") ){
		            $start = "$year-1-1";
		            break;
		          }
		          if(strtotime($start) > strtotime("$year-7-1") and strtotime($start) <= strtotime("$year-12-31") ){
		            $start = "$year-7-1";
		            break;
		          }
		        }
		      }
						// for those that got appointment before 1988

					if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1989-1-1')) {
						switch ($stepcounter) {
							case 1:
								if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1988-7-1')) {
									$stepcounter = $stepcounter + 0;
									$start = '1989-1-1';
								}
								if (strtotime($start) >= strtotime('1988-7-1') and strtotime($start) < strtotime('1989-1-1')) {
									$stepcounter = $stepcounter + 1;
									$start = '1989-7-1';
								}
								break;
							case 2:
								$stepcounter = $stepcounter + 0;
								$start = '1989-1-1';
								break;
							case 3:
								$stepcounter = $stepcounter + 0;
								$start = '1989-7-1';
								break;
							case 4:
								$stepcounter = $stepcounter - 1;
								$start = '1989-1-1';
								break;
							case 5:
								$stepcounter = $stepcounter - 1;
								$start = '1989-7-1';
								break;
							case 6:
								$stepcounter = $stepcounter - 2;
								$start = '1989-1-1';
								break;
							case 7:
								$stepcounter = $stepcounter - 2;
								$start = '1989-7-1';
								break;
							//default:
								# code...
								//break;
						}
						continue;
					}


		      $stepcounter = $stepcounter + 1;
		      $start = date("Y-m-d", strtotime('+1 year', strtotime($start)));
		    }
//---------for those that got their promotion in the year 1988----------------------------------------------------------------------------------------------------------

		    //return $step;
		    foreach ($data[$level_at_promotion - 1] as $key => $value) {
		      if($data[$prev_level-1][$stepcounter + 1 ] <= $data[$level_at_promotion - 1][$key]){
		        $stepcounter = $key;
		        //echo "$key\n";
		        break;
		      }

		    }

		    return $stepcounter;

		  }


		  //$_POST['levelProm'][0]
		  $startdate = $appointDate;
		  $prev_level = $levelAppoint;

		  $stepcounter = $stepAppoint;
		  if (isset($_POST['datePromotion'])) {
		      $data=$this->home_model->get_table($_POST['datePromotion'][0]);
		      $stepcounter = stepcounter($startdate,
		                                  $_POST['datePromotion'][0],
		                                  $stepcounter = $stepcounter - 1,
		                                  $prev_level,
		                                  $_POST['levelProm'][0],
		                                  $data,
																			$appointDate);

		      $i = 1;
		      while ($i < sizeof($_POST['datePromotion'])) {
		        //initialize previous level tolevel at appointment
		        $data=$this->home_model->get_table($_POST['datePromotion'][$i]);
		        $stepcounter = stepcounter($_POST['datePromotion'][$i-1],
		                                    $_POST['datePromotion'][$i],
		                                    $stepcounter = $stepcounter - 1,
		                                    $_POST['levelProm'][$i-1],
		                                    $_POST['levelProm'][$i],
		                                    $data,
																				$appointDate);

		        //$prev_level = $_POST['levelProm'][$i];
		        $i = $i + 1;

		      }

		      $stepcounter = $stepcounter - 1;
		      $lastElement = sizeof($_POST['datePromotion']) - 1;
		      $start = $_POST['datePromotion'][$lastElement];
		      while (strtotime($start) < strtotime('2007-03-31') ) {
		        if(strtotime($start) >= strtotime('1989-1-1')){
		          //$year = 1989;
		          for ($year=1989; $year <= 2007; $year++) {
		            if (strtotime($start) == strtotime("$year-1-1") or strtotime($start) == strtotime("$year-7-1") ){
		              break;
		            }
		            if(strtotime($start) > strtotime("$year-1-1") and strtotime($start) < strtotime("$year-7-1") ){
		              $start = "$year-1-1";
		              break;
		            }
		            if(strtotime($start) > strtotime("$year-7-1") and strtotime($start) <= strtotime("$year-12-31") ){
		              $start = "$year-7-1";
		              break;
		            }
		          }
		        }
		        $stepcounter = $stepcounter + 1;
		        $start = date("Y-m-d", strtotime('+1 year', strtotime($start)));
		      }

				  $level = $_POST['levelProm'][$lastElement];
		  }
		  else{
		    $stepcounter = $stepcounter - 1;
		    $stepcounter = noPromStepcounter($startdate, $stepcounter);
		    $level = $levelAppoint;
		  }
		  ##########################################
		  ## To make sure the step does not increase beyond 15 for levels 1-10
		  #  not beyond 11 for levels 12-14
		  # and not beyond 9 for levels 15-17......
		  if($level<=10 and $stepcounter>15){
		    $stepcounter=15;
		  }
		  if($level>10 and $level<=14 and $stepcounter>11){
		    $stepcounter=11;
		  }
		  if($level>14 and $level<=17 and $stepcounter>9){
		    $stepcounter=9;
		  }
		  ##############################################

		  //global $result;
			$result = array(
		    'level' => $level,
		    'stepcounter' => $stepcounter
		  );

			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'evaluation' => $result]));
			}


		  //print_r($data);

		  //print_r($stepcount);*/


		}



	}


?>
