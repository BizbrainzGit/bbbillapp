<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class BannerController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Banner_model');
			
		}	
 
  public function BannerView()
		{
		$this->load->view('templateadmin/bannersview');
		}
     
     public function BannerList()
	   {
		    $searchlist = $this->Banner_model->bannerList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveBanner(){
                         
            $banner_menu     	           = $this->input->post("add_banner_menu");   
            $banner_content     	       = $this->input->post("add_banner_content");
			$banner_title                  = $this->input->post("add_banner_title");
			$banner_image_alt              = $this->input->post("add_banner_image_alt");
		    $banner_status		           = $this->input->post("add_banner_status");

            $sourcePath1= isset($_FILES['add_banner_image']['tmp_name'])?$_FILES['add_banner_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/banner/";
				$target_file = $target_dir .basename($_FILES["add_banner_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["add_banner_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_banner_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_banner_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/banner/";
				$image1=$imagepath.$temp.$_FILES['add_banner_image']['name'];
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
		$bannerdata = [];
        
        $postData = dataFieldValidation($banner_menu, "Menu Name",$bannerdata,"menu_id","", $postData,"bannerarray");
        $postData = dataFieldValidation($banner_title, "Title",$bannerdata,"banner_title","","bannerarray");
        $postData = dataFieldValidation($banner_content, "Content",$bannerdata,"banner_content","", $postData,"bannerarray");
        $postData = dataFieldValidation($banner_image_alt, "Banner Image Alt",$bannerdata,"image_alt","", $postData,"bannerarray");
		$postData = dataFieldValidation($banner_status,"Status",$bannerdata,"status","", $postData,"bannerarray");
		$postData = dataFieldValidation($image1,"Image",$bannerdata,"image","", $postData,"bannerarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		} 
		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $bannerarray = array_merge($postData['dbinput']['bannerarray'],$createdlog);
        $addbanner = $this->Banner_model->addbanner($bannerarray);
       if($addbanner){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function bannerEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editbanner = $this->Banner_model->bannerEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editbanner));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateBanner(){
                         
                $id      	                        = $this->input->post("edit_banner_id");
                $banner_menu     	                = $this->input->post("edit_banner_menu");   
                $banner_content     	            = $this->input->post("edit_banner_content");
				$banner_title        	            = $this->input->post("edit_banner_title");
				$banner_image_alt                   = $this->input->post("edit_banner_image_alt");
				$banner_status		                = $this->input->post("edit_banner_status");

          $oldimage =  Banner_model::where('id',$id)->get(['image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];

          $sourcePath1= isset($_FILES['edit_banner_image']['tmp_name'])?$_FILES['edit_banner_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/banner/";
				$target_file = $target_dir .basename($_FILES["edit_banner_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_banner_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_banner_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/banner/";
				$image1=$imagepath.$temp.$_FILES['edit_banner_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}
      
      $postData=array();
		$bannerdata = [];
        
        $postData = dataFieldValidation($banner_menu, "Menu Name",$bannerdata,"menu_id","", $postData,"bannerarray");
        $postData = dataFieldValidation($banner_title, "Title",$bannerdata,"banner_title","","bannerarray");
        $postData = dataFieldValidation($banner_content, "Content",$bannerdata,"banner_content","", $postData,"bannerarray");
        $postData = dataFieldValidation($banner_image_alt, "Banner Image Alt",$bannerdata,"image_alt","", $postData,"bannerarray");
		$postData = dataFieldValidation($banner_status,"Status",$bannerdata,"status","", $postData,"bannerarray");
		$postData = dataFieldValidation($image1,"Image",$bannerdata,"image","", $postData,"bannerarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
                  $userId = $this->ion_auth->get_user_id();
                  $updatedlog=isUpdateLog($userId);
                  $bannerarray = array_merge($postData['dbinput']['bannerarray'],$updatedlog);
                $updatebanner = $this->Banner_model->bannerUpdate($bannerarray,$id);
                      if($updatebanner){
								echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
										return;
						    }else{
								echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
			                }	
            }


public function deleteBannerById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->Banner_model->bannerDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>