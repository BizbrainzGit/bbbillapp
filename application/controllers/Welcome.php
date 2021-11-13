<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
error_reporting(0);
class Welcome extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('User');
		$this->load->model('Userdetails_model');
		$this->load->model('CityMapping_model');
		$this->load->model('FeedbackQuestion_model');
		$this->load->model('BusinessFeedback_model');
		$this->load->model('BusinessFeedbackSaveQuestion_model');
		$this->load->model('Assignments_model');
		$this->load->model('Demowebsites_model');
        $this->load->model('Business_model');
		$this->load->model('Packages_model');
		$this->load->model('Customdata_model'); 
		$this->load->model('PaymentType_model');
        $this->load->model('Sms_send_model');
        $this->load->model('Userlogs_model');
		log_custom_message("Welcome Controller Constructor Called");
	}

	

	// == front end pages end===  //
	public function loginView()
	{
		$this->load->view('welcome_message');

	}
	public function is_user_logged_in(){ 
		if($this->is_user_logged_in) {
			$data = [
					'user_id'  => $this->auth_user_id,
					'username' => $this->auth_username,
					'user_roles'    => $this->auth_user_roles,
					'issuperadmin'     => $this->issuperadmin,
					'email'    => $this->auth_email,
					'profile_pic_path'=>$this->profile_pic_path,
					'name'=>$name,
					'city_id'=>$this->city_id
				];
			
			echo json_encode(array("success"=> true, "data" => $data));
			return;
		} else {
			echo json_encode(array("success"=> false));
			return;
		}
	}


	public function login(){
		try{
			log_custom_message("Login Method Called");
			if($this->is_user_logged_in) {
				$data = [
						'user_id'  => $this->auth_user_id,
						'username' => $this->auth_username,
						'user_roles'    => $this->auth_user_roles,
						'issuperadmin'     => $this->issuperadmin,
						'email'    => $this->auth_email,
						'profile_pic_path'=>$this->profile_pic_path,
						'name'=>$this->name,
						'city_id'=>$this->city_id
					];
				echo json_encode(array("success"=> true, "data" => $data));
				return;
			}
			
			$postdata = file_get_contents("php://input");
			$data = json_decode($postdata);
			// print_r($data);
			// echo $data->email;
			
			$dbData = [];
			$loginData=array();
			$loginData = dataFieldValidation($data->email, 'Email', $dbData, "email",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			$loginData = dataFieldValidation($data->password, 'Password', $dbData, "password",[ValidationTypes::REQUIRED], $loginData, "loginArray");
			
			if(isset($postData['errorslist']) && is_array($errors['errorslist'])){
				if(count($errors['errorslist'])>0){
					echo json_encode(array('success'=>false,'message'=>$errors['errorslist']));
					return;
				}
			}
			
			$username  = isset($data->email) ? $data->email : '';
			$password = isset($data->password) ? $data->password : '';
			
			
			$remember = false;
			if (isset($data->rememberme)){
				$remember = $data->rememberme;
			}
			
			if (empty($username) || empty($password))
			{   
				echo json_encode(array('success'=>false,'message'=>"Incorrect Username or Password"));
				return;
			}
		    			
			$usr_result=$this->ion_auth->login($username, $password, $remember);
			
			if ($usr_result === true) //active user record is present
			{
				$user = User::with('userdetails')->find($this->ion_auth->get_user_id());
				if($user->Userdetails->profile_pic_path === null || strlen($user->Userdetails->profile_pic_path) === 0){
					$user->Userdetails->profile_pic_path = 'assets/images/profile-img.jpg';
				}
				$user_id=$this->ion_auth->get_user_id();
				$username = $user->username;
				$email = $user->email;
				$name = trim($user->Userdetails->first_name . ' ' . $user->Userdetails->last_name);
				$issuperadmin = $this->ion_auth->is_admin();
				$city_id=$user->Userdetails->city_id;
				if($issuperadmin){
					$userroles = 'Admin';
					
				}
				else{
					$userroledata=User::userAccountsRole($this->ion_auth->get_user_id());
					foreach($userroledata as $value){
						 $userroles=$value->name;
					}
				}
				//set the session variables
                
		         $createdlog=isCreatedLog($user_id); 

		        $ip_address=$this->input->ip_address();
		        $login_datetime=date('Y-m-d H:i:s');
		        $session_id=session_id();
		         $userlogs = array_merge(array('user_id'=>$user_id,'ip_address'=>$ip_address,'login_datetime'=>$login_datetime,'session_id'=>$session_id),$createdlog);
		         $userlogsresult=$this->Userlogs_model->addUserLogs($userlogs);


				$sessiondata = [
					'user_id'  => $this->ion_auth->get_user_id(),
					'username' => $username,
					'issuperadmin' => $issuperadmin,
					'user_roles' => $userroles,
					'email'    => $email,
					'profile_pic_path'=> $user->Userdetails->profile_pic_path,
					'name'=>$name,
					'city_id'=>$city_id
				];
				
				$this->session->set_userdata($sessiondata);
				echo json_encode( array("success"=> true, 'data'=>$sessiondata));
				return;
			}
			else
			{
				if (strpos($this->ion_auth->errors(),"Account is inactive") > 0){
					echo json_encode(array("success"=> false, 'message'=> "Your account is inactive. Please contact administrator."));
					return;
				} else {
					echo json_encode(array("success"=> false, 'message'=> "Incorrect Username or Password"));
					return;
				}
			}		
		
		}catch(Exception $ex){
			 log_custom_message("Error:" . $ex. print_r($_REQUEST, TRUE)
							. "\nJSON Data:\n" . file_get_contents("php://input"));
		}
	}
	


	public function forgotPassword(){
		$this->load->view('forgot');
	}

	public function RegisterView()
	{
		$this->load->view('register');
	}


	public function Feedbackview()

	{   
	
		$id=$_REQUEST['id'];
		//$id=6;
        $data['businessid']=Assignments_model::where('business_details_id','=',$id)->get();
		$data['feedbackquestions']=$this->FeedbackQuestion_model->FeedbackquestionForBusiness();
		$this->load->view('feedbackview',$data);
	}

	public function SaveBusinessFeedback()
	{           
	            $marketing_userid       = $this->input->post("business_given_marketing_userid");
	            $businessid             = $this->input->post("business_given_businessid"); 
                $feedback_comments      = $this->input->post("business_given_feedback_comments");
                $feedback_questioncount = $this->input->post("business_given_questioncount");
                
                for($i=0;$i<$feedback_questioncount;$i++){

                	   $feedback_question[]  = $this->input->post("business_given_feedback_question$i");
				       $feedback_option[]      = $this->input->post("business_given_feedback_option$i");
                   }
		  
		   $business_feedback=array_combine($feedback_question,$feedback_option) ;
		   $postData=array();
           $businessfeedbackdata = [];

         $postData = dataFieldValidation($marketing_userid, "Bussnes Id",$businessfeedbackdata,"marketing_userid","",$postData,"businessfeedbackaarray");
         $postData = dataFieldValidation($businessid, "Company Name",$businessfeedbackdata,"business_id","",$postData,"businessfeedbackaarray");

         $postData = dataFieldValidation($feedback_comments, "Person Name",$businessfeedbackdata,"comments","", $postData,"businessfeedbackaarray");

            	if(isset($business_feedback) && !empty($business_feedback))
                {
        
              $feedbackdata=[];
			        foreach($business_feedback as $key=>$udata)
			    {
			      $option_id  = $udata;
			      $question_id = $key;
			      $postData = dataFieldValidation($question_id, "Question Id", $feedbackdata,"question_id", "", $postData, "feedbackdataarray".$key);
                 $postData = dataFieldValidation($option_id, "Option Id", $feedbackdata,"option_id", "", $postData, "feedbackdataarray".$key);

			        }

			     }



		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

        $business=BusinessFeedback_model::where('business_id','=',$businessid)->get();
      if(count($business)>0){
      	 echo json_encode(array('success'=>false,'message'=>"Already You given Feedback ...."));
				return;
         }
           // $userId = $this->ion_auth->get_user_id();
          //$createdlog=isCreatedLog($userId);
         //$businessemp = array_merge($postData['dbinput']['businessfeedbackaarray'],$createdlog);
         $businessfeedback=$this->BusinessFeedback_model->addBusinessFeedback($postData['dbinput']['businessfeedbackaarray']);

        if(isset($business_feedback) && !empty($business_feedback))
            {

			    foreach($business_feedback as $key=>$udata)
			    {
			        $option_id  = $udata;
			        $question_id = $key;

			        $feedbackqueArray=array('business_feedbackid'=>$businessfeedback,'question_id'=>$key,'option_id'=>$option_id);
			        $Businessfeedbackquestion=$this->BusinessFeedbackSaveQuestion_model->addBusinessFeedbackQuestion($feedbackqueArray);
			    }

            }

            if($businessfeedback && $Businessfeedbackquestion){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

	}

  public function demowebsites()
	{   
		$this->load->view('demowebsites');
	}
	
function OtpSendToMobileForpackage()
        {
               
                 $business_id = $this->input->post("add_packages_companyname");
                 $Businessdata=Business_model::where('id','=',$business_id)->get();
                 $numbers = $Businessdata[0]->mobile_no;

             $paymentmode_id = $this->input->post("add_business_payment_mode");
             $paymentmode =  PaymentType_model::where('id',$paymentmode_id)->get(['paymenttype_name']);//fetching from database table
		 json_encode(array('data'=>$paymentmode)); 
		  $paymentmodename= $paymentmode[0]['paymenttype_name'];
              $packages_total  = $this->input->post("add_packages_total");
              $packages_grandtotal = $this->input->post("add_packages_grandtotal");
                  $total=0;
               if(isset($packages_total) && !empty($packages_total)){
						$total=$packages_total;
					}else if(isset($packages_grandtotal) && !empty($packages_grandtotal)){
						$total=$packages_grandtotal;
					}
               $gst=$total*18/100;
               $gst = round($gst,2);
               $grandtoatal=$total+$gst;
              $grandtoatal=round($grandtoatal,2);

                $otp = rand(100000, 999999);
                $_SESSION['session_packageotp'] = $otp;

		$message=Customdata_model::where('content_type','=','OTP')->first()->content;
		$message=str_replace("{mobileOTP}",$otp ,$message);
		$message=str_replace("{TotalAmount}",$grandtoatal,$message);
		$message=str_replace("{paymentmode}",$paymentmodename,$message);

        $message1 = $message;
            
                
                $x=sendMultiSMS($numbers,$message1);

                if($x){  
      
      $vendor_id=1;
      $mobile_number=$numbers;
      $message=$message1;
      $response=$x;

         $postData=array();
         
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        
        $userId = $this->ion_auth->get_user_id();

        $createdlog=isCreatedLog($userId);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray); 

                    	echo json_encode(array('success'=>true,'message'=>"OTP sent Your mobile number!"));
				        return;
		        }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				        return;
		       }
    }

