<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelpredis extends CI_Model {

	public function getData($query){

			$dbquery = $this->db->query($query);
			return $dbquery->result_array();		
	}	
}
?>