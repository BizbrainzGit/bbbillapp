<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Business_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="business_details";
      public $PrimaryKey='id';
      protected $Filables=[  'address_id', 'business_status_id', 'business_id', 'company_name', 'business_category_name', 'person_name', 'person_designation', 'landline_no', 'mobile_no', 'alt_mobile_no', 'email', 'photo', 'visitingcard_photo', 'gst_company_name', 'gst_number', 'gst_state', 'gst_pincode', 'gst_pan_no', 'gst_address', 'website_url', 'facebook_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'instagram_url', 'is_senddemolink', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

    

function addBusiness($businessarray)
	{
		$addresult=self::create($businessarray);
		$id=$addresult->id;
		return $id;
	} 

// function BusinessList()
// 	{
// 		$listresult=self::join('address','address.id','=','business_details.address_id')->leftjoin('cities','cities.cityid','=','address.city_id')->leftjoin('business_status','business_status.id','=','business_payments.business_status_id') ->leftjoin('states','states.state_id','=','address.state_id')->leftjoin('project_status','project_status.id','=','business_details.project_status_id')->get(['business_details.id','company_name', 'house_no', 'street', 'sub_area', 'area', 'landmark','pincode', 'person_name', 'landline_no', 'mobile_no', 'email', 'photo','cityname','state_name','project_status_id','project_status.status','alt_mobile_no','gst_company_name', 'gst_number', 'gst_state', 'gst_pincode', 'gst_pan_no', 'gst_address', 'website_url', 'facebook_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'instagram_url','business_status_id','business_details.business_id']);
// 		return $listresult;
// 	} 


function updateStatus($statusarray, $appointment_id){

	$resultupdate=self::where('id','=',$appointment_id)->update($statusarray);
        return $resultupdate;

		}


function editBusiness($id)
	{
	$editresult=self::leftjoin('business_status','business_status.id','=','business_details.business_status_id')->join('address','address.id','=','business_details.address_id')->where('business_details.id','=',$id)->groupBy('business_details.id')->get(['business_details.id','address_id','company_name','person_name','person_designation','business_status_id', 'landline_no', 'mobile_no', 'email', 'photo','house_no', 'street', 'sub_area', 'area', 'landmark', 'address.city_id', 'state_id', 'country', 'pincode', 'geocoordinates', 'latitude', 'longitude','alt_mobile_no','gst_company_name', 'gst_number', 'gst_state', 'gst_pincode', 'gst_pan_no', 'gst_address','website_url', 'facebook_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'instagram_url']);
		return $editresult;
	}

function updateBusiness($businessarray, $business_id)
    {
	$resultupdate=self::where('id','=',$business_id)->update($businessarray);
       return $resultupdate;
    }

function deleteBusiness($id)
    {
	$deleteresult=self::where('id','=',$id)->delete();
       return $deleteresult;
    }

function UpdateAppointments($businessdataarray, $appointment_id)
    {
	   $resultupdate=self::where('id','=',$appointment_id)->update($businessdataarray);
        return $resultupdate;
	}

function getCompanyNameToPackages()
	{
		$listresult=self::join('address','address.id','=','business_details.address_id')->leftjoin('cities','cities.cityid','=','address.city_id')->leftjoin('states','states.state_id','=','address.state_id')->get(['business_details.id','company_name']);
		return $listresult;
	} 

function SearchBusiness($business_todate,$business_fromdate,$business_cname,$business_city,$city_id,$userid,$business_createdby,$business_status){
         if($city_id!=''){
		
			$city_id="\n OR address.city_id ='$city_id'";
		}
		else{
			$city_id="";
		}
		if($userid!=''){
		
			$userid="\n AND business_details.created_by ='$userid'";
		}
		else{
			$userid="";
		}
		  
         if($business_todate!=' '&&$business_fromdate!=''){
		
			$searchdate="\n AND business_details.created_on BETWEEN '$business_fromdate' AND '$business_todate'";
		}
		else{
			$searchdate=" ";
		}
		
		if($business_cname!=''){
		
			$name="\n AND business_details.company_name like '%$business_cname%'";
		}
		else{
			$name="";
		}
		if($business_city!=''){
		
			$cityname="\n AND address.city_id ='$business_city'";
		}
		else{
			$cityname="";
		}

		if($business_createdby!=''){
		
			$business_createdby="\n AND business_details.created_by ='$business_createdby'";
		}
		else{
			$business_createdby="";
		}

		if($business_status!=''){
		
			$business_status="\n AND business_details.business_status_id ='$business_status'";
		}
		else{
			$business_status="";
		}

           $searchData=Capsule::select("SELECT business_details.id,company_name,house_no,street,sub_area, area,landmark,pincode,person_name,landline_no,mobile_no,email,photo,cityname,state_name,alt_mobile_no,gst_company_name,gst_number,gst_state,gst_pincode,gst_pan_no,gst_address,website_url,facebook_url,twitter_url, youtube_url,linkedin_url,instagram_url,business_status_id,status_value,business_details.business_id,CONCAT(house_no , ' ',area, ' ',cityname , ' ',state_name) AS address_id,address.state_id,CONCAT(user_details.first_name,' ',user_details.last_name) as created_name,DATE_FORMAT(business_details.created_on, '%d-%m-%Y') as business_created_on,person_name,mobile_no,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile
		from business_details
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
	    join states on states.state_id=address.state_id
	    left join user_details on user_details.user_id=business_details.created_by 
	    left join business_status on business_status.id = business_details.business_status_id
		  WHERE business_details.id !=0 ".$searchdate.$name.$cityname.$userid.$city_id.$business_createdby.$business_status);     
	return $searchData;

	}


function ProjectStatusList($city_id,$userid)
	{  
		
        if($city_id!=''){
			$city_id="\n AND address.city_id ='$city_id'";
		}
		else{
			$city_id="";
		}
		if($userid!=''){
		
			$userid="\n AND business_details.created_by ='$userid'";
		}
		else{
			$userid="";
		}
     $searchreslutData=Capsule::select("SELECT business_payments.id,business_details.business_id,company_name,house_no,street,sub_area,area,landmark,pincode,person_name,landline_no,mobile_no,email,photo,cityname,alt_mobile_no,gst_company_name,gst_number,gst_state,gst_pincode,gst_pan_no,gst_address,website_url,facebook_url,twitter_url,youtube_url,linkedin_url,instagram_url,business_status_id,project_status_id,project_status.status,payment_mode_id,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketing_name,GROUP_CONCAT(DISTINCT(campaigns.campaign_name)) as campaign_name,GROUP_CONCAT(DISTINCT(packages.package_name)) as package_name
		from business_details
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		join business_payments on business_payments.business_id = business_details.id
		join business_payments_transaction on business_payments_transaction.business_payments_id = business_payments.business_package_id
		left join assignments on assignments.business_details_id=business_details.id
	    left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
	    left join user_details udd on udd.user_id=assignments.marketing_user_id
		left join business_status on business_status.id = business_details.business_status_id
	    left join project_status on project_status.id = business_payments.project_status_id
	    left join business_campaign on business_campaign.business_package_id = business_payments.business_package_id                                             
	    left join business_packages on business_packages.business_package_id = business_payments.business_package_id 
	    left join campaigns on campaigns.id = business_campaign.campaign_id
	    left join packages on packages.id = business_packages.package_id
		WHERE business_details.id !=0".$userid.$city_id ." 
         GROUP BY (business_payments.business_package_id)
        ");     
	  return $searchreslutData;

	} 
      
     

	public function TodayDealcloseForTelemarketingDashboard($userid,$today){
             
         $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             // ->orWhere('address.city_id','=',$city_id)
	             ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;
        
}

function TotalDealcloseForTelemarketingDashboard($userid,$month){
	 $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"), '=',$month)
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;

	}

public function TodayDealcloseForMarketingDashboard($userid,$today,$city_id){
             
         $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	             ->Where('address.city_id','=',$city_id)
	             ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;
        
}

function TotalDealcloseForMarketingDashboard($userid,$month,$city_id){
	 $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where('business_payments_transaction.created_by', '=',$userid)
	              ->Where('address.city_id','=',$city_id)
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"), '=',$month)
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;

	}

public function TodayDealcloseForMarketingLeadDashboard($today,$useries){
             
         $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->WhereIn('business_payments_transaction.created_by',[$useries])
	             ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;
        
}

function TotalDealcloseForMarketingLeadDashboard($month,$useries){
	 $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->WhereIn('business_payments_transaction.created_by',[$useries])
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"), '=',$month)
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;

	}

	public function TodayDealcloseForAdminDashboard($today){
             
         $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where('business_payments_transaction.created_on', 'LIKE', '%' . $today .'%')
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;
        
}

function TotalDealcloseForAdminDashboard($month){
	 $query = self::join('address','address.id','=','business_details.address_id')
	             ->join('business_payments','business_payments.business_id','=','business_details.id')
	             ->join("business_payments_transaction","business_payments_transaction.business_payments_id","=","business_payments.id")
	             ->where('business_details.business_status_id', '=','4')
	             ->where(new raw("(DATE_FORMAT(business_payments_transaction.created_on,'%Y-%m'))"), '=',$month)
	             ->groupby('business_details.id')
	             ->get()
	             ->count();
		return $query;

	}

function BusinessListExport(){
           $searchData=Capsule::select("SELECT business_details.id,company_name,house_no,street,sub_area, area,landmark,pincode,person_name,landline_no,mobile_no,email,photo,cityname,state_name,alt_mobile_no,gst_company_name,gst_number,gst_state,gst_pincode,gst_pan_no,gst_address,website_url,facebook_url,twitter_url, youtube_url,linkedin_url,instagram_url,business_status_id,status_value,business_details.business_id,CONCAT(house_no , ' ',area, ' ',cityname , ' ',state_name) AS address_id,address.state_id,CONCAT(user_details.first_name,' ',user_details.last_name) as created_name,DATE_FORMAT(business_details.created_on, '%d-%m-%Y') as business_created_on,person_name,mobile_no
		from business_details
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
	    join states on states.state_id=address.state_id
	    join user_details on user_details.user_id=business_details.created_by 
	    left join business_status on business_status.id = business_details.business_status_id
		  WHERE business_details.id !=0 ");     
	return $searchData;

	}	

} 
?>