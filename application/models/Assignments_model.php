<?php 
 use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class Assignments_model extends Eloquent {
    public $timestamps = false;
    protected $table = "assignments"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_details_id','message','tele_marketing_user_id','marketing_user_id','appointment_date','created_ip','created_by','created_on','	modified_ip','modified_by','modified_on','marketlead_user_id','appointment_time','marketing_message','assignment_status','is_update','next_followup_date'];
    
    function Addassigment($assigmentarray){
		$addresult=self::create($assigmentarray);
		return $addresult;
	} 

    function getAssignments($id){
		$result=self::where('assignments.business_details_id','=',$id)->get(['assignments.id','assignments.message','assignments.marketing_user_id']);
		return $result;
	}

	function updateAssignments($assignmentarray,$id){
		$result=self::where('assignments.id','=',$id)->update($assignmentarray);
		return $result;
	}

    function ListAssignments()
	{
		$query=self::leftjoin('business_details','business_details.id','=','assignments.business_details_id')
		           ->get(['assignments.id','assignments.message','business_details.company_name','business_details.person_name','business_details.email','business_details.mobile_no', new raw('DATE_FORMAT(assignments.appointment_date, "%d-%m-%Y") as appointment_date'), new raw('DATE_FORMAT(assignments.created_on, "%d-%m-%Y") as work_assigned_date')]);
		return $query;
	}

  
  function SearchAssignments($userid,$city_id,$business_cname,$business_city,$business_fromdate,$business_todate){
    if($city_id!=''){
			$city_id="\n AND address.city_id ='$city_id'";
		  }
		else{
			$city_id="";
		 }
		if($userid!=''){
			$userid="\n AND(assignments.tele_marketing_user_id ='$userid' OR  assignments.marketing_user_id ='$userid')";
		}
		else{
			$userid="";
		}
     //Search Values 
		 if($business_todate!=' '&&$business_fromdate!=''){
			$searchdate="\n  AND assignments.appointment_date BETWEEN '$business_fromdate' AND '$business_todate'";
		  }else{
			$searchdate=" ";
		  }
		if($business_cname!=''){
			$sreachcname="\n AND business_details.company_name like '%$business_cname%'";
		 }else{
			$sreachcname="";
		 }
		if($business_city!=''){
			$sreachcityname="\n AND address.city_id ='$business_city'";
		}else{
			$sreachcityname="";
		}   

     $searchagentData=Capsule::select("SELECT assignments.id as id, assignments.message,business_details.company_name,business_details.person_name,DATE_FORMAT( assignments.appointment_date,'%d-%m-%Y') as appointment_date,DATE_FORMAT(assignments.appointment_time,'%h:%i:%s %p') as appointment_time,DATE_FORMAT(assignments.created_on,'%d-%m-%Y') as work_assigned_date,CONCAT(user_details.first_name,' ',user_details.last_name) as marketing_name,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketlead_name,marketing_message,DATE_FORMAT(assignments.modified_on,'%d-%m-%Y %h:%i:%s %p') as assignmentmsg_datetime, DATE_FORMAT(CONCAT(appointment_date,' ',appointment_time),'%d-%m-%Y %h:%i:%s %p') as appointment_datetime,status_value,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname
		from assignments
		left join user_details on user_details.user_id=assignments.marketing_user_id 
		left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
		left join user_details udd on udd.user_id=assignments.marketlead_user_id
		join business_details on business_details.id=assignments.business_details_id 
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		left join business_status on business_status.id = assignments.assignment_status
	   WHERE assignments.id !=0".$userid.$city_id.$searchdate.$sreachcname.$sreachcityname);     
	   return $searchagentData;
	    }


		function DeleteAppointment($id)
		    {
			$deleteresult=self::where('assignments.id','=',$id)->delete();
		       return $deleteresult;
		    }  


function SendSmsBerforeAppointmentTime(){
           $searchagentData=Capsule::select("SELECT assignments.id as id, assignments.message,business_details.company_name,business_details.person_name,DATE_FORMAT(assignments.appointment_date,'%d-%m-%Y') as appointment_date,CONCAT(user_details.first_name,' ',user_details.last_name) as marketing_name,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketlead_name,marketing_user_id,appointment_time,cast(concat(appointment_date, ' ', appointment_time) as datetime) as appointment_datetime,business_details_id,
		from assignments
		left join user_details on user_details.user_id=assignments.marketing_user_id 
		left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
		left join user_details udd on udd.user_id=assignments.marketlead_user_id
		join business_details on business_details.id=assignments.business_details_id 
		join address on address.id = business_details.address_id WHERE  assignments.id !=0 ");     
	return $searchagentData;

	}



	function AssignmentsAddview($id,$tele_caller_id){

		$result=self::join('user_details','user_details.user_id','=','assignments.marketing_user_id')->where('assignments.business_details_id','=',$id)->where('assignments.tele_marketing_user_id','=',$tele_caller_id)->get(['assignments.id','assignments.message',new raw('DATE_FORMAT(assignments.appointment_date, "%d-%m-%Y") as appointment_date'), new raw('DATE_FORMAT(assignments.created_on, "%d-%m-%Y") as work_assigned_date'),new raw('CONCAT(user_details.first_name," ",user_details.last_name) as marketing_name'),]);
		return $result;

	}


function TodayAppointmentListForMarketingLead($today,$useries)
	{
		//$useries=explode(",",$useries);
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details as ud','ud.user_id','=','assignments.marketing_user_id')
	             ->join('user_details as udd','udd.user_id','=','assignments.tele_marketing_user_id')
	             ->leftjoin('business_status','business_status.id','=','business_details.business_status_id') 
	             ->WhereIn('assignments.marketing_user_id',$useries)
	             ->where(new raw('date(assignments.appointment_date)'), '=',$today)
	             ->get(['assignments.id as assignment_id','business_details.id','company_name','person_name','mobile_no','message', new raw('DATE_FORMAT(assignments.appointment_date, "%d-%m-%Y") as appointment_date'),new raw('CONCAT(ud.first_name," ",ud.last_name) as personname'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time'),'status_value', new raw('CONCAT(udd.first_name ,"",udd.last_name) as tele_marketing_name'),new raw('CONCAT(ud.first_name ,"",ud.last_name) as marketing_name')]);
		return $query;
	
	}

  function AppointmentUpdateTodayFormarketinglead($today,$useries,$apptime)
	{
		//$useries=explode(",",$useries);
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details as ud','ud.user_id','=','assignments.marketing_user_id')
	             ->join('user_details as udd','udd.user_id','=','assignments.tele_marketing_user_id')
	             ->leftjoin('business_status','business_status.id','=','business_details.business_status_id') 
	             ->WhereIn('assignments.marketing_user_id',$useries)
	             ->where(new raw('date(assignments.appointment_date)'), '=',$today)
	             ->where('assignments.is_update','=',0)
                 ->where(new raw("(DATE_FORMAT(assignments.appointment_time,'%H:%i:%s'))"),'<',$apptime)
	             ->get(['assignments.id as assignment_id','business_details.id','company_name','person_name','mobile_no','message', new raw('DATE_FORMAT(assignments.appointment_date, "%d-%m-%Y") as appointment_date'),new raw('CONCAT(ud.first_name," ",ud.last_name) as personname'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time'),'status_value', new raw('CONCAT(udd.first_name ,"",udd.last_name) as tele_marketing_name'),new raw('CONCAT(ud.first_name ,"",ud.last_name) as marketing_name')]);
		return $query;
	
	}	
   

	 function BusinessListTodayFormarketing($today,$city_id,$userid)
	{
		$query = self::join('business_details','business_details.id','=','assignments.business_details_id')->join('address','address.id','=','business_details.address_id')
		   ->join('user_details','user_details.user_id','=','assignments.tele_marketing_user_id')
		   ->leftjoin('business_status','business_status.id','=','business_details.business_status_id')
		   ->where('assignments.appointment_date', 'LIKE', '%' . $today . '%')
		   ->where('assignments.marketing_user_id','=',$userid)
		   ->where('address.city_id','=',$city_id)
		   ->get(['assignments.id as assignment_id','business_details.id','company_name','person_name','mobile_no','message','status_value','state_id',new raw('CONCAT(user_details.first_name ,"",user_details.last_name) as tele_marketing_name'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time')]);
	    return $query;
	}
  
   function StatusPopupTodayFormarketing($today,$city_id,$userid,$todaytime)
	{
		$query = self::join('business_details','business_details.id','=','assignments.business_details_id')->join('address','address.id','=','business_details.address_id')
		   ->join('user_details','user_details.user_id','=','assignments.tele_marketing_user_id')
		   ->leftjoin('business_status','business_status.id','=','business_details.business_status_id')
		   ->where('assignments.appointment_date', 'LIKE', '%' . $today . '%')
		   ->where('assignments.marketing_user_id','=',$userid)
		   ->where('address.city_id','=',$city_id)
		   ->where('assignments.appointment_time', '<',$todaytime)
		   ->where('assignments.is_update','=',0)
		   // ->where('assignments.appointment_time', '>', new raw('unix_timestamp(NOW())'))
		   ->orderBy('assignments.appointment_time', 'ASC')
		   ->get(['assignments.id as assignment_id','business_details.id','company_name','person_name','mobile_no','message','status_value','state_id',new raw('CONCAT(user_details.first_name ,"",user_details.last_name) as tele_marketing_name'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time')]);
	    return $query;
	}

 function AppointmentUpdateTodayFormarketing($today,$city_id,$userid,$apptime)
	{
		$query = self::join('business_details','business_details.id','=','assignments.business_details_id')->join('address','address.id','=','business_details.address_id')
           ->join('user_details','user_details.user_id','=','assignments.tele_marketing_user_id')
           ->leftjoin('business_status','business_status.id','=','business_details.business_status_id')
           ->where('assignments.appointment_date', 'LIKE', '%' . $today . '%')
           ->where('assignments.marketing_user_id','=',$userid)
           ->where('address.city_id','=',$city_id)
           ->where('assignments.is_update','=',0)
           ->where(new raw("(DATE_FORMAT(assignments.appointment_time,'%H:%i:%s'))"),'<',$apptime)
           ->get(['assignments.id as assignment_id','business_details.id','company_name','person_name','mobile_no','message','status_value','state_id','is_update',new raw('CONCAT(user_details.first_name ,"",user_details.last_name) as tele_marketing_name'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time')]) ;
	    return $query;
	}

	// function TodayAppointmentListForTeleMarketing($today,$userid)
	// {

	// $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	//              ->join('address','address.id','=','business_details.address_id')
	//              ->join('user_details','user_details.user_id','=','assignments.marketing_user_id')
	//              ->where('tele_marketing_user_id', '=', $userid)
	//              ->where(new raw('date(assignments.created_on)'),'=',$today)

	//              ->get(['business_details.id','company_name','person_name','mobile_no','message', new raw('DATE_FORMAT(assignments.appointment_date, "%d-%m-%Y") as appointment_date'),new raw('CONCAT(user_details.first_name," ",user_details.last_name) as personname'),new raw('DATE_FORMAT(assignments.appointment_time, "%l:%i:%p") as appointment_time')]);
	// 	return $query;
	
	// } 
   
   
	function AllBusinessListToday($today)
	{
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	->where(new raw('date(appointment_date)'),'=',$today)->get();

		return $query;
	}

function TodayAppointmentsForTelemarketingDashboard($userid,$today){
             
         $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details','user_details.user_id','=','assignments.marketing_user_id')
	             ->where('tele_marketing_user_id', '=', $userid)
	            ->where(new raw('date(assignments.created_on)'),'=',$today)
	             ->get()
	             ->count();
		return $query;

	}

function TotalAppointmentsForTelemarketingDashboard($userid,$month){
         $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details','user_details.user_id','=','assignments.marketing_user_id')
	             ->where('tele_marketing_user_id', '=', $userid)
	             ->where(new raw("(DATE_FORMAT(assignments.created_on,'%Y-%m'))"), '=',$month)
	             ->get()
	             ->count();
		return $query;

	}


	function TodayAppointmentsForMarketingDashboard($userid,$today,$city_id){
             
         $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details','user_details.user_id','=','assignments.marketing_user_id')
	             ->where('marketing_user_id', '=', $userid)
	             ->where(new raw('date(assignments.appointment_date)'), '=',$today)
	             ->where('address.city_id','=',$city_id)
	             ->get()
	             ->count();
		return $query;

	}

function TotalAppointmentsForMarketingDashboard($userid,$month,$city_id){
         $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details','user_details.user_id','=','assignments.marketing_user_id')
	             ->where('marketing_user_id', '=', $userid)
	             ->where(new raw("(DATE_FORMAT(assignments.appointment_date,'%Y-%m'))"), '=',$month)
	             ->where('address.city_id','=',$city_id)
	             ->get()
	             ->count();
		return $query;

	}

	function TodayAppointmentsForMarketingLeadDashboard($today,$useries)
	{
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details as ud','ud.user_id','=','assignments.marketing_user_id')
	             ->join('user_details as udd','udd.user_id','=','assignments.tele_marketing_user_id')
	            ->leftjoin('business_status','business_status.id','=','business_details.business_status_id') 
	             ->WhereIn('assignments.marketing_user_id',[$useries])
	             ->where(new raw('date(assignments.appointment_date)'), '=',$today)
	             ->get() 
	             ->count();
		return $query;
	
	}

	function TotalAppointmentsForMarketingLeadDashboard($month,$useries)
	{
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	             ->join('address','address.id','=','business_details.address_id')
	             ->join('user_details as ud','ud.user_id','=','assignments.marketing_user_id')
	             ->join('user_details as udd','udd.user_id','=','assignments.tele_marketing_user_id')
	             ->leftjoin('business_status','business_status.id','=','business_details.business_status_id') 
	             ->WhereIn('assignments.marketing_user_id',[$useries])
	             ->where(new raw("(DATE_FORMAT(assignments.appointment_date,'%Y-%m'))"), '=',$month)
	             ->get() 
	             ->count();
		return $query;
	
	}	

function TodayAppointmentsForAdminDashboard($today)
	{
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')->where('appointment_date', 'LIKE', '%' . $today . '%')->get()->count();
		return $query;
	}
function TotalAppointmentsForAdminDashboard($month)
	{
	$query = self::join('business_details','business_details.id','=','assignments.business_details_id')->where(new raw("(DATE_FORMAT(assignments.appointment_date,'%Y-%m'))"), '=',$month)->get()->count();
		return $query;
	}	

public function AssignmentsExportForAdmin($business_cname,$business_city,$business_fromdate,$business_todate){
         //Search Values 
		 if($business_todate!=' '&&$business_fromdate!=''){
			$searchdate="\n  AND assignments.appointment_date BETWEEN '$business_fromdate' AND '$business_todate'";
		  }else{
			$searchdate=" ";
		  }
		if($business_cname!=''){
			$sreachcname="\n AND business_details.company_name like '%$business_cname%'";
		 }else{
			$sreachcname="";
		 }
		if($business_city!=''){
			$sreachcityname="\n AND address.city_id ='$business_city'";
		}else{
			$sreachcityname="";
		} 
		$result = Capsule::select("SELECT assignments.id as id, assignments.message,business_details.company_name,business_details.person_name,mobile_no,DATE_FORMAT( assignments.appointment_date,'%d-%m-%Y') as appointment_date,DATE_FORMAT(assignments.appointment_time,'%h:%i:%s %p') as appointment_time,DATE_FORMAT(assignments.created_on,'%d-%m-%Y %h:%i:%s %p') as work_assigned_date,CONCAT(user_details.first_name,' ',user_details.last_name) as marketing_name,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketlead_name,marketing_message,DATE_FORMAT(assignments.modified_on,'%d-%m-%Y %h:%i:%s %p') as assignmentmsg_datetime, DATE_FORMAT(CONCAT(appointment_date,' ',appointment_time),'%d-%m-%Y %h:%i:%s %p') as appointment_datetime,status_value,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname
		from assignments
		left join user_details on user_details.user_id=assignments.marketing_user_id 
		left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
		left join user_details udd on udd.user_id=assignments.marketlead_user_id
		join business_details on business_details.id=assignments.business_details_id 
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		left join business_status on business_status.id = assignments.assignment_status
	   WHERE assignments.id !=0".$searchdate.$sreachcname.$sreachcityname);
		
        if(count($result)>0){
				return $result;
				
		}
		else{
			return '';
		} 
    }

  function getAssignmentMarketingDetails($add_markrting_user,$add_appointment_date,$add_appointment_time_to,$add_appointment_time_from){
    	$assignmentCount = self::where('assignments.marketing_user_id',$add_markrting_user)->where('assignments.appointment_date',$add_appointment_date)->whereBetween(
  'appointment_time', [$add_appointment_time_from, $add_appointment_time_to])->get()->count();
    	if($assignmentCount>0){
    		return 1;
    	}else{
    		return 0;
    	}
		
		// return $assignmentCount;
    }
  

  function TodayAppointmentList($today,$userid){
    
		if($userid!=''){
			$userid="\n AND(assignments.tele_marketing_user_id ='$userid')";
		}
		else{
			$userid=" ";
		}
        if($today!=''){
			$searchdate="\n  AND assignments.appointment_date = '$today' ";
		  }else{
			$searchdate=" ";
		  }
     $searchagentData=Capsule::select("SELECT assignments.id as id, assignments.message,business_details.company_name,business_details.person_name,DATE_FORMAT( assignments.appointment_date,'%d-%m-%Y') as appointment_date,DATE_FORMAT(assignments.appointment_time,'%h:%i:%s %p') as appointment_time,DATE_FORMAT(assignments.created_on,'%d-%m-%Y %h:%i:%s %p') as work_assigned_date,CONCAT(user_details.first_name,' ',user_details.last_name) as marketing_name,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketlead_name,marketing_message,DATE_FORMAT(assignments.modified_on,'%d-%m-%Y %h:%i:%s %p') as assignmentmsg_datetime, DATE_FORMAT(CONCAT(appointment_date,' ',appointment_time),'%d-%m-%Y %h:%i:%s %p') as appointment_datetime,status_value,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname
		from assignments
		left join user_details on user_details.user_id=assignments.marketing_user_id 
		left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
		left join user_details udd on udd.user_id=assignments.marketlead_user_id
		join business_details on business_details.id=assignments.business_details_id 
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		left join business_status on business_status.id = assignments.assignment_status
	   WHERE assignments.id !=0".$searchdate.$userid);     
	   return $searchagentData;

	    }


	function TodayAppointmentsForDashboardByCitywise($today){
	 $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	               ->join('address','address.id','=','business_details.address_id')
	               ->join('cities','cities.cityid','=','address.city_id')
	               ->where('appointment_date', 'LIKE', '%' . $today . '%')
	               ->groupby('address.city_id')
	             ->get([ new raw('count(assignments.id) as totalappointments'),'cityname']);
		return $query;
	} 

	function TotalAppointmentsForDashboardByCitywise($month){
	 $query = self::join('business_details','business_details.id','=','assignments.business_details_id')
	               ->join('address','address.id','=','business_details.address_id')
	               ->join('cities','cities.cityid','=','address.city_id')
	               ->where(new raw("(DATE_FORMAT(assignments.appointment_date,'%Y-%m'))"), '=',$month)
	               ->groupby('address.city_id')
	             ->get([ new raw('count(assignments.id) as totalappointments'),'cityname']);
		return $query;
	} 



// Today Follow Up Appoints List Start //

	 function TodayFollowUpAppointmentList($today,$userid){
    
		if($userid!=''){
			$userid="\n AND(assignments.tele_marketing_user_id ='$userid')";
		}else{
			$userid=" ";
		}
		
        if($today!=''){
			$searchdate="\n  AND assignments.next_followup_date = '$today' ";
		  }else{
			$searchdate=" ";
		  }
     $searchagentData=Capsule::select("SELECT assignments.id as id, assignments.message,business_details.company_name,business_details.person_name,DATE_FORMAT( assignments.appointment_date,'%d-%m-%Y') as appointment_date,DATE_FORMAT(assignments.appointment_time,'%h:%i:%s %p') as appointment_time,DATE_FORMAT(assignments.created_on,'%d-%m-%Y %h:%i:%s %p') as work_assigned_date,CONCAT(user_details.first_name,' ',user_details.last_name) as marketing_name,CONCAT(ud.first_name,' ',ud.last_name) as tele_name,CONCAT(udd.first_name,' ',udd.last_name) as marketlead_name,marketing_message,DATE_FORMAT(assignments.modified_on,'%d-%m-%Y %h:%i:%s %p') as assignmentmsg_datetime, DATE_FORMAT(CONCAT(appointment_date,' ',appointment_time),'%d-%m-%Y %h:%i:%s %p') as appointment_datetime,status_value,CONCAT(company_name,'<br>',business_details.business_id) as company_name_id , CONCAT(person_name,' <br>',mobile_no) as person_name_mobile,cityname
		from assignments
		left join user_details on user_details.user_id=assignments.marketing_user_id 
		left join user_details ud on ud.user_id=assignments.tele_marketing_user_id
		left join user_details udd on udd.user_id=assignments.marketlead_user_id
		join business_details on business_details.id=assignments.business_details_id 
		join address on address.id=business_details.address_id
		join cities on cities.cityid = address.city_id 
		left join business_status on business_status.id = assignments.assignment_status
	   WHERE assignments.id !=0".$searchdate.$userid);     
	   return $searchagentData;

	   }


// Today Follow Up Appoints List End //



}?>