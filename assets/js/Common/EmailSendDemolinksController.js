

SendemailviewListData();   
function SendemailviewListData(){
    $.ajax({
    type : 'GET',
    url : url+"EmailSendDemolinksController/SendmaildemolinksList",
    async : true,
    dataType : 'json',
    success : function(result){
      if(result.success===true){
        SendEmailDemoViewList(result.data)
      } 

    }
    });
}

 function SendEmailDemoViewList(projectlist){

   if ( $.fn.DataTable.isDataTable('#sendemaildemolisttable')) {
         $('#sendemaildemolisttable').DataTable().destroy();
         }  
         $('#sendemaildemolisttable tbody').empty();
          var data=projectlist;
         var table = $('#sendemaildemolisttable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No'},
      {data: 'company_name',title:'Business Name'},
      {data: 'to_email',title:'Business Email'}, 
      {data: 'user_name',title:'User Name'}, 
      {data: 'designation',title:'User Designation'},
      {data: 'subject',title: 'Email Subject'},
      {data: 'sending_datetime',title: 'Email Sending Date'},
      
           ] 
       });
 
table.rows.add(data).draw();
 
 }


   $('#sendemaildemolinks_pdf').click(excelexport);
   $('#sendemaildemolinks_print').click(excelexport);
   
      function DownloadExcelSendEmail(link) {
         var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function excelexport(){
        var export_type='';
        var id = this.id;
        if(id=='sendemaildemolinks_pdf'){
          export_type=$("#sendemaildemolinks_pdf").val();  
        }
        if(id=='sendemaildemolinks_print'){
          export_type=$("#sendemaildemolinks_print").val(); 
        }
        
        jQuery.ajax({
          type: "POST",
          url:url+"EmailSendDemolinksController/SendmaildemolinksExport",
          dataType: 'json',
          data:{export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelSendEmail(result.data);
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
