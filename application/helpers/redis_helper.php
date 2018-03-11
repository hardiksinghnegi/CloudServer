<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function readCache($query){
	
		$ci = &get_instance();
		$ci->load->library('redis');

		$redis=$ci->redis->get_redis();

		if ($redis->exists($query)){
		$get=$redis->get($query);
		return $get;
		}
		else{
			$ci->load->model('Modelpredis');
			$dbRecordsArr = $ci->Modelpredis->getData($query);
			$cacheJson = json_encode($dbRecordsArr);
			$set=$redis->set($query,$cacheJson);	
			return $cacheJson;
		}
	}

	function updateCache($query){

		$ci = &get_instance();
		$ci->load->library('redis');

		$redis=$ci->redis->get_redis();

		if($redis->exists($query)){
			$redis->mset(array($query => ''));
			$ci->load->model('Modelpredis');
			$dbRecordsArr = $ci->Modelpredis->getData($query);
			$cacheJson = json_encode($dbRecordsArr);
			$set=$redis->set($query,$cacheJson);	
			return $cacheJson;
		}
		else{
			echo "string";
		}
	}




	function getControlList($app){


			$ci = &get_instance();
			$ci->load->library('redis');
			$redis=$ci->redis->get_redis();
			$key = 'controlList'.$app;
			if ($redis->exists($key) && $ci->config->item('getControlList')){

				$get=$redis->get($key);
				return json_decode($get,TRUE);
			}
			else{
	
				$query = 'select * from assetcontrollist where applicability ='.$ci->db->escape_str($app);
				$dbRecords = $ci->db->query($query);
				if ($ci->config->item('getControlList')){
					$redis->set($key,json_encode($dbRecords->result_array()));
				}
				
				return $dbRecords->result_array();

			}

		}

	
	function delAppControlList($app){

		$ci = &get_instance();
		$ci->load->library('redis');
		$redis=$ci->redis->get_redis();
		$key = 'controlList'.$app;
		if ($redis->exists($key)){
			$redis->del($key);
		}
	}


	function delFullControlList(){

		$ci = &get_instance();
		$ci->load->library('redis');
		$redis=$ci->redis->get_redis();
		$keylist = $redis->keys("*controlList*");

		foreach ($keylist as $value) {
			$redis->del($value);
		}
	}


	function getAssessment($aId,$aHId=''){


			$ci = &get_instance();
			$ci->load->library('redis');
			$redis=$ci->redis->get_redis();
			$key = 'assetAssesment'.$aId.$aHId;

			if ($redis->exists($key) && $ci->config->item('getAssessment')){
				
				$get=$redis->get($key);
				return json_decode($get,TRUE);
			}
			else{


				$aHIdquery = ' and assetHeadId='.$ci->db->escape_str($aHId);

				if ($aHId == ''){
					$aHIdquery = '';
				}

				$query = 'select riskId from assetassesment where assetId ='.$ci->db->escape_str($aId).$aHIdquery;

				$dbRecords = $ci->db->query($query);
				if ($ci->config->item('getAssessment')){
					$redis->set($key,json_encode($dbRecords->result_array()));
				}
				
				return $dbRecords->result_array();

			}

		}

?>