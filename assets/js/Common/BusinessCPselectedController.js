
$(document).ready(function(){
viewDemowebsitesForPackages();   
        function viewDemowebsitesForPackages(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessController/SearchWebsitesForBusinessList",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
        viewDemowebsitesForPackagesList(result.data);
      
              }        
                }
            });
        }

  function viewDemowebsitesForPackagesList(demowebsites){
       var items = "";
       var edititems = "";
       var i;
       var n = demowebsites.length;

    for(var i=0; i<n; i++){
        items+='<div class="col-md-4 col-12 form-group"><div class="demoweb card"><img src="'+url+demowebsites[i].web_photo+'" alt="web image" class="image"><div class="container"><h6 class="p-2">'+demowebsites[i].web_name+'</h6></div><div class="overlay"><div class="text"><a  href="'+demowebsites[i].web_url+'" class="btn btn-info btn-rounded btn-fw mb-3" target="_blank">Live Demo</a><a  href="'+demowebsites[i].web_url+'" class="btn btn-light btn-rounded btn-fw" target="_blank">Preview</a></div></div></div></div>';
     }    

        $("#demowebsitespackages").html(items);;
  
  }

function searchdemowebsitesByCategoryForPackages(search_website){

  var search_business_website = search_website;

 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"BusinessController/SearchWebsitesForBusinessList",
    dataType: 'json',
    data:{search_business_website:search_business_website},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
        
        viewDemowebsitesForPackagesList(result.data);  
      }
  else if(result.success==false){
        $('#search_packages_website-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_packages_website-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_packages_website-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_packages_website-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });

}

// Search demo websites for packages end //



var packagesform = $("#add_packagesdata");
packagesform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      // add_packages_companyname :"required",
      // add_business_campaign :"required",
      add_package_condition:"required",
      add_packages_debitcardno:{number:true,minlength:5, maxlength:18},
      add_packages_creditcardno:{number:true,minlength:5, maxlength:18},
      add_packages_chequeno:{number:true,minlength:4, maxlength:12},
      add_packages_cchequeno:{number:true,minlength:4, maxlength:12,equalTo:"#add_packages_chequeno"},
      add_packages_cheque_micr:{number:true},
      add_packages_accountno:{number:true,minlength:5, maxlength:20},
      add_packages_caccountno: {number:true,minlength:5, maxlength:20,equalTo: "#add_business_accountno"},
      add_packages_cacholdername: { equalTo: "#add_business_acholdername"},
      add_business_phonepay:{number:true,minlength:10, maxlength:12},
      add_business_amazonpay:{number:true,minlength:10, maxlength:12},
      add_business_googlepay:{number:true,minlength:10, maxlength:12},
    
    }
});



