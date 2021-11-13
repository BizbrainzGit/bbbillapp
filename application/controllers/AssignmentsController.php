<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class AssignmentsController extends CommonBaseController {
 public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Business_model'); 
			$this->load->model('BusinessPayments_model'); 
      $this->load->model('Assignments_model'); 
      $this->load->model('CityMapping_model');
      $this->load->model('Userdetails_model');
      $this->load->model('Sms_send_model');
      $this->load->model('Customdata_model');
		}	

 public function assignmentsViewForAdmin(){
          $this->load->view('admin/assignmentsview');
           }

 public function assignmentsViewForTelemarketing(){
          $this->load->view('tele-market/assignmentsview');
        }

 public function assignmentsViewFormarketingLead(){
          $this->load->view('market-lead/assignmentsview');
      }  

 public function assignmentsViewFormarketing(){
           $id= $this->ion_auth->get_user_id();
           $citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
          $this->load->view('market/assignmentsview',$citydata);
      }         

  // get Marketing Person For Assignments Start//

        public function getMarketingUsersForAssignments($id)
        {
          $cityiddata=Business_model::join('address','address.id','=','business_details.address_id')->where('business_details.id','=',$id)->get(['address.city_id']);
          $cityid = $cityiddata[0]['city_id'];   
           $Marketingname =$this->CityMapping_model->MarkrtingUsersListForAssignment($cityid);
           echo json_encode(array('success'=>true,'data'=>$Marketingname)); 
        }
  // get Marketing Person For Assignments End//

  // Add Assignments By Telemarketing  Start //  
  public function saveAssignments(){

         $id                                  = $this->input->post("add_business_id");
         $add_markrting_user                  = $this->input->post("add_assignment_markrting_user");
         $add_message                         = $this->input->post("add_message");
         $add_appointment_date                = $this->input->post("add_appointment_date"); 
         $add_appointment_date                = date("Y-m-d", strtotime($add_appointment_date) );
         $tele_caller_id                      = $this->ion_auth->get_user_id();
         $appointment_time                    = $this->input->post("add_appointment_time"); 
         $add_appointment_time                 = date("H:i", strtotime($appointment_time));
         // die();

      $add_appointment_time_to=date("H:i", strtotime('+30 minutes', strtotime($add_appointment_time)));
      $add_appointment_time_from=date("H:i", strtotime('-30 minutes',strtotime($add_appointment_time)));

      $getAssignmentMarketingExec=$this->Assignments_model->getAssignmentMarketingDetails($add_markrting_user,$add_appointment_date,$add_appointment_time_to,$add_appointment_time_from);


        if($getAssignmentMarketingExec==1){
              echo json_encode(array('success'=>false,'message'=>"Already Appointment Fixed to this Executive try for another Slot"));
              return; 
          }

      

         $postData=array();
         $assigmentdata = [];
         
         $postData = dataFieldValidation($id, "Id",$assigmentdata,"business_details_id",[ValidationTypes::REQUIRED],$postData,"assigmentarray");
           
         $postData = dataFieldValidation($add_markrting_user, "Select Marketing Users",$assigmentdata,"marketing_user_id",[ValidationTypes::REQUIRED],$postData,"assigmentarray");

         $postData = dataFieldValidation($add_message, "Type Your Massage",$assigmentdata,"message","",$postData,"assigmentarray");

         $postData = dataFieldValidation($add_appointment_date, "Appointment Date",$assigmentdata,"appointment_date",[ValidationTypes::REQUIRED],$postData,"assigmentarray");
         
         $postData = dataFieldValidation($tele_caller_id, "Tele Coller",$assigmentdata,"tele_marketing_user_id","",$postData,"assigmentarray"); 
         $postData = dataFieldValidation($add_appointment_time, "Tele Coller",$assigmentdata,"appointment_time","",$postData,"assigmentarray");
        
        $createdlog=isCreatedLog($tele_caller_id);
        $assigmentarray = array_merge($postData['dbinput']['assigmentarray'],$createdlog);
   

         $Addassigment= $this->Assignments_model->Addassigment($assigmentarray);
         // $tele_caller_id     = $this->ion_auth->get_user_id();
         // $listBusiness=$this->Assignments_model->AssignmentsAddview($id,$tele_caller_id);

         if($Addassigment){
                
       
         $marketing_user_id=$Addassigment->marketing_user_id ; 
         $tele_marketing_user_id=$Addassigment->tele_marketing_user_id ; 
         $business_details_id=$Addassigment->business_details_id ; 

        $marketing_leaddata=CityMapping_model::where('user_city_mapping.user_id','=',$marketing_user_id)->get(['marketlead_user_id']) ; 
        $marketing_lead_user_id=$marketing_leaddata[0]->marketlead_user_id;
           
          $telemarketing=$this->Userdetails_model->getdetailsForSms($tele_marketing_user_id);
          $marketing=$this->Userdetails_model->getdetailsForSms($marketing_user_id);
          $marketinglead=$this->Userdetails_model->getdetailsForSms($marketing_lead_user_id);

         $businessdata=Business_model::where('business_details.id','=',$business_details_id)->join('address','address.id','=','business_details.address_id')->leftjoin('cities','cities.cityid','=','address.city_id')->leftjoin('business_status','business_status.id','=','business_details.business_status_id') ->leftjoin('states','states.state_id','=','address.state_id')->get(['business_details.id','company_name', 'house_no', 'street', 'sub_area', 'area', 'landmark','pincode', 'person_name', 'landline_no', 'mobile_no', 'email', 'photo','cityname','state_name','alt_mobile_no','gst_company_name', 'gst_number', 'gst_state', 'gst_pincode', 'gst_pan_no', 'gst_address', 'website_url', 'facebook_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'instagram_url','business_status_id','business_details.business_id']);

          $app_date=$Addassigment->appointment_date;
          $app_time  = date("g:i A", strtotime($add_appointment_time));
  

          $company_name=$businessdata[0]->company_name;
          $person_name=$businessdata[0]->person_name;
          $company_mobile=$businessdata[0]->mobile_no;
            // $company_mobile="9703012666";
          $app_address=$businessdata[0]->street.",".$businessdata[0]->area.",".$businessdata[0]->cityname.",".$businessdata[0]->state_name.".";


         $marketing_name =$marketing->first_name." ".$marketing->last_name;
          $marketing_mobile=$marketing->mobileno;

         $marketing_leads_name=$marketinglead->first_name." ".$marketinglead->last_name;
          $marketing_leads_mobile=$marketinglead->mobileno;

         $telemarketing_name=$telemarketing->first_name." ".$telemarketing->last_name;
          $telemarketing_mobile=$telemarketing->mobileno; 

          $website_url= getHostURL(true).'websites';
          $buy_now= getHostURL(true).'buynow';

      $marketing_sms="Hello, *".$marketing_name."* Appointment for you with *Company Name: ".$company_name.", Person Name : ".$person_name.", Mobile No : ".$company_mobile.", Address : ".$app_address." on ".$app_date." ".$app_time.".* Message : ".$add_message." ,TME: ".$telemarketing_name.",".$telemarketing_mobile.".";

        //       $body=Customdata_model::where('content_type','=','Appointment-SMS')->first()->content;
        //       $body=str_replace("{MEName}",$marketing_name,$body);
        //       $body=str_replace("{CompanyName}",$company_name,$body);
        //       $body=str_replace("{PersonName}",$person_name,$body);
        //       $body=str_replace("{MobileNo}",$company_mobile,$body);
        //       $body=str_replace("{Address}",$app_address,$body);
        //       $body=str_replace("{AppDate}",$app_date,$body);
        //       $body=str_replace("{AppTime}",$app_time,$body);
        //       $body=str_replace("{AppMessage}",$add_message,$body);
        //       $body=str_replace("{TMEName}",$telemarketing_name,$body);
        //       $body=str_replace("{TMEMobileno}",$telemarketing_mobile,$body);
        // $marketing_sms=$body ;

      $customer_sms="Thanks for giving opportunity our manager ".$marketing_name." ".$marketing_mobile." will meet you on ".$app_date." ".$app_time.". click Link ".$website_url." "; 


          
      $x=sendMultiSMS($marketing_mobile,$marketing_sms);
      if($x){
        $vendor_id=1;
      $mobile_number=$marketing_mobile;
      $message=$marketing_sms;
      $response=$x;
         $postData=array();
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
           
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");

         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");

         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        $createdlog=isCreatedLog($tele_caller_id);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray);
      }

      
      $z=sendSMSApp($company_mobile,$customer_sms);   

      if($z){
      $vendor_id=1;
      $mobile_number=$company_mobile;
      $message=$customer_sms;
      $response=$z;
         $postData=array();
         $smsdata = [];
         $postData = dataFieldValidation($vendor_id, "Vendor Id",$smsdata,"vendor_id","",$postData,"smsarray");
         $postData = dataFieldValidation($mobile_number, "Mobile Number",$smsdata,"mobile_number","",$postData,"smsarray");
         $postData = dataFieldValidation($message, "Message",$smsdata,"message","",$postData,"smsarray");
         $postData = dataFieldValidation($response, "Response",$smsdata,"response","",$postData,"smsarray");
        $createdlog=isCreatedLog($tele_caller_id);
        $smsarray = array_merge($postData['dbinput']['smsarray'],$createdlog);
        $sendsms=$this->Sms_send_model->Smssend($smsarray);
          
          }

      // $x=sendMultiSMS('9985171676,9652589420,9666364606',$smstemplate);
     $dataurl="https://api.whatsapp.com/send?phone=+91".$marketing_mobile."&text=".$marketing_sms." ";
        echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$dataurl)); 
        return;
          } else {
            echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
            return;
          }

        }
