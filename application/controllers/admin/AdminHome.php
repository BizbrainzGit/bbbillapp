<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class AdminHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
        $this->load->database();
	}
     public function Dashboard()
		{      
            $this->load->view('admin/dashboard');
        }
     
     public function OurPackagesListView()
       {
        $this->load->view('admin/our_packages_view');
      }     



}
?>