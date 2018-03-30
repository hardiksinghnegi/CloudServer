<?php

//This model interacts with the database
class ModelDashboard extends CI_Model
{	
	public function getSetupStatus(){
		$queryRes = $this->db->query("SELECT config_flag from setup_config");
		$queryRes = $queryRes->row_array();

		return $queryRes['config_flag'];
	}

	public function updateSetupStatus($updateVal){
		$this->db->query("UPDATE setup_config SET config_flag=".$this->db->escape($updateVal)."");
	}

	public function updateStorageDetails($storageInfo){
		$this->db->insert('storage_detail',$storageInfo);
	}

	public function updateSetupStorage($storageSpace){
		$this->db->query("UPDATE setup_config SET storage_count = 1, total_capacity =".$this->db->escape($storageSpace).", free_capacity=".$this->db->escape($storageSpace)."");
	}

	public function getMaxSpace(){
		$maxSpace = $this->db->query("Select free_capacity from setup_config");
		$maxSpace = $maxSpace->row_array();

		return $maxSpace['free_capacity'];
	}

	public function updateMgmtStorage($inputSpace,$inputPerm,$inputOpt){

		$this->db->query('UPDATE setup_config SET user_capacity='.$this->db->escape($inputSpace).', sec_perm='.$this->db->escape($inputPerm).', enforce_https='.$this->db->escape($inputOpt).'');

	}
}