function OtpVerficationToMobileForpackage()
        {
        
                $otp = $this->input->post("package_mobileOtp");
                $_SESSION['session_packageotp'] ;
                if ($otp == $_SESSION['session_packageotp']) {
                    unset($_SESSION['session_packageotp']);
                    echo json_encode(array('success'=>true,'message'=>"Your mobile number is verified!"));
				        return;
                } else {
                    echo json_encode(array('success'=>false,'message'=>"You have entered wrong OTP."));
				        return;
                }

         }


         function OtpSendToMobile()
        {
        
             $numbers = $this->input->post("add_business_mobileno");
             $paymentmode_id = $this->input->post("add_newbusiness_payment_mode");
             $paymentmode =  PaymentType_model::where('id',$paymentmode_id)->get(['paymenttype_name']);//fetching from database table
		 json_encode(array('data'=>$paymentmode)); 
		 $paymentmodename= $paymentmode[0]['paymenttype_name'];
              $packages_total  = $this->input->post("add_business_packages_total");
              $packages_grandtotal = $this->input->post("add_business_packages_grandtotal");
                  $total=0;
               if(isset($packages_total) && !empty($packages_total)){
						$total=$packages_total;
					}else if(isset($packages_grandtotal) && !empty($packages_grandtotal)){
						$total=$packages_grandtotal;
					}
               $gst=$total*18/100;
               $gst = round($gst,2);
               $grandtoatal=$total+$gst;
               $grandtoatal = round($grandtoatal,2);
                $otp = rand(100000, 999999);
                $_SESSION['session_otp'] = $otp;

		$message=Customdata_model::where('content_type','=','OTP')->first()->content;
		$message=str_replace("{mobileOTP}",$otp ,$message);
		$message=str_replace("{TotalAmount}",$grandtoatal,$message);
		$message=str_replace("{paymentmode}",$paymentmodename,$message);

        $message1 = $message;
            
                
                $x=sendMultiSMS($numbers,$message1);

                if($x){  
      
      $vendor_id=1;
      $mobile_number=$numbers;
      $message=$message1;
      $response=$x;

         $postData=array();
         
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        
        $userId = $this->ion_auth->get_user_id();

        $createdlog=isCreatedLog($userId);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray); 

                    	echo json_encode(array('success'=>true,'message'=>"OTP sent Your mobile number!"));
				        return;
		        }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				        return;
		       }
    }

