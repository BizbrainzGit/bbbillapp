<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class GalleryController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Gallery_model');
			
		}	
 
  public function GalleryView()
		{
		$this->load->view('templateadmin/gallerysview');
		}
     
     public function GalleryList()
	   {
		    $searchlist = $this->Gallery_model->galleryList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveGallery(){
                         
            $gallery_type     	           = $this->input->post("add_gallery_type");   
			$gallery_title                 = $this->input->post("add_gallery_title");
			$gallery_image_alt             = $this->input->post("add_gallery_image_alt");
		    $gallery_status		           = $this->input->post("add_gallery_status");

            $sourcePath1= isset($_FILES['add_gallery_image']['tmp_name'])?$_FILES['add_gallery_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/gallery/";
				$target_file = $target_dir .basename($_FILES["add_gallery_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["add_gallery_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_gallery_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_gallery_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/gallery/";
				$image1=$imagepath.$temp.$_FILES['add_gallery_image']['name'];
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
		$gallerydata = [];
        
        $postData = dataFieldValidation($gallery_type, "Gallery Type",$gallerydata,"gallery_type","", $postData,"galleryarray");
        $postData = dataFieldValidation($gallery_title, "Title",$gallerydata,"gallery_title","","galleryarray");
        $postData = dataFieldValidation($gallery_image_alt, "Image Alt",$gallerydata,"image_alt","","galleryarray");
		$postData = dataFieldValidation($gallery_status,"Status",$gallerydata,"status","", $postData,"galleryarray");
		$postData = dataFieldValidation($image1,"Image",$gallerydata,"image","", $postData,"galleryarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $galleryarray = array_merge($postData['dbinput']['galleryarray'],$createdlog);
      $addgallery = $this->Gallery_model->addgallery($galleryarray);
       if($addgallery){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function galleryEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editgallery = $this->Gallery_model->galleryEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editgallery));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateGallery(){
                         
                $id      	                        = $this->input->post("edit_gallery_id");
                $gallery_type     	                = $this->input->post("edit_gallery_type");   
				$gallery_title        	            = $this->input->post("edit_gallery_title");
				$gallery_image_alt                  = $this->input->post("edit_gallery_image_alt");
				$gallery_status		                = $this->input->post("edit_gallery_status");

          $oldimage =  Gallery_model::where('id',$id)->get(['image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];

          $sourcePath1= isset($_FILES['edit_gallery_image']['tmp_name'])?$_FILES['edit_gallery_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/gallery/";
				$target_file = $target_dir .basename($_FILES["edit_gallery_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_gallery_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_gallery_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/gallery/";
				$image1=$imagepath.$temp.$_FILES['edit_gallery_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}
      
      $postData=array();
		$gallerydata = [];
        
        $postData = dataFieldValidation($gallery_type, "Gallery Type",$gallerydata,"gallery_type","", $postData,"galleryarray");
        $postData = dataFieldValidation($gallery_title, "Title",$gallerydata,"gallery_title","","galleryarray");
        $postData = dataFieldValidation($gallery_image_alt, "Image Alt",$gallerydata,"image_alt","","galleryarray");
		$postData = dataFieldValidation($gallery_status,"Status",$gallerydata,"status","", $postData,"galleryarray");
		$postData = dataFieldValidation($image1,"Image",$gallerydata,"image","", $postData,"galleryarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $galleryarray = array_merge($postData['dbinput']['galleryarray'],$updatedlog);
        $updategallery = $this->Gallery_model->galleryUpdate($galleryarray,$id);
                      if($updategallery){
								echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
										return;
						    }else{
								echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
			                }	
            }


public function deleteGalleryById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->Gallery_model->galleryDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>