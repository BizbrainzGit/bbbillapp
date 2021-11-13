<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class GForm_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="gform_data";
      public $PrimaryKey='id';
      protected $Filables=['company_name','contact_personname','mobileno','email','business_keywords','working_hours','house_no','area','landmark','pincode','city_id','state_id','photo','created_date','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];


			
		
  function AddGformData($gformarray){
		$addresult=self::create($gformarray);
		$addgformid=$addresult->id;
		return $addgformid;
		
	} 

 function listGFormData(){
		$addresult=self::leftjoin('cities','cities.cityid','=','gform_data.city_id')
		               ->leftjoin('states','states.state_id','=','gform_data.state_id')
		               ->join('users','users.id','=','gform_data.created_by')
		               ->join('user_details','user_details.user_id','=','users.id')
		               ->get(['gform_data.id','gform_data.company_name','contact_personname','gform_data.mobileno','gform_data.email','business_keywords','working_hours','house_no','area','landmark','pincode','cityname','state_name', new raw('DATE_FORMAT(gform_data.created_on, "%d-%m-%Y <br> %l:%i %p") as created_date'),new raw('CONCAT(user_details.first_name ," ",user_details.last_name) as user_name')]);
		return $addresult;
	}
 


} 
?>