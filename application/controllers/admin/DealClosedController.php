<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class DealClosedController extends BaseController {

 public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Business_model'); 
			$this->load->model('BusinessPayments_model');
			
		}	

//  public function dealclosedView(){
//           $this->load->view('admin/dealclosedview');
//       }

//  public function DealClosedlist(){
	   
// 	   $city_id=""; 
// 	   $userid="";
//       $DealClosedlist=$this->Business_model->DealClosedList($city_id,$userid);
// 	   echo json_encode(array('success'=>true,'data'=>$DealClosedlist));
//      }

// public function editProjectStatusByid($id)
// 		{
	
// 	 		$result=BusinessPayments_model::where('id','=',$id)->get(['project_status_id','id']);
// 	        echo json_encode(array('success'=>true,'data'=>$result));
	     
//         }
        
//  public function ProjectupdateStatusByid(){

//          $project_change_status_id       			            = $this->input->post("project_change_status_id");
//          $project_change_status       			                = $this->input->post("project_change_status"); 
			
//         $postData=array();
// 		$projectchangestatus = [];
// 		$postData = dataFieldValidation($project_change_status, " Project Status",$projectchangestatus,"project_status_id","",$postData,"projectstatusarray");
//         $projectupdateStatus = $this->BusinessPayments_model->updateStatusproject($postData['dbinput']['projectstatusarray'],$project_change_status_id);
            
//              if($projectupdateStatus){

// 				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$projectupdateStatus));
// 				return;
				
//               }else{

//                   echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

// 				return;
	
//                   }	
//   }




}
?>