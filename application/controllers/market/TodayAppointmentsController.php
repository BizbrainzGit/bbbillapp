<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/market/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class TodayAppointmentsController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Status_model');
         $this->load->model('Business_model');
         $this->load->model('Address_model');
         $this->load->model('PaymentType_model');
         $this->load->model('BusinessPaymentmode_model');
         $this->load->model('Campaigns_model');
         $this->load->model('BusinessPackage_model');
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
         $this->load->model('Assignments_model');
         $this->load->model('BusinessPaymentTransaction_model');
        
			
		}	
 

     public function listTodayApp()
		{
	 	$today=date("Y-m-d");
		$city_id=$this->city_id;
        $userId = $this->ion_auth->get_user_id();
        $todaylist=$this->Assignments_model->BusinessListTodayFormarketing($today,$city_id,$userId);
	    echo json_encode(array('data'=>$todaylist));

     }


      public function TodayAppStatusPopup()
        {

       // date_default_timezone_set('Asia/kolkata');            
        $today=date("Y-m-d");
        $city_id=$this->city_id;
        $currentime=date('H:i:s');
        $time   = strtotime($currentime);
        $time   = $time - (60*60); //one hour
        $todaytime = date("H:i:s", $time);
        // die();
        $userId = $this->ion_auth->get_user_id();
        $todaylist=$this->Assignments_model->StatusPopupTodayFormarketing($today,$city_id,$userId,$todaytime);
             if(count($todaylist)>0){
                    echo json_encode(array('success'=>true,'data'=>$todaylist));
                    return;
             }else{
                   echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                  return;
            } 
       

     }

   


  public function MarketeditStatusByid($assignmentid)
		{
			// echo $result=Business_model::where('id','=',$id)->get([id,business_status_id]);
        
        $assignment_time=Assignments_model::join('business_details','business_details.id','=','assignments.business_details_id')->where('assignments.id','=',$assignmentid)
        ->get(['assignments.id','appointment_time','business_details_id','business_status_id','is_update']);
        $apptime = $assignment_time[0]['appointment_time'];
        $today=date("Y-m-d");
        $city_id=$this->city_id;
        $userid = $this->ion_auth->get_user_id();
        $assignment_updated=$this->Assignments_model->AppointmentUpdateTodayFormarketing($today,$city_id,$userid,$apptime);
        echo json_encode(array('success'=>true,'data'=>$assignment_updated,'updateddata'=>$assignment_time));
	     
        }

         public function  TodayMarketupdateStatusByid(){


		 $change_status_id        = $this->input->post("todaymarket_change_status_id");
         $change_status           = $this->input->post("todaymarket_change_status");
         $assignment_id           = $this->input->post("todaymarket_change_assignment_id");
         $assignment_message      = $this->input->post("todaymarket_change_assignment_message"); 
         $is_update=1;

         $postData=array();
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
         $marketchangestatus = [];
         
        $postData = dataFieldValidation($change_status, "Status",$marketchangestatus,"business_status_id","",$postData,"statusarray");

        $marketassignment = [];
        $postData = dataFieldValidation($assignment_message, "Meassage",$marketassignment,"marketing_message","",$postData,"marketassignmentarray"); 
        $postData = dataFieldValidation($change_status, "Assignment Status",$marketassignment,"assignment_status","",$postData,"marketassignmentarray");
        $postData = dataFieldValidation($is_update, "Update Value",$marketassignment,"is_update","",$postData,"marketassignmentarray");

        $statusarray = array_merge($postData['dbinput']['statusarray'],$updatedlog);
        $market_updateStatus = $this->Business_model->updateStatus($statusarray,$change_status_id);

        $marketassignmentarray = array_merge($postData['dbinput']['marketassignmentarray'],$updatedlog);
        $updateassignments = $this->Assignments_model->updateAssignments($marketassignmentarray,$assignment_id);



             if($market_updateStatus||$updateassignments){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				  return;
	
                  }	

         }
     
  public function MarketupdateStatusByid(){
 
		 $change_status_id        = $this->input->post("market_change_status_id");
         $change_status           = $this->input->post("market_change_status");
         $assignment_id           = $this->input->post("market_change_assignment_id");
         $assignment_message      = $this->input->post("market_change_assignment_message"); 
         
         $is_update=1;

         $postData=array();
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $marketchangestatus = [];

        $postData = dataFieldValidation($change_status, "Status",$marketchangestatus,"business_status_id","",$postData,"statusarray");
        $marketassignment = [];
        $postData = dataFieldValidation($assignment_message, "Meassage",$marketassignment,"marketing_message","",$postData,"marketassignmentarray"); 
        $postData = dataFieldValidation($change_status, "Assignment Status",$marketassignment,"assignment_status","",$postData,"marketassignmentarray");
        $postData = dataFieldValidation($is_update, "Update Value",$marketassignment,"is_update","",$postData,"marketassignmentarray");

        $statusarray = array_merge($postData['dbinput']['statusarray'],$updatedlog);
        $market_updateStatus = $this->Business_model->updateStatus($statusarray,$change_status_id);

        $marketassignmentarray = array_merge($postData['dbinput']['marketassignmentarray'],$updatedlog);
        $updateassignments = $this->Assignments_model->updateAssignments($marketassignmentarray,$assignment_id);



             if($market_updateStatus||$updateassignments){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				  return;
	
                  }	
  }



