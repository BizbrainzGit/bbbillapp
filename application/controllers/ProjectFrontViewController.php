
<?php defined('BASEPATH') OR exit('No direct script access allowed');
// include_once(APPPATH . 'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class ProjectFrontViewController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email'));
		$this->load->helper(array('form','html','Util'));
		$this->load->database();
		$this->load->model('Project_model'); 
	    // $this->load->model('ProjectCategory_model');
	}
   
     

	public function OurProductsViewList()
	{
		    $resultlist = $this->Project_model->OurProductsForOurProductsPage();
			echo json_encode(array('success'=>true,'data'=>$resultlist));
	}
    
   public function ClientProductsViewList()
	{
		    $resultlist = $this->Project_model->ClientProductsForOurProductsPage();
			echo json_encode(array('success'=>true,'data'=>$resultlist));
	}

  //  public function ClientProjectCategorysViewList()
		// {
		//  $ResultList =$this->ProjectCategory_model->ProjectCategorysget();//fetching from database table
		//  echo json_encode(array('success'=>true,'data'=>$ResultList));
		//  return;
		// }

   public function SearchByCategoryClientProductsViewList()
            {

		    $category_id = $this->input->post("search_forntview_project_category");
		    $resultlist = $this->Project_model->SearchClientProductsForOurProductsPage($category_id);

		    if(count($resultlist)>0){
		    	 echo json_encode(array('success'=>true,'data'=>$resultlist));
		    }else{
		    	 echo json_encode(array('success'=>false,'message'=>SEARCH_PROJECT_CATEGORY_MSG));
		    }
			
	}


}
?>