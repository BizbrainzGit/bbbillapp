<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class BusinessEmp_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "business_emp"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id', 'emp_name', 'emp_role', 'emp_mobile', 'emp_email'];

    

	public function addBusinessemployee($businessemparray)
	{
		$createbusiness_emp=self::create($businessemparray);
		$business_empid=$createbusiness_emp->id;
		return $business_empid;
	} 
	public function deleteBusinessemployee($business_id)
	{
		$deletebusiness_owners=self::where('business_emp.business_id','=',$business_id)->delete();
		return $deletebusiness_owners;
	}  

	public function editBusinessemp($id)
	{
		$deletebusiness_owners=self::where('business_emp.business_id','=',$id)->get();
		return $deletebusiness_owners;
	} 
	
}
?>

