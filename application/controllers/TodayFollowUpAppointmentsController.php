<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class TodayFollowUpAppointmentsController extends CommonBaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Business_model');
			$this->load->model('Assignments_model');
		 }	
 
     public function todayAppointmentsViewForTelemarketing()
		{
            $this->load->view('tele-market/todayfollowupappointments');
        }

  //     public function todayAppointmentsViewForAdmin()
		// {
  //           $this->load->view('admin/todayappointments');
  //       }   

    public function SearchTodayFollowUpAppointmentslist()
		{      
                $userrole=$this->session->userdata('user_roles');
		          if($userrole=="Tele-Marketing"){ 
		               $today=date("Y-m-d");
		               $userid=$this->ion_auth->get_user_id();
		            }else{
		                 $today=date("Y-m-d");
		                 $userid="";
		            }  
	               $todaylist=$this->Assignments_model->TodayFollowUpAppointmentList($today,$userid);
		           echo json_encode(array('success'=>true, 'data'=>$todaylist));
         
         }



}
?>