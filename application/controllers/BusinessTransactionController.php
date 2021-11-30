<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
class BusinessTransactionController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
         $this->load->model('Business_model');
         $this->load->model('BusinessPayments_model');
         $this->load->model('Customdata_model');
         $this->load->model('UserGroups_model');
         $this->load->model('BusinessPaymentTransaction_model');
         $this->load->model('Sms_send_model');  
         $this->load->model('CityMapping_model'); 

    }
	public function adminBusinessTransactionsView()
    {
     $this->load->view("admin/managebusinesstransactionsview");
    } 
	public function accountantBusinessTransactionsView()
		{
		 $this->load->view("accountant/managebusinesstransactionsview");
		} 
public function MarketLeadBusinessTransactionsView()
    {
     $this->load->view("market-lead/managebusinesstransactionsview");
    }
public function MarketingBusinessTransactionsView()
    {
          $id= $this->ion_auth->get_user_id();
          $citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
          $this->load->view('market/managebusinesstransactionsview',$citydata);
    }
public function TeleMarketingBusinessTransactionsView()
    {
     $this->load->view("tele-market/managebusinesstransactionsview");
    }    
	public function listofBusinessTransactions()
		{ 
			     $business_cname            = $this->input->post("search_businessdealclosed_cname"); 
           $business_city             = $this->input->post("search_businessdealclosed_city"); 
           
           $search_businessdealclosed_fromdate  = $this->input->post("search_businessdealclosed_fromdate"); 
           if($search_businessdealclosed_fromdate) {
               $business_fromdate  = date("Y-m-d", strtotime($search_businessdealclosed_fromdate) );
            }else{
           	  $business_fromdate=" " ;
            }

           $search_businessdealclosed_todate          = $this->input->post("search_businessdealclosed_todate");
          
           if($search_businessdealclosed_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_businessdealclosed_todate) );
           }else{
           	   $business_todate=" " ;
            }
          

         $userrole=$this->session->userdata('user_roles');
           if($userrole=="Marketing"){

              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              
           }else if($userrole=="Marketing-Lead"){

               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();

           }else if($userrole=="Tele-Marketing"){ 

               $city_id="";
               $userid=$this->ion_auth->get_user_id();
               
           }else{
                $city_id="";
                $userid="";
            }  
            
		  $listresult = $this->BusinessPaymentTransaction_model->BusinessTransactionsList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate);
		  echo json_encode(array('success'=>true,'data'=>$listresult,'role'=>$userrole));
		  return;
		} 

    public function BusinessTransactionDataByid($id){
        $listresult = $this->BusinessPaymentTransaction_model->BusinessTransactionsByid($id);
		  echo json_encode(array('success'=>true,'data'=>$listresult));
		  return;
         }	

    public function saveBusinessTransactionChequeApproval(){

                 $id       			            = $this->input->post("businesstransaction_approval_id");
                $businessstransaction_approval  = $this->input->post("businesstransaction_approval_status");
          // die();
           $postData=array();
		   $businesstransactionapprovaldata = [];
          $postData = dataFieldValidation($businessstransaction_approval, "Business Cheque Approval",$businesstransactionapprovaldata,"is_cheque_received","",$postData,"businesstransactionapprovalarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		  }

	  $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
       $businesstransactionapprovalarray = array_merge($postData['dbinput']['businesstransactionapprovalarray'],$updatedlog);
       $updateresult=$this->BusinessPaymentTransaction_model->UpdateBusinessTransactionApproval($businesstransactionapprovalarray,$id);

            if($updateresult){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }
	


} 
?>
