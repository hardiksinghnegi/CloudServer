<?php

//This model interacts with the database
class ModelLogin extends CI_Model
{	

	public function verifyEmail($emailId){

		$queryRes = $this->db->query("select uid from user_login where email_id=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();

		if(count($queryRes)==1){
			return True;
		}

		return False;
	}


	public function verifyAPIUser($emailId,$empId){
		$queryRes = $this->db->query("SELECT * FROM `user_login` INNER JOIN `user_detail` on `user_login.uid` = u`ser_detail.uid` where `user_login.email_id`=".$this->db->escape($emailId)." AND user_detail.emp_id=".$this->db->escape($empId)."");
		$queryRes = $queryRes->row_array();

		if(count($queryRes)==1){
			return True;
		}

		return False;
	}


	public function getHash($emailId){

		$queryRes = $this->db->query("select passwd_hash from user_login where email_id=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes['passwd_hash'];
	}

	public function setNonce($nonce,$emailId){
		// echo $nonce;
		$this->db->query("Update user_login SET usr_nonce =".$this->db->escape($nonce)." WHERE email_id=".$this->db->escape($emailId)."");
	}

	// public function delNonce($emailId){
	// 	// $this->db->query("Update user_login SET usr_nonce = 'NULL' WHERE email_id=".$this->db->escape($emailId)."");
	// }

	public function getUserInfo($emailId){

		$queryRes = $this->db->query("select * from user_login where email_id=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes;
	}

	public function startOnboarding(){

		$queryRes = $this->db->query("select uid from user_login ");
		$queryRes = $queryRes->result_array();
		
		if (count($queryRes)==0){
			return True;
		}

		return False;

	}

	public function createUser($fname,$mname,$lname,$company,$city,$state,$country,$email,$empId,$url,$password,$priviledge){

		$ul_array = array(
			'email_id' => $email,
			'passwd_hash' => $password,
			'usr_lvl' => $priviledge);

		$ud_array = array('emp_id' => $empId,
						  'f_name' => $fname,
						  'm_name' => $mname,
						  'l_name' => $lname,
						  'company' => $company,
						  'c_url' => $url,
						  'c_city' => $city,
						  'c_state' => $state,
						  'c_country' => $country

						);

		$this->db->insert('user_login',$ul_array);
		$this->db->insert('user_detail',$ud_array);
	}

	public function getUserDetail($userId){
		$queryRes = $this->db->query("select * from user_detail where emp_id=".$this->db->escape($userId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes;
	}

	public function getNonce($emailId){
		$queryRes = $this->db->query("select usr_nonce from user_login where email_id=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes['usr_nonce'];	
	}

	public function getUid($emailId){
		$queryRes = $this->db->query("select uid from user_login where email_id=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes['uid'];
	}

}