<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class BusinessPaymentTransaction_model extends Eloquent{
    public $timestamps = false;
    protected $table = "business_payments_transaction"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_payments_id', 'otp_no', 'order_id', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature', 'transaction_amount', 'transaction_status', 'payment_mode_id', 'debitcard_number', 'debitcard_expireddate', 'creditcard_number', 'creditcard_expireddate', 'upi', 'phonepay', 'amazonpay', 'googlepay', 'paytm_upi', 'cheque_number', 'cheque_account_no', 'cheque_holder_name', 'cheque_issue_date', 'cheque_bankname', 'cheque_ifsc', 'cheque_photo', 'cheque_micr', 'neft_number', 'cash_amount', 'cash_place', 'cash_date', 'cash_personname', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on','is_cheque_received'];

	public function addBPaymentTransaction($paymentArray)
	{
		$addresult=self::create($paymentArray);
		return $addresult;
	} 
	
  public function UpdatePaymentTransaction($paymenttransactionarray,$order_id){
	    $resultupdate=self::where('order_id','=',$order_id)->update($paymenttransactionarray);
        return $resultupdate;

	}

public function getTransactionOrderId($order_id){
      $getresult=self::where('order_id','=',$order_id)->get(['transaction_amount','transaction_status','order_id']);
        return $getresult;
	}

	public function getTransactionTotalAmount($payments_id){

	    $getresult=self::where('business_payments_id','=',$payments_id)->where('transaction_status','=',"SUCCESS")->get([new raw('SUM(business_payments_transaction.transaction_amount) as transaction_amount')]);
        return $getresult;

	}

	function PaymentPendingDetailsinBusinessTransctions($id)
	{
		$listresult=self::join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
		          ->where('business_payments_transaction.business_payments_id','=',$id)
		          ->get(['payment_mode_id',new raw('DATE_FORMAT(business_payments_transaction.created_on, "%d-%m-%Y") as created_on'),'paymenttype_name','order_id','razorpay_order_id','transaction_amount','transaction_status']);
		return $listresult;
	} 

	 function InvoiceData($id)
	        {
		   $listresult=self::join("business_payments","business_payments.business_package_id","=","business_payments_transaction.business_payments_id")
		      ->where('business_payments_transaction.transaction_status','=','SUCCESS')
		      ->where('business_payments_transaction.business_payments_id','=',$id)
		      // ->groupby('business_payments_transaction.business_payments_id')
		      ->orderBy('business_payments_transaction.business_payments_id','DESC')
		      ->get(['business_payments.business_package_id', new raw('DATE_FORMAT(business_payments_transaction.created_on, "%d-%m-%Y") as created_on')]);

		return $listresult;
	} 

     function ReceiptList($id)
	{
	        $listresult=self::join("business_payments","business_payments.id","=","business_payments_transaction.business_payments_id")
		    ->join('business_details','business_details.id','=','business_payments.business_id')
		    ->join('address','address.id','=','business_details.address_id')
		    ->join('cities','cities.cityid','=','address.city_id')
		    ->join('states','states.state_id','=','address.state_id')
		    ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
		    ->where('business_payments_transaction.business_payments_id','=',$id)
		    ->get(['business_payments_transaction.id','business_payments.business_package_id','business_payments_transaction.order_id','payment_mode_id',new raw('DATE_FORMAT(business_payments_transaction.created_on, "%d-%m-%Y") as created_on'),'paymenttype_name','transaction_status','transaction_amount']);
		return $listresult;
	} 


     function Receipt($id)
	{
		$listresult=self::join("business_payments","business_payments.id","=","business_payments_transaction.business_payments_id")
		    ->join('business_details','business_details.id','=','business_payments.business_id')
		    ->join('address','address.id','=','business_details.address_id')
		    ->join('cities','cities.cityid','=','address.city_id')
		    ->join('states','states.state_id','=','address.state_id')
		    ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
		    ->where('business_payments_transaction.id','=',$id)
		    ->get([ 'business_payments_transaction.id','business_payments.business_package_id','business_payments_transaction.order_id','company_name', 'business_details.business_id','person_name', 'person_designation', 'landline_no', 'mobile_no', 'alt_mobile_no', 'email', 'photo', 'gst_company_name', 'gst_number', 'gst_state','discount_amount', 'total_amount', 'grand_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount', 'account_number', 'account_holder_name', 'bank_name', 'ifsc_code', 'bank_city', 'branch_name', 'account_type', 'gstgrand_total_amount', 'payment_mode_id', 'debitcard_number', 'debitcard_expireddate', 'creditcard_number', 'creditcard_expireddate', 'upi', 'phonepay', 'amazonpay', 'googlepay', 'paytm_upi', 'cheque_number', 'cheque_account_no', 'cheque_holder_name', 'cheque_issue_date', 'cheque_bankname', 'cheque_ifsc', 'cheque_photo', 'cheque_micr', 'neft_number', 'cash_amount', 'cash_place', 'cash_date', 'cash_personname','house_no', 'street', 'sub_area', 'area', 'landmark','cityname','state_name',new raw('DATE_FORMAT(business_payments.created_on, "%d-%m-%Y") as created_on'),'paymenttype_name',new raw('CONCAT(house_no,",",area," , ",cityname," , ",state_name," , ",pincode,".") AS address'),'transaction_status','transaction_amount']);
 // ,new raw("CONCAT(ud.first_name,'',ud.last_name) as paymentbyname"),new raw("CONCAT(udd.first_name,'',udd.last_name) as businesscreatedbyname"),new raw("CONCAT(aud.first_name,'',aud.last_name) as apaymentbyname"),new raw("CONCAT(audd.first_name,'',audd.last_name) as abusinesscreatedbyname"
		return $listresult;
	} 

 // function BusinessTransactionsList()
	// {
	// 	$listresult=self::join("business_payments","business_payments.id","=","business_payments_transaction.business_payments_id")
	// 	    ->join('business_details','business_details.id','=','business_payments.business_id')
	// 	    ->join('address','address.id','=','business_details.address_id')
	// 	    ->join('cities','cities.cityid','=','address.city_id')
	// 	    ->join('states','states.state_id','=','address.state_id')
	// 	    ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	// 	    ->join('user_details','user_details.user_id','=','business_payments_transaction.created_by')
	// 		->groupBy('business_payments_transaction.id')
	// 	    ->get([ 'business_payments_transaction.id','business_payments.business_package_id','business_payments_transaction.order_id','company_name', 'business_details.business_id','gstgrand_total_amount','paymenttype_name','transaction_status','transaction_amount',new raw('DATE_FORMAT(business_payments_transaction.created_on, "%d-%m-%Y") as created_on'), new raw("CONCAT(first_name,'',last_name) as employeename")]);

	// 	return $listresult;
	// }



function BusinessTransactionsList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate)
	{
		
        if($city_id!=''){
			$city_id="\n AND address.city_id ='$city_id'";
		  }
		else{
			$city_id="";
		 }

		if($userid!=''){
			$userid="\n AND(business_details.created_by ='$userid' OR  business_payments.created_by ='$userid')";
		}
		else{
			$userid="";
		}

     //Search Values 
		 if($business_todate!=' '&&$business_fromdate!=''){
			$searchdate="\n AND (business_payments_transaction.created_on  BETWEEN '$business_fromdate' AND '$business_todate')";
		  }else{
			$searchdate=" ";
		  }

		if($business_cname!=''){
			$sreachcname="\n AND business_details.company_name like '%$business_cname%'";
		 }else{
			$sreachcname="";
		 }
		if($business_city!=''){
			$sreachcityname="\n AND address.city_id ='$business_city'";
		}else{
			$sreachcityname="";
		}


     $searchData=Capsule::select("SELECT business_payments_transaction.id as id,business_payments.grand_total_amount,business_payments.gstgrand_total_amount,business_details.company_name,GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name ,GROUP_CONCAT(DISTINCT(package_name)) as package_name,person_name,mobile_no,business_details.business_id,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname,DATE_FORMAT(business_payments.created_on, '%d-%m-%Y') as payment_created_on,transaction_amount,CONCAT(udp.first_name,' ',udp.last_name) as employeename,receipt_no,transaction_status,DATE_FORMAT(business_payments_transaction.created_on, '%d-%m-%Y') as created_on, paymenttype_name
     	from business_payments_transaction
		join business_payments on business_payments.id = business_payments_transaction.business_payments_id
		join business_details on business_details.id = business_payments.business_id
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join states on states.state_id=address.state_id
		join payments_type on payments_type.id = business_payments_transaction.payment_mode_id
		left join business_campaign on business_campaign.business_package_id=business_payments.business_package_id
		left join business_packages on business_packages.business_package_id=business_payments.business_package_id
		left join campaigns on campaigns.id=business_campaign.campaign_id
		left join packages on packages.id=business_packages.package_id
        left join user_details as udp on udp.user_id = business_payments_transaction.created_by
        join business_status on business_status.id = business_details.business_status_id 
		WHERE business_payments_transaction.id !=0 ".$userid.$city_id.$searchdate.$sreachcname.$sreachcityname." 
       GROUP BY (business_payments_transaction.id) 
       " );     
	return $searchData;

	} 



function BusinessTransactionsByid($id)
	{
		$listresult=self::join("business_payments","business_payments.id","=","business_payments_transaction.business_payments_id")
		    ->join('business_details','business_details.id','=','business_payments.business_id')
		    ->join('address','address.id','=','business_details.address_id')
		    ->join('cities','cities.cityid','=','address.city_id')
		    ->join('states','states.state_id','=','address.state_id')
		    ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
		    ->join('user_details','user_details.user_id','=','business_payments_transaction.created_by')
			
			->leftjoin('business_campaign','business_campaign.business_package_id','=','business_payments.business_package_id')
			->leftjoin('business_packages','business_packages.business_package_id','=','business_payments.business_package_id')
			->leftjoin('campaigns','campaigns.id','=','business_campaign.campaign_id')
			->leftjoin('packages','packages.id','=','business_packages.package_id')
			->where('business_payments_transaction.id','=',$id)
			->groupBy('business_payments_transaction.id')
		    ->get([ 'business_payments_transaction.id','business_payments.business_package_id','business_payments_transaction.order_id','company_name', 'business_details.business_id','gstgrand_total_amount','paymenttype_name','transaction_status','transaction_amount',new raw('DATE_FORMAT(business_payments_transaction.created_on, "%d-%m-%Y") as created_on'), new raw("CONCAT(first_name,'',last_name) as employeename"),new raw('GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name'),new raw('GROUP_CONCAT(DISTINCT(package_name)) as package_name'),'is_cheque_received']);

		return $listresult;
	}

   public function UpdateBusinessTransactionApproval($paymenttransactionarray,$id){
 	    $resultupdate=self::where('id','=',$id)->update($paymenttransactionarray);
        return $resultupdate;

	}	

	public function deleteBusinessPackageTransctions($id){
	    $resultupdate=self::where('business_payments_id','=',$id)->delete();
        return $resultupdate;

	}

}
?>