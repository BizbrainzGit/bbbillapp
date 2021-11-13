

// $(function(){
	
// 		 var items="";
// 		 $.getJSON(url+"admin/PackagesController/listPackages", function(campaignList){
// 		  $.each(campaignList,function(index,itemlist)
// 		 {
// 		 if ( $.fn.DataTable.isDataTable('#packagestable')) {
// 				 $('#packagestable').DataTable().destroy();
// 				 }	
// 				 $('#packagestable tbody').empty();

// 				 var data=itemlist; 
// 				 var table = $('#packagestable').DataTable({
				
// 				 paging: true,
// 				 searching: true,
// 				 columns: [
// 		  {data: 'id',title: 'S No.'},
// 		  {data: 'package_name',title:'Package Name'},
// 		  {data: 'package_amount',title:'Amount'},
// 		  {data: null,
// 					 'title' : 'Action',
// 					 "sClass" : "center",
// 					 mRender: function (data, type, row) {
//     return '<button class="btn btn-primary btn-sm packagedata_edit" data-toggle="modal" id="packagedata_edit" data-target="#EditpackageModal"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;<button class="btn btn-danger btn-sm package_delete"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
// 					 } }]

	

// 			 });

// table.rows.add(data).draw();

 
		 
// 		  });	
// });	
//  });



$(document).ready(function(){

view_packages();   
//function show all employee

        function view_packages(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/PackagesController/listPackages",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#packagestable')) {
				 $('#packagestable').DataTable().destroy();
				 }	
				 $('#packagestable tbody').empty();

				 var data=result.data; 
				 var table = $('#packagestable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
		  {data: 'package_name',title:'Package Name'},
		  {data: 'package_amount',title:'Amount'},
		  {data: 'package_status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm packagedata_edit" data-toggle="modal" id="packagedata_edit" data-target="#EditpackageModal"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'

    // <button class="btn btn-danger btn-sm package_delete"><a data-packageid="'+data.id+'" data-packagename="' +data.package_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
					  columnDefs: [{
		  targets: 3,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			 if(data == '1' ){
             data = '<label class="badge badge-success">Active</label>' 
           } else 
           if(data == '3' ){
             data = '<label class="badge badge-warning"> Show In Front Page</label>' 
           }else
            if(data == '2' ){
             data = '<label class="badge badge-danger">In-Active</label>' 
          } 
          	 
          }
        return data;
       }
		 }]		

	

			 });

table.rows.add(data).draw();
         
  }        
                }
            });
        }




/* ======  campaign  Table  edit  start ===== */

 $(document).on('click', '.packagedata_edit a', function(e){
 
 var id= $(this).attr("data-packageid");


 $.ajax({
    type: "GET",
    url:url+'admin/PackagesController/editPackageByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_packagename_head').html(result.data[0].package_name);  
        $('#edit_package #edit_package_id').val(result.data[0].id);
        $('#edit_package #edit_package_name').val(result.data[0].package_name);
        $('#edit_package #edit_package_amount').val(result.data[0].package_amount);
        $('#edit_package #edit_package_status').val(result.data[0].package_status).prop("selected",true);
          var values = result.data[0].sub_package_id;
		var selectedValues=new Array();
		$.each(values.split(","), function(i,e){
			selectedValues[i]=e;
		   });

		$("#edit_package_campaign").select2().val(selectedValues).trigger('change');

        }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  campaign  Table  edit  end ===== */


/* ======  campaign  Table  update  start ===== */

$("#edit_package").validate({
     
     rules:{
        edit_package_name :"required",
        edit_package_amount:"required",
        edit_package_campaign:"required",
        edit_package_status:"required"
     }
 });

 $("#updatepackage").click(function(){

	  if(!$("#edit_package").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_package")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/PackagesController/updatePackageByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#package-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#package-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_package")[0].reset();
            setTimeout(function(){
               $('#EditpackageModal').modal('hide');
                }, 5000); 

            view_packages();   
			

   }
	else if(result.success===false){
				$('#package-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#package-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#package-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#package-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  campaign  Table  update  end ===== */


/* ====== add  campaign  details  start ===== */
$("#add_package").validate({
     
     rules:{
        add_package_name :"required",
        add_package_amount :"required",
        add_package_campaign:"required",
        add_package_status:"required"
     }
 });

$("#addpackage").click(function() {
	
	  if(!$("#add_package").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_package")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/PackagesController/savePackage",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#package-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#package-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_package')[0].reset();
				setTimeout(function(){
               $('#AddpackageModal').modal("hide");
                    }, 5000);	

				view_packages();   
				 
			}
			else{
				$('#package-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#package-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#package-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#package-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  campaign  details  end ===== */


$(document).on('click', '.package_delete a', function(e){
 
 var id= $(this).attr("data-packageid");
 var name=$(this).attr("data-packagename");

    $.ajax({
    type: "GET",
    url:url+'admin/PackagesController/deletePackageById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 

    view_packages();   
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});


/* ====== Medicalshop delete end ===== */



});

