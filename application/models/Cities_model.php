<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
 
class Cities_model extends Eloquent {
    public $timestamps = false;
    protected $table = "cities"; // table name
    public $primaryKey = 'cityid';
    protected $fillable = [ 'cityname', 'state_id', 'latitude', 'longitude', 'short_code', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

   public function CityList()
	{
		$result=self::where('status','=',1)->orderBy('cityname')->get();
		return $result;
	}
	
	public function SelectedCityList($city_id)
	{
		$result=self::where('cities.id',$city_id)->get();
		return $result;
	}


	function AddCity($citysarray)
	{
		$addresult=self::create($citysarray);
		return $addresult;
	} 


function EditCity($id)
	{
		$editresult=self::where('cities.cityid','=',$id)->get();
		return $editresult;
	} 

function AllCitiesList()
	{
		$datalistresult=self::join('states','states.state_id','=','cities.state_id') 
		->get(['cities.cityid','cityname','states.state_id','latitude','longitude','short_code','status','states.state_name']);
		return $datalistresult;
	}	

function UpdateCity($citysarray, $city_id){

	$resultupdate=self::where('cityid','=',$city_id)->update($citysarray);
                return $resultupdate;
		}

function DeleteCity($id){
	$deleteresult=self::where('cityid','=',$id)->delete();
    return $deleteresult;
        	}
	
 
}
?>