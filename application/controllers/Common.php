<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class Common extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Status_model');
		 $this->load->model('Cities_model');
		 $this->load->model('States_model');
         $this->load->model('Business_model');
         $this->load->model('Address_model');
         $this->load->model('PaymentType_model');
         $this->load->model('BusinessPaymentmode_model');
         $this->load->model('Campaigns_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('BusinessOwner_model');
         $this->load->model('BusinessEmp_model');
         $this->load->model('Promocode_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Packages_model');
         $this->load->model('Subpackages_model');
         $this->load->model('Demowebsites_model');
         $this->load->model('CategoriesList_model');
         $this->load->model('BusinessKeywords_model');
         $this->load->model('Customdata_model');
         $this->load->model('UserGroups_model');
         $this->load->model('BusinessPackage_model');
         $this->load->model('CityMapping_model');
         $this->load->model('Assignments_model');
         $this->load->model('BusinessPaymentTransaction_model');
         $this->load->model('Sms_send_model'); 
         $this->load->model('Userlogs_model');  
         $this->load->model('ProductType_model'); 

    }
	public function logout() {
		
		session_start();
		//error_reporting(0);
		$userId=$this->ion_auth->get_user_id();
		$logout_datetime=date('Y-m-d H:i:s');
		$session_id=session_id();

		$this->Userdetails_model->updateUserDetails(array('city_id'=>null),$this->ion_auth->get_user_id());
		$this->ion_auth->logout();
		session_write_close();
		         $updatedlog=isUpdateLog($userId);
		         $updateuserlogs = array_merge(array('logout_datetime'=>$logout_datetime),$updatedlog);
		         $userlogsresult=$this->Userlogs_model->updateUserLogs($updateuserlogs,$session_id);

		if ($this->redirectType == "Normal"){
			//echo json_encode(array('success'=>true));
			header('Location:'."/".base_url(),null,302);
			return;
		} else {
			header($this->cprotocol . ' 350 ' . ' /');
			return;
		}
		
	}
      

       public function getAllUsers()
		{
		 $alluserdata =$this->Userdetails_model->AllUsers();//fetching from database table
		 echo json_encode(array('data'=>$alluserdata));
		 return;
		}


    public function getUsers()
		{
		 $email =$this->User->UsersList();//fetching from database table
		 echo json_encode(array('data'=>$email));
		 return;
		}

    public function getMarketingUsers()
		{
		 $email =$this->User->MarketingUsersList();//fetching from database table
		 echo json_encode(array('data'=>$email));
		 return;
		}

	public function getMarketLeadUsers()
		{
		 $email =$this->User->MarketLedUsersList();//fetching from database table
		 echo json_encode(array('data'=>$email));
		 return;
		}


	public function getDesignation()
		{
		 $designation =$this->UserGroups_model->DesignationList();//fetching from database table
		 echo json_encode(array('data'=>$designation));
		 return;
		}
			
	public function getSubpackages()
		{
		 $Subpackages =$this->Subpackages_model->SubpackagesList();//fetching from database table
		 echo json_encode(array('data'=>$Subpackages));
		 return;
		}		

    public function getCategories()
		{
		 $CategoriesList =$this->CategoriesList_model->CategoriesList();//fetching from database table
		 echo json_encode(array('data'=>$CategoriesList));
		 return;
		}		

    public function getStatus()
		{
		 $status =$this->Status_model->StatusList();//fetching from database table
		 echo json_encode(array('data'=>$status));
		 return;
		}
	public function getStatusWithOutDealClosed(){
		$status =$this->Status_model->StatusWithOutDealClosedList();//fetching from database table
		 echo json_encode(array('data'=>$status));
		 return;
	}

	public function getStatusListForTelemarketingBForm(){
		$status =$this->Status_model->StatusListForTelemarketingBForm();//fetching from database table
		 echo json_encode(array('data'=>$status));
		 return;
	}			

	// public function Statusget()  
	// 	{
	// 	 $status =$this->Status_model->StatusList();
	// 	 $getpayment = $this->BusinessPayments_model->PaymentsList();
	// 	 echo json_encode(array('data'=>$status,'status'=>$getpayment)); 
	// 	}		
	public function getCity()
		{
		 $cityname =$this->Cities_model->CityList();//fetching from database table
		 echo json_encode(array('data'=>$cityname));
		 return;
		}
	
	public function getState($cityId=null)
		{
		 if($cityId==null){
			$statename = $this->States_model->StateList();
		 }else{
			$statename = $this->States_model->getCityId($cityId);//fetching from database table
		 }
		 echo json_encode(array('data'=>$statename));
		 return;
		}

	public function getPaymenttype()
		{
		 $paymenttype = $this->PaymentType_model->PaymentTypeList();//fetching from database table
		 echo json_encode(array('data'=>$paymenttype));
		 return;
		}

    public function getCampaignlist()
		{
		 $campaignlist = $this->Campaigns_model->ListCampaignForBusiness();//fetching from database table
		 echo json_encode(array('data'=>$campaignlist));
		 return;
		}
	
	 public function getCampaignERPlist()
		{
		 $campaignlist = $this->Campaigns_model->ListCampaignERPForBusiness();//fetching from database table
		 echo json_encode(array('data'=>$campaignlist));
		 return;
		}
			
    
    public function getPackagelist()
		{
		 $packageslist = $this->Packages_model->GetPackageForBusiness();//fetching from database table
		 echo json_encode(array('data'=>$packageslist));
		 return;
		}

		 public function getDemoWebsitelinks($categoryId=null)
		{
		 if($categoryId==null){
			$weblist = $this->Demowebsites_model->getDemowebsitesByCategory();
		 }else{
			$weblist = $this->Demowebsites_model->getDemowebsitesByCategory($categoryId);//fetching from database table
		 }
		 echo json_encode(array('data'=>$weblist));
		 return;
		}


		public function getProductType()
		{
			 $producttypename =$this->ProductType_model->ProductTypeList();//fetching from database table
			 echo json_encode(array('data'=>$producttypename));
			 return;
		}

		public function getStatusForPackagesSeleted(){
		$status =$this->Status_model->StatusForPackagesSeleted();//fetching from database table
		 echo json_encode(array('data'=>$status));
		 return;
	}

} 
?>
