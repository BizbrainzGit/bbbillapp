<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PackagesController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Packages_model');
			$this->load->model('PackagesDetails_model');
		}	
 

 public function packagesView()
		{
          $this->load->view('admin/packagesview');
        }

 public function listPackages()
		{
          $packageslist=$this->Packages_model->listPackages();
	      echo json_encode(array('success'=>true,'data'=>$packageslist));
        }

 public function savePackage()
        {  
          $add_package_name       			           = $this->input->post("add_package_name");
          $add_package_amount       			       = $this->input->post("add_package_amount");
          $add_package_status       			       = $this->input->post("add_package_status");
          $add_package_campaign_id       		       = $this->input->post("add_package_campaign");
            	
          $postData=array();
		  $packagedata = [];
		  $subpackagedata = [];
         
          $postData = dataFieldValidation($add_package_name, "Package Name",$packagedata,"package_name",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($add_package_amount, "Package Amount",$packagedata,"package_amount",[ValidationTypes::REQUIRED],$postData,"packagearray");
          $postData = dataFieldValidation($add_package_status, "Package Status",$packagedata,"package_status","",$postData,"packagearray");

          if(isset($add_package_campaign_id) && !empty($add_package_campaign_id)){ 
          foreach($add_package_campaign_id as $key=>$udata){
                $sub_package = $udata;
                $postData = dataFieldValidation($sub_package, "Sub Package ",$subpackagedata,"sub_package_id",[ValidationTypes::REQUIRED],$postData,"packagelistarray".$key);
                }
              } 
	
		  if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
		  echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
           
         $userId = $this->ion_auth->get_user_id();
         $createdlog=isCreatedLog($userId);
         $packagearray = array_merge($postData['dbinput']['packagearray'],$createdlog);

           $addPackage= $this->Packages_model->AddPackage($packagearray);
   
		   if(isset($add_package_campaign_id) && !empty($add_package_campaign_id)){  
           foreach($add_package_campaign_id as $key=>$udata){
                   $sub_package  = $udata;
			       $subpackagearray = array_merge(array('package_id'=>$addPackage,'sub_package_id'=>$sub_package));
			       $addSubPackage= $this->PackagesDetails_model->AddSubPackege($subpackagearray);
			    }
            if($addSubPackage){
            echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
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

public function editPackageByid($id)
	   {
	     $editPackage=$this->Packages_model->EditPackage($id);
	     echo json_encode(array('success'=>true,'data'=>$editPackage));
       }

public function updatePackageByid()
       {

        $package_id 					           =$this->input->post("edit_package_id");
        $edit_package_name       			       = $this->input->post("edit_package_name");
	    $edit_package_amount       			       = $this->input->post("edit_package_amount"); 
	    $edit_package_status       			       = $this->input->post("edit_package_status");
	    $edit_package_campaign       			   = $this->input->post("edit_package_campaign"); 

        $postData=array();
		$packagedata = [];
       


        $postData = dataFieldValidation($edit_package_name, "Package Name",$packagedata,"package_name","",$postData,"packagearray");

        $postData = dataFieldValidation($edit_package_amount, "Package Amount",$packagedata,"package_amount","",$postData,"packagearray");
        $postData = dataFieldValidation($edit_package_status, "Package Status",$packagedata,"package_status","",$postData,"packagearray");

        $subpackagedata = [];
     
        if(isset($edit_package_campaign) && !empty($edit_package_campaign)){ 
        foreach($edit_package_campaign as $key=>$udata){
                $subpackage = $udata;
                $postData = dataFieldValidation($subpackage, "Sub Package ",$subpackagedata,"sub_package_id","",$postData,"subpackagearray".$key);
               }
          } 
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
         
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $packagearray = array_merge($postData['dbinput']['packagearray'],$updatedlog);
       $updatepackage = $this->Packages_model->UpdatePackage($packagearray,$package_id);

	   if(isset($edit_package_campaign) && !empty($edit_package_campaign)){  
         
       $deleteCity = $this->PackagesDetails_model->DeletesubPackage($package_id);
       if($deleteCity>0)
         {
	   foreach($edit_package_campaign as $key=>$udata){
	           $subpackage  = $udata;
		       $subpackagearray = array_merge(array('package_id'=>$package_id,'sub_package_id'=>$subpackage));
               $updateSubPackage= $this->PackagesDetails_model->AddSubPackege($subpackagearray);
		  }
	     }else{
        foreach($edit_package_campaign as $key=>$udata){
	            $subpackage  = $udata;
				$subpackagearray = array_merge(array('package_id'=>$package_id,'sub_package_id'=>$subpackage));
			    $updateSubPackage= $this->PackagesDetails_model->AddSubPackege($subpackagearray);
			       }
			  }
        
          }		

       if($updateSubPackage){
          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
		  return;
		  } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
          return;
          }	
       }

public function deletePackageById($id)
       {
       if(isset($id)&&$id>0){
          $deletepackage = $this->Packages_model->DeletePackage($id);
	   	  $deletesbupackage = $this->PackagesDetails_model->DeletesubPackage($id);
       if($deletepackage && $deletesbupackage){
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