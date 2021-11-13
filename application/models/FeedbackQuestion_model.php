<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class FeedbackQuestion_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="feedback_questions";
      public $PrimaryKey='id';
      protected $Filables=['question', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

		
		
  function Addfeedbackquestion($feedbackarray)
	{
		$addresult=self::create($feedbackarray);
		$questionid=$addresult->id;
		return $questionid;
	} 


function EditFeedbackquestion($id)
	{
		$editresult=self::join('feedback_question_options','feedback_question_options.question_id','=','feedback_questions.id')->where('feedback_questions.id','=',$id)->get(['feedback_questions.id','feedback_questions.question','feedback_questions.status',new raw('feedback_question_options.id as optionid'),'feedback_question_options.value']);
		return $editresult;
	} 

function FeedbackquestionList()
	{
		$datalistresult=self::join('feedback_question_options','feedback_question_options.question_id','=','feedback_questions.id')->get(['feedback_questions.id','feedback_questions.question','feedback_questions.status',new raw('feedback_question_options.id as optionid'),'feedback_question_options.value']);
		return $datalistresult;
	}	



function Updatefeedbackquestion($feedbackQuestionarray,$id){

	$updateresult=self::where('id','=',$id)->update($feedbackQuestionarray);
    return $updateresult;
        
        }


function DeleteFeedbackquestion($id){
	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        }
 
 function FeedbackquestionForBusiness()
	{
		$datalistresult=self::join('feedback_question_options','feedback_question_options.question_id','=','feedback_questions.id')->get(['feedback_questions.id','feedback_questions.question','feedback_questions.status',new raw('feedback_question_options.id as optionid'),'feedback_question_options.value']);
		return $datalistresult;
	}	


} 
?>