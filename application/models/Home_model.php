<?php



/**
* 
*/
class Home_model extends CI_Model
{
	
	public function get_table($date)
	{
		$sdate = strtotime($date);
		if($sdate >= strtotime('1975-10-01') and $sdate < strtotime('1977-06-01')){
			$q = $this->db->get('s_1-10-1975');
		}
		if ($sdate >= strtotime('1977-06-01') and $sdate < strtotime('1979-01-01')) {
			$q = $this->db->get('s_1-6-1977');
		}
		if ($sdate >= strtotime('1979-01-01') and $sdate < strtotime('1980-01-01')) {
			$q = $this->db->get('s_1979');
		}
		if ($sdate >= strtotime('1980-01-01') and $sdate < strtotime('1983-06-01')) {
			$q = $this->db->get('s_1980');
		}
		if ($sdate >= strtotime('1983-06-01') and $sdate < strtotime('1988-08-01')) {
			$q = $this->db->get('s_1-6-1983');
		}
		if ($sdate >= strtotime('1988-08-01') and $sdate < strtotime('1991-03-01')) {
			$q = $this->db->get('s1-8-1988');
		}
		if ($sdate >= strtotime('1991-03-01') and $sdate < strtotime('1992-07-01')) {
			$q = $this->db->get('s_1-3-1991');
		}
		if ($sdate >= strtotime('1992-07-01') and $sdate < strtotime('1993-01-01')) {
			$q = $this->db->get('ugss_1-7-92');
		}
		if ($sdate >= strtotime('1993-01-01') and $sdate < strtotime('1999-01-01')) {
			$q = $this->db->get('ugss_1-1-93');
		}
		if ($sdate >= strtotime('1999-01-01') and $sdate < strtotime('1999-05-01')) {
			$q = $this->db->get('hapss_1-1-1999');
		}
		if ($sdate >= strtotime('1999-05-01') and $sdate < strtotime('2000-05-01')) {
			$q = $this->db->get('hapss_1-5-1999');
		}
		if ($sdate >= strtotime('2000-05-01') and $sdate < strtotime('2005-11-01')) {
			$q = $this->db->get('hapss_1-5-2000');
		}
		if ($sdate >= strtotime('2005-11-01') and $sdate < strtotime('2007-03-01')) {
			$q = $this->db->get('hapss_1-11-2005');
		}
		if ($sdate >= strtotime('2007-03-01') and $sdate < strtotime('2007-03-31')) {
			$q = $this->db->get('hapss_1-3-2007');
		}


		//$q = $this->db->get($table);

		return $q->result_array();
	}
}







?>