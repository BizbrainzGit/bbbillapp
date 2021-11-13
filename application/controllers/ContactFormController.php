
<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class ContactFormController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('ContactForm_model');
	 }

public function saveContactFormDetails(){

                $your_name       			           = $this->input->post("your_name");
                $business_email       			       = $this->input->post("business_email");
                $mobile_number       			       = $this->input->post("mobile_number");
                $company_name       			       = $this->input->post("company_name");
                $message       			               = $this->input->post("message");

          
           $postData=array();
		   $contactformdata = [];
         $postData = dataFieldValidation($your_name, "Menus Name",$contactformdata,"name","",$postData,"contactformarray");
         $postData = dataFieldValidation($business_email, "Business Email",$contactformdata,"email","",$postData,"contactformarray");
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$contactformdata,"mobile_no","",$postData,"contactformarray");
         $postData = dataFieldValidation($company_name, "Company Name",$contactformdata,"company_name","",$postData,"contactformarray");
         $postData = dataFieldValidation($message, "Message",$contactformdata,"message","",$postData,"contactformarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = null;
       $createdlog=isCreatedLog($userId);	
       $contactformarray = array_merge($postData['dbinput']['contactformarray'],$createdlog);
       $addcontactform=$this->ContactForm_model->AddContactFormDetails($contactformarray);
            if($addcontactform){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addcontactform));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }


}
?>