<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class Content_model extends Eloquent {
    public $timestamps = false;
    protected $table = "content"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['content_type', 'title','image','status','contentdata'];
	
	public function addcontent($contentarray)
	{
		$addcontent=self::create($contentarray);
		return $addcontent;
	} 

	public function contentDatalist()
	{
		$searchUserData=Capsule::select("SELECT g.id ,g.title,g.image,g.status,menu_type.menu_type_name,contentdata from content g left join menu_type on menu_type.id= g.content_type");
		return $searchUserData;
	} 
 
 public function contentEdit($id)
	{
		$editdata = self::join('menu_type','menu_type.id','=','content.content_type')
		->where('content.id','=',$id)->get();
	
		return $editdata;
	}
  
 public function contentUpdate($contentarray,$id)
	{
		$updatedcontent=self::where('content.id','=',$id)->update($contentarray);
		return $updatedcontent;
	}

 public function contentdataView($id)
	{
		$result=self::join('menu_type','menu_type.id','=','content.content_type')->where('content.status','=','1')->where('content.content_type','=',$id)->get(['content.id','content_type','title', 'image', 'status', 'contentdata']);
		return $result;
	} 



}
?>