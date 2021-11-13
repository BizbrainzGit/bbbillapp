
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ob_start();

class ProjectStatusController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('Status_model');
		 $this->load->model('Project_status_model');
	}

  public function getProjectStatusList(){
        $status =$this->Project_status_model->ProjectStatusList();//fetching from database table
         echo json_encode(array('data'=>$status));
         return;
    }

  

    

}
?>