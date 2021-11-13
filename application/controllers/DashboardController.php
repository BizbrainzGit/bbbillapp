<?php defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/CommonBaseController.php');
ob_start();
use Illuminate\Database\Query\Expression as raw;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class DashboardController extends CommonBaseController {
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->library(array('form_validation','ValidationTypes','excel','session','ion_auth'));
		 $this->load->helper(array('url','html','form','util_helper','language'));
		 $this->load->database();
		 $this->load->model('User');
		 $this->load->model('Userdetails_model');
		 $this->load->model('Status_model');
		 $this->load->model('Cities_model');
		 $this->load->model('States_model');
     $this->load->model('Business_model');
     $this->load->model('Address_model');
     $this->load->model('PaymentType_model');
     $this->load->model('BusinessPaymentmode_model');
     $this->load->model('Campaigns_model');
     $this->load->model('BusinessCampaign_model');
     $this->load->model('BusinessOwner_model');
     $this->load->model('BusinessEmp_model');
     $this->load->model('Promocode_model');
     $this->load->model('BusinessPayments_model');
     $this->load->model('Packages_model');
     $this->load->model('Subpackages_model');
     $this->load->model('Demowebsites_model');
     $this->load->model('CategoriesList_model');
     $this->load->model('BusinessKeywords_model');
     $this->load->model('Customdata_model');
     $this->load->model('UserGroups_model');
     $this->load->model('BusinessPackage_model');
     $this->load->model('CityMapping_model');
     $this->load->model('Assignments_model');
     $this->load->model('BusinessPaymentTransaction_model');
     $this->load->model('Sms_send_model');
     $this->load->model('Project_status_model');

    }

   public function ProjectList()
    { 
     $city_id=""; $userid="";
      $searchdata=$this->Business_model->ProjectStatusList($city_id,$userid);
            echo json_encode(array('success'=>true,'data'=>$searchdata));
        return;
     
    }
 

 public function EmployeeSaleReportsList()
    { 
       
        $month= date('Y-m', strtotime('0 month'));
        $monthview= date('M Y', strtotime('0 month'));
        $userrole=$this->session->userdata('user_roles');
           if($userrole==MARKET_EXEC){
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
           }else if($userrole==MARKET_LEAD){ 
               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();
           }else if($userrole==TELE_MARKET){ 
                $city_id="";
                $userid=$this->ion_auth->get_user_id();
           }else{
               $city_id="";
               $userid="";
            }    
       $resultdata=$this->BusinessPayments_model->EmployeeSaleReport($city_id,$userid,$month);
            echo json_encode(array('success'=>true,'data'=>$resultdata,'userrole'=>$userrole, 'monthview'=>$monthview));
        return;
     
    }

    public function EmployeeSaleReportsListByMonth($id)
    {  
            
               // $month=$id;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){
                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
               
          $userrole=$this->session->userdata('user_roles');
           if($userrole==MARKET_EXEC){
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
           }else if($userrole==MARKET_LEAD){ 
               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();
           }else if($userrole==TELE_MARKET){ 
                $city_id="";
                $userid=$this->ion_auth->get_user_id();
           }else{
               $city_id="";
               $userid="";
            }      
            

            $resultdata=$this->BusinessPayments_model->EmployeeSaleReport($city_id,$userid,$month);
            echo json_encode(array('success'=>true,'data'=>$resultdata,'userrole'=>$userrole, 'monthview'=>$monthview));
           return;


    }
    
    
   public function AllSalesListForDashboard()
		{  
            
          $userrole=$this->session->userdata('user_roles');
           if($userrole==MARKET_EXEC){
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
           }else if($userrole==MARKET_LEAD){ 
               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();
           }else if($userrole==TELE_MARKET){ 
                $city_id="";
                $userid=$this->ion_auth->get_user_id();
           }else{
               $city_id="";
               $userid="";
            }      
            
            $month=date('Y-m');
            
            $offlinesale=$this->BusinessPayments_model->OfflineSales($city_id,$userid,$month);
            $onlinesale=$this->BusinessPayments_model->OnlineSales($city_id,$userid,$month);
            $paymenttypesale=$this->BusinessPayments_model->PaymentTypeSales($city_id,$userid,$month);
           	echo json_encode(array('success'=>true,'offlinesale'=>$offlinesale,'onlinesale'=>$onlinesale,'paymenttypesale'=>$paymenttypesale));

		}


// public function AllSalesListForDashboard()
//       {  
//           $userrole=$this->session->userdata('user_roles');
//           $month=date('Y-m');
//           $monthview=date('M Y');

//           $alltodayappt=0;
//           $alltotalappt=0;
          
