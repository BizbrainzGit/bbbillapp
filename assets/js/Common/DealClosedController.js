
BusinessDealclosedList();   
function BusinessDealclosedList(){
    $.ajax({
    type : 'GET',
    url : url+"DealClosedController/SearchDealClosedlist",
    async : true,
    dataType : 'json',
    success : function(result){
      if(result.success==true){
         
          var role=result.role; 
        BusinessDealclosedListData(result.data,role)
      } 

    }
    });
}


function BusinessDealclosedListData(businesslist ,role){

   if ( $.fn.DataTable.isDataTable('#dealclosedtable')) {
         $('#dealclosedtable').DataTable().destroy();
         }  

         $('#dealclosedtable tbody').empty();
          var data=businesslist;
         var table = $('#dealclosedtable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'company_name_id',title:'Company Name & Id'},
      {data: 'person_name_mobile',title: 'Person Name & Mobile No'},
      {data: 'cityname',title: 'City Name'}, 
      {data: 'gst_number',title: 'GST Name'},
      {data: 'package_name',title: 'Package Name'},
      // {data: 'campaign_name',title:'Compain Name'},
      {data: 'domain_names',title:'Domain Name'},
      {data: 'gstgrand_total_amount',title:'Package Grand <br> Total Amount'},
      {data: 'payment_created_on',title:'Package Date'}, 
      {data: 'transaction_amount',title:'Transaction Amount'}, 
      {data: 'dealclosed_created_on',title:'Deal Closed Date'},  
      {data: 'receipt_no',title:'Invoice No'},
      {data: 'package_created_name',title:'Package Given By'},
      {data: 'business_created_name',title:'Business Created By'},
      {data: null,
          'title' : 'Action',
          "sClass" : "center",
          mRender: function (data, type, row) { 

            if(role=="Admin"){
               return '<button class="btn btn-primary btn-sm business_dealclosed_invoice"  id="business_dealclosed_invoice" title="Invoice"><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;&nbsp; <button class="btn btn-warning btn-sm business_edit_invoiceno" data-toggle="modal"  data-target="#EditInvoiceNoModal"  id="business_edit_invoiceno" title="Edite Invoice No"><a data-selected_invoicenoid="'+data.id+'" data-selecte_invoicenoname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;' 
             }else  if(role=="Accountant"){
               return '<button class="btn btn-primary btn-sm business_dealclosed_invoice"  id="business_dealclosed_invoice" title="Invoice"><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;&nbsp;<button class="btn btn-danger btn-sm business_dealclosed_delete"  id="business_dealclosed_delete" title="Delete"><a data-selected_deleteid="'+data.id+'" data-selecte_deletedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-delete"></i></a></button>&nbsp; <button class="btn btn-warning btn-sm business_edit_invoiceno" data-toggle="modal"  data-target="#EditInvoiceNoModal"  id="business_edit_invoiceno" title="Edite Invoice No"><a data-selected_invoicenoid="'+data.id+'" data-selecte_invoicenoname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;' 
             }else{
              return '<button class="btn btn-primary btn-sm business_dealclosed_invoice"  id="business_dealclosed_invoice" title="Invoice"><a data-selectedid="'+data.id+'" data-selectedname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-file-document"></i></a></button>&nbsp;&nbsp;'

             }
           

        } }
      ]
       });
table.rows.add(data).draw();
 
 if(data.length>0){
    $('#dealcolse_excel').show();
    $('#dealcolse_pdf').show();
    $('#dealcolse_print').show();
  }

 }

// Search Business DealClosed Start //


$("#search_businessdealclosed").validate({
     
     rules:{
        // search_business_cname :"required",
        // search_business_city :"required",
      
     }
 });

