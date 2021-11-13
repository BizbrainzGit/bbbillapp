
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class SendLinkBuyNowController extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();
		
    		 $this->load->library(array('form_validation','Excel_reader','ValidationTypes'));
    		 $this->load->helper(array('form','html','util_helper','language','url'));
    		 $this->load->database();
    		 $this->load->model('Status_model');
         $this->load->model('Business_model');
         $this->load->model('Address_model');
         $this->load->model('PaymentType_model');
         $this->load->model('Campaigns_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Packages_model');
         $this->load->model('Customdata_model');
         $this->load->model('BusinessPackage_model');
         $this->load->model('BusinessPaymentTransaction_model'); 
				
	}

	 public function SendLinkBuyNowView()
     { 
       $id=$_REQUEST['id'];
        // $id=6;
        $data['businessdata']=$this->Business_model->editBusiness($id);
        $this->load->view('sendlinkbuynowview',$data);
     }
    public function getSendLinkBuyNowPackagelist()
      {
       $packageslist = $this->Packages_model->GetPackageForBusinessCustomer();//fetching from database table
       echo json_encode(array('data'=>$packageslist));
       return;
      }


public function saveSendLinkBuyNowPackagesData(){
         
               $business_id           = $this->input->post("add_sendlinkbuynow_business_id");
               $business_package      = $this->input->post("add_sendlinkbuynow_package");
               $packages_grandtotal   = $this->input->post("add_sendlinkbuynow_packages_total");
              
              $business_payment_mode = 8;
              $razorpayorder_id  = $this->input->post("add_sendlinkbuynow_razorpay_order_id");
              $business_state_id  = $this->input->post("add_sendlinkbuynow_state_id");

              $perviousid=BusinessPayments_model::orderBy('id','desc')->first();
              $pervious_business_package_id = $perviousid['business_package_id'];

              $pervious_business_package_id++;
              $id_number=str_pad($pervious_business_package_id, 4, "0", STR_PAD_LEFT);  
                 
              $userId = null;  
              $postData=[];
              if(isset($business_package) && !empty($business_package))
                {
                      $package=[];
                foreach($business_package as $key=>$udata)
                {
                    $package_id  = $udata;
                    $postData = dataFieldValidation($package_id, "Package", $package,"package_id", "", $postData, "packagearray".$key);
                    }
                }

      
         
    $packages_tds  = $this->input->post("add_sendlinkbuynow_tds");
     
     if($packages_tds ==1){
         $tds=$packages_grandtotal*2/100;
          } else{
           $tds="0.00";
         }

         if($business_state_id ==32){
         $cgst=$packages_grandtotal*9/100;
         $sgst=$packages_grandtotal*9/100;
         $grandtoatal=$packages_grandtotal+$cgst+$sgst+$tds;
         
          } else if($business_state_id !=32){

          $igst=$packages_grandtotal*18/100;
          $grandtoatal=$packages_grandtotal+$igst+$tds;

         }  

         $grandtoatal=round($grandtoatal);    
         $packagesdata = [];
         
          $postData = dataFieldValidation($business_id, "Business Id",$packagesdata,"business_id","", $postData,"packagesdataarray");
          
          $postData = dataFieldValidation($packages_grandtotal, "Total Amount",$packagesdata,"total_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_grandtotal, "Grand Total",$packagesdata,"grand_total_amount","", $postData,"packagesdataarray");
          
          $postData = dataFieldValidation($igst, "IGST",$packagesdata,"igst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($cgst, "CGST",$packagesdata,"cgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($sgst, "SGST",$packagesdata,"sgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($tds, "TDS Amount",$packagesdata,"tds_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($grandtoatal, "Grand Total",$packagesdata,"gstgrand_total_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($id_number, "Selected Id",$packagesdata,"business_package_id","", $postData,"packagesdataarray");


         
        if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
          echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
          return;
        }
            
            $userId = null;
            $createdlog=isCreatedLog($userId);

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
               
               $packagesdataarray = array_merge($postData['dbinput']['packagesdataarray'],$createdlog);
               $addPackagesid=$this->BusinessPayments_model->AddPayments($packagesdataarray);
  
              $updatedlog=isUpdateLog($userId);

              if(strlen($razorpayorder_id)>0){

                  $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid,'payment_mode_id'=>$business_payment_mode),$updatedlog);
                  $paymenttransaction=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 

                $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($razorpayorder_id);
                   $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
                   $transaction_status= $getTransactionOrderId[0]->transaction_status;
                }
                
            }
            if($Packages||$addPackagesid){

                  $Businessdata=Business_model::where('id','=',$business_id)->get();
                  $business_email = $Businessdata[0]->email;
                  $business_mobileno = $Businessdata[0]->mobile_no;
                  $business_cname = $Businessdata[0]->company_name;
                  // $subject='Feedback';
                  // $url = getHostURL(true).'feedback?id='.$business_id;
                  // $name=$Businessemail['company_name'];
                  // $hiuser = ucfirst($name);
                  // $body=Customdata_model::where('content_type','=','Feedback')->first()->content;
                  // $body=str_replace("{CompanyName}",$hiuser,$body);
                  // $body=str_replace("{URL}",$url,$body);
                  // sendEmail("info@bizbrainz.in","Administrator",$business_email, $subject,$body); 

              if($transaction_amount>=$grandtoatal && $transaction_status=='SUCCESS'){ 
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



}?>