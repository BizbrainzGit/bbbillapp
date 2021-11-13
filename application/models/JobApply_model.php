<?php 
 use \Illuminate\Database\Eloquent\Model as Eloquent;
 use Illuminate\Database\Capsule\Manager as Capsule;
 use Illuminate\Database\Query\Expression as raw;
class JobApply_model extends Eloquent {
    public $timestamps = false;
    protected $table = "jobapply_details"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['job_id', 'first_name', 'last_name', 'email', 'mobileno', 'qualification','resume', 'address', 'message', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addapplyjob($applyjobarray)
	{
		$addapplyjob=self::create($applyjobarray);
		return $addapplyjob;
	} 

	public function applyjobdetailsList()
	{
		$listdata = self::join('jobs','jobs.id','=','jobapply_details.job_id')
		       ->get(['jobapply_details.id','email','mobileno','qualification','resume','job_title', 'address', 'message',new raw("concat(first_name,' ',last_name) as name")]);
		return $listdata;
	} 
 public function applyjobCountForDashboard()
	{
		$resultcount =self::count();
		return $resultcount;
	}
 
	
}
?>