// Add Assignments By Telemarketing  End //


// Search Assignments List Strat //

 public function SearchAssignmentslist()
		{
           $business_cname            = $this->input->post("search_businessassignments_cname"); 
           $business_city             = $this->input->post("search_businessassignments_city"); 
           
           $search_businessassignments_fromdate  = $this->input->post("search_businessassignments_fromdate"); 
           if($search_businessassignments_fromdate) {
               $business_fromdate  = date("Y-m-d", strtotime($search_businessassignments_fromdate) );
            }else{
           	  $business_fromdate=" " ;
            }

           $search_businessassignments_todate          = $this->input->post("search_businessassignments_todate");
          
           if($search_businessassignments_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_businessassignments_todate) );
           }else{
           	   $business_todate=" " ;
            }
          

         $userrole=$this->session->userdata('user_roles');
           if($userrole=="Marketing"){

              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              
           }else if($userrole=="Marketing-Lead"){

               // $city_id=$this->session->userdata('city_id');
               $city_id="";
               $userid=$this->ion_auth->get_user_id();

           }else if($userrole=="Tele-Marketing"){ 

               $city_id="";
               $userid=$this->ion_auth->get_user_id();
               
           }else{
                 $city_id="";
                 $userid="";
            }      
            
           $resultdata=$this->Assignments_model->SearchAssignments($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate); 
           	echo json_encode(array('success'=>true,'data'=>$resultdata,'role'=>$userrole));
				return;
	   
		}