function OtpVerficationToMobile()
        {
        
              $otp = $this->input->post("mobileOtp");
                if ($otp == $_SESSION['session_otp']) {
                    unset($_SESSION['session_otp']);
                    echo json_encode(array('success'=>true,'message'=>"Your mobile number is verified!"));
				        return;
                } else {
                    echo json_encode(array('success'=>true,'message'=>"You have entered wrong OTP."));
				        return;
                }

         }



         // echo getName($n); 
function OtpSendToMobileForpackageMarketing()
        {
               
                 $business_id = $this->input->post("market_add_packages_companyname");
                 $Businessdata=Business_model::where('id','=',$business_id)->get();
                 $numbers = $Businessdata[0]->mobile_no;

             $paymentmode_id = $this->input->post("add_business_payment_mode");
             $paymentmode =  PaymentType_model::where('id',$paymentmode_id)->get(['paymenttype_name']);//fetching from database table
		 json_encode(array('data'=>$paymentmode)); 
		  $paymentmodename= $paymentmode[0]['paymenttype_name'];
              $packages_total  = $this->input->post("market_add_packages_total");
              $packages_grandtotal = $this->input->post("market_add_packages_grandtotal");
                  $total=0;
               if(isset($packages_total) && !empty($packages_total)){
						$total=$packages_total;
					}else if(isset($packages_grandtotal) && !empty($packages_grandtotal)){
						$total=$packages_grandtotal;
					}
               $gst=$total*18/100;
               $gst = round($gst,2);
               $grandtoatal=$total+$gst;
              $grandtoatal=round($grandtoatal,2);

                $otp = rand(100000, 999999);
                $_SESSION['session_packageotp_marketing'] = $otp;

		$message=Customdata_model::where('content_type','=','OTP')->first()->content;
		$message=str_replace("{mobileOTP}",$otp ,$message);
		$message=str_replace("{TotalAmount}",$grandtoatal,$message);
		$message=str_replace("{paymentmode}",$paymentmodename,$message);

        $message1 = $message;
            
                
                $x=sendMultiSMS($numbers,$message1);

                if($x){  
      
      $vendor_id=1;
      $mobile_number=$numbers;
      $message=$message1;
      $response=$x;

         $postData=array();
         
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        
        $userId = $this->ion_auth->get_user_id();

        $createdlog=isCreatedLog($userId);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray); 

                    	echo json_encode(array('success'=>true,'message'=>"OTP sent Your mobile number!"));
				        return;
		        }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				        return;
		       }
    }

