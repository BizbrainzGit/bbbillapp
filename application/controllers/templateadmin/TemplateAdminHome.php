<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class TemplateAdminHome extends BaseController{
public function __construct(){
		parent::__construct("Normal");
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
	    $this->load->database();
	    $this->load->model('User');
	    $this->load->model('Userdetails_model');
	    $this->load->model('Address_model');
	    $this->load->model('ContactForm_model'); 
	    $this->load->model('JobApply_model');
	    $this->load->model('Gallery_model');
	    $this->load->model('ClientLogo_model');
	    $this->load->model('Project_model'); 
	    $this->load->model('CategoriesList_model');

	 }
        public function Dashboard()
		{      
         $data['gallerycount']=$this->Gallery_model->GalleryCountForDashboard();
         $data['applyjobcount']=$this->JobApply_model->applyjobCountForDashboard();
         $data['clientlogocount']=$this->ClientLogo_model->clientlogoCountForDashboard();
         $data['clientproductscount']=$this->Project_model->clientproductsCountForDashboard();
         $this->load->view('templateadmin/dashboard',$data);
       }
    


     public function contactformView()
		{
          $this->load->view('templateadmin/contactformview');
        }

       public function ContactFormDetailsList()
		{
          $searchdata=$this->ContactForm_model->ListContactFormDetails();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
          }



     public function JobApplyDetailsView()
		{
          $this->load->view('templateadmin/jobapplydetailsview');
        }

     public function JobApplyDetailsList()
		{
           $searchdata=$this->JobApply_model->applyjobdetailsList();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
          }

public function getCategoriesForProjects()
		{
		 $CategoriesList =$this->CategoriesList_model->CategoriesList();//fetching from database table
		 echo json_encode(array('data'=>$CategoriesList));
		 return;
		}




}?>