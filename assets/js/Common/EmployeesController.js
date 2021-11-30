
employeesView();
 function employeesView(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/EmployeesController/SearchEmployeeList",
                async : true,
                dataType : 'json',
                success : function(result){
                 if(result.success===true){
                  employeesViewList(result.data);
                  }        
                }
            });
        }

$('[data-toggle="modal"]').tooltip();

function employeesViewList(employeeslistdata){
  if ( $.fn.DataTable.isDataTable('#employeestable')) {
         $('#employeestable').DataTable().destroy();
         }  
         $('#employeestable tbody').empty();

         var data=employeeslistdata; 
         var table = $('#employeestable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'Sno'},
      {data: 'name',title:'Name'},
      {data: 'email',title: 'Email Id'},
      {data: 'username',title:'Employe Id'},
      {data: 'designation',title: 'Designation'},
      {data: 'cityname',title: 'City Name'},
      {data: 'state_name',title: 'State Name'},
      {data: 'mobileno',title: 'Mobile No'},
      {data: 'active',title: 'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-info btn-md employees_status_edit" data-toggle="modal" id="employees_status_edit" data-target="#EditEmployeesstatusModal" title="Employe Status"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-pencil-box"></i> </a></button>&nbsp;<button class="btn btn-primary btn-md editemployees" id="employeesdata_edit" title="Employe Edit"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;'
    //<button class="btn btn-danger btn-md employees_delete" title="Employe Delete"><a data-employeesid="'+data.id+'" data-employeesname="' +data.name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }],

           columnDefs: [{
         targets: 8,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else if(data == '0' ){
             
             data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }          
      }
          return data;
       }
     }]

  

       });

table.rows.add(data).draw();

if(data.length>0){
    $('#employees_excel').show();
    $('#employees_pdf').show();
    $('#employees_print').show();
  }else{
    $('#employees_excel').hide();
    $('#employees_pdf').hide();
    $('#employees_print').hide();
  }
}



$('#employees_excel').click(excelexport);
$('#employees_pdf').click(excelexport);
$('#employees_print').click(excelexport);
function EmployeesDownloadExcel(link) {
   var downloadurl=url+link;
  // alert(downloadurl);
  window.open(downloadurl,'_blank');
}
function excelexport(){
  var export_type='';
  var id = this.id;
  
  if(id=='employees_excel'){
    export_type=$("#employees_excel").val();
    
  }
  if(id=='employees_pdf'){
    export_type=$("#employees_pdf").val();  
  }
  if(id=='employees_print'){
    export_type=$("#employees_print").val();  
  }
  var obj=  {export_type:export_type};
  var data = JSON.stringify(obj);
  
  jQuery.ajax({
    type: "POST",
    url:url+"admin/EmployeesController/EmployeesExport",
    dataType: 'json',
    data:data,
    success: function(result){
      if(result.success===true){
           $('#employeesexport_msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
           $("#employeesexport_msg").html("<div class='alert alert-success'>"+result.message+"</div>");
          if(result.download_type=='excel' || result.download_type=='pdf'){
            EmployeesDownloadExcel(result.data);
            return false;
          }else{
            
              var printWindow = window.open('', '', 'height=400,width=800');
              printWindow.document.write('<html><head><title>Employees List</title>');
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
          $('#employeesexport_msg').html('<div class="alert alert-failure">No Data !...</div>');
        },1000);
        }
    },
    failure: function (result){
      setTimeout(function(){
        $('#employeesexport_msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
      },1000);
      
    }
  });
}


$("#search_employee").validate({
     
     rules:{
        // search_employee_name :"required",
        // search_employee_city :"required",
      
     }
 });

$("#searchemployee").click(function() {
  
    if(!$("#search_employee").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_employee")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/EmployeesController/SearchEmployeeList",
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
         employeesViewList(result.data);
         // window.setTimeout(function(){location.reload()},3000);
            
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




$("#showaddemployees").click(function(){
 $(".listemployees-class").hide();
 $(".addemployees-class").show();
});

$(document).on('click', '.editemployees a', function(e){

 $(".listemployees-class").hide();
 $(".addemployees-class").hide();
 $(".editemployees-class").show();
 var id= $(this).attr("data-employeesid");

$.ajax({
    type: "GET",
    url:url+'admin/EmployeesController/editEmployeesByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 

     
        $('#edit_employeesdata #edit_employees_addid').val(result.data[0].address_id);
        $('#edit_employeesdata #edit_employees_userid').val(result.data[0].user_id);
        $('#edit_employeesdata #edit_employees_id').val(result.data[0].id);

        $('#edit_employeesdata #edit_employees_hno').val(result.data[0].house_no);
        $('#edit_employeesdata #edit_employees_street').val(result.data[0].street);
        $('#edit_employeesdata #edit_employees_subarea').val(result.data[0].sub_area);
        $('#edit_employeesdata #edit_employees_area').val(result.data[0].area);
        $('#edit_employeesdata #edit_employees_landmark').val(result.data[0].landmark);
        $('#edit_employeesdata #edit_employees_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_employeesdata #edit_employees_state').val(result.data[0].state_id).prop("selected", true);
        if (result.data[0].pincode==0) {
          var pincode="";
          }else{
            var pincode=result.data[0].pincode
          }
        $('#edit_employeesdata #edit_employees_pincode').val(pincode);
         
         $('#edit_employeesdata #edit_employees_fname').val(result.data[0].first_name);
         $('#edit_employeesdata #edit_employees_lname').val(result.data[0].last_name);
         $('#edit_employeesdata #edit_employees_mobileno').val(result.data[0].mobileno);
         $('#edit_employeesdata #edit_employees_aadharno').val(result.data[0].aadharno);
         $('#edit_employeesdata #edit_employees_employe_id').val(result.data[0].username);
         $('#edit_employeesdata #edit_employees_role').val(result.data[0].role_id).prop("selected", true);
         $('#edit_employeesdata #edit_employees_status').val(result.data[0].active).prop("selected", true);


    $("#employeesimage").html('<img src="'+url+result.data[0].profile_pic_path+ '" width="200px"  height="100px" alt=" photo" />');

         }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }

});



});

var employeeseditform = $("#edit_employeesdata");
employeeseditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_employees_city :"required",
      edit_employees_state :"required",
      edit_employees_cname :"required",
      edit_employees_street:"required", 
      edit_employees_area:"required",
      edit_employees_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      edit_employees_aadharno:{required: true,number:true,minlength:12, maxlength:12},
      edit_employees_condition:"required",
      edit_employees_email:{required: true,email: true },
      edit_employees_lname:"required",
      edit_employees_fname:"required",
      edit_employees_role:"required",
      // edit_employees_status:"required",
      edit_employees_employe_id:"required",
      edit_employees_pincode:{number:true,minlength:6, maxlength:6}
    }
});

employeeseditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        employeeseditform.validate().settings.ignore = ":disabled,:hidden";
        return employeeseditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        employeeseditform.validate().settings.ignore = ":disabled";
        return employeeseditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_employeesdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/EmployeesController/updateEmployeesData",
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

        $('#employeesdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#employeesdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_employeesdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000);
       
      }
      else{
        $('#employeesdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#employeesdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#employeesdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#employeesdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.employees_delete a', function(e){
   var id= $(this).attr("data-employeesid");
   var name=$(this).attr("data-employeesname");
    
    $.ajax({
    type: "GET",
    url:url+'admin/EmployeesController/deleteEmployeesById/'+id,
    dataType: 'json',
    
    success:function(result){
      if(result.success==true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    window.setTimeout(function(){location.reload()},3000);
   
      }else if(result.success==false){
           
           alert('request failed', 'error');
      }

    },
 
  fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

// }else{
//     swal("Cancelled", "Your imaginary file is safe :)", "error");
//   }

        
//     });

    

    });
 



/* ====== Employees delete end ===== */


var employeesaddform = $("#add_employeesdata");
employeesaddform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_employees_city :"required",
      add_employees_state :"required",
      add_employees_cname :"required",
      add_employees_street:"required", 
      add_employees_area:"required",
      add_employees_mobileno:{required: true,number:true,minlength:10, maxlength:10},
      add_employees_aadharno:{required: true,number:true,minlength:12, maxlength:12},
      add_employees_condition:"required",
      add_employees_email:{required: true,email: true },
      add_employees_password:"required",
      add_employees_cpassword: {required: true, equalTo: "#add_employees_password"},
      add_employees_lname:"required",
      add_employees_fname:"required",
      add_employees_role:"required",
      add_employees_employe_id:"required",
      add_employees_pincode:{number:true,minlength:6, maxlength:6}

    }
});
employeesaddform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        employeesaddform.validate().settings.ignore = ":disabled,:hidden";
        return employeesaddform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        employeesaddform.validate().settings.ignore = ":disabled";
        return employeesaddform.valid();
    },
    onFinished: function (event, currentIndex)
    {
         
    var formData = new FormData($("#add_employeesdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/EmployeesController/saveEmployeesData",
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

        $('#employeesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $( "#employeesdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_employeesdata')[0].reset();
      
      }
      else{
        $('#employeesdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#employeesdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    
    failure: function (result){

      $('#employeesdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#employeesdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});




$(document).on('click', '.employees_status_edit a', function(e){
 
 var id= $(this).attr("data-employeesid");

 $.ajax({
    type: "GET",
    url:url+'admin/EmployeesController/editEmployeesStatusByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
        
        $('#employees_status_change_form #employees_status_id').val(id);
        // alert(result.data[0].active);
        if (result.data[0].active==1) {
          // alert(result.data[0].active); activestatusmsg
          var data="Are you sure you want to Deactivate The Employee?";
          $('#activestatusmsg').html(data);
           $('#employees_status_change_form #employees_status_change').val(0);
        }else   if (result.data[0].active==0) {
          var data="Are you sure you want to Activate The Employee?";
          $('#activestatusmsg').html(data);
           $('#employees_status_change_form #employees_status_change').val(1);
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

$("#employeesupdatestatus").click(function(){
  // alert("hhh");

    if(!$("#employees_status_change_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#employees_status_change_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/EmployeesController/updateEmployeesStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
      
      if(result.success===true){
      
        $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#employees_status_change_form")[0].reset();
            setTimeout(function(){
               $('#EditEmployeesstatusModal').modal('hide');
                }, 5000);


       employeesView();

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