//           $today=date("Y-m-d");
//            if($userrole==MARKET_EXEC){
              
//               $city_id=$this->session->userdata('city_id');
//               $userid=$this->ion_auth->get_user_id();
//               $todayappt=$this->Assignments_model->TodayAppointmentsForMarketingDashboard($userid,$today,$city_id);
//               $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingDashboard($userid,$month,$city_id);


//            }else if($userrole==MARKET_LEAD){
//                 $userid=$this->ion_auth->get_user_id();
//                 $city_id="";
//                 $todayappt=$this->Assignments_model->TodayAppointmentsForMarketingDashboard($userid,$today,$city_id);
//                 $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingDashboard($userid,$month,$city_id);

//                $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
//                $useries=implode(",",$useries);
//                $alltodayappt=$this->Assignments_model->TodayAppointmentsForMarketingLeadDashboard($today,$useries);
//                $alltotalappt=$this->Assignments_model->TotalAppointmentsForMarketingLeadDashboard($month,$useries);


//            }else if($userrole==TELE_MARKET){ 

//                 $userid=$this->ion_auth->get_user_id();
//                 $todayappt=$this->Assignments_model->TodayAppointmentsForTelemarketingDashboard($userid,$today);
//                 $totalappt=$this->Assignments_model->TotalAppointmentsForTelemarketingDashboard($userid,$month);

//            }else if($userrole=="Admin"){
               
//                $todayappt=$this->Assignments_model->TodayAppointmentsForAdminDashboard($today);
//                $totalappt=$this->Assignments_model->TotalAppointmentsForAdminDashboard($month);
//             }      
          
//             echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todayappt'=>$todayappt,'totalappt'=>$totalappt,'alltodayappt'=>$alltodayappt,'alltotalappt'=>$alltotalappt));

//     }



	public function AllSalesListForDashboardByMonth($id)
		{  
            
               // $month=$id;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
               	    $month= date('Y-m', strtotime('-1 month'));
               }elseif($id==3){

               	 $month= date('Y-m', strtotime('-2 month'));
               }elseif($id==4){

               	 $month= date('Y-m', strtotime('-3 month'));
               }
               
          $userrole=$this->session->userdata('user_roles');
           if($userrole==MARKET_EXEC){
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
           }else if($userrole==MARKET_LEAD){ 
               $city_id=$this->session->userdata('city_id');
               $userid=$this->ion_auth->get_user_id();
           }else if($userrole==TELE_MARKET){ 
                $city_id="";
                $userid=$this->ion_auth->get_user_id();
           }else{
               $city_id="";
               $userid="";
            }      
            
            $offlinesale=$this->BusinessPayments_model->OfflineSales($city_id,$userid,$month);
            $onlinesale=$this->BusinessPayments_model->OnlineSales($city_id,$userid,$month);
            $paymenttypesale=$this->BusinessPayments_model->PaymentTypeSales($city_id,$userid,$month);
           	echo json_encode(array('success'=>true,'offlinesale'=>$offlinesale,'onlinesale'=>$onlinesale,'paymenttypesale'=>$paymenttypesale));

		}



public function AllAppointmentForDashboard()
      {  
          $userrole=$this->session->userdata('user_roles');
          $month=date('Y-m');
          $monthview=date('M Y');

          $alltodayappt=0;
          $alltotalappt=0;
          
          $today=date("Y-m-d");
           if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $todayappt=$this->Assignments_model->TodayAppointmentsForMarketingDashboard($userid,$today,$city_id);
              $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingDashboard($userid,$month,$city_id);


           }else if($userrole==MARKET_LEAD){
                $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $todayappt=$this->Assignments_model->TodayAppointmentsForMarketingLeadDashboard($today,$userid);
                $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingLeadDashboard($month,$userid);

               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltodayappt=$this->Assignments_model->TodayAppointmentsForMarketingLeadDashboard($today,$useries);
               $alltotalappt=$this->Assignments_model->TotalAppointmentsForMarketingLeadDashboard($month,$useries);


           }else if($userrole==TELE_MARKET){ 

                $userid=$this->ion_auth->get_user_id();
                $todayappt=$this->Assignments_model->TodayAppointmentsForTelemarketingDashboard($userid,$today);
                $totalappt=$this->Assignments_model->TotalAppointmentsForTelemarketingDashboard($userid,$month);

           }else{
               
               $todayappt=$this->Assignments_model->TodayAppointmentsForAdminDashboard($today);
               $totalappt=$this->Assignments_model->TotalAppointmentsForAdminDashboard($month);
            }      
          
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todayappt'=>$todayappt,'totalappt'=>$totalappt,'alltodayappt'=>$alltodayappt,'alltotalappt'=>$alltotalappt));

    }