public function savePackagesData(){
               
                $business_id          = $this->input->post("market_edit_business_id");
                $address_id           = $this->input->post("market_edit_business_addid");
                $business_cname       = $this->input->post("market_edit_business_cname");
                $business_hno         = $this->input->post("market_edit_business_hno");
                $business_street      = $this->input->post("market_edit_business_street");
                $business_subarea     = $this->input->post("market_edit_business_subarea");
                $business_area        = $this->input->post("market_edit_business_area");
                $business_landmark    = $this->input->post("market_edit_business_landmark");
                $business_city        = $this->input->post("market_edit_business_city");
                $business_state       = $this->input->post("market_edit_business_state");
                $business_pincode     = $this->input->post("market_edit_business_pincode");

                if(isset($business_pincode) && !empty($business_pincode)){
                    $business_pincode=$business_pincode;
                }else{
                    $business_pincode=0;
                }
               
                $business_pname                            = $this->input->post("market_edit_business_pname");
                $business_mobileno                         = $this->input->post("market_edit_business_mobileno");
                $business_email                            = $this->input->post("market_edit_business_email");
                $business_gstno                            = $this->input->post("market_edit_business_gstno");



                     $business_campaign    = $this->input->post("add_business_campaign");
                     $business_package     = $this->input->post("add_business_package");

               $business_accountno = $this->input->post("market_add_packages_accountno");
                if(isset($business_accountno) && !empty($business_accountno)){
                    $business_accountno=$business_accountno;
                }else{
                    $business_accountno=0;
                }

                $business_acholdername                         = $this->input->post("market_add_packages_acholdername");

                if(isset($business_acholdername) && !empty($business_acholdername)){
                    $business_acholdername=$business_acholdername;
                }else{
                    $business_acholdername=null;
                }
                $business_bankname                             = $this->input->post("market_add_packages_bankname");
                if(isset($business_bankname) && !empty($business_bankname)){
                    $business_bankname=$business_bankname;
                }else{
                    $business_bankname=null;
                }
                $business_ifsccode                             = $this->input->post("market_add_packages_ifsccode");

                if(isset($business_ifsccode) && !empty($business_ifsccode)){
                    $business_ifsccode=$business_ifsccode;
                }else{
                    $business_ifsccode=null;
                }

                $business_bankcity                             = $this->input->post("market_add_packages_bankcity");
                if(isset($business_bankcity) && !empty($business_bankcity)){
                    $business_bankcity=$business_bankcity;
                }else{
                    $business_bankcity=null;
                }
                $business_branchname                           = $this->input->post("market_add_packages_branchname");
                if(isset($business_branchname) && !empty($business_branchname)){
                    $business_branchname=$business_branchname;
                }else{
                    $business_branchname=null;
                }

                $business_acctype                              = $this->input->post("market_add_packages_acctype");

                if(isset($business_acctype) && !empty($business_acctype)){
                    $business_acctype1=$business_acctype;
                }else{
                    $business_acctype1=0;
                }
               
                 $business_uppersale_amount     = $this->input->post("market_add_packages_uppersale_amount");
                       if(isset($business_uppersale_amount) && !empty($business_uppersale_amount)){
                            $business_uppersale_amount=$business_uppersale_amount;
                        }else{
                            $business_uppersale_amount=0;
                        }

                 $business_totaluppersale_amount     = $this->input->post("market_add_packages_totaluppersale_amount");
                       if(isset($business_totaluppersale_amount) && !empty($business_totaluppersale_amount)){
                            $business_totaluppersale_amount=$business_totaluppersale_amount;
                        }else{
                            $business_totaluppersale_amount=0;
                        }

                $packages_total = $this->input->post("market_add_packages_totalpackageamount");
                 if(isset($packages_total) && !empty($packages_total)){
                        $packages_total=$packages_total;
                    }else{
                        $packages_total=0;
                    }
                $packages_discountamount                      = $this->input->post("market_add_packages_discountamount");

                if(isset($packages_discountamount) && !empty($packages_discountamount)){
                        $packages_discountamount=$packages_discountamount;
                    }else{
                        $packages_discountamount=0;
                    }
                $packages_grandtotal                          = $this->input->post("market_add_packages_grandtotal");
                 if(isset($packages_grandtotal) && !empty($packages_grandtotal)){
                        $packages_grandtotal=$packages_grandtotal;
                    }else{
                        $packages_grandtotal=0;
                    }

                   $packages_domainchecked  = $this->input->post("market_add_packages_domainamount_checked");
                    if($packages_domainchecked ==1){
                       $packages_domainamount = $this->input->post("market_add_packages_domainamount");
                          } else{
                          $packages_domainamount="0.00";
                     }
                $packages_domainnames_option1   = $this->input->post("market_add_packages_domainnames_option1");
                $packages_domainnames_option2   = $this->input->post("market_add_packages_domainnames_option2");
                $packages_domainnames_option3   = $this->input->post("market_add_packages_domainnames_option3");
                $packages_domain_names=$packages_domainnames_option1.",".$packages_domainnames_option2.",".$packages_domainnames_option3;  

               
                if($packages_discountamount==0){
                          $packages_grandtotal = $packages_total;
                         }else{
                          $packages_grandtotal=$packages_total-$packages_discountamount;
                      }

                 if($packages_domainamount==0){
                     $total = $packages_grandtotal;
                  }else{
                     $total=$packages_grandtotal+$packages_domainamount;
                  }
               

                  $packages_tds  = $this->input->post("market_add_packages_tds");
                    if($packages_tds ==1){
                             $tds=$packages_grandtotal*2/100;
                              } else{
                          $tds="0.00";
                             }
                  if($business_state ==32){
                     $cgst=$packages_grandtotal*9/100;
                     $sgst=$packages_grandtotal*9/100;
                     $grandtoatal=$packages_grandtotal+$cgst+$sgst+$tds;
                     
                      } else if($business_state !=32){

                      $igst=$packages_grandtotal*18/100;
                      $grandtoatal=$packages_grandtotal+$igst+$tds;

                     }  

                    $grandtoatal=round($grandtoatal); 


                $packages_promocode_id                        = $this->input->post("market_add_packages_promocode_id");

                if(isset($packages_promocode_id) && !empty($packages_promocode_id)){
                        $packages_promocode_id=$packages_promocode_id;
                    }else{
                        $packages_promocode_id=0;
                    }
                 $business_payment_mode                       = $this->input->post("add_business_payment_mode");
                 
               
                if(isset($business_payment_mode) && !empty($business_payment_mode)){
                         $business_payment_mode=$business_payment_mode; 
                    }else{
                         $business_payment_mode=0;
                    }

                     $debitcardno                                 = $this->input->post("market_add_packages_debitcardno");
                     if(isset($debitcardno) && !empty($debitcardno)){
                        $debitcardno=$debitcardno;
                    }else{
                        $debitcardno=0;
                    }
                     $debitcardexpireddate                        = $this->input->post("market_add_packages_debitcard_expireddate");
                      if(empty($debitcardexpireddate)){
                        $debitcard_expireddate                     = null;
                        }else{
                        $debitcard_expireddate                     = date("Y-m-d", strtotime($debitcardexpireddate) );
                       }    
                     

                     $creditcardno                                = $this->input->post("market_add_packages_creditcardno");
                     if(isset($creditcardno) && !empty($creditcardno)){
                        $creditcardno=$creditcardno;
                    }else{
                        $creditcardno=0;
                    }
                     $creditcardexpireddate                       = $this->input->post("market_add_packages_creditcard_expireddate");

                      if(empty($creditcardexpireddate)){
                        $creditcard_expireddate                     = null;
                        }else{
                          $creditcard_expireddate                     = date("Y-m-d", strtotime($creditcardexpireddate) );
                       } 

                   


                     $upi                                         = $this->input->post("market_add_packages_upi");
                     $phonepay                                    = $this->input->post("market_add_packages_phonepay");
                     if(isset($phonepay) && !empty($phonepay)){
                        $phonepay=$phonepay;
                    }else{
                        $phonepay=0;
                    }
                     $amazonpay                                   = $this->input->post("market_add_packages_amazonpay");
                       if(isset($amazonpay) && !empty($amazonpay)){
                        $amazonpay=$amazonpay;
                    }else{
                        $amazonpay=0;
                    }
                     $googlepay                                   = $this->input->post("market_add_packages_googlepay");
                      if(isset($googlepay) && !empty($googlepay)){
                        $googlepay=$googlepay;
                    }else{
                        $googlepay=0;
                    } 

                    $upiamount                           = $this->input->post("market_add_packages_upiamount");
                     if(empty($upiamount)){
                        $upiamount                        = 0.00;
                        }else{
                          $upiamount                      = $upiamount;
                       }

                     $paytm_upi                                   = $this->input->post("market_add_packages_paytm_upi");
                      $paytmamount                           = $this->input->post("market_add_packages_paytmamount");
                     if(empty($paytmamount)){
                        $paytmamount                        = 0.00;
                        }else{
                          $paytmamount                      = $paytmamount;
                       } 

                     $cashamount                         = $this->input->post("market_add_packages_cashamount");
                     if(empty($cashamount)){
                        $cashamount                        = 0.00;
                        }else{
                          $cashamount                      = $cashamount;
                       }
                     $cashdate                           = $this->input->post("market_add_packages_cashdate");
                     if(empty($cashdate)){
                        $cashdate                        = null;
                        }else{
                          $cashdate                      = date("Y-m-d", strtotime($cashdate) );
                       } 
                     $personame                                   = $this->input->post("market_add_packages_personame");
                     $placename                                   = $this->input->post("market_add_packages_placename");
                     
                     $neftnumber                                  = $this->input->post("market_add_packages_neftnumber");

                    
                     $chequeno                                   = $this->input->post("market_add_packages_chequeno");
                      if(isset($chequeno) && !empty($chequeno)){
                        $chequeno=$chequeno;
                    }else{
                        $chequeno=0;
                    }
                     $chequeaccountno                            = $this->input->post("market_add_packages_chequeaccountno");
                      if(isset($chequeaccountno) && !empty($chequeaccountno)){
                        $chequeaccountno=$chequeaccountno;
                    }else{
                        $chequeaccountno=0;
                    }
                     $chequeholdername                           = $this->input->post("market_add_packages_chequeholdername");
                     $chequeissuedate                            = $this->input->post("market_add_packages_chequeissuedate");
                     if(empty($chequeissuedate)){
                        $chequeissuedate                         = null;
                        }else{
                          $chequeissuedate                       = date("Y-m-d", strtotime($chequeissuedate) );
                       } 
                     $cheque_bankname                            = $this->input->post("market_add_packages_cheque_bankname");
                     $cheque_ifsc                                = $this->input->post("market_add_packages_cheque_ifsc");
                     $cheque_micr                                = $this->input->post("market_add_packages_cheque_micr");
                      if(isset($cheque_micr) && !empty($cheque_micr)){
                        $cheque_micr=$cheque_micr;
                    }else{
                        $cheque_micr=0;
                    }
                    $chequeamount                            = $this->input->post("market_add_packages_chequeamount");
                     if(empty($chequeamount)){
                        $chequeamount                        = 0.00;
                        }else{
                          $chequeamount                      = $chequeamount;
                       } 
                       
                  $neftamount                            = $this->input->post("market_add_packages_neftamount");
                     if(empty($neftamount)){
                        $neftamount                        = 0.00;
                        }else{
                          $neftamount                      = $neftamount;
                       } 

                    $txnid = time(); 
                if($business_payment_mode==1){
                     $order_id="BB_CASH_".$txnid;
                     $status="SUCCESS";
                     $amount=$cashamount; 
                }else if($business_payment_mode==4){
                     $order_id="BB_UPI_".$txnid;
                     $status="SUCCESS";
                     $amount=$upiamount;
                }else if($business_payment_mode==5){
                     $order_id="BB_PAYTM_".$txnid;
                     $status="SUCCESS";
                     $amount=$paytmamount;
                }else if($business_payment_mode==6){
                      $order_id="BB_CHEQUE_".$txnid;
                      $status="SUCCESS";
                      $amount=$chequeamount;    
                }else if($business_payment_mode==7){
                      $order_id="BB_NEFT_".$txnid;
                      $status="SUCCESS";
                      $amount=$neftamount;    
                }else if($business_payment_mode==8){
                      $razorpayorder_id  = $this->input->post("razorpay_select_payment_order_id");
                }
            
             $business_status = $this->input->post("market_add_packages_status");
                if(isset($business_status) && !empty($business_status)){
                    $business_status=$business_status;
                }else{
                    $business_status=0;
                }

        $perviousid=BusinessPayments_model::orderBy('id','desc')->first();
        $pervious_business_package_id = $perviousid['business_package_id'];

         if($pervious_business_package_id){
            $pervious_business_package_id=$pervious_business_package_id;
        }else{
            $pervious_business_package_id=0;
        }

        $pervious_business_package_id++;
        $id_number=str_pad($pervious_business_package_id, 1, "0", STR_PAD_LEFT);  

                   $userId = $this->ion_auth->get_user_id();    
                      $postData=[];
                   if(isset($business_campaign) && !empty($business_campaign))
                        {
                              $campaign=[];
                            foreach($business_campaign as $key=>$udata)
                            {
                                  $campaign_id  = $udata;
                                  $postData = dataFieldValidation($campaign_id, "Campaign", $campaign,"campaign_id", "", $postData, "campaignarray".$key);
                                }
                        }

                      if(isset($business_package) && !empty($business_package))
                        {
                              $package=[];
                            foreach($business_package as $key=>$udata)
                            {
                                  $package_id  = $udata;
                                  $postData = dataFieldValidation($package_id, "Package", $package,"package_id", "", $postData, "packagearray".$key);
                                }
                        }

         

        $sourcePath2= isset($_FILES['market_add_packages_cheque_photo']['tmp_name'])?$_FILES['market_add_packages_cheque_photo']['tmp_name']:'';
                
            if(!empty($sourcePath2))
            {
                
                $target_dir = "assets/uploads/cheques/";
                $target_file = $target_dir.basename($_FILES["market_add_packages_cheque_photo"]["name"]);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
               
             //   $fileinfo = @getimagesize($_FILES["add_business_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

                // $check = $_FILES["add_business_photo"]["size"];
                //  if($width =! "1200" || $height =! "400"){
                //  echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
                //  return;
                // }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
                    {
                    echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
                    return;
                } 
                 
                $temp=rand(0,100000).'_';  
                $targetPath = FCPATH.$target_dir.$temp.$_FILES['market_add_packages_cheque_photo']['name']; // Target path where file is to be stored
                
                if(move_uploaded_file($sourcePath2,$targetPath)){

                $imagepath ="assets/uploads/cheques/";
                $cheque_image=$imagepath.$temp.$_FILES['market_add_packages_cheque_photo']['name'];

                } else{
                    echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
                    return;
                }
                
            }else{
                
                $cheque_image=null;
                
                
            }

         $marketing_add_package_otp  = $this->input->post("marketing_add_package_otp"); 
             if(isset($marketing_add_package_otp) && !empty($marketing_add_package_otp)){
                        $add_package_otp=$marketing_add_package_otp;
                    }else{
                        $add_package_otp=0;
                    }
                    
         $change_status           = $business_status;
         $assignment_id           = $this->input->post("market_add_packages_assignment_id");
         $assignment_message      = $this->input->post("market_add_packages_status_msg"); 
         $is_update=1;          
           
           $packagesdata = [];
         
          $postData = dataFieldValidation($business_id, "Business Id",$packagesdata,"business_id","", $postData,"packagesdataarray");
           $postData = dataFieldValidation($packages_domainamount, "Domain Amount",$packagesdata,"domain_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($packages_domain_names, "Domain Names",$packagesdata,"domain_names","", $postData,"packagesdataarray");

         $postData = dataFieldValidation($business_uppersale_amount, "Upper Sale Amount",$packagesdata,"uppersale_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($business_totaluppersale_amount, "Upper Sale Amount",$packagesdata,"totaluppersale_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_total, "Total Amount",$packagesdata,"total_amount","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($packages_discountamount, "Distocunt",$packagesdata,"discount_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_grandtotal, "Grand Total",$packagesdata,"grand_total_amount","", $postData,"packagesdataarray");
          
          $postData = dataFieldValidation($igst, "IGST",$packagesdata,"igst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($cgst, "CGST",$packagesdata,"cgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($sgst, "SGST",$packagesdata,"sgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($tds, "TDS Amount",$packagesdata,"tds_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($grandtoatal, "Grand Total",$packagesdata,"gstgrand_total_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($packages_promocode_id, "Promo Code",$packagesdata,"promocode_id","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($id_number, "Selected Id",$packagesdata,"business_package_id","", $postData,"packagesdataarray");

          

          $postData = dataFieldValidation($business_accountno, "Account Number",$packagesdata,"account_number","",$postData,"packagesdataarray");
         $postData = dataFieldValidation($business_acholdername, "Account holder Name",$packagesdata,"account_holder_name","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($business_bankname, "Bank Name ",$packagesdata,"bank_name","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($business_ifsccode, "IFSC code",$packagesdata,"ifsc_code","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($business_bankcity, "Bank City",$packagesdata,"bank_city","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($business_branchname, "Branch Name",$packagesdata,"branch_name","",$postData,"packagesdataarray");
         $postData = dataFieldValidation($business_acctype1, "Account Type",$packagesdata,"account_type","",$postData,"packagesdataarray");
         
      

       $paymenttransactiondata = [];
         $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray"); 
         $postData = dataFieldValidation($add_package_otp, "OTP",$paymenttransactiondata,"otp_no","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($business_payment_mode, "Business Payment Mode",$paymenttransactiondata,"payment_mode_id","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($debitcardno, "Debit Card Number",$paymenttransactiondata,"debitcard_number","", $postData,"paymenttransactionarray");
                     
        $postData = dataFieldValidation($debitcard_expireddate, "Debit Card Expired Date",$paymenttransactiondata,"debitcard_expireddate","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($creditcardno, "Credit Card Number",$paymenttransactiondata,"creditcard_number","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($creditcard_expireddate, "Credit Card Expired Date",$paymenttransactiondata,"creditcard_expireddate","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($upi, "UPI",$paymenttransactiondata,"upi","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($phonepay, "Phone Pay",$paymenttransactiondata,"phonepay","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($amazonpay, "Amazon Pay",$paymenttransactiondata,"amazonpay","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($googlepay, "Google Pay",$paymenttransactiondata,"googlepay","", $postData,"paymenttransactionarray");
                     
       $postData = dataFieldValidation($paytm_upi, "PayTm UPi",$paymenttransactiondata,"paytm_upi","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeno, "Cheque Number",$paymenttransactiondata,"cheque_number","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeaccountno, "Account Number",$paymenttransactiondata,"cheque_account_no","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeholdername, "Cheque Holder Name",$paymenttransactiondata,"cheque_holder_name","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($chequeissuedate, "Cheque Issue Date",$paymenttransactiondata,"cheque_issue_date","", $postData,"paymenttransactionarray");


       $postData = dataFieldValidation($cheque_bankname, "Cheque Bank Name",$paymenttransactiondata,"cheque_bankname","", $postData,"paymenttransactionarray");

      $postData = dataFieldValidation($cheque_ifsc, "Cheque IFSC",$paymenttransactiondata,"cheque_ifsc","", $postData,"paymenttransactionarray");
                     
      $postData = dataFieldValidation($cheque_micr, "Cheque MICR",$paymenttransactiondata,"cheque_micr","", $postData,"paymenttransactionarray");

      $postData = dataFieldValidation($cheque_image, "Cheque Photo",$paymenttransactiondata,"cheque_photo","", $postData,"paymenttransactionarray");
      
       $postData = dataFieldValidation($cashamount, "Cash Amount",$paymenttransactiondata,"cash_amount","", $postData,"paymenttransactionarray");

       $postData = dataFieldValidation($cashdate , "Cash Date",$paymenttransactiondata,"cash_date","", $postData,"paymenttransactionarray");

      $postData = dataFieldValidation($personame, "Cash Person Name",$paymenttransactiondata,"cash_personname","", $postData,"paymenttransactionarray");
                     
      $postData = dataFieldValidation($placename, "Cash Place/City Name",$paymenttransactiondata,"cash_place","", $postData,"paymenttransactionarray");

      $postData = dataFieldValidation($neftnumber, "NEFT /IMPS ",$paymenttransactiondata,"neft_number","", $postData,"paymenttransactionarray"); 
      
      $businessdata = [];
         $postData = dataFieldValidation($business_cname, "Company Name",$businessdata,"company_name","",$postData,"businessdataarray");
          $postData = dataFieldValidation($business_pname, "Person Name",$businessdata,"person_name","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_landlineno, "LandLine Number",$businessdata,"landline_no","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_mobileno, "Mobile No",$businessdata,"mobile_no","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_altnemobileno, "Mobile No",$businessdata,"alt_mobile_no","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_email, "Email",$businessdata,"email","",$postData,"businessdataarray");
         
          $postData = dataFieldValidation($business_gstno, "GST Number",$businessdata,"gst_number","", $postData,"businessdataarray");
        
 
        $businessadressdata = [];
        $postData = dataFieldValidation($business_hno, "Building Number",$businessadressdata,"house_no","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_street, "Street",$businessadressdata,"street","", $postData,"businessAddressarray");
        
         $postData = dataFieldValidation($business_subarea, "Sub Area",$businessadressdata,"sub_area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_area, "Area",$businessadressdata,"area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_landmark, "LandMark",$businessadressdata,"landmark","", $postData,"businessAddressarray");

         $postData = dataFieldValidation($business_city, "City",$businessadressdata,"city_id","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_state, "State",$businessadressdata,"state_id","",$postData,"businessAddressarray");
         $postData = dataFieldValidation($business_pincode, "Pincode",$businessadressdata,"pincode","", $postData,"businessAddressarray");


          $marketassignment = [];
        $postData = dataFieldValidation($assignment_message, "Meassage",$marketassignment,"marketing_message","",$postData,"marketassignmentarray"); 
        $postData = dataFieldValidation($change_status, "Assignment Status",$marketassignment,"assignment_status","",$postData,"marketassignmentarray");
        $postData = dataFieldValidation($is_update, "Update Value",$marketassignment,"is_update","",$postData,"marketassignmentarray");

      

      

        if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
            echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
            return;
        }
            

            $createdlog=isCreatedLog($userId);
             if(isset($business_campaign) && !empty($business_campaign))
                  {
                        foreach($business_campaign as $key=>$udata)
                        {
                            $campaign_id  = $udata;
                            $campaignArray=array('business_id'=>$business_id,'campaign_id'=>$campaign_id,'business_package_id'=>$id_number);
                            $Campaigns=$this->BusinessCampaign_model->addBCampaign($campaignArray);
                        }

                 }

                 if(isset($business_package) && !empty($business_package))
                  {
                        foreach($business_package as $key=>$udata)
                        {
                             $package_id  = $udata;
                             $packagearray1=array('business_id'=>$business_id,'package_id'=>$package_id,'business_package_id'=>$id_number);

                            // print_r($packagearray1);

                            $Packages=$this->BusinessPackage_model->addBPackage($packagearray1);
                        }

                 }

                 // die();

                   $updatedlog=isUpdateLog($userId);
                    $businessdataarray = array_merge($postData['dbinput']['businessdataarray'],$updatedlog);
                    $businessAddressarray = array_merge($postData['dbinput']['businessAddressarray'],$updatedlog);
                    $addressid = $this->Address_model->updateAddress($businessAddressarray,$address_id);
                    $Businessupdate=$this->Business_model->updateBusiness($businessdataarray,$business_id);

                    $marketassignmentarray = array_merge($postData['dbinput']['marketassignmentarray'],$updatedlog);
                    $updateassignments = $this->Assignments_model->updateAssignments($marketassignmentarray,$assignment_id);

             if($packages_grandtotal>0){

               $packagesdataarray = array_merge($postData['dbinput']['packagesdataarray'],$createdlog);
               $addPackagesid=$this->BusinessPayments_model->AddPayments($packagesdataarray);
               $userId = $this->ion_auth->get_user_id();
               $updatedlog=isUpdateLog($userId);

          if(strlen($razorpayorder_id)>0){
              $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid,'otp_no'=>$add_package_otp,'payment_mode_id'=>$business_payment_mode),$updatedlog);
              $paymenttransaction=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
              $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($razorpayorder_id);
               $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
               $transaction_status= $getTransactionOrderId[0]->transaction_status;
              }else{
             $userId = $this->ion_auth->get_user_id();
             $createdlog=isCreatedLog($userId);
             $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid),$postData['dbinput']['paymenttransactionarray'],$createdlog);
             $paymenttransaction=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 
             $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($order_id); 
         $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
         $transaction_status= $getTransactionOrderId[0]->transaction_status;
            }
            
            }


            if($Packages||$Campaigns||$addPackagesid || $Businessupdate||  $addressid){

                 $data = array('business_status_id' => $business_status);
                 $Businessupdate=Business_model::where('id','=',$business_id)->update($data);
                  $Businessdata=Business_model::where('id','=',$business_id)->get();
                  $business_email = $Businessdata[0]->email;
                  $business_mobileno = $Businessdata[0]->mobile_no;
                  $business_cname = $Businessdata[0]->company_name;
                 
        $subject='Feedback';
        $url = getHostURL(true).'feedback?id='.$business_id;
        $name=$Businessemail['company_name'];
        $hiuser = ucfirst($name);
        $body=Customdata_model::where('content_type','=','Feedback')->first()->content;
        $body=str_replace("{CompanyName}",$hiuser,$body);
        $body=str_replace("{URL}",$url,$body);
        // $body.="<br> <p>For any query, please call Mr KRISHNA CHOWDARY PURIMETLA at 9739989333.</p> ";
        sendEmail("info@bizbrainz.in","Administrator",$business_email, $subject,$body); 
             if($business_status==12){
                   $id = $addPackagesid;
                 // $export_type = $this->input->post("export_type");
             $titledata='Proposal';
             $data=$this->BusinessPayments_model->Invoice($id);
             $data=$this->BusinessPayments_model->Invoice($id);
               $campaign = $data[0]['campaign_id'];
               $package = $data[0]['package_id'];
               $package_id = $Businessinvoice[0]['business_package_id'];
               if($campaign!=null){
                 $array = explode(',', $campaign);
                  for($i=0;$i<count($array);$i++){
                      $campaignlist[] = Campaigns_model::where('id','=',$array[$i])->get(['campaign_name','campaign_amount']);
                  }
               
               }
             if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                      $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }
             }
              
              $filename='Proposal-'.$id.'-'.date('YmdHis').'.pdf';
              $data2['data']=$data;
              $data2['campaignlist']=$campaignlist;
              $data2['packageslist']=$packageslist;
              $data2['invoicedata']=$invoiceData;
            // die();
            $data2['print']=0;
            //load the view and saved it into $html variable
            $html=$this->load->view('export/estimateReceiptExportPdf',$data2, true);
            //this the the PDF filename that user will get to download
            $pdfFilePath =FCPATH.'/assets/downloads/'.$filename;
            //load mPDF library
            $this->load->library('pdf');
           //generate the PDF from the given html
            $this->pdf->pdf->useSubstitutions = true;
            $this->pdf->pdf->WriteHTML($html);
            //download it.
            ob_clean();
            $this->pdf->pdf->Output($pdfFilePath,"F");
            // $file='assets/downloads/'.$filename;
                    
                    $receiptsubject1='Proposal';
                    $name=$business_cname;
                    $hiuser = ucfirst($name);
                    $receiptbody1=Customdata_model::where('content_type','=','Receipt')->first()->content;
                    $receiptbody1=str_replace("{CompanyName}",$hiuser,$receiptbody1);
                    $attachments='assets/downloads/'.$filename; 
                 $x=sendEmail("bizbrainz2020@gmail.com","Administrator",$business_email,$receiptsubject1,$receiptbody1,$attachments);
                }
                
               
                if($transaction_amount>=$grandtoatal && $transaction_status=='SUCCESS'){ 
                 $userId = $this->ion_auth->get_user_id();
                 $updatedlog=isUpdateLog($userId);
                 $status=4;
                 $statusupdatefordealclose = array_merge(array('business_status_id'=>$status),$updatedlog);
                 $statusupdate=$this->Business_model->updateBusiness($statusupdatefordealclose,$business_id);

                  $perviousid=BusinessPayments_model::orderBy('receipt_no','desc')->first();
                    $number = $perviousid['receipt_no'];
                    $a=explode("/",$number);
                    $number=$a[2];
                    $number++;
                    $short_name=BB_INVOICE_NO;
                    $id_number=str_pad($number, 4,"0", STR_PAD_LEFT);     
                    $receipt_no = $short_name.$id_number;
                    $receiptfordealclose = array_merge(array('receipt_no'=>$receipt_no),$updatedlog);
                    $receiptupdate=$this->BusinessPayments_model->updateReceiptNo($receiptfordealclose,$addPackagesid); 
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


public function getAmountPromocode(){

            $business_id = $this->input->post("market_add_packages_companyname");
            $promocode = $this->input->post("market_add_packages_promocode");
            $todaydate= date("Y-m-d");
            $getpromocodeamount=$this->Promocode_model->PromocodeAmount($promocode,$todaydate);
            $promcodecount=BusinessPayments_model::where('business_payments.business_id','=',$business_id)->get();
         if(count($getpromocodeamount)>0){
                        if($promcodecount[0]['promocode_id'] == $getpromocodeamount[0]['id']){
                            echo json_encode(array('success'=>false,'message'=>'This Promo Code Already Used...'));
                             return;   
                     }else{
                         echo json_encode(array('success'=>true,'data'=>$getpromocodeamount));
                          return; 
                     }

               }else{

                    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                        return;
                       
                }    
 
          }

          public function editBusinessByid($id)
        {
          $businessedit = $this->Business_model->editBusiness($id);
          $businessowneredit = $this->BusinessOwner_model->editBusinessowner($id);
         echo json_encode(array('success'=>true,'data'=>$businessedit,'editowner'=>$businessowneredit));
         return; 

        }

      

}
?>