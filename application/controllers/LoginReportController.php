<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
error_reporting(1);
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class LoginReportController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
     $this->load->model('Userlogs_model');

    }

     public function AdminLoginReportView()
       {
         $this->load->view('admin/loginreportview');
       }

     public function MarketLeadLoginReportView()
       {
         $this->load->view('market-lead/loginreportview');
       }  

     public function listLoginReport()
		   {
         $resultdata=$this->User->listLoginReport();
	       echo json_encode(array('success'=>true,'data'=>$resultdata));
        }

     public function LoginReportExport(){
    
      $export_type = $this->input->post("export_type");
      $data=$this->User->listLoginReport();

    if(isset($export_type) && $export_type=='pdf'){

      $filename='Loginreport-'.date('YmdHis').'.pdf';
      $data2['data']=$data;

      $data2['print']=0;
      //load the view and saved it into $html variable
      $html=$this->load->view('export/loginreportExportPdf',$data2, true);
   
      //this the the PDF filename that user will get to download
      $pdfFilePath =FCPATH.'/assets/downloads/'.$filename;
   
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
      $data2['print']=1;
      $html=$this->load->view('export/loginreportExportPdf', $data2,true);
      echo json_encode(array('success'=>true,'message'=>DWNLOAD_MSG,'download_type'=>$export_type,'data'=>$html));
      return;
    }
  }
   

   public function UserLoginReportById($id)
       {
          $resultdata=$this->Userlogs_model->UserlogsDetailsById($id);
          echo json_encode(array('success'=>true,'data'=>$resultdata));
        }
} 
?>
