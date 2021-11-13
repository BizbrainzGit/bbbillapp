<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
error_reporting(0);
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;

class DealClosedController extends CommonBaseController {
 public function __construct(){
			parent::__construct();
			$this->load->helper(array('form','url','file','captcha','html','language','util_helper'));
			$this->load->library(array('session', 'form_validation', 'email','ion_auth','ValidationTypes'));
			$this->load->database();
			$this->load->model('Business_model'); 
			$this->load->model('BusinessPayments_model'); 
			$this->load->model('BusinessPaymentTransaction_model'); 
      $this->load->model('CityMapping_model');
      $this->load->model('BusinessPayments_model');
      $this->load->model('Packages_model');
      $this->load->model('Campaigns_model');
      $this->load->model('Customdata_model');
		}	


 public function dealclosedViewForAccounts(){
          $this->load->view('accountant/dealclosedview');
           }

 public function dealclosedViewForAdmin(){
          $this->load->view('admin/dealclosedview');
           }

 public function dealclosedViewForTelemarketing(){
          $this->load->view('tele-market/dealclosedview');
      }
 public function dealclosedViewFormarketingLead(){
          $this->load->view('market-lead/dealclosedview');
      }  
 public function dealclosedViewFormarketing(){
          $id= $this->ion_auth->get_user_id();
          $citydata['citydata']=$this->CityMapping_model->CitySelectedCount($id);
          $this->load->view('market/dealclosedview',$citydata);
      }         



 public function SearchDealClosedlist()
		{
          
           $business_cname            = $this->input->post("search_businessdealclosed_cname"); 
           $business_city             = $this->input->post("search_businessdealclosed_city"); 
           
           $search_businessdealclosed_fromdate  = $this->input->post("search_businessdealclosed_fromdate"); 
           if($search_businessdealclosed_fromdate) {
               $business_fromdate  = date("Y-m-d", strtotime($search_businessdealclosed_fromdate) );
            }else{
           	  $business_fromdate=" " ;
            }

           $search_businessdealclosed_todate          = $this->input->post("search_businessdealclosed_todate");
          
           if($search_businessdealclosed_todate ) {
               $business_todate = date("Y-m-d", strtotime($search_businessdealclosed_todate) );
           }else{
           	   $business_todate=" " ;
            }
          

         $userrole=$this->session->userdata('user_roles');
           if($userrole=="Marketing"){

              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              
           }else if($userrole=="Marketing-Lead"){

               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();

           }else if($userrole=="Tele-Marketing"){ 

               $city_id="";
               $userid=$this->ion_auth->get_user_id();
               
           }else{
                $city_id="";
                $userid="";
            }      
            
           $resultdata=$this->BusinessPayments_model->SearchBusinessDealclosedList($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate);
           	echo json_encode(array('success'=>true,'data'=>$resultdata,'role'=>$userrole));
				return;
	   
		}


public function editProjectStatusByid($id)
		{
	
	 		$result=BusinessPayments_model::where('id','=',$id)->get(['project_status_id','id']);
	        echo json_encode(array('success'=>true,'data'=>$result));
	     
        }
        
