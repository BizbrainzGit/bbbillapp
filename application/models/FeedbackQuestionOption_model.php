<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class FeedbackQuestionOption_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="feedback_question_options";
      public $PrimaryKey='id';
      protected $Filables=['question_id', 'value', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

		
  function Addfeedbackoption($feedbackOptionarray)
	{
		$addresult=self::create($feedbackOptionarray);
		return $addresult;
	} 

function Updatefeedbackoption($feedbackOptionarray,$option_id){

	$updateresult=self::where('id','=',$option_id)->update($feedbackOptionarray);
    return $updateresult;
        
        }

function DeleteFeedbackoption($option_id){
	$deleteresult=self::where('feedback_question_options.id','=',$option_id)->delete();
    return $deleteresult;
        }        


} 
?>