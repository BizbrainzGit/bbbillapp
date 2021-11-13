<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class ServiceController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Service_model');
			
		}	
 
  public function ServiceView()
		{
		$this->load->view('templateadmin/servicesview');
		}
     
     public function ServiceList()
	   {
		    $searchlist = $this->Service_model->serviceList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveService(){
                         
             
            $service_content     	       = $this->input->post("add_service_content");
			$service_title                  = $this->input->post("add_service_title");
		    $service_status		           = $this->input->post("add_service_status");
		    $service_url		           = $this->input->post("add_service_url");
		    $service_imagealt		           = $this->input->post("add_service_imagealt");  
       
            $sourcePath1= isset($_FILES['add_service_image']['tmp_name'])?$_FILES['add_service_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/service/";
				$target_file = $target_dir .basename($_FILES["add_service_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["add_service_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_service_image']['name']; // 
				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/service/";
				$image1=$imagepath.$temp.$_FILES['add_service_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$image1=null;
				// echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
				// 	return;
				
			}
      
        $postData=array();
		$servicedata = [];
       
        $postData = dataFieldValidation($service_title, "Title",$servicedata,"service_title","","servicearray");
        $postData = dataFieldValidation($service_content, "Content",$servicedata,"service_content","", $postData,"servicearray");
		$postData = dataFieldValidation($service_status,"Status",$servicedata,"status","", $postData,"servicearray"); 
		$postData = dataFieldValidation($service_url,"Status",$servicedata,"service_url","", $postData,"servicearray"); 
		$postData = dataFieldValidation($image1,"Image",$servicedata,"image","", $postData,"servicearray");

		$postData = dataFieldValidation($service_imagealt,"Image Alt",$servicedata,"image_alt","", $postData,"servicearray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
        $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $servicearray = array_merge($postData['dbinput']['servicearray'],$createdlog);
        $addservice = $this->Service_model->addservice($servicearray); 

       if($addservice){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function serviceEditById($id){ 
                     if(isset($id)&&$id>0){
		       	 $editservice = $this->Service_model->serviceEdit($id);
			      echo json_encode(array('success'=>true,'data'=>$editservice));
			       }else{
		         echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}
          }


public function updateService(){
                         
                $id      	                    = $this->input->post("edit_service_id");
                $service_skill     	                = $this->input->post("edit_service_skill");   
                $service_content     	            = $this->input->post("edit_service_content");
				$service_title        	            = $this->input->post("edit_service_title");
				$service_status		                = $this->input->post("edit_service_status");
				$service_url		                = $this->input->post("edit_service_url"); 
                $service_imagealt		            = $this->input->post("edit_service_imagealt"); 

               $oldimage =  Service_model::where('id',$id)->get(['image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];

          $sourcePath1= isset($_FILES['edit_service_image']['tmp_name'])?$_FILES['edit_service_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/service/";
				$target_file = $target_dir .basename($_FILES["edit_service_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_service_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_service_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/service/";
				$image1=$imagepath.$temp.$_FILES['edit_service_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}
         
      
      $postData=array();
		$servicedata = [];
        
        $postData = dataFieldValidation($service_title, "Title",$servicedata,"service_title","","servicearray");
        $postData = dataFieldValidation($service_content, "Content",$servicedata,"service_content","", $postData,"servicearray");
		$postData = dataFieldValidation($service_status,"Status",$servicedata,"status","", $postData,"servicearray"); 
		$postData = dataFieldValidation($service_url,"Status",$servicedata,"service_url","", $postData,"servicearray"); 
		$postData = dataFieldValidation($image1,"Image",$servicedata,"image","", $postData,"servicearray");
        
        $postData = dataFieldValidation($service_imagealt,"Image Alt",$servicedata,"image_alt","", $postData,"servicearray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $servicearray = array_merge($postData['dbinput']['servicearray'],$updatedlog);
        $updateservice = $this->Service_model->serviceUpdate($servicearray,$id); 
         
          if($updateservice){
								echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
										return;
						    }else{
								echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
			                }	
            }


public function deleteServiceById($id){ 

              if(isset($id)&&$id>0){
		       	    $deleteMenus = $this->Service_model->serviceDelete($id);
			          echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		               echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}
                    

            }

}
?>