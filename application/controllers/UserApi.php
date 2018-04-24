<?php

require(APPPATH.'/libraries/REST_Controller.php');
 
class UserApi extends REST_Controller {

	function generateNonce_get(){

		if(!$this->get('usrname')){	
			$this->response(NULL,400);
		}
		else{
			
			$userName = $this->get('usrname');
            $this->load->model('modelLogin');
            
            if($this->modelLogin->verifyEmail($userName)){
                $randNonce =  mt_rand(10,33);
                $this->modelLogin->setNonce($randNonce,$userName);
                $passDetails = $this->modelLogin->getHash($userName);
                $passArray = explode("$",$passDetails);
              
                $hashType = "";
                if($passArray[1]=="2y"){
                    $hashType = 1;
                }
                elseif($passArray[1] == "2a") {
                        $hashType = 2;
                }    
                else{
                    $hashType = 3;
                }

                $hashRound = $passArray[2];
                $hashSalt = substr($passArray[3],0,22);
                $respArray = array('nonce' => $randNonce,
                                    'param1' => $hashType,
                                    'param2' => $hashRound,
                                    'param3' => $hashSalt);
                $this->response($respArray,200);

            }
            else{
                $this->response(NULL,400);
            }
		}

	}
    
    private function authRequest($emailId,$authToken){
    	if (strlen($emailId) == 0 || strlen($authToken) == 0){
    		return False;
    	}
        $this->load->model('modelLogin');
        $userNonce = $this->modelLogin->getNonce($emailId);
        $userBcrypt = $this->modelLogin->getHash($emailId);
        $verifyToken = hash("sha256",$userNonce.$userBcrypt.$userNonce);
        $verifyToken = substr($verifyToken,0,$userNonce);
        $this->modelLogin->setNonce(NULL,$emailId);
        if($verifyToken==$authToken){
            return True;
        }
        else{
            return False;
        }
        

    }

    private function getFileSize($filePath){
        $rawSize = filesize($filePath);
        $finalQ = $rawSize/1048576;
        $finalR = $rawSize%1048576;
        $finalSize = $finalQ.'.'.$finalR;
        $finalSize = number_format($finalSize,3);
        return $finalSize;
    }

    function cmpSpace($elem1,$elem2){
        $sp1 = $elem1['s_free_space'];
        $sp2 = $elem2['s_free_space'];
        if($sp1==$sp2){
            return 0;
        }

        return ($sp1 < $sp2) ? -1:1;
    }

    private function uploadSFTP($tempPath,$uploadSize){

        $this->load->model("modelDashboard");
        $storageInfo = $this->modelDashboard->getStorageData();

        uasort($storageInfo,array($this,'cmpSpace'));

        $sftpInfo =  end($storageInfo);
        $upPath = $tempPath;
        $sid = $sftpInfo['s_id'];
        $sIp = $sftpInfo['s_ip'];
        $sUser = $sftpInfo['s_uname'];
        $sPass = $sftpInfo['s_passwd'];
        $sKey = $sftpInfo['s_keypath'];
        $sPort = $sftpInfo['s_port'];
        $sFreeSpace = $sftpInfo['s_free_space'];

        $sAuth = '';
        $sType = '';

        if(strlen($sPass)==0){

            $sAuth = $sKey;
            $sType = 2;
        }
        else{
            $sAuth = $sPass;
            $sType = 1;
        }

        $sftpStatus  = exec("python ./pythonEngine/sftpTransfer.py 1 ".$sIp." ".$sUser." ".$sAuth." ".$sType." ".$sPort." ".$upPath." 2>&1");
        
        if ($sftpStatus=="Uploaded"){
            $newFreeSpace = $sFreeSpace-$uploadSize;
            $this->modelDashboard->updateStorageSpace($newFreeSpace,$sid);
            return $sid;
        }
        else{
            return -1;
        }
        
    }

