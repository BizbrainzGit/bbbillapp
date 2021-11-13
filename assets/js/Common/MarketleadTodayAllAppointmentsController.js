$(function(){
		 var items="";
		 $.getJSON(url+"market-lead/TodayAllAppointmentsController/TodayAppointForMarketingLead", function(todayallappointmentsList){
		  $.each(todayallappointmentsList,function(index,itemlist)
		 {

		 if ( $.fn.DataTable.isDataTable('#todayallapptable')) {
				 $('#todayallapptable').DataTable().destroy();
				 }	
				 $('#todayallapptable tbody').empty();

				 var data=itemlist; 
				 var table = $('#todayallapptable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
      {data: 'company_name',title:'Company Name'},
      {data: 'person_name',title:'Contact Person Name'},
      {data: 'mobile_no',title:'Contact Person Phone'},
      {data: 'tele_marketing_name',title:'Assigned By'}, 
      {data: 'marketing_name',title:'Assigned To'},
      {data: 'appointment_time',title:'Appointment Time'},
      {data: 'message',title:'Message'},
      {data: 'status_value',title:'Status'},
      {data: null,
          'title' : 'Action',
          "sClass" : "center",
          mRender: function (data, type, row) {
    return '<button class="btn btn-warning btn-sm mt-2 market_lead_status_edit" data-toggle="modal" id="market_lead_status_edit"  data-target="#market_lead_EditstatusModal" title="Edi Business Status"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" data-assignmentid="'+data.assignment_id+'" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp;<button class="btn btn-info btn-sm mt-2 market_lead_selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;<button class="btn btn-info btn-sm mt-2  marketeditbusiness" id="businessdata_edit" title="Edit Business Details" style="color:#0066ff"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"  style="color:#ffffff"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp; '
              } }
        ],
			 });
table.rows.add(data).draw();
		  });	
   });	
 });


$('[data-toggle="modal"]').tooltip();

$(document).on('click', '.market_lead_status_edit a', function(e){
 var id= $(this).attr("data-businessid"); 
 var assignmentid= $(this).attr("data-assignmentid");
$('#market_lead_change_status_form #market_lead_change_assignment_id').val(assignmentid);
 $.ajax({
    type: "GET",
    url:url+'market-lead/TodayAllAppointmentsController/MarketLeadeditStatusByid/'+assignmentid,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 

         if(result.updateddata[0].is_update==1){
              items=' <label class="badge badge-warning" style="text-algin:center;padding:10px;"> This Assignment Updated  Already ... </label>';
                    $("#marketlead_appointment_statuschecked").html(items); 

             }else{
                   
                    if(result.data.length>0){
             var items = "";
             var i;
             var n = result.data.length;
             for(var i=0; i<n; i++){
              // alert(result.data[i].appointment_time);
              items+=' <label class="badge badge-warning" style="text-algin:center;padding:10px;"> Please Updated '+result.data[i].appointment_time+'  Assignment </label>';
                }
                $("#marketlead_appointment_statusmodel").hide();
                $("#marketlead_appointment_statuschecked").html(items);    

            }else{
                  $("#marketlead_appointment_statuschecked").hide();   
                  $("#marketlead_appointment_statusmodel").show();   
               $('#market_lead_change_status_form #market_lead_change_status_id').val(id);
               $('#market_lead_change_status_form #market_lead_change_status').val(result.updateddata[0].business_status_id).prop("selected", true);
                }

             }


       }else{
            alert('request failed', 'error');
      }

    },
   
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }
});

});

