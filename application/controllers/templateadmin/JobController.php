<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class JobController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Job_model');
			$this->load->model('SelectedJobSkills_model');
			
		}	
 
  public function JobView()
		{
		$this->load->view('templateadmin/jobsview');
		}
     
     public function JobList()
	   {
		    $searchlist = $this->Job_model->jobList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveJob(){
                         
             
            $job_content     	       = $this->input->post("add_job_content");
			$job_title                  = $this->input->post("add_job_title");
		    $job_status		           = $this->input->post("add_job_status");
            $job_skill     	           = $this->input->post("add_job_skill");
           
      
        $postData=array();
		$jobdata = [];
       
        $postData = dataFieldValidation($job_title, "Title",$jobdata,"job_title","","jobarray");
        $postData = dataFieldValidation($job_content, "Content",$jobdata,"job_content","", $postData,"jobarray");
		$postData = dataFieldValidation($job_status,"Status",$jobdata,"status","", $postData,"jobarray"); 


		if(isset($job_skill) && !empty($job_skill))
            {
    	        $jobskills=[];
			    foreach($job_skill as $key=>$data)
			    {
			      $job_skill_id  = $data;
			      $postData = dataFieldValidation($job_skill_id, "service name", $jobskills, "job_skill_id", "", $postData, "jobskillarray".$key); 

			    }
            }
		
		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
        $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $jobarray = array_merge($postData['dbinput']['jobarray'],$createdlog);
        $addjob = $this->Job_model->addjob($jobarray); 

        if(isset($job_skill) && !empty($job_skill))
            {
			    foreach($job_skill as $key=>$data)
			    {
			        $job_skill_id  = $data;
			        $selectedJobSkill=array('job_id'=>$addjob,'job_skill_id'=>$job_skill_id);
			        $jobskillId=$this->SelectedJobSkills_model->addSelectedJobSkill($selectedJobSkill);
			    }
            }


       if($addjob){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function jobEditById($id){ 
                     if(isset($id)&&$id>0){
		       	 $editjob = $this->Job_model->jobEdit($id);
			      echo json_encode(array('success'=>true,'data'=>$editjob));
			       }else{
		         echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}
          }


public function updateJob(){
                         
                $id      	                    = $this->input->post("edit_job_id");
                $job_skill     	                = $this->input->post("edit_job_skill");   
                $job_content     	            = $this->input->post("edit_job_content");
				$job_title        	            = $this->input->post("edit_job_title");
				$job_status		                = $this->input->post("edit_job_status");

         
      
      $postData=array();
		$jobdata = [];
        
        $postData = dataFieldValidation($job_title, "Title",$jobdata,"job_title","","jobarray");
        $postData = dataFieldValidation($job_content, "Content",$jobdata,"job_content","", $postData,"jobarray");
		$postData = dataFieldValidation($job_status,"Status",$jobdata,"status","", $postData,"jobarray"); 

		if(isset($job_skill) && !empty($job_skill))
			{   $jobskills=[];
			    foreach($job_skill as $key=>$data)
			    {
			   $job_skill_id  = $data;
			   $postData = dataFieldValidation($job_skill_id, "service name", $jobskills, "job_skill_id", "", $postData, "jobskillarray".$key);
			    }
			    
			 }
		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $jobarray = array_merge($postData['dbinput']['jobarray'],$updatedlog);
        $updatejob = $this->Job_model->jobUpdate($jobarray,$id); 

         if(isset($job_skill) && !empty($job_skill))
               {  
               	$deleteSelectedJobSkill=$this->SelectedJobSkills_model->deleteSelectedJobSkill($id);
                if($deleteSelectedJobSkill){
	                    foreach($job_skill as $key=>$data)
				    {   $job_skill_id  = $data;
	                    $selectedJobSkill=array('job_id'=>$id,'job_skill_id'=>$job_skill_id);
				        $jobskillId=$this->SelectedJobSkills_model->addSelectedJobSkill($selectedJobSkill);
				    }
                }else{
	                	 foreach($job_skill as $key=>$data)
				    {   $job_skill_id  = $data;
	                    $selectedJobSkill=array('job_id'=>$id,'job_skill_id'=>$job_skill_id);
				        $jobskillId=$this->SelectedJobSkills_model->addSelectedJobSkill($selectedJobSkill);
				    }
                }
		      }	

                      if($updatejob && $jobskillId){
								echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
										return;
						    }else{
								echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
			                }	
            }


public function deleteJobById($id){ 
                     if(isset($id)&&$id>0){
		       	    $deleteMenus = $this->Job_model->jobDelete($id);
		       	 	$deleteSelectedJobSkill=$this->SelectedJobSkills_model->deleteSelectedJobSkill($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>