packagesform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {   

       
        if (currentIndex == 2) {
          var n = $("#add_business_package:checked").length;
          if(n <=0){
             alert("Please Select Any One Package !!!");
            return false;
          }
        }

            var search_website = $("#add_packages_businesskeyword:checked").val();
         searchdemowebsitesByCategoryForPackages(search_website);
          var paymentmodeid = $("#add_business_payment_mode:checked").val();
         
         var add_business_creditcard_expireddate=$("#add_newbusiness_payment_mode").val();
         var add_business_creditcardno=$("#add_business_creditcardno").val();
         
         if(paymentmodeid==3 && (!add_business_creditcard_expireddate || add_business_creditcard_expireddate.length<=0) && (!add_business_creditcardno ||  add_business_creditcardno.length<=0)){
            alert("Please fill all Credit Card Mode options!!!");
            return false;
         }
         
         var add_business_chequeaccountno=$("#add_packages_chequeaccountno").val();
         var add_business_chequeno=$("#add_packages_chequeno").val();
         var add_business_cchequeno=$("#add_packages_cchequeno").val();
         var add_business_cheque_micr=$("#add_packages_cheque_micr").val();
         var add_business_cheque_photo=$("#add_packages_cheque_photo").val();
         var add_business_chequeissuedate=$("#add_packages_chequeissuedate").val();
         
         if(paymentmodeid==6 && (!add_business_chequeaccountno || add_business_chequeaccountno.length<=0) && (!add_business_chequeno ||  add_business_chequeno.length<=0) && (!add_business_cchequeno || add_business_cchequeno.length<=0) && (!add_business_cheque_micr || add_business_cheque_micr.length<=0) && (!add_business_cheque_photo || add_business_cheque_photo.length<=0) && (!add_business_chequeissuedate || add_business_chequeissuedate.length<=0)){
            alert("Please fill all Cheque Mode options!!!");
            return false;
         }
         
         var add_business_cashamount=$("#add_packages_cashamount").val();
         var add_business_cashdate=$("#add_packages_cashdate").val();
         var add_business_personame=$("#add_packages_personame").val();
         var add_business_placename=$("#add_packages_placename").val();
         
         
         if(paymentmodeid==1 && (!add_business_cashamount || add_business_cashamount.length<=0) && (!add_business_cashdate ||  add_business_cashdate.length<=0) && (!add_business_personame ||  add_business_personame.length<=0) && (!add_business_placename ||  add_business_placename.length<=0)){
            alert("Please fill all Cash Mode options!!!");
            return false;
         }
         
         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", packagesform).remove();
            $(".body:eq(" + newIndex + ") .error", packagesform).removeClass("error");
        }
        //alert(businessform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
           });
        
        //alert(currentIndex);
        
        packagesform.validate().settings.ignore = ":disabled,:hidden";
        return packagesform.valid();
     
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
         var campaigntotal=0;
         var package=0;
   var uppersaleamount = $("#add_packages_uppersale_amount").val();
         if (uppersaleamount>0) {
         var  uppersaleamount=Number(uppersaleamount);
         }else{
            var uppersaleamount=0;
         }
        if (currentIndex == 2) {
       viewpackagelistForBusinessSelected(uppersaleamount)
        }    
  
     $('#totalamount1').show();  
     // $('#grandtotalamount').hide(); 
      $('#campaignlist1').empty();
        var n = $("#add_business_campaign:checked").length;
        if (n > 0){
            $("#add_business_campaign:checked").each(function(){
                //var campaign_id= $(this).val();
                var campainname=$(this).attr("data-cname");
                var campaignamount=$(this).attr("data-camount");
                campaigntotal += Number(campaignamount);

        $('#campaignlist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campainname+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campaignamount+'</label></div>');   
  
            });

        }

        $('#packagelist1').empty();
        var n = $("#add_business_package:checked").length;
        
        if (n > 0){
            $("#add_business_package:checked").each(function(){
                //var campaign_id= $(this).val();
                var packagename=$(this).attr("data-pname");
                  // alert(packagename);
                var packageamount=Number($(this).attr("data-pamount"));
                  // alert(packageamount);
                  // alert(uppersaleamount);
                 package += Number(packageamount); 
                var packageamount=Number(packageamount+uppersaleamount);
               packagetotal += Number(packageamount); 
                  // alert(packageamount);
        $('#packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packageamount+'</label></div>');   
  
            });
        }
       var totaluppersaleamount = Number(packagetotal-package); 
      $('#add_packages_totaluppersale_amount').val(totaluppersaleamount); 
      
     var domainamount_checked1 = $('#add_packages_domainamount_checked:checked').val();
     if(domainamount_checked1==1){
           var packages_domainamount=$("#add_packages_domainamount").val();
           var packages_domainamount=Number(packages_domainamount);
           var packages_domainamountview='<div class="col-sm-6 col-6 form-group"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6 form-group "><label>'+packages_domainamount+'</label></div>'
       }else{
           var packages_domainamount= 0;
           var packages_domainamountview=' ';
       }
      var totalpackageamount=campaigntotal+packagetotal;
      var total=Number(totalpackageamount+packages_domainamount); 
      var total= parseFloat(total).toFixed(2);
      var tdsvalue = $('#add_packages_tds:checked').val();
        // alert(tdsvalue);
     if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }

     var state_id = $('#add_packages_companyname_state_id').val();
     if(state_id==32){
        var cgst=Number(total*9/100);
        var sgst=Number(total*9/100);

        var cgst= parseFloat(cgst).toFixed(2);
        var sgst= parseFloat(sgst).toFixed(2);
        var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
        var grandtoatal= parseFloat(grandtoatal).toFixed(2);
        var grandtoatal =Math.round(grandtoatal);
        var gst='<div class="col-sm-6 col-6 form-group"> <label> CGST </label></div> <div class="col-sm-6 col-6 form-group"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 form-group"> <label> SGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+sgst+'</label></div>'+tdsview+'';

       
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
        var grandtoatal =Math.round(grandtoatal);
      gst='<div class="col-sm-6 col-6 form-group"> <label>IGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+igst+'</label></div>'+tdsview+'';
     } 
     // alert(grandtoatal);
     $('#totalamount1').empty();
     $('#totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Packages Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+totalpackageamount+'</label></div> '+packages_domainamountview+' <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div> </div></div>')
     
     $('#add_packages_total').val(grandtoatal);
     $('#add_packages_totalpackageamount').val(totalpackageamount);

    },
    onFinishing: function (event, currentIndex)
    {  
        packagesform.validate().settings.ignore = ":disabled";
        return packagesform.valid();
       
    },
    onFinished: function (event, currentIndex)
    {

    var business_id=$('#add_packages_companyname').val();   
    var formData = new FormData($("#add_packagesdata")[0] );
     $.ajax({
    type:"POST",
    url:url+"BusinessCPselectedController/savePackagesData",
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

        $('#packagesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#packagesdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_packagesdata')[0].reset();
        
         window.setTimeout(function(){location.reload()},3000)

         }
      else{
        $('#packagesdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#packagesdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
},    
    failure: function (result){

      $('#packagesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#packagesdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});





 $("#applypromocode").click(function(){
 
 var add_packages_promocode = $('#add_packages_promocode').val();
 var totalamount = $('#add_packages_totalpackageamount').val();
 var add_packages_companyname = $('#add_packages_companyname').val();
 var state_id = $('#add_packages_companyname_state_id').val();
 var domainamount_checked1 = $('#add_packages_domainamount_checked:checked').val();
 var tdsvalue = $('#add_packages_tds:checked').val();

    $.ajax({
    type: "POST",
    url:url+'BusinessCPselectedController/getAmountPromocode',
    data:{add_packages_promocode:add_packages_promocode,add_packages_companyname:add_packages_companyname},
    dataType: 'json',
  beforeSend: function(){
    // Show image container
    $(".loader").show();
},  
  success:function(result){
      if(result.success===true)
      { 

 var discountamount=0 ;
 
if(result.data[0].discount_amount !='NULL' && result.data[0].discount_amount >0){
$( "#promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_amount+"Rs Discount to Using this Promocode </div>"); 

  discountamount=result.data[0].discount_amount;
  var discountamount= parseFloat(discountamount).toFixed(2);

}else if(result.data[0].discount_percentage != 'NULL' && result.data[0].discount_percentage != ' '){
$("#promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_percentage+"% Discount to Using this Promocode </div>");   
        var percentage=result.data[0].discount_percentage; 
        discountamount =(totalamount/100) * percentage ; 
        var discountamount= parseFloat(discountamount).toFixed(2);
       

}

    $('#totalamount1').hide();  
    $('#grandtotalamount').empty();
      var totalpackageamount=totalamount-discountamount;
     if(domainamount_checked1==1){
           var packages_domainamount=$("#add_packages_domainamount").val();
           var packages_domainamount = Number(packages_domainamount);
           var domainamount_packageviw='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+packages_domainamount+'</label></div>'
         }else{
           var packages_domainamount= 0;
           var domainamount_packageviw=' ';
         }
    var total=Number(totalpackageamount+packages_domainamount); 
  if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }

   var total= parseFloat(total).toFixed(2);
    if(state_id==32){
        var cgst=Number(total*9/100);
        var sgst=Number(total*9/100);

        var cgst= parseFloat(cgst).toFixed(2);
        var sgst= parseFloat(sgst).toFixed(2);
        var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
        var grandtoatal= parseFloat(grandtoatal).toFixed(2);
         var grandtoatal =Math.round(grandtoatal);
        var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6"> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
       
     }else{
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var grandtoatal =Math.round(grandtoatal);
       var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> ';
      
     } 

      $('#grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Amount </label></div> <div class="col-sm-6 col-6"><label>'+discountamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>')
     
       $('#add_packages_discountamount').val(discountamount);
       $('#add_packages_totalpackageamount').val(totalamount);
       $('#add_packages_grandtotal').val(grandtoatal);
       $('#add_packages_total').val('');
       $('#add_packages_promocode_id').val(result.data[0].id);

      }else if(result.success==false){
        
        $('#totalamount1').hide();  

            $('#grandtotalamount').empty();
            $('#discount').empty();
             $('#promcodeamount-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
             $("#promcodeamount-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>"); 
     
       if(domainamount_checked1==1){
           var packages_domainamount=$("#add_packages_domainamount").val();
           var packages_domainamount = Number(packages_domainamount);
           var domainamount_packageviw='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+packages_domainamount+'</label></div>'
         }else{
           var packages_domainamount= 0;
           var domainamount_packageviw=' ';
         }
        var totalpackageamount=Number(totalamount);
        var total=Number(totalpackageamount+packages_domainamount); 
      if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }
  if(state_id==32){
        var cgst=Number(total*9/100);
        var sgst=Number(total*9/100);
        var cgst= parseFloat(cgst).toFixed(2);
        var sgst= parseFloat(sgst).toFixed(2);
        var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
        var grandtoatal= parseFloat(grandtoatal).toFixed(2);
          var grandtoatal =Math.round(grandtoatal);
          var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 "> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
       
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
        var grandtoatal =Math.round(grandtoatal);
      var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> '+tdsview+'';
     } 

     $('#grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>')
     
      $('#add_packages_grandtotal').val('');
      $('#add_packages_total').val(grandtoatal);
      $('#add_packages_totalpackageamount').val(totalpackageamount);

      }

    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
},
 failure:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

    

    });




$("#packages_generated_opt").click(function() {

var add_packages_companyname = $("#add_packages_companyname").val();
var add_business_payment_mode =$("input:radio[name=add_business_payment_mode]:checked").val();    
// var add_business_payment_mode = $("#add_business_payment_mode").val();
var add_packages_total = $("#add_packages_total").val();
var add_packages_grandtotal = $("#add_packages_grandtotal").val();
   $.ajax({
    type:"POST",
    url:url+"Welcome/OtpSendToMobileForpackage",
    dataType: 'json',
    data:{add_packages_companyname:add_packages_companyname,add_business_payment_mode:add_business_payment_mode,add_packages_total:add_packages_total,add_packages_grandtotal:add_packages_grandtotal},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
          alert(result.message);
           $('#package_otpverficationmodal').modal('show');
        }
  else if(result.success==false){
        alert(result.message);
      }
    },
    
    failure: function (result){
      alert("Some thing went wrong try again ...");
    } 
         
      });

});

// }


$("#package_otp_verification").click(function() {
var package_mobileOtp = $("#package_mobileOtp").val();
   $.ajax({
       type:"POST",
       url:url+"Welcome/OtpVerficationToMobileForpackage",
    dataType: 'json',
    data:{package_mobileOtp:package_mobileOtp},
    dataType: 'json',
 success: function(result){
      
      if(result.success==true){
        $('#add_package_otp').val(package_mobileOtp);
        $('#package_otpverficationmodal').modal('hide');    
        alert(result.message);
   }
  else if(result.success===false){
       alert(result.message);
      }
    },
    
    failure: function (result){
     alert("Some thing went wrong try again ...");
    } 
         
      });

});









// Search Keyword For Packages  Start //

viewBusinessKeywords();   
        function viewBusinessKeywords(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessController/getBusinessKeywordslist",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
        businesskeywordsview(result.data);
      
              }        
                }
            });
        }

  function businesskeywordsview(keywordlist){
    
       var items = "";
       var edititems = "";
       var i;
       var n = keywordlist.length;

for(i=0;i<n;i++) {
   // items+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="add_business_businesskeyword" name="add_business_businesskeyword"  style="display: inline;"> <span class="form-label" for="add_business_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

   edititems+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="add_packages_businesskeyword" name="add_packages_businesskeyword"  style="display: inline;"> <span class="form-label" for="add_packages_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

       }

         // $("#addkeywordsbusiness").html(items);
         $("#addkeywordspackages").html(edititems);
  
  }

$("#add_keywords").validate({
     
     rules:{
        add_keywords_name :"required",
        add_keywords_category:"required"
     }
 });


$("#addkeywords").click(function() {
  
    if(!$("#add_keywords").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_keywords")[0] );
     $.ajax({
      type:"POST",
    url:url+"BusinessController/saveKeywords",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
  
  success: function(result){
      if(result.success==true){
        $('#keywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $( "#keywords-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_keywords')[0].reset();
        setTimeout(function(){
               $('#AddkeywordsModal').modal("hide");
                    }, 5000); 
         viewBusinessKeywords(); 
      }
      else{
        $('#keywords-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#keywords-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#keywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#keywords-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
        });

});


// $("#searchpackageskeywordscategory").click(function(){
  $( "#search_packages_keyword" ).keyup(function() {
var search_business_keyword = $('#search_packages_keyword').val();
 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"BusinessController/SearchKeywordsForBusinessList",
    dataType: 'json',
    data:{search_business_keyword:search_business_keyword},
    dataType: 'json',

 success: function(result){
      
      if(result.success===true){

          businesskeywordsview(result.data)
   }
  else if(result.success===false){
        $('#search_packages_keywords-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_packages_keywords-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_packages_keywords-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_packages_keywords-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });

});

$("#searchpackageswebcategory").click(function(){
  var search_website = $('#search_packages_website').val();
  searchdemowebsitesByCategoryForPackages(search_website);
});

// Search Keyword For Packages  End //


 function viewpackagelistForBusinessSelected(uppersaleamount){
  // alert("babu");
  var items="";
  var itemsb="";
  var edititems="";
  var uppersaleamount = uppersaleamount;
   if (uppersaleamount>0) {
            var uppersaleamount=Number(uppersaleamount);
            // alert(uppersaleamount);
            // $("#addpackagelist").empty()
           
    }else{
              var uppersaleamount=0; 
              // alert(uppersaleamount);
             
    }

      $.getJSON(url+"Common/getPackagelist",function(packagelist){
      items+=" ";
      itemsb+=" ";
      edititems+=" ";
      $.each(packagelist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
  var i;
  var values = item.sublist_name;
  var subname = values.split(',');
  var n =subname.length;
  var sname ="";
   
    
for(i=0;i<n;i++) {
   sname+= "<div class='subpackage'>"+subname[i]+"</div>"
   }    

       var package_amount=  Number(item.package_amount);
       var package_amount=  Number(package_amount+uppersaleamount)

      items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages"> <div class="text-center pt-3 pb-2 card-packagehead"><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2">Rs.'+package_amount+'</h4></div> <div class="scrollbar"><span class="packages_scollbar"> '+sname+'</span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center"> <label> <input type="checkbox"  value='+item.id+'  id="add_business_package" name="add_business_package[]" data-pname="'+item.package_name+'" data-pamount="'+item.package_amount+'"> Select Package </label></div></div>';
    
    });
     
  });
         $("#addpackagelist").html(items);
      
  });

}


  }); // document ready