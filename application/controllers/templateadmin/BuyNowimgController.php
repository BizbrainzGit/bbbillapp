<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class BuyNowimgController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('BuyNowimg_model');
			
		}	
 
  public function BuyNowimgView()
		{
		$this->load->view('templateadmin/buynowimgsview');
		}
     
     public function BuyNowimgList()
	   {
		    $searchlist = $this->BuyNowimg_model->buynowimgList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveBuyNowimg(){
                 
			     $buynowimg_title                 = $this->input->post("add_buynowimg_title");
			     $buynowimg_image_alt		        = $this->input->post("add_buynowimg_image_alt");
		         $buynowimg_status		        = $this->input->post("add_buynowimg_status"); 

            $sourcePath1= isset($_FILES['add_buynowimg_image']['tmp_name'])?$_FILES['add_buynowimg_image']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/buynowimg/";
				$target_file = $target_dir .basename($_FILES["add_buynowimg_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// $check = $_FILES["add_buynowimg_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_buynowimg_image']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_buynowimg_image"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/buynowimg/";
				$image1=$imagepath.$temp.$_FILES['add_buynowimg_image']['name'];
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
		$buynowimgdata = [];
        
       
        $postData = dataFieldValidation($buynowimg_title, "Title",$buynowimgdata,"buynowimg_title","","buynowimgarray");

        $postData = dataFieldValidation($buynowimg_image_alt, "Image Alt",$buynowimgdata,"image_alt","","buynowimgarray");
       
		$postData = dataFieldValidation($buynowimg_status,"Status",$buynowimgdata,"status","", $postData,"buynowimgarray");
	
		$postData = dataFieldValidation($image1,"Image",$buynowimgdata,"image","", $postData,"buynowimgarray");


		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $buynowimgarray = array_merge($postData['dbinput']['buynowimgarray'],$createdlog);
        $addbuynowimg = $this->BuyNowimg_model->addbuynowimg($buynowimgarray);
       if($addbuynowimg){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function buynowimgEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editbuynowimg = $this->BuyNowimg_model->buynowimgEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editbuynowimg));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateBuyNowimg(){
                         
                $id      	                        = $this->input->post("edit_buynowimg_id");
				$buynowimg_title        	            = $this->input->post("edit_buynowimg_title");
				$buynowimg_image_alt		        = $this->input->post("edit_buynowimg_image_alt");
				$buynowimg_status		                = $this->input->post("edit_buynowimg_status");

          $oldimage =  BuyNowimg_model::where('id',$id)->get(['image']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['image'];

          $sourcePath1= isset($_FILES['edit_buynowimg_image']['tmp_name'])?$_FILES['edit_buynowimg_image']['tmp_name']:'';
           if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/buynowimg/";
				$target_file = $target_dir .basename($_FILES["edit_buynowimg_image"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["edit_buynowimg_image"]["size"];
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
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_buynowimg_image']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/buynowimg/";
				$image1=$imagepath.$temp.$_FILES['edit_buynowimg_image']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				
				$image1= $oldimage1;
				
				
			}
      
        $postData=array();
		$buynowimgdata = [];
        
        $postData = dataFieldValidation($buynowimg_title, "Title",$buynowimgdata,"buynowimg_title","","buynowimgarray");
        $postData = dataFieldValidation($buynowimg_image_alt, "Image Alt",$buynowimgdata,"image_alt","","buynowimgarray");
		$postData = dataFieldValidation($buynowimg_status,"Status",$buynowimgdata,"status","", $postData,"buynowimgarray");
		$postData = dataFieldValidation($image1,"Image",$buynowimgdata,"image","", $postData,"buynowimgarray");
		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $buynowimgarray = array_merge($postData['dbinput']['buynowimgarray'],$updatedlog);
        $updatebuynowimg = $this->BuyNowimg_model->buynowimgUpdate($buynowimgarray,$id);
         if($updatebuynowimg){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}else{
			    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			     }	
            }


public function deleteBuyNowimgById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->BuyNowimg_model->buynowimgDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>