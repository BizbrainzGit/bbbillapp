<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Leads_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="prospect_leads";
      public $PrimaryKey='id';
      protected $Filables=['name','email','phone_number','bussiness_name','message','status','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];
		
  function Addleads($leadsarray){
		$addresult=self::create($leadsarray);
		return $addresult;
	} 

function LeadsList(){
		
		$datalistresult=self::leftjoin('user_details','user_details.user_id','=','prospect_leads.modified_by')->get(['prospect_leads.id','prospect_leads.name','prospect_leads.email','prospect_leads.phone_number','prospect_leads.bussiness_name','prospect_leads.message','prospect_leads.status',new raw("CONCAT(first_name,'',last_name) as employeename"),new raw('DATE_FORMAT(prospect_leads.modified_on, "%d-%m-%Y") as modified_on')]);
		return $datalistresult;
	}	
	function updateStatus($statusarray, $status_change_id){

	$resultupdate=self::where('id','=',$status_change_id)->update($statusarray);
        return $resultupdate;

		}


 

} 
?>