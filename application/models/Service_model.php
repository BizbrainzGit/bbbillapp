<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Service_model extends Eloquent {
    public $timestamps = false;
    protected $table = "services"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['service_title', 'service_content','service_url', 'status','image','image_alt','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addservice($servicearray)
	{
		$addservice=self::create($servicearray);
		$addserviceid=$addservice->id;
		return $addserviceid;
	} 

	public function serviceList()
	{
		$listdata = self::get(['services.id','services.service_title', 'services.service_content', 'services.status']);
		return $listdata;
	} 
 
 public function serviceEdit($id)
	{
		$editdata = self::where('services.id','=',$id)->get(['services.id','services.service_title', 'services.service_content', 'services.status','services.image','services.image_alt','services.service_url']);
		return $editdata;
	}
  
public function serviceUpdate($servicearray,$id)
	{
		$updatedservice=self::where('services.id','=',$id)->update($servicearray);
		return $updatedservice;
	}

 public function serviceDelete($id)
	{
		$editdata = self::where('services.id','=',$id)->delete();
		return $editdata;
	}

	public function getServiceType()
	{
		$result=self::where('services.status','=','1')->get(['services.id','service_title','service_url']);
		return $result;
	} 


		public function serviceForForntView()
	{
		$result=self::where('services.status','=','1')->get(['services.id','service_url','service_title', 'service_content','services.image','services.image_alt']);
		return $result;
	} 
 
 
	
}
?>