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

	public function getFileInfo($uid){

		$queryRes = $this->db->query("SELECT file_info.file_name,file_info.size,file_info.chksum,file_info.down_perm,file_info.created_at from file_info INNER JOIN user_detail ON file_info.uid = user_detail.uid WHERE user_detail.emp_id=".$this->db->escape($uId)." and del_flag ='0'");

		//$queryRes = $this->db->query("SELECT file_name,size,chksum,down_perm,created_at from file_info where uid =".$this->db->escape($uid)." and del_flag ='0'");

		return $queryRes->result_array();
	}

	public function getUserSpace($uid){

		$queryRes = $this->db->query("SELECT alloted_space,free_space from user_detail WHERE uid =".$this->db->escape($uid)."");
		return $queryRes->row_array();
	}

	public function updateFileData($sid,$uid,$fileName,$fileSize,$fileHash,$uploadDate,$downPerm,$newFreeSpace){
		$this->db->query('UPDATE user_detail SET free_space='.$this->db->escape($newFreeSpace).' WHERE uid ='.$this->db->escape($uid).'');

		$fileRecord = array('s_id' => $sid,
							'uid' => $uid,
							'file_name' => $fileName,
							'size' => $fileSize,
							'chksum' => $fileHash,
							'created_at' => $uploadDate,
							'last_down' => NULL,
							'down_perm' => $downPerm,
							'delete_at' => NULL);
		$this->db->insert('file_info',$fileRecord);
	}

	public function fileExists($fileName,$uid){
		$queryRes = $this->db->query('SELECT * from file_info WHERE file_name ='.$this->db->escape($fileName).' AND uid='.$this->db->escape($uid).'');
		if($queryRes->num_rows() >=1){
			return True;
		}
		return False;

	}

	public function getFileRecord($fileName,$uid){
		$queryRes = $this->db->query('SELECT * from file_info WHERE file_name ='.$this->db->escape($fileName).' AND uid='.$this->db->escape($uid).'');
		$queryRes = $queryRes->row_array();
		return $queryRes;

	}

	public function getStorageData(){
		$queryRes = $this->db->query("SELECT s_id,s_free_space,s_ip,s_uname,s_passwd,s_keypath,s_port from storage_detail");
		$queryRes = $queryRes->result_array();
		return $queryRes;
	}

	public function updateStorageSpace($newFreeSpace,$sid){
		$this->db->query("UPDATE storage_detail SET s_free_space=".$newFreeSpace." WHERE s_id=".$sid." ");
	}

	public function getStorageCreds($sid){
		$queryRes = $this->db->query("SELECT s_ip,s_uname,s_passwd,s_keypath,s_port FROM storage_detail WHERE s_id = ".$this->db->escape($sid)."");
		return $queryRes->row_array();
	}

	public function fileDownloadDate($downloadDate,$fileName,$uid){
		$this->db->query("UPDATE file_info SET last_down =".$this->db->escape($downloadDate)." WHERE uid =".$this->db->escape($uid)." AND file_name =".$this->db->escape($fileName)." ");
	}
}