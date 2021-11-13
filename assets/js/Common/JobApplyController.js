
$(document).ready(function(){

/* ====== add start ===== */
$("#add_applyjob").validate({
     
     rules:{
     	 add_applyjob_id :"required",
     	 add_applyjob_firstname :"required",
     	 add_applyjob_qualification :"required",
     	 add_applyjob_emailid:{required:true,email: true},
         add_applyjob_mobileno :{number:true,minlength:10, maxlength:10},
         add_applyjob_file :"required"
      }
 });

$("#addapplyjob").click(function() {

	alert("sebejwf");

	  if(!$("#add_applyjob").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_applyjob")[0] );
     $.ajax({
      type:"POST",
      url:url+"JobApplyController/saveApplyJob",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#applyjob-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#applyjob-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_applyjob')[0].reset();
				
			}
			else{
				 $('#applyjob-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#applyjob-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#applyjob-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#applyjob-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */




}); // document ready 