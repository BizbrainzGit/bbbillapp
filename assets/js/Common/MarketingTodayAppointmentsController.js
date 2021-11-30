

// $(document).ready(function(){

$(function(){
     var items="";
     $.getJSON(url+"market/TodayAppointmentsController/listTodayApp", function(todayappointmentsList){
      $.each(todayappointmentsList,function(index,itemlist)
     {

     if ( $.fn.DataTable.isDataTable('#todayapptable')) {
         $('#todayapptable').DataTable().destroy();
         }  
         $('#todayapptable tbody').empty();

         var data=itemlist; 
         var table = $('#todayapptable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
    //      {data: null,
    //       'title' : 'Action',
    //       "sClass" : "center",
    //       mRender: function (data, type, row) {
    // return '<button class="btn btn-warning btn-sm mt-2 market_status_edit" data-toggle="modal" id="market_status_edit" data-target="#market_EditstatusModal" title="Edi Business Status"><a data-statusbusinessid="'+data.id+'" data-businessname="' +data.company_name+ '" data-assignmentid="'+data.assignment_id+'" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp;      <button class="btn btn-info btn-sm mt-2 market_selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;'
    //           } },
      {data: 'assignment_id',title: 'S No.'},
      {data: 'company_name',title:'Company Name'},
      {data: 'person_name',title:'Contact Person Name'},
      {data: 'mobile_no',title:'Contact Person Phone'},
      {data: 'message',title:'Message'},
      {data: 'tele_marketing_name',title:'Assigned By'}, 
      {data: 'appointment_time',title:'Appointment <br> Time'},
      {data: 'status_value',title:'Status'},
      
    
        ],

       });

table.rows.add(data).draw();
     
      }); 
      }); 
 });

$('[data-toggle="modal"]').tooltip();




viewStatusPopup();   
function viewStatusPopup(){
            $.ajax({
                type  : 'GET',
                url   : url+"market/TodayAppointmentsController/TodayAppStatusPopup",
                async : true,
                dataType : 'json',
                success : function(result){
                  if(result.success==true){
                        $("#myModal").modal('show');
                        // alert(result.data[0].status_value);
         $('#market_change_status_form #market_change_status_id').val(result.data[0].id);                 
         $('#market_change_status_form #market_change_assignment_id').val(result.data[0].assignment_id);
         $('#market_change_status_form #market_change_status_companyname').html(result.data[0].company_name);
         $('#market_change_status_form #market_change_status_conactname').html(result.data[0].person_name);
         $('#market_change_status_form #market_change_status_mobileno').html(result.data[0].mobile_no);
         $('#market_change_status_form #market_change_status_apptime').html(result.data[0].appointment_time);
         $('#market_change_status_form #market_change_status_appmsg').html(result.data[0].message); 
         $('#market_change_status_form #market_change_status').val(result.data[0].status_value).prop("selected",true); 
         }else if(result.success==false){
                 $("#myModal").modal('hide');
         }

                     }
            });
        }

