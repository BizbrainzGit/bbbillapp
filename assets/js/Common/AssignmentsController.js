
$(document).ready(function(){

assignmentListView() ;
 function assignmentListView(){
            $.ajax({
                type  : 'GET',
                url   : url+"AssignmentsController/SearchAssignmentslist",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  assignmentView(result.data,result.role);
                  }        
                }
            });
        }

function assignmentView(AssignmentsList,roles){
          var role=roles ;

	 if ( $.fn.DataTable.isDataTable('#assignmentstablelist')) {
				 $('#assignmentstablelist').DataTable().destroy();
				 }	
				 $('#assignmentstablelist tbody').empty();

				 var data=AssignmentsList; 
				 var table = $('#assignmentstablelist').DataTable({
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
		  // {data: 'work_assigned_date',title:'Work Assigned <br> Date'},
		  {data: 'tele_name',title:'Assigned By<br> Tele-caller'},
		  // {data: 'marketlead_name',title:'Assigned By <br> MarketLead'},
		  {data: 'marketing_message',title:'Status Message'},
		  {data: 'assignmentmsg_datetime',title:'Status Updated On'},
		  {data: 'status_value',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
		if(role=="Admin"){  
			return '<button class="btn btn-danger btn-sm assignment_delete"><a data-assignmentid="'+data.id+'" data-assignmentcompanyname="' +data.company_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
			
		 }else{
			return ' '
		}			 	
    
					 } }
				]

			 });

table.rows.add(data).draw();
if(data.length>0){
		$('#assignments_excel').show();
		$('#assignments_pdf').show();
		$('#assignments_print').show();
	}else{
		$('#assignments_excel').hide();
		$('#assignments_pdf').hide();
		$('#assignments_print').hide();
	}

	}




$('#assignments_excel').click(excelexport);
$('#assignments_pdf').click(excelexport);
$('#assignments_print').click(excelexport);
function DownloadExcel(link) {
	 var downloadurl=url+link;
	// alert(downloadurl);
	window.open(downloadurl,'_blank');
}
function excelexport(){
	var search_businessassignments_cname     = $("#search_businessassignments_cname").val();
	var search_businessassignments_city      = $("#search_businessassignments_city").val();
	var search_businessassignments_fromdate  = $("#search_businessassignments_fromdate").val();
	var search_businessassignments_todate    = $("#search_businessassignments_todate").val();
	var export_type='';
	var id = this.id;
	if(id=='assignments_excel'){
		export_type=$("#assignments_excel").val();
		
	}
	if(id=='assignments_pdf'){
		export_type=$("#assignments_pdf").val();	
	}
	if(id=='assignments_print'){
		export_type=$("#assignments_print").val();	
	}
	var obj=  {export_type:export_type,search_businessassignments_cname:search_businessassignments_cname,search_businessassignments_city:search_businessassignments_city,search_businessassignments_fromdate:search_businessassignments_fromdate,search_businessassignments_todate:search_businessassignments_todate};
	var data = JSON.stringify(obj);
	
	jQuery.ajax({
		type: "POST",
		url:url+"AssignmentsController/AssignmentsExport",
		dataType: 'json',
		data:data,
		success: function(result){
			if(result.success===true){
					 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);		
					 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
					if(result.download_type=='excel' || result.download_type=='pdf'){
						DownloadExcel(result.data);
						return false;
					}else{
						
							var printWindow = window.open('', '', 'height=400,width=800');
							printWindow.document.write('<html><head><title>Vendor Movement Register</title>');
							printWindow.document.write('</head><body >');
							printWindow.document.write(result.data);
							printWindow.document.write('</body></html>');
							printWindow.document.close();
							printWindow.print();
							
					}
					
			}
			else{
				//window.location.href= '';
				setTimeout(function(){
				  $('#msg').html('<div class="alert alert-failure">No Data !...</div>');
				},1000);
			  }
		},
		failure: function (result){
			setTimeout(function(){
			  $('#msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
			},1000);
		  
		}
	});
}



$("#search_assignment").validate({
     
     rules:{
        // search_appointment_fromdate :"required",
        // search_appointment_todate :"required",
      
     }
 });

$("#searchassignment").click(function() {
	
	  if(!$("#search_assignment").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#search_assignment")[0] );
     $.ajax({
      type:"POST",
    url:url+"AssignmentsController/SearchAssignmentsList",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
    beforeSend: function(){
    // Show image container
    $(".loader").show();
},
     success: function(result){
			
			if(result.success==true){
               assignmentView(result.data,result.role);
			 }
			else if(result.success===false){
				alert('Information request failed:error, Please try Again....');
			}
		},
   complete:function(){
      // Hide image container
      $(".loader").hide();
     }, 		
	  
		failure: function (result){

			alert('Information request failed: error, Please try Again....');
		}	
            
      });


});



/* ====== Assignments delete  Start ===== */

$(document).on('click', '.assignment_delete a', function(e){
 var id= $(this).attr("data-assignmentid");
 var name=$(this).attr("data-assignmentcompanyname");
    $.ajax({
    type: "GET",
    url:url+'AssignmentsController/deleteAssignmentById/'+id,
    dataType: 'json',
    beforeSend:function(){
         return confirm("Are you sure to Delete ?");
      },
  success:function(result){
      if(result.success===true)
      { 
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    assignmentListView(); 
      }else{
            alert('request failed', 'error');
      }
    },
 
  fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
       }

     });

});

/* ====== Assignments delete end ===== */



}); // document ready //

