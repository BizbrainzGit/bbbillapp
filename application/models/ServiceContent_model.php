<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class ServiceContent_model extends Eloquent {
    public $timestamps = false;
    protected $table = "servicecontents"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['id', 'servicecontent_type', 'bannertitle', 'bannercontent', 'bannerimage','bannerimage_alt', 'section1_heading', 'section1_content', 'section1_image', 'section1_image_alt','section2_heading', 'section2_content', 'section2_image','section2_image_alt', 'section3_heading', 'section3_content', 'section3_image','section3_image_alt', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addservicecontent($servicecontentarray)
	{
		$addservicecontent=self::create($servicecontentarray);
		return $addservicecontent;
	} 

	public function servicecontentList()
	{
		$listdata = self::join('services','services.id','=','servicecontents.servicecontent_type')->get(['servicecontents.id', 'servicecontents.bannertitle', 'servicecontents.status','service_title']);
		return $listdata;
	} 
 
 public function servicecontentEdit($id)
	{
		$editdata = self::where('servicecontents.id','=',$id)->get();
		return $editdata;
	}
  
public function servicecontentUpdate($servicecontentarray,$id)
	{
		$updatedservicecontent=self::where('servicecontents.id','=',$id)->update($servicecontentarray);
		return $updatedservicecontent;
	}

public function servicecontentDelete($id)
	{
		$editdata = self::where('servicecontents.id','=',$id)->delete();
		return $editdata;
	}
public function serviceContentForFullPage($id)
	{
		$result=self::where('servicecontents.servicecontent_type','=',$id)->where('servicecontents.status','=','1')->get(['servicecontents.id','bannertitle', 'bannercontent', 'bannerimage', 'section1_heading', 'section1_content', 'section1_image', 'section2_heading', 'section2_content', 'section2_image', 'section3_heading', 'section3_content', 'section3_image','section1_image_alt','section2_image_alt','section3_image_alt','bannerimage_alt']);
		return $result;
	} 


}
?>