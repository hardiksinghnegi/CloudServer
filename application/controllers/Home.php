<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->loadHome();
	}

	public function loadHome(){
	
		if($this->session->userdata('is_logged_in')){
				redirect('home/testVal');
		}
		else{
				$this->load->view("login_view");
				$isSubmit = $this->input->post('isSubmit');

				if($isSubmit=='1'){
					$this->load->model('modelLogin');
					$userRes = $this->modelLogin->verifyEmail($this->input->post('txtUserName'));
					
					if ($userRes){

						$salt = $this->modelLogin->getSalt($this->input->post('txtUserName'));
						$userPasswd = $this->input->post('txtPassword');
						$userPasswd = $salt.$userPasswd;
						$userHash = hash("sha256", $userPasswd);

						$dbPasswd = $this->modelLogin->getPassword($this->input->post('txtUserName'));
						$dbPasswd = $salt.$dbPasswd;
						$dbHash = hash("sha256",$dbPasswd);

						if($dbPasswd==$userPasswd){
							$userInfo = $this->modelLogin->getUserInfo($this->input->post('txtUserName'));
							$userSession = array('emailId' => $userInfo['emailId'],
												  'userId' => $userInfo['uid'],
												  'privilege' => $userInfo['usrlvl'],
												  'is_logged_in' => true

											 );
							$this->session->set_userdata($userSession);
							redirect('home/testVal');
						}
					}
				
			}
		}
	}

	public function testVal(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('dashboard_view');
		}
		else{
			redirect('home/loadHome');
		}
	}

}