$("#searchbusinessdealclosed").click(function() {
    if(!$("#search_businessdealclosed").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_businessdealclosed")[0]);
     $.ajax({
    type:"POST",
    url:url+"DealClosedController/SearchDealClosedlist",
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
          var role=result.role; 
        BusinessDealclosedListData(result.data,role)
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
// ==== business Dealclosed search ends == //


$('#dealcolse_excel').click(dealcolse_excelexport);
$('#dealcolse_pdf').click(dealcolse_excelexport);
$('#dealcolse_print').click(dealcolse_excelexport);
function DownloadExcel(link) {
   var downloadurl=url+link;
  // alert(downloadurl);
  window.open(downloadurl,'_blank');
}
function dealcolse_excelexport(){
  var export_type='';
  var id = this.id;
  if(id=='dealcolse_excel'){
    export_type=$("#dealcolse_excel").val();
    
  }
  if(id=='dealcolse_pdf'){
    export_type=$("#dealcolse_pdf").val();  
  }
  if(id=='dealcolse_print'){
    export_type=$("#dealcolse_print").val();  
  }
  var obj=  {export_type:export_type};
  var data = JSON.stringify(obj);
  
  jQuery.ajax({
    type: "POST",
    url:url+"DealClosedController/dealclosedListExport",
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
              printWindow.document.write('<html><head><title>Business Dealclosed List </title>');
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

// Dealclosed Invoice Start //

$(document).on('click', '.business_dealclosed_invoice a', function(e){
 var id= $(this).attr("data-selectedid");
 var name=$(this).attr("data-selectedname");
 $(".business_dealclosed-class").hide();
$.ajax({
    type: "GET",
    url:url+'DealClosedController/BusinessInvoice/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
          $(".business_dealclosed_invoice-class").show(); 
        $('#export_invoice #business_invoice_selectedid').val(result.data[0].business_package_id); 
        $('#business_dealclosed_invoice_id').html(result.data[0].receipt_no);
        $('#business_order_id').html(result.data[0].order_id);
        $('#business_dealclosed_invoice_company_name').html(result.data[0].company_name);
        $('#business_dealclosed_invoice_address').html(result.data[0].address);
        $('#business_dealclosed_invoice_gstno').html(result.data[0].gst_number);

        $('#business_dealclosed_invoice_raisedate').html(result.invoicedata[0].created_on);
        
        $('#business_dealclosed_invoice_duedate').html(result.data[0].duedate);

        // $('#business_dealclosed_invoice_subtotal').html(result.data[0].total_amount);
        // $('#business_dealclosed_invoice_dicount').html(result.data[0].discount_amount);
        // $('#business_dealclosed_invoice_total').html(result.data[0].grand_total_amount);
      
         $('#business_dealclosed_invoice_subtotal').html(result.data[0].total_amount);
        $('#business_dealclosed_invoice_dicount').html(result.data[0].discount_amount);
        $('#business_dealclosed_invoice_packagetotal').html(result.data[0].grand_total_amount);
        
        if(result.data[0].domain_amount!=null && result.data[0].domain_amount!=0){
          var domain_amount =Number(result.data[0].domain_amount);
         }else{
            var domain_amount=0;
         }
        $('#business_dealclosed_invoice_domainamount').html(domain_amount);
         if(domain_amount==0){
              var package_amount1= Number(result.data[0].grand_total_amount);
         }else{
             var package_amount1=  Number(Number(result.data[0].grand_total_amount)+Number(domain_amount));
         }
        $('#business_dealclosed_invoice_total').html(package_amount1);


        if(result.data[0].cgst_amount!=null && result.data[0].sgst_amount!=null){
            $('#business_dealclosed_invoice_cgst').html(result.data[0].cgst_amount);
            $('#business_dealclosed_invoice_sgst').html(result.data[0].sgst_amount);
         
         }else{
             
              $('#business_dealclosed_invoice_cgst').html(0);
              $('#business_dealclosed_invoice_sgst').html(0);

         }
          if( result.data[0].igst_amount!=null){
          $('#business_dealclosed_invoice_igst').html(result.data[0].igst_amount);
         }else{
            $('#business_dealclosed_invoice_igst').html(0);
         }

            if( result.data[0].tds_amount!=null){
          $('#business_dealclosed_invoice_tds').html(result.data[0].tds_amount);
         }else{
            $('#business_dealclosed_invoice_tds').html(0);
         }
       
         if(result.data[0].uppersale_amount==null){
           var invoice_upsale_packageamount=0;
         }else{
             var invoice_upsale_packageamount=Number(result.data[0].uppersale_amount);
         }
         
        $('#business_dealclosed_invoice_grandtotal').html(result.data[0].gstgrand_total_amount);
        for(var i=0; i<result.campaigndata.length;i++){
           $("#myTable > tbody").append('<tr class="text-right"><td class="text-left"></td><td class="text-left"> '+result.campaigndata[i][0].campaign_name+'</td><td>1</td><td>'+result.campaigndata[i][0].campaign_amount+'</td><td>'+result.campaigndata[i][0].campaign_amount+'</td></tr>');
                 }             
        for(var j=0; j<result.packagesdata.length;j++){
          var package_amount= Number(result.packagesdata[j][0].package_amount);
          var invoice_package_amount=Number(package_amount+invoice_upsale_packageamount); 
           $("#myTable > tbody").append('<tr class="text-right"><td class="text-left"></td><td class="text-left"> '+result.packagesdata[j][0].package_name+'</td><td>1</td><td>'+invoice_package_amount+'</td><td>'+invoice_package_amount+'</td></tr>');
                   } 
      }else{
            alert('Invoice Not Generated Please Dealclose Business');
            $(".lisofbusiness-class").show();
         }
    },
   
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});
});


//====  Invoice Start=== //

   $('#invoice_pdf').click(excelexport);
   $('#invoice_print').click(excelexport);
      function DownloadExcelInvoice(link) {
        var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }
      function excelexport(){
        var business_invoice_selectedid = $("#business_invoice_selectedid").val();
        var export_type='';
        var id = this.id;
        if(id=='invoice_pdf'){
          export_type=$("#invoice_pdf").val();  
        }
        if(id=='invoice_print'){
          export_type=$("#invoice_print").val(); 
        }
        // var obj=  {business_invoice_selectedid: business_invoice_selectedid,export_type:export_type};
        // var data = JSON.stringify(obj);
        
        jQuery.ajax({
          type: "POST",
          url:url+"DealClosedController/invoiceExport",
          dataType: 'json',
          data:{business_invoice_selectedid: business_invoice_selectedid,export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelInvoice(result.data);
                  return false;
                }else{
                  
                    var printWindow = window.open('', '');
                    printWindow.document.write('<html><head><title>Invoice</title>');
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

      $("#invoice_sendmail").click(function(){
      var business_invoice_selectedid = $('#business_invoice_selectedid').val();
       var items =" ";
         $.ajax({
             type:"POST",
             url:url+"DealClosedController/invoiceSendToMail",
          dataType: 'json',
          data:{business_invoice_selectedid:business_invoice_selectedid},
          dataType: 'json',
      beforeSend: function(){
          // Show image container
          $(".loader").show();
      },
       success: function(result){
            
            if(result.success===true){
              $('#invoice_sendmail_msg').hide().fadeIn('').delay(1000).fadeOut(2200);
              $( "#invoice_sendmail_msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
         }
        else if(result.success===false){
              $('#invoice_sendmail_msg').hide().fadeIn('').delay(1000).fadeOut(2200);
              $( "#invoice_sendmail_msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
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

//====  Invoice end=== //


// Dealclosed Invoice End //

$(document).on('click', '.business_dealclosed_delete a', function(e){
 var id= $(this).attr("data-selected_deleteid");
 var name=$(this).attr("data-selected_deletename");
    $.ajax({
    type: "GET",
    url:url+'DealClosedController/deleteDealClosedById/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success");  
    window.setTimeout(function(){location.reload()},3000)
      }else{
            alert('request failed', 'error');
      }
    },
 
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

    });

// Edit Invoice No End //

$(document).on('click', '.business_edit_invoiceno a', function(e){
 var id= $(this).attr("data-selected_invoicenoid");
 var name=$(this).attr("data-selected_invoicenoname");
 // alert(id);
    $.ajax({
    type: "GET",
    url:url+'DealClosedController/editInvoiceNoById/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 

         $('#edit_invoiceno_form #edit_invoiceno_selectedid').val(result.data[0].business_package_id); 
         $('#edit_invoiceno_form #edit_invoiceno_receipt_no').val(result.data[0].receipt_no);

      }else{
            alert('request failed', 'error');
      }
    },
 
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

    });



$("#updateinvoiceno").click(function(){
    if(!$("#edit_invoiceno_form").valid())
   {
     return false;
   }
  var formData = new FormData($("#edit_invoiceno_form")[0] );
   $.ajax({
    type:"POST",
    url:url+"DealClosedController/updateInvoiceByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
 success: function(result){
      if(result.success===true){
          $('#invoiceno_editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#invoiceno_editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
           $("#edit_invoiceno_form")[0].reset();
            setTimeout(function(){
               $('#EditInvoiceNoModal').modal('hide');
                }, 5000);

       window.setTimeout(function(){location.reload()},3000);

            }else if(result.success===false){
        $('#invoiceno_editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#invoiceno_editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#invoiceno_editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#invoiceno_editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});



// $(document).on('click', '.project_status_edit a', function(e){
//  var id= $(this).attr("data-businessid");
//  $.ajax({
//     type: "GET",
//     url:url+'DealClosedController/editProjectStatusByid/'+id,
//     dataType: 'json',
//   success:function(result){
//       if(result.success===true)
//       { 
//        $('#project_change_status_form #project_change_status_id').val(id);
//        $('#project_change_status_form #project_change_status').val(result.data[0].project_status_id).prop("selected", true);
    
//        }else{
//             alert('request failed', 'error');
//       }
//     },
//  fail:function(result){
      
//       alert('Information request failed: ' + textStatus, 'error');
//     }
//   });

// });


// $("#projectupdatestatus").click(function(){
//     if(!$("#project_change_status_form").valid())
//    {
//      return false;
//    }
//   var formData = new FormData($("#project_change_status_form")[0] );
//    $.ajax({
//        type:"POST",
//        url:url+"DealClosedController/ProjectupdateStatusByid",
//     dataType: 'json',
//     data:formData,
//     contentType: false, 
//     cache: false,      
//     processData:false,
//  success: function(result){
//       if(result.success===true){
//         $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
//           $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
//            $("#change_status_form")[0].reset();
//             setTimeout(function(){
//                $('#projectEditstatusModal').modal('hide');
//                 }, 5000);

//        window.setTimeout(function(){location.reload()},3000);

//             }else if(result.success===false){
//         $('#citymapping-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
//         $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
//       }
//     },
    
//     failure: function (result){

//       $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
//       $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
//     } 
         
//       });


// });