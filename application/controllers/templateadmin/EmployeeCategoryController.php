<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class EmployeeCategoryController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('EmployeeCategory_model');
			
		}	
 

  public function EmployeeCategoryView()
		{
          $this->load->view('templateadmin/employeecategoryview');
      }


public function editEmployeeCategorysByid($id)
		{
	
	   $editEmployeeCategorys=$this->EmployeeCategory_model->editEmployeeCategorys($id);
	   echo json_encode(array('success'=>true,'data'=>$editEmployeeCategorys));
     }


     public function updateEmployeeCategorysByid(){

                $employeecategory_id 					  =$this->input->post("edit_employeecategory_id");
                $employeecategory_name       			  = $this->input->post("edit_employeecategory_name");
			    $employeecategory_status       			  = $this->input->post("edit_employeecategory_status");
			    $employeecategory_content       			  = $this->input->post("edit_employeecategory_content"); 

				
           $postData=array();
		   $employeecategorysdata = [];
           
         $postData = dataFieldValidation($employeecategory_name, "EmployeeCategorys Name",$employeecategorysdata,"employeecategory_name","",$postData,"employeecategoryarray");
         $postData = dataFieldValidation($employeecategory_status, "EmployeeCategorys Status",$employeecategorysdata,"status","",$postData,"employeecategoryarray");
         $postData = dataFieldValidation($employeecategory_content, "EmployeeCategorys Content",$employeecategorysdata,"employeecategory_content","",$postData,"employeecategoryarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $employeecategoryarray = array_merge($postData['dbinput']['employeecategoryarray'],$updatedlog);
		$updateEmployeeCategorys = $this->EmployeeCategory_model->UpdateEmployeeCategorys($employeecategoryarray,$employeecategory_id);
            
             if($updateEmployeeCategorys){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateEmployeeCategorys));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveEmployeeCategorys(){

                $employeecategory_name       			       = $this->input->post("add_employeecategory_name");
                $employeecategory_status       			       = $this->input->post("add_employeecategory_status");
                 $employeecategory_content       			  = $this->input->post("add_employeecategory_content");
          
           $postData=array();
		   $employeecategorysdata = [];
         $postData = dataFieldValidation($employeecategory_name, "EmployeeCategorys Name",$employeecategorysdata,"employeecategory_name","",$postData,"employeecategoryarray");
         $postData = dataFieldValidation($employeecategory_status, "EmployeeCategorys Status",$employeecategorysdata,"status","",$postData,"employeecategoryarray");
         $postData = dataFieldValidation($employeecategory_content, "EmployeeCategorys Content",$employeecategorysdata,"employeecategory_content","",$postData,"employeecategoryarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	
       $employeecategoryarray = array_merge($postData['dbinput']['employeecategoryarray'],$createdlog);
       $addEmployeeCategorys=$this->EmployeeCategory_model->AddEmployeeCategorys($employeecategoryarray);
            if($addEmployeeCategorys){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addEmployeeCategorys));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteEmployeeCategorysById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteEmployeeCategorys = $this->EmployeeCategory_model->DeleteEmployeeCategorys($id);
			   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function EmployeeCategorysList()
		{
          
           $searchdata=$this->EmployeeCategory_model->ListEmployeeCategorys();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>