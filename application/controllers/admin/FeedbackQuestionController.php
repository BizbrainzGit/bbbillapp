<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class FeedbackQuestionController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('FeedbackQuestion_model');
			$this->load->model('FeedbackQuestionOption_model');
		}	
 

  public function feedbackquestionView()
		{
          $this->load->view('admin/feedbackquestionview');
      }

public function listFeedbackQuestion()
		{
	
      $ResultList=$this->FeedbackQuestion_model->FeedbackquestionList();
	   echo json_encode(array('success'=>true,'data'=>$ResultList));
	   return;
     }

public function editFeedbackquestionByid($id)
		{
	
	   $editCity=$this->FeedbackQuestion_model->EditFeedbackquestion($id);
	   echo json_encode(array('success'=>true,'data'=>$editCity));
	   return;
     }


     public function updateFeedbackquestionByid(){

                $id 					               =$this->input->post("edit_feedbackquestion_id");
                $option_id 					           =$this->input->post("edit_feedbackoption_id");

                $feedback_question       			           = $this->input->post("edit_feedback_question");
                $feedback_option       			               = $this->input->post("edit_feedback_option"); 
			    $feedback_status       			               = $this->input->post("edit_feedback_status"); 
				
           $postData=array();
		   $feedbackquestiondata = [];
           $feedbackoptiondata = [];
           
         $postData = dataFieldValidation($feedback_question, "Feedback Question",$feedbackquestiondata,"question",[ValidationTypes::REQUIRED],$postData,"feedbackquestionarray");
         
          $postData = dataFieldValidation($feedback_status, "Feedback Question Status",$feedbackquestiondata,"status",[ValidationTypes::REQUIRED],$postData,"feedbackquestionarray");
  
         
         $postData = dataFieldValidation($feedback_option,"Feedback Option Value",$feedbackoptiondata,"value",[ValidationTypes::REQUIRED],$postData,"feedbackoptionarray");

      
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
          $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);	 
 
			       $feedbackQuestionarray = array_merge($postData['dbinput']['feedbackquestionarray'],$updatedlog);
			       $updateFeedbackQuestion= $this->FeedbackQuestion_model->Updatefeedbackquestion($feedbackQuestionarray,$id);
			     
                  $feedbackOptionarray = array_merge($postData['dbinput']['feedbackoptionarray'],$updatedlog);
			      $updateFeedbackOption= $this->FeedbackQuestionOption_model->Updatefeedbackoption($feedbackOptionarray,$option_id);
			        

            
            
             if($updateFeedbackOption||$updateFeedbackQuestion){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveFeedbackQuestion(){

               
                $feedback_question       			           = $this->input->post("add_feedback_question");
                $feedback_option       			               = $this->input->post("add_feedback_option"); 
			    $feedback_status       			               = $this->input->post("add_feedback_status"); 
				
           $postData=array();
		   $feedbackquestiondata = [];
           $feedbackoptiondata = [];
           
         $postData = dataFieldValidation($feedback_question, "Feedback Question",$feedbackquestiondata,"question",[ValidationTypes::REQUIRED],$postData,"feedbackquestionarray");
         
          $postData = dataFieldValidation($feedback_status, "Feedback Question Status",$feedbackquestiondata,"status",[ValidationTypes::REQUIRED],$postData,"feedbackquestionarray");
  
         
         $postData = dataFieldValidation($feedback_option,"Feedback Option Value",$feedbackoptiondata,"value",[ValidationTypes::REQUIRED],$postData,"feedbackoptionarray");

      
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
          $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId);	 
 
			       $feedbackQuestionarray = array_merge($postData['dbinput']['feedbackquestionarray'],$createdlog);
			       $addFeedbackQuestion= $this->FeedbackQuestion_model->Addfeedbackquestion($feedbackQuestionarray);
			     
                  $feedbackOptionarray = array_merge(array('question_id'=>$addFeedbackQuestion),$postData['dbinput']['feedbackoptionarray'],$createdlog);

			      $addFeedbackOption= $this->FeedbackQuestionOption_model->Addfeedbackoption($feedbackOptionarray);
			    
                   if($addFeedbackQuestion && $addFeedbackOption){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			        }
			     else
					{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}

            }

public function deleteFeedbackquestionById(){ 

                          $id 					               =$this->input->post("delete_feedbackquestion_id");
                         $option_id 					           =$this->input->post("delete_feedbackoption_id");

               if(isset($id)&&$id>0 && isset($option_id)&&$option_id>0 ){

                        //$question_id=FeedbackQuestion_model::where('id','=',$id)->get(['id']);
				        
				       
				       	$deleteOption = $this->FeedbackQuestionOption_model->DeleteFeedbackoption($option_id);
                        $deleteQuestion = $this->FeedbackQuestion_model->DeleteFeedbackquestion($id);

					   if($deleteQuestion && $deleteOption ){
					   	         echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
					   	         return;
					     }else{
		                         echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
		                      }
				   }else{

			       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
				}
                    

         }








}
?>