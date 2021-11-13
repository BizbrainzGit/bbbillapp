<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class ProjectCategoryController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('ProjectCategory_model');
			
		}	
 

  public function projectcategoryView()
		{
          $this->load->view('templateadmin/projectcategoryview');
      }


public function editProjectCategorysByid($id)
		{
	
	   $editProjectCategorys=$this->ProjectCategory_model->editProjectCategorys($id);
	   echo json_encode(array('success'=>true,'data'=>$editProjectCategorys));
     }


     public function updateProjectCategorysByid(){

                $projectcategory_id 					               =$this->input->post("edit_projectcategory_id");
                $projectcategory_name       			               = $this->input->post("edit_projectcategory_name");
			    $projectcategory_status       			               = $this->input->post("edit_projectcategory_status"); 

				
           $postData=array();
		   $projectcategorysdata = [];
           
         $postData = dataFieldValidation($projectcategory_name, "ProjectCategorys Name",$projectcategorysdata,"projectcategory_name","",$postData,"projectcategoryarray");
         $postData = dataFieldValidation($projectcategory_status, "ProjectCategorys Status",$projectcategorysdata,"status","",$postData,"projectcategoryarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $projectcategoryarray = array_merge($postData['dbinput']['projectcategoryarray'],$updatedlog);
		$updateProjectCategorys = $this->ProjectCategory_model->UpdateProjectCategorys($projectcategoryarray,$projectcategory_id);
            
             if($updateProjectCategorys){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateProjectCategorys));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveProjectCategorys(){

                $projectcategory_name       			       = $this->input->post("add_projectcategory_name");
                $projectcategory_status       			       = $this->input->post("add_projectcategory_status");
          
           $postData=array();
		   $projectcategorysdata = [];
         $postData = dataFieldValidation($projectcategory_name, "ProjectCategorys Name",$projectcategorysdata,"projectcategory_name","",$postData,"projectcategoryarray");
         $postData = dataFieldValidation($projectcategory_status, "ProjectCategorys Status",$projectcategorysdata,"status","",$postData,"projectcategoryarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	
       $projectcategoryarray = array_merge($postData['dbinput']['projectcategoryarray'],$createdlog);
       $addProjectCategorys=$this->ProjectCategory_model->AddProjectCategorys($projectcategoryarray);
            if($addProjectCategorys){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addProjectCategorys));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteProjectCategorysById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteProjectCategorys = $this->ProjectCategory_model->DeleteProjectCategorys($id);
			   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function ProjectCategorysList()
		{
          
           $searchdata=$this->ProjectCategory_model->ListProjectCategorys();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>