<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Job_model extends Eloquent {
    public $timestamps = false;
    protected $table = "jobs"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['job_title', 'job_content', 'status','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
	public function addjob($jobarray)
	{
		$addjob=self::create($jobarray);
		$addjobid=$addjob->id;
		return $addjobid;
	} 

	public function jobList()
	{
		$listdata = self::get(['jobs.id','jobs.job_title', 'jobs.job_content', 'jobs.status']);
		return $listdata;
	} 
 
 public function jobEdit($id)
	{
		$editdata = self::join('selectedjobskills','selectedjobskills.job_id','=','jobs.id')->where('jobs.id','=',$id)->get(['jobs.id','jobs.job_title', 'jobs.job_content', 'jobs.status',new raw('GROUP_CONCAT(DISTINCT(selectedjobskills.job_skill_id)) as job_skill_id')]);
		return $editdata;
	}
  
public function jobUpdate($jobarray,$id)
	{
		$updatedjob=self::where('jobs.id','=',$id)->update($jobarray);
		return $updatedjob;
	}

 public function jobDelete($id)
	{
		$editdata = self::where('jobs.id','=',$id)->delete();
		return $editdata;
	}


		public function jobdataForForntView()
	{
		$result=self::join('selectedjobskills','selectedjobskills.job_id','=','jobs.id')->join('jobskills','jobskills.id','=','selectedjobskills.job_skill_id')->where('jobs.status','=','1')->groupBy('jobs.id')->get(['jobs.id','job_title', 'job_content',new raw('GROUP_CONCAT(DISTINCT(	jobskill_name)) as 	jobskill_name')]);
		return $result;
	} 
 
 	public function getjoblistForApplyForntView()
	{
		$result=self::join('selectedjobskills','selectedjobskills.job_id','=','jobs.id')->where('jobs.status','=','1')->groupBy('jobs.id')->get(['jobs.id','job_title']);
		return $result;
	} 
	
}
?>