    function user_get()
    {	
        $authArr = $this->input->request_headers();
        if(!isset($authArr['token_a']) || !isset($authArr['token_b'])){
        	$this->response(NULL,404);
        }
    	if (($this->authRequest($authArr['token_a'],$authArr['token_b'])==True)){

     		$this->load->model('modelLogin');
            $user = $this->modelLogin->getUserDetail($authArr['token_a']);
             
            if($user)
            {
                $this->response($user, 200); // 200 being the HTTP response code
            }
     
            else
            {
                $this->response(NULL, 404);
            }
        }
        else{
            $this->response(NULL,404);
        }
            
    }


    function fileInfo_get(){

    	$authArr = $this->input->request_headers();
    	if(!isset($authArr['token_a']) || !isset($authArr['token_b'])){
        	$this->response(NULL,404);
        }
    	if (($this->authRequest($authArr['token_a'],$authArr['token_b']) == True)){

	    	$this->load->model('modelDashboard');
	    	$fileArray = $this->modelDashboard->getFileInfo($authArr['token_a']);

	    	if($fileArray){

	    		$this->response($fileArray, 200);
	    	}
	    	else{
	    		$this->response(NULL, 404);
	    	}
	    }
	    else{
	    	$this->response(NULL,400);
	    }
    }

    /*  API Name: smallFileUpload
        API URL : http://<IP Addr>/SecuraServer/UserApi/smallFileUpload 
        API Type: POST
        API HEADERS: token_a => Email for Authentication
                     token_b => Password Digest for Authentication
                     checksum => Upload file checksum
        
        POST Parameters: localName => Name of file on client machine
                         down_perm => permissions with which file is to be downloaded
                         localSize => Size of file on client machine

        FILE parameter: file => File to be uploaded

        API Description: This is a file upload API for filesize <= 4MB. This uploads the 
                         file to SecuraServer and then initiates SFTP transfer to one of
                         the onboarder storages. API generates record of file for every
                         authenticated user and stores it in DB. 
    */


