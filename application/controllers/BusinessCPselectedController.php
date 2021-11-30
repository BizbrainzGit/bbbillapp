
<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(0);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule; 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class BusinessCPselectedController extends CommonBaseController {
	
	public function __construct()
	{   
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
         $this->load->model('Business_model');
         $this->load->model('Promocode_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('BusinessPackage_model');
         $this->load->model('Campaigns_model');
         $this->load->model('Packages_model');
         $this->load->model('Customdata_model');
         $this->load->model('BusinessPaymentTransaction_model');
         $this->load->model('Sms_send_model');
         $this->load->model('PaymentType_model');
        
    }

  
		public function getCompanyName()
		{
		 $companyname = $this->Business_model->getCompanyNameToPackages();//fetching from database table
		 echo json_encode(array('data'=>$companyname)); 
		}


          public function savePackagesData(){
	       
	             $business_id          = $this->input->post("add_packages_companyname");
	             $business_campaign    = $this->input->post("add_business_campaign");
	             $business_package     = $this->input->post("add_business_package");
               
                
                 $business_uppersale_amount     = $this->input->post("add_packages_uppersale_amount");
		               if(isset($business_uppersale_amount) && !empty($business_uppersale_amount)){
							$business_uppersale_amount=$business_uppersale_amount;
						}else{
							$business_uppersale_amount=0;
						}

			     $business_totaluppersale_amount     = $this->input->post("add_packages_totaluppersale_amount");
		               if(isset($business_totaluppersale_amount) && !empty($business_totaluppersale_amount)){
							$business_totaluppersale_amount=$business_totaluppersale_amount;
						}else{
							$business_totaluppersale_amount=0;
						}
                $business_state_id  = $this->input->post("add_packages_companyname_state_id");
                $packages_total    = $this->input->post("add_packages_totalpackageamount");
                 if(isset($packages_total) && !empty($packages_total)){
						$packages_total=$packages_total;
					}else{
						$packages_total=0;
					}

                $packages_discountamount = $this->input->post("add_packages_discountamount");
                if(isset($packages_discountamount) && !empty($packages_discountamount)){
						$packages_discountamount=$packages_discountamount;
					}else{
						$packages_discountamount=0;
					}


			     $packages_domainchecked  = $this->input->post("add_packages_domainamount_checked");
				    if($packages_domainchecked ==1){
				       $packages_domainamount = $this->input->post("add_packages_domainamount");
				          } else{
				          $packages_domainamount="0.00";
				     }
				 $packages_domainnames_option1   = $this->input->post("add_packages_domainnames_option1");
                 $packages_domainnames_option2   = $this->input->post("add_packages_domainnames_option2");
                 $packages_domainnames_option3   = $this->input->post("add_packages_domainnames_option3");
                 $packages_domain_names=$packages_domainnames_option1.",".$packages_domainnames_option2.",".$packages_domainnames_option3;    

				$packages_promocode_id   = $this->input->post("add_packages_promocode_id");

					if(isset($packages_promocode_id) && !empty($packages_promocode_id)){
							$packages_promocode_id=$packages_promocode_id;
						}else{
							$packages_promocode_id=0;
						}
				
				 $business_payment_mode        				  = $this->input->post("add_business_payment_mode");

					if(isset($business_payment_mode) && !empty($business_payment_mode)){
							 $business_payment_mode=$business_payment_mode; 
						}else{
							 $business_payment_mode=0;
						}

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
			   
                  $packages_tds  = $this->input->post("add_packages_tds");
				    if($packages_tds ==1){
				         $tds=$total*2/100;
				          } else{
				          $tds="0.00";
				         }
				    if($business_state_id ==32){
				         $cgst=$total*9/100;
				         $sgst=$total*9/100;
				         $grandtoatal=$total+$cgst+$sgst+$tds;
				          } else if($business_state_id !=32){
				          $igst=$total*18/100;
				          $grandtoatal=$total+$igst+$tds;
				         } 
				      
				      $grandtoatal=round($grandtoatal); 

                 $business_otp       				     = $this->input->post("add_package_otp");
					 if(empty($business_otp)){
                         	$business_otp = 0;
                        }else{
                      	    $business_otp  = $business_otp;
                       }    

					$txnid = time(); 
                if($business_payment_mode==1){

                	$cashamount = $this->input->post("add_packages_cashamount");
                     if(empty($cashamount)){
                      	       $cashamount = 0.00;
                        }else{
                      	  $cashamount = $cashamount;
                       }
				     $cashdate = $this->input->post("add_packages_cashdate");
				     if(empty($cashdate)){
                      	      $cashdate  = null;
                        }else{
                      	  $cashdate = date("Y-m-d", strtotime($cashdate) );
                       } 
			         $personame = $this->input->post("add_packages_personame");
			         $placename = $this->input->post("add_packages_placename");


                     $order_id="BB_CASH_".$txnid;
                     $status="SUCCESS";
                     $amount=$cashamount; 


                }else if($business_payment_mode==4){

                     $upiname = $this->input->post("add_packages_upiname");
                     $upiid  = $this->input->post("add_packages_upiid");
                     $upiphonenumber = $this->input->post("add_packages_upiphonenumber");
                     $upiphoto = $this->input->post("add_packages_upiphoto");
					
					$upiamount = $this->input->post("add_packages_upiamount");
					 if(empty($upiamount)){
                      	    $upiamount = 0.00;
                        }else{
                      	  $upiamount = $upiamount;
                       }

		          $upiphoto= isset($_FILES['add_packages_upiphoto']['tmp_name'])?$_FILES['add_packages_upiphoto']['tmp_name']:'';
					if(!empty($upiphoto))
					  {
						$target_dir = "assets/uploads/cheques/";
						$target_file = $target_dir .basename($_FILES["add_packages_upiphoto"]["name"]);
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
							{
							echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
							return;
						} 
		                $temp=rand(0,100000).'_';  
						$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_packages_upiphoto']['name'];
						if(move_uploaded_file($upiphoto,$targetPath)){
						   $imagepath ="assets/uploads/cheques/";
						   $upi_image=$imagepath.$temp.$_FILES['add_packages_upiphoto']['name'];
						} else{
							echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
							return;
						}
						
					}else{
						
						$upi_image=null;
					}


                     $order_id="BB_UPI_".$txnid;
                     $status="SUCCESS";
                     $amount=$upiamount;

                } else if($business_payment_mode==6){
                      

                     $chequeno = $this->input->post("add_packages_chequeno");
				      if(isset($chequeno) && !empty($chequeno)){
						  $chequeno=$chequeno;
					   }else{
						$chequeno=0;
					  }

				     $chequeissuedate       				     = $this->input->post("add_packages_chequeissuedate");
				     if(empty($chequeissuedate)){
                      	$chequeissuedate                         = null;
                        }else{
                      	  $chequeissuedate                       = date("Y-m-d", strtotime($chequeissuedate) );
                       } 
			         $cheque_bankname       				     = $this->input->post("add_packages_cheque_bankname");
					$chequeamount       				     = $this->input->post("add_packages_chequeamount");
					 if(empty($chequeamount)){
                      	$chequeamount                        = 0.00;
                        }else{
                      	  $chequeamount                      = $chequeamount;
                       }
                      

			          $cheque_photo= isset($_FILES['add_packages_cheque_photo']['tmp_name'])?$_FILES['add_packages_cheque_photo']['tmp_name']:'';
						if(!empty($cheque_photo))
						  {
							$target_dir = "assets/uploads/cheques/";
							$target_file = $target_dir .basename($_FILES["add_packages_cheque_photo"]["name"]);
							$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
								{
								echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
								return;
							} 
			                $temp=rand(0,100000).'_';  
							$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_packages_cheque_photo']['name'];
							if(move_uploaded_file($cheque_photo,$targetPath)){
							   $imagepath ="assets/uploads/cheques/";
							  $cheque_image=$imagepath.$temp.$_FILES['add_packages_cheque_photo']['name'];
							} else{
								echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
								return;
							}
							
						}else{
							
							$cheque_image=null;
						} 


                      $order_id="BB_CHEQUE_".$txnid;
                      $status="SUCCESS";
                      $amount=$chequeamount;
         


                }else if($business_payment_mode==7){


                         $neftnumber = $this->input->post("add_packages_neftnumber");
                         $neftamount = $this->input->post("add_packages_neftamount");
					  if(empty($neftamount)){
                      	   $neftamount  = 0.00;
                        }else{
                      	  $neftamount = $neftamount;
                       }

                       $neftphoto= isset($_FILES['add_packages_neftphoto']['tmp_name'])?$_FILES['add_packages_neftphoto']['tmp_name']:'';
					if(!empty($neftphoto))
					  {
						$target_dir = "assets/uploads/cheques/";
						$target_file = $target_dir .basename($_FILES["add_packages_neftphoto"]["name"]);
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
							{
							echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
							return;
						} 
		                $temp=rand(0,100000).'_';  
						$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_packages_neftphoto']['name'];
						if(move_uploaded_file($neftphoto,$targetPath)){
						   $imagepath ="assets/uploads/cheques/";
						   $neft_image=$imagepath.$temp.$_FILES['add_packages_neftphoto']['name'];
						} else{
							echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
							return;
						}
						
					}else{
						
						$neft_image=null;
					}

                      $order_id="BB_NEFT_".$txnid;
                      $status="SUCCESS";
                      $amount=$neftamount; 	


                }else if($business_payment_mode==8){
                      $razorpayorder_id  = $this->input->post("razorpay_select_payment_order_id");
                }
            
        $business_status = $this->input->post("add_packages_status");
			
        $perviousid=BusinessPayments_model::orderBy('id','desc')->first();
        $pervious_business_package_id = $perviousid['business_package_id'];

        $pervious_business_package_id++;
        $id_number=str_pad($pervious_business_package_id, 4, "0", STR_PAD_LEFT);  

                 
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

           $postData=array();
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

       $paymenttransactiondata = [];

         $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($business_otp, "OTP",$paymenttransactiondata,"otp_no","", $postData,"paymenttransactionarray");
         $postData = dataFieldValidation($business_payment_mode, "Business Payment Mode",$paymenttransactiondata,"payment_mode_id","", $postData,"paymenttransactionarray");

        $postData = dataFieldValidation($upiname, "UPI Name",$paymenttransactiondata,"upi_name","", $postData,"paymenttransactionarray");
        $postData = dataFieldValidation($upiid, "Upi Id",$paymenttransactiondata,"upi_id","", $postData,"paymenttransactionarray");
        $postData = dataFieldValidation($upiphonenumber, "UPI Phone Number",$paymenttransactiondata,"upi_phone_number","", $postData,"paymenttransactionarray");
        $postData = dataFieldValidation($upiamount, "UPI Amount",$paymenttransactiondata,"upi_amount","", $postData,"paymenttransactionarray");
	   $postData = dataFieldValidation($upi_image, "UPI Photo",$paymenttransactiondata,"upi_photo","", $postData,"paymenttransactionarray");


       $postData = dataFieldValidation($chequeno, "Cheque Number",$paymenttransactiondata,"cheque_number","", $postData,"paymenttransactionarray");
       $postData = dataFieldValidation($chequeissuedate, "Cheque Issue Date",$paymenttransactiondata,"cheque_issue_date","", $postData,"paymenttransactionarray");
       $postData = dataFieldValidation($cheque_bankname, "Cheque Bank Name",$paymenttransactiondata,"cheque_bankname","", $postData,"paymenttransactionarray");
	   $postData = dataFieldValidation($cheque_image, "Cheque Photo",$paymenttransactiondata,"cheque_photo","", $postData,"paymenttransactionarray");

      
       $postData = dataFieldValidation($cashamount, "Cash Amount",$paymenttransactiondata,"cash_amount","", $postData,"paymenttransactionarray");
       $postData = dataFieldValidation($cashdate , "Cash Date",$paymenttransactiondata,"cash_date","", $postData,"paymenttransactionarray");
	   $postData = dataFieldValidation($personame, "Cash Person Name",$paymenttransactiondata,"cash_personname","", $postData,"paymenttransactionarray");
	   $postData = dataFieldValidation($placename, "Cash Place/City Name",$paymenttransactiondata,"cash_place","", $postData,"paymenttransactionarray");
	  

	  $postData = dataFieldValidation($neftnumber, "NEFT /IMPS Number ",$paymenttransactiondata,"neft_number","", $postData,"paymenttransactionarray");
	  $postData = dataFieldValidation($neft_image, "NEFT /IMPS Image",$paymenttransactiondata,"neft_photo","", $postData,"paymenttransactionarray");
	  $postData = dataFieldValidation($neftamount, "NEFT /IMPS Amount ",$paymenttransactiondata,"neft_amount","", $postData,"paymenttransactionarray"); 
      
         
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
					        $packagearray=array('business_id'=>$business_id,'package_id'=>$package_id,'business_package_id'=>$id_number);
					        $Packages=$this->BusinessPackage_model->addBPackage($packagearray);
					    }

                 }
             if($packages_grandtotal>0){
               // echo "baburao"; 
               // die();
               $packagesdataarray = array_merge($postData['dbinput']['packagesdataarray'],$createdlog);
        	   $addPackagesid=$this->BusinessPayments_model->AddPayments($packagesdataarray);
  
               $userId = $this->ion_auth->get_user_id();
               $updatedlog=isUpdateLog($userId);
              
               $BusinessStatus = array_merge(array('business_status_id'=>$business_status),$updatedlog);
               $statusupdate=$this->Business_model->updateBusiness($BusinessStatus,$business_id); 


          if(strlen($razorpayorder_id)>0){

              $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid,'payment_mode_id'=>$business_payment_mode,'otp_no'=>$business_otp),$updatedlog);
        	  $paymenttransaction=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
        	  
        	  }else{

			 $userId = $this->ion_auth->get_user_id();
	         $createdlog=isCreatedLog($userId);
	         $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid),$postData['dbinput']['paymenttransactionarray'],$createdlog);
	         $paymenttransaction=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 
        	}
            
            }
            if($Packages||$Campaigns||$addPackagesid){
                  
                  $data = array('business_status_id' => $business_status);
                  $Businessupdate=Business_model::where('id','=',$business_id)->update($data);
                  $Businessdata=Business_model::where('id','=',$business_id)->get();
                  $business_email = $Businessdata[0]->email;
                  $business_mobileno = $Businessdata[0]->mobile_no;
                  $business_cname = $Businessdata[0]->company_name;
                 
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
			        $receiptsubject1='Proposal';
					$name=$business_cname;
			        $hiuser = ucfirst($name);
					$receiptbody1=Customdata_model::where('content_type','=','Receipt')->first()->content;
					$receiptbody1=str_replace("{CompanyName}",$hiuser,$receiptbody1);
					$attachments='assets/downloads/'.$filename; 
				    $x=sendEmail($business_email,$receiptsubject1,$receiptbody1,$attachments);
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

            $business_id = $this->input->post("add_packages_companyname");
            $promocode = $this->input->post("add_packages_promocode");
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

          




} ?>


