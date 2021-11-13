<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class Banner_model extends Eloquent {
    public $timestamps = false;
    protected $table = "banner"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['menu_id', 'banner_title', 'banner_content', 'status','image','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addbanner($bannerarray)
	{
		$addbanner=self::create($bannerarray);
		return $addbanner;
	} 

	public function bannerList()
	{
		$listdata = self::join('menus','menus.id','=','banner.menu_id')->get(['banner.id','banner.menu_id', 'banner.banner_title', 'banner.banner_content', 'banner.status','banner.image','menu_name']);
		return $listdata;
	} 
 
 public function bannerEdit($id)
	{
		$editdata = self::where('banner.id','=',$id)->get();
		return $editdata;
	}
  
public function bannerUpdate($bannerarray,$id)
	{
		$updatedbanner=self::where('banner.id','=',$id)->update($bannerarray);
		return $updatedbanner;
	}

public function bannerDelete($id)
	{
		$editdata = self::where('banner.id','=',$id)->delete();
		return $editdata;
	}

public function bannerForFontView($id)
	{
		$result=self::where('banner.menu_id','=',$id)->where('banner.status','=','1')->orderBy('banner.id', 'DESC')->get();
		return $result;
	}


	
}
?>