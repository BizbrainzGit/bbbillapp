<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class Services_model extends Eloquent {
    public $timestamps = false;
    protected $table = "services"; // table name
    public $primaryKey = 'id';
    protected $fillable = [ 'title','image','status','content','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addservice($servicearray)
	{
		$addresult=self::create($servicearray);
		return $addresult;
	} 

	public function servicesDatalist()
	{
		$listresult=Capsule::select("SELECT id ,title,image,status,content from services ");
		return $listresult;
	} 
 
 public function servicesEdit($id)
	{
		$editdata = self::where('services.id','=',$id)->get();
	    return $editdata;
	}
  
public function servicesUpdate($servicearray,$id)
	{
		$updateresult=self::where('services.id','=',$id)->update($servicearray);
		return $updateresult;
	}

	public function servicesAllView()
	{
		$result=self::where('services.status','=','1')->get();
		return $result;
	}
 
 public function getServicesCount(){
		$resutdata=self::count();
		return $resutdata;
	}



}
?>