<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
class SelectedJobSkills_model extends Eloquent{
	
    public $timestamps = false;
    protected $table = "selectedjobskills"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['job_id','job_skill_id'];

	public function addSelectedJobSkill($selectedJobSkill)
	{
		$createservice=self::create($selectedJobSkill);
		
		return $createservice;
	} 
	
	public function deleteSelectedJobSkill($job_id)
	{
		$updateaddress=self::where('job_id','=',$job_id)->delete();
		return $updateaddress;
	}
}
?>