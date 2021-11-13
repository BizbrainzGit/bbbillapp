
$(document).ready(function(){
//
	$("#loginForm").validate({
      rules: {
        email: {
         required: true,
          //email: true
        },
        password: {
          required: true,
          // minlength: 5
        },
	  },
	  messages: {
       email: {
          required: "Please enter a username",
          minlength: "Your username must consist of at least 2 characters"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long"
        }
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
	});
    //
  	

$('#login-button').click(function(e) {
	 if(!$("#loginForm").valid())
	 {
		 return false;
	 }
	var email = $("#email").val();
	var password = $("#password").val();
	login={email:email,password:password};	
	var Login = JSON.stringify(login);
	$.ajax({
		type: "POST",
		url:url+'Welcome/login',
		data:Login,
		dataType: 'json',
		success: function(result){
			
			if(result.success===true && result.data.user_roles=='Admin')
			{ 		
				setTimeout('window.location.href = "'+url+'admin-Dashboard"; ',100);
			}
			if(result.success==true && result.data.user_roles=='Marketing'){
       setTimeout('window.location.href = "'+url+'Marketing"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Tele-Marketing'){
        setTimeout('window.location.href = "'+url+'teleMarketing"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Marketing-Lead'){
        setTimeout('window.location.href = "'+url+'Marketing-Lead"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Content-Manager'){
        setTimeout('window.location.href = "'+url+'templateadmin-Dashboard"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Managing-Director'){
        setTimeout('window.location.href = "'+url+'Managing-Director-Dashboard"; ',100);
      }
      if(result.success===true && result.data.user_roles=='Accountant'){
        setTimeout('window.location.href = "'+url+'Accountant-Dashboard"; ',100);
      }
       if(result.success===true && result.data.user_roles=='IT-Department'){
        alert("baburao");
        setTimeout('window.location.href = "'+url+'IT-Department-Dashboard"; ',100);
      }
			if(result.success===false){
				alert('Incorrect UserName and Password'); 
			}
		}
		
		});
});



$("#forgot-button").click(function(){
  
  
  if(!$("#forgotPasswordForm").valid()){
    return false;
  }
  var email=$("#email").val();
  // alert(email);
   var obj={email:email};
  var myJSON = JSON.stringify(obj);
  $.ajax({
      type:"POST",
     url:url+"Forgot/forgotpassword",
      dataType : 'json',
      cache :false,
      data:myJSON,
      success: function(result)
      {
      if(result.success==true)
      {
       
      $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#forgotPasswordForm')[0].reset();
           
      }else{

             $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
         $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       alert("not inserted");
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#alert-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});

$('#changepasswordForm').validate({
    rules:{
  
  old_password: {
            required: true
        },
  new_password: {
            required: true
        },
  confirm_password : {
                equalTo : '[name="new_password"]'
        }
  
  }
  
  
});


$("#cpswd_save").click(function(){
  
  if(!$("#changepasswordForm").valid()){
    return false;
  }
  
  var old_password=$("#old_password").val();
  var new_password=$("#new_password").val();
  var confirm_password=$("#confirm_password").val();
  
  $.ajax({
      type:"POST",
      url:url+"Forgot/Changepassword",
      dataType : 'json',
      cache :false,
      data: {old_password:old_password,new_password:new_password,confirm_password:confirm_password},
      success: function(result)
      {
      if(result.success==true)
      {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");
      $('#changepasswordForm')[0].reset();
          
          setTimeout(function(){
          $('#changepswdModal').modal('hide');
              },900);       
      }else{

           $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $("#alert-msg").html("<div class='alert alert-success'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#alert-msg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#alert-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});




// $('#business_given_feedback_form').validate({
//     rules:{
  
//  
  
//   }
  
  
// });


$("#business_given_feedback_save").click(function(){
  
  if(!$("#business_given_feedback_form").valid()){
    return false;
  }
 
 var formData = new FormData($("#business_given_feedback_form")[0]);
  $.ajax({
      type:"POST",
      url:url+"Welcome/SaveBusinessFeedback",
      dataType : 'json',
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
      success: function(result)
      {
      if(result.success==true)
      {
       $('#feedback-savemsg').hide().fadeIn('slow').delay(350).fadeOut('slow');
       $("#feedback-savemsg").html("<div class='alert alert-success'>"+result.message+"</div>");
          
      }else{

         $('#feedback-savemsg').hide().fadeIn('slow').delay(350).fadeOut('slow');
         $("#feedback-savemsg").html("<div class='alert alert-danger'>"+result.message+"</div>");

      }
      
    },
    failure: function (result)
    {
       $('#feedback-savemsg').hide().fadeIn('slow').delay(350).fadeOut('slow');
      $( "#feedback-savemsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ..</div>");
    }   
  });
});



$("#searchdemowebsitebemail").click(function(){
var search_business_website = $('#search_bemail_website').val();

 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"Common/SearchWebsitesForBusinessList",
    dataType: 'json',
    data:{search_business_website:search_business_website},
    dataType: 'json',
 success: function(result){
      if(result.success===true){
        $('#berfore_search_demowebsitesemail').hide();
       for(var i=0; i<result.data.length; i++){
        items+='<div class="col-md-4 col-6 form-group"><div class="demoweb card"><img src="'+url+result.data[i].web_photo+'" alt="web image" class="image"><div class="container"><h6 class="p-2">'+result.data[i].web_name+'</h6></div><div class="overlay"><div class="text"><a  href="'+result.data[i].web_url+'" class="btn btn-info btn-rounded btn-fw mb-3" target="_blank">Live Demo</a><a  href="'+result.data[i].web_url+'" class="btn btn-light btn-rounded btn-fw" target="_blank">Preview</a></div></div></div></div>';
     }
       $("#demowebsitesemail").html(items);   
   }
  else if(result.success===false){
        $('#search_bemail_website-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_bemail_website-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_bemail_website-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_bemail_website-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});




});