function OtpVerficationToMobileForpackageMarketing()
        {
        
                $otp = $this->input->post("marketing_package_mobileOtp");
                if ($otp == $_SESSION['session_packageotp_marketing']) {
                    unset($_SESSION['session_packageotp_marketing']);
                    echo json_encode(array('success'=>true,'message'=>"Your mobile number is verified!"));
				        return;
                } else {
                    echo json_encode(array('success'=>false,'message'=>"You have entered wrong OTP."));
				        return;
                }

         } 

         

   function OtpSendToMobileForpackageMarketingLead()
        {
                 unset($_SESSION['session_packageotp_marketinglead']);
                $business_id = $this->input->post("market_lead_add_packages_companyname");
                 $Businessdata=Business_model::where('id','=',$business_id)->get();
                 $numbers = $Businessdata[0]->mobile_no;

             $paymentmode_id = $this->input->post("add_business_payment_mode");
             $paymentmode =  PaymentType_model::where('id',$paymentmode_id)->get(['paymenttype_name']);//fetching from database table
		 json_encode(array('data'=>$paymentmode)); 
		  $paymentmodename= $paymentmode[0]['paymenttype_name'];
              $packages_total  = $this->input->post("market_lead_add_packages_total");
              $packages_grandtotal = $this->input->post("market_lead_add_packages_grandtotal");
                  $total=0;
               if(isset($packages_total) && !empty($packages_total)){
						$total=$packages_total;
					}else if(isset($packages_grandtotal) && !empty($packages_grandtotal)){
						$total=$packages_grandtotal;
					}
               $gst=$total*18/100;
               $gst = round($gst,2);
               $grandtoatal=$total+$gst;
              $grandtoatal=round($grandtoatal,2);

                $otp = rand(100000, 999999);
                $_SESSION['session_packageotp_marketinglead'] = $otp;

		$message=Customdata_model::where('content_type','=','OTP')->first()->content;
		$message=str_replace("{mobileOTP}",$otp ,$message);
		$message=str_replace("{TotalAmount}",$grandtoatal,$message);
		$message=str_replace("{paymentmode}",$paymentmodename,$message);

        $message1 = $message;
            
                
                $x=sendMultiSMS($numbers,$message1);

                if($x){  
      
      $vendor_id=1;
      $mobile_number=$numbers;
      $message=$message1;
      $response=$x;

         $postData=array();
         
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        
        $userId = $this->ion_auth->get_user_id();

        $createdlog=isCreatedLog($userId);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray); 

                    	echo json_encode(array('success'=>true,'message'=>"OTP sent Your mobile number!"));
				        return;
		        }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				        return;
		       }
    }



