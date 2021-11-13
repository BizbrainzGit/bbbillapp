
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmsTriggerController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('CityMapping_model');
		$this->load->model('Business_model');
        $this->load->model('Sms_send_model');
        $this->load->model('Assignments_model');
		$this->load->model('Userdetails_model');		
	}

	  
    public function SmsSendingToMarketing(){
        $Addassigment= $this->Assignments_model->SendSmsBerforeAppointmentTime();
        $date = date('Y-m-d H:i:s');
		//echo $date;
        for($i=0;$i<count($Addassigment);$i++){

             $appointment_datetime=$Addassigment[$i]->appointment_datetime;
             $marketing_user_id=$Addassigment[$i]->user_id;
             $business_details_id=$Addassigment[$i]->business_details_id;
             $appointment_date=$Addassigment[$i]->appointment_date;
             $appointment_time=$Addassigment[$i]->appointment_time;
             // $result=$date-$appointment_datetime;
             $result= round((strtotime($appointment_datetime) - strtotime($date)) / 60);
             // echo $result."<br>";
             if($result==30){
                $marketing=$this->Userdetails_model->getdetailsForSms($marketing_user_id);
                 
                  $marketing_name =$marketing->first_name." ".$marketing->last_name;
                  $marketing_mobile=$marketing->mobileno;
                  $marketing_email=$marketing->email;
            
                    $businessdata=Business_model::where('business_details.id','=',$business_details_id)->join('address','address.id','=','business_details.address_id')->leftjoin('cities','cities.cityid','=','address.city_id')->leftjoin('business_status','business_status.id','=','business_details.business_status_id') ->leftjoin('states','states.state_id','=','address.state_id')->get(['business_details.id','company_name', 'house_no', 'street', 'sub_area', 'area', 'landmark','pincode', 'person_name', 'landline_no', 'mobile_no', 'email', 'photo','cityname','state_name','alt_mobile_no','gst_company_name', 'gst_number', 'gst_state', 'gst_pincode', 'gst_pan_no', 'gst_address', 'website_url', 'facebook_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'instagram_url','business_status_id','business_details.business_id']);

          $app_date=$Addassigment->appointment_date;
          $app_time  = date("g:i A", strtotime($appointment_time));

          $company_name=$businessdata[0]->company_name;
          $person_name=$businessdata[0]->person_name;
          $company_mobile=$businessdata[0]->mobile_no;
          $app_address=$businessdata[0]->street.",".$businessdata[0]->area.",".$businessdata[0]->cityname.",".$businessdata[0]->state_name.".";
          $website_url= getHostURL(true).'websites';
         
		 $marketing_sms="Hi, ".$marketing_name.". Your appoint is with Mr.".$person_name."  ".$company_mobile.",of ".$company_name." ".$app_address." on ".$app_date." ".$app_time.". Here is the products link ".$website_url."";

     $receiptsubject1="Appointment";
     $attachments=null;
     $x=sendEmail("bizbrainz2020@gmail.com","Administrator",$marketing_email,$receiptsubject1,$marketing_sms,$attachments);

      $smsStatusData=sendSMSApp($marketing_mobile,$marketing_sms);
      if($smsStatusData){
              $vendor_id="1";
              $mobile_number=$marketing_mobile;
              $message=$marketing_sms;
              $response=$statusValue;

         $postData=array();
         
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        
        // $createdlog=isCreatedLog($tele_caller_id);
        $smsarray = array_merge($postData['dbinput']['smsarray']);
        $sendsms=$this->Sms_send_model->Smssend($smsarray);
    }
         

             }


         }
       
	}

}
?>