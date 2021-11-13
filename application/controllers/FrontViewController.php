
<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class FrontViewController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('Gallery_model');
		$this->load->model('GalleryType_model'); 
		$this->load->model('Job_model');
		$this->load->model('CategoriesList_model');
		$this->load->model('Service_model');
	   
	}
 
 public function getProjectCategorys()
		{
		 //$ResultList =$this->ProjectCategory_model->ProjectCategorysget();//fetching from database table
		  $ResultList =$this->CategoriesList_model->CategoriesList();
		 echo json_encode(array('data'=>$ResultList));
		 return;
		}


public function getJobListForApplyForntView()
		{
		 $ResultList =$this->Job_model->getjoblistForApplyForntView();//fetching from database table
		 echo json_encode(array('data'=>$ResultList));
		 return;
		}

  public function getServicesTypesForMenu()
		{
		 $ResultList =$this->Service_model->getServiceType();//fetching from database table
		 echo json_encode(array('success'=>true,'data'=>$ResultList));
		 return;
		}

}
?>