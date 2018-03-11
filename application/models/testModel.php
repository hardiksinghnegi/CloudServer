<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class testModel extends CI_Model {

	public function testData(){
		$query=$this->query("select * from data where id=2");
		$set=$redis->set('Data1',$query);
		return $redis->get('Data1');
	}
}


?>
