<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/itdepartment/BaseController.php');
class ItDepartmentHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
		$this->load->database();
	
	}
        public function Dashboard()
		{    
		
            $id= $this->ion_auth->get_user_id();
			$this->load->view('itdepartment/dashboard');
			
			
        }


        

}

?>