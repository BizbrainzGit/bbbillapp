<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class BusinessController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
         $this->load->model('Campaigns_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('BusinessOwner_model');
         $this->load->model('Packages_model');
         $this->load->model('Customdata_model');
         $this->load->model('BusinessPackage_model');
         $this->load->model('BusinessPaymentTransaction_model');
         $this->load->model('CityMapping_model');
         $this->load->model('CategoriesList_model');
         $this->load->model('Demowebsites_model');
         $this->load->model('Business_model');
         $this->load->model('Address_model');
         $this->load->model('Promocode_model');
         $this->load->model('Cities_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Userdetails_model');
    }
     
     public function BusinessView()
	    {
		 	
         $this->load->view('admin/managebusinessview');
        }
        
		public function marketingBusinessView()
	    {
		 	$id= $this->ion_auth->get_user_id();
			$citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
            $this->load->view('market/managebusinessview',$citydata);
        }

		public function teleMarketingBusinessView()
	    {
         $this->load->view('tele-market/managebusinessview');
        }

        public function marketLeadBusinessView()
	    {
		 	
         $this->load->view('market-lead/managebusinessview');
        }

         public function accountantBusinessView()
	    {
         $this->load->view('accountant/managebusinessview');
        }


//==== Start Business Keywords Code for Business View page ==== /

	public function getBusinessKeywordslist()
		{
		  $business_keyword = null;
		  $keywordslist = $this->CategoriesList_model->SearchBusinessKeywordsforBusiness($business_keyword);//fetching from database table
		  echo json_encode(array('success'=>true,'data'=>$keywordslist));
		  return;
		} 
    
    public function SearchKeywordsForBusinessList()
		{
          
           $business_keyword                = $this->input->post("search_business_keyword"); 
           $searchdata=$this->CategoriesList_model->SearchBusinessKeywordsforBusiness($business_keyword);
           if(count($searchdata)>0){
				echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
              }else{
                  echo json_encode(array('success'=>false,'message'=>NOT_AVAILABLE_DATA));
				 return;
                  }
		} 

//==== Ends Business Keywords Code for Business View page ==== /


//==== Start Demo Website Code for Business View page ==== /
	public function getDemoWebsiteslist()
		{
		  $weblist = $this->Demowebsites_model->GetDemowebsitesForBusiness();//fetching from database table
		  echo json_encode(array('data'=>$weblist));
		  return;
		}
    
    public function SearchWebsitesForBusinessList()
		{
          
          $business_website = $this->input->post("search_business_website"); 
           $searchdata=$this->Demowebsites_model->SearchWebsiteforBusiness($business_website);
           if(count($searchdata)>0){
				echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
              }else{
                  echo json_encode(array('success'=>false,'message'=>NOT_AVAILABLE_DATA));
				 return;
                  }
		} 

