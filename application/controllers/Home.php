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

							$userPasswd = $this->input->post('txtPassword');
							$dbHash = $this->modelLogin->getHash($this->input->post('txtUserName'));
							

							if(password_verify($userPasswd,$dbHash)){
								$userInfo = $this->modelLogin->getUserInfo($this->input->post('txtUserName'));
								$userSession = array('emailId' => $userInfo['email_id'],
													  'userId' => $userInfo['uid'],
													  'privilege' => $userInfo['usr_lvl'],
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

		if($this->input->post('hideOnboard')=='1'){

			$this->load->library('form_validation');

			$this->form_validation->set_rules('firstName','First Name','required|callback_firstNameCheck');
			$this->form_validation->set_rules('lastName','Last Name','required|callback_lastNameCheck');
			$this->form_validation->set_rules('middleName','Middle Name','callback_middleNameCheck');
			$this->form_validation->set_rules('txtCompany','Company Name','required');
			$this->form_validation->set_rules('txtCity','City','required');
			$this->form_validation->set_rules('txtState','State','required');
			$this->form_validation->set_rules('txtCountry','Country','required');
			$this->form_validation->set_rules('txtEmail','Email','required|valid_email|is_unique[user_login.email_id]');
			$this->form_validation->set_rules('txtId','Employee ID','required');
			$this->form_validation->set_rules('txtUrl','URL','required|callback_urlVerify');
			$this->form_validation->set_rules('txtPassword','Password','required|callback_check_password|min_length[6]');
			$this->form_validation->set_rules('txtConfirm','Confirm Password','required|matches[txtPassword]');
			$this->form_validation->set_message('minlength', 'Password size must be greater or equal to 6');



			if($this->form_validation->run()){

				$this->load->view('success_view');
				$this->load->model('modelLogin');

				$fname = $this->input->post('firstName');
				$mname = $this->input->post('middleName');
				$lname = $this->input->post('lastName');
				$company = $this->input->post('txtCompany');
				$city = $this->input->post('txtCity');
				$state = $this->input->post('txtState');
				$country = $this->input->post('txtCountry');
				$email = $this->input->post('txtEmail');
				$empId = $this->input->post('txtId');
				$url = $this->input->post('txtUrl');
				$password = $this->input->post('txtPassword');
				$password = password_hash($password, PASSWORD_BCRYPT);
				$privilege = '0';

				$this->modelLogin->createUser($fname,$mname,$lname,$company,$city,$state,$country,$email,$empId,$url,$password,$privilege);
				
				$this->load->view('success_view');
				


			}
			else{
				$this->load->view('admin_view');
			}


	 	}
	 	else{
	 		redirect('home/loadHome');
	 	}

	
	}



	public function firstNameCheck(){
			$fname=$this->input->post('firstName');
			if(preg_match('/^[A-Za-z][A-Za-z. ]{0,31}$/', $fname))
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('firstNameCheck','Only alphabets in First Name');
				return false;
			}
		}

	public function middleNameCheck(){
			$mname=$this->input->post('middleName');
			if(preg_match('/^[A-Za-z][A-Za-z. ]{0,31}$/', $mname) || empty($mname))
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('middleNameCheck','Only alphabets in Middle Name');
				return false;
			}
		}


	public function lastNameCheck(){
			$lname=$this->input->post('lastName');
			if(preg_match('/^[A-Za-z][A-Za-z. ]{0,31}$/', $lname))
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('lastNameCheck','Only alphabets in Last Name');
				return false;
			}
		}
	public function urlVerify()
		{
			$url = $this->input->post('txtUrl');
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				return true;
			} else {
				$this->form_validation->set_message('urlVerify','Invalid URL Include http or https in your URL');
				return false;
			}
		}

	public function check_password()
	{
		//load the model
		$pass = $this->input->post('txtPassword');
		//if record found return true else send message
		if(preg_match ('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/', $pass))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_password','Please use strong Password (Requires One Uppercase letter, one number and one special Character)');
			return false;
		}
	}



}
