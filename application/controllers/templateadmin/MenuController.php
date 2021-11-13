<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/templateadmin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class MenuController extends BaseController {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
		$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
		$this->load->database();
		$this->load->model('Menu_model');
			
		}	
 

  public function menuView()
		{
          $this->load->view('templateadmin/menuview');
      }


public function editMenusByid($id)
		{
		   $editMenus=$this->Menu_model->editMenus($id);
		   echo json_encode(array('success'=>true,'data'=>$editMenus));
      }


     public function updateMenusByid(){

                $menu_id 					       =$this->input->post("edit_menu_id");
                $menu_name       			       = $this->input->post("edit_menu_name");
			    $menu_status       			       = $this->input->post("edit_menu_status"); 
			    $menu_urlname       			   = $this->input->post("edit_menu_urlname");
                $menu_titletag       			   = $this->input->post("edit_menu_titletag");
                $menu_metakeyword       		   = $this->input->post("edit_menu_metakeyword");
                $menu_metadescription              = $this->input->post("edit_menu_metadescription");

				
           $postData=array();
		   $menusdata = [];
           
         $postData = dataFieldValidation($menu_name, "Menus Name",$menusdata,"menu_name","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_status, "Menus Status",$menusdata,"status","",$postData,"menuarray"); 
          $postData = dataFieldValidation($menu_urlname, "Menus URL Name",$menusdata,"menu_urlname","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_titletag, "Menus Title Tag",$menusdata,"menu_titletag","",$postData,"menuarray");
          $postData = dataFieldValidation($menu_metakeyword, "Menus Meta KeyWords",$menusdata,"menu_metakeyword","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_metadescription, "Menus Meta Description",$menusdata,"menu_metadescription","",$postData,"menuarray");
        
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

       $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);
        $menuarray = array_merge($postData['dbinput']['menuarray'],$updatedlog);
		$updateMenus = $this->Menu_model->UpdateMenus($menuarray,$menu_id);
            
             if($updateMenus){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateMenus));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }


public function saveMenus(){

                $menu_name       			       = $this->input->post("add_menu_name");
                $menu_status       			       = $this->input->post("add_menu_status");
                $menu_urlname       			   = $this->input->post("add_menu_urlname");
                $menu_titletag       			   = $this->input->post("add_menu_titletag");
                $menu_metakeyword       		   = $this->input->post("add_menu_metakeyword");
                $menu_metadescription              = $this->input->post("add_menu_metadescription");
          
           $postData=array();
		   $menusdata = [];
         $postData = dataFieldValidation($menu_name, "Menus Name",$menusdata,"menu_name","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_status, "Menus Status",$menusdata,"status","",$postData,"menuarray");
          $postData = dataFieldValidation($menu_urlname, "Menus URL Name",$menusdata,"menu_urlname","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_titletag, "Menus Title Tag",$menusdata,"menu_titletag","",$postData,"menuarray");
          $postData = dataFieldValidation($menu_metakeyword, "Menus Meta KeyWords",$menusdata,"menu_metakeyword","",$postData,"menuarray");
         $postData = dataFieldValidation($menu_metadescription, "Menus Meta Description",$menusdata,"menu_metadescription","",$postData,"menuarray");
	
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}

	   $userId = $this->ion_auth->get_user_id();
       $createdlog=isCreatedLog($userId);	
       $menuarray = array_merge($postData['dbinput']['menuarray'],$createdlog);
       $addMenus=$this->Menu_model->AddMenus($menuarray);
            if($addMenus){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$addMenus));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	

            }

public function deleteMenusById($id){ 


                     if(isset($id)&&$id>0){

		       	$deleteMenus = $this->Menu_model->DeleteMenus($id);
			   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));

			   }else{

		       echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

						return;
					}
                    

            }


public function MenusList()
		{
          
           $searchdata=$this->Menu_model->ListMenus();
		   echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;	
             
		} 





}
?>