// Search Assignments List End //


 // Assignments List Export Strat //

public function AssignmentsExport(){

    $postdata = file_get_contents("php://input");
    $paging   = json_decode($postdata);

           $business_cname = $paging->search_businessassignments_cname; 
           // die();
           $business_city  = $paging->search_businessassignments_city;
           $search_businessassignments_fromdate  =$paging->search_businessassignments_fromdate; 

           if($search_businessassignments_fromdate) {
               $business_fromdate  = date("Y-m-d", strtotime($search_businessassignments_fromdate) );
            }else{
              $business_fromdate=" " ;
            }
           $search_businessassignments_todate          = $paging->search_businessassignments_todate;
           if($search_businessassignments_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_businessassignments_todate) );
           }else{
               $business_todate=" " ;
            }

    $data=$this->Assignments_model->AssignmentsExportForAdmin($business_cname,$business_city,$business_fromdate,$business_todate);
    //print_r($data);

    if(isset($paging->export_type) && $paging->export_type=="excel"){
      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('Data');
      $this->excel->getActiveSheet()->setCellValue('A1', 'Assignments List');
      $this->excel->getActiveSheet()->setCellValue('A2', 'S.No.');
      $this->excel->getActiveSheet()->setCellValue('B2', 'Company Name');
      $this->excel->getActiveSheet()->setCellValue('C2', 'Person Name');
      $this->excel->getActiveSheet()->setCellValue('D2', 'Person Mobile');
      $this->excel->getActiveSheet()->setCellValue('E2', 'Message');
      $this->excel->getActiveSheet()->setCellValue('F2', 'Appointment Date & Time');
      $this->excel->getActiveSheet()->setCellValue('G2', 'Marketing Name');
      $this->excel->getActiveSheet()->setCellValue('H2', 'Work Assigned Date');
      $this->excel->getActiveSheet()->setCellValue('I2', 'Assigned By Tele-caller');
      $this->excel->getActiveSheet()->setCellValue('J2', 'Assigned By MarketLead');
      $this->excel->getActiveSheet()->setCellValue('K2', 'Status Message');
      $this->excel->getActiveSheet()->setCellValue('L2', 'Status Updated On');
      $this->excel->getActiveSheet()->setCellValue('M2', 'Status');
      
      $this->excel->getActiveSheet()->mergeCells('A1:M1');
      
      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
      $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
      
      for($col = ord('A'); $col <= ord('M'); $col++){
            
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
    
        $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      }
    
      $exceldata="";
      $rowcount=3;
      
      if(count($data)>0){   
        foreach ($data as $row){
          
          // echo $row->id ;

          $status_value=strip_tags($row->status_value);
          
          $this->excel->getActiveSheet()->SetCellValue('A'.$rowcount,$row->id);
          $this->excel->getActiveSheet()->SetCellValue('B'.$rowcount,$row->company_name);
          $this->excel->getActiveSheet()->SetCellValue('C'.$rowcount,$row->person_name);
          $this->excel->getActiveSheet()->SetCellValue('D'.$rowcount,$row->mobile_no);
          $this->excel->getActiveSheet()->SetCellValue('E'.$rowcount,$row->message);
          $this->excel->getActiveSheet()->SetCellValue('F'.$rowcount,$row->appointment_datetime);
          $this->excel->getActiveSheet()->SetCellValue('G'.$rowcount,$row->marketing_name);
          $this->excel->getActiveSheet()->SetCellValue('H'.$rowcount,$row->work_assigned_date);
          $this->excel->getActiveSheet()->SetCellValue('I'.$rowcount,$row->tele_name);
          $this->excel->getActiveSheet()->SetCellValue('J'.$rowcount,$row->marketlead_name);
          $this->excel->getActiveSheet()->SetCellValue('K'.$rowcount,$row->marketing_message);
          $this->excel->getActiveSheet()->SetCellValue('L'.$rowcount,$row->assignmentmsg_datetime);
          $this->excel->getActiveSheet()->SetCellValue('M'.$rowcount,$status_value);
          
           $rowcount++;
        }
      }
      $filename='AssignmentsList-'.date('YmdHis').'.xls'; 
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
      
      $filename='AssignmentsList-'.date('YmdHis').'.pdf';
      
      $data2['data']=$data;
      $data2['print']=0;
      
      //load the view and saved it into $html variable
      $html=$this->load->view('export/assignmentsExportPdf', $data2, true);
   
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
      $html=$this->load->view('export/assignmentsExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }

  }


// Assignments List Export End //

// Assignments Delete Start //

public function deleteAssignmentById($id)
       {
       if(isset($id)&&$id>0){
         
        $deleteassignment = $this->Assignments_model->DeleteAppointment($id);
             if($deleteassignment){
                   echo json_encode(array('success'=>true,'message'=>DELTE_MSG));
                   return;
              } else {
                 echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                 return;
             }
         }else {
            echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
          return;
          }
       }  


// Assignments Delete Start //

} ?>
