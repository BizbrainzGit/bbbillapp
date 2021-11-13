<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class ClientLogo_model extends Eloquent {
    public $timestamps = false;
    protected $table = "clientlogos"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['clientlogo_title', 'clientlogo_url','status','clientlogo_image','clientlogo_image_alt','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addclientlogo($clientlogoarray)
	{
		$addclientlogo=self::create($clientlogoarray);
		return $addclientlogo;
	} 

	public function clientlogoList()
	{
		$listdata = self::get(['clientlogos.id', 'clientlogos.clientlogo_title', 'clientlogos.clientlogo_url', 'clientlogos.status','clientlogos.clientlogo_image','clientlogos.clientlogo_image_alt']);
		return $listdata;
	} 
 
 public function clientlogoEdit($id)
	{
		$editdata = self::where('clientlogos.id','=',$id)->get();
		return $editdata;
	}
  
public function clientlogoUpdate($clientlogoarray,$id)
	{
		$updatedclientlogo=self::where('clientlogos.id','=',$id)->update($clientlogoarray);
		return $updatedclientlogo;
	}

public function clientlogoDelete($id)
	{
		$editdata = self::where('clientlogos.id','=',$id)->delete();
		return $editdata;
	}



public function OurClientLogoForFontView()
	{
		$result=self::where('clientlogos.status','=','1')->orderBy('clientlogos.id', 'DESC')->get(['clientlogos.id','clientlogo_title', 'clientlogo_url', 'status','clientlogo_image','clientlogo_image_alt']);
		return $result;
	} 
 public function clientlogoCountForDashboard()
	{
		$resultcount =self::count();
		return $resultcount;
	}

}
?>