 public function ProjectupdateStatusByid(){

           $project_change_status_id       			            = $this->input->post("project_change_status_id");
           $project_change_status       			                = $this->input->post("project_change_status"); 
			
          $postData=array();
      		$projectchangestatus = [];
      		$postData = dataFieldValidation($project_change_status, " Project Status",$projectchangestatus,"project_status_id","",$postData,"projectstatusarray");
        $projectupdateStatus = $this->BusinessPayments_model->updateStatusproject($postData['dbinput']['projectstatusarray'],$project_change_status_id);
            
             if($projectupdateStatus){
      				echo json_encode(array('success'=>true,'message'=>UPDATE_MSG,'data'=>$projectupdateStatus));
      				return;
				
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
				       return;
	
                  }	
        }

// Deal closed List Export Strat //
public function dealclosedListExport(){

     $postdata = file_get_contents("php://input");
     $paging   = json_decode($postdata);
     
     $data=$this->BusinessPayments_model->BusinessDealclosedListExport();
    //print_r($data);

    if(isset($paging->export_type) && $paging->export_type=="excel"){
      $this->excel->setActiveSheetIndex(0);
      $this->excel->getActiveSheet()->setTitle('Data');
      $this->excel->getActiveSheet()->setCellValue('A1', 'Business Dealclosed List');
      $this->excel->getActiveSheet()->setCellValue('A2', 'S.No.');
      $this->excel->getActiveSheet()->setCellValue('B2', 'Company Name');
      $this->excel->getActiveSheet()->setCellValue('C2', 'Business Id');
      $this->excel->getActiveSheet()->setCellValue('D2', 'Person Name');
      $this->excel->getActiveSheet()->setCellValue('E2', 'Mobile No');
      $this->excel->getActiveSheet()->setCellValue('F2', 'City Name');
      $this->excel->getActiveSheet()->setCellValue('G2', 'Package Name');
      $this->excel->getActiveSheet()->setCellValue('H2', 'Compain Name');
      $this->excel->getActiveSheet()->setCellValue('I2', 'Package Grand Total Amount');
      $this->excel->getActiveSheet()->setCellValue('J2', 'Package Date');
      $this->excel->getActiveSheet()->setCellValue('K2', 'Transaction Amount');
      $this->excel->getActiveSheet()->setCellValue('L2', 'Deal Closed Date');
      $this->excel->getActiveSheet()->setCellValue('M2', 'Package Given By');
      $this->excel->getActiveSheet()->setCellValue('N2', 'Business Created By');
     
      $this->excel->getActiveSheet()->mergeCells('A1:N1');
      
      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
      $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
      
      for($col = ord('A'); $col <= ord('N'); $col++){
            
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
    
        $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      }
    
      $exceldata="";
      $rowcount=3;
      
      if(count($data)>0){   
        foreach ($data as $row){
          
          $this->excel->getActiveSheet()->SetCellValue('A'.$rowcount,$row->id);
          $this->excel->getActiveSheet()->SetCellValue('B'.$rowcount,$row->company_name);
          $this->excel->getActiveSheet()->SetCellValue('C'.$rowcount,$row->business_id);
          $this->excel->getActiveSheet()->SetCellValue('D'.$rowcount,$row->person_name);
          $this->excel->getActiveSheet()->SetCellValue('E'.$rowcount,$row->mobile_no);
          $this->excel->getActiveSheet()->SetCellValue('F'.$rowcount,$row->cityname);
          $this->excel->getActiveSheet()->SetCellValue('G'.$rowcount,$row->package_name);
          $this->excel->getActiveSheet()->SetCellValue('H'.$rowcount,$row->campaign_name);
          $this->excel->getActiveSheet()->SetCellValue('I'.$rowcount,$row->gstgrand_total_amount);
          $this->excel->getActiveSheet()->SetCellValue('J'.$rowcount,$row->payment_created_on);
          $this->excel->getActiveSheet()->SetCellValue('K'.$rowcount,$row->transaction_amount);
          $this->excel->getActiveSheet()->SetCellValue('L'.$rowcount,$row->dealclosed_created_on);
          $this->excel->getActiveSheet()->SetCellValue('M'.$rowcount,$row->package_created_name);
          $this->excel->getActiveSheet()->SetCellValue('N'.$rowcount,$row->business_created_name);
          
           $rowcount++;
        }
      }
      $filename='DealclosedList-'.date('YmdHis').'.xls'; 
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
      
      $filename='DealclosedList-'.date('YmdHis').'.pdf';
      
      $data2['data']=$data;
      $data2['print']=0;
      
      //load the view and saved it into $html variable
      $html=$this->load->view('export/dealclosedlistExportPdf', $data2, true);
   
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
      $html=$this->load->view('export/dealclosedlistExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$paging->export_type,'data'=>$html));
      return;
    }

  }

// Deal closed List Export End //


  public function deleteDealClosedById($id){

           if(isset($id)&&$id>0){

           $business_package_id=$id ;
           // $getid =  Business_model::where('id',$id)->get(['address_id']);//fetching from database table
           // $deleteresult = $this->Business_model->deleteBusiness($id);
            
           //$deleteresult=$this->BusinessPayments_model->deleteBusinessPackages($business_package_id);
           $deleteresult=$this->BusinessPaymentTransaction_model->deleteBusinessPackageTransctions($business_package_id);
                      echo json_encode(array('success'=>true,'message'=>DELTE_MSG,'data'=>$deleteresult));
                      return;
            }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                     return;
          }

    }


    // editInvoiceNo Start //

  public function editInvoiceNoById($id){

            $result=BusinessPayments_model::where('business_package_id','=',$id)->get(['receipt_no','business_package_id']);

                if($result){
                      echo json_encode(array('success'=>true,'data'=>$result));
                      return;
                   }else{
                     echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                     return;
                   }

    }


     public function updateInvoiceByid(){

           $business_package_id                        = $this->input->post("edit_invoiceno_selectedid");
           $invoiceno_receipt_no                       = $this->input->post("edit_invoiceno_receipt_no"); 
      
          $postData=array();
          $packageinvoiceno = [];
          $postData = dataFieldValidation($invoiceno_receipt_no,"Receipt No",$packageinvoiceno,"receipt_no","",$postData,"packageinvoicenoarray");

          if(isset($postData['errorslist']) && count($postData['errorslist'])>0){
                 echo json_encode(array('success'=>false,'message'=>$postData['errorslist']));
                 return;
            }

            $userId = $this->ion_auth->get_user_id();
             // $createdlog=isCreatedLog($userId);
             $paymenttransactionarray = array_merge($postData['dbinput']['packageinvoicenoarray']);
             $updateresult =$this->BusinessPayments_model->updateInvoiceNo($paymenttransactionarray,$business_package_id);

             if($updateresult){
              echo json_encode(array('success'=>true,'message'=>UPDATE_MSG));
              return;
              }else{

                  echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
                  return;
  
                  } 
        }


