<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class CityController extends BaseController {

		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Cities_model');
		}	
 

   public function cityView()
		{
          $this->load->view('admin/cityview');
        }

   public function listCity()
		{
      $citylist=$this->Cities_model->AllCitiesList();
	   echo json_encode(array('success'=>true,'data'=>$citylist));
     }

   public function editCityByid($id)
		{
	   $editCity=$this->Cities_model->editCity($id);
	   echo json_encode(array('success'=>true,'data'=>$editCity));
     }


     public function updateCityByid(){

                $city_id 					           =$this->input->post("edit_city_id");
                $city_name       			            = $this->input->post("edit_city_name");
                $city_shortcode       			        = $this->input->post("edit_city_shortcode");
                $city_state       			            = $this->input->post("edit_city_state");
                $city_status       			            = $this->input->post("edit_city_status");

           $postData=array();
		   $citysdata = [];
           
         $postData = dataFieldValidation($city_name, "City Name",$citysdata,"cityname","",$postData,"citysarray");
         $postData = dataFieldValidation($city_shortcode, "City Short Code",$citysdata,"short_code",$postData,"citysarray");
         $postData = dataFieldValidation($city_state, "City State",$citysdata,"state_id",$postData,"citysarray");
         $postData = dataFieldValidation($city_status, "City Status",$citysdata,"status","", $postData,"citysarray");

		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $citysarray = array_merge($postData['dbinput']['citysarray'],$updatedlog);
		$updateCity = $this->Cities_model->UpdateCity($citysarray,$city_id);
            
             if($updateCity){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateCity));
				return;
              }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				  return;
	
                  }	




            }


public function saveCity(){

               
                $city_name       			            = $this->input->post("add_city_name");
                $city_shortcode       			        = $this->input->post("add_city_shortcode");
                $city_state       			            = $this->input->post("add_city_state");
                $city_status       			            = $this->input->post("add_city_status");
           $postData=array();
		   $citysdata = [];
         $postData = dataFieldValidation($city_name, "City Name",$citysdata,"cityname","",$postData,"citysarray");
         $postData = dataFieldValidation($city_shortcode, "City Short Code",$citysdata,"short_code",$postData,"citysarray");
         $postData = dataFieldValidation($city_state, "City State",$citysdata,"state_id",$postData,"citysarray");
         $postData = dataFieldValidation($city_status, "City Status",$citysdata,"status","", $postData,"citysarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	 
        $citysarray = array_merge($postData['dbinput']['citysarray'],$createdlog);
        $addCity=$this->Cities_model->AddCity($citysarray);
            if($addCity){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addCity));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteCityById($id){ 

              if(isset($id)&&$id>0){
		       	$deleteCity = $this->Cities_model->DeleteCity($id);
			    echo json_encode(array('success'=>true,'data'=>$deleteCity));
                return;
			   }else{
		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
			   return;
					}
                    

            }








}
?>