<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH.'controllers/market/BaseController.php');
class MarketingHome extends BaseController{

	public function __construct(){
		parent::__construct("Normal");
		
		$this->load->helper(array('form', 'url','captcha','html','language'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth'));
		$this->load->database();
		$this->load->model('CityMapping_model');
		$this->load->model('Cities_model');
		$this->load->model('Assignments_model');
		$this->load->model('Packages_model');
	}
        public function dashboard()
		{    
		   
		   // $this->load->view('market/statuspopupview');

            $id= $this->ion_auth->get_user_id();
			$city_id=$this->city_id;
			$citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
			$citydata['cityid']=$this->CityMapping_model->CitySelectedCount($id);
			
			if(!isset($city_id) || is_null($city_id)){
				if(count($citydata['cityid'])>0){
					$this->load->view('market/cityselectedview',$citydata);
				}else{
					 $this->load->view('market/dashboard',$citydata);
				}	
			}else{
				$this->load->view('market/dashboard',$citydata);
			}
			
        }

        public function todayAppointmentsView()
		{   
			 $id= $this->ion_auth->get_user_id();
			$citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
            $this->load->view('market/todayappointments',$citydata);
        }

         public function citySelectedView()
		{    $id= $this->ion_auth->get_user_id();
			$citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
            $this->load->view('market/cityselectedview',$citydata);
        } 
     
       public function MarketingPackagesListView()
       {
          $this->load->view('market/our_packages_view');
       }
        

}

?>