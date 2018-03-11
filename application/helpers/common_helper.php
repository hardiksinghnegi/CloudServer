<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*Function to print array in readable form*/
function pA($arrayName){
	$res   =  "<pre>";
	$res  .= print_r($arrayName);
	return($res);
}
/*This function is to send email on given emailId and content for email is in $msg and subject in $subject*/
function sendMailTo($emailId,$msg,$email,$subject){
	$CI = get_instance();
	$CI->load->model('modelMail');
	$smtp=$CI->modelMail->getProtocol();
	$config = Array(
		      'protocol' => $smtp['protocol'],//'smtp',
		      'smtp_host' => $smtp['smtpHost'],//'ssl://smtp.googlemail.com',
		      'smtp_port' => $smtp['smtpPort'],//465,
		      'smtp_user' => $smtp['user'],//'stevedoe.safe@gmail.com', // change it to yours
		      'smtp_pass' => $smtp['password'],//'Lucideus@123', // change it to yours
		      'mailtype' => 'html',
		      'charset' => 'iso-8859-1',
		      'wordwrap' => TRUE);
	$CI->load->library('email', $config);
	$CI->email->set_newline("\r\n");
	$CI->email->from($email); 
	$CI->email->to($emailId);	 		
	$CI->email->subject($subject);
	$CI->email->message($msg);
	if($CI->email->send()){     
		return true; 
	}else{
		return false;
	}
}

