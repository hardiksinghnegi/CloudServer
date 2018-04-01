<?php

require(APPPATH.'/libraries/REST_Controller.php');
 
class UserApi extends REST_Controller {

	function generateNonce_get(){

		if((!$this->get('usrname'))||(!$this->get('clid'))||(!$this->get('ntoken'))){
			
			echo 'error';
		}
		else{
			
			$nonceParam = array('username' => $this->get('usrname'),
								'clientid' => $this->get('clid'),
								'nhash' => $this->get('ntoken'));
			$this->response($nonceParam,200);
		}

	}
 
    function user_get()
    {	
    	$this->authRequest();

        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }
 		
 		$this->load->model('modelLogin');
        $user = $this->modelLogin->getUserDetail( $this->get('id') );
         
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }
 
        else
        {
            $this->response(NULL, 404);
        }
    }


    function fileInfo_get(){

    	if(!$this->get('id')){
    		$this->response(NULL,400);
    	}
    	$this->load->model('modelDashboard');
    	$fileArray = $this->modelDashboard->getFileInfo($this->get('id'));

    	if($fileArray){

    		$this->response($fileArray, 200);
    	}
    	else{
    		$this->response(NULL, 404);
    	}
    }

     
}