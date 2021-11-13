<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class GalleryTypeController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('GalleryType_model');
			
		}	
 

  public function gallerytypeView()
		{
          $this->load->view('templateadmin/gallerytypeview');
      }


public function editGalleryTypesByid($id)
		{
	
	   $editGalleryTypes=$this->GalleryType_model->editGalleryTypes($id);
	   echo json_encode(array('success'=>true,'data'=>$editGalleryTypes));
     }


     public function updateGalleryTypesByid(){

                $gallerytype_id 					               =$this->input->post("edit_gallerytype_id");
                $gallerytype_name       			               = $this->input->post("edit_gallerytype_name");
			    $gallerytype_status       			               = $this->input->post("edit_gallerytype_status"); 

				
           $postData=array();
		   $gallerytypesdata = [];
           
         $postData = dataFieldValidation($gallerytype_name, "GalleryTypes Name",$gallerytypesdata,"gallerytype_name","",$postData,"gallerytypearray");
         $postData = dataFieldValidation($gallerytype_status, "GalleryTypes Status",$gallerytypesdata,"status","",$postData,"gallerytypearray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $gallerytypearray = array_merge($postData['dbinput']['gallerytypearray'],$updatedlog);
		$updateGalleryTypes = $this->GalleryType_model->UpdateGalleryTypes($gallerytypearray,$gallerytype_id);
            
             if($updateGalleryTypes){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateGalleryTypes));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveGalleryTypes(){

                $gallerytype_name       			       = $this->input->post("add_gallerytype_name");
                $gallerytype_status       			       = $this->input->post("add_gallerytype_status");
          
           $postData=array();
		   $gallerytypesdata = [];
         $postData = dataFieldValidation($gallerytype_name, "GalleryTypes Name",$gallerytypesdata,"gallerytype_name","",$postData,"gallerytypearray");
         $postData = dataFieldValidation($gallerytype_status, "GalleryTypes Status",$gallerytypesdata,"status","",$postData,"gallerytypearray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	
       $gallerytypearray = array_merge($postData['dbinput']['gallerytypearray'],$createdlog);
       $addGalleryTypes=$this->GalleryType_model->AddGalleryTypes($gallerytypearray);
            if($addGalleryTypes){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addGalleryTypes));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteGalleryTypesById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteGalleryTypes = $this->GalleryType_model->DeleteGalleryTypes($id);
			   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function GalleryTypesList()
		{
          
           $searchdata=$this->GalleryType_model->ListGalleryTypes();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>