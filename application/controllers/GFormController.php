
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class GFormController extends CommonBaseController {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->database();
		$this->load->model('GForm_model'); 
		$this->load->model('Customdata_model'); 
		$this->load->model('EmailSendDemolinks_model');
				
	}

	   public function GFormView()
		  {
		    
		   $this->load->view('admin/g_form_view');
		  }
   
        public function marketingGFormView()
	    {
            $this->load->view('market/g_form_view');
        }
		public function teleMarketingGFormView()
	    {
		 	
         $this->load->view('tele-market/g_form_view');
        }
        public function marketLeadGFormView()
	    {
		 	
         $this->load->view('market-lead/g_form_view');
        }

   public function saveGFormData()
  {

  	        $add_gform_company_name       		       = $this->input->post("add_gform_company_name");
			$add_gform_proprietor_name       	       = $this->input->post("add_gform_proprietor_name");
			$add_gform_mobileno       			       = $this->input->post("add_gform_mobileno");
			$add_gform_email       				       = $this->input->post("add_gform_email");
            $add_gform_businesskeyword       		   = $this->input->post("add_gform_businesskeyword");
            $add_gform_workinghours       			   = $this->input->post("add_gform_workinghours");
            // $add_gform_workinghours       			   = $this->input->post("add_gform_workinghours");
    	    $add_gform_hno       				       = $this->input->post("add_gform_houseno");
			$add_gform_area       			           = $this->input->post("add_gform_area");
			$add_gform_landmark       			       = $this->input->post("add_gform_landmark");
			$add_gform_city       				       = $this->input->post("add_gform_city");
			$add_gform_state       			           = $this->input->post("add_gform_state");
			$add_gform_pincode     			           = $this->input->post("add_gform_pincode");
			
			if(isset($add_gform_pincode) && !empty($add_gform_pincode)){
					$add_gform_pincode=$add_gform_pincode;
				}else{
					$add_gform_pincode=0;
				}


		
			//  $sourcePath1= isset($_FILES['add_gform_photo']['tmp_name'])?$_FILES['add_gform_photo']['tmp_name']:'';
                
			// if(!empty($sourcePath1))
			// {
				
			// 	$target_dir = "assets/uploads/gform/";
			// 	$target_file = $target_dir .basename($_FILES["add_gform_photo"]["name"]);
			// 	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			//    $fileinfo = @getimagesize($_FILES["add_gform_photo"]["tmp_name"]);
   //             $width = $fileinfo[0];
   //             $height = $fileinfo[1];

			// 	$check = $_FILES["add_gform_photo"]["size"];
			// 	 if($width =! "1200" || $height =! "400"){
			// 		echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
			// 		return;
			// 	}
			// 	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
			// 		{
			// 		echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
			// 		return;
			// 	} 
   //                $temp=rand(0,100000).'_'; 
			// 	$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_gform_photo']['name']; // Target path where file is to be stored
				
			// 	if(move_uploaded_file($sourcePath1,$targetPath)){

			// 	$imagepath ="assets/uploads/gform/";
			// 	$image=$imagepath.$temp.$_FILES['add_gform_photo']['name'];
			// 	} else{
			// 		echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
			// 		return;
			// 	}
				
			// }else{
			// 	$imagepath =null;
			// 	$image=null;
			// 	echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
			// 		return;
				
			// }
		
		$userId = $this->ion_auth->get_user_id();
		$createdlog=isCreatedLog($userId);	
           $postData=array();
           
         
          $addgformuserdetails=[];

         $postData = dataFieldValidation($add_gform_company_name, "Company Name",$addgformuserdetails,"company_name","",$postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_proprietor_name, "Contact Person Name",$addgformuserdetails,"contact_personname","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_mobileno, "Mobile No",$addgformuserdetails,"mobileno","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_email, "Email",$addgformuserdetails,"email","",$postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_businesskeyword, "Business Keywords",$addgformuserdetails,"business_keywords","",$postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_workinghours, "Workin Hours",$addgformuserdetails,"working_hours","",$postData,"addgformdetailsarray");
         // $postData = dataFieldValidation($image, "Photo",$addgformuserdetails,"photo","",$postData,"addgformdetailsarray");

	     
            
           // $addgformadressdata = [];

        $postData = dataFieldValidation($add_gform_hno, "Bulidding Numnber",$addgformuserdetails,"house_no","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_area, "Area",$addgformuserdetails,"area","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_landmark, "LandMark",$addgformuserdetails,"landmark","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_pincode, "Pincode",$addgformuserdetails,"pincode","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_city, "City",$addgformuserdetails,"city_id","", $postData,"addgformdetailsarray");
         $postData = dataFieldValidation($add_gform_state, "State",$addgformuserdetails,"state_id","", $postData,"addgformdetailsarray");
        
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);
	    $gformarray = array_merge($postData['dbinput']['addgformdetailsarray'],$createdlog);
	   // print_r($gformarray);
	   $gformid = $this->GForm_model->AddGformData($gformarray);
		
          
            if($gformid >0){
            	$subject1='Sample Websites';
				$url1 = getHostURL(true).'websites';
				$name=$add_gform_company_name;
		        $hiuser = ucfirst($name);
				$body1=Customdata_model::where('content_type','=','Sample Websites')->first()->content;
				$body1=str_replace("{CompanyName}",$hiuser,$body1);
				$body1=str_replace("{URL}",$url1,$body1);
		        $sendresult=sendEmail("info@bizbrainz.in","Administrator",$add_gform_email,$subject1,$body1); 

                if($sendresult){
			       	  
			       	  $to_email=$add_gform_email;
			       	  $from_email="bizbrainz2020@gmail.com";
			       	  $user_id=$userId;
			       	  $business_id=$gformid;
			       	  $subject=$subject1;
			       	  $message=$body1;


			       	  $postData=array();
			          $emailsenddemodata = [];
			          
			         $postData = dataFieldValidation($to_email, "To Email",$emailsenddemodata,"to_email","",$postData,"emailsenddemoarray");
			           
			         $postData = dataFieldValidation($from_email, "From Email",$emailsenddemodata,"from_email","",$postData,"emailsenddemoarray");

			          $postData = dataFieldValidation($user_id, "User Id",$emailsenddemodata,"sender_user_id","",$postData,"emailsenddemoarray");
			           
			         $postData = dataFieldValidation($business_id, "Business ID",$emailsenddemodata,"business_gform_id","",$postData,"emailsenddemoarray");

			         $postData = dataFieldValidation($subject, "Subject",$emailsenddemodata,"subject","",$postData,"emailsenddemoarray");

			         $postData = dataFieldValidation($message, "Message",$emailsenddemodata,"message","",$postData,"emailsenddemoarray");

			        $createdlog=isCreatedLog($userId);
			        $emailsenddemoarray = array_merge($postData['dbinput']['emailsenddemoarray'],$createdlog);
			        $sendemailsenddemo=$this->EmailSendDemolinks_model->EmailSendDemolinksSave($emailsenddemoarray); 
			        
			               }



               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	


   
  }
  
   public function listGFormdata()
		{
          $resultdata=$this->GForm_model->listGFormData();
	      echo json_encode(array('success'=>true,'data'=>$resultdata));
        }


}
?>