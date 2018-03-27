<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//This controller manages onboarding process and admin dashboard after signup and signin


class AdminDashboard extends CI_Controller {

	function __construct(){
		parent::__construct();

	}

	public function index(){
		if($this->session->userdata('is_logged_in')){
			$this->load->model('modelDashboard');
			if($this->modelDashboard->getSetupStatus()=='0'){

				$this->load->view('welcome_view');
			}
			else if($this->modelDashboard->getSetupStatus()=='1')
			{
				$this->load->view('storage_setup');
			}
			else if($this->modelDashboard->getSetupStatus()=='2')
			{
				$this->load->view('mgmt_view');
			}

		}
		else{
			redirect('home');
		}
	}



	public function storageSetup(){
		if($this->input->post("isAdmin")=='1' && $this->session->userdata('is_logged_in')){
			$this->load->model('modelDashboard');
			$this->modelDashboard->updateSetupStatus('1');

			$this->load->view('storage_setup');

		}
	}

	public function mgmtSetup(){
		if($this->input->post('hideStorage')=='1' && $this->session->userdata('is_logged_in')){

			$this->load->library('form_validation');
			$this->form_validation->set_rules("assetTag","Asset Tag","required|is_unique[storage_detail.s_tag]");
			$this->form_validation->set_rules("assetModel","Asset Model","required");
			$this->form_validation->set_rules("assetOS","Asset OS","required");
			$this->form_validation->set_rules("assetIP","Asset IP","required|valid_ip");
			$this->form_validation->set_rules("txtId","Username","required|callback_verifyConnect");
			$this->form_validation->set_rules("assetSpace","Storage Space (MB)","required|greater_than[0]");
			$this->form_validation->set_rules("txtPort","Connection Port","greater_than[0]|less_than[65536]");

			if($this->form_validation->run()){

				$this->load->model('modelDashboard');
				$this->modelDashboard->updateSetupStatus('2');

				$storageTag = $this->input->post('assetTag');
				$storageModel = $this->input->post('assetModel');
				$storageOS = $this->input->post('assetOS');
				$storageIP = $this->input->post('assetIP');
				$storageUname = $this->input->post('txtId');
				$storagePort = $this->input->post('txtPort');
				$storageSpace = $this->input->post('assetSpace');

				$storagePasswd = '';
				if(strlen($this->input->post('txtPass'))>0){

					$this->load->library('encryption');
					$encKey = $this->getKey();
					$this->encryption->initialize(
						array(
				        	'cipher' => 'aes-256',
				        	'mode' => 'ctr',
				        	'key' => $encKey
						)
					);

					$storagePasswd = $this->encryption->encrypt($this->input->post('txtPass'));
				}


				$keyPath = '';
				if(strlen($this->input->post('txtKey'))>0)
					$keyPath = $storageTag."_key.pem";


				$s_array = array('s_tag' => $storageTag,
								 's_model' => $storageModel,
								 's_os' => $storageOS,
								 's_total_space' => $storageSpace,
								 's_ip' => $storageIP,
								 's_uname' => $storageUname,
								 's_passwd' =>$storagePasswd,
								 's_keypath' => $keyPath,
								 's_port' =>$storagePort );

				$this->modelDashboard->updateStorageDetails($s_array);
				$this->modelDashboard->updateSetupStorage($storageSpace);

				$this->load->view('mgmt_view');
			}
			else{
				$this->load->view('storage_setup');
			}	

		}
		else{
			redirect('adminDashboard');
		}
	}

	function getKey(){

			$key = hex2bin('eafcb65122e0ff406d2d9658d152cd6a4a8d5b1ee34851b946b50e6bf1cb4f07');
			return $key;
	}

	public function verifyConnect(){

		$userName = $this->input->post('txtId');
		$ipAddr = $this->input->post('assetIP');
		$passwd = $this->input->post('txtPass');
		$sshKey = $this->input->post('txtKey');
		$assetTag = $this->input->post('assetTag');
		$returnVal = '';

		if(strlen($sshKey)>0){
			$filePath = $assetTag."_key.pem";
			$keyFile = fopen($assetTag."_key.pem", "w") or die("Unable to open file!");
			fwrite($keyFile, $sshKey);
			fclose($keyFile);
			$returnVal = exec('python ./pythonEngine/testConnect.py '.$ipAddr.' '.$userName.' '.$filePath.' 2 22');

		}
		else{
			$returnVal = exec('python ./pythonEngine/testConnect.py '.$ipAddr.' '.$userName.' '.$passwd.' 1 22');
		}

		if ($returnVal=='True')
			return True;
		else
			$this->form_validation->set_message('verifyConnect','Unable to connect using given credentials');
			return False;

	}

}