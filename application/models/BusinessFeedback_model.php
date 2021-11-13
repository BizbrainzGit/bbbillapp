<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class BusinessFeedback_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "business_feedbackdetails"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id', 'marketing_userid', 'comments'];

    

	public function addBusinessFeedback($businessfeedbackaarray)
	{
		$addresult=self::create($businessfeedbackaarray);
		$feedback_id=$addresult->id;
		return $feedback_id;
	} 
	// public function deleteBusinessemployee($business_id)
	// {
	// 	$deletebusiness_owners=self::where('business_emp.business_id','=',$business_id)->delete();
	// 	return $deletebusiness_owners;
	// }  

	// public function editBusinessemp($id)
	// {
	// 	$deletebusiness_owners=self::where('business_emp.business_id','=',$id)->get();
	// 	return $deletebusiness_owners;
	// } 
	
}
?>

