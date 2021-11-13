
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
error_reporting(0);
ob_start();
class CustomerBuyController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes'));
		$this->load->helper(array('form','html','util_helper','language','url'));
		$this->load->database();
		$this->load->model('leads_model');
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Status_model');
		 $this->load->model('Cities_model');
		 $this->load->model('States_model');
         $this->load->model('Business_model');
         $this->load->model('Address_model');
         $this->load->model('PaymentType_model');
         $this->load->model('Campaigns_model');
         $this->load->model('BusinessCampaign_model');
         $this->load->model('Promocode_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Packages_model');
         $this->load->model('Customdata_model');
         $this->load->model('UserGroups_model');
         $this->load->model('BusinessPackage_model');
         $this->load->model('BusinessPaymentTransaction_model'); 
				 $this->load->model('CategoriesList_model'); 
         $this->load->model('Demowebsites_model');
	}
   // Search Demo Website  for Customet Email link start //

   public function getCategories()
    {
     $CategoriesList =$this->CategoriesList_model->CategoriesList();//fetching from database table
     echo json_encode(array('data'=>$CategoriesList));
     return;
    }

     public function SearchWebsitesForEmailLink()
    {
          $business_website = $this->input->post("search_demowebsite_emaillink"); 
           $searchdata=$this->Demowebsites_model->SearchWebsiteforBusiness($business_website);
           if(count($searchdata)>0){
        echo json_encode(array('success'=>true,'data'=>$searchdata));
        return; 
              }else{
                  echo json_encode(array('success'=>false,'message'=>NOT_AVAILABLE_DATA));
         return;
                  }
    }

 // Search Demo Website  for Customet Email link start //



   public function getCustomerBuyCity()
      {
       $cityname =$this->Cities_model->CityList();//fetching from database table
       echo json_encode(array('data'=>$cityname));
       return;
      }
   
   public function getCustomerBuyState($cityId=null)
      {
       if($cityId==null){
         $statename = $this->States_model->StateList();
       }else{
         $statename = $this->States_model->getCityId($cityId);//fetching from database table
       }
       echo json_encode(array('data'=>$statename));
       return;
      }

	public function CustomerBuyView()
     {
    
    $this->load->view('customerbuyview');
     }
   public function getCustomerBuyPackagelist()
      {
       $packageslist = $this->Packages_model->GetPackageForBusinessCustomer();//fetching from database table
       echo json_encode(array('data'=>$packageslist));
       return;
      }
   public function getCustomerBuyCampaignlist()
      {
       $campaignlist = $this->Campaigns_model->ListCampaignForBusiness();//fetching from database table
       echo json_encode(array('data'=>$campaignlist));
       return;
      }
   
    public function getCustomerBuyCampaignERPlist()
      {
       $campaignlist = $this->Campaigns_model->ListCampaignERPForBusiness();//fetching from database table
       echo json_encode(array('data'=>$campaignlist));
       return;
      }   
   public function getCustomerBuyPaymenttype()
      {
       $paymenttype = $this->PaymentType_model->PaymentTypeList();//fetching from database table
       echo json_encode(array('data'=>$paymenttype));
       return;
      }
   

   public function saveCustomerBuyPackagesData(){
               
                    $add_customerbuy_name           = $this->input->post("add_customerbuy_name");
                    $add_customerbuy_companyname    = $this->input->post("add_customerbuy_companyname");
                    $add_customerbuy_phonenumber    = $this->input->post("add_customerbuy_phonenumber");
                    $add_customerbuy_email          = $this->input->post("add_customerbuy_email");
                    $add_customerbuy_houseno        = $this->input->post("add_customerbuy_houseno");
                    $add_customerbuy_area           = $this->input->post("add_customerbuy_area");
                    $add_customerbuy_city           = $this->input->post("add_customerbuy_city");
                    $add_customerbuy_state          = $this->input->post("add_customerbuy_state");
                     
                    $business_campaign              = $this->input->post("add_customerbuy_campaign");
                    $business_package               = $this->input->post("add_customerbuy_package");
                    $packages_grandtotal            = $this->input->post("add_customerbuy_packages_grandtotal");

                    $business_status=2;
                    $txnid = time(); 
                    $razorpayorder_id  = $this->input->post("customerbuy_razorpay_select_payment_order_id");
                    $business_payment_mode=8;
                    $business_otp=0;
         
      $citysname=Cities_model::where('cities.cityid','=',$add_customerbuy_city)->get();
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
          $userId = null;

        $perviousid=BusinessPayments_model::orderBy('id','desc')->first();
        $pervious_business_package_id = $perviousid['business_package_id'];

        $pervious_business_package_id++;

        $business_package_id=str_pad($pervious_business_package_id, 4, "0", STR_PAD_LEFT);  

                 
                  $userId = null;   
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


    $add_customerbuy_tds  = $this->input->post("add_customerbuy_tds");
    if($add_customerbuy_tds ==1){
         $tds=$packages_grandtotal*2/100;
          } else{
      $tds="0.00";
         }

      if($add_customerbuy_state ==32){
        
              $cgst=$packages_grandtotal*9/100;
               $sgst=$packages_grandtotal*9/100;
               $grandtoatal=$packages_grandtotal+$cgst+$sgst;
             $igst="0.00";
          } else if($add_customerbuy_state !=32){
                $cgst="0.00";   
               $igst=$packages_grandtotal*18/100;
               $grandtoatal=$packages_grandtotal+$igst;
               $sgst="0.00";
         } 
         
         $grandtoatal=round($grandtoatal);
    
           $postData=array();
           $customerbuydata = [];

   
         $postData = dataFieldValidation($add_customerbuy_companyname, "Company Name",$customerbuydata,"company_name","",$postData,"customerbuydataarray");

         $postData = dataFieldValidation($add_customerbuy_name, "Person Name",$customerbuydata,"person_name","", $postData,"customerbuydataarray");

         $postData = dataFieldValidation($add_customerbuy_phonenumber, "Mobile No",$customerbuydata,"mobile_no","", $postData,"customerbuydataarray");
        
         $postData = dataFieldValidation($add_customerbuy_email, "Email",$customerbuydata,"email","",$postData,"customerbuydataarray"); 
         $postData = dataFieldValidation($business_status, "Status",$customerbuydata,"business_status_id","", $postData,"customerbuydataarray");
        $postData = dataFieldValidation($company_id, "Bussnes Id",$customerbuydata,"business_id","",$postData,"customerbuydataarray");
         
          $customerbuyadressdata = [];

        
         $postData = dataFieldValidation($add_customerbuy_houseno, "Street",$customerbuyadressdata,"street","", $postData,"customerbuyAddressarray");        
        
         $postData = dataFieldValidation($add_customerbuy_area, "Area",$customerbuyadressdata,"area","", $postData,"customerbuyAddressarray");
        
         $postData = dataFieldValidation($add_customerbuy_city, "City",$customerbuyadressdata,"city_id","", $postData,"customerbuyAddressarray");

         $postData = dataFieldValidation($add_customerbuy_state, "State",$customerbuyadressdata,"state_id","", $postData,"customerbuyAddressarray");  

          $packagesdata = [];
         

          $postData = dataFieldValidation($packages_grandtotal, "Total Amount",$packagesdata,"total_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($packages_grandtotal, "Grand Total",$packagesdata,"grand_total_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($igst, "IGST Amount",$packagesdata,"igst_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($cgst, "CSGT Amount",$packagesdata,"cgst_amount","", $postData,"packagesdataarray");
          $postData = dataFieldValidation($sgst, "SGST Amount",$packagesdata,"sgst_amount","", $postData,"packagesdataarray");
         $postData = dataFieldValidation($tds, "TDS Amount",$packagesdata,"tds_amount","", $postData,"packagesdataarray");

          $postData = dataFieldValidation($grandtoatal, "Grand Total",$packagesdata,"gstgrand_total_amount","", $postData,"packagesdataarray");


          $postData = dataFieldValidation($business_package_id, "Selected Id",$packagesdata,"business_package_id","", $postData,"packagesdataarray");

        
      

      if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
         echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
         return;
      }
        
        $userId=null;
        $createdlog=isCreatedLog($userId);

        $addressarray = array_merge($postData['dbinput']['customerbuyAddressarray'],$createdlog); 

        $addressid = $this->Address_model->addAddress($addressarray);
       
        $business = array_merge($postData['dbinput']['customerbuydataarray'],array('address_id'=>$addressid),$createdlog);
        $addBusinessid=$this->Business_model->addBusiness($business);
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

            $userId = null;
              $updatedlog=isUpdateLog($userId);
              if(strlen($razorpayorder_id)>0){
            $paymenttransactionarray = array_merge(array('business_payments_id'=>$addPackagesid,'payment_mode_id'=>$business_payment_mode,'otp_no'=>$business_otp),$updatedlog);
               $Packagesupdate=$this->BusinessPaymentTransaction_model->UpdatePaymentTransaction($paymenttransactionarray,$razorpayorder_id); 
               $getTransactionOrderId=$this->BusinessPaymentTransaction_model->getTransactionOrderId($razorpayorder_id);
               $transaction_amount= $getTransactionOrderId[0]->transaction_amount;
               $transaction_status= $getTransactionOrderId[0]->transaction_status;
            
             }
        
            }
     
            if($addBusinessid){
                   
            $subject1='Sample Websites';
            $url1 = getHostURL(true).'websites';
            $name=$add_customerbuy_companyname;
            $hiuser = ucfirst($name);
            $body1=Customdata_model::where('content_type','=','Sample Websites')->first()->content;
            $body1=str_replace("{CompanyName}",$hiuser,$body1);
            $body1=str_replace("{URL}",$url1,$body1);
           sendEmail("info@bizbrainz.in","Administrator",$add_customerbuy_email, $subject1,$body1); 

      if($transaction_amount>=$grandtoatal && $transaction_status=='SUCCESS'){ 
           $userId = null;
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
     
               echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
               return;
        }else{
                echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                return;
         }  

    }





   public function CustomerBuyorderRazorPayGeneration(){

      $currency_code = $this->config->item('DISPLAY_CURRENCY');
      $amount = round($this->input->post('merchant_total'),0);
      $key_id = $this->config->item('RAZOR_KEY_ID');
      $key_secret = $this->config->item('RAZOR_KEY_SECRET');
      $merchant_order_id = $this->input->post('merchant_order_id');
      $api = new Api($key_id, $key_secret);
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
         
         try
         {
            
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
      $data['amount']=$successArray['amount'];
      $data['pay_order_id']=$successArray['description'];
      $data['razorpay_payment_id']=$successArray['razorpay_payment_id'];
      $data['razorpay_signature']=$successArray['razorpay_signature'];
      $data['razorpay_order_id']=$successArray['razorpay_order_id'];
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
        $userId =null;
          $createdlog=isCreatedLog($userId);
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 

        $this->load->view('success', $data);
    }  

    public function failed($failureArray){
        $data['title'] = 'Transaction Failed | BizBrainz';
      $data['message'] ='Your Transaction failed..';
      $data['amount']=$failureArray['amount'];
      $data['pay_order_id']=$failureArray['description'];
      $data['razorpay_payment_id']=$failureArray['razorpay_payment_id'];
        $data['razorpay_signature']=$failureArray['razorpay_signature'];
      $data['razorpay_order_id']=$failureArray['razorpay_order_id'];
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
         $userId = null;
          $createdlog=isCreatedLog($userId); 
         $paymenttransactionarray = array_merge($postData['dbinput']['paymenttransactionarray'],$createdlog);
         $Packagesupdate=$this->BusinessPaymentTransaction_model->addBPaymentTransaction($paymenttransactionarray); 

           $this->load->view('failure', $data);

    }
}

?>