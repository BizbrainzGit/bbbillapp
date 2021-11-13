<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class Project_model extends Eloquent {
    public $timestamps = false;
    protected $table = "projects"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['project_type', 'project_title', 'project_url','project_category', 'status','image','image_alt','certification_image','certification_image_alt','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addproject($projectarray)
	{
		$addproject=self::create($projectarray);
		return $addproject;
	} 

	public function projectList()
	{
		$listdata = self::get(['projects.id','projects.project_type', 'projects.project_title', 'projects.project_url', 'projects.status','projects.image']);
		return $listdata;
	} 
 
 public function projectEdit($id)
	{
		$editdata = self::where('projects.id','=',$id)->get();
		return $editdata;
	}
  
public function projectUpdate($projectarray,$id)
	{
		$updatedproject=self::where('projects.id','=',$id)->update($projectarray);
		return $updatedproject;
	}

public function projectDelete($id)
	{
		$editdata = self::where('projects.id','=',$id)->delete();
		return $editdata;
	}



public function OurProjectForHome()
	{
		$result=self::where('projects.project_type','=','1')->where('projects.status','=','1')->orderBy('projects.id', 'DESC')->limit(4)->get(['projects.id','project_title', 'project_url', 'status','image','certification_image','image_alt','certification_image_alt']);
		return $result;
	} 
public function OurProductsForOurProductsPage()
	{
		$result=self::where('projects.project_type','=','1')->where('projects.status','=','1')->orderBy('projects.id', 'DESC')->get(['projects.id','project_title', 'project_url', 'status','image','certification_image','image_alt','certification_image_alt']);
		return $result;
	} 
public function ClientProjectForHome()
	{
		$result=self::where('projects.project_type','=','2')->where('projects.status','=','1')->orderBy('projects.id', 'DESC')->limit(4)->get(['projects.id','project_title', 'project_url', 'status','image','certification_image','image_alt','certification_image_alt']);
		return $result;
	}
public function ClientProductsForOurProductsPage()
	{
		$result=self::where('projects.project_type','=','2')->where('projects.status','=','1')->orderBy('projects.id', 'DESC')->get(['projects.id','project_title', 'project_url', 'status','image','certification_image','image_alt','certification_image_alt']);
		return $result;
	}

public function SearchClientProductsForOurProductsPage($category_id)
	{
		$result=self::where('projects.project_type','=','2')->where('projects.status','=','1')->where('projects.project_category','=',$category_id)->orderBy('projects.id', 'DESC')->get(['projects.id','project_title', 'project_url', 'status','image','certification_image','image_alt','certification_image_alt']);
		return $result;
	}
 public function clientproductsCountForDashboard()
	{
		$resultcount =self::where('projects.project_type','=','2')->count();
		return $resultcount;
	}
}
?>