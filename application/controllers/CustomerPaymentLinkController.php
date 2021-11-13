
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
error_reporting(0);
ob_start();

class CustomerPaymentLinkController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes'));
		$this->load->helper(array('form','html','util_helper','language','url'));
		$this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
     $this->load->model('Business_model');
     $this->load->model('PaymentType_model');
     $this->load->model('Campaigns_model');
     $this->load->model('BusinessCampaign_model');
    $this->load->model('BusinessPayments_model');
    $this->load->model('Packages_model');
    $this->load->model('Customdata_model');
    $this->load->model('UserGroups_model');
    $this->load->model('BusinessPackage_model');
    $this->load->model('BusinessPaymentTransaction_model'); 
		
	}
  
  public function CustomerPaymentView()
  {   
    
    $id=$_REQUEST['id'];
    $data['packagedata']=$this->BusinessPayments_model->PaymentPendingDetailsinBusinessPayments($id);
         $campaign = $data['packagedata'][0]['campaign_id'];
         $package = $data['packagedata'][0]['package_id'];
         $packageslist=array();
         $campaignlist=array();
               if($campaign!=null){
                 $array = explode(',', $campaign);
                  for($i=0;$i<count($array);$i++){
                      $campaignlist[] = Campaigns_model::where('id','=',$array[$i])->get(['campaign_name','campaign_amount']);
                  }
                  $data['campaignlist']= $campaignlist;
               
               }
             if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                      $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }

                $data['packageslist']= $packageslist;
             }

          $data['transctiondata']=$this->BusinessPaymentTransaction_model->PaymentPendingDetailsinBusinessTransctions($id);

          // echo $data['packageslist'];
          // print_r($data['packageslist']);
              
              // echo count($data['packageslist']);
            // die();
         //         echo json_encode(array('success'=>true,'data'=>$paymentpendingdata,'campaigndata'=>$campaignlist,'packagesdata'=>$packageslist, 'paymenttransction'=>$paymentpendingTransctiondata));
         // return;

    $this->load->view('customerpaymentlinkview',$data);

  }  


    
public function Savecustomerpaymentlink(){

               $business_id          = $this->input->post("customer_paymentlink_business_id");
               $package_id           = $this->input->post("customer_paymentlink_package_id");
               $pendingtotal         = $this->input->post("customer_paymentlink_pendingtotal");
               $business_payment_mode= $this->input->post("customer_paymentlink_payment_mode");


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
                
          $business_otp                   = $this->input->post("add_paymentpending_otp");
           if(empty($business_otp)){
                        $business_otp                        = 0;
                        }else{
                          $business_otp                      = $business_otp;
                       }      

               $txnid = time(); 
                if($business_payment_mode==8){
                   $razorpayorder_id  = $this->input->post("customer_paymentlink_razorpay_order_id");
                }
      

        $postData=array();
        $paymenttransactiondata = [];

         // $postData = dataFieldValidation($order_id, "Order Id",$paymenttransactiondata,"order_id","", $postData,"paymenttransactionarray");

         // $postData = dataFieldValidation($amount, "Transaction Amount",$paymenttransactiondata,"transaction_amount","", $postData,"paymenttransactionarray");

         // $postData = dataFieldValidation($status, "Transaction Status",$paymenttransactiondata,"transaction_status","", $postData,"paymenttransactionarray");
         
         // $postData = dataFieldValidation($business_otp, "OTP",$paymenttransactiondata,"otp_no","", $postData,"paymenttransactionarray");
        
        // $postData = dataFieldValidation($business_payment_mode, "Business Payment Mode",$paymenttransactiondata,"payment_mode_id","", $postData,"paymenttransactionarray");

         
    if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
      echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
      return;
    }
            $userId = null;

          if(strlen($razorpayorder_id)>0){

              $updatedlog=isUpdateLog($userId);  
              $paymenttransactionarray = array_merge(array('otp_no'=>$business_otp,'business_payments_id'=>$package_id,'payment_mode_id'=>$business_payment_mode),$updatedlog);
               // print_r($paymenttransactionarray);
               // die();
            $paymenttransaction=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
            }
         // $updatedlog=isUpdateLog($userId);
         // // $status=4;
         // $statusupdate = array_merge(array('business_status_id'=>$business_status),$updatedlog);
         // $updatestatus=$this->Business_model->updateBusiness($statusupdate,$business_id); 
          
            if($paymenttransaction){

                   $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionTotalAmount($package_id); 
                 $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
                  $getGrandTotal=BusinessPayments_model::where('business_package_id','=',$package_id)->get(['gstgrand_total_amount','receipt_no']);

                  $grandtoatal    = $getGrandTotal[0]->gstgrand_total_amount;
                  $receiptNoById  = $getGrandTotal[0]->receipt_no;
                 
                 
            if($transaction_amount>=$grandtoatal ){

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
                 } else {
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                  return;
                 } 




        } 
  
}
?>