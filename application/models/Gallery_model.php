<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class Gallery_model extends Eloquent {
    public $timestamps = false;
    protected $table = "gallery"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['gallery_type', 'gallery_title','status','image','image_alt','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addgallery($galleryarray)
	{
		$addgallery=self::create($galleryarray);
		return $addgallery;
	} 

   

	public function galleryList()
	{
		$listdata = self::join('gallerytypes','gallerytypes.id','=','gallery.gallery_type')->get(['gallery.id','gallery.gallery_type', 'gallery.gallery_title','gallery.image_alt','gallery.status','gallery.image','gallerytype_name']);
		return $listdata;
	} 
 
 public function galleryEdit($id)
	{
		$editdata = self::where('gallery.id','=',$id)->get();
		return $editdata;
	}
  
public function galleryUpdate($galleryarray,$id)
	{
		$updatedgallery=self::where('gallery.id','=',$id)->update($galleryarray);
		return $updatedgallery;
	}

public function galleryDelete($id)
	{
		$editdata = self::where('gallery.id','=',$id)->delete();
		return $editdata;
	}

		public function gallerydataForForntView()
	{
		// $result=self::join('gallerytypes','gallerytypes.id','=','gallery.gallery_type')->where('gallery.status','=','1')->offset($page)->limit($limit)->get(['gallery.id','gallery.gallery_type', 'gallery.gallery_title','gallery.status','gallery.image','gallerytype_name']);
		// return $result;

		$result=self::join('gallerytypes','gallerytypes.id','=','gallery.gallery_type')->where('gallery.status','=','1')->get(['gallery.id','gallery.gallery_type', 'gallery.gallery_title','gallery.status','gallery.image','gallerytype_name','image_alt']);
		return $result;
	} 
  
   public function GalleryCountForDashboard()
	{
		$countresultgallery=self::count();
		return $countresultgallery;
	}
	
}
?>