$("#market_lead_change_status_form").validate({
     
     rules:{
        market_lead_change_assignment_message : "required",
        market_lead_change_status :"required"
      
     }
 });

 $("#market_lead_updatestatus").click(function(){
    if(!$("#market_lead_change_status_form").valid())
   {
     return false;
   }
  var formData = new FormData($("#market_lead_change_status_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"market-lead/TodayAllAppointmentsController/MarketLeadupdateStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
      
      if(result.success===true){
      
        $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#market_lead_change_status_form")[0].reset();
            setTimeout(function(){
               $('#market_lead_EditstatusModal').modal('hide');
                }, 5000); 

       window.setTimeout(function(){location.reload()},3000);

   }
  else if(result.success===false){
        $('#citymapping-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});



$(document).on('click', '.market_lead_selectedpackages a', function(e){

 var id= $(this).attr("data-businessid");
 var name=$(this).attr("data-businessname");
 var state_id=$(this).attr("data-businessstate_id");
$("#market_lead_add_packages_companyname_state_id").val(state_id);
$("#market_lead_add_packages_companyname").val(id);

$("#market_lead_cname").html(name);
$(".market_lead_todayAppointmentList_class").hide();
$(".market_lead_addpackages-class").show();


   });
 


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

        // $("#demowebsitesbusiness").html(items);
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


var market_lead_packagesform = $("#market_lead_add_packagesdata");
market_lead_packagesform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      // market_lead_add_packages_companyname :"required",
      // add_business_campaign :"required",
      add_package_condition:"required",
      market_lead_add_packages_debitcardno:{number:true,minlength:5, maxlength:18},
      market_lead_add_packages_creditcardno:{number:true,minlength:5, maxlength:18},
      market_lead_add_packages_chequeno:{number:true,minlength:4, maxlength:12},
      market_lead_add_packages_cchequeno:{number:true,minlength:4, maxlength:12,equalTo:"#market_lead_add_packages_chequeno"},
      market_lead_add_packages_cheque_micr:{number:true},
      market_lead_add_packages_accountno:{number:true,minlength:5, maxlength:20},
      market_lead_add_packages_caccountno: {number:true,minlength:5, maxlength:20,equalTo: "#market_lead_add_packages_accountno"},
      market_lead_add_packages_cacholdername: { equalTo: "#market_lead_add_packages_acholdername"},
      market_lead_add_packages_phonepay:{number:true,minlength:10, maxlength:12},
      market_lead_add_packages_amazonpay:{number:true,minlength:10, maxlength:12},
      market_lead_add_packages_googlepay:{number:true,minlength:10, maxlength:12},
    
    }
});

market_lead_packagesform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {   
      var search_website = $("#market_lead_add_packages_businesskeyword:checked").val();
       searchdemowebsitesByCategoryForPackages(search_website);
         var paymentmodeid = $("#add_business_payment_mode:checked").val();
         var add_business_creditcard_expireddate=$("#add_newbusiness_payment_mode").val();
         var add_business_creditcardno=$("#add_business_creditcardno").val();
        
        if (currentIndex == 2) {
          var n = $("#add_business_package:checked").length;
          if(n <=0){
             alert("Please Select Any One Package !!!");
            return false;
          }
        } 

         if(paymentmodeid==3 && (!add_business_creditcard_expireddate || add_business_creditcard_expireddate.length<=0) && (!add_business_creditcardno ||  add_business_creditcardno.length<=0)){
            alert("Please fill all Credit Card Mode options!!!");
            return false;
         }
         
         var add_business_chequeaccountno=$("#market_lead_add_packages_chequeaccountno").val();
         var add_business_chequeno=$("#market_lead_add_packages_chequeno").val();
         var add_business_cchequeno=$("#market_lead_add_packages_cchequeno").val();
         var add_business_cheque_micr=$("#market_lead_add_packages_cheque_micr").val();
         var add_business_cheque_photo=$("#market_lead_add_packages_cheque_photo").val();
         var add_business_chequeissuedate=$("#market_lead_add_packages_chequeissuedate").val();
         
         if(paymentmodeid==6 && (!add_business_chequeaccountno || add_business_chequeaccountno.length<=0) && (!add_business_chequeno ||  add_business_chequeno.length<=0) && (!add_business_cchequeno || add_business_cchequeno.length<=0) && (!add_business_cheque_micr || add_business_cheque_micr.length<=0) && (!add_business_cheque_photo || add_business_cheque_photo.length<=0) && (!add_business_chequeissuedate || add_business_chequeissuedate.length<=0)){
            alert("Please fill all Cheque Mode options!!!");
            return false;
         }
         
         var add_business_cashamount=$("#market_lead_add_packages_cashamount").val();
         var add_business_cashdate=$("#market_lead_add_packages_cashdate").val();
         var add_business_personame=$("#market_lead_add_packages_personame").val();
         var add_business_placename=$("#market_lead_add_packages_placename").val();
         
         
         if(paymentmodeid==1 && (!add_business_cashamount || add_business_cashamount.length<=0) && (!add_business_cashdate ||  add_business_cashdate.length<=0) && (!add_business_personame ||  add_business_personame.length<=0) && (!add_business_placename ||  add_business_placename.length<=0)){
            alert("Please fill all Cash Mode options!!!");
            return false;
         }

         if (currentIndex < newIndex)
         {
             // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", market_lead_packagesform).remove();
            $(".body:eq(" + newIndex + ") .error", market_lead_packagesform).removeClass("error");

          }
        //alert(businessform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }



           });
        
       // $('.wizard').wizard('next');
       //   $nextBtn = $('.wizard').find( 'button.btn-next' );
       //   $nextBtn.removeAttr('disabled');

        
        market_lead_packagesform.validate().settings.ignore = ":disabled,:hidden";
        return market_lead_packagesform.valid();
     
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
         var campaigntotal=0;
         var package=0;

    var uppersaleamount = $("#market_lead_add_packages_uppersale_amount").val();
       if (uppersaleamount>0) {
        uppersaleamount=Number(uppersaleamount);
       }else{
          uppersaleamount=0;
       }
      
      if (currentIndex == 2) {
          todayAppMarketingLeadviewpackagelist(uppersaleamount)
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
                var packageamount=Number($(this).attr("data-pamount"));
                  package += Number(packageamount); 
               var packageamount=Number(packageamount+uppersaleamount);
               packagetotal += Number(packageamount); 
        $('#packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packageamount+'</label></div>');   
  
            });
        }
         var totaluppersaleamount = Number(packagetotal-package); 
      $('#market_lead_add_packages_totaluppersale_amount').val(totaluppersaleamount); 
       var domainamount_checked1 = $('#market_lead_add_packages_domainamount_checked:checked').val();
     if(domainamount_checked1==1){
           var packages_domainamount=$("#market_lead_add_packages_domainamount").val();
           var packages_domainamount=Number(packages_domainamount);
           var packages_domainamountview='<div class="col-sm-6 col-6 form-group"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6 form-group "><label>'+packages_domainamount+'</label></div>'
       }else{
           var packages_domainamount= 0;
           var packages_domainamountview=' ';
       }

      var totalpackageamount=campaigntotal+packagetotal;
      var total=Number(totalpackageamount+packages_domainamount); 
        var tdsvalue = $('#market_lead_add_packages_tds:checked').val();
         // alert(tdsvalue);
     if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }

      var total= parseFloat(total).toFixed(2);
     var state_id = $('#market_lead_add_packages_companyname_state_id').val();
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
      gst='<div class="col-sm-6 col-6 form-group"> <label>IGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+igst+'</label></div> '+tdsview+'';
     } 
     // alert(grandtoatal);
     $('#totalamount1').empty();
     $('#totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Packages Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+totalpackageamount+'</label></div> '+packages_domainamountview+' <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div> </div></div>')
      
      $('#market_lead_add_packages_total').val(grandtoatal);
      $('#market_lead_add_packages_totalpackageamount').val(totalpackageamount);
      

    },
    onFinishing: function (event, currentIndex)
    {  
        market_lead_packagesform.validate().settings.ignore = ":disabled";
        return market_lead_packagesform.valid();
       
    },
    onFinished: function (event, currentIndex)
    {
  
    var business_id=$('#market_lead_add_packages_companyname').val();   
    var formData = new FormData($("#market_lead_add_packagesdata")[0] );
     $.ajax({
    type:"POST",
    url:url+"market-lead/TodayAllAppointmentsController/savePackagesData",
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
        $('#market_lead_add_packagesdata')[0].reset();
        
          window.setTimeout(function(){location.reload()},3000);

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



// $(document).ready(function(){

 $("#todaymarketingleadapplypromocode").click(function(){
 var market_lead_add_packages_promocode = $('#market_lead_add_packages_promocode').val();
 var tdsvalue = $('#market_lead_add_packages_tds:checked').val();
 var totalamount = $('#market_lead_add_packages_totalpackageamount').val();
 var market_lead_add_packages_companyname = $('#market_lead_add_packages_companyname').val();
 var state_id = $('#market_lead_add_packages_companyname_state_id').val();
 var domainamount_checked1 = $('#market_lead_add_packages_domainamount_checked:checked').val();
    $.ajax({
    type: "POST",
    url:url+'market-lead/TodayAllAppointmentsController/getAmountPromocode',
    data:{market_lead_add_packages_promocode:market_lead_add_packages_promocode,market_lead_add_packages_companyname:market_lead_add_packages_companyname},
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
           var packages_domainamount=$("#market_lead_add_packages_domainamount").val();
           var packages_domainamount = Number(packages_domainamount);
           var domainamount_packageviw='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+packages_domainamount+'</label></div>'
         }else{
           var packages_domainamount= 0;
           var domainamount_packageviw=' ';
         }
     var total=Number(totalpackageamount+packages_domainamount); 
     var total= parseFloat(total).toFixed(2);
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
        var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6"> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
       
     }else{
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> '+tdsview+'';
      
     } 

      $('#grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Amount </label></div> <div class="col-sm-6 col-6"><label>'+discountamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>');

  $('#market_lead_add_packages_discountamount').val(discountamount);
  $('#market_lead_add_packages_grandtotal').val(grandtoatal);
  $('#market_lead_add_packages_totalpackageamount').val(totalamount);
  $('#market_lead_add_packages_promocode_id').val(result.data[0].id);

      }else if(result.success==false){
        
            $('#totalamount1').hide();  
            $('#grandtotalamount').empty();
            $('#discount').empty();
            $('#promcodeamount-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
            $("#promcodeamount-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>"); 
         
        if(domainamount_checked1==1){
           var packages_domainamount=$("#market_lead_add_packages_domainamount").val();
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
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>';
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
          var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6"> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
       
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var grandtoatal =Math.round(grandtoatal);
      var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> '+tdsview+'';
     } 
     $('#grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>');
     
       $('#market_lead_add_packages_grandtotal').val('');
       $('#market_lead_add_packages_total').val(grandtoatal);
       $('#market_lead_add_packages_totalpackageamount').val(totalpackageamount);

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
   items+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="add_business_businesskeyword" name="add_business_businesskeyword"  style="display: inline;"> <span class="form-label" for="add_business_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

   edititems+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="market_lead_add_packages_businesskeyword" name="market_lead_add_packages_businesskeyword"  style="display: inline;"> <span class="form-label" for="market_lead_add_packages_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

       }

         $("#addkeywordsbusiness").html(items);
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


$("#search_packages_keyword").keyup(function() {
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


$(document).on('click', '.marketeditbusiness a', function(e){

 $(".market_lead_todayAppointmentList_class").hide();
 $(".market_lead_editbusiness-class").show();
 var id= $(this).attr("data-businessid");

$.ajax({
    type: "GET",
    url:url+'market-lead/TodayAllAppointmentsController/editBusinessByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 

        // alert(result.data[0].company_name);
        // $('#market_lead_edit_businessname_head').html(result.data[0].company_name);  

        $('#market_lead_edit_businessdata #market_lead_edit_business_addid').val(result.data[0].address_id);
        $('#market_lead_edit_businessdata #market_lead_edit_business_id').val(result.data[0].id);
        $('#market_lead_edit_businessdata #market_lead_edit_business_cname').val(result.data[0].company_name);
        $('#market_lead_edit_businessdata #market_lead_edit_business_hno').val(result.data[0].house_no);
        $('#market_lead_edit_businessdata #market_lead_edit_business_street').val(result.data[0].street);
        $('#market_lead_edit_businessdata #market_lead_edit_business_subarea').val(result.data[0].sub_area);
        $('#market_lead_edit_businessdata #market_lead_edit_business_area').val(result.data[0].area);
        $('#market_lead_edit_businessdata #market_lead_edit_business_landmark').val(result.data[0].landmark);
        $('#market_lead_edit_businessdata #market_lead_edit_business_city').val(result.data[0].city_id).prop("selected", true);
        $('#market_lead_edit_businessdata #market_lead_edit_business_state').val(result.data[0].state_id).prop("selected", true);

        if(result.data[0].pincode==0){
           var pincode ="";
        }else{
            var pincode =result.data[0].pincode;
        }
        $('#market_lead_edit_businessdata #market_lead_edit_business_pincode').val(pincode);

         $('#market_lead_edit_businessdata #market_lead_edit_business_pname').val(result.data[0].person_name);
         $('#market_lead_edit_businessdata #market_lead_edit_business_designation').val(result.data[0].person_designation);
         $('#market_lead_edit_businessdata #market_lead_edit_business_landlineno').val(result.data[0].landline_no);
         $('#market_lead_edit_businessdata #market_lead_edit_business_mobileno').val(result.data[0].mobile_no);
         $('#market_lead_edit_businessdata #market_lead_edit_business_altnemobileno').val(result.data[0].alt_mobile_no);
         $('#market_lead_edit_businessdata #market_lead_edit_business_email').val(result.data[0].email);

        $('#market_lead_edit_businessdata #market_lead_edit_business_gstcname').val(result.data[0].gst_company_name);
        $('#market_lead_edit_businessdata #market_lead_edit_business_cgstcname').val(result.data[0].gst_company_name);
        $('#market_lead_edit_businessdata #market_lead_edit_business_gstno').val(result.data[0].gst_number);
        $('#market_lead_edit_businessdata #market_lead_edit_business_cgstno').val(result.data[0].gst_number);
        $('#market_lead_edit_businessdata #market_lead_edit_business_gststate').val(result.data[0].gst_state);
          if(result.data[0].gst_pincode==0){
           var gst_pincode ="";
        }else{
            var gst_pincode =result.data[0].gst_pincode;
        }

        $('#market_lead_edit_businessdata #market_lead_edit_business_gstpincode').val(gst_pincode);
        $('#market_lead_edit_businessdata #market_lead_edit_business_gstpanno').val(result.data[0].gst_pan_no);
        $('#market_lead_edit_businessdata #market_lead_edit_business_gstaddress').val(result.data[0].gst_address);

        // $('#market_lead_edit_businessdata #market_lead_edit_business_status').val(result.data[0].business_status_id).prop("selected", true);


        $('#market_lead_edit_businessdata #market_lead_edit_business_website').val(result.data[0].website_url);
        $('#market_lead_edit_businessdata #market_lead_edit_business_facebook').val(result.data[0].facebook_url);
        $('#market_lead_edit_businessdata #market_lead_edit_business_twitter').val(result.data[0].twitter_url);
        $('#market_lead_edit_businessdata #market_lead_edit_business_youtube').val(result.data[0].youtube_url);
        $('#market_lead_edit_businessdata #market_lead_edit_business_linkedin').val(result.data[0].linkedin_url);
        $('#market_lead_edit_businessdata #market_lead_edit_business_instagram').val(result.data[0].instagram_url);

        $('#market_lead_edit_businessdata #market_lead_edit_business_owner1name').val(result.editowner[0].owner_name);
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner1role').val(result.editowner[0].owner_role);
         if(result.editowner[0].owner_mobile==0){
           var owner_mobile ="";
        }else{
            var owner_mobile =result.editowner[0].owner_mobile;
        }
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner1mobile').val(owner_mobile);
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner1email').val(result.editowner[0].owner_email);

        $('#market_lead_edit_businessdata #market_lead_edit_business_owner2name').val(result.editowner[1].owner_name);
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner2role').val(result.editowner[1].owner_role);
         if(result.editowner[1].owner_mobile==0){
           var owner_mobile1 ="";
        }else{
            var owner_mobile1 =result.editowner[1].owner_mobile;
        }
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner2mobile').val(owner_mobile1);
        $('#market_lead_edit_businessdata #market_lead_edit_business_owner2email').val(result.editowner[1].owner_email);
      
         

         $('#market_lead_edit_businessdata #market_lead_edit_business_lat').val(result.data[0].latitude);
         $('#market_lead_edit_businessdata #market_lead_edit_business_long').val(result.data[0].longitude);

  //  var latitude=result.data[0].latitude;
  //  var longitude=result.data[0].longitude;
  // var myLatLng = {lat:latitude, lng:longitude};
  // var map = new google.maps.Map(document.getElementById('editdvMap'), {
  //   zoom: 4,
  //   center: myLatLng
  // });

  // var marker = new google.maps.Marker({
  //   position: myLatLng,
  //   map: map,
  //   title: 'Hello World!'
  // });




   if(result.data[0].photo!=null){
     $("#businessimage").html('<img src="'+url+result.data[0].photo+ '" width="200px"  height="100px" alt=" photo" />');
   }else{
    $("#businessimage").html('<img src="'+url+'assets/images/no_image.png" width="200px"  height="100px" alt=" photo" />')
   }



      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var marketleadbusinesseditform = $("#market_lead_edit_businessdata");
marketleadbusinesseditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      market_lead_edit_business_city :"required",
      market_lead_edit_business_state :"required",
      market_lead_edit_business_cname :"required",
      // market_lead_edit_business_street:"required", 
      // market_lead_edit_business_area:"required",
      market_lead_edit_business_pincode:{number:true,minlength:6, maxlength:6},
      market_lead_edit_business_pname:"required",
      market_lead_edit_business_designation:"required",
      market_lead_edit_business_landlineno:{number:true,minlength:8, maxlength:16},
      market_lead_edit_business_mobileno:{required:true,number:true, number:true,minlength:10, maxlength:10},
      market_lead_edit_business_altnemobileno:{minlength:10, maxlength:10},
      market_lead_edit_business_condition:"required",
      market_lead_edit_business_email:{required:true,email: true },
      market_lead_edit_business_cgstcname: {equalTo: "#market_lead_edit_business_gstcname"},
      market_lead_edit_business_cgstno: {equalTo: "#market_lead_edit_business_gstno"},
      market_lead_edit_business_debitcardno:{number:true,minlength:5, maxlength:18},
      market_lead_edit_business_creditcardno:{number:true,minlength:5, maxlength:18},
      market_lead_edit_business_accountno:{number:true,minlength:5, maxlength:20},
      market_lead_edit_business_caccountno: {number:true,minlength:5, maxlength:20,equalTo: "#market_lead_edit_business_accountno"},
      market_lead_edit_business_cacholdername: { equalTo: "#market_lead_edit_business_acholdername"},
      // market_lead_edit_business_owner1name:"required",
      // market_lead_edit_business_owner1role:"required",
      market_lead_edit_business_owner1mobile:{number:true,minlength:10, maxlength:10},
      market_lead_edit_business_owner1email:{email: true },
      market_lead_edit_business_owner2mobile:{minlength:10, maxlength:10},
      market_lead_edit_business_owner2email:{email: true },
      // market_lead_edit_business_status:"required",
      

    }
});

marketleadbusinesseditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        marketleadbusinesseditform.validate().settings.ignore = ":disabled,:hidden";
          
        return marketleadbusinesseditform.valid();
        
    },
    onFinishing: function (event, currentIndex)
    {
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if ($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
           } 
        });
        marketleadbusinesseditform.validate().settings.ignore = ":disabled";
        return marketleadbusinesseditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#market_lead_edit_businessdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"market-lead/TodayAllAppointmentsController/updateBusinessData",
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

        $('#businessdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#businessdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#market_lead_edit_businessdata')[0].reset();

        window.setTimeout(function(){location.reload()},3000)
       
      }
      else{
        $('#businessdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#businessdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
      complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#businessdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#businessdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




$("#marketinglead_packages_generated_opt").click(function() {
var market_lead_add_packages_companyname = $("#market_lead_add_packages_companyname").val();
var add_business_payment_mode =$("input:radio[name=add_business_payment_mode]:checked").val();    
// var add_business_payment_mode = $("#add_business_payment_mode").val();
var market_lead_add_packages_total = $("#market_lead_add_packages_total").val();
var market_lead_add_packages_grandtotal = $("#market_lead_add_packages_grandtotal").val();
   $.ajax({
    type:"POST",
    url:url+"Welcome/OtpSendToMobileForpackageMarketingLead",
    dataType: 'json',
    data:{market_lead_add_packages_companyname:market_lead_add_packages_companyname,add_business_payment_mode:add_business_payment_mode,market_lead_add_packages_total:market_lead_add_packages_total,market_lead_add_packages_grandtotal:market_lead_add_packages_grandtotal},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
          alert(result.message);
           $('#marketinglead_package_otpverficationmodal').modal('show');
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


$("#marketingleadpackageotpverification").click(function() {

var marketinglead_package_mobileOtp = $("#marketinglead_package_mobileOtp").val();
   $.ajax({
       type:"POST",
       url:url+"Welcome/OtpVerficationToMobileForpackageMarketingLead",
    dataType: 'json',
    data:{marketinglead_package_mobileOtp:marketinglead_package_mobileOtp},
    dataType: 'json',
 success: function(result){
      
      if(result.success==true){
        $('#marketinglead_add_package_otp').val(marketinglead_package_mobileOtp);
        $('#marketinglead_package_otpverficationmodal').modal('hide');    
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


// }); // document ready

 function todayAppMarketingLeadviewpackagelist(uppersaleamount){
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