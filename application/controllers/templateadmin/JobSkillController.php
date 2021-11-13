<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class JobSkillController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('JobSkill_model');
			
		}	
 

  public function JobSkillView()
		{
          $this->load->view('templateadmin/jobskillview');
      }


public function editJobSkillsByid($id)
		{
	
	   $editJobSkills=$this->JobSkill_model->editJobSkills($id);
	   echo json_encode(array('success'=>true,'data'=>$editJobSkills));
     }


     public function updateJobSkillsByid(){

                $jobskill_id 					               =$this->input->post("edit_jobskill_id");
                $jobskill_name       			               = $this->input->post("edit_jobskill_name");
			    $jobskill_status       			               = $this->input->post("edit_jobskill_status"); 

				
           $postData=array();
		   $jobskillsdata = [];
           
         $postData = dataFieldValidation($jobskill_name, "JobSkills Name",$jobskillsdata,"jobskill_name","",$postData,"jobskillarray");
         $postData = dataFieldValidation($jobskill_status, "JobSkills Status",$jobskillsdata,"status","",$postData,"jobskillarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $jobskillarray = array_merge($postData['dbinput']['jobskillarray'],$updatedlog);
		$updateJobSkills = $this->JobSkill_model->UpdateJobSkills($jobskillarray,$jobskill_id);
            
             if($updateJobSkills){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateJobSkills));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveJobSkills(){

                $jobskill_name       			       = $this->input->post("add_jobskill_name");
                $jobskill_status       			       = $this->input->post("add_jobskill_status");
          
           $postData=array();
		   $jobskillsdata = [];
         $postData = dataFieldValidation($jobskill_name, "JobSkills Name",$jobskillsdata,"jobskill_name","",$postData,"jobskillarray");
         $postData = dataFieldValidation($jobskill_status, "JobSkills Status",$jobskillsdata,"status","",$postData,"jobskillarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	
       $jobskillarray = array_merge($postData['dbinput']['jobskillarray'],$createdlog);
       $addJobSkills=$this->JobSkill_model->AddJobSkills($jobskillarray);
            if($addJobSkills){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addJobSkills));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteJobSkillsById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteJobSkills = $this->JobSkill_model->DeleteJobSkills($id);
			   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function JobSkillsList()
		{
          
           $searchdata=$this->JobSkill_model->ListJobSkills();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>