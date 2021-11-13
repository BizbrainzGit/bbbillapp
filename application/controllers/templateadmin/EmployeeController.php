<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class EmployeeController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Employee_model');
			
		}	
 
  public function EmployeeView()
		{
		$this->load->view('templateadmin/employeesview');
		}
     
     public function EmployeeList()
	   {
		    $searchlist = $this->Employee_model->employeeList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveEmployee(){
                         
            $employee_category     	       = $this->input->post("add_employee_category");   
            $employee_lastname     	       = $this->input->post("add_employee_lastname");
			$employee_firstname            = $this->input->post("add_employee_firstname");
			$employee_designation          = $this->input->post("add_employee_designation");
		    $employee_mobileno		       = $this->input->post("add_employee_mobileno");
		    $employee_status		       = $this->input->post("add_employee_status");

            $sourcePath1= isset($_FILES['add_employee_image']['tmp_name'])?$_FILES['add_employee_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/employee/";
				$target_file = $target_dir .basename($_FILES["add_employee_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["add_employee_image"]["size"];
				 if($check==false){
					echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
					return;
				 }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_employee_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_employee_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/employee/";
				$image1=$imagepath.$temp.$_FILES['add_employee_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$image1=null;
				echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				
			}
      
        $postData=array();
		$employeedata = [];
        
        $postData = dataFieldValidation($employee_category, "Menu Name",$employeedata,"category_id","", $postData,"employeearray");
        $postData = dataFieldValidation($employee_firstname, "First Name",$employeedata,"emp_first_name","","employeearray");
        $postData = dataFieldValidation($employee_lastname, "Last Name",$employeedata,"emp_last_name","", $postData,"employeearray");
         $postData = dataFieldValidation($employee_designation, "Designation",$employeedata,"emp_designation","", $postData,"employeearray");
		$postData = dataFieldValidation($employee_mobileno,"Mobile No",$employeedata,"emp_mobileno","", $postData,"employeearray");
		$postData = dataFieldValidation($employee_status,"Status",$employeedata,"status","", $postData,"employeearray");
		$postData = dataFieldValidation($image1,"Image",$employeedata,"image","", $postData,"employeearray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		} 
		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $employeearray = array_merge($postData['dbinput']['employeearray'],$createdlog);
        $addemployee = $this->Employee_model->addemployee($employeearray);
       if($addemployee){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function employeeEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editemployee = $this->Employee_model->employeeEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editemployee));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateEmployee(){
                         
                $id      	                        = $this->input->post("edit_employee_id");
                $employee_category     	                = $this->input->post("edit_employee_category");   
                $employee_lastname     	            = $this->input->post("edit_employee_lastname");
				$employee_firstname        	            = $this->input->post("edit_employee_firstname");
				$employee_status		                = $this->input->post("edit_employee_status");
                $employee_designation        	    = $this->input->post("edit_employee_designation");
				$employee_mobileno		                = $this->input->post("edit_employee_mobileno");

              


          $oldimage =  Employee_model::where('id',$id)->get(['image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];

          $sourcePath1= isset($_FILES['edit_employee_image']['tmp_name'])?$_FILES['edit_employee_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/employee/";
				$target_file = $target_dir .basename($_FILES["edit_employee_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_employee_image"]["size"];
				 if($check==false){
					echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
					return;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_employee_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/employee/";
				$image1=$imagepath.$temp.$_FILES['edit_employee_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}
      
      $postData=array();
		$employeedata = [];
        
        $postData = dataFieldValidation($employee_category, "Menu Name",$employeedata,"category_id","", $postData,"employeearray");
        $postData = dataFieldValidation($employee_firstname, "First Name",$employeedata,"emp_first_name","","employeearray");
        $postData = dataFieldValidation($employee_lastname, "Last Name",$employeedata,"emp_last_name","", $postData,"employeearray");
         $postData = dataFieldValidation($employee_designation, "Designation",$employeedata,"emp_designation","", $postData,"employeearray");
		$postData = dataFieldValidation($employee_mobileno,"Mobile No",$employeedata,"emp_mobileno","", $postData,"employeearray");
		$postData = dataFieldValidation($employee_status,"Status",$employeedata,"status","", $postData,"employeearray");
		$postData = dataFieldValidation($image1,"Image",$employeedata,"image","", $postData,"employeearray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
                  $userId = $this->ion_auth->get_user_id();
                  $updatedlog=isUpdateLog($userId);
                  $employeearray = array_merge($postData['dbinput']['employeearray'],$updatedlog);
                $updateemployee = $this->Employee_model->employeeUpdate($employeearray,$id);
                      if($updateemployee){
								echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
										return;
						    }else{
								echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
			                }	
            }


public function deleteEmployeeById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->Employee_model->employeeDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>