<?php


	/**
	* 
	*/
	class User_model extends CI_Model
	{
		/**
		*@usage
		*Single:	$this->user_model->get(3);
		*All:		$this->user_model->get();
		*
		*/
		
		public function get($table)
		{
			//if($grade_level===null){
				$q = $this->db->get($table);
			//} else {
			//	$q = $this->db->get_where('hss1993', ['grade_level' => $grade_level]);
			//}
			
			return $q->result_array();
		}
	}

?>