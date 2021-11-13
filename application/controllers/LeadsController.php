
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class LeadsController extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Leads_model');
				
	}
  
	public function leadsView()
	{
		$this->load->view('leads');
	}

   public function leadsListViewForAdmin()
    {
      $this->load->view('admin/prospect_leadsview');
    }
   public function leadsListViewForTelemarketing()
    {
     $this->load->view('tele-market/prospect_leadsview');
    }
   public function leadsListViewForMarketingLead()
    {
       $this->load->view('market-lead/prospect_leadsview');
    }
     
	public function saveLeads(){
          $add_lead_name       			        = $this->input->post("add_lead_name");
          $add_lead_email                       = $this->input->post("add_lead_email");
          $add_lead_mobileno                    = $this->input->post("add_lead_mobileno");
          $add_lead_bussiness                   = $this->input->post("add_lead_bussiness");
          $add_lead_message                     = $this->input->post("add_lead_message"); 
			
				
         $postData=array();
		 $leadsdata = [];
         
           
         $postData = dataFieldValidation($add_lead_name, "Name",$leadsdata,"name",[ValidationTypes::REQUIRED],$postData,"leadsarray");

         $postData = dataFieldValidation($add_lead_email, "Email",$leadsdata,"email",[ValidationTypes::REQUIRED],$postData,"leadsarray");

         $postData = dataFieldValidation($add_lead_mobileno, "Mobile Number",$leadsdata,"phone_number",[ValidationTypes::REQUIRED],$postData,"leadsarray");

         $postData = dataFieldValidation($add_lead_bussiness, "Bussiness",$leadsdata,"bussiness_name","",$postData,"leadsarray");

         $postData = dataFieldValidation($add_lead_message, "Message",$leadsdata,"message","",$postData,"leadsarray");

         $userId = 5;
         $createdlog=isCreatedLog($userId);
        $leadsarray = array_merge($postData['dbinput']['leadsarray'],$createdlog);

        $addleads= $this->Leads_model->Addleads($leadsarray);
			    
         if($addleads){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			    } else {
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}
			  }
 


	public function leadslist()
		{
	
      $ResultList=$this->Leads_model->LeadsList();
	   echo json_encode(array('success'=>true,'data'=>$ResultList));
	   return;
     }
 

 public function editStatusByid($id)
		{
	 		$result=Leads_model::where('id','=',$id)->get(['status','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
        }

     public function updateStatusByid(){

        $prospect_status_id       			                    = $this->input->post("prospect_status_id");
        $prospect_status_change       			                = $this->input->post("prospect_status_change"); 
			
        $postData=array();
		$changestatus = [];

	$postData = dataFieldValidation($prospect_status_change, "Status",$changestatus,"status","",$postData,"statusarray");
	 if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
         // $status=4;
         $statusarray = array_merge($postData['dbinput']['statusarray'],$updatedlog);
         
        $updateStatus = $this->Leads_model->updateStatus($statusarray,$prospect_status_id);
            
             if($updateStatus){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	
  }


			  
		
}
?>