
view_loginreportdata();  
        function view_loginreportdata(){
            $.ajax({
                type  : 'GET',
                url   : url+"LoginReportController/listLoginReport",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#loginreporttable')) {
         $('#loginreporttable').DataTable().destroy();
         }  
         $('#loginreporttable tbody').empty();
         var data=result.data; 
         var table = $('#loginreporttable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'user_id',title:'User ID'},
      {data: 'user_name',title: 'User Name'},
      {data: 'designation',title:'Designation'},
      {data: 'mobileno',title: 'Mobile No.'},
      {data: 'last_login',title:'Last Login Time'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm userlogs_data"  id="userlogs_data" ><a data-userlogs_userid="'+data.id+'" data-userlogs_username="' +data.user_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp'
           } }
           ]

       });

table.rows.add(data).draw();
         
                }        
                }
            });
        }


   $('#loginreport_pdf').click(excelexport);
   $('#loginreport_print').click(excelexport);
   
      function DownloadExcelLoginReport(link) {
         var downloadurl=url+link;
        window.open(downloadurl, '_blank');
      }

      function excelexport(){
        var export_type='';
        var id = this.id;
        if(id=='loginreport_pdf'){
          export_type=$("#loginreport_pdf").val();  
        }
        if(id=='loginreport_print'){
          export_type=$("#loginreport_print").val(); 
        }
        
        jQuery.ajax({
          type: "POST",
          url:url+"LoginReportController/LoginReportExport",
          dataType: 'json',
          data:{export_type:export_type},
          success: function(result){
            if(result.success===true){
                 $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
                 $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
                if(result.download_type=='pdf'){
                  DownloadExcelLoginReport(result.data);
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


$(document).on('click', '.userlogs_data a', function(e){

 $(".userlogs-list-class").hide();
 $(".userlogs-induviallist-class").show();
 var id= $(this).attr("data-userlogs_userid");
 var username= $(this).attr("data-userlogs_username");
 $("#userlogs_username").html(username);
 // alert(id);

$.ajax({
    type: "GET",
    url:url+'LoginReportController/UserLoginReportById/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
        // alert(result.data);
        view_userlogsbyid(result.data);

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});


function view_userlogsbyid($datalist){

   if ( $.fn.DataTable.isDataTable('#userlogsreporttable')) {
         $('#userlogsreporttable').DataTable().destroy();
         }  
         $('#userlogsreporttable tbody').empty();
         var data=$datalist; 
         var table = $('#userlogsreporttable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'login_datetime',title:'Login Time'},
      {data: 'logout_datetime',title:'Logout Time'},
      {data: 'duration',title:'Duration Time'},
           ]

       });

table.rows.add(data).draw();
         
               
          
        }

