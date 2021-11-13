<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class CityMapping_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="user_city_mapping";
      public $PrimaryKey='id';
      protected $Filables=['marketlead_user_id', 'user_id', 'city_mapping_id', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];


		
		
  function Addcitymapping($citymappingarray)
	{
		$addresult=self::create($citymappingarray);
		return $addresult;
	} 


function EditCitymapping($id)
	{
		$editresult=self::where('user_city_mapping.user_id','=',$id)->groupBy('user_city_mapping.user_id')->get(['user_city_mapping.id','user_city_mapping.marketlead_user_id','user_city_mapping.user_id',new raw('GROUP_CONCAT(DISTINCT(city_mapping_id)) as city_mapping_id')]);
		return $editresult;
	} 

function CitymappingList()
	{
		$datalistresult=self::join('user_details','user_details.user_id','=','user_city_mapping.marketlead_user_id')->leftjoin('user_details as ud','ud.user_id','=','user_city_mapping.user_id')->leftjoin('cities','cities.cityid','=','user_city_mapping.city_mapping_id')->groupBy('user_city_mapping.user_id')->get(['user_city_mapping.id','user_city_mapping.user_id',new raw('GROUP_CONCAT(DISTINCT(cityname)) as city_mapping_name')
			,new raw('CONCAT(user_details.first_name," ",user_details.last_name) as marketlead_user_name'),new raw('CONCAT(ud.first_name," ",ud.last_name) as user_name')]);
		return $datalistresult;
	}	



function DeleteCitymapping($user_id){

	$deleteresult=self::where('user_id','=',$user_id)->delete();
    return $deleteresult;
        
        }
       
function CitySelectedCount($id){

 //$countofcitydata=self::where('user_city_mapping.user_id','=',$id)->groupBy('user_city_mapping.user_id')->get(['user_city_mapping.id','user_city_mapping.user_id',new raw('Count(city_mapping_id) as citycount'),new raw('GROUP_CONCAT(DISTINCT(city_mapping_id)) as city_mapping_id')]);
	$countofcitydata=self::join('cities','cities.cityid','=','user_city_mapping.city_mapping_id')->where('user_city_mapping.user_id','=',$id)->get(['cities.cityid','cities.cityname']);

return $countofcitydata;
}


function MarkrtingUsersListForAssignment($cityid)
	{
		$result=self::join('user_details','user_details.user_id','=','user_city_mapping.user_id')
		             ->join('users','users.id','=','user_details.user_id')
		             ->join('groups','groups.id','=','users.role_id')
		             ->where('users.active','=','1')
		             ->where('user_city_mapping.city_mapping_id','=',$cityid)->get(['user_city_mapping.id','user_city_mapping.user_id',new raw('CONCAT(user_details.first_name," ",user_details.last_name) as user_name'),'groups.designation']);
		return $result;
	}


} 
?>