
$(document).ready(function(){
viewBusinessSelectedPackage();   
        function viewBusinessSelectedPackage(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessSelectedPackageController/SearchBusinessSelectedPackages",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
        viewBusinessSelectedPackagesList(result.data);
               }        
                }
            });
        }

 function viewBusinessSelectedPackagesList(businesslist){
      
         if ( $.fn.DataTable.isDataTable('#businessseletedpackagestable')) {
         $('#businessseletedpackagestable').DataTable().destroy();
         }  
         $('#businessseletedpackagestable tbody').empty();
         var data=businesslist; 
         var table = $('#businessseletedpackagestable').DataTable({
         paging: true,
         searching: true,
         columns: [

      {data: 'id',title: 'S No.'},
      {data: 'company_name_id',title:'Company Name & Id'},
      {data: 'person_name_mobile',title: 'Person Name & Mobile No'},
      {data: 'cityname',title: 'City Name'},
      {data: 'package_name',title: 'Package Name'},
      {data: 'campaign_name',title:'Compain Name'},
      {data: 'gstgrand_total_amount',title:'Package Grand <br> Total Amount'},
      {data: 'payment_created_on',title:'Package Taken Date'}, 
      {data: 'package_created_name',title:'Package Given By'},
      {data: 'business_created_name',title:'Business Created By'},
      {data: 'status_value',title:'Package Status'},
      {data: null,
          'title' : 'Action',
          "sClass" : "center",
          mRender: function (data, type, row) {
               return ' <button class="btn btn-danger btn-sm package_paymentlink"  id="package_paymentlink" title="Payment Link"><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;  <button class="btn btn-info btn-sm business_receipt"  id="business_receipt" title="Receipt" ><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp; <button class="btn btn-warning btn-sm business_payment_pending"  id="business_payment_pending" title="Payment Pending" ><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;'

        } }
     ]
 });
table.rows.add(data).draw();
if(data.length>0){
    $('#businessselectedpakage_excel').show();
    $('#businessselectedpakage_pdf').show();
    $('#businessselectedpakage_print').show();
  }

 }


// Search Business Selected Packages  Start //


$("#search_businessseletedpackage").validate({
     
     rules:{
        // search_business_cname :"required",
        // search_business_city :"required",
      
     }
 });