$(document).on('click', '.market_status_edit a', function(e){
 var id= $(this).attr("data-statusbusinessid");
 var assignmentid= $(this).attr("data-assignmentid");
$('#todaymarket_change_status_form #todaymarket_change_assignment_id').val(assignmentid);

 $.ajax({
    type: "GET",
    url:url+'market/TodayAppointmentsController/MarketeditStatusByid/'+assignmentid,
    dataType: 'json',
      success:function(result){
          if(result.success===true)
          { 
             
             if(result.updateddata[0].is_update==1){

                 $("#market_appointment_statusmodel").hide();
                 $("#market_appointment_statuschecked").show();

                    items=' <label class="badge badge-warning" style="text-algin:center;padding:10px;"> This Assignment Updated  Already ... </label>';
                    $("#market_appointment_statuschecked").html(items); 

             }else if (result.updateddata[0].is_update==0){
                   
                  
            if(result.data.length>0){
                
             var items = "";
             var i;
             var n = result.data.length;
             for(var i=0; i<n; i++){
              // alert(result.data[i].appointment_time);
              items+=' <label class="badge badge-warning" style="text-algin:center;padding:10px;"> Please Updated '+result.data[i].appointment_time+'  Assignment </label>';
                }
                 
                $("#market_appointment_statusmodel").hide();
                $("#market_appointment_statuschecked").show();  
                $("#market_appointment_statuschecked").html(items); 

               }else {
                        
                  $("#market_appointment_statusmodel").show(); 
                  $("#market_appointment_statuschecked").hide(); 
                  $('#todaymarket_change_status_form #todaymarket_change_status_id').val(id);
                  $('#todaymarket_change_status_form #todaymarket_change_status').val(result.updateddata[0].business_status_id).prop("selected", true);
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



$("#todaymarket_change_status_form").validate({
     rules:{
        todaymarket_change_assignment_message : "required",
        todaymarket_change_status :"required"
      
     }
 });


 $("#todaymarket_updatestatus").click(function(){
    if(!$("#todaymarket_change_status_form").valid())
   {
       return false;
   }
  var formData = new FormData($("#todaymarket_change_status_form")[0] );
   $.ajax({
      type:"POST",
      url:url+"market/TodayAppointmentsController/TodayMarketupdateStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
   success: function(result){
      if(result.success===true){
        $('#todaymarket-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#todaymarket-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
           $("#market_change_status_form")[0].reset();
            setTimeout(function(){
               $('#market_EditstatusModal').modal('hide');
                }, 5000); 

        window.setTimeout(function(){location.reload()},3000);

     }
  else if(result.success===false){
        $('#todaymarket-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#todaymarket-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#todaymarket-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#todaymarket-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });
});


// Marketing Pop Data Save Start//

$("#market_change_status_form").validate({
     rules:{
        market_change_assignment_message : "required",
        market_change_status :"required"
      
     }
 });


 $("#market_updatestatus").click(function(){
    if(!$("#market_change_status_form").valid())
   {
       return false;
   }
  var formData = new FormData($("#market_change_status_form")[0] );
   $.ajax({
      type:"POST",
      url:url+"market/TodayAppointmentsController/MarketupdateStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
   success: function(result){
      if(result.success===true){
        $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
           $("#market_change_status_form")[0].reset();
            setTimeout(function(){
               $('#market_EditstatusModal').modal('hide');
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



// $(document).on('click', '.market_selectedpackages a', function(e){
//  var id= $(this).attr("data-businessid");
//  var name=$(this).attr("data-businessname");

$('#todayapptable').on('click', 'tbody tr', function () {
    var table = $('#todayapptable').DataTable();
    var row = table.row($(this)).data();
     var id = row['id'];
     var assignment_id=row['assignment_id'] ;

$.ajax({
    type: "GET",
    url:url+'market/TodayAppointmentsController/editBusinessByid/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
         $(".market_todayAppointmentList_class").hide();
         $(".market_addpackages-class").show();

        // $('#market_add_packagesdata #market_add_packages_assignment_id').val(assignment_id);
        $('#market_add_packagesdata #market_edit_business_addid').val(result.data[0].address_id);
        $('#market_add_packagesdata #market_edit_business_id').val(result.data[0].id);

        $('#market_add_packagesdata #market_edit_business_cname').val(result.data[0].company_name);
        $('#market_add_packagesdata #market_edit_business_hno').val(result.data[0].house_no);
        $('#market_add_packagesdata #market_edit_business_street').val(result.data[0].street);
        $('#market_add_packagesdata #market_edit_business_subarea').val(result.data[0].sub_area);
        $('#market_add_packagesdata #market_edit_business_area').val(result.data[0].area);
        $('#market_add_packagesdata #market_edit_business_landmark').val(result.data[0].landmark);
        $('#market_add_packagesdata #market_edit_business_city').val(result.data[0].city_id).prop("selected", true);
        $('#market_add_packagesdata #market_edit_business_state').val(result.data[0].state_id).prop("selected", true);
           if(result.data[0].pincode!=0){
            var pincode=result.data[0].pincode;
           }else{
            var pincode="";
           }
         $('#market_add_packagesdata #market_edit_business_pincode').val(pincode);
         $('#market_add_packagesdata #market_edit_business_pname').val(result.data[0].person_name);
         $('#market_add_packagesdata #market_edit_business_designation').val(result.data[0].person_designation);
         $('#market_add_packagesdata #market_edit_business_mobileno').val(result.data[0].mobile_no);
         $('#market_add_packagesdata #market_edit_business_email').val(result.data[0].email);
         $('#market_add_packagesdata #market_edit_business_gstno').val(result.data[0].gst_number);

         $('#market_add_packagesdata #market_add_packages_status').val(result.data[0].business_status_id);

       
      }else{
            alert('request failed', 'error');
      }

    },
   
 fail:function(result){
        alert('Information request failed: ' + textStatus, 'error'); }

});



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

          $("#demowebsitespackages").html(items);
  
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


var marketpackagesform = $("#market_add_packagesdata");
marketpackagesform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      market_edit_business_city :"required",
      market_edit_business_state :"required",
      market_edit_business_cname :"required",
      market_edit_business_pincode:{number:true,minlength:6, maxlength:6},
      market_edit_business_pname:"required",
      market_edit_business_designation:"required",
      market_edit_business_email:{required:true,email: true },
      market_edit_business_mobileno:{required:true,number:true, number:true,minlength:10, maxlength:10},

      market_add_package_condition:"required",
    
      market_add_packages_chequeno:{number:true,minlength:4, maxlength:12},
      market_add_packages_cchequeno:{number:true,minlength:4, maxlength:12,equalTo:"#market_add_packages_chequeno"},
      
      market_add_packages_status_msg:"required", 
      market_add_packages_status:"required",

      market_add_packages_cashamount:{number:true},
      market_add_packages_neftamount:{number:true},
      market_add_packages_chequeamount:{number:true},
      market_add_packages_upiamount:{number:true},
      market_add_packages_upiphonenumber:{number:true,minlength:10, maxlength:12},

    }
});
 
marketpackagesform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {   

       // if (currentIndex == 2) {
       //    var n = $("#add_business_package:checked").length;
       //    if(n <=0){
       //       alert("Please Select Any One Package !!!");
       //      return false;
       //    }
       //  }
        
     
          var paymentmodeid = $("#add_business_payment_mode:checked").val();

if(paymentmodeid==6) {
            var add_chequeamount=$("#market_add_packages_chequeamount").val();
            var add_chequeno=$("#market_add_packages_chequeno").val();
            var add_cchequeno=$("#market_add_packages_cchequeno").val();
            var add_cheque_photo=$("#market_add_packages_cheque_photo").val();
            if (add_chequeno.length<=0) {
                 alert("Please fill Cheque Number");
                 return false;
             }
            if (add_cchequeno.length<=0 && add_cchequeno!=add_chequeno) {
                 alert("Please fill Confirm Cheque Number and Same As Cheque Number");
                 return false;
             }
            if (add_cheque_photo.length<=0) {
                 alert("Please Upload Cheque Photos");
                 return false;
             }
            if (add_chequeamount.length<=0) {
                 alert("Please fill Cheque Amount");
                 return false;
             } 

         }

         if(paymentmodeid==1) {
            var add_cashamount=$("#market_add_packages_cashamount").val();
            var add_personame=$("#market_add_packages_personame").val();
            if (add_personame.length<=0) {
                 alert("Please fill Person Name");
                 return false;
             }
            if (add_cashamount.length<=0) {
                 alert("Please fill Cash Amount");
                 return false;
             } 

         }

         if(paymentmodeid==4) {
            var add_upiname=$("#market_add_packages_upiname").val();
            var add_upiphonenumber=$("#market_add_packages_upiphonenumber").val();
            var add_upiphoto=$("#market_add_packages_upiphoto").val();
            var add_upiamount=$("#market_add_packages_upiamount").val();
            if (add_upiname.length<=0) {
                 alert("Please fill UPI Name");
                 return false;
             }
          if (add_upiphonenumber.length<=0) {
                 alert("Please fill UPI Phone Number");
                 return false;
             }
            if (add_upiamount.length<=0) {
                 alert("Please fill UPI Amount");
                 return false;
             } 
            if (add_upiphoto.length<=0) {
                 alert("Please Upload UPI Transction Photos");
                 return false;
             }

         }

         if(paymentmodeid==7) {
            var add_neftnumber=$("#market_add_packages_neftnumber").val();
            var add_neftamount=$("#market_add_packages_neftamount").val();
            var add_neftphoto=$("#market_add_packages_neftphoto").val();
            if (add_neftnumber.length<=0) {
                 alert("Please fill NEFT Number");
                 return false;
             }
            if (add_neftamount.length<=0) {
                 alert("Please fill NEFT Amount");
                 return false;
             } 
            if (add_neftphoto.length<=0) {
                 alert("Please Upload NEFT Transction Photos");
                 return false;
             }

         }
         
         
         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", marketpackagesform).remove();
            $(".body:eq(" + newIndex + ") .error", marketpackagesform).removeClass("error");
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
        
        marketpackagesform.validate().settings.ignore = ":disabled,:hidden";
        return marketpackagesform.valid();
     
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
         var campaigntotal=0;
         var package=0;

    var uppersaleamount = $("#market_add_packages_uppersale_amount").val();
     if (uppersaleamount>0) {
      uppersaleamount=Number(uppersaleamount);
     }else{
        uppersaleamount=0;
    
        // alert(uppersaleamount);
     }

       if (currentIndex == 3) {
          todayAppviewpackagelist(uppersaleamount)
        }  

      $('#market_totalamount1').show();  
      $('#market_campaignlist1').empty();
        var n = $("#add_business_campaign:checked").length;
        if (n > 0){
            $("#add_business_campaign:checked").each(function(){
                //var campaign_id= $(this).val();
                var campainname=$(this).attr("data-cname");
                var campaignamount=$(this).attr("data-camount");
                campaigntotal += Number(campaignamount);

        $('#market_campaignlist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campainname+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campaignamount+'</label></div>');   
            });

        }

        $('#market_packagelist1').empty();
        var n = $("#add_business_package:checked").length;
        if (n > 0){
            $("#add_business_package:checked").each(function(){
                //var campaign_id= $(this).val();
                var packagename=$(this).attr("data-pname");
                var packageamount=Number($(this).attr("data-pamount"));
                package += Number(packageamount); 
               var packageamount=Number(packageamount+uppersaleamount); 
               packagetotal += Number(packageamount); 
        $('#market_packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packageamount+'</label></div>');   
  
            });
        }
      var totaluppersaleamount = Number(packagetotal-package); 
      $('#market_add_packages_totaluppersale_amount').val(totaluppersaleamount); 
       
        var market_domainamount_checked = $('#market_add_packages_domainamount_checked:checked').val();
     if(market_domainamount_checked==1){
           var market_packages_domainamount=$("#market_add_packages_domainamount").val();
           var market_packages_domainamount=Number(market_packages_domainamount);
           var market_packages_domainamountview='<div class="col-sm-6 col-6 form-group"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6 form-group "><label>'+market_packages_domainamount+'</label></div>'
       }else{
           var market_packages_domainamount= 0;
           var market_packages_domainamountview=' ';
       }

      var totalpackageamount=campaigntotal+packagetotal;
      var total=Number(totalpackageamount+market_packages_domainamount); 
      var total= parseFloat(total).toFixed(2);
       var tdsvalue = $('#market_add_packages_tds:checked').val();
         // alert(tdsvalue);
     if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>';
       }else{
           var tds= 0;
           var tdsview=' ';
       }

      var total= parseFloat(total).toFixed(2);
     var state_id = $('#market_edit_business_state').val();
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
     $('#market_totalamount1').empty();
     $('#market_totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Packages Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+totalpackageamount+'</label></div> '+market_packages_domainamountview+' <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div> </div></div>')
      $('#market_add_packages_total').val(grandtoatal);
      $('#market_add_packages_totalpackageamount').val(totalpackageamount);

    },
    onFinishing: function (event, currentIndex)
    {  
        marketpackagesform.validate().settings.ignore = ":disabled";
        return marketpackagesform.valid();
       
    },
    onFinished: function (event, currentIndex)
    {
  
    var business_id=$('#market_edit_business_id').val();   
    
    var formData = new FormData($("#market_add_packagesdata")[0] );
     $.ajax({
    type:"POST",
    url:url+"market/TodayAppointmentsController/savePackagesData",
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

        $('#market_packagesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#market_packagesdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#market_add_packagesdata')[0].reset();
        
           window.setTimeout(function(){location.reload()},3000)

         }
      else{
        $('#market_packagesdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#market_packagesdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
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




 $("#market_applypromocode").click(function(){
 var market_add_packages_promocode = $('#market_add_packages_promocode').val();
 var totalamount = $('#market_add_packages_totalpackageamount').val();
 var market_add_packages_companyname = $('#market_edit_business_id').val();
 var state_id = $('#market_edit_business_state').val();
 var tdsvalue = $('#market_add_packages_tds:checked').val();
 var market_domainamount_checked = $('#market_add_packages_domainamount_checked:checked').val();

    $.ajax({
    type: "POST",
    url:url+'market/TodayAppointmentsController/getAmountPromocode',
    data:{market_add_packages_promocode:market_add_packages_promocode,market_add_packages_companyname:market_add_packages_companyname},
    dataType: 'json',
//   beforeSend: function(){
//     // Show image container
//     $(".loader").show();
// },  
  success:function(result){
      if(result.success===true)
      { 

 var discountamount=0 ;
 
if(result.data[0].discount_amount !='NULL' && result.data[0].discount_amount >0){
$( "#market_promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_amount+"Rs Discount to Using this Promocode </div>"); 

  discountamount=result.data[0].discount_amount;
  var discountamount= parseFloat(discountamount).toFixed(2);

}else if(result.data[0].discount_percentage != 'NULL' && result.data[0].discount_percentage != ' '){
$("#market_promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_percentage+"% Discount to Using this Promocode </div>");   
        var percentage=result.data[0].discount_percentage; 
        discountamount =(totalamount/100) * percentage ; 
        var discountamount= parseFloat(discountamount).toFixed(2);
       

}

$('#market_totalamount1').hide();  
     $('#market_add_packages_grandtotal').empty();
     $('#market_add_packages_total').empty();

    $('#market_grandtotalamount').empty();
   var totalpackageamount=totalamount-discountamount;
   if(market_domainamount_checked==1){
           var market_packages_domainamount=$("#market_add_packages_domainamount").val();
           var market_packages_domainamount = Number(market_packages_domainamount);
           var market_domainamount_packageviw='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+market_packages_domainamount+'</label></div>'
         }else{
           var market_packages_domainamount= 0;
           var market_domainamount_packageviw=' ';
         }
  var total=Number(totalpackageamount+market_packages_domainamount); 
   if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>';
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
       var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> '+tdsview+'';
      
     } 

      $('#market_grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Amount </label></div> <div class="col-sm-6 col-6"><label>'+discountamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+market_domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>')

      $('#market_add_packages_discountamount').val(discountamount); 
      $('#market_add_packages_total').val('');
      $('#market_add_packages_grandtotal').val(grandtoatal); 
      $('#market_add_packages_state_id').val(state_id);
      $('#market_add_packages_promocode_id').val(result.data[0].id);
      $('#market_add_packages_totalpackageamount').val(totalamount);


      }else if(result.success==false){
        
        $('#market_totalamount1').hide();  
             $('#market_add_packages_grandtotal').empty();
             $('#market_add_packages_total').empty();
             $('#market_discount').empty();
             $('#market_promcodeamount-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
             $("#market_promcodeamount-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>"); 

  
   if(market_domainamount_checked==1){
           var market_packages_domainamount=$("#market_add_packages_domainamount").val();
           var market_packages_domainamount = Number(market_packages_domainamount);
           var market_domainamount_packageviw='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+market_packages_domainamount+'</label></div>'
         }else{
           var market_packages_domainamount= 0;
           var market_domainamount_packageviw=' ';
         }
        var totalpackageamount=Number(totalamount);
        var total=Number(totalpackageamount+market_packages_domainamount); 

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
          var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 "> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
       
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var grandtoatal =Math.round(grandtoatal);
      var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div> '+tdsview+'';
     } 

     $('#market_grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+market_domainamount_packageviw+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>');
       
     $('#market_add_packages_total').val(grandtoatal);
     $('#market_add_packages_grandtotal').val('');
     $('#market_add_packages_totalpackageamount').val(totalpackageamount);
     
 
      }

    },
//    complete:function(){
//     // Hide image container
//     $(".loader").hide();
// },
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

   edititems+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="market_add_packages_businesskeyword" name="market_add_packages_businesskeyword"  style="display: inline;"> <span class="form-label" for="market_add_packages_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

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
         // viewBusinessKeywords(); 
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




$("#marketing_packages_generated_opt").click(function() {


var market_add_packages_companyname = $("#market_edit_business_id").val();
var add_business_payment_mode =$("input:radio[name=add_business_payment_mode]:checked").val();    
// var add_business_payment_mode = $("#add_business_payment_mode").val();
var market_add_packages_total = $("#market_add_packages_total").val();
var market_add_packages_grandtotal = $("#market_add_packages_grandtotal").val();
   $.ajax({
    type:"POST",
    url:url+"Welcome/OtpSendToMobileForpackageMarketing",
    dataType: 'json',
    data:{market_add_packages_companyname:market_add_packages_companyname,add_business_payment_mode:add_business_payment_mode,market_add_packages_total:market_add_packages_total,market_add_packages_grandtotal:market_add_packages_grandtotal},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
          alert(result.message);
           $('#marketing_package_otpverficationmodal').modal('show');
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


$("#marketingpackageotpverification").click(function() {
 var marketing_package_mobileOtp = $("#marketing_package_mobileOtp").val();
   $.ajax({
       type:"POST",
       url:url+"Welcome/OtpVerficationToMobileForpackageMarketing",
    dataType: 'json',
    data:{marketing_package_mobileOtp:marketing_package_mobileOtp},
    dataType: 'json',
 success: function(result){
      if(result.success==true){
        $('#marketing_add_package_otp').val(marketing_package_mobileOtp);
        $('#marketing_package_otpverficationmodal').modal('hide');    
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


 function todayAppviewpackagelist(uppersaleamount){
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

// }); // document ready ///
