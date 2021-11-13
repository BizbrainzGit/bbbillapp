<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class Project_status_model extends Eloquent {
    public $timestamps = false;
    protected $table = "project_status"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['status'];
   

   public function ProjectStatusList()
	{
		$result=self::orderBy('status')->get();
		return $result;
	}
	
 
}
?>