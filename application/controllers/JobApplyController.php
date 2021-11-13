
<?php defined('BASEPATH') OR exit('No direct script access allowed');
// include_once(APPPATH . 'controllers/CommonBaseController.php');
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
class JobApplyController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','Excel_reader','ValidationTypes','email'));
		$this->load->helper(array('url','html','form','util_helper','language'));
		$this->load->database();
		$this->load->model('JobApply_model'); 
		$this->load->model('Customdata_model');
	   
	}

public function saveApplyJob(){
                         
            $applyjob_id     	           = $this->input->post("add_applyjob_id");
            $applyjob_firstname            = $this->input->post("add_applyjob_firstname");   
            $applyjob_lastname     	       = $this->input->post("add_applyjob_lastname");
			$applyjob_emailid              = $this->input->post("add_applyjob_emailid");
		    $applyjob_mobileno		       = $this->input->post("add_applyjob_mobileno");
		    $applyjob_address		       = $this->input->post("add_applyjob_address");
		    $applyjob_message		       = $this->input->post("add_applyjob_message");
		    $applyjob_qualification		       = $this->input->post("add_applyjob_qualification");


            $sourcePath1= isset($_FILES['add_applyjob_file']['tmp_name'])?$_FILES['add_applyjob_file']['tmp_name']:'';
			if(!empty($sourcePath1))
			{
				$target_dir = "assets/uploads/applyjob/";
				$target_file = $target_dir .basename($_FILES["add_applyjob_file"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = $_FILES["add_applyjob_file"]["size"];
				 // if($check==false){
					// echo json_encode(array('success'=>false,'message'=>FILE_TYPE_ERR));
					// return;
				 // }
				 
				if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" && $imageFileType != "DOCX" && $imageFileType != "DOC" && $imageFileType != "PDF")
					{
					echo json_encode(array('success'=>false,'message'=>RESUME_TYPE_ERR));
					return;
				} 
                
                $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_applyjob_file']['name']; // Target path where file is to be stored
				// echo __DIR__  ;
                 // echo $check = $_FILES["add_applyjob_file"]["error"];

				if(move_uploaded_file($sourcePath1,$targetPath)){
				$imagepath ="assets/uploads/applyjob/";
				$file1=$imagepath.$temp.$_FILES['add_applyjob_file']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>RESUME_NOT_UPLOADED));
					return;
				}
				
			}else{
				$imagepath =null;
				$file1=null;
				echo json_encode(array('success'=>false,'message'=>RESUME_NOT_UPLOADED));
					return;
				
			}
      
        $postData=array();
		$applyjobdata = [];
        
        $postData = dataFieldValidation($applyjob_id, "Job Id",$applyjobdata,"job_id","", $postData,"applyjobarray");
        $postData = dataFieldValidation($applyjob_firstname, "First Name",$applyjobdata,"first_name","","applyjobarray");
        $postData = dataFieldValidation($applyjob_lastname, "Last Name",$applyjobdata,"last_name","", $postData,"applyjobarray");
         $postData = dataFieldValidation($applyjob_emailid, "Designation",$applyjobdata,"email","", $postData,"applyjobarray");
		$postData = dataFieldValidation($applyjob_mobileno,"Mobile No",$applyjobdata,"mobileno","", $postData,"applyjobarray");
		$postData = dataFieldValidation($applyjob_address,"Status",$applyjobdata,"address","", $postData,"applyjobarray");
		$postData = dataFieldValidation($applyjob_message,"Status",$applyjobdata,"message","", $postData,"applyjobarray");
		$postData = dataFieldValidation($applyjob_qualification,"Status",$applyjobdata,"qualification","", $postData,"applyjobarray");

		$postData = dataFieldValidation($file1,"Image",$applyjobdata,"resume","", $postData,"applyjobarray");

		if(isset($postData['errorslist'])&& count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		} 
		$userId =Null;
        $createdlog=isCreatedLog($userId);	
        $applyjobarray = array_merge($postData['dbinput']['applyjobarray'],$createdlog);
        $addapplyjob = $this->JobApply_model->addapplyjob($applyjobarray);
       if($addapplyjob){

       	$subject='Apply For Job';
       	$url = getHostURL(true).$file1;
		$name= $applyjob_firstname." ".$applyjob_lastname;
        $hiuser = ucfirst($name);
		$body1=Customdata_model::where('content_type','=','Apply Job')->first()->content;
		$body1=str_replace("{name}",$hiuser,$body1);
		$body1=str_replace("{email}",$applyjob_emailid,$body1);
		$body1=str_replace("{mobileno}",$applyjob_mobileno,$body1);
		$body1=str_replace("{qualification}",$applyjob_qualification,$body1);
		$body1=str_replace("{URL}",$url,$body1);
		$attachments=null; 

		$x=sendEmail("info@bizbrainz.in","Administrator","baburaot@bizbrainz.in",$subject,$body1,$attachments);

						echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
						return;
	                }else{
						echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
						return;
			        }	

            }


}
?>