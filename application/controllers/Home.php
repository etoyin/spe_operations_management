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

/*-----------App Page (dashboard)--------------------------------*/
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

		public function evaluate()
		{
		  // to be sent to the browser for javascript to have acess to
		  $this->output->set_content_type('application_json');

		  $this->form_validation->set_rules('appointDate', 'Date of appointment', 'required|exact_length[10]');
		  $this->form_validation->set_rules('levelAppoint', 'Level of appointment', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Level in this field'));
		  $this->form_validation->set_rules('stepAppoint', 'Step of appointment', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Step in this field'));
			$this->form_validation->set_rules('sections', 'Section', 'required', array('required' => 'Select a Section'));


		  if (isset($_POST['datePromotion']) and isset($_POST['levelProm']) ) {
		    $this->form_validation->set_rules('datePromotion[]', 'Date of Promotion', 'required|exact_length[10]');
		    $this->form_validation->set_rules('levelProm[]', 'Level of Promotion', 'required|numeric|greater_than[0]', array('greater_than' => 'Select a Promotion Level in this field'));
		    //$this->form_validation->set_rules('levelProm', 'Level of Promotion', 'required|numeric');
		  }

			if(isset($_POST['mainstream'])){
				$this->form_validation->set_rules('mainstream', 'Mainstream', 'required', array('required' => 'Select a Section in Mainstream'));
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
			$sections = $this->input->post('sections');
			if($sections == 'mainstream'){
				$mainstream = $this->input->post('mainstream');
			}
			//$dob = $this->input->post('dob');

			

		  //$_POST['datePromotion'][0];

		  function noPromStepcounter($start, $stepcounter){
				$originalStart = $start;
				$monthCounter = 0;
				$enterIncrement = true;
				$count88 = true;
		    while(strtotime($start) < strtotime("2007-03-31")){
					
				// for those that got appointment in 1988
		      if ($count88 and strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1989-1-1')) {
						switch ($stepcounter) {
		          case 1:
		            if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1988-7-1')) {
		              $stepcounter = $stepcounter + 0;
		              $start = '1988-1-1';
		            }
		            if (strtotime($start) >= strtotime('1988-7-1') and strtotime($start) < strtotime('1989-1-1')) {
		              $stepcounter = $stepcounter + 1;
		              $start = '1988-7-1';
		            }
								$count88 = false;
		            break;
		          case 2:
		            $stepcounter = $stepcounter + 0;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 3:
		            $stepcounter = $stepcounter + 0;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          case 4:
		            $stepcounter = $stepcounter - 1;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 5:
		            $stepcounter = $stepcounter - 1;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          case 6:
		            $stepcounter = $stepcounter - 2;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 7:
		            $stepcounter = $stepcounter - 2;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          //default:
		            # code...
		            //break;
		        }
		      }

					//for thiose that started work after 1988
					if(strtotime($originalStart) >= strtotime('1989-1-1') and $enterIncrement){
						$count88 = false;
						$year = date("Y", strtotime($originalStart));
						
						if(strtotime($originalStart) > strtotime("$year-1-1") and strtotime($originalStart) < strtotime("$year-7-1") ){
							$start = "$year-1-1";
							$enterIncrement = false;
						}
						if(strtotime($originalStart) > strtotime("$year-7-1") and strtotime($originalStart) <= strtotime("$year-12-31") ){
							$start = "$year-7-1";
							$enterIncrement = false;
						}
					}

					if($count88 == false){
						$start = date("Y-m-d", strtotime('+1 month', strtotime($start)));
						$monthCounter = $monthCounter + 1;
						if($monthCounter === 12){
							$stepcounter = $stepcounter + 1;
							$monthCounter = 0;
						}
					}else{
						$is11 = $monthCounter == 11;
						$startMonth = date("m", strtotime($originalStart));
						$startday = date("d", strtotime($start));
						//$promotionMonth = date("m", strtotime($))

						if($is11 and ($startMonth == 01 or $startMonth == 07) and $startday > 01){
							$start = date("Y-m-d", strtotime('+1 day', strtotime($start)));
							//$this->output->set_output(json_encode(["result" =>1, "uiu" => $start]));
						}
						else{
							$start = date("Y-m-d", strtotime('+1 month', strtotime($start)));
							$monthCounter = $monthCounter + 1;
							//$this->output->set_output(json_encode(['result' => 1,'ty' => $monthCounter]));
						}
						if($monthCounter === 12){
							$stepcounter = $stepcounter + 1;
							$monthCounter = 0;
						}
					}
		    }
		    return $stepcounter;
		  }

		  function stepcounter(	$start, 
														$date_of_promotion, 
														$stepcounter, 
														$prev_level, 
														$level_at_promotion, 
														$data, 
														$appointDate,
														$sections){
				//$appointDate = $this->input->post('appointDate');
				$originalStart = $start;
				$monthCounter = 0;
				$count88 = true;
				$enterIncrement = true;
		    while(strtotime($start) < strtotime($date_of_promotion)){
				// for those that got appointment in 1988
		      if ($count88 and strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1989-1-1')) {
						switch ($stepcounter) {
		          case 1:
		            if (strtotime($start) >= strtotime('1988-1-1') and strtotime($start) < strtotime('1988-7-1')) {
		              $stepcounter = $stepcounter + 0;
		              $start = '1988-1-1';
		            }
		            if (strtotime($start) >= strtotime('1988-7-1') and strtotime($start) < strtotime('1989-1-1')) {
		              $stepcounter = $stepcounter + 1;
		              $start = '1988-7-1';
		            }
								$count88 = false;
		            break;
		          case 2:
		            $stepcounter = $stepcounter + 0;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 3:
		            $stepcounter = $stepcounter + 0;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          case 4:
		            $stepcounter = $stepcounter - 1;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 5:
		            $stepcounter = $stepcounter - 1;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          case 6:
		            $stepcounter = $stepcounter - 2;
		            $start = '1988-1-1';
								$count88 = false;
		            break;
		          case 7:
		            $stepcounter = $stepcounter - 2;
		            $start = '1988-7-1';
								$count88 = false;
		            break;
		          //default:
		            # code...
		            //break;
		        }
		      }

		      if(strtotime($originalStart) >= strtotime('1989-1-1') and $enterIncrement){
						$count88 = false;
						$year = date("Y", strtotime($originalStart));
						
						if(strtotime($originalStart) > strtotime("$year-1-1") and strtotime($originalStart) < strtotime("$year-7-1") ){
							$start = "$year-1-1";
							$enterIncrement = false;
						}
						if(strtotime($originalStart) > strtotime("$year-7-1") and strtotime($originalStart) <= strtotime("$year-12-31") ){
							$start = "$year-7-1";
							$enterIncrement = false;
						}
					}
						

					if($count88 == false){
						$start = date("Y-m-d", strtotime('+1 month', strtotime($start)));
						$monthCounter = $monthCounter + 1;

						if($monthCounter === 12){
							$stepcounter = $stepcounter + 1;
							$monthCounter = 0;
						}
					}else{
						$is11 = $monthCounter == 11;
						$startMonth = date("m", strtotime($originalStart));
						$startday = date("d", strtotime($start));
						//$promotionMonth = date("m", strtotime($))

						if($is11 and ($startMonth == 01 or $startMonth == 07) and $startday > 01){
							$start = date("Y-m-d", strtotime('+1 day', strtotime($start)));
							//$this->output->set_output(json_encode(["result" =>1, "uiu" => $start]));
						}
						else{
							$start = date("Y-m-d", strtotime('+1 month', strtotime($start)));
							$monthCounter = $monthCounter + 1;
							//$this->output->set_output(json_encode(['result' => 1,'ty' => $monthCounter]));
						}

						if($monthCounter === 12){
							$stepcounter = $stepcounter + 1;
							$monthCounter = 0;
						}
					}
					
		    }
//---------for those that got their promotion in the year 1988----------------------------------------------------------------------------------------------------------
				if($level_at_promotion >= 12){
					$level_at_promotion = $level_at_promotion - 1;
				}
				if($prev_level >= 12){
					$prev_level = $prev_level - 1;
				}
				$progressor = 1;
				if($sections == 'subeb' or $sections == 'local'){
					$progressor = 0;
				}
		    //return $step;
		    foreach ($data[$level_at_promotion - 1] as $key => $value) {
		      if($data[$prev_level-1][$stepcounter + $progressor ] <= $data[$level_at_promotion - 1][$key]){
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

					$data=$this->home_model->get_main_tepo_table($_POST['datePromotion'][0]);
					if($sections == 'local' or $sections == 'subeb'){
						$data=$this->home_model->get_localSubeb_table($_POST['datePromotion'][0]);
					}
		      
		      $stepcounter = stepcounter($startdate,
		                                  $_POST['datePromotion'][0],
		                                  $stepcounter,
		                                  $prev_level,
		                                  $_POST['levelProm'][0],
		                                  $data,
																			$appointDate,
																			$sections);

		      $i = 1;
		      while ($i < sizeof($_POST['datePromotion'])) {
						$data=$this->home_model->get_main_tepo_table($_POST['datePromotion'][$i]);
					
						if($sections == 'local' or $sections == 'subeb'){
							$data=$this->home_model->get_localSubeb_table($_POST['datePromotion'][$i]);
						}
					
						//initialize previous level tolevel at appointment
		        //$data=$this->home_model->get_table($_POST['datePromotion'][$i]);
		        $stepcounter = stepcounter($_POST['datePromotion'][$i-1],
		                                    $_POST['datePromotion'][$i],
		                                    $stepcounter,
		                                    $_POST['levelProm'][$i-1],
		                                    $_POST['levelProm'][$i],
		                                    $data,
																				$appointDate,
																				$sections);

		        //$prev_level = $_POST['levelProm'][$i];
		        $i = $i + 1;

		      }

		      //$stepcounter = $stepcounter - 1;
		      $lastElement = sizeof($_POST['datePromotion']) - 1;
		      $start = $_POST['datePromotion'][$lastElement];
					$monthCounter = 0;
					$enterIncrement = true;
		      while (strtotime($start) < strtotime('2007-03-31') ) {
		        $start = date("Y-m-d", strtotime('+1 month', strtotime($start)));
						$monthCounter = $monthCounter + 1;

						if($monthCounter == 12){
							$stepcounter = $stepcounter + 1;
							$monthCounter = 0;
						}
		      }

				  $level = $_POST['levelProm'][$lastElement];
		  }
		  else{
		    //$stepcounter = $stepcounter - 1;
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


		}



	}


?>
