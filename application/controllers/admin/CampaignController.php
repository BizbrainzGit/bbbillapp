<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class CampaignController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Campaigns_model');
			
		}	
 

  public function campaignView()
		{
          $this->load->view('admin/campaignview');
      }

public function listCampaign()
		{
	
      $campaignlist=$this->Campaigns_model->ListCampaign();
	   echo json_encode(array('success'=>true,'data'=>$campaignlist));
     }

public function editCampaignByid($id)
		{
	
	   $editCampaign=$this->Campaigns_model->editCampaign($id);
	   echo json_encode(array('success'=>true,'data'=>$editCampaign));
     }


     public function updateCampaignByid(){

                $campaign_id 					           =$this->input->post("edit_campaign_id");
                $campaign_name       			           = $this->input->post("edit_campaign_name");
			    $campaign_amount       			           = $this->input->post("edit_campaign_amount");
			    $campaign_status       			           = $this->input->post("edit_campaign_status"); 

          $oldimage =  Campaigns_model::where('id',$campaign_id)->get(['campaign_photo']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['campaign_photo'];

			 $sourcePath1= isset($_FILES['edit_campaign_photo']['tmp_name'])?$_FILES['edit_campaign_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/campaigns/";
				$target_file = $target_dir .basename($_FILES["edit_campaign_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
    //            $fileinfo = @getimagesize($_FILES["edit_campaign_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["edit_campaign_photo"]["size"];
				//  if($width > "1200" || $height >"400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG"&& $imageFileType != "PNG" && $imageFileType != "JPEG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_';  
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_campaign_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/campaigns/";
				$image=$imagepath.$temp.$_FILES['edit_campaign_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}
				
           $postData=array();
		   $campaignsdata = [];
           
         $postData = dataFieldValidation($campaign_name, "Campaign Name",$campaignsdata,"campaign_name",$postData,"campaignsarray");
          $postData = dataFieldValidation($campaign_amount, "Campaign Amount",$campaignsdata,"campaign_amount",$postData,"campaignsarray");
         $postData = dataFieldValidation($image, "Campaign Photo",$campaignsdata,"campaign_photo","", $postData,"campaignsarray");
         $postData = dataFieldValidation($campaign_status, "Campaign Status",$campaignsdata,"status","", $postData,"campaignsarray");

		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $campaignsarray = array_merge($postData['dbinput']['campaignsarray'],$updatedlog);
		$updateCampaign = $this->Campaigns_model->UpdateCampaign($campaignsarray,$campaign_id);
            
             if($updateCampaign){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateCampaign));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveCampaign(){

               
                $campaign_name       			           = $this->input->post("add_campaign_name");
                $campaign_amount       			           = $this->input->post("add_campaign_amount"); 
                $campaign_category       			       = $this->input->post("add_campaign_category");
                $campaign_status       			       = $this->input->post("add_campaign_status");

			 $sourcePath1= isset($_FILES['add_campaign_photo']['tmp_name'])?$_FILES['add_campaign_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/campaigns/";
				$target_file = $target_dir .basename($_FILES["add_campaign_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_campaign_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_campaign_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
              $temp=rand(0,100000).'_';  
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_campaign_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/campaigns/";
				$image=$imagepath.$temp.$_FILES['add_campaign_photo']['name'];
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
		   $campaignsdata = [];
         
           
         $postData = dataFieldValidation($campaign_name, "Campaign Name",$campaignsdata,"campaign_name","",$postData,"campaignsarray");
         $postData = dataFieldValidation($campaign_amount, "Campaign Amount",$campaignsdata,"campaign_amount",$postData,"campaignsarray");
         $postData = dataFieldValidation($campaign_category, "Campaign Category",$campaignsdata,"category_id",$postData,"campaignsarray");
         $postData = dataFieldValidation($image, "Campaign Photo",$campaignsdata,"campaign_photo","", $postData,"campaignsarray");
         $postData = dataFieldValidation($campaign_status, "Campaign Status",$campaignsdata,"status","", $postData,"campaignsarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

		$userId = $this->ion_auth->get_user_id();
  $createdlog=isCreatedLog($userId);	 
 $campaignsarray = array_merge($postData['dbinput']['campaignsarray'],$createdlog);



        $addCampaign=$this->Campaigns_model->AddCampaign($campaignsarray);
				
				   
            if($addCampaign){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addCampaign));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteCampaignById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteCampaign = $this->Campaigns_model->DeleteCampaign($id);
			   echo json_encode(array('success'=>true,'data'=>$deleteCampaign));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }








}
?>