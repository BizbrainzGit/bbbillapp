<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class CityMappingController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('CityMapping_model');
			
		}	
 

  public function citymappingView()
		{
          $this->load->view('admin/city_mapping_view');
      }

public function listCityMapping()
		{
	
      $CitymappingList=$this->CityMapping_model->CitymappingList();
	   echo json_encode(array('success'=>true,'data'=>$CitymappingList));
     }

public function editCitymappingByid($id)
		{
	
	   $editCity=$this->CityMapping_model->EditCitymapping($id);
	   echo json_encode(array('success'=>true,'data'=>$editCity));
     }


     public function updateCitymappingByid(){

                $user_id 					           =$this->input->post("edit_citymapping_id");
                $marketlead_user_name       			            = $this->input->post("edit_marketlead_user");
                $user_name       			            = $this->input->post("edit_user");
                $city_id       			                = $this->input->post("edit_mapping_city"); 
			
        $postData=array();
		$citymappingdata = [];

	  $postData = dataFieldValidation($marketlead_user_name, "Market lead User Name",$citymappingdata,"marketlead_user_id","",$postData,"citymappingarray");
      
      $postData = dataFieldValidation($user_name, "Markating User Name",$citymappingdata,"user_id","",$postData,"citymappingarray");
     
     if(isset($city_id) && !empty($city_id)){ 
        foreach($city_id as $key=>$udata){
                $city_name = $udata;
                 $postData = dataFieldValidation($city_name, "City Name ",$citymappingdata,"city_mapping_id",$postData,"citymappingarray".$key);
               }
          } 
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}


		 if(isset($city_id) && !empty($city_id)){  
         
         $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

         	$deleteCity = $this->CityMapping_model->DeleteCitymapping($user_id);

         if($deleteCity>0)
         {
	         	 foreach($city_id as $key=>$udata){
	                 $city_name  = $udata;
				      $mappingarray = array_merge(array('marketlead_user_id'=>$marketlead_user_name,'user_id'=>$user_name,'city_mapping_id'=>$city_name),$updatedlog);
          
				      $updateCityMapping= $this->CityMapping_model->Addcitymapping($mappingarray);
				     }
	     }else{

				 foreach($city_id as $key=>$udata){
	                 $city_name  = $udata;
				     $mappingarray = array_merge(array('marketlead_user_id'=>$marketlead_user_name,'user_id'=>$user_name,'city_mapping_id'=>$city_name),$updatedlog);
			        $updateCityMapping= $this->CityMapping_model->Addcitymapping($mappingarray);
			       }
			  }
        
          }		
            
            
             if($updateCityMapping){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveCityMapping(){

                $marketlead_user_name       		   = $this->input->post("add_marketlead_user");
                $user_name       			           = $this->input->post("add_user");
                $city_id       			               = $this->input->post("add_mapping_city"); 
			
				
           $postData=array();
		   $citymappingdata = [];
         

         $postData = dataFieldValidation($marketlead_user_name, "Market Lead User Name",$citymappingdata,"marketlead_user_id",[ValidationTypes::REQUIRED],$postData,"citymappingarray");
           
         $postData = dataFieldValidation($user_name, "User Name",$citymappingdata,"user_id",[ValidationTypes::REQUIRED],$postData,"citymappingarray");

     if(isset($city_id) && !empty($city_id)){ 
        foreach($city_id as $key=>$udata){
                $city_name = $udata;
                 $postData = dataFieldValidation($city_name, "City Name ",$citymappingdata,"city_mapping_id",[ValidationTypes::REQUIRED],$postData,"citymappingarray".$key);
        
               }
          } 

	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
          $userId = $this->ion_auth->get_user_id();
          $createdlog=isCreatedLog($userId);	 
 

   
		 if(isset($city_id) && !empty($city_id)){  
         foreach($city_id as $key=>$udata){
                 $city_name  = $udata;
			       $mappingarray = array_merge(array('marketlead_user_id'=>$marketlead_user_name,'user_id'=>$user_name,'city_mapping_id'=>$city_name),$createdlog);
			        $addCityMapping= $this->CityMapping_model->Addcitymapping($mappingarray);
			    }
                   if($addCityMapping){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			        }
			     else
					{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
					}

			  }
			  else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}		
				   
           	

            }

public function deleteCitymappingById($id){ 


               if(isset($id)&&$id>0){

				       	$deleteCity = $this->CityMapping_model->DeleteCitymapping($id);
					   if($deleteCity){
					   	         echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
					   	         return;
					     }else{
		                         echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
								return;
		                      }
				   }else{

			       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
							return;
				}
                    

         }








}
?>