  //  invoice started //


         public function BusinessInvoice($id)
        {   
                  
              $Businessinvoice=$this->BusinessPayments_model->Invoice($id);
               $campaign = $Businessinvoice[0]['campaign_id'];
               $package = $Businessinvoice[0]['package_id'];
               $package_id = $Businessinvoice[0]['business_package_id'];
         $packageslist=array();
         $campaignlist=array();
               if($campaign!=null){
                 $array = explode(',', $campaign);
                  for($i=0;$i<count($array);$i++){
                      $campaignlist[] = Campaigns_model::where('id','=',$array[$i])->get(['campaign_name','campaign_amount']);
                  }
               
               }
             if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                      $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }
             }
               

                $invoiceData=$this->BusinessPaymentTransaction_model->InvoiceData($package_id);

             if(count($Businessinvoice)>0&&count($invoiceData)>0){
                   echo json_encode(array('success'=>true,'message'=>SAVE_MSG,'data'=>$Businessinvoice,'campaigndata'=>$campaignlist,'packagesdata'=>$packageslist,'invoicedata'=>$invoiceData));
                return;

             }else{
                    echo json_encode(array('success'=>false,'message'=>SERVER_ERROR));
             return;
             }
                

     
        }


public function invoiceExport(){
    
    // $postdata = file_get_contents("php://input");
    // $paging   = json_decode($postdata);
    // //$data=$this->Vendor_model->vendorDataDetails($paging);
   $id = $this->input->post("business_invoice_selectedid");
     $export_type = $this->input->post("export_type");
     
      $data=$this->BusinessPayments_model->Invoice($id);
               $campaign = $data[0]['campaign_id'];
               $package = $data[0]['package_id'];
               $package_id = $data[0]['business_package_id'];
               if($campaign!=null){
                 $array = explode(',', $campaign);
                  for($i=0;$i<count($array);$i++){
                      $campaignlist[] = Campaigns_model::where('id','=',$array[$i])->get(['campaign_name','campaign_amount']);
                  }
               
               }
             if($package!=null){
                  $array = explode(',', $package);
                  for($i=0;$i<count($array);$i++){
                      $packageslist[] = Packages_model::where('id','=',$array[$i])->get(['package_name','package_amount']);
               }
             }
       $invoiceData=$this->BusinessPaymentTransaction_model->InvoiceData($id);

    if(isset($export_type) && $export_type=='pdf'){
      
      $filename='Invoice-'.$id.'-'.date('YmdHis').'.pdf';
      $data2['data']=$data;
      $data2['campaignlist']=$campaignlist;
      $data2['packageslist']=$packageslist;
        $data2['invoicedata']=$invoiceData;
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/invoiceExportPdf',$data2, true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
      //load mPDF library
      $this->load->library('pdf');
       //generate the PDF from the given html
      $this->pdf->pdf->useSubstitutions = true;
      $this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath,"F");
      $file='assets/downloads/'.$filename;
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$file));
      //echo $file;
      return;
      
    }

    if(isset($export_type) && $export_type=='print'){
      $data2['data']=$data;
      $data2['campaignlist']=$campaignlist;
      $data2['packageslist']=$packageslist;
      $data2['invoicedata']=$invoiceData;
      $data2['print']=1;
      $html=$this->load->view('export/invoiceExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
      return;
    }
  }



public function invoiceSendToMail(){

     $id = $this->input->post("business_invoice_selectedid");
     $export_type = $this->input->post("export_type");
     $data=$this->BusinessPayments_model->Invoice($id);
     $business_email=$data[0]['email'];
     $filename='Invoice-'.$id.'-'.date('YmdHis').'.pdf';
      $data2['data']=$data;
      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/invoiceExportPdf',$data2, true);
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'assets/downloads/'.$filename;
      //load mPDF library
      $this->load->library('pdf');
       //generate the PDF from the given html
      $this->pdf->pdf->useSubstitutions = true;
      $this->pdf->pdf->WriteHTML($html);
      //download it.
      ob_clean();
      $this->pdf->pdf->Output($pdfFilePath,"F");
        
        

        $receiptsubject1='Invoice';
        $recipt_subject='Invoice';
    // $recipt_url = getHostURL(true).'websites';
    $name=$business_cname;
        $hiuser = ucfirst($name);
    $receiptbody1=Customdata_model::where('content_type','=','Receipt')->first()->content;
    $receiptbody1=str_replace("{CompanyName}",$hiuser,$receiptbody1);
    // $receiptbody1=str_replace("{URL}",$url1,$receiptbody1);
    echo $attachments='assets/downloads/'.$filename;
       
       $result=sendEmail("bizbrainz2020@gmail.com","Administrator",$business_email,$receiptsubject1,$receiptbody1,$attachments);
       
       if($result){
         echo json_encode(array('success'=>true,'message'=>MAILSEND_SUCCESS_MSG));
              return;
        }else{

          echo json_encode(array('success'=>false,'message'=>MAILSEND_FAIL_MSG,));
              return;
        }
        
}


} ?>