function round2decimal($num,$dec=2)
{
	return number_format((float)$num, $dec, '.', '');
}

	function is_valid_questions_database($validAssetName,$validAssetOwnerEmailId,$AssetClassification,$validHostIp,$assetType,$mirroring,$costBreach,$validUserName, $validPassword,$validPort,$validSId) //assetDepartment assetLocation
	{

		$validAssetClassification = array("Critical","High","Medium-Low");
		if (in_array($AssetClassification,$validAssetClassification))
		{	
			$validHostIp = (filter_var($validHostIp, FILTER_VALIDATE_IP)) ? $validHostIp : 'Invalid HostIP';
			$validAssetName = (preg_match("/[^A-Za-z'-]/", $validAssetName)) ? $validAssetName : 'Invalid ';
			$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';
			$validUserName = (preg_match("/[^A-Za-z'-]/", $validUserName)) ? $validUserName : 'invalid';

			$validPasword = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validPassword)) ? $validPassword: 'invalid';
			$validPort = (preg_match('/^[0-9]{4}$/', $validPort)) ? $validPort : 'invalid';
			$validSId = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validSId)) ? $validSId: 'invalid';

			$validAssetType =  array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey");

			if(in_array($assetType, $validAssetType))
			{
				$validMirroring =  array("Yes","No");
				if(in_array($mirroring, $validMirroring))
				{	
					$validCostBreach = array("Medium","Low","High");
					if(in_array($costBreach, $validCostBreach))
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			
			
			else
			{
				return false;
			}
			{
				return false;
			}
			
		}
	}

	function is_valid_question_endpoint($assetType,$validModelName,$operatingSystem,$assetClassification,$jusridiction,$validAssetTag,$validMacAdress, $validAssetOwnerEmailID) //assetLocation applicability  assetDepartment
	{
		$validAssetType = array("Laptop","Desktop","Mobile Phone","Handheld Devices","Printer","Scanner","Fax Machine","VC Devices","External Storage Devices","Data Cards","DVR","CCTV Camera","IP Camera");
		if(in_array($assetType, $validAssetType))
		{
			$validModelName = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validModelName)) ? $validModelName : 'invalid';
			$validAssetTag = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validAssetTag)) ? $validAssetTag 
			: 'invalid';

			$validMacAddress = (preg_match('/^([a-fA-F0-9]{2}:){5}[a-fA-F0-9]{2}$/', $validMacAdress)) ? $validMacAdress : 'invalid';

			$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';
			$validOperatingSystem = array("Windows OS","Linux Based OS","OS X");
			if(in_array($operatingSystem, $validOperatingSystem))
			{
				$validAssetClassification = array("Critical","High","Medium-Low","High");
				if(in_array($assetClassification, $validAssetClassification))
				{
					$validJurisdiction = array("India","USA","UK","Singapore","Hong Kong","Netherlands");
					if(in_array($jurisdiction,$validJurisdiction))	
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return false;
		}
	}
	


	
	
	

	function is_valid_question_mobileApps($validAssetOwnerEmailId,$validAssetName,$assetType,$databaseType,$internetAccess,$intranetAccess,$assetClassification,$validAssetExposure,$validAssetVersion,$changeRequest) //location applicability department
	{
		$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';

		$validAssetName = (preg_match("/[^A-Za-z'-]/", $validAssetName)) ? $validAssetName : 'invalid';

		$validAssetType = array("CMS","Custom Developed");
		if(in_array($assetType,$validAssetType))
		{
			$validDatabaseType = array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey");
			if(in_array($databaseType, $validDatabaseType))	
			{
				$validDatabaseType = array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey");
				if(in_array($databaseType, $validDatabaseType))	
				{
					$validInternetAccess = array("10 Million +","1 Million to 10 Million","Less Than 1 Million");
					if(in_array($internetAccess, $validInternetAccess))	
					{
						$validIntranetAccess = array("50% +","10% - 50%","Less Than 10%");
						if(in_array($intranetAccess, $validIntranetAccess))	
						{
							$validAssetClassification = array("Critical","High","Medium-Low","High");
							if(in_array($assetClassification, $validAssetClassification))	
							{
								$validAssetExposure =array("Internet","Intranet");
								if(in_array($assetExposure, $validAssetExposure))
								{
									$validAssetVersion = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validAssetVersion)) ? $validAssetVersion : 'invalid';

									$validChangeRequest = array("On Daily basis","On Weekly basis","On Monthly basis","On Quarterly basis","On Yearly basis");
									if(in_array($changeRequest,$validChangeRequest))
									{
										return true;
									}	
									else 
									{
										return false;
									}
								}	
							}
							else
							{
								return false;
							}
						}
						else 
						{
							return false;
						}
					}
					else 
					{
						return false;
					}
				}
				else 
				{
					return false;
				}
			}
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
	}
	
	
	

	function is_valid_question_network($assetClassification,$assetKind,$jurisdiction, $validIpAddress, $validMacAdress, $assetDr,$assetHR,$assetPlace,$validUserName,$validPort,$validAssetOwnerEmailId,$validAssetTag) // location applicability department onemore
	{
		$validAssetClassification = array("Critical","High","Medium-Low","High");
		if(in_array($assetClassification, $validAssetClassification))
		{
			$validAssetKind = array("Physical Asset","Virtual Asset");
			if(in_array($assetKind, $validAssetKind))
			{
				$validJurisdiction = array("India","USA","UK","Singapore","Hong Kong","Netherlands");
				if(in_array($jurisdiction,$validJurisdiction))
				{
					$validAssetExposure =array("Internet","Intranet");
					if(in_array($assetExposure, $validAssetExposure))
					{
						$validAssetDr = array("Yes","No");
						if(in_array($assetDR, $validAssetDr))	
						{
							$validAssetHR = array("Yes","No");
							if(in_array($assetHR, $validAssetHR))	
							{
								$validAssetPlace = array("Datacenter","Server Room in Workspace","In workspace outside the server room / datacenter ");
								if(in_array($assetPlace, $validAssetPlace))	
								{
									$validUserName = (preg_match("/[^A-Za-z'-]/", $validUserName)) ? $validUserName : 'invalid';

									$validPassword = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validPassword)) ? $validPassword: 'invalid';

									$validPort = (preg_match('/^[0-9]{4}$/', $validPort)) ? $validPort : 'invalid';

									$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';

									$validAssetTag = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validAssetTag)) ? $validAssetTag
									: 'invalid';	

									$validIpAddress = (filter_var($validIpAddress, FILTER_VALIDATE_IP))? $$validIpAddress : 'invalid';

									$validMacAddress = (preg_match('/^([a-fA-F0-9]{2}:){5}[a-fA-F0-9]{2}$/', $validMacAdress)) ? $validMacAdress : 'invalid';
								}
								else
								{
									return false;
								}
							}
							else
							{
								return false;
							}
						}
						else 
						{
							return false;
						}
					}
					else 
					{
						return false;
					}	
				}
				else
				{
					return false;
				}	
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return false;
		}
	}

	function is_valid_ques_server($assetType,$assetKind,$validAssetTag,$validAssetModel,$validPrivateIpAddress,$validPublicIpAddress,$validAssetOwnerEmailId,$assetClassification,$dataRecide,$validUserName,$validPassword,$validPort)
	{
		$validAssetType= array ("File Server","Web Server","DB Server");
		if(in_array($assetType, $validAssetType))
		{
			$validAssetKind= array ("Physical Asset","Virtual Asset");
			if(in_array($assetKind, $validAssetKind))
			{
				$validAssetTag = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validAssetTag)) ? $validAssetTag: 'invalid';
				$validAssetModel = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validAssetModel)) ? $validAssetModel: 'invalid';
				$validPrivateIpAddress = (filter_var($validPrivateIpAddress, FILTER_VALIDATE_IP)) ? $validPrivateIpAddress : 'invalid';
				$validPublicIpAddress = (filter_var($validPrivateIpAddress, FILTER_VALIDATE_IP)) ? $validPublicIpAddress : 'invalid';
				$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';

				$validAssetClassification = array("Critical","High","Medium-Low");
				if (in_array($AssetClassification,$validAssetClassification))
				{
					$validDataRecide = array("Local Storage","Enterprise Storage");
					if (in_array($dataRecide,$validAssetRecide))	
					{
						$validUserName = (preg_match("/[^A-Za-z'-]/", $validUserName)) ? $validUserName : 'invalid';

						$validPasword = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validPassword)) ? $validPassword: 'invalid';

						$validPort = (preg_match('/^[0-9]{4}$/', $validPort)) ? $validPort : 'invalid';	
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}	
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	

	function is_valid_ques_storage($validAssetName,$validAssetTag,$validPrivateIp,$assetClassification,$assetType,$raid,$jurisdiction,$validAssetOwnerEmailId)
	{
		$validAssetName = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validAssetName)) ? $validAssetName: 'invalid';
		$validAssetTag = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validAssetTag)) ? $validAssetTag: 'invalid';
		$validPrivateIp = (filter_var($validPrivateIp, FILTER_VALIDATE_IP)) ? $validPrivateIp : 'invalid';
		$validAssetClassification = array("Critical","High","Medium-Low");
		if (in_array($AssetClassification,$validAssetClassification))
		{
			$validAssetType = array("NAS","SAN","Flash Storage");
			if (in_array($AssetType,$validAssetType))
			{
				$validRaid = array("Raid 0","Raid 1","Raid 5","Raid 10");
				if (in_array($raid,$validRaid))	
				{
					$validJurisdiction = array("India","USA","UK","Singapore","Hong Kong","Netherlands");
					if(in_array($jurisdiction,$validJurisdiction))	
					{
						$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';	
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	

	function is_valid_ques_thickClient($validAssetOwnerEmailId,$assetClassification,$validAssetName,$codeAccess,$databaseType,$dataReside,$validVersion,$validProgrammingLanguage)
	{
		$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';

		$validAssetClassification = array("Critical","High","Medium-Low");
		if (in_array($AssetClassification,$validAssetClassification))
		{
			$validAssetName = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validAssetName)) ? $validAssetName: 'invalid';

			$validCodeAccess = array("Yes","No");
			if (in_array($codeAccess, $validCodeAccess))
			{
				$validDatabaseType = array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey");
				if(in_array($databaseType, $validDatabaseType))	
				{
					$validDataRecide = array ("Local Storage","Service Driven Stroge");
					if(in_array($dataRecide, $validDataRecide))
					{
						$validAssetDevelopment = array("Product","Custom Developed Thick Client");
						if(in_array($assetDevelopment, $validAssetDevelopment))	
						{
							$validVersion = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validVersion)) ? $validVersion: 'invalid';

							$validProgrammingLanguage = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validProgrammingLanguage)) ? $validProgrammingLanguage: 'invalid';
						}
						else 
						{
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}	
		}
		else
		{
			return false;
		}
	}

	function is_valid_ques_web($validAssetOwnerEmailId,$assetClassification,$validVersion,$assetExposure,$validAssetName,$internetAccess,$intranetAccess,$databaseType,$validateUrl,$codeAccess,$changeRequest,$assetType)
	{
		$validAssetOwnerEmailId = (filter_var($validAssetOwnerEmailId, FILTER_VALIDATE_EMAIL)) ? $validAssetOwnerEmailId : 'invalid';	

		$validAssetClassification = array("Critical","High","Medium-Low");
		if (in_array($AssetClassification,$validAssetClassification))
		{
			$validAssetExposure =array("Internet","Intranet");
			if(in_array($assetExposure, $validAssetExposure))
			{
				$validInternetAccess = array("10 Million +","1 Million to 10 Million","Less Than 1 Million");
				if(in_array($internetAccess, $validInternetAccess))	
				{
					$validIntranetAccess = array("50% +","10% - 50%","Less Than 10%");
					if(in_array($intranetAccess, $validIntranetAccess))	
					{
						$validDatabaseType = array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey");
						if(in_array($databaseType, $validDatabaseType))	
						{
							$validCodeAccess = array("Yes","No");
							if (in_array($codeAccess, $validCodeAccess))
							{
								$validChangeRequest = array("On Daily basis","On Weekly basis","On Monthly basis","On Quarterly basis","On Yearly basis");
								if(in_array($changeRequest,$validChangeRequest))	
								{
									
									$validAssetName = (preg_match("/[^A-Za-z'-]/", $validAssetName)) ? $validAssetName : 'invalid';
									$validVersion = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validVersion)) ? $validVersion: 'invalid';
									$validAssetType = array("CMS","Custom Developed","Internet","Intranet");
									if(in_array($assetType, $validAssetType))	
									{
										$validateUrl = (filter_var($validateUrl, FILTER_VALIDATE_URL)) ? $validateUrl : 'invalid';
										
									}
									else 
									{
										return false;
									}
								}
								else 
								{
									return false;
								}
							}
							else
							{
								return false;
							}	
						}
						else
						{
							return false;
						}
					}
					else 
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}	
		}
		else 
		{
			return false;
		}
	}

	function is_valid_question_vendor($validVendorName,$validContactName,$validContactLastName,$validContactNumber,$validEmailId,$validTos,$validClassification,$Nda,$authentication,$access,$validDescription,$InternalDataSharingMechanism,$ExternalDataSharingMechanism)
	{
		$validVendorName = (preg_match("/[^A-Za-z'-]/", $validVendorName)) ? $validVendorName : 'invalid';
		$validContactName = (preg_match("/[^A-Za-z'-]/", $validContactName)) ? $validContactName : 'invalid';
		$validContactLastName = (preg_match("/[^A-Za-z'-]/", $validContactLastName)) ? $validContactLastName : 'invalid';
		$validContactNumber = (preg_match('/^[0-9]{10}+$/', $validContactNumber)) ? $validContactNumber : 'invalid';
		$validEmailId = (filter_var($validEmailId, FILTER_VALIDATE_EMAIL)) ? $validEmailId : 'invalid';
		$validTos = (preg_match("/[A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>§~]/", $validTos)) ? $validTos: 'invalid';
		$validClassification = array("Critical","High","Medium-Low");
		if (in_array($validAssetClassificationfication,$validAssetClassification))
		{
			$validNda = array ("Yes","No");
			if(in_array($Nda,$validNda))
			{
				$validAuthentication = array ("Yes","No");
				if(in_array($authentication,$validAuthentication))
				{
					$validAccess = array ("yes","No");
					if(in_array($access,$validAccess))
					{
						$validDescription = (preg_match("/[^A-Za-z'-]/", $validDescription)) ? $validDescription : 'invalid';
						$validInterDataSharingMechanism = array ("Over Network","Pendrives & Hard Drive","Hardcopy");
						if(in_array($InternalDataSharingMechanism,$validInternalDataSharingMechanism))
						{
							$validExternalDataSharingMechanism = array ("Over Network","Pendrives & Hard Drive","Hardcopy");
							if(in_array($ExternalDataSharingMechanism,$validExternalDataSharingMechanism))
							{
								return true;
							}
							else
							{
								return false;
							}
						}
						else
						{
							return false;
						}
					}
					else 
					{
						return false;
					}
				}
				else 
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}







	}
	

// ____________________________________________________________________________________________________________________
//AMS QUESTIONS FUNCTION

	

		//UPLOAD DATABASE

	 //DatabaseName, Username, SID
function empty_field($nameType)
{
	if(trim($nameType) =="")
		{
			return false;
		}
		else
		{
			return true;
		}
}
	
	function name_feild($nameType)

	{	
		if(trim($nameType) =="")
		{
			
			return false;
		}
		if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._ ]+$/', $nameType)) //min length 2 char		
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

		function middle_feild($nameType)

	{	
		if(trim($nameType) =="")
		{
			return false;
		}
		if(preg_match('/^[a-zA-Z]+$/', $nameType)) //min length 2 char		
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
		//AssetOwnerEmailId
function emailId_feild ($validEmail)

{
	if(trim($validEmail) =="")
	{
		return false;
	}
	if(preg_match('/^([a-z0-9]+([_\.\-]{1}[a-z0-9]+)*){1}([@]){1}([a-z0-9]+([_\-]{1}[a-z0-9]+)*)+(([\.]{1}[a-z]{2,6}){0,3}){1}$/i', $validEmail)) 
	{
		return true;
	}
	else 
	{
		return false;
	}
}
		//DataBaseType
function databaseType_feild ($validDatabaseType)
{
	if(trim($validDatabaseType) =="")
	{
		return false;
	}
	$validDatabase_Type = array("MySQL","DB2","SQLite","MS SQL","Mongo DB","Oracle DB","Postgrey","Oracle","MongoDB");
	if(in_array($validDatabaseType, $validDatabase_Type))	
	{
		return true;
	}	
	else
	{
		return false;
	}
}

		//classification
function classification_feild ($validClassification)
{
	if(trim($validClassification) =="")
	{
		return false;
	}
	$validAssetClassification = array("Critical","High","Medium-Low");
	if (in_array($validClassification,$validAssetClassification))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function applicability_network ($validNetworkApplicability)
{			
	if(trim($validNetworkApplicability) =="")
	{
		return false;
	}
	$validNetworkAssetApplicability = array("6","29","30","31","39","40","41","43","46","47","48");
	if (in_array($validNetworkApplicability,$validNetworkAssetApplicability))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function applicability_server ($validNetworkApplicability)
{			
	if(trim($validNetworkApplicability) =="")
	{
		return false;
	}
	$validNetworkAssetApplicability = array("8","11","12","13","14","20","22","42","44","45");
	if (in_array($validNetworkApplicability,$validNetworkAssetApplicability))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function asset_place ($validClassification)
{
	if(trim($validClassification) =="")
	{
		return false;
	}
	$validAssetPlace = array("In workspace outside the server room / data center","Server Room in Workspace","Datacenter");
	if (in_array($validClassification,$validAssetPlace))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function breach_feild($costBreach)
{
	if(trim($costBreach) =="")
	{
		return false;
	}
	$validCostBreach = array("Very high","High","Medium","Low","Negligible");
	if(in_array($costBreach, $validCostBreach))
	{
		return true;
	}
	else
	{
		return false;
	}
}






function assetExposure_feild ($asset_exposure)
{
	if(trim($asset_exposure) =="")
	{
		return false;
	}
	$validAssetExposure = array("Internet","Intranet");
	if(in_array($asset_exposure, $validAssetExposure))
	{
		return true;
	}
	else
	{
		return false;
	}
}



function internetAccess_feild ($internetAccess)
{
	if(trim($internetAccess) =="")
	{
		return false;
	}
	$validInternetAccess = array ("10 Million +","1 Million to 10 Million","Less Than 1 Million","Less than 1 Million");
	if(in_array($internetAccess, $validInternetAccess))
	{
		return true;
	}	
	else
	{
		return false;
	}

}


function intranetAccess_feild($intranetAccess)
{
	if(trim($intranetAccess) =="")
	{
		return false;
	}
	$validIntranetAccess = array("50% +","10% - 50%","Less Than 10%","Less than 10%");
	if(in_array($intranetAccess, $validIntranetAccess))	
	{
		return true;
	}
	else
	{
		return false;
	}
}

function codeAccess_feild ($codeAccess)
{
	if(trim($codeAccess) =="")
	{
		return false;
	}
	$validCodeAccess = array ("Yes","No");
	if(in_array($codeAccess, $validCodeAccess))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function jurisdiction_feild ($jurisdiction)
{
	if(trim($jurisdiction) =="")
	{
		return false;
	}
	$validJurisdiction = array("India","USA","UK","Singapore","Hong Kong","Netherlands");
	if(in_array($jurisdiction,$validJurisdiction))
	{
		return true;
	}	
	else
	{
		return false;
	}
}

	/* Function to validate Phone number in format :
		-> the number should start with "+" sign.
		-> the country code will be of either of 2 or 3 digits.
		-> the latter number can be between 5 and 13 digits.
		-> there ought to be 1 space character between number sequences i.e. the country code and phone number.

		Eg: +91 9182736450
	*/
		function number_field($phone)
		{
			if(trim($phone) =="")
			{
				return false;
			}
			if(preg_match('/^[+][\d]{2,3} \b[\d]{5,13}\b/', $phone))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function phone_feild($phone)
		{
			if(trim($phone) =="")
			{
				return false;
			}
			if(preg_match('/^[0-9]*$/', $phone))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function mac_Adress_feild($macAdress)
		{
			if(trim($macAdress) =="")
			{
				return false;
			}
			if(preg_match('/^([a-fA-F0-9]{2}:){5}[a-fA-F0-9]{2}$/', $macAdress))
			{
				return true;
			} 
			else
			{
				return false;
			}
		}

		function ip_Adress_feild ($ipAdress)
		{
			if(trim($ipAdress) =="")
			{
				return false;
			}
			if(filter_var($ipAdress, FILTER_VALIDATE_IP))
			{
				return true;
			} 
			else
			{
				return false;
			}
		}

		function is_valid_ques_process($validProcessName,$validProcessDescription)
		{
			$validProcessName = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validProcessName)) ? $validProcessName : 'invalid';
			$validProcessDescription = (preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $validProcessDescription)) ? $validProcessDescription : 'invalid';
		}

		function validAssetType_EndPoint($assetType)
		{
			if(trim($assetType) =="")
			{
				return false;
			}
			$validAssetType = array("Laptop","Desktop","Mobile Phone","Handheld Devices","Printer","Scanner","Fax Machine","VC Devices","External Storage Devices","Data Cards","DVR","CCTV Camera","IP Camera");
			if(in_array($assetType, $validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validAssetType_Storage($assetType)
		{
			if(trim($assetType) =="")
			{
				return false;
			}
			$validAssetType = array("NAS","SAN","Flash Storage");
			if(in_array($assetType, $validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validOS_EndPoint($operatingSystem)
		{
			if(trim($operatingSystem) =="")
			{
				return false;
			}
			$validOperatingSystem = array("Windows OS","Linux Based OS","OS X");
			if(in_array($operatingSystem, $validOperatingSystem))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validAssetType_MobileApp($assetType)
		{
			if(trim($assetType) =="")
			{
				return false;
			}
			$validAssetType = array("CMS","Custom Developed");
			if(in_array($assetType,$validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function validAssetType_Thick($assetType)
		{
			if(trim($assetType) =="")
			{
				return false;
			}
			$validAssetType = array("Product","Custom Developed");
			if(in_array($assetType,$validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function changeRequest_feild($changeRequest)
		{
			if(trim($changeRequest) =="")
			{
				return false;
			}
			$validChangeRequest = array("On Daily basis","On Weekly basis","On Monthly basis","On Quarterly basis","On Yearly basis");
			if(in_array($changeRequest,$validChangeRequest))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function assetType_network($asset_Type)
		{
			if(trim($asset_Type) =="")
			{
				return false;
			}
			$validAssetType = array("Router","Switch","Firewall","VPN","IDS/IDPS/IPS");
			if(in_array($asset_Type,$validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function assetType_server($asset_Type)
		{
			if(trim($asset_Type) =="")
			{
				return false;
			}
			$validAssetType = array("File Server","File server","Web server","Db server");
			if(in_array($asset_Type,$validAssetType))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function assetKind_server($asset_kind)
		{
			if(trim($asset_kind) =="")
			{
				return false;
			}
			$validAssetKind = array("Physical Asset","Virtual Asset");
			if(in_array($asset_kind, $validAssetKind))
			{
				return true;
			}
			else
			{
				false;
			}
		}

		function dataReside_server($data_Reside)
		{
			if(trim($data_Reside) =="")
			{
				return false;
			}
			$validDataRecide = array("Local Storage","Enterprise Storage");
			if (in_array($data_Reside,$validDataRecide))	
			{
				return true;
			}
			else
			{
				return false;
			}

		}

		function raid_storage($raid)
		{
			if(trim($raid) =="")
			{
				return false;
			}
			$validRaid = array("Raid 0","Raid 1","Raid 5","Raid 10");
			if (in_array($raid,$validRaid))	
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function data_recide_thickClient($dataReside)
		{
			if(trim($dataReside) =="")
			{
				return false;
			}
			$validDataRecide = array ("Local Storage","Service Driven Storage");
			if(in_array($dataReside, $validDataRecide))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function assetType_Web($asset_Type)
		{
			if(trim($asset_Type) =="")
			{
				return false;
			}
			$validAssetType = array("CMS","Custom Developed","Internet","Intranet");
			if(in_array($asset_Type, $validAssetType))
			{
				return true;
			}	
			else
			{
				return false;
			}
		}

		function data_sharing_vendor($sharing)
		{
			if(trim($sharing) =="")
			{
				return false;
			}
			$validSharing = array (htmlentities("overNetwork"),htmlentities("Pendrive & Hard Drive"), htmlentities("Hardcopy"));
			if(in_array($sharing,$validSharing))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function classification_vendor($classification)
		{
			if(trim($classification) =="")
			{
				return false;
			}
			$validClassification= array ("High", "Medium", "Low");

			if(in_array($classification,$validClassification))
			{
				return true;
			}
			else
			{
				return false;
			}

		}

		function url_feild($url)
		{
			if(trim($url) =="")
			{
				return false;
			}
			if(preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url))
			{
				return true;
			} 
			else
			{
				return false;
			}

		}

		function Ip($ipAdd)
		{
			if(trim($ipAdd) =="")
			{
				return false;
			}
			if(preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $ipAdd))
			{
				return true;
			}
			else
			{
				return false;
			}

		}

		function allApplicability($applicability)
		{
			if(trim($applicability)=="")
			{
				return false;
			}
			$validApplicability= array("Database - Oracle 11g","Database - Oracle 12c","SQL Server 2008","SQL Server 2012","SQL Server 2014","SQL Server 2016","MYSQL 5.6");
			if(in_array($applicability, $validApplicability))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function passwordMatch($password)
		{
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function departmentMatch($department)
		{
			if(trim($department)=="")
			{
				return false;
			}

		}

		function locationMatch($location)
		{
			if(trim($location)=='')
			{
				return false;
			}
		}

		function getKey(){

			$key = hex2bin('eafcb65122e0ff406d2d9658d152cd6a4a8d5b1ee34851b946b50e6bf1cb4f07');
			return $key;
		}




	//This function is no longer required
	// function setUploadFileSizeLimit($format){
	// 	switch ($format) {
	// 		// $CI =& get_instance();
	// 		// $CI->load->database();
	// 		$value = $CI->db->query("SELECT configValue FROM config WHERE configKey='".$format."'")->row_array();
	// 		return ($value['configValue']*1024);
	// 		case 'img':
	// 			return 2*1024;
	// 			break;
	// 		case 'pdf':
	// 		case 'doc':
	// 			return 2*1024;
	// 			break;
	// 		default:
	// 			return 2*1024;
	// 			break;
	// 		}

		function getRiskRangeByLevel($level)
		{
			$start=0.0;
			$end=0.0;

			if(strtoupper($level)=="CRITICAL"){
				$start=9.0;
				$end=10.0;
			}else if(strtoupper($level)=="HIGH"){
				$start=7.0;
				$end=9.0;
			}else if(strtoupper($level)=="MEDIUM"){
				$start=4.0;
				$end=7.0;
			}else if(strtoupper($level)=="LOW"){
				$start=1.0;
				$end=4.0;
			}else if(strtoupper($level)=="NEGLIGIBLE"){
				$start=0.0;
				$end=1.0;
			}

			return array('start'=>$start,'end'=>$end);
		}
		function validate($table,$column,$attr,$assetheadid=0){

			$CI =& get_instance();
			$data = [];
			if($table=='people' && $attr=="NONE")
			{
				return;
			}

			if($assetheadid != 0)

			{ 
				$query = $CI->db->select($column)
				->from($table)
				->where('assetHeadId',$assetheadid)
				->get();
				$options=$query->result_array();
				$options1 = array_column($options,$column);
				if(!in_array($attr,$options1)){
					$data= $attr; }

				}

				else {

					$query = $CI->db->select($column)
					->get($table);
					$options=$query->result_array();
					$options1 = array_column($options,$column);

					if(!in_array($attr,$options1)){
						$data= $attr; }  


					}  


					return $data;

				}

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
		
		function getControlList(){

			$ci = &get_instance();
			$ci->load->library('redis');
			$redis=$ci->redis->get_redis();

			if ($redis->exists('assetcontrollist')){
				return "it's done";
			}
			else{
				return "it's note done";
			}

		}


?>