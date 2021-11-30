
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class SendLinkController extends CommonBaseController {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->database();
		$this->load->model('SendLink_model'); 
		$this->load->model('Customdata_model'); 
		$this->load->model('EmailSendDemolinks_model'); 

		$this->load->model('Address_model'); 
		$this->load->model('Business_model'); 
		$this->load->model('BusinessOwner_model'); 
		$this->load->model('Cities_model'); 

		$this->load->model('CityMapping_model'); 
				
	}

	   public function SendLinkView()
		  {
		   $this->load->view('admin/sendlinkview');
		  }
   
        public function marketingSendLinkView()
	    {   
	    	 $id= $this->ion_auth->get_user_id();
             $citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
             $this->load->view('market/sendlinkview',$citydata);

        }
		public function teleMarketingSendLinkView()
	    {
		 	
         $this->load->view('tele-market/sendlinkview');
        }
        public function marketLeadSendLinkView()
	    {
         $this->load->view('market-lead/sendlinkview');
        }

   public function saveSendLinkData()
  {

  	      $add_sendlink_company_name       	 = $this->input->post("add_sendlink_company_name");
		  $add_sendlink_proprietor_name      = $this->input->post("add_sendlink_proprietor_name");
		  $add_sendlink_mobileno       	     = $this->input->post("add_sendlink_mobileno");
		  $add_sendlink_email       	     = $this->input->post("add_sendlink_email");
          $add_sendlink_demolinks            = $this->input->post("add_sendlink_demolinks");

          $add_sendlink_city       	         = $this->input->post("add_sendlink_city");
          $add_sendlink_state                = $this->input->post("add_sendlink_state");
      
	         $citysname=Cities_model::where('cities.cityid','=',$add_sendlink_city)->get();
	           json_encode(array('data'=>$citysname)); 
			 $short_name= $citysname[0]['short_code']; 

			$perviousid=Business_model::orderBy('id','desc')->first();
	        $number = $perviousid['business_id'];
	        $a=explode("-",$number);
	        $number=$a[1];
	        $number++;
	        $id_number=str_pad($number, 4,"0", STR_PAD_LEFT);     
	        $company_id = $short_name.'-'.$id_number;
            $add_sendlink_issenddemolink=1;
		    $business_status=15;
			$userId = $this->ion_auth->get_user_id();
	        $postData=array();
         
          $addsendlinkuserdetails=[];

         $postData = dataFieldValidation($add_sendlink_company_name, "Company Name",$addsendlinkuserdetails,"company_name","",$postData,"addsendlinkdetailsarray");

         $postData = dataFieldValidation($add_sendlink_proprietor_name, "Contact Person Name",$addsendlinkuserdetails,"contact_personname","", $postData,"addsendlinkdetailsarray");

         $postData = dataFieldValidation($add_sendlink_mobileno, "Mobile No",$addsendlinkuserdetails,"mobileno","", $postData,"addsendlinkdetailsarray");

         $postData = dataFieldValidation($add_sendlink_demolinks, "Demo Links",$addsendlinkuserdetails,"demo_link","",$postData,"addsendlinkdetailsarray");

          $postData = dataFieldValidation($add_sendlink_email, "Email",$addsendlinkuserdetails,"email","",$postData,"addsendlinkdetailsarray");

       
		   $businessdata = [];
           
           $postData = dataFieldValidation($company_id, "Bussnes Id",$businessdata,"business_id","",$postData,"businessdataarray");
          $postData = dataFieldValidation($add_sendlink_company_name, "Company Name",$businessdata,"company_name","",$postData,"businessdataarray");
          $postData = dataFieldValidation($add_sendlink_proprietor_name, "Person Name",$businessdata,"person_name","", $postData,"businessdataarray");

          $postData = dataFieldValidation($add_sendlink_mobileno, "Mobile No",$businessdata,"mobile_no","", $postData,"businessdataarray");
         
          $postData = dataFieldValidation($add_sendlink_email, "Email",$businessdata,"email","",$postData,"businessdataarray");

          $postData = dataFieldValidation($add_sendlink_issenddemolink, "Is Send Demo Link",$businessdata,"is_senddemolink","",$postData,"businessdataarray");
       
         $postData = dataFieldValidation($business_status, "Status",$businessdata,"business_status_id","", $postData,"businessdataarray");
   

          $businessadressdata = [];

         $postData = dataFieldValidation($add_sendlink_city, "City",$businessadressdata,"city_id","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($add_sendlink_state, "State",$businessadressdata,"state_id","",$postData,"businessAddressarray");
       

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);

	    $sendlinkarray = array_merge($postData['dbinput']['addsendlinkdetailsarray'],$createdlog);
	    $sendlinkid = $this->SendLink_model->AddDemolinks($sendlinkarray);

        $addressarray = array_merge($postData['dbinput']['businessAddressarray'],$createdlog); 
        
        $addressid = $this->Address_model->addAddress($addressarray);
       
        $business = array_merge($postData['dbinput']['businessdataarray'],array('address_id'=>$addressid),$createdlog);
        $addBusinessid=$this->Business_model->addBusiness($business);
        
        $businessowner1 = array_merge($postData['dbinput'],array('business_id'=>$addBusinessid));
        $addowner1=$this->BusinessOwner_model->addBusinessowner($businessowner1);
       
        $businessowner2 = array_merge($postData['dbinput'],array('business_id'=>$addBusinessid));
        $addowner2=$this->BusinessOwner_model->addBusinessowner($businessowner2);
          
        if($sendlinkid && $addBusinessid ){

            	$subject1='Demo Website && Sepcial Offer';
            	$buynow_url = getHostURL(true).'sendlinkbuynow?id='.$addBusinessid;
				$demolink_url = $add_sendlink_demolinks;
				$name=$add_sendlink_proprietor_name;
		        $hiuser = ucfirst($name);
				$body1=Customdata_model::where('content_type','=','SendDemoLink')->first()->content;
				$body1=str_replace("{CompanyName}",$hiuser,$body1);
				$body1=str_replace("{URL}",$demolink_url,$body1);
				$body1=str_replace("{BUYNOWURL}",$buynow_url,$body1);
		        $sendresult=sendEmail("info@bizbrainz.in","Administrator",$add_sendlink_email,$subject1,$body1,null); 
		        $body2="Hi,".$name.",  Greeting From Bizbrainz Technologies Private Limited.  Click on the link below to view some of our sample website for Internet Website Designers.  ".$demolink_url."  We are proving website life time Rs.15000 Frist 100 Customers only. ".$buynow_url."  Any Queries Call Us 8196 98 98 98.";
		        $dataurl="https://api.whatsapp.com/send?phone=+91".$add_sendlink_mobileno."&text=".$body2." ";
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$dataurl));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	


   
  }
  
   public function listSendLinkdata()
		{
          $resultdata=$this->SendLink_model->listSendLinkData();
	      echo json_encode(array('success'=>true,'data'=>$resultdata));
        }


}
?>