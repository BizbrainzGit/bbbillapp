<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class BusinessPayments_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "business_payments"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['id', 'business_id', 'business_package_id', 'product_type_id', 'receipt_no', 'project_status_id', 'promocode_id', 'discount_amount', 'total_amount', 'grand_total_amount', 'uppersale_amount', 'totaluppersale_amount', 'domain_amount', 'domain_names', 'gst_amount', 'igst_amount', 'cgst_amount', 'tds_amount', 'sgst_amount', 'account_number', 'account_holder_name', 'bank_name', 'ifsc_code', 'bank_city', 'branch_name', 'account_type', 'gstgrand_total_amount', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function AddPayments($packagesdataarray)
	{
		$addresult=self::create($packagesdataarray);
		$id=$addresult->id;
		return $id;
	} 
	
	
   public function PackagesList()
	{
		$editresult=self::join('business_details','business_details.id','=','business_payments.business_id')->leftjoin('business_campaign','business_campaign.business_id','=','business_details.id')->join('campaign_list','campaign_list.id','=','business_campaign.campaign_id')->groupBy('business_details.id')->get(['business_payments.id','business_payments.business_id','business_details.company_name',new raw('GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name'),'status_value']);
		return $editresult;
	}

   public function PaymentsList()
	{
		$editresult=self::join('business_details','business_details.id','=','business_payments.business_id')->where('business_payments.id','=','business_payments.transaction_status')->groupBy('business_details.id')->get(['business_payments.id','business_payments.business_id','business_payments.promocode_id','business_payments.discount_amount','business_payments.total_amount','business_payments.grand_total_amount','business_payments.gstgrand_total_amount','business_payments.order_id','business_payments.transaction_amount','business_payments.transaction_status','business_details.company_name']);
		return $editresult;
	}

    public function ListOfBusiness($id)
	{     
			$query=self::join('business_details','business_details.id','=','business_payments.business_id')
			->leftjoin('business_status','business_status.id','=','business_details.business_status_id')
			->leftjoin('project_status','project_status.id','=','business_payments.project_status_id')
			->leftjoin('business_campaign','business_campaign.business_package_id','=','business_payments.business_package_id')
			->leftjoin('business_packages','business_packages.business_package_id','=','business_payments.business_package_id')
			->leftjoin('campaigns','campaigns.id','=','business_campaign.campaign_id')
			->leftjoin('packages','packages.id','=','business_packages.package_id')
			->where('business_payments.business_id','=',$id)
			->groupBy('business_payments.business_package_id')
			->get(['business_payments.id','business_payments.grand_total_amount','business_payments.gstgrand_total_amount','business_details.company_name','packages.package_name','business_status_id',new raw('GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name'),new raw('GROUP_CONCAT(DISTINCT(package_name)) as package_name'),new raw('DATE_FORMAT(business_payments.created_on, "%d-%m-%Y") as created_on'),'status_value','project_status_id','project_status.status','domain_amount', 'domain_names','uppersale_amount', 'totaluppersale_amount']);
		   return $query;
	}	
    
    
   
   
	 function Invoice($id)
	        {
		   $listresult=self::join('business_details','business_details.id','=','business_payments.business_id')
		      // ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
		      ->join('address','address.id','=','business_details.address_id')
		      ->join('cities','cities.cityid','=','address.city_id')
		      ->join('states','states.state_id','=','address.state_id')
		      ->leftjoin('business_campaign','business_campaign.business_package_id','=','business_payments.business_package_id')
		      ->leftjoin('business_packages','business_packages.business_package_id','=','business_payments.business_package_id')
		      ->where('business_payments.business_package_id','=',$id)
		      // ->where('business_details.business_status_id','=',4)
		      ->groupby('business_payments.business_package_id')
		      ->get(['business_details.company_name','business_payments.business_package_id',new raw('CONCAT(house_no,",",area," , <br>",cityname," , ",state_name," , <br>",pincode,".") AS address'),'cityname','address.pincode','business_details.gst_number','business_details.person_name','business_details.mobile_no',
		      	  new raw('GROUP_CONCAT(DISTINCT(campaign_id)) as campaign_id'),
		      	  new raw('GROUP_CONCAT(DISTINCT(package_id)) as package_id'),
		      	  'discount_amount','total_amount','grand_total_amount','gst_amount','gstgrand_total_amount','igst_amount','cgst_amount','sgst_amount','tds_amount','receipt_no','uppersale_amount','totaluppersale_amount','domain_amount', 'domain_names','uppersale_amount', 'totaluppersale_amount']);
		return $listresult;
	} 

	function updateStatusproject($projectstatusarray, $appointment_id){
	$resultupdate=self::where('id','=',$appointment_id)->update($projectstatusarray);
        return $resultupdate;
		}
    
    function updateReceiptNo($receiptfordealclose,$addPackagesid){
	$resultupdate=self::where('id','=',$addPackagesid)->update($receiptfordealclose);
        return $resultupdate;
		}
   
    function updateInvoiceNo($paymenttransactionarray,$business_package_id){
	$resultupdate=self::where('business_package_id','=',$business_package_id)->update($paymenttransactionarray);;
        return $resultupdate;
		}

	function OnlineSales($city_id,$userid,$month){

        if($city_id!=''){
		
			$city_id="\n AND address.city_id ='$city_id'";
		}
		else{
			$city_id="";
		}
		if($userid!=''){
		
			$userid="\n AND business_payments_transaction.created_by ='$userid'";
		}
		else{
			$userid="";
		} 
		if($month!=''){
		
			$month="\n AND DATE_FORMAT(business_payments_transaction.created_on, '%Y-%m') = '$month'";
		}
		else{
			$month="";
		}
		
           $searchData=Capsule::select("SELECT SUM(transaction_amount) As totalamount FROM business_payments
        join business_payments_transaction on business_payments_transaction.business_payments_id=business_payments.id   	
        join business_details on business_details.id=business_payments.business_id    
        join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
         WHERE payment_mode_id IN ('8')AND business_payments_transaction.transaction_status='SUCCESS' AND business_details.id!=0".$userid.$city_id.$month);     
	return $searchData;

	}

	function OfflineSales($city_id,$userid,$month){

        if($city_id!=''){
			$city_id="\n AND address.city_id ='".$city_id."'";
		  }
		else{
			$city_id="";
		}
		if($userid!=''){
			$userid="\n AND business_payments_transaction.created_by ='".$userid."'";
		}
		else{
			$userid="";
		}
		if($month!=''){
		
			$month="\n AND DATE_FORMAT(business_payments_transaction.created_on, '%Y-%m') = '".$month."'";
		}
		else{
			$month="";
		}

           $searchData=Capsule::select("SELECT SUM(transaction_amount) As totalamount FROM business_payments
        join business_payments_transaction on business_payments_transaction.business_payments_id=business_payments.id   	
        join business_details on business_details.id=business_payments.business_id    
        join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
         WHERE payment_mode_id IN ('1','4','5','6') AND business_payments_transaction.transaction_status='SUCCESS' AND business_details.id!=0".$userid.$city_id.$month);     
	return $searchData;

	}


function PaymentTypeSales($city_id,$userid,$month){

        if($city_id!=''){
		
			$city_id="\n AND address.city_id ='$city_id'";
		}
		else{
			$city_id="";
		}
		if($userid!=''){
		
			$userid="\n AND business_payments_transaction.created_by ='$userid'";
		}
		else{
			$userid="";
		}
		if($month!=''){
		
			$month="\n AND DATE_FORMAT(business_payments_transaction.created_on, '%Y-%m') = '$month'";
		}
		else{
			$month="";
		}
		
           $searchData=Capsule::select("SELECT SUM(transaction_amount) As totalamount ,paymenttype_name FROM business_payments
        join business_payments_transaction on business_payments_transaction.business_payments_id=business_payments.id 
        join payments_type on payments_type.id=business_payments_transaction.payment_mode_id   	
        join business_details on business_details.id=business_payments.business_id    
        join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
        WHERE business_payments_transaction.transaction_status='SUCCESS' AND business_details.id!=0".$userid.$city_id.$month." group by (payment_mode_id)");     
	return $searchData;

	}

 

	function TodayMonthlySalesForTelemarketingDashboard($userid,$today){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             // ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m-%d'))"),'=',$today)
	             ->sum('transaction_amount');
		return $query;

	}

	function TotalMonthlySalesForTelemarketingDashboard($userid,$month){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"),'=',$month)
	             ->sum('transaction_amount');
		return $query;
	   }

	function TodayMonthlySalesForMarketingDashboard($userid,$today,$city_id){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             ->where('address.city_id','=',$city_id)
	             // ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	              ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m-%d'))"),'=',$today)
	             ->sum('transaction_amount');
	             
		return $query;

	}

function TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             ->where('address.city_id','=',$city_id)
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"),'=',$month)
	             ->sum('transaction_amount');
		return $query;
	}

function TodayMonthlySalesForMarketingLeadDashboard($today,$useries){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->WhereIn('business_payments_transaction.created_by',[$useries])
	             // ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m-%d'))"),'=',$today)
	             ->sum('transaction_amount');
		return $query;
	}
function TotalMonthlySalesForMarketingLeadDashboard($month,$useries){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->WhereIn('business_payments_transaction.created_by',[$useries])
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"),'=',$month)
	             ->sum('transaction_amount');
	             
		return $query;

	}

function TodayMonthlySalesForAdminDashboard($today){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             // ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m-%d'))"),'=',$today)
	             ->sum('transaction_amount');
		return $query;

	}

function TotalMonthlySalesForAdminDashboard($month){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"),'=',$month)
	             ->sum('transaction_amount');
		return $query;

	}

	function TodaySalesForDashboardByCitywise($today){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('cities','cities.cityid','=','address.city_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where('business_payments_transaction.created_on', 'LIKE', '%' .$today .'%')
	             ->groupby('address.city_id')
	             ->get([new raw("SUM(transaction_amount) As totalamount"),'cityname']);
		return $query;

	} 
		function TotalSalesForDashboardByCitywise($month){
	 $query = self::join('business_details','business_details.id','=','business_payments.business_id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('payments_type','payments_type.id','=','business_payments_transaction.payment_mode_id')
	             ->join('cities','cities.cityid','=','address.city_id')
	             ->where('business_payments_transaction.transaction_status', '=','SUCCESS')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"),'=',$month)
	             ->groupby('address.city_id')
	             ->get([new raw("SUM(transaction_amount) As totalamount"),'cityname']);
		return $query;

	} 

	   function PaymentPendingDetailsinBusinessPayments($id_number)
	     {
		$listresult=self::join('business_details','business_details.id','=','business_payments.business_id')
		          ->join('address','address.id','=','business_details.address_id')
		          ->join('cities','cities.cityid','=','address.city_id')
		          ->join('states','states.state_id','=','address.state_id')
		         ->leftjoin('business_campaign','business_campaign.business_package_id','=','business_payments.business_package_id')
		         ->leftjoin('business_packages','business_packages.business_package_id','=','business_payments.business_package_id')
		          ->where('business_payments.business_package_id','=',$id_number)
		          ->get([ 'business_payments.business_package_id','company_name', 'person_name', 'person_designation','mobile_no','email','gst_number','discount_amount', 'total_amount', 'grand_total_amount', 'gst_amount', 'igst_amount', 'cgst_amount', 'sgst_amount','gstgrand_total_amount',new raw('DATE_FORMAT(business_payments.created_on, "%d-%m-%Y") as created_on'),new raw('CONCAT(house_no,",",area," , ",cityname," , ",state_name," , ",pincode,".") AS address'),new raw('GROUP_CONCAT(DISTINCT(campaign_id)) as campaign_id'),new raw('GROUP_CONCAT(DISTINCT(package_id)) as package_id'),'business_payments.business_id','business_details.business_status_id','tds_amount','domain_amount','domain_names','uppersale_amount', 'totaluppersale_amount']);
		return $listresult;
	} 



// Deal Closed List Start //

function SearchBusinessDealclosedList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate)
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
			$searchdate="\n AND (SELECT business_payments_transaction.created_on FROM  business_payments_transaction WHERE business_payments_id !=0 AND business_payments_id = business_payments.id AND transaction_status='SUCCESS' ORDER BY business_payments_transaction.id DESC LIMIT 1) BETWEEN '$business_fromdate' AND '$business_todate'";
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


     $searchData=Capsule::select("SELECT business_payments.business_package_id as id,business_payments.grand_total_amount,business_payments.gstgrand_total_amount,business_details.company_name,GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name ,GROUP_CONCAT(DISTINCT(package_name)) as package_name,person_name,mobile_no,business_details.business_id,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname,DATE_FORMAT(business_payments.created_on, '%d-%m-%Y') as payment_created_on,SUM(DISTINCT(transaction_amount)) transaction_amount,DATE_FORMAT((SELECT business_payments_transaction.created_on FROM  business_payments_transaction WHERE business_payments_id !=0 AND business_payments_id = business_payments.id AND transaction_status='SUCCESS' ORDER BY business_payments_transaction.id DESC LIMIT 1), '%d-%m-%Y') as dealclosed_created_on,             CONCAT(udp.first_name,' ',udp.last_name) as package_created_name, CONCAT(udb.first_name,' ',udb.last_name) as business_created_name,receipt_no,domain_amount,domain_names,gst_number
		from business_payments
		join business_details on business_details.id = business_payments.business_id
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join states on states.state_id=address.state_id
		left join business_campaign on business_campaign.business_package_id=business_payments.business_package_id
		left join business_packages on business_packages.business_package_id=business_payments.business_package_id
		left join campaigns on campaigns.id=business_campaign.campaign_id
		left join packages on packages.id=business_packages.package_id
        left join user_details as udp on udp.user_id = business_payments.created_by
        left join user_details as udb on udb.user_id = business_details.created_by
        join business_payments_transaction on business_payments_transaction.business_payments_id = business_payments.id
        join business_status on business_status.id = business_details.business_status_id 
		WHERE business_payments.business_package_id !=0  AND (SELECT SUM(DISTINCT(transaction_amount)) FROM  business_payments_transaction WHERE business_payments_id !=0 AND business_payments_id = business_payments.id AND transaction_status='SUCCESS' GROUP BY business_payments_transaction.business_payments_id) >= business_payments.gstgrand_total_amount".$userid.$city_id.$searchdate.$sreachcname.$sreachcityname." 
       GROUP BY (business_payments.business_package_id) 
       " );     
	return $searchData;

	} 

// Deal Closed List End  //

// Dealclosed Export Start  //
function BusinessDealclosedListExport()
	{
		
     $searchData=Capsule::select("SELECT business_payments.business_package_id as id,business_payments.grand_total_amount,business_payments.gstgrand_total_amount,business_details.company_name,GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name ,GROUP_CONCAT(DISTINCT(package_name)) as package_name,person_name,mobile_no,business_details.business_id,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname,DATE_FORMAT(business_payments.created_on, '%d-%m-%Y') as payment_created_on,SUM(DISTINCT(transaction_amount)) transaction_amount,DATE_FORMAT((SELECT business_payments_transaction.created_on FROM  business_payments_transaction WHERE business_payments_id !=0 AND business_payments_id = business_payments.id AND transaction_status='SUCCESS' ORDER BY business_payments_transaction.id DESC LIMIT 1), '%d-%m-%Y') as dealclosed_created_on,             CONCAT(udp.first_name,' ',udp.last_name) as package_created_name, CONCAT(udb.first_name,' ',udb.last_name) as business_created_name,domain_amount,domain_names
		from business_payments
		join business_details on business_details.id = business_payments.business_id
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join states on states.state_id=address.state_id
		left join business_campaign on business_campaign.business_package_id=business_payments.business_package_id
		left join business_packages on business_packages.business_package_id=business_payments.business_package_id
		left join campaigns on campaigns.id=business_campaign.campaign_id
		left join packages on packages.id=business_packages.package_id
        left join user_details as udp on udp.user_id = business_payments.created_by
        left join user_details as udb on udb.user_id = business_details.created_by
        join business_payments_transaction on business_payments_transaction.business_payments_id = business_payments.business_package_id
        join business_status on business_status.id = business_details.business_status_id 
		WHERE business_payments.business_package_id !=0  AND (SELECT SUM(DISTINCT(transaction_amount)) FROM  business_payments_transaction WHERE business_payments_id !=0 AND business_payments_id = business_payments.business_package_id AND transaction_status='SUCCESS' GROUP BY business_payments_transaction.business_payments_id) >= business_payments.gstgrand_total_amount
       GROUP BY business_payments.business_package_id " );     
     
	return $searchData;
	} 

// Dealclosed Export end  // 

// Customer Selected Packages Start //

public function BusinessSelectedPackagesList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate){
 
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
		 if($business_todate!=' ' &&$business_fromdate!=' '){
			$searchdate="\n AND ( business_payments.created_on BETWEEN '$business_fromdate' AND '$business_todate')";
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

$searchData=Capsule::select("SELECT business_payments.id as id,business_payments.grand_total_amount,business_payments.gstgrand_total_amount,business_details.company_name,GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name ,GROUP_CONCAT(DISTINCT(package_name)) as package_name,person_name,mobile_no,business_details.business_id,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname,DATE_FORMAT(business_payments.created_on, '%d-%m-%Y') as payment_created_on,CONCAT(udp.first_name,' ',udp.last_name) as package_created_name, CONCAT(udb.first_name,' ',udb.last_name) as business_created_name,status_value,domain_amount,domain_names,uppersale_amount,totaluppersale_amount
		from business_payments
		join business_details on business_details.id = business_payments.business_id
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join states on states.state_id=address.state_id
		left join business_campaign on business_campaign.business_package_id=business_payments.business_package_id
		left join business_packages on business_packages.business_package_id=business_payments.business_package_id
		left join campaigns on campaigns.id=business_campaign.campaign_id
		left join packages on packages.id=business_packages.package_id
        left join user_details as udp on udp.user_id = business_payments.created_by
        left join user_details as udb on udb.user_id = business_details.created_by
        join business_status on business_status.id = business_details.business_status_id 
		WHERE business_payments.business_package_id !=0".$userid.$city_id.$searchdate.$sreachcname.$sreachcityname." 
        GROUP BY (business_payments.business_package_id) 
       " );     
	return $searchData;

}

// Customer Selected Packages end  //	


// Customer Selected Packages Export Start //

public function BusinessSelectedPackagesListExport(){
 
$searchData=Capsule::select("SELECT business_payments.business_package_id as id,business_payments.grand_total_amount,business_payments.gstgrand_total_amount,business_details.company_name,GROUP_CONCAT(DISTINCT(campaign_name)) as campaign_name ,GROUP_CONCAT(DISTINCT(package_name)) as package_name,person_name,mobile_no,business_details.business_id,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname,DATE_FORMAT(business_payments.created_on, '%d-%m-%Y') as payment_created_on,CONCAT(udp.first_name,' ',udp.last_name) as package_created_name, CONCAT(udb.first_name,' ',udb.last_name) as business_created_name,status_value,domain_amount,domain_names,uppersale_amount, totaluppersale_amount
		from business_payments
		join business_details on business_details.id = business_payments.business_id
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join states on states.state_id=address.state_id
		left join business_campaign on business_campaign.business_package_id=business_payments.business_package_id
		left join business_packages on business_packages.business_package_id=business_payments.business_package_id
		left join campaigns on campaigns.id=business_campaign.campaign_id
		left join packages on packages.id=business_packages.package_id
        left join user_details as udp on udp.user_id = business_payments.created_by
        left join user_details as udb on udb.user_id = business_details.created_by
        join business_status on business_status.id = business_details.business_status_id 
		WHERE business_payments.business_package_id !=0 
        GROUP BY (business_payments.business_package_id) 
       " );     
	return $searchData;

}

// Customer Selected Packages Export End  //	

// employee sales data start //

function EmployeeSaleReport($city_id,$userid,$month){

        if($city_id!=''){
		
			$city_id="\n AND address.city_id ='$city_id'";
		}
		else{
			$city_id="";
		}
		if($userid!=''){
		
			$userid="\n AND business_payments_transaction.created_by ='$userid'";
		}
		else{
			$userid="";
		} 
		if($month!=''){
			$month="\n AND DATE_FORMAT(business_payments_transaction.created_on, '%Y-%m') = '$month'";
		}

        $searchData=Capsule::select("SELECT business_payments.id,CONCAT(udp.first_name,' ',udp.last_name) as package_created_name,SUM(DISTINCT(gstgrand_total_amount)) gstgrand_total_amount, ROUND(SUM(transaction_amount)/(1.18),2 )  withouttransaction_amount ,SUM(transaction_amount) transaction_amount 
        FROM business_payments
        join business_payments_transaction on business_payments_transaction.business_payments_id=business_payments.id   	
        join business_details on business_details.id=business_payments.business_id    
        join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		left join user_details as udp on udp.user_id = business_payments_transaction.created_by
        WHERE  business_payments_transaction.transaction_status='SUCCESS' AND business_payments.id!=0".$month."GROUP BY (business_payments_transaction.created_by)");     
	    return $searchData;

	}


   public function deleteBusinessPackages($id){
	    $resultupdate=self::where('business_payments.id','=',$id)->delete();
        return $resultupdate;

	}


}?>

