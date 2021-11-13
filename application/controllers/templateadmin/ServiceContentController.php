<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class ServiceContentController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('ServiceContent_model');
			
		}	
 
  public function ServiceContentView()
		{
		$this->load->view('templateadmin/servicecontentsview');
		}
     
     public function ServiceContentList()
	   {
		    $searchlist = $this->ServiceContent_model->servicecontentList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveServiceContent(){
                  $servicecontent_type             = $this->input->post("add_servicecontent_type");   
                  $servicecontent_bannertitle      = $this->input->post("add_servicecontent_bannertitle");
                  $servicecontent_bannercontent= $this->input->post("add_servicecontent_bannercontent");
                  $servicecontent_bannerimagealt= $this->input->post("add_servicecontent_bannerimagealt"); 

			      $servicecontent_section1_heading  = $this->input->post("add_servicecontent_section1_heading");
			      $servicecontent_section1_content  = $this->input->post("add_servicecontent_section1_content");
			      $servicecontent_section1_imagealt  = $this->input->post("add_servicecontent_section1_imagealt");

			      $servicecontent_section2_heading  = $this->input->post("add_servicecontent_section2_heading");
			      $servicecontent_section2_content  = $this->input->post("add_servicecontent_section2_content");
			       $servicecontent_section2_imagealt  = $this->input->post("add_servicecontent_section2_imagealt");

			      $servicecontent_section3_heading  = $this->input->post("add_servicecontent_section3_heading");
			      $servicecontent_section3_content  = $this->input->post("add_servicecontent_section3_content");
			      $servicecontent_section3_imagealt  = $this->input->post("add_servicecontent_section3_imagealt");
			       

		          $servicecontent_status	= $this->input->post("add_servicecontent_status"); 
		        

            $sourcePath1= isset($_FILES['add_servicecontent_bannerimage']['tmp_name'])?$_FILES['add_servicecontent_bannerimage']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/servicecontent/";
				$target_file = $target_dir .basename($_FILES["add_servicecontent_bannerimage"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_servicecontent_bannerimage']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/servicecontent/";
				$image1=$imagepath.$temp.$_FILES['add_servicecontent_bannerimage']['name'];
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

		$section1_image= isset($_FILES['add_servicecontent_section1_image']['tmp_name'])?$_FILES['add_servicecontent_section1_image']['tmp_name']:'';
			if(!empty($section1_image))
			{
				$target_dir = "assets/uploads/servicecontent/";
				$target_file = $target_dir .basename($_FILES["add_servicecontent_section1_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_servicecontent_section1_image']['name']; // Target path where file is to be stored
				if(move_uploaded_file($section1_image,$targetPath)){
				$imagepath ="assets/uploads/servicecontent/";
				$section1_image=$imagepath.$temp.$_FILES['add_servicecontent_section1_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$section1_image=null;
			}


			$section2_image= isset($_FILES['add_servicecontent_section2_image']['tmp_name'])?$_FILES['add_servicecontent_section2_image']['tmp_name']:'';
			if(!empty($section2_image))
			{
				$target_dir = "assets/uploads/servicecontent/";
				$target_file = $target_dir .basename($_FILES["add_servicecontent_section2_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_servicecontent_section2_image']['name']; // Target path where file is to be stored
				if(move_uploaded_file($section2_image,$targetPath)){
				$imagepath ="assets/uploads/servicecontent/";
				$section2_image=$imagepath.$temp.$_FILES['add_servicecontent_section2_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$section2_image=null;
			}

			$section3_image= isset($_FILES['add_servicecontent_section3_image']['tmp_name'])?$_FILES['add_servicecontent_section3_image']['tmp_name']:'';
			if(!empty($section3_image))
			{
				$target_dir = "assets/uploads/servicecontent/";
				$target_file = $target_dir .basename($_FILES["add_servicecontent_section3_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_servicecontent_section3_image']['name']; // Target path where file is to be stored
				if(move_uploaded_file($section3_image,$targetPath)){
				$imagepath ="assets/uploads/servicecontent/";
				$section3_image=$imagepath.$temp.$_FILES['add_servicecontent_section3_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$section3_image=null;
			}
      
        $postData=array();
		$servicecontentdata = [];
        
        $postData = dataFieldValidation($servicecontent_type, "ServiceContent Type",$servicecontentdata,"servicecontent_type","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannertitle, "Title",$servicecontentdata,"bannertitle","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannercontent,"Content",$servicecontentdata,"bannercontent","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($image1,"Image",$servicecontentdata,"bannerimage","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannerimagealt,"Image",$servicecontentdata,"bannerimage_alt","", $postData,"servicecontentarray");
		$postData = dataFieldValidation($servicecontent_status,"Status",$servicecontentdata,"status","", $postData,"servicecontentarray");

		 $postData = dataFieldValidation($servicecontent_section1_heading, "Title",$servicecontentdata,"section1_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section1_content,"Content",$servicecontentdata,"section1_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section1_image,"Image",$servicecontentdata,"section1_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section1_imagealt,"Image",$servicecontentdata,"section1_image_alt","", $postData,"servicecontentarray");

        $postData = dataFieldValidation($servicecontent_section2_heading, "Title",$servicecontentdata,"section2_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section2_content,"Content",$servicecontentdata,"section2_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section2_image,"Image",$servicecontentdata,"section2_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section2_imagealt,"Image",$servicecontentdata,"section2_image_alt","", $postData,"servicecontentarray");

          $postData = dataFieldValidation($servicecontent_section3_heading, "Title",$servicecontentdata,"section3_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section3_content,"Content",$servicecontentdata,"section3_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section3_image,"Image",$servicecontentdata,"section3_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section3_imagealt,"Image",$servicecontentdata,"section3_image_alt","", $postData,"servicecontentarray");
		

		

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $servicecontentarray = array_merge($postData['dbinput']['servicecontentarray'],$createdlog);
        $addservicecontent = $this->ServiceContent_model->addservicecontent($servicecontentarray);
       if($addservicecontent){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function servicecontentEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editservicecontent = $this->ServiceContent_model->servicecontentEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editservicecontent));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateServiceContent(){
                         
            $id      	                        = $this->input->post("edit_servicecontent_id");
            $servicecontent_type             = $this->input->post("edit_servicecontent_type");   
            $servicecontent_bannertitle      = $this->input->post("edit_servicecontent_bannertitle");
            $servicecontent_bannercontent= $this->input->post("edit_servicecontent_bannercontent");
            $servicecontent_bannerimagealt= $this->input->post("edit_servicecontent_bannerimagealt");  

            $servicecontent_section1_heading  = $this->input->post("edit_servicecontent_section1_heading");
            $servicecontent_section1_content  = $this->input->post("edit_servicecontent_section1_content");
            $servicecontent_section1_imagealt  = $this->input->post("edit_servicecontent_section1_imagealt");

            $servicecontent_section2_heading  = $this->input->post("edit_servicecontent_section2_heading");
            $servicecontent_section2_content  = $this->input->post("edit_servicecontent_section2_content");
            $servicecontent_section2_imagealt  = $this->input->post("edit_servicecontent_section2_imagealt");

            $servicecontent_section3_heading  = $this->input->post("edit_servicecontent_section3_heading");
            $servicecontent_section3_content  = $this->input->post("edit_servicecontent_section3_content");
             $servicecontent_section3_imagealt  = $this->input->post("edit_servicecontent_section3_imagealt");

              $servicecontent_status  = $this->input->post("edit_servicecontent_status"); 
     
      $oldimage =  ServiceContent_model::where('id',$id)->get(['bannerimage','section1_image','section2_image','section3_image']);//fetching from database table
     json_encode(array('data'=>$oldimage)); 
     $bannerimage= $oldimage[0]['bannerimage'];
     $oldimage1= $oldimage[0]['section1_image'];
     $oldimage2= $oldimage[0]['section2_image'];
     $oldimage3= $oldimage[0]['section3_image'];


            $sourcePath1= isset($_FILES['edit_servicecontent_bannerimage']['tmp_name'])?$_FILES['edit_servicecontent_bannerimage']['tmp_name']:'';
      if(!empty($sourcePath1))
      {
        $target_dir = "assets/uploads/servicecontent/";
        $target_file = $target_dir .basename($_FILES["edit_servicecontent_bannerimage"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
          {
          echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
          return;
        } 
                
                $temp=rand(0,100000).'_'; 
        $targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_servicecontent_bannerimage']['name']; // Target path where file is to be stored
        
        if(move_uploaded_file($sourcePath1,$targetPath)){
        $imagepath ="assets/uploads/servicecontent/";
        $image1=$imagepath.$temp.$_FILES['edit_servicecontent_bannerimage']['name'];
        } else{
          echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
          return;
        }
        
      }else{
        $imagepath =null;
        $image1=$bannerimage;
        
      }

    $section1_image= isset($_FILES['edit_servicecontent_section1_image']['tmp_name'])?$_FILES['edit_servicecontent_section1_image']['tmp_name']:'';
      if(!empty($section1_image))
      {
        $target_dir = "assets/uploads/servicecontent/";
        $target_file = $target_dir .basename($_FILES["edit_servicecontent_section1_image"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
          {
          echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
          return;
        } 
                
                $temp=rand(0,100000).'_'; 
        $targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_servicecontent_section1_image']['name']; // Target path where file is to be stored
        if(move_uploaded_file($section1_image,$targetPath)){
        $imagepath ="assets/uploads/servicecontent/";
        $section1_image=$imagepath.$temp.$_FILES['edit_servicecontent_section1_image']['name'];
        } else{
          echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
          return;
        }
        
      }else{
        $imagepath =null;
        $section1_image=$oldimage1;
      }


      $section2_image= isset($_FILES['edit_servicecontent_section2_image']['tmp_name'])?$_FILES['edit_servicecontent_section2_image']['tmp_name']:'';
      if(!empty($section2_image))
      {
        $target_dir = "assets/uploads/servicecontent/";
        $target_file = $target_dir .basename($_FILES["edit_servicecontent_section2_image"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
          {
          echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
          return;
        } 
                
                $temp=rand(0,100000).'_'; 
        $targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_servicecontent_section2_image']['name']; // Target path where file is to be stored
        if(move_uploaded_file($section2_image,$targetPath)){
        $imagepath ="assets/uploads/servicecontent/";
        $section2_image=$imagepath.$temp.$_FILES['edit_servicecontent_section2_image']['name'];
        } else{
          echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
          return;
        }
        
      }else{
        $imagepath =null;
        $section2_image=$oldimage2;
      }

      $section3_image= isset($_FILES['edit_servicecontent_section3_image']['tmp_name'])?$_FILES['edit_servicecontent_section3_image']['tmp_name']:'';
      if(!empty($section3_image))
      {
        $target_dir = "assets/uploads/servicecontent/";
        $target_file = $target_dir .basename($_FILES["edit_servicecontent_section3_image"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
          {
          echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
          return;
        } 
                
                $temp=rand(0,100000).'_'; 
        $targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_servicecontent_section3_image']['name']; // Target path where file is to be stored
        if(move_uploaded_file($section3_image,$targetPath)){
        $imagepath ="assets/uploads/servicecontent/";
        $section3_image=$imagepath.$temp.$_FILES['edit_servicecontent_section3_image']['name'];
        } else{
          echo json_encode(array('success'=>false,'message'=>IMAGE_NOT_UPLOADED));
          return;
        }
        
      }else{
        $imagepath =null;
        $section3_image=$oldimage3;
      }

      $postData=array();
		$servicecontentdata = [];
        
         $postData = dataFieldValidation($servicecontent_type, "ServiceContent Type",$servicecontentdata,"servicecontent_type","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannertitle, "Title",$servicecontentdata,"bannertitle","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannercontent,"Content",$servicecontentdata,"bannercontent","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($image1,"Image",$servicecontentdata,"bannerimage","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_bannerimagealt,"Image Alt",$servicecontentdata,"bannerimage_alt","", $postData,"servicecontentarray");
		$postData = dataFieldValidation($servicecontent_status,"Status",$servicecontentdata,"status","", $postData,"servicecontentarray");

		 $postData = dataFieldValidation($servicecontent_section1_heading, "Title",$servicecontentdata,"section1_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section1_content,"Content",$servicecontentdata,"section1_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section1_image,"Image",$servicecontentdata,"section1_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section1_imagealt,"Image",$servicecontentdata,"section1_image_alt","", $postData,"servicecontentarray");

        $postData = dataFieldValidation($servicecontent_section2_heading, "Title",$servicecontentdata,"section2_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section2_content,"Content",$servicecontentdata,"section2_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section2_image,"Image",$servicecontentdata,"section2_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section2_imagealt,"Image",$servicecontentdata,"section2_image_alt","", $postData,"servicecontentarray");

          $postData = dataFieldValidation($servicecontent_section3_heading, "Title",$servicecontentdata,"section3_heading","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section3_content,"Content",$servicecontentdata,"section3_content","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($section3_image,"Image",$servicecontentdata,"section3_image","", $postData,"servicecontentarray");
        $postData = dataFieldValidation($servicecontent_section3_imagealt,"Image",$servicecontentdata,"section3_image_alt","", $postData,"servicecontentarray");
		

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $servicecontentarray = array_merge($postData['dbinput']['servicecontentarray'],$updatedlog);
        $updateservicecontent = $this->ServiceContent_model->servicecontentUpdate($servicecontentarray,$id);
         if($updateservicecontent){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}else{
			    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			     }	
            }


public function deleteServiceContentById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->ServiceContent_model->servicecontentDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>