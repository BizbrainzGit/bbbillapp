<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class DemoWebsitesController extends BaseController {
		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Demowebsites_model');
			
		}	
 

  public function demowebsitesView()
		{
          $this->load->view('admin/demowebsitesview');
        }


public function editDemowebsitesByid($id)
		{
	
	   $editDemowebsites=$this->Demowebsites_model->EditDemowebsites($id);
	   echo json_encode(array('success'=>true,'data'=>$editDemowebsites));
     }


     public function updateDemowebsitesByid(){

                $demowebsites_id 					    =$this->input->post("edit_demowebsites_id");
                $demowebsites_name       			    = $this->input->post("edit_demowebsites_name");
			    $demowebsites_url       			    = $this->input->post("edit_demowebsites_url");
			    $demowebsites_category       			= $this->input->post("edit_demowebsites_category");
			    $demowebsites_status       			    = $this->input->post("edit_demowebsites_status");


          $oldimage =  Demowebsites_model::where('id',$demowebsites_id)->get(['web_photo']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['web_photo'];

			 $sourcePath1= isset($_FILES['edit_demowebsites_photo']['tmp_name'])?$_FILES['edit_demowebsites_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/demowebsites/";
				$target_file = $target_dir .basename($_FILES["edit_demowebsites_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
    //            $fileinfo = @getimagesize($_FILES["edit_demowebsites_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["edit_demowebsites_photo"]["size"];
				//  if($width > "1200" || $height >"400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_';

				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_demowebsites_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/demowebsites/";
				$image=$imagepath.$temp.$_FILES['edit_demowebsites_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}
				
           $postData=array();
		   $demowebsitesdata = [];
         
         $postData = dataFieldValidation($demowebsites_category, "Demowebsites Category",$demowebsitesdata,"category_id","",$postData,"demowebsitesarray");  
         $postData = dataFieldValidation($demowebsites_name, "Demowebsites Name",$demowebsitesdata,"web_name",$postData,"demowebsitesarray");
          $postData = dataFieldValidation($demowebsites_url, "Demowebsites Amount",$demowebsitesdata,"web_url",$postData,"demowebsitesarray");
         $postData = dataFieldValidation($image, "Demowebsites Photo",$demowebsitesdata,"web_photo","", $postData,"demowebsitesarray");
         $postData = dataFieldValidation($demowebsites_status, "Demowebsites Photo",$demowebsitesdata,"web_status","", $postData,"demowebsitesarray");


		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $demowebsitesarray = array_merge($postData['dbinput']['demowebsitesarray'],$updatedlog);
		$updateDemowebsites = $this->Demowebsites_model->UpdateDemowebsites($demowebsitesarray,$demowebsites_id);
            
             if($updateDemowebsites){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateDemowebsites));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveDemowebsites(){

                $demowebsites_category       	= $this->input->post("add_demowebsites_category"); 
                $demowebsites_name       	    = $this->input->post("add_demowebsites_name");
                $demowebsites_url       	    = $this->input->post("add_demowebsites_url"); 
                $demowebsites_status            = $this->input->post("add_demowebsites_status");

			 $sourcePath1= isset($_FILES['add_demowebsites_photo']['tmp_name'])?$_FILES['add_demowebsites_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/demowebsites/";
				$target_file = $target_dir .basename($_FILES["add_demowebsites_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_demowebsites_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_demowebsites_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                 $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_demowebsites_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/demowebsites/";
				$image=$imagepath.$temp.$_FILES['add_demowebsites_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=null;
				echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				
			}
				
           $postData=array();
		   $demowebsitesdata = [];
         
           
         $postData = dataFieldValidation($demowebsites_name, "Demowebsites Name",$demowebsitesdata,"web_name","",$postData,"demowebsitesarray");
         $postData = dataFieldValidation($demowebsites_category, "Demowebsites Category",$demowebsitesdata,"category_id","",$postData,"demowebsitesarray");
         $postData = dataFieldValidation($demowebsites_url, "Demowebsites URL",$demowebsitesdata,"web_url",$postData,"demowebsitesarray");
         $postData = dataFieldValidation($image, "Demowebsites Photo",$demowebsitesdata,"web_photo","", $postData,"demowebsitesarray");
         $postData = dataFieldValidation($demowebsites_status, "Demowebsites Status",$demowebsitesdata,"web_status","", $postData,"demowebsitesarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

		$userId = $this->ion_auth->get_user_id();
  $createdlog=isCreatedLog($userId);	 
 $demowebsitesarray = array_merge($postData['dbinput']['demowebsitesarray'],$createdlog);



        $addDemowebsites=$this->Demowebsites_model->AddDemowebsites($demowebsitesarray);
				
				   
            if($addDemowebsites){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addDemowebsites));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }
            

public function deleteDemowebsitesById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteDemowebsites = $this->Demowebsites_model->DeleteDemowebsites($id);
			   echo json_encode(array('success'=>true,'data'=>$deleteDemowebsites));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

 public function SearchDemoWebsitesList()
		{
          
           $demo_website = $this->input->post("search_demo_website"); 
           $searchdata=$this->Demowebsites_model->ListDemowebsites($demo_website);
			echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 






}
?>