

view_sendlinkdata();  
 
        function view_sendlinkdata(){
            $.ajax({
                type  : 'GET',
                url   : url+"SendLinkController/listSendLinkdata",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#sendlinkdatatable')) {
         $('#sendlinkdatatable').DataTable().destroy();
         }  
         $('#sendlinkdatatable tbody').empty();

         var data=result.data; 
         var table = $('#sendlinkdatatable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'company_name',title:'Company Name'},
      {data: 'contact_personname',title: 'Person Name.'},
      {data: 'mobileno',title: 'Mobile No.'},
      {data: 'email',title:'Email'},
      {data: 'demo_link',title:'Demo link'},
      {data: 'user_name',title:'Employee Name'},
      {data: 'created_date',title:'Date & Time'},
    //   {data: null,
    //        'title' : 'Action',
    //        "sClass" : "center",
    //        mRender: function (data, type, row) {
    // return '<button class="btn btn-primary btn-sm paymenttypedata_edit" data-toggle="modal" id="paymenttypedata_edit" data-target="#EditpaymenttypeModal"><a data-paymenttypeid="'+data.id+'" data-paymenttypename="' +data.paymenttype_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;<button class="btn btn-danger btn-sm paymenttype_delete"><a data-paymenttypeid="'+data.id+'" data-paymenttypename="' +data.paymenttype_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
    //        } }

           ]

  

       });

table.rows.add(data).draw();
         
            }        
                }
            });
        }



var form = $("#add_sendlink_form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_sendlink_company_name :"required",
      add_sendlink_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_sendlink_email:{required: true,email: true },
      add_sendlink_demolinks:"required",
    }
});


$("#savesendlinkdata").click(function(){
    if(!$("#add_sendlink_form").valid())
   {
     return false;
   }
   
    var name= $("#add_sendlink_proprietor_name").val();   
    var numbers= $("#add_sendlink_mobileno").val();
  var formData = new FormData($("#add_sendlink_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"SendLinkController/saveSendLinkData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
     beforeSend: function(){
    $(".loader").show();
},

 success: function(result){
      
      if(result.success===true){
          $('#sendlinkdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#sendlinkdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $("#add_sendlink_form")[0].reset();
          setTimeout(function(){
               $('#AddsendlinkModal').modal("hide");
                    }, 1000);  
           view_sendlinkdata();
           var dataurl =result.data;
           window.open(dataurl,'_blank');
         
   }
  else if(result.success===false){
        $('#add_sendlink_form').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#add_sendlink_form" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
},   
    failure: function (result){

      $('#add_sendlink_form').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#add_sendlink_form" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});