function OtpVerficationToMobileForpackageMarketingLead()
        {
        
                 $otp = $this->input->post("marketinglead_package_mobileOtp");
                // echo $_SESSION['session_packageotp_marketinglead'];
                if ($otp == $_SESSION['session_packageotp_marketinglead']) {
                    unset($_SESSION['session_packageotp_marketinglead']);
                    echo json_encode(array('success'=>true,'message'=>"Your mobile number is verified!"));
				        return;
                } else {
                    echo json_encode(array('success'=>false,'message'=>"You have entered wrong OTP."));
				        return;
                }

         } 


function testEmail()
        {
            echo "baburao" ;
            $from="bizbrainz2020@gmail.com";
            $fromName="Admin" ;
            $to="bizbrainz2020@gmail.com";
            $subject="test" ;
            $body="baburao";
            $attachments=null;

           echo  $x=sendEmail($from, $fromName, $to, $subject, $body, $attachments);

         }


         function testSMS()
        {
            echo "baburao" ;
            $numbers="9652589420";
            $message1="Hello" ;
           echo  $x=sendMultiSMS($numbers,$message1);;

         }  
     
             function whatsSMS()
        {
            echo "baburao" ;
            $numbers="9652589420";
            $message1="Hello" ;
           echo  $x=" <a href='https://api.whatsapp.com/send?phone=+919100509236&text=I'm%20interested%20in%20your%20car%20for%20sale'>Send message</a> ";
//    $data = [
//     'phone' => '+919739989333', // Receivers phone
//     'body' => 'Hello,Welcome To Bizbrainz! check website http://bizbrainz.in/', // Message
// ];
// $json = json_encode($data); // Encode data to JSON
// // URL for request POST /message
// $token = 'xwolu8gkqdhlqv8z';
// $instanceId = '198999';
// $url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
// // Make a POST request
// $options = stream_context_create(['http' => [
//         'method'  => 'POST',
//         'header'  => 'Content-type: application/json',
//         'content' => $json
//     ]
// ]);
// // Send a request
// echo $result = file_get_contents($url, false, $options);

         }        



}?>