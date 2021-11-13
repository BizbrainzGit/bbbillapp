<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class PaymentTypesController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('PaymentType_model');
			
		}	
 

 public function paymentTypesView()
		{
          $this->load->view('admin/paymenttypesview');
        }

 public function listPaymentTypes()
		{
          $PaymentTypeslist=$this->PaymentType_model->listPaymentsTypes();
	      echo json_encode(array('success'=>true,'data'=>$PaymentTypeslist));
        }

 public function savePaymentType()
        {  
          $add_paymenttype       			           = $this->input->post("add_paymenttype");
          
            	
          $postData=array();
		  $paymenttypedata = [];
		 
         
          $postData = dataFieldValidation($add_paymenttype, "Payment Type",$paymenttypedata,"paymenttype_name",[ValidationTypes::REQUIRED],$postData,"paymenttypearray");


           $addPaymenttype= $this->PaymentType_model->AddPaymenttype($postData['dbinput']['paymenttypearray']);
   
		
            if($addPaymenttype){
            echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
		    return;
			} else {
		    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			return;
		    }
			
       }

public function editPaymenttypeByid($id)
	   {
	     $editPaymenttype=$this->PaymentType_model->EditPaymenttype($id);
	     echo json_encode(array('success'=>true,'data'=>$editPaymenttype));
       }

public function updatePaymenttypeByid()
       {

        $paymenttype_id 					           =$this->input->post("edit_paymenttype_id");
        $edit_paymenttype       			       = $this->input->post("edit_paymenttype");
	  

        $postData=array();
		$paymenttypedata = [];
       


        $postData = dataFieldValidation($edit_paymenttype, "Payment Type",$paymenttypedata,"paymenttype_name","",$postData,"paymenttypearray");

  
       $updatepaymenttype = $this->PaymentType_model->UpdatePaymenttype($postData['dbinput']['paymenttypearray'],$paymenttype_id);

	   if($updatepaymenttype){
          echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
		  return;
		  } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
          return;
          }	
       }

public function deletePaymenttypeById($id)
       {
       if(isset($id)&&$id>0){
          $deletepaymenttype = $this->PaymentType_model->DeletePaymenttype($id);
	   	  
       if($deletepaymenttype){
		  echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
		  return;
		} else {
		  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
		  return;
	     }
	    } else {
          echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
    	  return;
	     }
       }            


}
?>