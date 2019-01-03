<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class download extends CI_Model {

	
	function insert_info($userid,$product_id,$token,$expiry_date){
		
		$this->db->select('filename');
		$this->db->from('file');
		$this->db->where('id',$product_id);
		$query = $this->db->get();
		$data = $query->row();
		$data = array(
			'user_id' => $userid,
			'token'=> $token,
			'filepath' => $data->filename,
			'product_id' => $product_id,
			'expare_date'  => date('Y-m-d H:m:s', strtotime('+'.$expiry_date.'5 days'))
		);
		$this->db->insert('download_log',$data); 
	}
	

}
