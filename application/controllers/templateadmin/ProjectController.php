<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class ProjectController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Project_model');
			
		}	
 
  public function ProjectView()
		{
		$this->load->view('templateadmin/projectsview');
		}
     
     public function ProjectList()
	   {
		    $searchlist = $this->Project_model->projectList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveProject(){
                 $project_type     	            = $this->input->post("add_project_type");   
                 $project_url     	            = $this->input->post("add_project_url");
			     $project_title                 = $this->input->post("add_project_title");
		         $project_status		        = $this->input->post("add_project_status"); 
		         $project_category		        = $this->input->post("add_project_category");
		         $project_image_alt		        = $this->input->post("add_project_image_alt"); 
		         $project_certification_image_alt = $this->input->post("add_project_certification_image_alt"); 

            $sourcePath1= isset($_FILES['add_project_image']['tmp_name'])?$_FILES['add_project_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/project/";
				$target_file = $target_dir .basename($_FILES["add_project_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_project_image"]["size"];
				//  if($check==false){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
				// 	return;
				//  }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_project_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_project_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/project/";
				$image1=$imagepath.$temp.$_FILES['add_project_image']['name'];
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

		$sourcePath2= isset($_FILES['add_project_certification']['tmp_name'])?$_FILES['add_project_certification']['tmp_name']:'';
			if(!empty($sourcePath2))
			{
				$target_dir = "assets/uploads/project/";
				$target_file = $target_dir .basename($_FILES["add_project_certification"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_project_certification"]["size"];
				//  if($check==false){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
				// 	return;
				//  }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_project_certification']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_project_image"]["error"];

				if(move_uploaded_file($sourcePath2,$targetPath)){
				$imagepath ="assets/uploads/project/";
				$image2=$imagepath.$temp.$_FILES['add_project_certification']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$image2=null;
				// echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
				// 	return;
				
			}
      
        $postData=array();
		$projectdata = [];
        
        $postData = dataFieldValidation($project_type, "Project Type",$projectdata,"project_type","", $postData,"projectarray");
        $postData = dataFieldValidation($project_title, "Title",$projectdata,"project_title","","projectarray");
        $postData = dataFieldValidation($project_url, "Url",$projectdata,"project_url","", $postData,"projectarray");
		$postData = dataFieldValidation($project_status,"Status",$projectdata,"status","", $postData,"projectarray");
		$postData = dataFieldValidation($project_category,"Status",$projectdata,"project_category","", $postData,"projectarray");
		$postData = dataFieldValidation($image1,"Image",$projectdata,"image","", $postData,"projectarray");

		$postData = dataFieldValidation($image2,"Certification Image",$projectdata,"certification_image","", $postData,"projectarray");
		$postData = dataFieldValidation($project_image_alt,"Image Alt",$projectdata,"image_alt","", $postData,"projectarray");

		$postData = dataFieldValidation($project_certification_image_alt,"Certification Image Alt",$projectdata,"certification_image_alt","", $postData,"projectarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $projectarray = array_merge($postData['dbinput']['projectarray'],$createdlog);
        $addproject = $this->Project_model->addproject($projectarray);
       if($addproject){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function projectEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editproject = $this->Project_model->projectEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editproject));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateProject(){
                         
                $id      	                        = $this->input->post("edit_project_id");
                $project_type     	                = $this->input->post("edit_project_type");   
                $project_url     	                = $this->input->post("edit_project_url");
				$project_title        	            = $this->input->post("edit_project_title");
				$project_status		                = $this->input->post("edit_project_status");
				$project_category		            = $this->input->post("edit_project_category"); 
				$project_image_alt		            = $this->input->post("edit_project_image_alt"); 
		        $project_certification_image_alt    = $this->input->post("edit_project_certification_image_alt"); 

          $oldimage =  Project_model::where('id',$id)->get(['image','certification_image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];
		 $oldimage2= $oldimage[0]['certification_image'];

          $sourcePath1= isset($_FILES['edit_project_image']['tmp_name'])?$_FILES['edit_project_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/project/";
				$target_file = $target_dir .basename($_FILES["edit_project_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_project_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_project_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/project/";
				$image1=$imagepath.$temp.$_FILES['edit_project_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}

			$sourcePath2= isset($_FILES['edit_project_certification']['tmp_name'])?$_FILES['edit_project_certification']['tmp_name']:'';
			if(!empty($sourcePath2))
			{
				$target_dir = "assets/uploads/project/";
				$target_file = $target_dir .basename($_FILES["edit_project_certification"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_project_certification"]["size"];
				//  if($check==false){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
				// 	return;
				//  }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_project_certification']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_project_image"]["error"];

				if(move_uploaded_file($sourcePath2,$targetPath)){
				$imagepath ="assets/uploads/project/";
				$image2=$imagepath.$temp.$_FILES['edit_project_certification']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				
				$image2=$oldimage1;
			}
      
      $postData=array();
		$projectdata = [];
        
        $postData = dataFieldValidation($project_type, "Project Type",$projectdata,"project_type","", $postData,"projectarray");
        $postData = dataFieldValidation($project_title, "Title",$projectdata,"project_title","","projectarray");
        $postData = dataFieldValidation($project_url, "Url",$projectdata,"project_url","", $postData,"projectarray");
		$postData = dataFieldValidation($project_status,"Status",$projectdata,"status","", $postData,"projectarray");
		$postData = dataFieldValidation($project_category,"Status",$projectdata,"project_category","", $postData,"projectarray");
		$postData = dataFieldValidation($image1,"Image",$projectdata,"image","", $postData,"projectarray");

		$postData = dataFieldValidation($image2,"Certification Image",$projectdata,"certification_image","", $postData,"projectarray");
		$postData = dataFieldValidation($project_image_alt,"Image Alt",$projectdata,"image_alt","", $postData,"projectarray");

		$postData = dataFieldValidation($project_certification_image_alt,"Certification Image Alt",$projectdata,"certification_image_alt","", $postData,"projectarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $projectarray = array_merge($postData['dbinput']['projectarray'],$updatedlog);
        $updateproject = $this->Project_model->projectUpdate($projectarray,$id);
         if($updateproject){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}else{
			    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			     }	
            }


public function deleteProjectById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->Project_model->projectDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>