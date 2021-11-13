<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class ClientLogoController extends BaseController {
		public function __construct(){
		 parent::__construct();
		 $this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		 $this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		 $this->load->database();
		 $this->load->model('ClientLogo_model');
			
		}	
 
  public function ClientLogoView()
		{
		$this->load->view('templateadmin/clientlogosview');
		}
     
     public function ClientLogoList()
	   {
		    $searchlist = $this->ClientLogo_model->clientlogoList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveClientLogo(){
                 
                 $clientlogo_url     	            = $this->input->post("add_clientlogo_url");
			     $clientlogo_title                  = $this->input->post("add_clientlogo_title");
			     $clientlogo_image_alt              = $this->input->post("add_clientlogo_image_alt");
		         $clientlogo_status		            = $this->input->post("add_clientlogo_status"); 

            $sourcePath1= isset($_FILES['add_clientlogo_image']['tmp_name'])?$_FILES['add_clientlogo_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/clientlogo/";
				$target_file = $target_dir .basename($_FILES["add_clientlogo_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_clientlogo_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_clientlogo_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_clientlogo_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/clientlogo/";
				$image1=$imagepath.$temp.$_FILES['add_clientlogo_image']['name'];
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
		$clientlogodata = [];
        
        $postData = dataFieldValidation($clientlogo_title, "Title",$clientlogodata,"clientlogo_title","","clientlogoarray");
        $postData = dataFieldValidation($clientlogo_url, "Url",$clientlogodata,"clientlogo_url","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($clientlogo_status,"Status",$clientlogodata,"status","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($image1,"Image",$clientlogodata,"clientlogo_image","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($clientlogo_image_alt,"Image Alt",$clientlogodata,"clientlogo_image_alt","", $postData,"clientlogoarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $clientlogoarray = array_merge($postData['dbinput']['clientlogoarray'],$createdlog);
        $addclientlogo = $this->ClientLogo_model->addclientlogo($clientlogoarray);
       if($addclientlogo){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function clientlogoEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editclientlogo = $this->ClientLogo_model->clientlogoEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editclientlogo));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateClientLogo(){
                         
                $id      	                        = $this->input->post("edit_clientlogo_id");
                $clientlogo_url     	                = $this->input->post("edit_clientlogo_url");
				$clientlogo_title        	            = $this->input->post("edit_clientlogo_title");
				$clientlogo_image_alt              = $this->input->post("edit_clientlogo_image_alt");
				$clientlogo_status		                = $this->input->post("edit_clientlogo_status");

          $oldimage =  ClientLogo_model::where('id',$id)->get(['clientlogo_image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['clientlogo_image'];
          $sourcePath1= isset($_FILES['edit_clientlogo_image']['tmp_name'])?$_FILES['edit_clientlogo_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/clientlogo/";
				$target_file = $target_dir .basename($_FILES["edit_clientlogo_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_clientlogo_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_clientlogo_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/clientlogo/";
				$image1=$imagepath.$temp.$_FILES['edit_clientlogo_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}

			$sourcePath2= isset($_FILES['edit_clientlogo_certification']['tmp_name'])?$_FILES['edit_clientlogo_certification']['tmp_name']:'';
			if(!empty($sourcePath2))
			{
				$target_dir = "assets/uploads/clientlogo/";
				$target_file = $target_dir .basename($_FILES["edit_clientlogo_certification"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_clientlogo_certification"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_clientlogo_certification']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_clientlogo_image"]["error"];

				if(move_uploaded_file($sourcePath2,$targetPath)){
				$imagepath ="assets/uploads/clientlogo/";
				$image2=$imagepath.$temp.$_FILES['edit_clientlogo_certification']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				
				$image2=$oldimage1;
			}
      
      $postData=array();
		$clientlogodata = [];
        $postData = dataFieldValidation($clientlogo_title, "Title",$clientlogodata,"clientlogo_title","","clientlogoarray");
        $postData = dataFieldValidation($clientlogo_url, "Url",$clientlogodata,"clientlogo_url","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($clientlogo_status,"Status",$clientlogodata,"status","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($image1,"Image",$clientlogodata,"clientlogo_image","", $postData,"clientlogoarray");
		$postData = dataFieldValidation($clientlogo_image_alt,"Image Alt",$clientlogodata,"clientlogo_image_alt","", $postData,"clientlogoarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $clientlogoarray = array_merge($postData['dbinput']['clientlogoarray'],$updatedlog);
        $updateclientlogo = $this->ClientLogo_model->clientlogoUpdate($clientlogoarray,$id);
         if($updateclientlogo){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}else{
			    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			     }	
            }


public function deleteClientLogoById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->ClientLogo_model->clientlogoDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>