public function AllAppointmentListForDashboardByMonth($id)
    {  
            $userrole=$this->session->userdata('user_roles');
            $today=date("Y-m-d");
            $alltodayappt=0;
            $alltotalappt=0;
               // $month=$id;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){

                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
               
//            // echo date('Y-m', strtotime('-2 month'));
//            // echo date('Y-m', strtotime('-3 month'));
         if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingDashboard($userid,$month,$city_id);

           }else if($userrole==MARKET_LEAD){
               $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $totalappt=$this->Assignments_model->TotalAppointmentsForMarketingDashboard($userid,$month,$city_id);
               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltotalappt=$this->Assignments_model->TotalAppointmentsForMarketingLeadDashboard($month,$useries);

           }else if($userrole==TELE_MARKET){ 

                $userid=$this->ion_auth->get_user_id();
                $totalappt=$this->Assignments_model->TotalAppointmentsForTelemarketingDashboard($userid,$month);

           }else{
               
               $totalappt=$this->Assignments_model->TotalAppointmentsForAdminDashboard($month);
            }
            
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'totalappt'=>$totalappt,'alltotalappt'=>$alltotalappt));

    }


public function AllDealcloseForDashboard()
      {  
          $userrole=$this->session->userdata('user_roles');
          $month=date('Y-m');
          $monthview=date('M Y');

          $alltodaydealclose=0;
          $alltotaldealclose=0;
          
          $today=date("Y-m-d");
           if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $todaydealclose=$this->Business_model->TodayDealcloseForMarketingDashboard($userid,$today,$city_id);
              $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);


           }else if($userrole==MARKET_LEAD){
                $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $todaydealclose=$this->Business_model->TodayDealcloseForMarketingDashboard($userid,$today,$city_id);
                $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);

               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltodaydealclose=$this->Business_model->TodayDealcloseForMarketingLeadDashboard($today,$useries);
               $alltotaldealclose=$this->Business_model->TotalDealcloseForMarketingLeadDashboard($month,$useries);


           }else if($userrole==TELE_MARKET){ 
                $userid=$this->ion_auth->get_user_id();
                $todaydealclose=$this->Business_model->TodayDealcloseForTelemarketingDashboard($userid,$today);
                $totaldealclose=$this->Business_model->TotalDealcloseForTelemarketingDashboard($userid,$month);

           }else{
               
               $todaydealclose=$this->Business_model->TodayDealcloseForAdminDashboard($today);
               $totaldealclose=$this->Business_model->TotalDealcloseForAdminDashboard($month);
            }      
          
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todaydealclose'=>$todaydealclose,'totaldealclose'=>$totaldealclose,'alltodaydealclose'=>$alltodaydealclose,'alltotaldealclose'=>$alltotaldealclose));

    }

public function AllDealcloseListForDashboardByMonth($id)
    {  
            $userrole=$this->session->userdata('user_roles');
            $today=date("Y-m-d");
            $alltodaydealclose=0;
            $alltotaldealclose=0;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){

                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
 
         if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);

           }else if($userrole==MARKET_LEAD){
               $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $totaldealclose=$this->Business_model->TotalDealcloseForMarketingDashboard($userid,$month,$city_id);
               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltotaldealclose=$this->Business_model->TotalDealcloseForMarketingLeadDashboard($month,$useries);

           }else if($userrole==TELE_MARKET){ 

                $userid=$this->ion_auth->get_user_id();
                $totaldealclose=$this->Business_model->TotalDealcloseForTelemarketingDashboard($userid,$month);

           }else{
               
               $totaldealclose=$this->Business_model->TotalDealcloseForAdminDashboard($month);
            }
            
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'totaldealclose'=>$totaldealclose,'alltotaldealclose'=>$alltotaldealclose));

    }




public function AllMonthlySalesForDashboard()
      {  
          $userrole=$this->session->userdata('user_roles');
          $month=date('Y-m');
          $monthview=date('M Y');
          $alltodaymonthlysales=0;
          $alltotalmonthlysales=0;
          
          $today=date("Y-m-d");
           if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingDashboard($userid,$today,$city_id);
              $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);


           }else if($userrole==MARKET_LEAD){
                $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingDashboard($userid,$today,$city_id);
                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);

               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltodaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForMarketingLeadDashboard($today,$useries);
               $alltotalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingLeadDashboard($month,$useries);


           }else if($userrole==TELE_MARKET){ 
                $userid=$this->ion_auth->get_user_id();
                $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForTelemarketingDashboard($userid,$today);
                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForTelemarketingDashboard($userid,$month);

           }else{
               
               $todaymonthlysales=$this->BusinessPayments_model->TodayMonthlySalesForAdminDashboard($today);
               $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForAdminDashboard($month);
            }      
          
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'todaymonthlysales'=>$todaymonthlysales,'totalmonthlysales'=>$totalmonthlysales,'alltodaymonthlysales'=>$alltodaymonthlysales,'alltotalmonthlysales'=>$alltotalmonthlysales));

    }
    