$("#searchbusinessseletedpackage").click(function() {
    if(!$("#search_businessseletedpackage").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_businessseletedpackage")[0]);
     $.ajax({
    type:"POST",
    url:url+"BusinessSelectedPackageController/SearchBusinessSelectedPackages",
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

        viewBusinessSelectedPackagesList(result.data)

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

// ==== business Selected Package search ends == //


$('#businessselectedpakage_excel').click(excelexport);
$('#businessselectedpakage_pdf').click(excelexport);
$('#businessselectedpakage_print').click(excelexport);
function DownloadExcel(link) {
   var downloadurl=url+link;
  // alert(downloadurl);
  window.open(downloadurl,'_blank');
}
function excelexport(){
  var export_type='';
  var id = this.id;
  if(id=='businessselectedpakage_excel'){
    export_type=$("#businessselectedpakage_excel").val();
    
  }
  if(id=='businessselectedpakage_pdf'){
    export_type=$("#businessselectedpakage_pdf").val();  
  }
  if(id=='businessselectedpakage_print'){
    export_type=$("#businessselectedpakage_print").val();  
  }
  var obj=  {export_type:export_type};
  var data = JSON.stringify(obj);
  
  jQuery.ajax({
    type: "POST",
    url:url+"BusinessSelectedPackageController/BusinessSelectedPackagesExport",
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
              printWindow.document.write('<html><head><title> Customer Secleted Packages List </title>');
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




/* ==== Payment Link Send To Customer Start  ===*/

 $(document).on('click', '.package_paymentlink a', function(e){
 var id= $(this).attr("data-selectedid");
 var name=$(this).attr("data-selectedname");
 // alert(id);
$.ajax({
    type: "GET",
    url:url+'BusinessSelectedPackageController/PackagePaymentLink/'+id,
    dataType: 'json',
  beforeSend:function(){
         return confirm("Are you sure? You want to Send Payment Link");
      },
  success:function(result){
      if(result.success===true)
      { 
          alert(" Payment Link Send To Your Email... ");
      }else{
            alert('request failed', 'error');
      }

    },
   fail:function(result){
        alert('Information request failed: ' + textStatus, 'error');
      },
});

});


// 


/* ==== payment pending start  ===*/
 $(document).on('click', '.business_payment_pending a', function(e){
 
 var id= $(this).attr("data-selectedid");
 var name=$(this).attr("data-selectedname");
 $(".listslectedpackages-class").hide();

$.ajax({
    type: "GET",
    url:url+'BusinessSelectedPackageController/BusinessPaymentPending/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
        $(".paymentpending-class").show();
        $('#add_business_paymentpending #business_paymentpending_package_id').val(result.data[0].business_package_id);
        $('#add_business_paymentpending #business_paymentpending_business_id').val(result.data[0].business_id);

        $('#add_business_paymentpending #add_paymentpending_status').val(result.data[0].business_status_id).prop('selected', true);

        $('#business_paymentpending_company_name').html(result.data[0].company_name);
        $('#business_paymentpending_person_name').html(result.data[0].person_name);
        $('#business_paymentpending_designation').html(result.data[0].person_designation);
        $('#business_paymentpending_mobileno').html(result.data[0].mobile_no);
        $('#business_paymentpending_email').html(result.data[0].email);
        $('#business_paymentpending_address').html(result.data[0].address);
       
        $('#business_paymentpending_subtotal').html(result.data[0]. total_amount);
        $('#business_paymentpending_discount').html(result.data[0].discount_amount);
        $('#business_paymentpending_total').html(result.data[0].grand_total_amount);



        $('#business_paymentpending_subtotal').html(result.data[0]. total_amount);
        $('#business_paymentpending_discount').html(result.data[0].discount_amount);
        $('#business_paymentpending_packagetotal').html(result.data[0].grand_total_amount);
         
         
         if(result.data[0].domain_amount==null && result.data[0].domain_amount==0){
            var domain_amount=0; 
         }else{
            var domain_amount=Number(result.data[0].domain_amount);
         }
          $('#business_paymentpending_domainamount').html(domain_amount);
          
        if(domain_amount==0){
            var total_amount=result.data[0].grand_total_amount; 
         }else{
            var total_amount=Number(Number(result.data[0].grand_total_amount)+Number(domain_amount));
         }
        $('#business_paymentpending_total').html(total_amount);
         
         if(result.data[0].tds_amount==null && result.data[0].tds_amount==0){
            var tds_amount=0; 
         }else{
            var tds_amount=Number(result.data[0].tds_amount);
         }
          $('#business_paymentpending_tdsamount').html(tds_amount);

         if(result.data[0].uppersale_amount==null && result.data[0].uppersale_amount==0){
            var uppersale_amount=0; 
         }else{
            var uppersale_amount=Number(result.data[0].uppersale_amount);
         }  
       
       if(result.data[0].cgst_amount!=null && result.data[0].sgst_amount!=null && result.data[0].cgst_amount!=0 && result.data[0].sgst_amount!=0){
            var gst=Number(Number(result.data[0].cgst_amount)+Number(result.data[0].sgst_amount));
         }else if(result.data[0].igst_amount!=null ){
           var gst=Number(result.data[0].igst_amount);
         }
        $("#business_paymentpending_gst").html(gst);
        $("#business_paymentpending_gstgrandtotal").html(result.data[0].gstgrand_total_amount);
        $("#receipt_payment_methode").html(result.data[0].paymenttype_name);
        $("#receipt_order_id").html(result.data[0].order_id);  

        
        

          for(var i=0; i<result.campaigndata.length;i++){
         $("#business_paymentpending_packages_table > tbody").append('<tr><td>'+result.campaigndata[i][0].campaign_name+'</td><td>'+result.campaigndata[i][0].campaign_amount+'</td></tr>');
                 }             
    
        for(var j=0; j<result.packagesdata.length;j++){
             var package_amount = Number(result.packagesdata[j][0].package_amount)+Number(uppersale_amount);
           $("#business_paymentpending_packages_table > tbody").append('<tr><td>'+result.packagesdata[j][0].package_name+'</td><td>'+package_amount+'</td></tr>');
        } 

        var transctiontotal=0;
        for(var j=0; j<result.paymenttransction.length;j++){
           $("#business_paymentpending_transctiondetails > tbody").append('<tr><td>'+result.paymenttransction[j].order_id+'</td><td>'+result.paymenttransction[j].transaction_amount+'</td><td>'+result.paymenttransction[j].paymenttype_name+'</td><td>'+result.paymenttransction[j].transaction_status+'</td></tr>');
           if(result.paymenttransction[j].transaction_status=="SUCCESS"){ 
             var amount=result.paymenttransction[j].transaction_amount;
                transctiontotal += parseFloat(amount);
              }
             } 

      $("#business_paymentpending_transction_gstgrandtotal").html(result.data[0].gstgrand_total_amount);
      var transctiontotal= parseFloat(transctiontotal).toFixed(2);
      $("#business_paymentpending_transction_grandtotal").html(transctiontotal);
        var pendingtotal= parseFloat(result.data[0].gstgrand_total_amount)-parseFloat(transctiontotal);
        var pendingtotal= parseFloat(pendingtotal).toFixed(2);
        $("#business_paymentpending_transction_pendingtotal").html(pendingtotal);
        $("#business_paymentpending_transction_pendingtotal_showingpending").html(pendingtotal);
        $("#business_paymentpending_pendingtotal").val(pendingtotal);
       
      }else{
            alert('request failed', 'error');
      }

    },
 
   fail:function(result){
        alert('Information request failed: ' + textStatus, 'error');
      },
});

});



var paymentpendingaddform = $("#add_business_paymentpending");
paymentpendingaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_paymentpending_status :"required"
     
    }
});

paymentpendingaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {      


       var business_paymentpending_pendingtotal = $("#business_paymentpending_pendingtotal").val();
         var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
            if($(this).text() == 'Next') {
                 if (currentIndex==0 && business_paymentpending_pendingtotal==0) {
                       $(this).attr('disabled', true);
                        $(this).addClass('disabled');
                  } else {
                       $(this).attr('disabled', false);
                       $(this).removeClass('disabled');
                  }
            }


           });

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
         
    var formData = new FormData($("#add_business_paymentpending")[0] );
     $.ajax({
      type:"POST",
     url:url+"BusinessSelectedPackageController/savePaymentpendingData",
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

        $('#paymentpendingdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#paymentpendingdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_business_paymentpending')[0].reset(); 
        window.setTimeout(function(){location.reload()},3000);
      
      }
      else{
        $('#paymentpendingdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#paymentpendingdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#paymentpendingdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#paymentpendingdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});

/* ==== payment pending ends  ===*/ 

/* ==== Receipt ends  ===*/

$(document).on('click', '.business_receipt a', function(e){
 var id= $(this).attr("data-selectedid");
 var name=$(this).attr("data-selectedname");
 $(".listslectedpackages-class").hide();
 $(".listofreceipt-class").show();
$.ajax({
    type: "GET",
    url:url+'BusinessSelectedPackageController/BusinessReceiptList/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
        
        if ( $.fn.DataTable.isDataTable('#listofreceipttable')) {
         $('#listofreceipttable').DataTable().destroy();
         }  
         $('#listofreceipttable tbody').empty();

         var data=result.data; 
         var table = $('#listofreceipttable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'Sno'},
      {data: 'created_on',title:'Date'},
      {data: 'order_id',title:'Order Id'},
      {data: 'paymenttype_name',title:'Payment Type'}, 
      {data: 'transaction_amount',title:'Paid Amount'}, 
      {data: 'transaction_status',title:'Transction Status'},
      {data: null,
          'title' : 'Action',
          "sClass" : "center",
          mRender: function (data, type, row) {
                         return '<button class="btn btn-info btn-sm business_receipt_byid"  id="business_receipt_byid" title="Receipt" ><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;'
        } }
     ]
   
 });

table.rows.add(data).draw();

       
      }else{
            alert('request failed', 'error');
      }
    },
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});


});



$(document).on('click', '.business_receipt_byid a', function(e){
 var id= $(this).attr("data-selectedid");
 var name=$(this).attr("data-selectedname");
 $(".listofreceipt-class").hide();
$.ajax({
    type: "GET",
    url:url+'BusinessSelectedPackageController/BusinessReceipt/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
        $(".receipt-class").show();
        $('#export_receipt #business_receipt_selectedid').val(result.data[0].id);
        // alert(result.data[0].id);
        $('#receipt_date').html(result.data[0].created_on);
        $('#receipt_number').html(result.data[0].id);
        $('#receipt_company_name').html(result.data[0].company_name);
        $('#receipt_company_address').html(result.data[0].address);
        $('#receipt_company_city').html(result.data[0].cityname);
        $('#receipt_comapy_state').html(result.data[0].state_name); 
        $('#receipt_person_designation').html(result.data[0].person_designation); 
        $('#receipt_person_name').html(result.data[0].person_name); 
        $('#receipt_email').html(result.data[0].email); 

        $('#receipt_mobile_no').html(result.data[0].mobile_no);
        $('#receipt_total_payment').html(result.data[0].grand_total_amount);
        $('#receipt_bank_name').html(result.data[0].bank_name);
        
        // $('#receipt_pay_date').html(result.data[0].created_on);
       //  $("#receipt_sub_total").html(result.data[0].total_amount);
       //  $("#receipt_discount_amount").html(result.data[0].discount_amount);
       //  $("#receipt_total_amount").html(result.data[0].grand_total_amount);
       // if(result.data[0].cgst_amount!=null && result.data[0].sgst_amount!=null){
       //  var gst=Number(Number(result.data[0].cgst_amount)+Number(result.data[0].sgst_amount));
       // }else if(result.data[0].igst_amount!=null ){
       //   var gst=Number(result.data[0].igst_amount);
       // }
       //  $("#receipt_gst").html(gst);
       //  $("#receipt_grand_total").html(result.data[0].gstgrand_total_amount);

           // alert(result.data[0].transaction_amount);
        $("#receipt_transaction_amount").html(result.data[0].transaction_amount);
        $("#receipt_transaction_status").html(result.data[0].transaction_status);
        $("#receipt_payment_methode").html(result.data[0].paymenttype_name);
        $("#receipt_order_id").html(result.data[0].order_id);
        $("#receipt_marketing_name").html(result.data[0].name);
        
       
      }else{
            alert('request failed', 'error');
      }
    },
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});

/* ==== Receipt ends  ===*/


//==== send Email Receipt Start=== //

    $('#receipt_pdf').click(receiptexport);
    $('#receipt_print').click(receiptexport);
    function DownloadExcelReceipt(link) {
      var downloadurl=url+link;
      window.open(downloadurl, '_blank');
    }
    function receiptexport(){
      var business_receipt_selectedid = $("#business_receipt_selectedid").val();
      var export_type='';
      var id = this.id;
      if(id=='receipt_pdf'){
        export_type=$("#receipt_pdf").val();  
      }
      if(id=='receipt_print'){
        export_type=$("#receipt_print").val(); 
      }
      // var obj=  {business_receipt_selectedid: business_receipt_selectedid,export_type:export_type};
      // var data = JSON.stringify(obj);
      jQuery.ajax({
        type: "POST",
        url:url+"BusinessSelectedPackageController/receiptExport",
        dataType: 'JSON',
        data:{business_receipt_selectedid: business_receipt_selectedid,export_type:export_type},
        success: function(result){
          if(result.success===true){
               $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
              $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
              if(result.download_type=='pdf'){
                DownloadExcelReceipt(result.data);
                return false;
              }else{
                
                  var printWindow = window.open('', '');
                  printWindow.document.write('<html><head><title>Receipt</title>');
                  printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/vendors/css/vendor.bundle.base.css">');
                  printWindow.document.write('<link rel="stylesheet"  href="'+url+'assets/css/vertical-layout-light/style.css">');
                  printWindow.document.write('<link rel="stylesheet" href="'+url+'assets/css/custom.css">');
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

    $("#receipt_sendmail").click(function(){
    var business_receipt_selectedid = $('#business_receipt_selectedid').val();
     var items =" ";
       $.ajax({
           type:"POST",
           url:url+"BusinessSelectedPackageController/receiptSendToMail",
        dataType: 'json',
        data:{business_receipt_selectedid:business_receipt_selectedid},
        dataType: 'json',
    beforeSend: function(){
        // Show image container
        $(".loader").show();
    },
     success: function(result){
          if(result.success===true){
            $('#receipt_sendmail_msg').hide().fadeIn('').delay(1000).fadeOut(2200);
            $( "#receipt_sendmail_msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
       }
      else if(result.success===false){
            $('#receipt_sendmail_msg').hide().fadeIn('').delay(1000).fadeOut(2200);
            $( "#receipt_sendmail_msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
          }
        },
      complete:function(){
        // Hide image container
        $(".loader").hide();
        },
        failure: function (result){
          $('#receipt_sendmail_msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
          $( "#receipt_sendmail_msg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
        } 
             
          });
       });
//====send Email Receipt end=== //



    }); // document ready