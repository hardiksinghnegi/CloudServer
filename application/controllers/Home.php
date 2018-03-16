<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();


	}

	


	public function index(){
		$this->load->model('modelLogin');
		$bool = $this->modelLogin->startOnboarding();

		if($bool){
			$this->loadOnboarding();
		}
		else{
			$this->loadHome();
		}
	}


	public function loadOnboarding(){

		$this->load->model('modelLogin');
		$boolVal = $this->modelLogin->startOnboarding();
		if($boolVal){
			$this->load->view('admin_view');
		}
		else{
			redirect('home/loadHome');
		}
	}



	public function loadHome(){

		$this->load->model('modelLogin');
		$boolVal = $this->modelLogin->startOnboarding();

		if($boolVal){

			redirect('home/loadOnboarding');

		}
		else{
			if($this->session->userdata('is_logged_in')){
					redirect('home/testVal');
			}
		
			else{

					$this->load->view("login_view");
					$this->isSubmit = $this->input->post('isSubmit');
		
					if($this->isSubmit=='1'){
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
	}

	public function testVal(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('dashboard_view');
		}
		else{
			redirect('home/loadHome');
		}
	}

	public function logout(){
		if($this->session->userdata('is_logged_in')){
			$exitArray  = array('emailId' =>'' ,
								'userId' =>'',
								'privilege' =>'',
								'is_logged_in' => false

							 );
			$this->session->unset_userdata($exitArray);
			$this->session->sess_destroy();
			$this->load->helper('cookie');
			delete_cookie("csrf_cookie");
			redirect('home/loadHome');
		}
	}

	public function forgotPassword(){

		if($this->input->post('forgotPass')=='1'){
			$this->load->view('forgot_password_view');
		}
		else{
			redirect('home/loadHome');
		}

	}

	public function onboarding(){

		print_r($_POST);

	}

}