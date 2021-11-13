<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class BuyNowimg_model extends Eloquent {
    public $timestamps = false;
    protected $table = "buynowimgs"; // table name
    public $primaryKey = 'id';
    protected $fillable = [ 'buynowimg_title',  'status','image','image_alt','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addbuynowimg($buynowimgarray)
	{
		$addbuynowimg=self::create($buynowimgarray);
		return $addbuynowimg;
	} 

	public function buynowimgList()
	{
		$listdata = self::get(['buynowimgs.id', 'buynowimgs.buynowimg_title','buynowimgs.image_alt',  'buynowimgs.status','buynowimgs.image']);
		return $listdata;
	} 
 
 public function buynowimgEdit($id)
	{
		$editdata = self::where('buynowimgs.id','=',$id)->get();
		return $editdata;
	}
  
public function buynowimgUpdate($buynowimgarray,$id)
	{
		$updatedbuynowimg=self::where('buynowimgs.id','=',$id)->update($buynowimgarray);
		return $updatedbuynowimg;
	}

public function buynowimgDelete($id)
	{
		$editdata = self::where('buynowimgs.id','=',$id)->delete();
		return $editdata;
	}



public function BuyNowimgForFontviewHome()
	{
		$result=self::where('buynowimgs.status','=','1')->orderBy('buynowimgs.id', 'DESC')->get(['buynowimgs.id','buynowimg_title','status','image','image_alt']);
		return $result;
	} 


}
?>