//==== Ends Demo Website Code for Business View page ==== /
		


    public function editBusinessAppointmentsByid($id)
        {
         $appointmentsedit = $this->Business_model->editBusinessAppointments($id);
		 echo json_encode(array('success'=>true,'data'=>$appointmentsedit)); 
		}


	public function updateBusinessAppointmentsData()
	    {
        $appointment_id 				=$this->input->post("edit_appointment_id");
		$business_status       		    = $this->input->post("edit_status");

        $postData=array(); 
        $businessdata = [];	
        $postData = dataFieldValidation($business_status, "Status",$businessdata,"business_status_id","", $postData,"businessdataarray");

           if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		
		$updateAppointment = $this->Business_model->UpdateAppointments($postData['dbinput']['businessdataarray'],$appointment_id);
             if($updateAppointment){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateAppointment));
				return;	
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

    public function editStatusByid($id)
		{
			$result=Business_model::where('id','=',$id)->get(['business_status_id','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
	     
        }

    public function updateStatusByid(){

         $change_status_id       			            = $this->input->post("change_status_id");
         $change_status       			                = $this->input->post("change_status"); 
        $postData=array();
		$changestatus = [];
		$postData = dataFieldValidation($change_status, "Status",$changestatus,"business_status_id","",$postData,"statusarray");
        $updateStatus = $this->Business_model->updateStatus($postData['dbinput']['statusarray'],$change_status_id);
            
             if($updateStatus){
				          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
				          return;
              }else{
                          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				          return;
	
                  }	
  }


  public function getAmountPromocodeforBusiness(){

            $promocode = $this->input->post("business_packages_promocode");
            $todaydate= date("Y-m-d");
            $getpromocodeamount=$this->Promocode_model->PromocodeAmount($promocode,$todaydate);
         if(count($getpromocodeamount)>0){
                       echo json_encode(array('success'=>true,'data'=>$getpromocodeamount));
                     	  return; 
                     }else{
                    echo json_encode(array('success'=>false,'message'=>NOT_AVAILABLE_DATA));
						return;
				  }    
 
          }


public function saveBusinessData(){
               
                $business_cname       			           = $this->input->post("add_business_cname");
			    $business_cname                            =isset($business_cname)? $business_cname:null;
			    $business_category_name       			   = $this->input->post("add_business_category_name");
			    $business_hno       				       = $this->input->post("add_business_hno");
			    $business_street       			           = $this->input->post("add_business_street");
			    $business_subarea       				   = $this->input->post("add_business_subarea");
			    $business_area       			           = $this->input->post("add_business_area");
                $business_landmark       			       = $this->input->post("add_business_landmark");
                $business_city       				       = $this->input->post("add_business_city");
			    $business_state       			           = $this->input->post("add_business_state");
			    $business_pincode       			       = $this->input->post("add_business_pincode");
				if(isset($business_pincode) && !empty($business_pincode)){
					$business_pincode=$business_pincode;
				}else{
					$business_pincode=0;
				}
				
			    $business_pname                            = $this->input->post("add_business_pname");
				$business_pname                            =isset($business_pname)? $business_pname:null;
			    $business_designation       			   = $this->input->post("add_business_designation");
				$business_landlineno       				   = $this->input->post("add_business_landlineno");
			    $business_mobileno       			       = $this->input->post("add_business_mobileno");
			    $business_altnemobileno       			   = $this->input->post("add_business_altnemobileno");
			    $business_email       				       = $this->input->post("add_business_email");
                
                $business_payment_mode       			   = $this->input->post("add_business_payment_mode");
                $business_campaign       		     	   = $this->input->post("add_business_campaign");

			    //$business_currentlatlag       			   = $this->input->post("add_business_currentlatlag");

			    $business_currentlat       			   = $this->input->post("add_business_currentlat");
				if(isset($business_currentlat) && !empty($business_currentlat)){
					$business_currentlat=$business_currentlat;
				}else{
					$business_currentlat=0.00;
				}
				$business_currentlag       			   = $this->input->post("add_business_currentlag");
				if(isset($business_currentlag) && !empty($business_currentlag)){
					$business_currentlag=$business_currentlag;
				}else{
					$business_currentlag=0.00;
				}
                $business_website                         = $this->input->post("add_business_website");
                $business_facebook                        = $this->input->post("add_business_facebook");
                $business_twitter                         = $this->input->post("add_business_twitter");
                $business_youtube                         = $this->input->post("add_business_youtube");
                $business_linkedin                        = $this->input->post("add_business_linkedin");
                $business_instagram                       = $this->input->post("add_business_instagram");
                $business_gstcname       			      = $this->input->post("add_business_gstcname");
                $business_gstno       			          = $this->input->post("add_business_gstno");
				$business_gststate       				  = $this->input->post("add_business_gststate");
				if(isset($business_gststate) && !empty($business_gststate)){
					$business_gststate=$business_gststate;
				}else{
					$business_gststate=0;
				}

			    $business_gstpincode       			       = $this->input->post("add_business_gstpincode");
				if(isset($business_gstpincode) && !empty($business_gstpincode)){
					$business_gstpincode=$business_gstpincode;
				}else{
					$business_gstpincode=0;
				}
			    $business_gstpanno       			       = $this->input->post("add_business_gstpanno");
			    $business_gstaddress       				   = $this->input->post("add_business_gstaddress");

			    
                $business_owner1name                           = $this->input->post("add_business_owner1name");
                $business_owner1role                           = $this->input->post("add_business_owner1role");
                $business_owner1mobile                         = $this->input->post("add_business_owner1mobile");
				if(isset($business_owner1mobile) && !empty($business_owner1mobile)){
					$business_owner1mobile=$business_owner1mobile;
				}else{
					$business_owner1mobile=0;
				}

                $business_owner1email                          = $this->input->post("add_business_owner1email"); 
                $business_owner2name                           = $this->input->post("add_business_owner2name");
                $business_owner2role                           = $this->input->post("add_business_owner2role");
                $business_owner2mobile                         = $this->input->post("add_business_owner2mobile");
				if(isset($business_owner2mobile) && !empty($business_owner2mobile)){
					$business_owner2mobile=$business_owner2mobile;
				}else{
					$business_owner2mobile=0;
				}
                $business_owner2email                          = $this->input->post("add_business_owner2email");


                $business_accountno       			           = $this->input->post("add_business_accountno");
				if(isset($business_accountno) && !empty($business_accountno)){
					$business_accountno=$business_accountno;
				}else{
					$business_accountno=0;
				}
                $business_acholdername       			       = $this->input->post("add_business_acholdername");
				if(isset($business_acholdername) && !empty($business_acholdername)){
					$business_acholdername=$business_acholdername;
				}else{
					$business_acholdername=null;
				}
				$business_bankname       				       = $this->input->post("add_business_bankname");
				if(isset($business_bankname) && !empty($business_bankname)){
					$business_bankname=$business_bankname;
				}else{
					$business_bankname=null;
				}
			    $business_ifsccode       			           = $this->input->post("add_business_ifsccode");
				if(isset($business_ifsccode) && !empty($business_ifsccode)){
					$business_ifsccode=$business_ifsccode;
				}else{
					$business_ifsccode=null;
				}
			    $business_bankcity       			           = $this->input->post("add_business_bankcity");
				if(isset($business_bankcity) && !empty($business_bankcity)){
					$business_bankcity=$business_bankcity;
				}else{
					$business_bankcity=null;
				}
			    $business_branchname       				       = $this->input->post("add_business_branchname");
				if(isset($business_branchname) && !empty($business_branchname)){
					$business_branchname=$business_branchname;
				}else{
					$business_branchname=null;
				}
                $business_acctype = $this->input->post("add_business_acctype");
			    
				if(isset($business_acctype) && !empty($business_acctype)){
					$business_acctype1=$business_acctype;
				}else{
					$business_acctype1=0;
				}
				
                $business_status= $this->input->post("add_business_status");
                $business_status_telemarketing= $this->input->post("add_business_status_telemarketing");

				if(isset($business_status) && !empty($business_status)){
					$business_status=$business_status;
				}else if(isset($business_status_telemarketing) && !empty($business_status_telemarketing)){
					  $business_status=$business_status_telemarketing;
				}else{
					  $business_status=0;
				}

				 // echo $business_status ;

                $business_feedback                          = $this->input->post("add_business_condition");

		        $business_campaign            = $this->input->post("add_newbusiness_campaign");
                $business_package             = $this->input->post("add_newbusiness_package");
                  
                $business_uppersale_amount    = $this->input->post("add_business_uppersale_amount");

		               if(isset($business_uppersale_amount) && !empty($business_uppersale_amount)){
							$business_uppersale_amount=$business_uppersale_amount;
						}else{
							$business_uppersale_amount=0;
						}
				$business_totaluppersale_amount    = $this->input->post("add_business_totaluppersale_amount");

		               if(isset($business_totaluppersale_amount) && !empty($business_totaluppersale_amount)){
							$business_totaluppersale_amount=$business_totaluppersale_amount;
						}else{
							$business_totaluppersale_amount=0;
						}	
                    

                  $packages_total   = $this->input->post("add_business_totalpackageamount");
						 if(isset($packages_total) && !empty($packages_total)){
							$packages_total=$packages_total;
						}else{
							$packages_total=0;
						}

                  $packages_discountamount    = $this->input->post("add_business_packages_discountamount");

					 if(isset($packages_discountamount) && !empty($packages_discountamount)){
						$packages_discountamount=$packages_discountamount;
					}else{
						$packages_discountamount=0;
					}
			       
			       $packages_promocode_id     = $this->input->post("add_business_packages_promocode_id");
					if(isset($packages_promocode_id) && !empty($packages_promocode_id)){
						$packages_promocode_id=$packages_promocode_id;
					}else{
						$packages_promocode_id=0;
					} 

                 $business_domainnames_option1   = $this->input->post("add_business_domainnames_option1");
                 $business_domainnames_option2   = $this->input->post("add_business_domainnames_option2");
                 $business_domainnames_option3   = $this->input->post("add_business_domainnames_option3");
                 $business_domain_names=$business_domainnames_option1.",".$business_domainnames_option2.",".$business_domainnames_option3;

			    $business_domainchecked   = $this->input->post("add_business_domainamount_checked");
				  if($business_domainchecked==1){
						$business_domain_amount=$this->input->post("add_business_domainamount");
					}else{
						$business_domain_amount=0;
					}		

				if($packages_discountamount==0){
					$packages_grandtotal = $packages_total;
				  }else{
                    $packages_grandtotal=$packages_total-$packages_discountamount;
				  }
                 
                 if($business_domain_amount==0){
					 $total = $packages_grandtotal;
				  }else{
                     $total=$packages_grandtotal+$business_domain_amount;
				  }
                   

			      $add_business_tds  = $this->input->post("add_business_tds");
					if($add_business_tds ==1){
			         $tds=$total*2/100;
			          } else{
					  $tds="0.00";
			         } 
					if($business_state ==32){
			         $cgst=$total*9/100;
			         $sgst=$total*9/100;
			         $grandtoatal=$total+$cgst+$sgst-$tds;
			         $igst="0.00";
			          } else if($business_state !=32){
					  $cgst="0.00";	
			          $igst=$total*18/100;
			          $grandtoatal=$total+$igst-$tds;
					  $sgst="0.00";
			         } 

     	             $grandtoatal=round($grandtoatal);

				    $business_payment_mode     = $this->input->post("add_newbusiness_payment_mode");
						if(isset($business_payment_mode) && !empty($business_payment_mode)){
							$business_payment_mode=$business_payment_mode;
						}else{
							$business_payment_mode=0;
						}


                      $upi      = $this->input->post("add_business_upi");
                      $phonepay  = $this->input->post("add_business_phonepay");
						 if(isset($phonepay) && !empty($phonepay)){
							$phonepay=$phonepay;
						}else{
							$phonepay=0;
						}
                     $amazonpay      			                  = $this->input->post("add_business_amazonpay");
					  if(isset($amazonpay) && !empty($amazonpay)){
						$amazonpay=$amazonpay;
					}else{
						$amazonpay=0;
					}
                     $googlepay      			                  = $this->input->post("add_business_googlepay");
					  if(isset($googlepay) && !empty($googlepay)){
						$googlepay=$googlepay;
					}else{
						$googlepay=0;
					}

					 $upiamount       				     = $this->input->post("add_business_upiamount");
					 if(empty($upiamount)){
                      	$upiamount                        = 0.00;
                        }else{
                      	  $upiamount                      = $upiamount;
                       }

                     $paytm_upi       			             = $this->input->post("add_business_paytm_upi");
                     $paytmamount       				     = $this->input->post("add_business_paytmamount");
                     if(empty($paytmamount)){
                      	$paytmamount                        = 0.00;
                        }else{
                      	  $paytmamount                      = $paytmamount;
                       }


                     $cashamount       				     = $this->input->post("add_business_cashamount");
					 if(empty($cashamount)){
                      	$cashamount                        = 0.00;
                        }else{
                      	  $cashamount                      = $cashamount;
                       }
				     $cashdate       				     = $this->input->post("add_business_cashdate");
				     if(empty($cashdate)){
                      	$cashdate                        = null;
                        }else{
                      	  $cashdate                      = date("Y-m-d", strtotime($cashdate) );
                       } 
			         
			         $personame  = $this->input->post("add_business_personame");
			         $placename  = $this->input->post("add_business_placename");
			         $neftnumber = $this->input->post("add_business_neftnumber");
				     $chequeno   = $this->input->post("add_business_chequeno");
						  if(isset($chequeno) && !empty($chequeno)){
							$chequeno=$chequeno;
						}else{
							$chequeno=0;
						} 
					  $chequeamount  = $this->input->post("add_business_chequeamount");
						 if(empty($chequeamount)){
	                      	$chequeamount                        = 0.00;
	                        }else{
	                      	  $chequeamount                      = $chequeamount;
	                       }

				     $chequeaccountno   = $this->input->post("add_business_chequeaccountno");
						 if(isset($chequeaccountno) && !empty($chequeaccountno)){
							$chequeaccountno=$chequeaccountno;
						}else{
							$chequeaccountno=0;
						}
				     $chequeholdername    = $this->input->post("add_business_chequeholdername");
				     $chequeissuedate     = $this->input->post("add_business_chequeissuedate");
					     if(empty($chequeissuedate)){
	                      	$chequeissuedate = null;
	                        }else{
	                      	  $chequeissuedate = date("Y-m-d", strtotime($chequeissuedate) );
	                       } 
			         $cheque_bankname     = $this->input->post("add_business_cheque_bankname");
                     $cheque_ifsc         = $this->input->post("add_business_cheque_ifsc");
                     $cheque_micr         = $this->input->post("add_business_cheque_micr");
						  if(isset($cheque_micr) && !empty($cheque_micr)){
							$cheque_micr=$cheque_micr;
						}else{
							$cheque_micr=0;
						}

					 $neftamount   = $this->input->post("add_business_neftamount");
					 if(empty($neftamount)){
                      	$neftamount = 0.00;
                        }else{
                      	  $neftamount  = $neftamount;
                       }
                    
                   $business_otp   = $this->input->post("add_business_otp");
					 if(empty($business_otp)){
                      	$business_otp = 0;
                        }else{
                      	  $business_otp  = $business_otp;
                       }



       $sourcePath2= isset($_FILES['add_business_cheque_photo']['tmp_name'])?$_FILES['add_business_cheque_photo']['tmp_name']:'';
                
			if(!empty($sourcePath2))
			{
				
				$target_dir = "assets/uploads/cheques/";
				$target_file = $target_dir .basename($_FILES["add_business_cheque_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_business_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_business_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                 
                $temp=rand(0,100000).'_';  
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_business_cheque_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath2,$targetPath)){

				$imagepath ="assets/uploads/cheques/";
				$cheque_image=$imagepath.$temp.$_FILES['add_business_cheque_photo']['name'];

				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$cheque_image=null;
				
				
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
                     $razorpayorder_id  = $this->input->post("razorpay_payment_order_id");
                }
                
			 $sourcePath1= isset($_FILES['add_business_photo']['tmp_name'])?$_FILES['add_business_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/business/";
				$target_file = $target_dir.basename($_FILES["add_business_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_business_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_business_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JIG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                 
                $temp=rand(0,100000).'_';  
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_business_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){
					$imagepath ="assets/uploads/business/";
					$image=$imagepath.$temp.$_FILES['add_business_photo']['name'];
				 }else{
					echo json_encode(array('success'=>false,'message'=>"companyphota"));
					return;
				  }
				
			 }else{
				$imagepath =null;
				$image=null;
				
			}
		
          $sourcePath3= isset($_FILES['add_business_visitingcardphoto']['tmp_name'])?$_FILES['add_business_visitingcardphoto']['tmp_name']:'';
                
			if(!empty($sourcePath3))
			{
				
				$target_dir = "assets/uploads/business/";
				$target_file = $target_dir .basename($_FILES["add_business_visitingcardphoto"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_business_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_business_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "JIG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                 
                $temp=rand(0,100000).'_';  
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_business_visitingcardphoto']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath3,$targetPath)){

				$imagepath ="assets/uploads/business/";
				$visitingcard_image=$imagepath.$temp.$_FILES['add_business_visitingcardphoto']['name'];

				} else{
					echo json_encode(array('success'=>false,'message'=>"viisiting card"));
					return;
				}
			   }else{
				$visitingcard_image=null;
			   }


		$citysname=Cities_model::where('cities.cityid','=',$business_city)->get();
           json_encode(array('data'=>$citysname)); 
		$short_name= $citysname[0]['short_code']; 

		$perviousid=Business_model::orderBy('id','desc')->first();
        $number = $perviousid['business_id'];
        $a=explode("-",$number);
        $number=$a[1];
        $number++;
        $id_number=str_pad($number, 4,"0", STR_PAD_LEFT);     
        $company_id = $short_name.'-'.$id_number;
   
           $postData=array();
		   $userId = $this->ion_auth->get_user_id();

        $perviousid=BusinessPayments_model::orderBy('id','desc')->first();
        $pervious_business_package_id = $perviousid['business_package_id'];
        if($pervious_business_package_id){
        	$pervious_business_package_id=$pervious_business_package_id;
        }else{
        	$pervious_business_package_id=0;
        }
        
       $pervious_business_package_id++;
       $business_package_id=str_pad($pervious_business_package_id, 1, "0", STR_PAD_LEFT);  
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

                     $add_business_demolink = $this->input->post("add_business_demolink");
				     $add_business_demolink =implode(" ",$add_business_demolink);
        
				      if(isset($business_package) && !empty($business_package))
				        {
				              $package=[];
						    foreach($business_package as $key=>$udata)
						    {
							      $package_id  = $udata;
							      $postData = dataFieldValidation($package_id, "Package", $package,"package_id", "", $postData, "packagearray".$key);
						        }
				        }

	           
           $postData=array();
		   $packagesdata = [];
         
          $postData = dataFieldValidation($business_domain_amount, "Domain Amount",$packagesdata,"domain_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($business_domain_names, "Domain Names",$packagesdata,"domain_names","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($business_uppersale_amount, "Upper Sale Amount",$packagesdata,"uppersale_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($business_totaluppersale_amount, "Upper Sale Amount",$packagesdata,"totaluppersale_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_total, "Total Amount",$packagesdata,"total_amount","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($packages_discountamount, "Distocunt",$packagesdata,"discount_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_grandtotal, "Grand Total",$packagesdata,"grand_total_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($igst, "IGST Amount",$packagesdata,"igst_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($cgst, "CSGT Amount",$packagesdata,"cgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($sgst, "SGST Amount",$packagesdata,"sgst_amount","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($tds, "TDS Amount",$packagesdata,"tds_amount","", $postData,"packagesdataarray");
          
          $postData = dataFieldValidation($grandtoatal, "Grand Total",$packagesdata,"gstgrand_total_amount","", $postData,"packagesdataarray");


          $postData = dataFieldValidation($packages_promocode_id, "Promo Code",$packagesdata,"promocode_id","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($business_package_id, "Selected Id",$packagesdata,"business_package_id","", $postData,"packagesdataarray");

         

          $postData = dataFieldValidation($business_accountno, "Account Number",$packagesdata,"account_number","",$postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_acholdername, "Account holder Name",$packagesdata,"account_holder_name","", $postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_bankname, "Bank Name ",$packagesdata,"bank_name","", $postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_ifsccode, "IFSC code",$packagesdata,"ifsc_code","", $postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_bankcity, "Bank City",$packagesdata,"bank_city","", $postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_branchname, "Branch Name",$packagesdata,"branch_name","",$postData,"packagesdataarray");
	     $postData = dataFieldValidation($business_acctype1, "Account Type",$packagesdata,"account_type","",$postData,"packagesdataarray");
	      	   	 
           
           $businessdata = [];

         
         $postData = dataFieldValidation($company_id, "Bussnes Id",$businessdata,"business_id","",$postData,"businessdataarray");
         $postData = dataFieldValidation($business_cname, "Company Name",$businessdata,"company_name","",$postData,"businessdataarray");
          $postData = dataFieldValidation($business_category_name, "Category Name",$businessdata,"business_category_name","",$postData,"businessdataarray");
         
         $postData = dataFieldValidation($business_pname, "Person Name",$businessdata,"person_name","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_designation, "Person Name",$businessdata,"person_designation","", $postData,"businessdataarray");

         
         $postData = dataFieldValidation($business_landlineno, "LandLine Number",$businessdata,"landline_no","", $postData,"businessdataarray");

         $postData = dataFieldValidation($business_mobileno, "Mobile No",$businessdata,"mobile_no","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_altnemobileno, "Mobile No",$businessdata,"alt_mobile_no","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_email, "Email",$businessdata,"email","",$postData,"businessdataarray");
         $postData = dataFieldValidation($image, "Photo",$businessdata,"photo","", $postData,"businessdataarray");
        
         $postData = dataFieldValidation($visitingcard_image, "Visiting Card Photo",$businessdata,"visitingcard_photo","", $postData,"businessdataarray");
     
	     $postData = dataFieldValidation($business_gstcname, "GST Company Name",$businessdata,"gst_company_name","",$postData,"businessdataarray");
	     $postData = dataFieldValidation($business_gstno, "GST Number",$businessdata,"gst_number","", $postData,"businessdataarray");
	     $postData = dataFieldValidation($business_gststate, "GST State",$businessdata,"gst_state","", $postData,"businessdataarray");
	     $postData = dataFieldValidation($business_gstpincode, "GST Pincode ",$businessdata,"gst_pincode","", $postData,"businessdataarray");
	     $postData = dataFieldValidation($business_gstpanno, "PAN Crad No",$businessdata,"gst_pan_no","", $postData,"businessdataarray");
	     $postData = dataFieldValidation($business_gstaddress, "GST Address",$businessdata,"gst_address","",$postData,"businessdataarray");

	     $postData = dataFieldValidation($business_website, "Website",$businessdata,"website_url","",$postData,"businessdataarray");
         $postData = dataFieldValidation($business_facebook, "FaceBook",$businessdata,"facebook_url","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_twitter, "Twitter",$businessdata,"twitter_url","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_youtube, "Youtube",$businessdata,"youtube_url","", $postData,"businessdataarray");
         $postData = dataFieldValidation($business_linkedin, "Linkedin",$businessdata,"linkedin_url","", $postData,"businessdataarray");
         $postData  =dataFieldValidation($business_instagram,"Instagram",$businessdata,"instagram_url","",$postData,"businessdataarray");

	     $postData = dataFieldValidation($business_status, "Status",$businessdata,"business_status_id","", $postData,"businessdataarray");

	     $business_is_senddemolink=2;
	      $postData = dataFieldValidation($business_is_senddemolink, "Is Demo Link",$businessdata,"is_senddemolink","", $postData,"businessdataarray");
         
          $businessadressdata = [];

         $postData = dataFieldValidation($business_hno, "Bulidding Numnber",$businessadressdata,"house_no","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_street, "Street",$businessadressdata,"street","", $postData,"businessAddressarray");
        
         $postData = dataFieldValidation($business_subarea, "Sub Area",$businessadressdata,"sub_area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_area, "Area",$businessadressdata,"area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_landmark, "LandMark",$businessadressdata,"landmark","", $postData,"businessAddressarray");

         $postData = dataFieldValidation($business_city, "City",$businessadressdata,"city_id","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_state, "State",$businessadressdata,"state_id","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_pincode, "Pincode",$businessadressdata,"pincode","", $postData,"businessAddressarray");
        
        
         $postData = dataFieldValidation($business_currentlat, "Latitude",$businessadressdata,"latitude","",$postData,"businessAddressarray");
         $postData = dataFieldValidation($business_currentlag, "Longitude",$businessadressdata,"longitude","", $postData,"businessAddressarray");
        
         $businessowner=[];

         $postData = dataFieldValidation($business_owner1name, "Owner Name",$businessowner,"owner_name","",$postData,"businessownersarray");
         $postData = dataFieldValidation($business_owner1role, "Role",$businessowner,"owner_role","", $postData,"businessownersarray");
         $postData = dataFieldValidation($business_owner1mobile, "Mobile",$businessowner,"owner_mobile","", $postData,"businessownersarray");
         $postData = dataFieldValidation($business_owner1email, "Email",$businessowner,"owner_email","", $postData,"businessownersarray");
       
         $businessowner2=[];

         $postData = dataFieldValidation($business_owner2name, "Owner Name",$businessowner2,"owner_name","",$postData,"businessownersarray2");
         $postData = dataFieldValidation($business_owner2role, "Role",$businessowner2,"owner_role","", $postData,"businessownersarray2");
         $postData = dataFieldValidation($business_owner2mobile, "Mobile",$businessowner2,"owner_mobile","", $postData,"businessownersarray2");
         $postData = dataFieldValidation($business_owner2email, "Email",$businessowner2,"owner_email","", $postData,"businessownersarray2");
       
      //    $businessemp=[];

	     // $postData = dataFieldValidation($business_empname, "Employee Name",$businessemp,"emp_name","",$postData,"businessemparray");
	     // $postData = dataFieldValidation($business_emprole, "Role",$businessemp,"emp_role","", $postData,"businessemparray");
	     // $postData = dataFieldValidation($business_empmobile, "Twitter",$businessemp,"emp_mobile","", $postData,"businessemparray");
	     // $postData = dataFieldValidation($business_empemail, "Youtube",$businessemp,"emp_email","", $postData,"businessemparray");

		

         $paymenttransactiondata = []; 

         $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($business_otp, "OTP",$paymenttransactiondata,"otp_no","", $postData,"paymenttransactionarray");
         
         $postData = dataFieldValidation($debitcardno, "Debit Card Number",$paymenttransactiondata,"debitcard_number","", $postData,"paymenttransactionarray"); 

          $postData = dataFieldValidation($business_payment_mode, "Business Payment Mode",$paymenttransactiondata,"payment_mode_id","", $postData,"paymenttransactionarray");
			         
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


		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}


        $createdlog=isCreatedLog($userId);

        $addressarray = array_merge($postData['dbinput']['businessAddressarray'],$createdlog); 
        
        $addressid = $this->Address_model->addAddress($addressarray);
       
        $business = array_merge($postData['dbinput']['businessdataarray'],array('address_id'=>$addressid),$createdlog);
        $addBusinessid=$this->Business_model->addBusiness($business);
        
        $businessowner1 = array_merge($postData['dbinput']['businessownersarray'],array('business_id'=>$addBusinessid));
        $addowner1=$this->BusinessOwner_model->addBusinessowner($businessowner1);
       
        $businessowner2 = array_merge($postData['dbinput']['businessownersarray2'],array('business_id'=>$addBusinessid));
        $addowner2=$this->BusinessOwner_model->addBusinessowner($businessowner2);

         if($packages_grandtotal>0){

        if(isset($business_campaign) && !empty($business_campaign))
                  {
					    foreach($business_campaign as $key=>$udata)
					    {
					        $campaign_id  = $udata;
					        $campaignArray=array('business_id'=>$addBusinessid,'campaign_id'=>$campaign_id,'business_package_id'=>$business_package_id);
					        $Campaigns=$this->BusinessCampaign_model->addBCampaign($campaignArray);
					    }

                 }

         if(isset($business_package) && !empty($business_package))
                  {
					    foreach($business_package as $key=>$udata)
					    {
					        $package_id  = $udata;
					        $packagearray=array('business_id'=>$addBusinessid,'package_id'=>$package_id,'business_package_id'=>$business_package_id);
					        $Packages=$this->BusinessPackage_model->addBPackage($packagearray);
					    }

                 }

               $packagesdataarray = array_merge($postData['dbinput']['packagesdataarray'],array('business_id'=>$addBusinessid),$createdlog);

        	  $addPackagesid=$this->BusinessPayments_model->AddPayments($packagesdataarray); 

        	  $userId = $this->ion_auth->get_user_id();
              $updatedlog=isUpdateLog($userId);
              if(strlen($razorpayorder_id)>0){

	              $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid,'payment_mode_id'=>$business_payment_mode,'payment_mode_id'=>$business_payment_mode,'otp_no'=>$business_otp),$updatedlog);
	        	   $Packagesupdate=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
	        	   $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($razorpayorder_id);
	        	   $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
	        	   $transaction_status= $getTransactionOrderId[0]->transaction_status;
        	  }
        	else{

				 $userId = $this->ion_auth->get_user_id();
		         $createdlog=isCreatedLog($userId);
		         $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid),$postData['dbinput']['paymenttransactionarray'],$createdlog);
		         $Packagesupdate=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 
		         $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($order_id); 
		         $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
		         $transaction_status= $getTransactionOrderId[0]->transaction_status;

        	}

            }
     
            if($addBusinessid){
		         
		        $id                                  = $addBusinessid;
		        $subject='Feedback';
				$url = getHostURL(true).'feedback?id='.$addBusinessid;
				$name=$business_cname;
		        $hiuser = ucfirst($name);
				$body=Customdata_model::where('content_type','=','Feedback')->first()->content;
				$body=str_replace("{CompanyName}",$hiuser,$body);
				$body=str_replace("{URL}",$url,$body);

		        sendEmail($business_email,$subject,$body,null);

		        $subject1='Sample Websites';
				$url1 = getHostURL(true).'websites';
				$name=$business_cname;
		        $hiuser = ucfirst($name);
				$body1=Customdata_model::where('content_type','=','Sample Websites')->first()->content;
				$body1=str_replace("{CompanyName}",$hiuser,$body1);
				$body1=str_replace("{URL}",$url1,$body1);

		        sendEmail($business_email, $subject1,$body1,null); 
                
                 if($business_status==12){
			       $id = $addPackagesid;
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
					$receiptbody1=str_replace("{URL}",$url1,$receiptbody1);
					$attachments='assets/downloads/'.$filename; 
		            
		            $x=sendEmail($business_email,$receiptsubject1,$receiptbody1,$attachments);
		        
		        }

		      if($transaction_amount>=$grandtoatal && $transaction_status=='SUCCESS'){ 

		      	 $userId = $this->ion_auth->get_user_id();
		         $updatedlog=isUpdateLog($userId);
		         $status=4;
		         $statusupdatefordealclose = array_merge(array('business_status_id'=>$status),$updatedlog);
		         $statusupdate=$this->Business_model->updateBusiness($statusupdatefordealclose,$addBusinessid);
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

            
                $subject1='Demo Website && Sepcial Offer';
            	$buynow_url = getHostURL(true).'sendlinkbuynow?id='.$addBusinessid;
				$demolink_url = $url1;
				$name=$business_pname;
		        $hiuser = ucfirst($name);
				$body1=Customdata_model::where('content_type','=','SendDemoLink')->first()->content;
				$body1=str_replace("{CompanyName}",$hiuser,$body1);
				$body1=str_replace("{URL}",$demolink_url,$body1);
				$body1=str_replace("{BUYNOWURL}",$buynow_url,$body1);
		        $sendresult=sendEmail($business_email,$subject1,$body1,null);
                $websitelink = getHostURL(true).'websites';
                 if($business_status==15){
                 	 $body2="Hi, ".$name.", Greetings From Bizbrainz Technologies Private Limited. Click on the link below to view our sample website for Your Kind Reference. ".$demolink_url." We are providing life time website at Rs.15000 for first 100 Customers only. ".$buynow_url." For Any Queries Call Us - 8196 98 98 98.";
                 }else{
                 	 $body2="Hi, ".$name.", Greetings From Bizbrainz Technologies Private Limited. Click on the link below to view our sample website for Your Kind Reference. ".$demolink_url." We are providing life time website at Rs.15000 for first 100 Customers only. ".$buynow_url." For Any Queries Call Us - 8196 98 98 98.";
                 }
		        
		        $dataurl="https://api.whatsapp.com/send?phone=+91".$business_mobileno."&text=".$body2." ";
		          // die();
		  	    echo json_encode(array('success'=>true,'message'=>SAVE_MSG, 'data'=>$dataurl));
					 return;
			}else{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			  }	


            }

    public function updateBusinessData(){

                $address_id= $this->input->post("edit_business_addid");
                $business_id = $this->input->post("edit_business_id");
                $business_cname = $this->input->post("edit_business_cname");
				$business_hno = $this->input->post("edit_business_hno");
			    $business_street = $this->input->post("edit_business_street");
			    $business_subarea = $this->input->post("edit_business_subarea");
			    $business_area = $this->input->post("edit_business_area");
                $business_landmark = $this->input->post("edit_business_landmark");
                $business_city = $this->input->post("edit_business_city");
			    $business_state  = $this->input->post("edit_business_state");
			    $business_pincode = $this->input->post("edit_business_pincode");
			   
			    if(isset($business_pincode) && !empty($business_pincode)){
					$business_pincode=$business_pincode;
				}else{
					$business_pincode=0;
				}
			 
               
			    $business_pname                            = $this->input->post("edit_business_pname");
			    $business_designation                            = $this->input->post("edit_business_designation");
				$business_landlineno                       = $this->input->post("edit_business_landlineno");
			    $business_mobileno       			       = $this->input->post("edit_business_mobileno");
			    $business_altnemobileno       		       = $this->input->post("edit_business_altnemobileno");
			    $business_email       				       = $this->input->post("edit_business_email");
                
                // $business_currentlat       			   = $this->input->post("edit_business_currentlat");
                // $business_currentlag       			   = $this->input->post("edit_business_currentlag");

                $business_gstcname       			       = $this->input->post("edit_business_gstcname");
                $business_gstno       			           = $this->input->post("edit_business_gstno");
				$business_gststate       				   = $this->input->post("edit_business_gststate");
				if(isset($business_gststate) && !empty($business_gststate)){
					$business_gststate=$business_gststate;
				}else{
					$business_gststate=0;
				}
			    $business_gstpincode       			       = $this->input->post("edit_business_gstpincode");
			    if(isset($business_gstpincode) && !empty($business_gstpincode)){
					$business_gstpincode=$business_gstpincode;
				}else{
					$business_gstpincode=0;
				}
			    $business_gstpanno       			       = $this->input->post("edit_business_gstpanno");
			    if(isset($business_gstpanno) && !empty($business_gstpanno)){
					$business_gstpanno=$business_gstpanno;
				}else{
					$business_gstpanno=null;
				}
			    $business_gstaddress       				   = $this->input->post("edit_business_gstaddress");

			 //    $business_status       	       		   = $this->input->post("edit_business_status");
			 //    if(isset($business_status) && !empty($business_status)){
				// 	$business_status=$business_status;
				// }else{
				// 	$business_status=null;
				// }

                $business_website                         = $this->input->post("edit_business_website");
                $business_facebook                        = $this->input->post("edit_business_facebook");
                $business_twitter                         = $this->input->post("edit_business_twitter");
                $business_youtube                         = $this->input->post("edit_business_youtube");
                $business_linkedin                        = $this->input->post("edit_business_linkedin");
                $business_instagram                       = $this->input->post("edit_business_instagram");


                $business_owner1name                           = $this->input->post("edit_business_owner1name");
                $business_owner1role                           = $this->input->post("edit_business_owner1role");
                $business_owner1mobile                         = $this->input->post("edit_business_owner1mobile");
                if(isset($business_owner1mobile) && !empty($business_owner1mobile)){
					$business_owner1mobile=$business_owner1mobile;
				}else{
					$business_owner1mobile=0;
				}
                $business_owner1email                          = $this->input->post("edit_business_owner1email"); 

               
                $business_owner2name                           = $this->input->post("edit_business_owner2name");
                $business_owner2role                           = $this->input->post("edit_business_owner2role");
                $business_owner2mobile                         = $this->input->post("edit_business_owner2mobile");

                if(isset($business_owner2mobile) && !empty($business_owner2mobile)){
					$business_owner2mobile=$business_owner2mobile;
				}else{
					$business_owner2mobile=0;
				}

                $business_owner2email                          = $this->input->post("edit_business_owner2email");

               
				
      $oldimage =  Business_model::where('id',$business_id)->get(['photo']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['photo'];

			 $sourcePath1= isset($_FILES['edit_business_photo']['tmp_name'])?$_FILES['edit_business_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/business/";
				$target_file = $target_dir .basename($_FILES["edit_business_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			   $fileinfo = @getimagesize($_FILES["edit_business_photo"]["tmp_name"]);
               $width = $fileinfo[0];
               $height = $fileinfo[1];

				$check = $_FILES["edit_business_photo"]["size"];
				 if($width =! "1200" || $height =! "400"){
					echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
					return;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_business_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/business/";
				$image=$imagepath.$temp.$_FILES['edit_business_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image=$oldimage1;
				
				
			}
				
           $postData=array();
           $businessadressdata = [];
		   $businessdata = [];
         
           
          $postData = dataFieldValidation($business_cname, "Company Name",$businessdata,"company_name","",$postData,"businessdataarray");
          $postData = dataFieldValidation($business_pname, "Person Name",$businessdata,"person_name","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_designation, "Person Name",$businessdata,"person_designation","", $postData,"businessdataarray");

         $postData = dataFieldValidation($business_landlineno, "LandLine Number",$businessdata,"landline_no","", $postData,"businessdataarray");

          $postData = dataFieldValidation($business_mobileno, "Mobile No",$businessdata,"mobile_no","", $postData,"businessdataarray");
          $postData = dataFieldValidation($business_altnemobileno, "Mobile No",$businessdata,"alt_mobile_no","", $postData,"businessdataarray");
          
          $postData = dataFieldValidation($business_email, "Email",$businessdata,"email","",$postData,"businessdataarray");
         $postData = dataFieldValidation($image, "Photo",$businessdata,"photo","", $postData,"businessdataarray");

          $postData = dataFieldValidation($business_gstcname, "GST Company Name",$businessdata,"gst_company_name","",$postData,"businessdataarray");
	    $postData = dataFieldValidation($business_gstno, "GST Number",$businessdata,"gst_number","", $postData,"businessdataarray");
	    $postData = dataFieldValidation($business_gststate, "GST State",$businessdata,"gst_state","", $postData,"businessdataarray");
	    $postData = dataFieldValidation($business_gstpincode, "GST Pincode ",$businessdata,"gst_pincode","", $postData,"businessdataarray");
	    $postData = dataFieldValidation($business_gstpanno, "PAN Crad No",$businessdata,"gst_pan_no","", $postData,"businessdataarray");
	    $postData = dataFieldValidation($business_gstaddress, "GST Address",$businessdata,"gst_address","",$postData,"businessdataarray");

    
    // $postData = dataFieldValidation($business_status, "Status",$businessdata,"business_status_id","", $postData,"businessdataarray");
   
        $postData = dataFieldValidation($business_website, "Website",$businessdata,"website_url","",$postData,"businessdataarray");
        $postData = dataFieldValidation($business_facebook, "FaceBook",$businessdata,"facebook_url","", $postData,"businessdataarray");
        $postData = dataFieldValidation($business_twitter, "Twitter",$businessdata,"twitter_url","", $postData,"businessdataarray");
        $postData = dataFieldValidation($business_youtube, "Youtube",$businessdata,"youtube_url","", $postData,"businessdataarray");
        $postData = dataFieldValidation($business_linkedin, "Linkedin",$businessdata,"linkedin_url","", $postData,"businessdataarray");
        $postData  =dataFieldValidation($business_instagram,"Instagram",$businessdata,"instagram_url","",$postData,"businessdataarray");

      $postData = dataFieldValidation($business_hno, "Building Number",$businessadressdata,"house_no","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_street, "Street",$businessadressdata,"street","", $postData,"businessAddressarray");
        
         $postData = dataFieldValidation($business_subarea, "Sub Area",$businessadressdata,"sub_area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_area, "Area",$businessadressdata,"area","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_landmark, "LandMark",$businessadressdata,"landmark","", $postData,"businessAddressarray");

         $postData = dataFieldValidation($business_city, "City",$businessadressdata,"city_id","", $postData,"businessAddressarray");
         $postData = dataFieldValidation($business_state, "State",$businessadressdata,"state_id","",$postData,"businessAddressarray");
         $postData = dataFieldValidation($business_pincode, "Pincode",$businessadressdata,"pincode","", $postData,"businessAddressarray");
         

        $businessowner=[];

        $postData = dataFieldValidation($business_owner1name, "Owner Name",$businessowner,"owner_name","",$postData,"businessownersarray");
        $postData = dataFieldValidation($business_owner1role, "Role",$businessowner,"owner_role","", $postData,"businessownersarray");
        $postData = dataFieldValidation($business_owner1mobile, "Mobile",$businessowner,"owner_mobile","", $postData,"businessownersarray");
        $postData = dataFieldValidation($business_owner1email, "Email",$businessowner,"owner_email","", $postData,"businessownersarray");
       
       $businessowner2=[];

       $postData = dataFieldValidation($business_owner2name, "Owner Name",$businessowner2,"owner_name","",$postData,"businessownersarray2");
        $postData = dataFieldValidation($business_owner2role, "Role",$businessowner2,"owner_role","", $postData,"businessownersarray2");
        $postData = dataFieldValidation($business_owner2mobile, "Mobile",$businessowner2,"owner_mobile","", $postData,"businessownersarray2");
        $postData = dataFieldValidation($business_owner2email, "Email",$businessowner2,"owner_email","", $postData,"businessownersarray2");
   
         // $postData = dataFieldValidation($business_currentlat, "Latitude",$businessadressdata,"latitude","",$postData,"businessAddressarray");
         // $postData = dataFieldValidation($business_currentlag, "Longitude",$businessadressdata,"longitude","", $postData,"businessAddressarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
      
        $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $businessdataarray = array_merge($postData['dbinput']['businessdataarray'],$updatedlog);
        $businessAddressarray = array_merge($postData['dbinput']['businessAddressarray'],$updatedlog);

         $addressid = $this->Address_model->updateAddress($businessAddressarray,$address_id);
         $Businessupdate=$this->Business_model->updateBusiness($businessdataarray,$business_id);
		

          $deleteowner1=$this->BusinessOwner_model->deleteBusinessowner($business_id);
                
                   if($deleteowner1>0){

		                  $businessowner1 = array_merge($postData['dbinput']['businessownersarray'],array('business_id'=>$business_id));
                          $addowner1=$this->BusinessOwner_model->addBusinessowner($businessowner1);
                            $businessowner2 = array_merge($postData['dbinput']['businessownersarray2'],array('business_id'=>$business_id));
                           $addowner2=$this->BusinessOwner_model->addBusinessowner($businessowner2);

			         }else{

                          $businessowner1 = array_merge($postData['dbinput']['businessownersarray'],array('business_id'=>$business_id));
                          $addowner1=$this->BusinessOwner_model->addBusinessowner($businessowner1);
                            $businessowner2 = array_merge($postData['dbinput']['businessownersarray2'],array('business_id'=>$business_id));
                          $addowner2=$this->BusinessOwner_model->addBusinessowner($businessowner2);

			        }

		     

            if( $Businessupdate || $BusinessPaymetupdate || $addressid || $businessowner1|| $businessowner2){
               	echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }        


public function deleteBusinessById($id){


		       if(isset($id)&&$id>0){
		       $getid =  Business_model::where('id',$id)->get(['address_id']);//fetching from database table
		       $deleteresult = $this->Business_model->deleteBusiness($id);
               $deleteAddress=$this->Address_model->deleteAddress($getid[0]['address_id']);
					      echo json_encode(array('success'=>true,'message'=>DELTE_MSG,'data'=>$deleteresult));
					      return;
			   }else{
			               echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
					}

		}


public function getCityByIdForMarketing($city_id){
			
			if(isset($city_id)&&$city_id>0){
				if($city_id != $this->city_id){
					
					$cityid_prev=$this->session->userdata('city_id');
					                   
				    session_start();
					$cityid=$this->session->set_userdata('city_id', $city_id);
					session_write_close();
					//print_r($this->session->all_userdata());
					$userid=$this->ion_auth->get_user_id();
					$this->Userdetails_model->updateUserDetails(array('city_id'=>$city_id),$userid);
				}
					 echo json_encode(array('success'=>true,'url'=>base_url().'Marketing'));
			  		 return;
			}else{
				  echo json_encode(array('success'=>false,'message'=>NOT_AVAILABLE_DATA));
						return;
			}

		}



 public function SearchBusinessList()
		{
          
           $business_cname        = $this->input->post("search_business_cname"); 
           $business_city         = $this->input->post("search_business_city"); 
           $search_business_fromdate  = $this->input->post("search_business_fromdate"); 
           $business_createdby        = $this->input->post("search_business_createdby"); 
           $business_status         = $this->input->post("search_business_status"); 
       
           
           if($search_business_fromdate ) {
               $business_fromdate  = date("Y-m-d", strtotime($search_business_fromdate) );
           }else{
           	 $business_fromdate=" " ;
           }

           $search_business_todate          = $this->input->post("search_business_todate");
           if($search_business_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_business_todate) );
           }else{
           	 $business_todate=" " ;
           }
          
         $userrole=$this->session->userdata('user_roles');
           if($userrole=="Marketing"){
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
           }else if($userrole=="Marketing-Lead"){ 

               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();

           }else if($userrole=="Tele-Marketing"){ 
               $city_id="";
               $userid=$this->ion_auth->get_user_id();
               
           }else{
               $city_id="";
               $userid="";
          }      

          $searchdata=$this->Business_model->SearchBusiness($business_todate,$business_fromdate,$business_cname,$business_city,$city_id,$userid,$business_createdby,$business_status);
           	echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
				return;
	   
		}



    
	


	public function orderRazorPayGeneration(){
		//print_r($_POST);die();
		$currency_code = $this->config->item('DISPLAY_CURRENCY');
		$amount = round($this->input->post('merchant_total'),0);
		$key_id = $this->config->item('RAZOR_KEY_ID');
		$key_secret = $this->config->item('RAZOR_KEY_SECRET');
		$merchant_order_id = $this->input->post('merchant_order_id');
		$api = new Api($key_id, $key_secret);
		//session_start();
		try
		{
			$razorpayOrder  = $api->order->create(array(
				'receipt' => $merchant_order_id,
				'amount' => $amount,
				'payment_capture' => 1,
				'currency' => $currency_code
				)
			  );
			
			$razorpayOrderId = $razorpayOrder['id'];
			//$_SESSION['razorpay_order_id'] = $razorpayOrderId;
			echo json_encode(array('success'=>true,'message'=>$razorpayOrderId));
			return;
		}
		catch(SignatureVerificationError $e)
		{
			$error = 'Razorpay Order Error : ' . $e->getMessage();
			echo json_encode(array('success'=>false,'message'=>$e->getMessage()));
			return;
		}
		
	}
	
	// callback method
	public function callback(){
	
		if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
			$razorpay_payment_id = $this->input->post('razorpay_payment_id');
			$razorpay_signature = $this->input->post('razorpay_signature');
            $merchant_order_id = $this->input->post('merchant_order_id');
			$razorpay_order_id = $this->input->post('razorpay_order_id');
            $currency_code = $this->config->item('DISPLAY_CURRENCY');
            $amount = $this->input->post('merchant_total');
			$key_id = $this->config->item('RAZOR_KEY_ID');
			$key_secret = $this->config->item('RAZOR_KEY_SECRET');
			$api = new Api($key_id, $key_secret);
			$error='Transaction Failed';
			$success=true;
			/*$payment = $api->payment->fetch($this->input->post('razorpay_payment_id'));
			$paymentResult=$payment->capture(array('amount' => $amount));
			
			// echo '<pre>';print_r($paymentResult);
			$status=$paymentResult->status;
			$pay_order_id=$paymentResult->description;
			$payment_amount=$paymentResult->amount;
			$email=$paymentResult->email;
			$contact=$paymentResult->contact;
			$card=isset($paymentResult->card)? $paymentResult->card:null;
			if(isset($card)&&count($card)>0){
				$id=$paymentResult->card->id;
				$last4=$paymentResult->card->last4;
				$network=$paymentResult->card->network;
				$type=$paymentResult->card->type;
				$name=$paymentResult->card->name;
			}*/
			
			try
			{
				// Please note that the razorpay order ID must
				// come from a trusted source (session here, but
				// could be database or something else)
				$attributes = array(
					'razorpay_order_id' => $razorpay_order_id,
					'razorpay_payment_id' => $razorpay_payment_id,
					'razorpay_signature' =>$razorpay_signature
				);
		
				$api->utility->verifyPaymentSignature($attributes);
			}
			catch(SignatureVerificationError $e)
			{
				$success = false;
				$error = 'Razorpay Error : ' . $e->getMessage();
			}
			$Array=array('amount'=>$amount,'description'=>$merchant_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature,'razorpay_order_id'=>$razorpay_order_id);
			if ($success === true)
			{
				$this->success($Array);	
			}
			else
			{
				$this->failed($Array);
			}
			
		}else{
			echo 'An error occured. Contact site administrator, please!';
		}
	} 
    public function success($successArray) {
        $data['title'] = 'Payment Transaction Successfully';
		$data['message'] ='Thanks for the Payment.';
		//$data['status']=$successArray['status'];
		$data['amount']=$successArray['amount'];
		//$data['email']=$successArray['email'];
		//$data['contact']=$successArray['contact'];
		$data['pay_order_id']=$successArray['description'];
		$data['razorpay_payment_id']=$successArray['razorpay_payment_id'];
		$data['razorpay_signature']=$successArray['razorpay_signature'];
		$data['razorpay_order_id']=$successArray['razorpay_order_id'];
		 //$status=$successArray['status'];
	     $amount=$successArray['amount']/100;
	     $status='SUCCESS';
    
           $postData=array();
          $paymenttransactiondata = [];
        
         $postData = dataFieldValidation($data['pay_order_id'], "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_payment_id'], "Payment ID",$paymenttransactiondata,"razorpay_payment_id","", $postData,"paymenttransactionarray");
		  $postData = dataFieldValidation($data['razorpay_signature'], "RazorPay Signature",$paymenttransactiondata,"razorpay_signature","", $postData,"paymenttransactionarray");
          $postData = dataFieldValidation($data['razorpay_order_id'], "RazorPay Order Id",$paymenttransactiondata,"razorpay_order_id","", $postData,"paymenttransactionarray");
		 $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId);
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 

        $this->load->view('success', $data);
    }  
    public function failed($failureArray){
        $data['title'] = 'Transaction Failed | BizBrainz';
		$data['message'] ='Your Transaction failed..';
		//$data['status']=$failureArray['status'];
		$data['amount']=$failureArray['amount'];
		//$data['email']=$failureArray['email'];
		//$data['contact']=$failureArray['contact'];
		$data['pay_order_id']=$failureArray['description'];
		$data['razorpay_payment_id']=$failureArray['razorpay_payment_id'];
        $data['razorpay_signature']=$failureArray['razorpay_signature'];
		$data['razorpay_order_id']=$failureArray['razorpay_order_id'];
         //$status=$failureArray['status'];
	     $amount=$failureArray['amount']/100;
	     
	      $status='FAILURE';
           $postData=array();
          $paymenttransactiondata = [];
    
         $postData = dataFieldValidation($data['pay_order_id'], "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_payment_id'], "Payment ID",$paymenttransactiondata,"razorpay_payment_id","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_signature'], "RazorPay Signature",$paymenttransactiondata,"razorpay_signature","", $postData,"paymenttransactionarray");
		 $postData = dataFieldValidation($data['razorpay_order_id'], "RazorPay Order Id",$paymenttransactiondata,"razorpay_order_id","", $postData,"paymenttransactionarray");
         $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId); 
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 

           $this->load->view('failure', $data);

    }



    public function saveNewKeywords(){

               $keywords_name     = $this->input->post("add_new_business_keywords_name");
               $keywords_status   = 0;
				
           $postData=array();
		   $keywordssdata = [];
           
         $postData = dataFieldValidation($keywords_name, "Keywords Name",$keywordssdata,"category_name","",$postData,"keywordsarray");
         $postData = dataFieldValidation($keywords_status, "Keywords Status",$keywordssdata,"status","",$postData,"keywordsarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	

       $businesskeywordsarray = array_merge($postData['dbinput']['keywordsarray'],$createdlog);

        $addKeywords=$this->CategoriesList_model->AddKeywords($businesskeywordsarray);
				
				   
            if($addKeywords){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addKeywords));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

     }

 

// Business List Export Strat //
public function businessListExport(){

     $postdata = file_get_contents("php://input");
     $paging   = json_decode($postdata);
     
      // $searchdata=$this->Business_model->SearchBusiness($business_todate,$business_fromdate,$business_cname,$business_city,$city_id,$userid,$business_createdby,$business_status);

     $data=$this->Business_model->BusinessListExport();
    // print_r($data);

    if(isset($paging->export_type) && $paging->export_type=="excel"){
      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('Data');
      $this->excel->getActiveSheet()->setCellValue('A1', 'Business List');
      $this->excel->getActiveSheet()->setCellValue('A2', 'S.No.');
      $this->excel->getActiveSheet()->setCellValue('B2', 'Company Name');
      $this->excel->getActiveSheet()->setCellValue('C2', 'Business Id');
      $this->excel->getActiveSheet()->setCellValue('D2', 'Person Name');
      $this->excel->getActiveSheet()->setCellValue('E2', 'Mobile No');
      $this->excel->getActiveSheet()->setCellValue('F2', 'City Name');
      $this->excel->getActiveSheet()->setCellValue('G2', 'State Name');
      $this->excel->getActiveSheet()->setCellValue('H2', 'Created By');
      $this->excel->getActiveSheet()->setCellValue('I2', 'Created Date');
      $this->excel->getActiveSheet()->setCellValue('J2', 'Status');
     
      $this->excel->getActiveSheet()->mergeCells('A1:J1');
      
      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
      $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
      
      for($col = ord('A'); $col <= ord('J'); $col++){
            
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
    
        $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      }
    
      $exceldata="";
      $rowcount=3;
      
      if(count($data)>0){   
        foreach ($data as $row){
          
          $this->excel->getActiveSheet()->SetCellValue('A'.$rowcount,$row->id);
          $this->excel->getActiveSheet()->SetCellValue('B'.$rowcount,$row->company_name);
          $this->excel->getActiveSheet()->SetCellValue('C'.$rowcount,$row->business_id);
          $this->excel->getActiveSheet()->SetCellValue('D'.$rowcount,$row->person_name);
          $this->excel->getActiveSheet()->SetCellValue('E'.$rowcount,$row->mobile_no);
          $this->excel->getActiveSheet()->SetCellValue('F'.$rowcount,$row->cityname);
          $this->excel->getActiveSheet()->SetCellValue('G'.$rowcount,$row->state_name);
          $this->excel->getActiveSheet()->SetCellValue('H'.$rowcount,$row->created_name);
          $this->excel->getActiveSheet()->SetCellValue('I'.$rowcount,$row->business_created_on);
          $this->excel->getActiveSheet()->SetCellValue('J'.$rowcount,$row->status_value);
          
           $rowcount++;
        }
      }
      $filename='BusinessList-'.date('YmdHis').'.xls'; 
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
      //$objWriter->save('php://output');
      $objWriter->save(FCPATH.'/assets/downloads/'.$filename);
      
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>'assets/downloads/'.$filename));
      return;
      
    }
    if(isset($paging->export_type) && $paging->export_type=='pdf'){
      
      $filename='DealclosedList-'.date('YmdHis').'.pdf';
      
      $data2['data']=$data;
      $data2['print']=0;
      
      //load the view and saved it into $html variable
      $html=$this->load->view('export/businessExportPdf', $data2, true);
   
      //this the the PDF filename that user will get to download
      $pdfFilePath = FCPATH.'/assets/downloads/'.$filename;
   
      //load mPDF library
      $this->load->library('pdf');
   
       //generate the PDF from the given html
      
      $this->pdf->pdf->useSubstitutions = true;
    
      $this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath, "F");
      
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>'assets/downloads/'.$filename));
      return;
      
    }

    if(isset($paging->export_type) && $paging->export_type=='print'){
      $data2['data']=$data;
      $data2['print']=1;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/businessExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }

  }

// Business  List Export End //

} 
?>
