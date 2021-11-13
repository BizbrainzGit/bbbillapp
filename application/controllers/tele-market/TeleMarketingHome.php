<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/tele-market/BaseController.php');
class TeleMarketingHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
		$this->load->model('Leads_model');
		$this->load->database();
	}
        public function dashboard()
		{
            $this->load->view('tele-market/dashboard');
        }
   

  
  public function OurPackagesListView()
  {
    
   $this->load->view('tele-market/our_packages_view');
  }     

}

?>