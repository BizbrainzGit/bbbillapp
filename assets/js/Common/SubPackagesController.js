

$(document).ready(function(){

view_subpackages(); 
        function view_subpackages(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/SubPackagesController/listSubPackages",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#subpackagestable')) {
				 $('#subpackagestable').DataTable().destroy();
				 }	
				 $('#subpackagestable tbody').empty();

				 var data=result.data; 
				 var table = $('#subpackagestable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
		  {data: 'sublist_name',title:'SubPackage Name'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm subpackagedata_edit" data-toggle="modal" id="subpackagedata_edit" data-target="#EditSubpackageModal"><a data-subpackageid="'+data.id+'" data-subpackagename="' +data.sublist_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp'
    //;<button class="btn btn-danger btn-sm subpackage_delete"><a data-subpackageid="'+data.id+'" data-subpackagename="' +data.sublist_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
		
	

			 });

table.rows.add(data).draw();
         
  }        
                }
            });
        }




/* ======  campaign  Table  edit  start ===== */

 $(document).on('click', '.subpackagedata_edit a', function(e){
 
 var id= $(this).attr("data-subpackageid");


 $.ajax({
    type: "GET",
    url:url+'admin/SubPackagesController/editSubPackageByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_subpackage #edit_subpackage_id').val(result.data[0].id);
        $('#edit_subpackage #edit_subpackage_name').val(result.data[0].sublist_name); 
       
         

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

$("#edit_subpackage").validate({
     
     rules:{
        edit_subpackage_name :"required"
        
     }
 });

 $("#updatesubpackage").click(function(){

	  if(!$("#edit_subpackage").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_subpackage")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/SubPackagesController/updateSubPackageByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#subpackage-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#subpackage-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_subpackage")[0].reset();
            setTimeout(function(){
               $('#EditSubpackageModal').modal('hide');
                }, 5000); 

            view_subpackages();   
			

   }
	else if(result.success===false){
				$('#subpackage-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#subpackage-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#subpackage-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#subpackage-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  campaign  Table  update  end ===== */


/* ====== add  campaign  details  start ===== */
$("#add_subpackage").validate({
     
     rules:{
        add_subpackage_name :"required"
        
     }
 });

$("#addsubpackage").click(function() {
	
	  if(!$("#add_subpackage").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_subpackage")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/SubPackagesController/saveSubPackage",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#subpackage-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#subpackage-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_subpackage')[0].reset();
				setTimeout(function(){
               $('#AddSubpackageModal').modal("hide");
                    }, 5000);	

				view_subpackages();
				 
			}
			else{
				$('#subpackage-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#subpackage-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#subpackage-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#subpackage-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  campaign  details  end ===== */


$(document).on('click', '.subpackage_delete a', function(e){
 
 var id= $(this).attr("data-subpackageid");
 var name=$(this).attr("data-subpackagename");

    $.ajax({
    type: "GET",
    url:url+'admin/SubPackagesController/deleteSubPackageById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 

    view_subpackages();  
   
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

