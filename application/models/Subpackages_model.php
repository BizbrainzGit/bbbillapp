<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class Subpackages_model extends Eloquent {
    public $timestamps = false;
    protected $table = "sub_packages"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['sublist_name','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
    
    
public function SubpackagesList()
	{
		$result=self::get();
		return $result;
	}
		
  function AddSubPackage($subpackagearray)
	{
		$addresult=self::create($subpackagearray);
		return $addresult;
	} 

  function SubPackageList()
	{
		$datalistresult=self::groupBy('sub_packages.id')->get(['sub_packages.id','sublist_name']);
		return $datalistresult;
	}

 function EditSubPackage($id)
	{
		$editresult=self::where('sub_packages.id','=',$id)->groupBy('sub_packages.id')->get(['sub_packages.id','sub_packages.sublist_name']);
		return $editresult;
	} 

  public function SubPackageUpdate($subpackagearray,$id)
      {
        $updateresult=self::where('sub_packages.id','=',$id)->update($subpackagearray);
        return $updateresult;
      }

    
function DeleteSubPackage($id)
    {
	$deleteresult=self::where('sub_packages.id','=',$id)->delete();
       return $deleteresult;
    }  



}
?>