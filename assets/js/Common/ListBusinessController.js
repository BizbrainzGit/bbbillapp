var url=base_url.baseurl;


$(function(){
		 var items="";
		 $.getJSON(url+"Common/listOfBusiness", function(listOfBusiness){
		  $.each(listOfBusiness,function(index,itemlist)
		 {
        
		 if ( $.fn.DataTable.isDataTable('#listofbusinesstable')) {
				 $('#listofbusinesstable').DataTable().destroy();
				 }	
				 $('#listofbusinesstable tbody').empty();

				 var data=itemlist; 
				 var table = $('#listofbusinesstable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Sno'},
		  {data: 'company_name',title:'Company Name'},
		  {data: 'person_name',title:'Name'},
		  {data: 'business_status_id',title:'Status'},
		  // {data: null,
				// 	 'title' : 'Action',
				// 	 "sClass" : "center",
				// 	 mRender: function (data, type, row) {
    //       return '<button class="btn btn-primary btn-sm appointment_edit" data-toggle="modal" id="appointmentdata_edit" data-target="#EditappointmentModal"><a data-appointmentid="'+data.id+'" data-appointmentname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'} }
     ],

		columnDefs: [{
         targets: 3,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
             data = '<label class="badge badge-success" id="active">Active</label>' 
			  }	else
			  if(data == '2' ){
             data = '<label class="badge badge-danger" id="inactive">In-active</label>' 
			  }	else
			  if(data == '3' ){
             data = '<label class="badge badge-warning" id="pending">Payment Pending</label>' 
			  }	else
			  if(data == '4' ){
				  data = '<label class="badge badge-info" id="followup">Follow Up</label>'
			  }
			  else
		      if(data == '5' ){
		          data = '<label class="badge badge-success" id="closed">Closed</label>'
		        }  				 
          }

          return data;
       }
	 }]
 });

table.rows.add(data).draw();

 
		 
		  });	
});	
 });



// $(document).ready(function(){

// /* ======  campaign  Table  edit  start ===== */

//  $(document).on('click', '.appointment_edit a', function(e){


//  var id= $(this).attr("data-appointmentid");

//  $.ajax({
//     type: "GET",
//     url:url+'Common/editBusinessAppointmentsByid/'+id,
//     dataType: 'json',
 
//   success:function(result){
//       if(result.success===true)
//       { 

//         $('#edit_appointment #edit_appointment_id').val(result.data[0].id);
//         $('#edit_appointment #edit_company_name').html(result.data[0].company_name);
//         $('#edit_appointment #edit_person_name').html(result.data[0].person_name);
//         $('#edit_appointment #edit_status').val(result.data[0].business_status_id).prop("selected", true);
       
//       }else{
//             alert('request failed', 'error');
//       }
//     },
   
 
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }


// });

// });


// });

// /* ======  campaign  Table  edit  end ===== */


// /* ======  campaign  Table  update  start ===== */

// $("#edit_appointment").validate({
     
//      rules:{
//         edit_status :"required"
//      }
//  });


//  $("#updateappointment").click(function(){

// 	  if(!$("#edit_appointment").valid())
// 	 {
// 		 return false;
// 	 }
	
// 	var formData = new FormData($("#edit_appointment")[0] );
//    $.ajax({
//        type:"POST",
//        url:url+"Common/updateBusinessAppointmentsData",
//     dataType: 'json',
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,

//  success: function(result){
			
// 			if(result.success===true){
			
// 				$('#appointment-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
// 			    $("#appointment-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
// 			    $("#edit_appointment")[0].reset();

//             setTimeout(function(){
//                $('#EditappointmentModal').modal('hide');
//                 }, 5000); 
			

//    }
// 	else if(result.success===false){

// 				$('#appointment-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
// 				$( "#appointment-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
// 			}
// 		},
	  
// 		failure: function (result){

// 			$('#appointment-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
// 			$( "#appointment-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
// 		}	
         
//       });


// });




