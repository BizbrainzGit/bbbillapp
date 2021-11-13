<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
class CountList_model extends Eloquent {
    public $timestamps = false;
    protected $table = "countlists"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['establishedyear', 'projectcount', 'clientcount','teamcount', 'status','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addcountlist($countlistarray)
	{
		$addcountlist=self::create($countlistarray);
		return $addcountlist;
	} 

	public function countlistList()
	{
		$listdata = self::get(['countlists.id','countlists.establishedyear', 'countlists.projectcount', 'countlists.clientcount', 'countlists.status', 'countlists.teamcount']);
		return $listdata;
	} 
 
 public function countlistEdit($id)
	{
		$editdata = self::where('countlists.id','=',$id)->get();
		return $editdata;
	}
  
public function countlistUpdate($countlistarray,$id)
	{
		$updatedcountlist=self::where('countlists.id','=',$id)->update($countlistarray);
		return $updatedcountlist;
	}

public function countlistDelete($id)
	{
		$editdata = self::where('countlists.id','=',$id)->delete();
		return $editdata;
	}



public function CountListForFrontViewAbout()
	{
		$result=self::where('countlists.status','=','1')->orderBy('countlists.id', 'DESC')->limit(1)->get(['countlists.id','countlists.establishedyear', 'countlists.projectcount', 'countlists.clientcount', 'countlists.status','countlists.teamcount']);
		return $result;
	} 


}
?>