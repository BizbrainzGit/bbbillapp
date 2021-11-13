<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/admin/BaseController.php');
class ReceiptController extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
	  $this->load->model('Business_model');
		$this->load->database();
	}
     

    public function BillReceiptView()
		{
    $this->load->view('admin/billreceiptview');
    }

    
      


}

?>