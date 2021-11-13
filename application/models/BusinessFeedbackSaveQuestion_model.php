<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class BusinessFeedbackSaveQuestion_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "business_feedback_questions"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_feedbackid','question_id','option_id'];

    

	public function addBusinessFeedbackQuestion($feedbackqueArray)
	{
		$addresult=self::create($feedbackqueArray);
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

