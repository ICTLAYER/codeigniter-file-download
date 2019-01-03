<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

	
	function check_validity($email,$password){
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
}
