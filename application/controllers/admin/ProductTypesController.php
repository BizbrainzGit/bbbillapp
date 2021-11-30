<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class ProductTypesController extends BaseController {
		public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('ProductType_model');
		}	
  public function producttypeView()
		    {
          $this->load->view('admin/producttypeview');
        }

   public function listProductType()
		{
        $producttypelist=$this->ProductType_model->SearchListProductTypes();
	      echo json_encode(array('success'=>true,'data'=>$producttypelist));
     }

   public function editProductTypeByid($id)
		{
	   $editProductType=$this->ProductType_model->EditProductType($id);
	   echo json_encode(array('success'=>true,'data'=>$editProductType));
     }


     public function updateProductTypeByid(){

                $producttype_id 					                =$this->input->post("edit_producttype_id");
                $producttype_name       			            = $this->input->post("edit_producttype_name");
                $producttype_status       			          = $this->input->post("edit_producttype_status");

           $postData=array();
		       $producttypesdata = [];
           
         $postData = dataFieldValidation($producttype_name, "ProductType Name",$producttypesdata,"product_type_name","",$postData,"producttypesarray");
         $postData = dataFieldValidation($producttype_status, "ProductType Status",$producttypesdata,"product_type_status","", $postData,"producttypesarray");

		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $producttypesarray = array_merge($postData['dbinput']['producttypesarray'],$updatedlog);
		   $updateProductType = $this->ProductType_model->UpdateProductType($producttypesarray,$producttype_id);
            
             if($updateProductType){
				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateProductType));
				return;
              }else{
                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				  return;
	
                  }	




            }


public function saveProductType(){

               
                $producttype_name       			            = $this->input->post("add_producttype_name");
                $producttype_status       			          = $this->input->post("add_producttype_status");
          
          $postData=array();
		      $producttypesdata = [];
         $postData = dataFieldValidation($producttype_name, "ProductType Name",$producttypesdata,"product_type_name","",$postData,"producttypesarray");
         $postData = dataFieldValidation($producttype_status, "ProductType Status",$producttypesdata,"product_type_status","", $postData,"producttypesarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

		$userId = $this->ion_auth->get_user_id();
        $createdlog=isCreatedLog($userId);	 
        $producttypesarray = array_merge($postData['dbinput']['producttypesarray'],$createdlog);
        $addProductType=$this->ProductType_model->AddProductType($producttypesarray);
            if($addProductType){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addProductType));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

// public function deleteProductTypeById($id){ 

//               if(isset($id)&&$id>0){
// 		       	$deleteProductType = $this->ProductType_model->DeleteProductType($id);
// 			    echo json_encode(array('success'=>true,'data'=>$deleteProductType));
//                 return;
// 			   }else{
// 		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
// 			   return;
// 					}
                    

//             }








}?>