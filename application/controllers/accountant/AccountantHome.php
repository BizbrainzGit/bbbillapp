<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/accountant/BaseController.php');
class AccountantHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
		$this->load->database();
		$this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Status_model');
		 $this->load->model('Cities_model');
		 $this->load->model('States_model');
	     $this->load->model('Business_model');
	     $this->load->model('Address_model');
	     $this->load->model('PaymentType_model');
	     $this->load->model('BusinessPaymentmode_model');
	     $this->load->model('Campaigns_model');
	     $this->load->model('BusinessCampaign_model');
	     $this->load->model('BusinessOwner_model');
	     $this->load->model('BusinessEmp_model');
	     $this->load->model('Promocode_model');
	     $this->load->model('BusinessPayments_model');
	     $this->load->model('Packages_model');
	     $this->load->model('Subpackages_model');
	     $this->load->model('Demowebsites_model');
	     $this->load->model('CategoriesList_model');
	     $this->load->model('BusinessKeywords_model');
	     $this->load->model('Customdata_model');
	     $this->load->model('UserGroups_model');
	     $this->load->model('BusinessPackage_model');
	     $this->load->model('CityMapping_model');
	     $this->load->model('Assignments_model');
	     $this->load->model('BusinessPaymentTransaction_model');
	     $this->load->model('Sms_send_model');
	     $this->load->model('GalleryType_model');
	     // $this->load->model('MenuType_model'); 
	     $this->load->model('Project_status_model');
	}
    public function dashboard()
		{    
		
            $id= $this->ion_auth->get_user_id();
		    $this->load->view('accountant/dashboard');
		
        }

    public function AccountantProjectList()
    { 
      $userrole=$this->session->userdata('user_roles');
           
               $city_id="";
               $userid="";
            
     
      $searchdata=$this->Business_model->ProjectStatusList($city_id,$userid);
            echo json_encode(array('success'=>true,'data'=>$searchdata,'role'=>$userrole));
        return;
     
    }
        

}

?>