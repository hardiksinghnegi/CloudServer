<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class testModel extends CI_Model {

	public function testData(){

		$query = 'select * from task';
		$this->load->helper('common_helper');
		$getData=readCache($query);

		echo $getData;
		
	}

	public function updateData(){

		$query = 'update assetassesment set status="NA" where assetHeadId=2 and assetId=2';
		$this->load->helper('common_helper');	
		$getData=updateCache($query);

		echo $getData;
		
	}	
}
?>



