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


}