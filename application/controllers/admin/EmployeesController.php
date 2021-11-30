<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/admin/BaseController.php');
use Illuminate\Database\Query\Expression as raw;
use Illuminate\Database\Capsule\Manager as Capsule;

class EmployeesController extends BaseController {

		public function __construct(){
		
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
		    $this->load->model('User');
		    $this->load->model('Address_model');
		    $this->load->model('Userdetails_model');
		
		}	
 

  public function employeesView()
		{
          $this->load->view('admin/employeesview');
      }


public function editEmployeesByid($id)
		{
	   $editEmployees=$this->Userdetails_model->EditEmployees($id);
	   echo json_encode(array('success'=>true,'data'=>$editEmployees));
     }

   public function editEmployeesStatusByid($id)
		{
	 		$result=User::where('id','=',$id)->get(['active','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
	     
        }


     public function updateEmployeesStatusByid(){

        $employees_status_id       			                    = $this->input->post("employees_status_id");
        $employees_status_change       			                = $this->input->post("employees_status_change"); 
			
        $postData=array();
		$changestatus = [];

	$postData = dataFieldValidation($employees_status_change, "Status",$changestatus,"active","",$postData,"statusarray");
	 if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		
        $updateStatus = $this->User->updateStatus($postData['dbinput']['statusarray'],$employees_status_id);
        // $updateStatus = $this->Userdetails_model->updateStatus($postData['dbinput']['statusarray'],$employees_status_id);
            
             if($updateStatus){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$updateStatus));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	
  }


     public function updateEmployeesData(){

                      $id 					               = $this->input->post("edit_employees_id");
                      $address_id 					       = $this->input->post("edit_employees_addid");
                      $user_id 				     	       = $this->input->post("edit_employees_userid");
                      $employees_role       		       = $this->input->post("edit_employees_role");
                      $employees_hno                       = $this->input->post("edit_employees_hno");
                      $employees_street                    = $this->input->post("edit_employees_street");
                      $employees_subarea                   = $this->input->post("edit_employees_subarea");
                      $employees_area                      = $this->input->post("edit_employees_area");
                      $employees_landmark                  = $this->input->post("edit_employees_landmark");
                      $employees_city                      = $this->input->post("edit_employees_city");
                      $employees_state                     = $this->input->post("edit_employees_state");
                      $employees_pincode                   = $this->input->post("edit_employees_pincode");


                      if(isset($employees_pincode) && !empty($employees_pincode)){
					$employees_pincode=$employees_pincode;
				}else{
					$employees_pincode=0;
				}
                      // $employees_employe_id       		   = $this->input->post("edit_employees_employe_id");
                      $employees_fname                     = $this->input->post("edit_employees_fname");
                      $employees_lname                     = $this->input->post("edit_employees_lname");
                      $employees_mobileno                  = $this->input->post("edit_employees_mobileno");
                      $employees_aadharno    		       = $this->input->post("edit_employees_aadharno");
                      
                      // $employees_email                     = $this->input->post("edit_employees_email");
                      // $employees_password                   = $this->input->post("edit_employees_password");
   //           $result= uniqueUserName($employees_employe_id,$id);

			// if($result>0)
			// {
			// 	echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
			// 	return;
			// }

          $oldimage =  Userdetails_model::where('id',$id)->get(['profile_pic_path']);//fetching from database table
		 json_encode(array('data'=>$oldimage)); 
		 $oldimage1= $oldimage[0]['profile_pic_path'];

			 $sourcePath= isset($_FILES['edit_employees_photo']['tmp_name'])?$_FILES['edit_employees_photo']['tmp_name']:'';
               
			if(!empty($sourcePath))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["edit_employees_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                 
    //            $fileinfo = @getimagesize($_FILES["edit_employees_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["edit_employees_photo"]["size"];
				//  if($width > "1200" || $height >"400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['edit_employees_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['edit_employees_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$imagepath =null;
				$image=$oldimage1;
				
			}
				
         $userId = $this->ion_auth->get_user_id();	
           $postData=array();
           
           $employeesdata = [];
         
         // $postData = dataFieldValidation($employees_fname, "First Name",$employeesdata,"first_name","",$postData,"employeesdataarray");
         // $postData = dataFieldValidation($employees_lname, "Last Name",$employeesdata,"last_name","", $postData,"employeesdataarray");

         // $postData = dataFieldValidation($employees_mobileno, "Mobile No",$employeesdata,"phone","", $postData,"employeesdataarray");
          //  $postData = dataFieldValidation($employees_password, "Password",$employeesdata,"password","", $postData,"employeesdataarray");
          // $postData = dataFieldValidation($employees_email, "Email",$employeesdata,"email","",$postData,"employeesdataarray");
          // $postData = dataFieldValidation($employees_email, "User Name",$employeesdata,"username","",$postData,"employeesdataarray");

          $postData= dataFieldValidation($employees_role, "Role ID",$employeesdata,"role_id","",$postData,"employeesdataarray");
          // $postData = dataFieldValidation($employees_employe_id, "User ID",$employeesdata,"username","",$postData,"employeesdataarray");
          // $postData = dataFieldValidation($employees_status, "Status",$employeesdata,"active","", $postData,"employeesdataarray");


          $employeesdetails=[];

         $postData = dataFieldValidation($image, "Photo",$employeesdetails,"profile_pic_path","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_fname, "First Name",$employeesdetails,"first_name","",$postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_lname, "Last Name",$employeesdetails,"last_name","", $postData,"employeesdetailsarray");
         
         $postData = dataFieldValidation($employees_mobileno, "Mobile No",$employeesdetails,"mobileno","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_aadharno, "Mobile No",$employeesdetails,"aadharno","", $postData,"employeesdetailsarray");
         
          
	     
            
           $employeesadressdata = [];

        $postData = dataFieldValidation($employees_hno, "Bulidding Numnber",$employeesadressdata,"house_no","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_street, "Street",$employeesadressdata,"street","", $postData,"employeesAddressarray");
        
         $postData = dataFieldValidation($employees_subarea, "Sub Area",$employeesadressdata,"sub_area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_area, "Area",$employeesadressdata,"area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_landmark, "LandMark",$employeesadressdata,"landmark","", $postData,"employeesAddressarray");

         $postData = dataFieldValidation($employees_city, "City",$employeesadressdata,"city_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_state, "State",$employeesadressdata,"state_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_pincode, "Pincode",$employeesadressdata,"pincode","", $postData,"employeesAddressarray");
     
		
		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
		 $userId = $this->ion_auth->get_user_id();
         $updatedlog=isUpdateLog($userId);

        //$employeesdataarray = array_merge($postData['dbinput']['employeesdataarray'],$updatedlog);
        $updateuser = $this->User->updateUserData($postData['dbinput']['employeesdataarray'],$user_id);

        $employeesAddressarray = array_merge($postData['dbinput']['employeesAddressarray'],$updatedlog);
        $updateaddress = $this->Address_model->updateAddress($employeesAddressarray,$address_id);

        $employeesdetailsarray = array_merge($postData['dbinput']['employeesdetailsarray'],$updatedlog);
		$updatedetails = $this->Userdetails_model->updateUserDetails($employeesdetailsarray,$id);
            
             if($updatedetails||$updateaddress|| $updateuser ){

				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));

				return;
	
                  }	




            }

public function saveEmployeesData(){


			$employees_hno       				       = $this->input->post("add_employees_hno");
			$employees_street       			       = $this->input->post("add_employees_street");
			$employees_subarea       				   = $this->input->post("add_employees_subarea");
			$employees_area       			           = $this->input->post("add_employees_area");
			$employees_landmark       			       = $this->input->post("add_employees_landmark");
			$employees_city       				       = $this->input->post("add_employees_city");
			$employees_state       			           = $this->input->post("add_employees_state");
			$employees_pincode       			       = $this->input->post("add_employees_pincode");

			if(isset($employees_pincode) && !empty($employees_pincode)){
					$employees_pincode=$employees_pincode;
				}else{
					$employees_pincode=0;
				}

			$employees_employe_id       		       = $this->input->post("add_employees_employe_id");
			$employees_fname       			           = $this->input->post("add_employees_fname");
			$employees_lname       				       = $this->input->post("add_employees_lname");
			$employees_mobileno       			       = $this->input->post("add_employees_mobileno");
			$employees_aadharno       			       = $this->input->post("add_employees_aadharno");
			$employees_email       				       = $this->input->post("add_employees_email");
			$employees_password       			       = $this->input->post("add_employees_password");
			$employees_role       			           = $this->input->post("add_employees_role");
			// $employees_status    			           = $this->input->post("add_employees_status");

            
            $result=uniqueMail($employees_email);
			
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMAIL_EXISTS_MSG));
				return; 
			}
            
