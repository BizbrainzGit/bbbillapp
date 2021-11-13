
$(document).ready(function(){

/* ====== add  menus  details  start ===== */
$("#ContactForm").validate({
     
     rules:{
        your_name :"required",
        business_email:{required: true,email: true },
        mobile_number:{required: true,number:true,minlength:10, maxlength:10}
     }
 });

$("#addcontactform").click(function() {
	
	  if(!$("#ContactForm").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#ContactForm")[0] );
     $.ajax({
      type:"POST",
    url:url+"ContactFormController/saveContactFormDetails",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			if(result.success==true){
				$('#contactform-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#contactform-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#ContactForm')[0].reset();
				// viewContactFormDetails();  
				 alert("Congratulatios...!\n Your Details Saved Successfully...!\n My Customer Care Person Contact You Soon...!  ");
			}
			else{
				$('#contactform-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#contactform-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){
			$('#contactform-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#contactform-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });


});



});

