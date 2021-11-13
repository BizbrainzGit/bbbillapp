
$(document).ready(function(){

viewClientLogos();   

        function viewClientLogos(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/ClientLogoController/ClientLogoList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ClientLogosList(result.data);
                                 }        
                }
            });
        }

function ClientLogosList(clientlogoslistdata){
	 if ( $.fn.DataTable.isDataTable('#clientlogotable')) {
				 $('#clientlogotable').DataTable().destroy();
				 }	
				 $('#clientlogotable tbody').empty();
				 var data=clientlogoslistdata; 
				 var table = $('#clientlogotable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'clientlogo_title',title: 'Titele'},
		  {data: 'clientlogo_image',title: 'Logo',render: getImg},
		  {data: 'clientlogo_image_alt',title: 'Image Alt'},
		  {data: 'clientlogo_url',title: 'Url'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_clientlogo" data-toggle="modal" data-target="#EditClientLogoModal"><a data-clientlogoid="'+data.id+'" data-clientlogoname="' +data.clientlogo_title+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md clientlogo_delete"><a data-clientlogoid="'+data.id+'" data-clientlogoname="' +data.clientlogo_title+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
	
		 columnDefs: [{
		  targets: 5,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
                    data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>';
			  }else if(data == '2' ){
				  data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>';
			  }			 
          }
        return data;
       }
		 }]
		
			 });
table.rows.add(data).draw();

         
}

function getImg(data, type, full, meta) {

            if(data){
               data = '<img id="active" src="'+url+data+'" heignt="32px" width="32px" align="center"/>';
			  }	else{
				  data = '<img id="inactive" src="'+url+'assets/images/no_image.png" heignt="32px" width="32px" align="center"/>';
			  }

       return data;
    }

/* ====== add start ===== */
$("#add_clientlogo").validate({
     
     rules:{
         add_clientlogo_url  :"required",
         add_clientlogo_status :"required",
         add_clientlogo_image :"required"
      }
 });

$("#addclientlogo").click(function() {
	  if(!$("#add_clientlogo").valid())
	 {   
		 return false;
	 }
    var formData = new FormData($("#add_clientlogo")[0]);
     $.ajax({
      type:"POST",
      url:url+"templateadmin/ClientLogoController/saveClientLogo",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success==true){
		    $('#clientlogo-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#clientlogo-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_clientlogo')[0].reset();
			 setTimeout(function(){
               $('#AddclientlogoModal').modal("hide");
                    }, 4000);
             viewClientLogos();          		
				
			}
			else{
				 $('#clientlogo-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#clientlogo-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#clientlogo-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#clientlogo-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_clientlogo a', function(e){
    var id = $(this).attr('data-clientlogoid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/ClientLogoController/clientlogoEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_clientlogo #edit_clientlogo_id').val(id);
               $('#edit_clientlogo #edit_clientlogo_title').val(result.data[0].clientlogo_title);
               $('#edit_clientlogo #edit_clientlogo_image_alt').val(result.data[0].clientlogo_image_alt);
               $('#edit_clientlogo #edit_clientlogo_url').val(result.data[0].clientlogo_url);
				if(result.data[0].status=='1'){
					$('#edit_clientlogo  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_clientlogo  #edit_inactive').prop('checked', true);
				}

		       $("#clientlogoimage").html('<img src="'+url+result.data[0].clientlogo_image+ '" width="100px"  height="100px" alt="photo" />');

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


$("#edit_clientlogo").validate({
     rules:{
     	 edit_clientlogo_title :"required",
         edit_clientlogo_url  :"required",
         edit_clientlogo_status :"required",
      }
 });

$("#updateclientlogo").click(function(){

	   if(!$("#edit_clientlogo").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_clientlogo")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/ClientLogoController/updateClientLogo",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#clientlogo-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#clientlogo-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_clientlogo')[0].reset();
                
                setTimeout(function(){
               $('#EditClientLogoModal').modal("hide");
                    }, 4000);	
                viewClientLogos();   

			 }
			else{
				$('#clientlogo-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#clientlogo-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#clientlogo-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#clientlogo-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.clientlogo_delete a', function(e){
 var id= $(this).attr("data-clientlogoid");
 var name=$(this).attr("data-clientlogoname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/ClientLogoController/deleteClientLogoById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewClientLogos();   
   
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