<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class BusinessSelectedPackageController extends CommonBaseController {
	public function __construct()
	{
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
         $this->load->model('Business_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Customdata_model');
         $this->load->model('UserGroups_model');
         $this->load->model('CityMapping_model');
         $this->load->model('BusinessPaymentTransaction_model');
         $this->load->model('Sms_send_model'); 
          $this->load->model('Campaigns_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('Packages_model');
         $this->load->model('Subpackages_model');
         $this->load->model('BusinessPackage_model');
         
    }
	    
        public function adminBusinessSelectedPackagesView()
        {
         $this->load->view('admin/managebusinesspackagesview');
         }

      public function accountantBusinessSelectedPackagesView()
	     {
         $this->load->view('accountant/managebusinesspackagesview');
        }

       public function teleMarketingBusinessSelectedPackagesView()
        {
         $this->load->view('tele-market/managebusinesspackagesview');
         }

        public function marketingBusinessSelectedPackagesView()
        { 
          $id= $this->ion_auth->get_user_id();
          $citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
          $this->load->view('market/managebusinesspackagesview',$citydata);
          
         }  
       public function marketingLeadBusinessSelectedPackagesView()
        {
         $this->load->view('market-lead/managebusinesspackagesview');
         } 
         
     public function SearchBusinessSelectedPackages()
        {
           $business_cname            = $this->input->post("search_businessseletedpackage_cname"); 
           $business_city             = $this->input->post("search_businessseletedpackage_city"); 
           
           $search_businessseletedpackage_fromdate  = $this->input->post("search_businessseletedpackage_fromdate"); 
           if($search_businessseletedpackage_fromdate) {
               $business_fromdate  = date("Y-m-d", strtotime($search_businessseletedpackage_fromdate) );
            }else{
           	  $business_fromdate=" " ;
            }

           $search_businessseletedpackage_todate          = $this->input->post("search_businessseletedpackage_todate");
           if($search_businessseletedpackage_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_businessseletedpackage_todate) );
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

         $listBusiness=$this->BusinessPayments_model->BusinessSelectedPackagesList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate);
	     echo json_encode(array('success'=>true,'data'=>$listBusiness));
	     return;

        }
  
// Customer Selected packageList Search End //


   // Customer Selected packageList Export Strat //

