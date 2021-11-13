$(document).ready(function(){

viewServices();   

        function viewServices(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/ServiceController/ServiceList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ServicesList(result.data);
                                 }        
                }
            });
        }

function ServicesList(serviceslistdata){
	 if ( $.fn.DataTable.isDataTable('#servicetable')) {
				 $('#servicetable').DataTable().destroy();
				 }	
				 $('#servicetable tbody').empty();
				 var data=serviceslistdata; 
				 var table = $('#servicetable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'service_title',title: 'Titele'},
		  {data: 'service_content',title: 'Content'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_service" data-toggle="modal" data-target="#EditServiceModal"><a data-serviceid="'+data.id+'" data-servicename="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md service_delete"><a data-serviceid="'+data.id+'" data-servicename="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
					 columnDefs: [{
		  targets: 3,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
			  }	else{
				  data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }			 
          }
        return data;
       }
		 }]
			 });

table.rows.add(data).draw();

         
}




/* ====== add start ===== */
$("#add_service").validate({
     
     rules:{
     	 // add_service_image:"required",
     	 add_service_url:"required",
     	 add_service_title :"required",
         add_service_content  :"required",
         add_service_status :"required"
      }
 });

$("#addservice").click(function() {
	  if(!$("#add_service").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_service")[0] );
     $.ajax({
      type:"POST",
      url:url+"templateadmin/ServiceController/saveService",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#service-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#service-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_service')[0].reset();
			 setTimeout(function(){
               $('#AddserviceModal').modal("hide");
                    }, 4000);
             viewServices();          		
				
			}
			else{
				 $('#service-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#service-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#service-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#service-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_service a', function(e){
    var id = $(this).attr('data-serviceid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/ServiceController/serviceEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_service #edit_service_id').val(id);
               $('#edit_service #edit_service_title').val(result.data[0].service_title);
               $('#edit_service #edit_service_content').val(result.data[0].service_content); 
               $('#edit_service #edit_service_url').val(result.data[0].service_url);
               $('#edit_service #edit_service_imagealt').val(result.data[0].image_alt);
				if(result.data[0].status=='1'){
					$('#edit_service  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_service  #edit_inactive').prop('checked', true);
				}
               $("#serviceimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');

              } 
		      else {
		        alert('request failed', 'error');
		      }

	        },
	failure: function (result){

		 alert('request failed', 'error');
	}		

    });
    
  });

/* ====== update  details  start ===== */


$("#edit_service").validate({
     rules:{
      
     	 edit_service_title :"required",
         edit_service_content  :"required",
         edit_service_status :"required",
         edit_service_url:"required"
      }
 });

$("#updateservice").click(function(){

	   if(!$("#edit_service").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_service")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/ServiceController/updateService",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#service-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#service-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_service')[0].reset();
                
                setTimeout(function(){
               $('#EditServiceModal').modal("hide");
                    }, 4000);	
                viewServices();   

			 }
			else{
				$('#service-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#service-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#service-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#service-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.service_delete a', function(e){
 var id= $(this).attr("data-serviceid");
 var name=$(this).attr("data-servicename");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/ServiceController/deleteServiceById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert("<div class='alert alert-success'>"+result.message+"</div>"); 
      viewServices();   
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});

/* ====== delete end ===== */


}); // document ready 