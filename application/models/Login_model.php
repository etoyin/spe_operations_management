<?php



/**
*
*/
class Login_model extends CI_Model
{

  public function can_login($username, $password)
  {
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $q = $this->db->get('users');

    if($q->num_rows() > 0){
      return true;
    }
    else{
      return false;
    }
  }

}







?>