public function AllMonthlySalesListForDashboardByMonth($id)
    {  
            $userrole=$this->session->userdata('user_roles');
            $alltodaymonthlysales=0;
            $alltotalmonthlysales=0;
               // $month=$id;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){

                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
               
//            // echo date('Y-m', strtotime('-2 month'));
//            // echo date('Y-m', strtotime('-3 month'));
         if($userrole==MARKET_EXEC){
              
              $city_id=$this->session->userdata('city_id');
              $userid=$this->ion_auth->get_user_id();
              $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);

           }else if($userrole==MARKET_LEAD){
               $userid=$this->ion_auth->get_user_id();
                $city_id="";
                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingDashboard($userid,$month,$city_id);
               $useries=CityMapping_model::where('marketlead_user_id','=',$userid)->pluck('user_id')->toArray();
               $useries=implode(",",$useries);
               $alltotalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForMarketingLeadDashboard($month,$useries);

           }else if($userrole==TELE_MARKET){ 

                $userid=$this->ion_auth->get_user_id();
                $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForTelemarketingDashboard($userid,$month);

           }else{
               
               $totalmonthlysales=$this->BusinessPayments_model->TotalMonthlySalesForAdminDashboard($month);
            }
            
            echo json_encode(array('success'=>true,'userrole'=>$userrole, 'monthview'=>$monthview, 'totalmonthlysales'=>$totalmonthlysales,'alltotalmonthlysales'=>$alltotalmonthlysales));

    }

public function AllSalesForDashboardByCitywise()
      {  
          $userrole=$this->session->userdata('user_roles');
          $month=date('Y-m');
          $monthview=date('M Y');
          $todaycitywisesales=0;
          $totalcitywisesales=0;
          $today=date("Y-m-d");
            
            $todaycitywisesales=$this->BusinessPayments_model->TodaySalesForDashboardByCitywise($today);
            $totalcitywisesales=$this->BusinessPayments_model->TotalSalesForDashboardByCitywise($month);
            echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'todaycitywisesales'=>$todaycitywisesales,'data'=>$totalcitywisesales));

      }
      
public function AllSalesForDashboardByCitywiseMonth($id)
    {  
            $userrole=$this->session->userdata('user_roles');
            $alltodaymonthlysales=0;
            $alltotalmonthlysales=0;
               // $month=$id;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){
                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
            
             $totalcitywisesales=$this->BusinessPayments_model->TotalSalesForDashboardByCitywise($month);
            echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'data'=>$totalcitywisesales));

    }


    public function AllAppointmentsForDashboardByCitywise()
      {  
          $userrole=$this->session->userdata('user_roles');
          $month=date('Y-m');
          $monthview=date('M Y');
          // $todaycitywiseappointments=0;
          // $totalcitywisesales=0;
          $today=date("Y-m-d");
          
          $todaycitywiseappointments=$this->Assignments_model->TodayAppointmentsForDashboardByCitywise($today);
            // $totalcitywisesales=$this->BusinessPayments_model->TotalSalesForDashboardByCitywise($month);
            echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'todaycitywiseappointments'=>$todaycitywiseappointments));

      }
      
public function AllAppointmentsForDashboardByCitywiseMonth($id)
    {  
            $userrole=$this->session->userdata('user_roles');
            // $alltodaymonthlysales=0;
            // $alltotalmonthlysales=0;
               if($id==1){
                    $month= date('Y-m', strtotime('0 month'));
                    $monthview= date('M Y', strtotime('0 month'));
               }elseif($id==2){
                    $month= date('Y-m', strtotime('-1 month'));
                    $monthview= date('M Y', strtotime('-1 month'));
               }elseif($id==3){

                 $month= date('Y-m', strtotime('-2 month'));
                 $monthview= date('M Y', strtotime('-2 month'));
               }elseif($id==4){
                 $month= date('Y-m', strtotime('-3 month'));
                 $monthview= date('M Y', strtotime('-3 month'));
               }
            
             $totalcitywisesales=$this->Assignments_model->TotalAppointmentsForDashboardByCitywise($month);
             echo json_encode(array('success'=>true, 'monthview'=>$monthview, 'data'=>$totalcitywisesales));

    }


} ?>