            $id=null;
			$result= uniqueUserName($employees_employe_id,$id);
			if($result>0)
			{
				echo json_encode(array('success'=>false,'message'=>EMPID_EXISTS_MSG));
				return;
			}

		
			 $sourcePath1= isset($_FILES['add_employees_photo']['tmp_name'])?$_FILES['add_employees_photo']['tmp_name']:'';
                
			if(!empty($sourcePath1))
			{
				
				$target_dir = "assets/uploads/employees/";
				$target_file = $target_dir .basename($_FILES["add_employees_photo"]["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
			 //   $fileinfo = @getimagesize($_FILES["add_employees_photo"]["tmp_name"]);
    //            $width = $fileinfo[0];
    //            $height = $fileinfo[1];

				// $check = $_FILES["add_employees_photo"]["size"];
				//  if($width =! "1200" || $height =! "400"){
				// 	echo json_encode(array('success'=>false,'message'=>FILE_SIZE_ERR));
				// 	return;
				// }
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF")
					{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				} 
                  $temp=rand(0,100000).'_'; 
				$targetPath = FCPATH.$target_dir.$temp.$_FILES['add_employees_photo']['name']; // Target path where file is to be stored
				
				if(move_uploaded_file($sourcePath1,$targetPath)){

				$imagepath ="assets/uploads/employees/";
				$image=$imagepath.$temp.$_FILES['add_employees_photo']['name'];
				} else{
					echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
					return;
				}
				
			}else{
				$image=null;
				// echo json_encode(array('success'=>false,'message'=>IMAGE_TYPE_ERR));
				// 	return;
				
			}
		
		$userId = $this->ion_auth->get_user_id();	
           $postData=array();
           
           $employeesdata = [];
         
         
          $postData = dataFieldValidation($employees_password, "Password",$employeesdata,"password","", $postData,"employeesdataarray");
          $postData = dataFieldValidation($employees_email, "Email",$employeesdata,"email","",$postData,"employeesdataarray");
          $postData = dataFieldValidation($employees_employe_id, "User ID",$employeesdata,"username","",$postData,"employeesdataarray");
          $postData= dataFieldValidation($employees_role, "Role ID",$employeesdata,"role_id","",$postData,"employeesdataarray");
          // $postData = dataFieldValidation($employees_status, "Status",$employeesdata,"active","", $postData,"employeesdataarray");
	     

          $employeesdetails=[];

         $postData = dataFieldValidation($image, "Photo",$employeesdetails,"profile_pic_path","", $postData,"employeesdetailsarray");
        

         $postData = dataFieldValidation($employees_fname, "First Name",$employeesdetails,"first_name","",$postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_lname, "Last Name",$employeesdetails,"last_name","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_mobileno, "Mobile No",$employeesdetails,"mobileno","", $postData,"employeesdetailsarray");
         $postData = dataFieldValidation($employees_aadharno, "Aadhar No",$employeesdetails,"aadharno","", $postData,"employeesdetailsarray");

	     
            
           $employeesadressdata = [];

        $postData = dataFieldValidation($employees_hno, "Bulidding Numnber",$employeesadressdata,"house_no","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_street, "Street",$employeesadressdata,"street","", $postData,"employeesAddressarray");
        
         $postData = dataFieldValidation($employees_subarea, "Sub Area",$employeesadressdata,"sub_area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_area, "Area",$employeesadressdata,"area","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_landmark, "LandMark",$employeesadressdata,"landmark","", $postData,"employeesAddressarray");

         $postData = dataFieldValidation($employees_city, "City",$employeesadressdata,"city_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_state, "State",$employeesadressdata,"state_id","", $postData,"employeesAddressarray");
         $postData = dataFieldValidation($employees_pincode, "Pincode",$employeesadressdata,"pincode","", $postData,"employeesAddressarray");
     

		if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
			echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
			return;
		}
        
 
        $createdlog=isCreatedLog($userId);
		
		$employeedata=$postData['dbinput']['employeesdataarray'];
		$group = array($employees_role); 
		$userid=$this->ion_auth->register($employees_employe_id,$employees_password,$employees_email,$employeedata,$group);
       
        $employeesAddressarray=array_merge($postData['dbinput']['employeesAddressarray'],$createdlog);
       
        $addressid = $this->Address_model->addAddress($employeesAddressarray);
   
	    $userdetailsarray = array_merge( array('address_id'=>$addressid,'user_id'=>$userid),$postData['dbinput']['employeesdetailsarray']);
	   
	    $userdata_save = $this->Userdetails_model->addUserDetails($userdetailsarray);
		
          
            if($userdata_save){
               	echo json_encode(array('success'=>true,'message'=>SAVE_MSG));
				return;
			}
			else
			{
				echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				return;
			}	




            }



public function deleteEmployeesById($id)
		{
	
	   if(isset($id)&&$id>0){
           
            $getid=Userdetails_model::where('user_details.id','=',$id)->get();
            
             $deletedata=$this->Userdetails_model->DeleteEmployees($id);
	         $deleteAddress=$this->Address_model->deleteAddress($getid[0]['address_id']);
	         $deleteuser=$this->User->deleteUserById($getid[0]['user_id']);
                if($deletedata && $deleteAddress && $deleteuser ) {
			                
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

public function SearchEmployeeList()
		{
          
           $employee_name                 = $this->input->post("search_employee_name"); 
           $employee_city                 = $this->input->post("search_employee_city");
           $employee_mobileno             = $this->input->post("search_employee_mobileno"); 
           $employee_designation          = $this->input->post("search_employee_designation");
                   

          $searchdata=$this->Userdetails_model->SearchEmployee($employee_name,$employee_city,$employee_mobileno, $employee_designation);
            
           	echo json_encode(array('success'=>true,'data'=>$searchdata));
				return;
	   
		}




		 // Employees List Export Strat //

public function EmployeesExport(){

              $postdata = file_get_contents("php://input");
              $paging   = json_decode($postdata);


    $data=$this->Userdetails_model->EmployeesExportForAdmin();
    //print_r($data);
    if(isset($paging->export_type) && $paging->export_type=="excel"){
      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('Data');
      $this->excel->getActiveSheet()->setCellValue('A1', 'Employees List');
      $this->excel->getActiveSheet()->setCellValue('A2', 'S.No.');
      $this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
      $this->excel->getActiveSheet()->setCellValue('C2', 'Email Id');
      $this->excel->getActiveSheet()->setCellValue('D2', 'Employee Id');
      $this->excel->getActiveSheet()->setCellValue('E2', 'Designation');
      $this->excel->getActiveSheet()->setCellValue('F2', 'Mobile No');
      $this->excel->getActiveSheet()->setCellValue('G2', 'Aadhar No');
      $this->excel->getActiveSheet()->setCellValue('H2', 'City Name');
      $this->excel->getActiveSheet()->setCellValue('I2', 'Address');
      $this->excel->getActiveSheet()->mergeCells('A1:I1');

      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
      $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
      
      for($col = ord('A'); $col <= ord('I'); $col++){
            
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
    
        $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      }
    
      $exceldata="";
      $rowcount=3;
      
      if(count($data)>0){   
        foreach ($data as $row){
          
          // echo $row->id ;
          
          $this->excel->getActiveSheet()->SetCellValue('A'.$rowcount,$row->id);
              
          $this->excel->getActiveSheet()->SetCellValue('B'.$rowcount,$row->name);
          $this->excel->getActiveSheet()->SetCellValue('C'.$rowcount,$row->email);
          $this->excel->getActiveSheet()->SetCellValue('D'.$rowcount,$row->username);
          $this->excel->getActiveSheet()->SetCellValue('E'.$rowcount,$row->designation);
          $this->excel->getActiveSheet()->SetCellValue('F'.$rowcount,$row->mobileno);
          $this->excel->getActiveSheet()->SetCellValue('G'.$rowcount,$row->aadharno);
          $this->excel->getActiveSheet()->SetCellValue('H'.$rowcount,$row->cityname);
          $this->excel->getActiveSheet()->SetCellValue('I'.$rowcount,$row->address);
          
           $rowcount++;
        }
      }
      $filename='EmployeesList-'.date('YmdHis').'.xls'; 
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
      
      //$objWriter->save('php://output');
      $objWriter->save(FCPATH.'/assets/downloads/'.$filename);
      
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>'assets/downloads/'.$filename));
      return;
      
    }
    if(isset($paging->export_type) && $paging->export_type=='pdf'){
      
      $filename='EmployeesList-'.date('YmdHis').'.pdf';
      
      $data2['data']=$data;
      $data2['print']=0;
      
      //load the view and saved it into $html variable
      $html=$this->load->view('export/employeesExportPdf', $data2, true);
   
      //this the the PDF filename that user will get to download
      $pdfFilePath = FCPATH.'/assets/downloads/'.$filename;
   
      //load mPDF library
      $this->load->library('pdf');
   
       //generate the PDF from the given html
      
      $this->pdf->pdf->useSubstitutions = true;
    
      $this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath, "F");
      
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>'assets/downloads/'.$filename));
      return;
      
    }

    if(isset($paging->export_type) && $paging->export_type=='print'){
      $data2['data']=$data;
      $data2['print']=1;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/employeesExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }

  }


// Employees List Export End //
      

}
?>