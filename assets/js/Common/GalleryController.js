

$(document).ready(function(){
viewGallerys();   
        function viewGallerys(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/GalleryController/GalleryList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             GallerysList(result.data);
                                 }        
                }
            });
        }

function GallerysList(galleryslistdata){
	 if ( $.fn.DataTable.isDataTable('#gallerytable')) {
				 $('#gallerytable').DataTable().destroy();
				 }	
				 $('#gallerytable tbody').empty();
				 var data=galleryslistdata; 
				 var table = $('#gallerytable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'gallerytype_name',title: 'Gallery Type'},
		  {data: 'gallery_title',title: 'Titele'},
		  {data: 'image_alt',title: 'Image Alt'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_gallery" data-toggle="modal" data-target="#EditGalleryModal"><a data-galleryid="'+data.id+'" data-galleryname="' +data.gallerytype_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md gallery_delete"><a data-galleryid="'+data.id+'" data-galleryname="' +data.gallerytype_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
					 columnDefs: [{
		  targets: 4,
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
$("#add_gallery").validate({
     
     rules:{
     	 add_gallery_type :"required",
     	 // add_gallery_title :"required",
         add_gallery_status :"required",
         add_gallery_image :"required"
      }
 });

$("#addgallery").click(function() {
	  if(!$("#add_gallery").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_gallery")[0] );
     $.ajax({
      type:"POST",
      url:url+"templateadmin/GalleryController/saveGallery",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#gallery-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#gallery-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_gallery')[0].reset();
			 setTimeout(function(){
               $('#AddgalleryModal').modal("hide");
                    }, 4000);
             viewGallerys();          		
				
			}
			else{
				 $('#gallery-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#gallery-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#gallery-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#gallery-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_gallery a', function(e){
    var id = $(this).attr('data-galleryid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/GalleryController/galleryEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_gallery #edit_gallery_id').val(id);
               $('#edit_gallery #edit_gallery_title').val(result.data[0].gallery_title);
               $('#edit_gallery #edit_gallery_image_alt').val(result.data[0].image_alt);
			   $('#edit_gallery #edit_gallery_type').val(result.data[0].gallery_type).prop('selected',true);
				if(result.data[0].status=='1'){
					$('#edit_gallery  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_gallery  #edit_inactive').prop('checked', true);
				}

		       $("#galleryimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');

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


$("#edit_gallery").validate({
     rules:{
        edit_gallery_type :"required",
     	 // edit_gallery_title :"required",
         edit_gallery_status :"required",
      }
 });

$("#updategallery").click(function(){

	   if(!$("#edit_gallery").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_gallery")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/GalleryController/updateGallery",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#gallery-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#gallery-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_gallery')[0].reset();
                
                setTimeout(function(){
               $('#EditGalleryModal').modal("hide");
                    }, 4000);	
                viewGallerys();   

			 }
			else{
				$('#gallery-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#gallery-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#gallery-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#gallery-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.gallery_delete a', function(e){
 var id= $(this).attr("data-galleryid");
 var name=$(this).attr("data-galleryname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/GalleryController/deleteGalleryById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewGallerys();   
   
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