<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;
class CountListController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('CountList_model');
			
		}	
 
  public function CountListView()
		{
		$this->load->view('templateadmin/countlistsview');
		}
     
     public function CountListList()
	   {
		    $searchlist = $this->CountList_model->countlistList();
			echo json_encode(array('success'=>true,'data'=>$searchlist));
	  }
  

public function saveCountList(){
                 $countlist_establishedyear  = $this->input->post("add_countlist_establishedyear");   
                 $countlist_clientcount      = $this->input->post("add_countlist_clientcount");
			     $countlist_projectcount     = $this->input->post("add_countlist_projectcount");
		         $countlist_status		     = $this->input->post("add_countlist_status"); 
		         $countlist_teamcount		 = $this->input->post("add_countlist_teamcount"); 
      
        $postData=array();
		$countlistdata = [];
        
        $postData = dataFieldValidation($countlist_establishedyear, "Established Year",$countlistdata,"establishedyear","", $postData,"countlistarray");
        $postData = dataFieldValidation($countlist_projectcount, "Projects Count ",$countlistdata,"projectcount","","countlistarray");
        $postData = dataFieldValidation($countlist_clientcount, "Client Count",$countlistdata,"clientcount","", $postData,"countlistarray");
        $postData = dataFieldValidation($countlist_teamcount,"Team Count ",$countlistdata,"teamcount","", $postData,"countlistarray");
		$postData = dataFieldValidation($countlist_status,"Status",$countlistdata,"status","", $postData,"countlistarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	    $userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	
        $countlistarray = array_merge($postData['dbinput']['countlistarray'],$createdlog);
        $addcountlist = $this->CountList_model->addcountlist($countlistarray);
       if($addcountlist){
						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


public function countlistEditById($id){ 

          
                     if(isset($id)&&$id>0){

		       	$editcountlist = $this->CountList_model->countlistEdit($id);
			   echo json_encode(array('success'=>true,'data'=>$editcountlist));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
          }


public function updateCountList(){
                         
                $id      	                = $this->input->post("edit_countlist_id");
                $countlist_establishedyear  = $this->input->post("edit_countlist_establishedyear");   
                $countlist_clientcount     	= $this->input->post("edit_countlist_clientcount");
				$countlist_projectcount     = $this->input->post("edit_countlist_projectcount");
				$countlist_status		    = $this->input->post("edit_countlist_status");
				$countlist_teamcount	    = $this->input->post("edit_countlist_teamcount"); 

         
      
        $postData=array();
		$countlistdata = [];
        
        $postData = dataFieldValidation($countlist_establishedyear, "Established Year",$countlistdata,"establishedyear","", $postData,"countlistarray");
        $postData = dataFieldValidation($countlist_projectcount, "Projects Count ",$countlistdata,"projectcount","","countlistarray");
        $postData = dataFieldValidation($countlist_clientcount, "Client Count",$countlistdata,"clientcount","", $postData,"countlistarray");
        $postData = dataFieldValidation($countlist_teamcount,"Team Count ",$countlistdata,"teamcount","", $postData,"countlistarray");
		$postData = dataFieldValidation($countlist_status,"Status",$countlistdata,"status","", $postData,"countlistarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        $userId = $this->ion_auth->get_user_id();
        $updatedlog=isUpdateLog($userId);
        $countlistarray = array_merge($postData['dbinput']['countlistarray'],$updatedlog);
        $updatecountlist = $this->CountList_model->countlistUpdate($countlistarray,$id);
         if($updatecountlist){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
			}else{
			    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			     }	
            }


public function deleteCountListById($id){ 
                     if(isset($id)&&$id>0){
		       	 $deleteMenus = $this->CountList_model->countlistDelete($id);
			    echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }

}
?>