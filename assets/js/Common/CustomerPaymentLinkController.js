

$(document).ready(function(){
var paymentpendingaddform = $("#add_customer_paymentlink");
paymentpendingaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      customer_paymentlink_condition :"required"

    }
});

paymentpendingaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        paymentpendingaddform.validate().settings.ignore = ":disabled,:hidden";
        return paymentpendingaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        paymentpendingaddform.validate().settings.ignore = ":disabled";
        return paymentpendingaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#add_customer_paymentlink")[0] );
     $.ajax({
      type:"POST",
     url:url+"CustomerPaymentLinkController/Savecustomerpaymentlink",
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

        $('#customer_paymentlink_addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#customer_paymentlink_addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_customer_paymentlink')[0].reset(); 
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#customer_paymentlink_addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#customer_paymentlink_addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#customer_paymentlink_addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#customer_paymentlink_addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});

/* ==== payment pending ends  ===*/ 


}); // document ready 