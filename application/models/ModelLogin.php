<?php

//This model interacts with the database
class ModelLogin extends CI_Model
{	

	public function verifyEmail($emailId){

		$queryRes = $this->db->query("select uid from userLogin where emailid=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();

		if(count($queryRes)==1){
			return True;
		}

		return False;
	}

	public function getSalt($emailId){

		$queryRes = $this->db->query("select pwdsalt from userLogin where emailid=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes['pwdsalt'];
	}

	public function getPassword($emailId){

		$queryRes = $this->db->query("select passwd from userLogin where emailid=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->row_array();
		return 	$queryRes['passwd'];
	}

	public function getUserInfo($emailId){

		$queryRes = $this->db->query("select * from userLogin where emailid=".$this->db->escape($emailId)."");
		$queryRes = $queryRes->result_array();
		return 	$queryRes;
	}

	public function startOnboarding(){

		$queryRes = $this->db->query("select uid from userLogin ");
		$queryRes = $queryRes->result_array();
		
		if (count($queryRes)==0){
			return True;
		}

		return False;

	}

}