public function BusinessSelectedPackagesExport(){

     $postdata = file_get_contents("php://input");
     $paging   = json_decode($postdata);
     
     $data=$this->BusinessPayments_model->BusinessSelectedPackagesListExport();
    //print_r($data);

    if(isset($paging->export_type) && $paging->export_type=="excel"){
      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('Data');
      $this->excel->getActiveSheet()->setCellValue('A1', 'Customer Selected List');
      $this->excel->getActiveSheet()->setCellValue('A2', 'S.No.');
      $this->excel->getActiveSheet()->setCellValue('B2', 'Company Name');
      $this->excel->getActiveSheet()->setCellValue('C2', 'Business Id');
      $this->excel->getActiveSheet()->setCellValue('D2', 'Person Name');
      $this->excel->getActiveSheet()->setCellValue('E2', 'Mobile No');
      $this->excel->getActiveSheet()->setCellValue('F2', 'City Name');
      $this->excel->getActiveSheet()->setCellValue('G2', 'Package Name');
      $this->excel->getActiveSheet()->setCellValue('H2', 'Compain Name');
      $this->excel->getActiveSheet()->setCellValue('I2', 'Package Grand Total Amount');
      $this->excel->getActiveSheet()->setCellValue('J2', 'Package Date');
      $this->excel->getActiveSheet()->setCellValue('K2', 'Package Given By');
      $this->excel->getActiveSheet()->setCellValue('L2', 'Business Created By');
      $this->excel->getActiveSheet()->setCellValue('M2', 'Business Status');
     
      $this->excel->getActiveSheet()->mergeCells('A1:M1');
      
      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
      $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
      
      for($col = ord('A'); $col <= ord('M'); $col++){
            
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
          $this->excel->getActiveSheet()->SetCellValue('G'.$rowcount,$row->package_name);
          $this->excel->getActiveSheet()->SetCellValue('H'.$rowcount,$row->campaign_name);
          $this->excel->getActiveSheet()->SetCellValue('I'.$rowcount,$row->gstgrand_total_amount);
          $this->excel->getActiveSheet()->SetCellValue('J'.$rowcount,$row->payment_created_on);
          $this->excel->getActiveSheet()->SetCellValue('K'.$rowcount,$row->package_created_name);
          $this->excel->getActiveSheet()->SetCellValue('L'.$rowcount,$row->business_created_name);
          $this->excel->getActiveSheet()->SetCellValue('M'.$rowcount,$row->status_value);
           $rowcount++;
        }
      }
      $filename='CustomerSecletedPackageList-'.date('YmdHis').'.xls'; 
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
      $html=$this->load->view('export/businessseletedpackagelistExportPdf', $data2, true);
   
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
      $html=$this->load->view('export/businessseletedpackagelistExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }

  }

// Customer Selected package List Export End //



// Send Payment Link To Customer Start //

  public function PackagePaymentLink($id)
  {
       
        $data['packagedata']=$this->BusinessPayments_model->PaymentPendingDetailsinBusinessPayments($id);
        $business_cname= $data['packagedata'][0]['campaign_id'];
        $business_email= $data['packagedata'][0]['email'];

        $id                 = $id;
        $subject='Payment Link';
        $url = getHostURL(true).'paymentlink?id='.$id;
        $name=$business_cname;
        $hiuser = ucfirst($name);
        $body=Customdata_model::where('content_type','=','PaymentLink')->first()->content;
        $body=str_replace("{CompanyName}",$hiuser,$body);
        $body=str_replace("{URL}",$url,$body);
        $sendlinkid= sendEmail("bizbrainz2020@gmail.com","Administrator",$business_email,$subject,$body);

              if($sendlinkid){
                    echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
                    return;
                }else {
                      echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                      return;
               } 


   
  }

  // Send Payment Link To Customer Start //

    
// Payment Pending Start //
 public function BusinessPaymentPending($id)
        {
              $paymentpendingdata=$this->BusinessPayments_model->PaymentPendingDetailsinBusinessPayments($id);
               $campaign = $paymentpendingdata[0]['campaign_id'];
               $package = $paymentpendingdata[0]['package_id'];
         $packageslist=array();
         $campaignlist=array();
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

           $paymentpendingTransctiondata=$this->BusinessPaymentTransaction_model->PaymentPendingDetailsinBusinessTransctions($id);
                 echo json_encode(array('success'=>true,'data'=>$paymentpendingdata,'campaigndata'=>$campaignlist,'packagesdata'=>$packageslist, 'paymenttransction'=>$paymentpendingTransctiondata));
         return;
     
        }  

  

    
public function savePaymentpendingData(){

               $business_id          = $this->input->post("business_paymentpending_business_id");
               $package_id           = $this->input->post("business_paymentpending_package_id");
                 $pendingtotal         = $this->input->post("business_paymentpending_pendingtotal");
                 $business_payment_mode= $this->input->post("add_paymentpending_payment_mode");
           if(isset($business_payment_mode) && !empty($business_payment_mode)){
            $business_payment_mode=$business_payment_mode;
          }else{
            $business_payment_mode=0;
          }

                 if(isset($pendingtotal) && !empty($pendingtotal)){
            $pendingtotal=$pendingtotal;
          }else{
            $pendingtotal=0;
          }

             $debitcardno       = $this->input->post("add_paymentpending_debitcardno");
             if(isset($debitcardno) && !empty($debitcardno)){
            $debitcardno=$debitcardno;
          }else{
            $debitcardno=0;
          }
                     $debitcardexpireddate  = $this->input->post("add_paymentpending_debitcard_expireddate");
                        if(empty($debitcardexpireddate)){
                          $debitcard_expireddate                     = null;
                          }else{
                          $debitcard_expireddate                     = date("Y-m-d", strtotime($debitcardexpireddate) );
                         }    

             $creditcardno                        = $this->input->post("add_paymentpending_creditcardno");
                 if(isset($creditcardno) && !empty($creditcardno)){
                $creditcardno=$creditcardno;
              }else{
                $creditcardno=0;
              }
               $creditcardexpireddate                 = $this->input->post("add_paymentpending_creditcard_expireddate");
                  if(empty($creditcardexpireddate)){
                          $creditcard_expireddate                     = null;
                          }else{
                            $creditcard_expireddate                     = date("Y-m-d", strtotime($creditcardexpireddate) );
                         } 

                     $upi                                     = $this->input->post("add_paymentpending_upi");
                     $phonepay                              = $this->input->post("add_paymentpending_phonepay");
                       if(isset($phonepay) && !empty($phonepay)){
              $phonepay=$phonepay;
            }else{
              $phonepay=0;
            }
                     $amazonpay                             = $this->input->post("add_paymentpending_amazonpay");
                         if(isset($amazonpay) && !empty($amazonpay)){
              $amazonpay=$amazonpay;
            }else{
              $amazonpay=0;
            }
                     $googlepay                             = $this->input->post("add_paymentpending_googlepay");
                        if(isset($googlepay) && !empty($googlepay)){
              $googlepay=$googlepay;
            }else{
              $googlepay=0;
            } 

          $upiamount                   = $this->input->post("add_paymentpending_upiamount");
           if(empty($upiamount)){
                        $upiamount                        = 0.00;
                        }else{
                          $upiamount                      = $upiamount;
                       }

                     $paytm_upi                               = $this->input->post("add_paymentpending_paytm_upi");
                      $paytmamount                   = $this->input->post("add_paymentpending_paytmamount");
                     if(empty($paytmamount)){
                        $paytmamount                        = 0.00;
                        }else{
                          $paytmamount                      = $paytmamount;
                       } 
                     $cashamount                   = $this->input->post("add_paymentpending_cashamount");
                     if(empty($cashamount)){
                        $cashamount                        = 0.00;
                        }else{
                          $cashamount                      = $cashamount;
                       }
             $cashdate                   = $this->input->post("add_paymentpending_cashdate");
             if(empty($cashdate)){
                        $cashdate                        = null;
                        }else{
                          $cashdate                      = date("Y-m-d", strtotime($cashdate) );
                       } 
               $personame                             = $this->input->post("add_paymentpending_personame");
               $placename                               = $this->input->post("add_paymentpending_placename");
               
               $neftnumber                              = $this->input->post("add_paymentpending_neftnumber");

            
             $chequeno                           = $this->input->post("add_paymentpending_chequeno");
                if(isset($chequeno) && !empty($chequeno)){
              $chequeno=$chequeno;
            }else{
              $chequeno=0;
            }
             $chequeaccountno                    = $this->input->post("add_paymentpending_chequeaccountno");
                if(isset($chequeaccountno) && !empty($chequeaccountno)){
              $chequeaccountno=$chequeaccountno;
            }else{
              $chequeaccountno=0;
            }
             $chequeholdername                   = $this->input->post("add_paymentpending_chequeholdername");
             $chequeissuedate                    = $this->input->post("add_paymentpending_chequeissuedate");
               if(empty($chequeissuedate)){
                          $chequeissuedate                         = null;
                          }else{
                            $chequeissuedate                       = date("Y-m-d", strtotime($chequeissuedate) );
                         } 
               $cheque_bankname                    = $this->input->post("add_paymentpending_cheque_bankname");
                     $cheque_ifsc                            = $this->input->post("add_paymentpending_cheque_ifsc");
                     $cheque_micr                          = $this->input->post("add_paymentpending_cheque_micr");
                        if(isset($cheque_micr) && !empty($cheque_micr)){
              $cheque_micr=$cheque_micr;
            }else{
              $cheque_micr=0;
            }
          $chequeamount                    = $this->input->post("add_paymentpending_chequeamount");
           if(empty($chequeamount)){
                        $chequeamount                        = 0.00;
                        }else{
                          $chequeamount                      = $chequeamount;
                       } 
                 
                 $neftamount                   = $this->input->post("add_paymentpending_neftamount");
           if(empty($neftamount)){
                        $neftamount                        = 0.00;
                        }else{
                          $neftamount                      = $neftamount;
                       }

                 $business_otp                   = $this->input->post("add_paymentpending_otp");
           if(empty($business_otp)){
                        $business_otp                        = 0;
                        }else{
                          $business_otp                      = $business_otp;
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
                      $razorpayorder_id  = $this->input->post("razorpay_paymentpending_order_id");
                }
            
             $business_status  = $this->input->post("add_packages_status");

        if(isset($business_status) && !empty($business_status)){
          $business_status=$business_status;
        }else{
          $business_status=0;
        }
       $sourcePath2= isset($_FILES['add_packages_cheque_photo']['tmp_name'])?$_FILES['add_packages_cheque_photo']['tmp_name']:'';
                
      if(!empty($sourcePath2))
      {
        
        $target_dir = "assets/uploads/cheques/";
        $target_file = $target_dir .basename($_FILES["add_packages_cheque_photo"]["name"]);
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
        $targetPath = FCPATH.$target_dir.$temp.$_FILES['add_packages_cheque_photo']['name']; // Target path where file is to be stored
        
        if(move_uploaded_file($sourcePath2,$targetPath)){

        $imagepath ="assets/uploads/cheques/";
        $cheque_image=$imagepath.$temp.$_FILES['add_packages_cheque_photo']['name'];

        } else{
          echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
          return;
        }
        
      }else{
        
        $cheque_image=null;
        
        
      }

        $business_status  = $this->input->post("add_paymentpending_status");
        if(isset($business_status) && !empty($business_status)){
          $business_status=$business_status;
        }else{
          $business_status=0;
        } 

        $postData=array();
        $paymenttransactiondata = [];

         $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");

         $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");

         $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
         
         $postData = dataFieldValidation($business_otp, "OTP",$paymenttransactiondata,"otp_no","", $postData,"paymenttransactionarray");
        
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
   
     
         
    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
      echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
      return;
    }
            
          if(strlen($razorpayorder_id)>0){
                
              $userId = $this->ion_auth->get_user_id();
               $updatedlog=isUpdateLog($userId);  
              $paymenttransactionarray = array_merge(array('otp_no'=>$business_otp,'business_payments_id'=>$package_id,'payment_mode_id'=>$business_payment_mode),$updatedlog);
              // print_r($paymenttransactionarray);
            $paymenttransaction=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 

            }else{

       $userId = $this->ion_auth->get_user_id();
           $createdlog=isCreatedLog($userId);
           $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],array('business_payments_id'=>$package_id),$createdlog);
           $paymenttransaction=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 
          
          } 

         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
         // $status=4;
         $statusupdate = array_merge(array('business_status_id'=>$business_status),$updatedlog);
         $updatestatus=$this->Business_model->updateBusiness($statusupdate,$business_id); 
          
            if($paymenttransaction){

                   $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionTotalAmount($package_id); 
                 $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
                  $getGrandTotal=BusinessPayments_model::where('business_package_id','=',$package_id)->get(['gstgrand_total_amount','receipt_no']);

                  $grandtoatal    = $getGrandTotal[0]->gstgrand_total_amount;
                  $receiptNoById  = $getGrandTotal[0]->receipt_no;
                 
                 
            if($transaction_amount>=$grandtoatal ){

              $userId = $this->ion_auth->get_user_id();
              $updatedlog=isUpdateLog($userId);
              $status=4;
              $statusupdatefordealclose = array_merge(array('business_status_id'=>$status),$updatedlog);
              $statusupdate=$this->Business_model->updateBusiness($statusupdatefordealclose,$business_id);

                 if($receiptNoById==null&&$receiptNoById==0){
                     $perviousid=BusinessPayments_model::orderBy('receipt_no','desc')->first();
                  $number = $perviousid['receipt_no'];
                  $a=explode("/",$number);
                  $number=$a[2];
                  $number++;
                  $short_name=BB_INVOICE_NO;
                  $id_number=str_pad($number, 4,"0", STR_PAD_LEFT);     
                  $receipt_no = $short_name.$id_number;
                        $receiptfordealclose = array_merge(array('receipt_no'=>$receipt_no),$updatedlog);
                    $receiptupdate=$this->BusinessPayments_model->updateReceiptNo($receiptfordealclose,$package_id);
                       }

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

  // payment Pending ends //  



 /*  Receipt List Start */

 public function BusinessReceiptList($id)
        {
                 $receiptdata=$this->BusinessPaymentTransaction_model->ReceiptList($id);
                  echo json_encode(array('success'=>true,'data'=>$receiptdata));
                 return;
     
        }

 public function BusinessReceipt($id)
        {
                 $receiptdata=$this->BusinessPaymentTransaction_model->Receipt($id);
                 echo json_encode(array('success'=>true,'data'=>$receiptdata));
                 return;
     
        }

public function receiptExport(){

    $id = $this->input->post("business_receipt_selectedid");
    $export_type = $this->input->post("export_type");
     $data=$this->BusinessPaymentTransaction_model->Receipt($id);

    if(isset($export_type) && $export_type=='pdf'){
      $filename='Receipt-'.$id.'-'.date('YmdHis').'.pdf';
      $data2['data']=$data;
      $data2['base_url']="/".base_url();
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/receiptExportPdf',$data2,true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
      //load mPDF library
      $this->load->library('pdf');
       //generate the PDF from the given html
      $this->pdf->pdf->useSubstitutions = true;
    
    $this->pdf->pdf->WriteHTML($html);  
      
    //$this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath,"F");
      
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>'assets/downloads/'.$filename));
      return;
      
    }

    if(isset($export_type) && $export_type=='print'){
      $data2['data']=$data;
      $data2['print']=1;
      $html=$this->load->view('export/receiptExportPrint',$data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
      return;
    }
  }

public function receiptSendToMail(){

     $id = $this->input->post("business_receipt_selectedid");
     $export_type = $this->input->post("export_type");
     $data=$this->BusinessPaymentTransaction_model->Receipt($id);
     $business_email=$data[0]['email'];
     $filename='Receipt-'.$id.'-'.date('YmdHis').'.pdf';
            $data2['data']=$data;
      $data2['campaignlist']=$campaignlist;
      $data2['packageslist']=$packageslist;
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/receiptExportPdf',$data2, true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
   
      //load mPDF library
      $this->load->library('pdf');
       //generate the PDF from the given html
      
      $this->pdf->pdf->useSubstitutions = true;
        
      $this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath,"F");
        $receiptsubject1='Receipt';
        $recipt_subject='Receipt';
    $recipt_url = getHostURL(true).'websites';
    $name=$business_cname;
        $hiuser = ucfirst($name);
    $receiptbody1=Customdata_model::where('content_type','=','Receipt')->first()->content;
    $receiptbody1=str_replace("{CompanyName}",$hiuser,$receiptbody1);
    $receiptbody1=str_replace("{URL}",$url1,$receiptbody1);
    $attachments='assets/downloads/'.$filename;
       
       $result=sendEmail("bizbrainz2020@gmail.com","Administrator",$business_email,$receiptsubject1,$receiptbody1,$attachments);
        
       if($result){
         echo json_encode(array('success'=>true,'message'=>MAILSEND_SUCCESS_MSG));
              return;
        }else{

          echo json_encode(array('success'=>false,'message'=>MAILSEND_FAIL_MSG,));
              return;
        }
        
} 

/*  Receipt List ends */

} 
?>
