<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function test()
	{
		$this->load->library('redis');
		$redis=$this->redis->get_redis();
		$this->load->helper('redis_helper');
		// $arr =  getControlList('29');
		// echo '<pre>';
		// print_r($arr);

		// $arr =  getAssessment('2','9');
		echo '<pre>';
		// print_r($arr);

		delFullControlList();

		// $list = $redis->keys("*");

		// print_r($list);

		// // echo $redis->get('assetcontrollist');
		// $redis->del('assetAssesment29');
		// echo 'done';
		
	}

	
}

