<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class SubPackagesController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
		  $this->load->model('Subpackages_model');
			// $this->load->model('PackagesDetails_model');
		}	
 

 public function SubPackagesView()
		{
          $this->load->view('admin/subpackagesview');
        }

 public function listSubPackages()
		{
          $subpackageslist=$this->Subpackages_model->SubPackageList();
          
	      echo json_encode(array('success'=>true,'data'=>$subpackageslist));
        }

 public function saveSubPackage()
        {  
          $add_subpackage_name       			           = $this->input->post("add_subpackage_name");
          
            	
          $postData=array();
		  
		     $subpackagedata = [];
         
          $postData = dataFieldValidation($add_subpackage_name, "Sub Package Name",$subpackagedata,"sublist_name",[ValidationTypes::REQUIRED],$postData,"subpackagearray");
         
	
		  if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
		  echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
           
         $userId = $this->ion_auth->get_user_id();
         $createdlog=isCreatedLog($userId);
         $subpackagearray = array_merge($postData['dbinput']['subpackagearray'],$createdlog);

           $addsubPackage= $this->Subpackages_model->AddSubPackage($subpackagearray);
   
		   
      if($addsubPackage){
       echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
		    return;
			} else {
		    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			return;
		    }
			} 

public function editSubPackageByid($id)
	   {
	     $editSubPackage=$this->Subpackages_model->EditSubPackage($id);
	     echo json_encode(array('success'=>true,'data'=>$editSubPackage));
       }

public function updateSubPackageByid()
       {

      $subpackage_id 					               =$this->input->post("edit_subpackage_id");
      $edit_subpackage_name       			       = $this->input->post("edit_subpackage_name");
	     

        $postData=array();
		    $subpackagedata = [];
       


        $postData = dataFieldValidation($edit_subpackage_name, "Sub Package Name",$subpackagedata,"sublist_name","",$postData,"subpackagearray");

      

        
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
         
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
         $subpackagearray = array_merge($postData['dbinput']['subpackagearray'],$updatedlog);
         $updatesubpackage = $this->Subpackages_model->SubPackageUpdate($subpackagearray,$subpackage_id);

	   

       if($updatesubpackage){
          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
		  return;
		  } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
          return;
          }	
       }

public function deleteSubPackageById($id)
       {
       if(isset($id)&&$id>0){
         
	   	  $deletesbupackage = $this->Subpackages_model->DeleteSubPackage($id);
       if($deletesbupackage){
		  echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
		  return;
		} else {
		  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		  return;
	     }
	    } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
    	  return;
	     }
       }            


}
?>