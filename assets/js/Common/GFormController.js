

view_gformdata();  
 
        function view_gformdata(){
            $.ajax({
                type  : 'GET',
                url   : url+"GFormController/listGFormdata",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#gformdatatable')) {
         $('#gformdatatable').DataTable().destroy();
         }  
         $('#gformdatatable tbody').empty();

         var data=result.data; 
         var table = $('#gformdatatable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'company_name',title:'Company Name'},
      {data: 'contact_personname',title: 'Person Name.'},
      {data: 'mobileno',title: 'Mobile No.'},
      {data: 'cityname',title:'City Name'},
      {data: 'state_name',title:'State Name'},
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



var form = $("#add_gform_form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_gform_company_name :"required",
      add_gform_proprietor_name :"required",
      // add_gform_landmark:"required", 
      // add_gform_area:"required",
      add_gform_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_gform_pincode:{number:true,minlength:6, maxlength:6},
      add_gform_city:"required",
      add_gform_state:"required",
      add_gform_email:{email: true },
      // add_gform_workinghours:"required",
      // add_gform_photo:"required",
      

    }
});


$("#savegformdata").click(function(){
    if(!$("#add_gform_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#add_gform_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"GFormController/saveGFormData",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
      
      if(result.success===true){
      
        $('#gformdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#gformdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
          $("#add_gform_form")[0].reset();
         setTimeout(function(){
               $('#AddgformModal').modal("hide");
                    }, 5000);   
        
           view_gformdata();

   }
  else if(result.success===false){
        $('#add_gform_form').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#add_gform_form" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#add_gform_form').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#add_gform_form" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});





