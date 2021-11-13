<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/managingdirector/BaseController.php');
class ManagingDirectorHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
		$this->load->database();
		$this->load->model('CityMapping_model');
		$this->load->model('Cities_model');
		$this->load->model('Assignments_model');
	}
        public function Dashboard()
		{    
		
            $id= $this->ion_auth->get_user_id();
			$this->load->view('managingdirector/dashboard');
			
			
        }


        

}

?>