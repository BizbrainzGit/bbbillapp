
$(document).ready(function(){

appointmentsListView() ;
 function appointmentsListView(){
            $.ajax({
                type  : 'GET',
                url   : url+"TodayAppointmentsController/SearchTodayAppointmentslist",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  appointmentsView(result.data,result.role);
                  }        
                }
            });
        }

function appointmentsView(AppointmentsList,roles){
          var role=roles ;

	 if ( $.fn.DataTable.isDataTable('#todayappointmentsstablelist')) {
				 $('#todayappointmentsstablelist').DataTable().destroy();
				 }	
				 $('#todayappointmentsstablelist tbody').empty();

				 var data=AppointmentsList; 
				 var table = $('#todayappointmentsstablelist').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
		  {data: 'company_name_id',title:'Company Name & Id'},
		  {data: 'person_name_mobile',title:'Person Name <br> & Mobile No'},
		  {data: 'cityname',title:'City Name'},
		  {data: 'message',title:'Message'},
		  {data: 'appointment_datetime',title:'Appointment <br> Date &Time.'}, 
		  {data: 'marketing_name',title:'Marketing Name'},
		  {data: 'tele_name',title:'Assigned By<br> Tele-caller'},
		  {data: 'work_assigned_date',title:'Work Assigned <br> Date'},
		  // {data: 'marketing_message',title:'Status Message'},
		  // {data: 'appointmentsmsg_datetime',title:'Status Updated On'},
		  // {data: 'status_value',title:'Status'},
		//   {data: null,
		// 			 'title' : 'Action',
		// 			 "sClass" : "center",
		// 			 mRender: function (data, type, row) {
		// if(role=="Admin"){  
		// 	return '<button class="btn btn-danger btn-sm appointments_delete"><a data-appointmentsid="'+data.id+'" data-appointmentscompanyname="' +data.company_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
		//  }else{
		// 	return ' '
		// }			 	
    
		// 			 } }
				]

			 });

table.rows.add(data).draw();


	}










}); // document ready //