    function smallFileUpload_post(){

        $authArr = $this->input->request_headers();
        if(!isset($authArr['token_a']) || !isset($authArr['token_b'])){
            $this->response(NULL,404);
        }

    	if (($this->authRequest($authArr['token_a'],$authArr['token_b'])==True)){
            if(!isset($authArr['checksum']) || !isset($_POST['localName']) || !isset($_POST['down_perm']) || !isset($_POST['localSize'])){
                $error = array('error' => 'All parameters not set',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
            }

            $this->load->model('modelLogin');
            $this->load->model('modelDashboard');
            $uid = $this->modelLogin->getUid($authArr['token_a']);
            $fileName = $this->input->post('localName');
            if($this->modelDashboard->fileExists($fileName,$uid)){
                $error = array('error' => 'Filename already taken use another',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
            }

           
            $clientSize = $this->input->post('localSize');
            $freeSpace  = $this->modelDashboard->getUserSpace($uid);
            $freeSpace  = $freeSpace['free_space'];

            if(($clientSize>=$freeSpace) ||($clientSize>4)){
                $error = array('error' => 'Upload File too Large',
                               'status' => 'Failed');
                $this->response($error,404);
                die;   
            }


            $uploadDate = date('Y-m-d H:i:s');
            $sftpName = 'uid_'.$uid.'_'.$fileName.'_'.$uploadDate;
            $sftpName = preg_replace('/\s+/', '_', $sftpName);
            $sftpName = str_replace(':', '-', $sftpName);
    		$config['upload_path'] = $this->config->item('SecuraClient_upload');
    		$config['file_name'] = $sftpName;
    		$config['allowed_types'] = '*';

    		$this->load->library('upload', $config);

    		if (!$this->upload->do_upload('file')){
     			$error = array('error' => $this->upload->display_errors(),
     						   'status' => 'Failed');
     			$this->response($error,404);
    		}
        	else{
                $uploadMetaData = $this->upload->data();
                $fileExt = $uploadMetaData['file_ext'];
                $downPerm = $this->input->post('down_perm');
     			$fileHash = $authArr['checksum'];
                $emailId = $authArr['token_a'];
                $tempPath = $this->config->item('SecuraClient_upload').'/'.$sftpName.$fileExt;
                $fileSize = $this->getFileSize($tempPath);
                $actualHash = hash_file('sha256', $tempPath);
                if($actualHash != $fileHash){
                    unlink($tempPath);
                    $error = array('error' => 'Invalid Checksuma'.$actualHash,
                               'status' => 'Failed');
                    $this->response($error,404);
                }
                else if($fileSize>=$freeSpace){
                    unlink($tempPath);
                    $error = array('error' => 'Space Overflow',
                               'status' => 'Failed');
                    $this->response($error,404);   
                }
                else{
                    $fileSid = $this->uploadSFTP($tempPath,$fileSize);
                    if($fileSid>0){
                        $newFreeSpace = $freeSpace-$fileSize;
                        $this->modelDashboard->updateFileData($fileSid,$uid,$fileName,$fileSize,$fileHash,$uploadDate,$downPerm,$newFreeSpace);
                        $data = array('upload_data' => $this->upload->data(),
                              'status' => 'Success');
                        unlink($tempPath);
                        $this->response($data,200);
                    }
                    else{
                        $error = array('error' => 'Upload failed due to connectivity issues. Please try again.',
                                     'status' => 'Failed');
                        $this->response($error,404);
                    }
            
                }
            
 		    }
        }
        else{
                $error = array('error' => 'AUTH Failure',
                                'status' => 'Failed');
                $this->response($error,404);
        }
    }

    function smallFileDownload_get(){
        $authArr = $this->input->request_headers();
        if(!isset($authArr['token_a']) || !isset($authArr['token_b'])){
            $this->response(NULL,404);
        }

        if (($this->authRequest($authArr['token_a'],$authArr['token_b'])==True)){
            $emailId = $authArr['token_a'];
            $fileName = $this->get('localName');
            
            $this->load->model('modelLogin');
            $this->load->model('modelDashboard');
            $uid = $this->modelLogin->getUid($emailId);
            if(!($this->modelDashboard->fileExists($fileName,$uid))){
                $error = array('error' => 'File doesn\'t exist',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
            }
            
            $fileData = $this->modelDashboard->getFileRecord($fileName,$uid);
            $fileSize = $fileData['size'];
            $fileChecksum = $fileData['chksum'];

            if ($fileSize>=4){
                $error = array('error' => 'File Size too Large',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
            }

            $tempPart = $fileData['created_at'];
            $tempPart = preg_replace('/\s+/', '_', $tempPart);
            $tempPart = str_replace(':', '-', $tempPart);
            $fileArray = explode('.', $fileName);
            $fileName = 'uid_'.$uid.'_'.$fileArray[0].'_'.$tempPart.'.'.end($fileArray);
            $tempPath = './tmp_Downloads/';
            
            $storageInfo = $this->modelDashboard->getStorageCreds($fileData['s_id']);
            $sIp = $storageInfo['s_ip'];
            $sUser = $storageInfo['s_uname'];
            $sPass = $storageInfo['s_passwd'];
            $sKey = $storageInfo['s_keypath'];
            $sPort = $storageInfo['s_port'];

            $sAuth = '';
            $sType = '';

            if(strlen($sPass)==0){

                $sAuth = $sKey;
                $sType = 2;
            }
            else{
                $sAuth = $sPass;
                $sType = 1;
            }

            $sftpStatus = exec("python ./pythonEngine/sftpTransfer.py 2 ".$sIp." ".$sUser." ".$sAuth." ".$sType." ".$sPort." ".$tempPath." ".$fileName." 2>&1");

            if ($sftpStatus=="Downloaded"){
                $downloadDate = date('Y-m-d H:i:s');
                $this->modelDashboard->fileDownloadDate($downloadDate,$this->get('localName'),$uid);
                $file_content = file_get_contents($tempPath.$fileName);
                if(file_exists($tempPath.$fileName)){
                    unlink($tempPath.$fileName);
                }
                $this->load->helper("download"); 
                force_download($fileName,$file_content);

            }
            else{
                $error = array('error' => 'Unable to download due to connectivity issues. Please try again',
                               'status' => 'Failed');
                $this->response($error,404);
            }
        }
        else{
            $this->response(NULL,404);
        }

    }

    function deleteFile_get(){
        $authArr = $this->input->request_headers();
        if(!isset($authArr['token_a']) || !isset($authArr['token_b'])){
            $this->response(NULL,404);
        }

        if (($this->authRequest($authArr['token_a'],$authArr['token_b'])==True)){

            $fileName = $this->get('localName');
            $emailId = $authArr['token_a'];

            $this->load->model('modelLogin');
            $this->load->model('modelDashboard');
            $uid = $this->modelLogin->getUid($emailId);
            if(!($this->modelDashboard->fileExists($fileName,$uid))){
                $error = array('error' => 'File doesn\'t exist',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
            }

            $fileData = $this->modelDashboard->getFileRecord($fileName,$uid);
            $tempPart = $fileData['created_at'];
            $tempPart = preg_replace('/\s+/', '_', $tempPart);
            $tempPart = str_replace(':', '-', $tempPart);
            $fileArray = explode('.', $fileName);
            $fileName = 'uid_'.$uid.'_'.$fileArray[0].'_'.$tempPart.'.'.end($fileArray);

            $storageInfo = $this->modelDashboard->getStorageCreds($fileData['s_id']);
            $sIp = $storageInfo['s_ip'];
            $sUser = $storageInfo['s_uname'];
            $sPass = $storageInfo['s_passwd'];
            $sKey = $storageInfo['s_keypath'];
            $sPort = $storageInfo['s_port'];

            $sAuth = '';
            $sType = '';

            if(strlen($sPass)==0){

                $sAuth = $sKey;
                $sType = 2;
            }
            else{
                $sAuth = $sPass;
                $sType = 1;
            }

            $sftpStatus = exec("python ./pythonEngine/sftpTransfer.py 3 ".$sIp." ".$sUser." ".$sAuth." ".$sType." ".$sPort." ".$fileName." 2>&1");

            if ($sftpStatus == "Deleted"){
                $this->modelDashboard->delFile($this->get('localName'),$uid);
                $data = array('message' => 'File deleted',
                              'status' => 'Success');
                $this->response($data,200);
            }
            elseif ($sftpStatus == "Invalid Path"){
                $error = array('error' => 'File doesn\'t exist',
                                'status' => 'Failed');
                $this->response($error,404);
            }
            else{
                $error = array('error' => 'Unable to delete',
                                'status' => 'Failed');
                $this->response($error,404);
            }
        }
        else{
            $error = array('error' => 'Unauthozied Access',
                           'status' => 'Failed');
            $this->response($error,404);
            }
        
    }


    private function uploadChunk($config,$chunkHandler,$partHash,$freeSpace,$partNo){
        
        $this->load->model('modelLogin');
        $this->load->model('modelDashboard');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($chunkHandler)){
                $error = array('error' => $this->upload->display_errors(),
                               'status' => 'Failed'
                                'nack' => $partNo);
                return $error;
            }
        else{   
                $chunkPath = $config['upload_path'].'/'.$config['file_name'];
                $chunkSize = $this->getFileSize($chunkPath);
                $actualHash = hash_file('sha256', $chunkPath);
                if($actualHash != $partHash){
                    unlink($chunkPath);
                    $error = array('error' => 'Invalid Checksum',
                                   'status' => 'Failed',
                                   'nack' => $partNo );
                    return $error;
                }
                else if($chunkSize>=$freeSpace){
                    unlink($chunkPath);
                    $error = array('error' => 'Space Overflow',
                               'status' => 'Failed',
                                'nack' => $partNo);
                    return $error;
                }
                else{
                    $data = array('upload_data' => $this->upload->data(),
                                  'status' => 'Success',
                                  'ack' => $partNo);
                    return $data;
                }
         }
    }


    function largeFileUpload_post(){
        $authArr = $this->input->request_headers();
        $emailId = $authArr['token_a'];
        $partHash = $authArr['pchksum'];
        $fileTime = $authArr['tparam'];
        $ctrFlag = $authArr['cparam'];
       
        $fileName = $this->input->post('localName');
        $partSize = $this->input->post('partSize');
        $filePart = $this->input->post('partNo');
        $fileSize = $this->input->post('fileSize');

        $this->load->model('modelLogin');
        $this->load->model('modelDashboard');
        $uid = $this->modelLogin->getUid($authArr['token_a']);

        $dirName = 'tmpDir';
        $path = './tmp_uploads/'.$dirName;

        if($this->modelDashboard->fileExists($fileName,$uid)){
                $error = array('error' => 'Filename already taken use another',
                               'status' => 'Failed');
                $this->response($error,404);
                die;
        }

        $uploadName = $fileName.'_'.$filePart;

        if(file_exists($path.'/'.$uploadName)){
            $data = array('status' => 'Success',
                          'ack' => $filePart);
            $this->response($data,200);
        }

        $freeSpace  = $this->modelDashboard->getUserSpace($uid);
        $freeSpace  = $freeSpace['free_space'];

        if(($fileSize>=$freeSpace) ||($fileSize>4)){
                $error = array('error' => 'Upload File too Large',
                               'status' => 'Failed'
                               'nack' => '-1');
                $this->response($error,404);
                die;   
        }

        if(($partSize>=$freeSpace) ||($partSize>4)){
                $error = array('error' => 'Chunk too Large',
                               'status' => 'Failed'
                               'nack' => $filePart);
                $this->response($error,404);
                die;   
        }

        $config['upload_path'] = $path;
        $config['file_name'] = $uploadName;
        $config['allowed_types'] = '*';

        if($this->modelDashboard->fileExists($fileName,$uid)){
            $error = array('error' => 'Filename already taken use another',
                           'status' => 'Failed');
            $this->response($error,404);
            die;
        }

        $resArr = '';
        if($ctrFlag == '1'){
            mkdir($path);
            $resArr = $this->uploadChunk($config,'chunkfile',$partHash,$freeSpace,$partNo);
            $this->response($resArr,200);

        }
        elseif ($ctrFlag == '-1') {
            $fullSize = $this->input->post('localSize');
            $downPerm = $this->input->post('down_perm');
            $fileHash = $authArr['chksum'];
            $partList = $this->input->post('partList');
            $resArr = $this->uploadChunk($config,'chunkfile',$partHash,$freeSpace,$partNo);
            if ($resArr['status'] == 'Failed'){
                $this->response($resArr,200);
                die;
            }
            $accumStatus = exec('python ./pythonEngine/accumulator.py '.$path.' '.$fileHash.' '.$fileName.' '.$freeSpace.' '.$partList.' 2>&1');
            if($accumStatus == 'Success'){
                $totalSize = $this->getFileSize($path.'/'.$fileName)
                $fileSid = $this->uploadSFTP($path.'/'.$fileName,$totalSize);
                if($fileSid>0){
                        $newFreeSpace = $freeSpace-$totalSize;
                        $this->modelDashboard->updateFileData($fileSid,$uid,$fileName,$totalSize,$fileHash,$uploadDate,$downPerm,$newFreeSpace);
                        delete_files($path, true);
                        rmdir($path);
                        $this->response($resArr,200);
                    }
                else{
                    $error = array('error' => 'Upload failed due to connectivity issues. Please try again.',
                                 'status' => 'Failed');
                    $this->response($error,404);
                }
            }
            else{
                $error = array('error' => 'Upload failed due to connectivity issues. Please try again.',
                                 'status' => 'Failed',
                                'nack' => $partNo);
                    $this->response($error,404);
            }
        }
        else{
            if(!file_exists($path)){
                $error = array('error' => 'Invalid upload. Try Again',
                            'status' => 'Failed');
                $this->response($error,404);
                die;
            }
            $resArr = $this->uploadChunk($config,'chunkfile',$partHash,$freeSpace,$partNo);
            $this->response($resArr,200);

        }

        // $this->response($resArr,200);

    }

     
}
