<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class KeywordsController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('BusinessKeywords_model');
			
		}	
 

  public function keywordsView()
		{
          $this->load->view('admin/keywordsview');
      }


public function editKeywordsByid($id)
		{
	
	   $editKeywords=$this->BusinessKeywords_model->editKeywords($id);
	   echo json_encode(array('success'=>true,'data'=>$editKeywords));
     }


     public function updateKeywordsByid(){

                $keywords_id 					               =$this->input->post("edit_keywords_id");
                $keywords_name       			               = $this->input->post("edit_keywords_name");
			   $keywords_category       			           = $this->input->post("edit_keywords_category"); 

				
           $postData=array();
		   $keywordssdata = [];
           
         $postData = dataFieldValidation($keywords_name, "Keywords Name",$keywordssdata,"keywords","",$postData,"keywordsarray");
         $postData = dataFieldValidation($keywords_category, "Keywords Amount",$keywordssdata,"category_id","",$postData,"keywordsarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $businesskeywordsarray = array_merge($postData['dbinput']['keywordsarray'],$updatedlog);
		$updateKeywords = $this->BusinessKeywords_model->UpdateKeywords($businesskeywordsarray,$keywords_id);
            
             if($updateKeywords){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateKeywords));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveKeywords(){

               
                $keywords_name       			           = $this->input->post("add_keywords_name");
                $keywords_category       			       = $this->input->post("add_keywords_category");
              
				
           $postData=array();
		   $keywordssdata = [];
           
         $postData = dataFieldValidation($keywords_name, "Keywords Name",$keywordssdata,"keywords","",$postData,"keywordsarray");
         $postData = dataFieldValidation($keywords_category, "Keywords Category",$keywordssdata,"category_id","",$postData,"keywordsarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	

       $businesskeywordsarray = array_merge($postData['dbinput']['keywordsarray'],$createdlog);

        $addKeywords=$this->BusinessKeywords_model->AddKeywords($businesskeywordsarray);
				
				   
            if($addKeywords){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addKeywords));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteKeywordsById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteKeywords = $this->BusinessKeywords_model->DeleteKeywords($id);
			   echo json_encode(array('success'=>true,'data'=>$deleteKeywords));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function SearchKeywordsList()
		{
          
           $business_keyword = $this->input->post("search_demo_keyword"); 
           $searchdata=$this->BusinessKeywords_model->SearchBusinessKeywordsforBusiness($business_keyword);
		   
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>