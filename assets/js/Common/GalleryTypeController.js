

$(document).ready(function(){
viewGalleryTypes();   

        function viewGalleryTypes(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/GalleryTypeController/GalleryTypesList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             gallerytypesList(result.data);
                                 }        
                }
            });
        }

function gallerytypesList(gallerytypeslistdata){

	 if ( $.fn.DataTable.isDataTable('#gallerytypestable')) {
				 $('#gallerytypestable').DataTable().destroy();
				 }	
				 $('#gallerytypestable tbody').empty();

				 var data=gallerytypeslistdata; 
				 var table = $('#gallerytypestable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'gallerytype_name',title:'GalleryType Name'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm gallerytypesdata_edit" data-toggle="modal" id="gallerytypesdata_edit" data-target="#EditGalleryTypesModal"><a data-gallerytypesid="'+data.id+'" data-gallerytypesname="' +data.gallerytype_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp;<button class="btn btn-danger btn-sm gallerytypes_delete"><a data-gallerytypesid="'+data.id+'" data-gallerytypesname="' +data.gallerytype_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
           columnDefs: [{
      targets: 2,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else if(data == '2'){
          data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }      
          }
        return data;
       }
     }]

	

			 });

table.rows.add(data).draw();
         
}


/* ======  gallerytypes  Table  edit  start ===== */

 $(document).on('click', '.gallerytypesdata_edit a', function(e){
 var id= $(this).attr("data-gallerytypesid");
 $.ajax({
    type: "GET",
    url:url+'templateadmin/GalleryTypeController/editGalleryTypesByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_gallerytype #edit_gallerytype_id').val(result.data[0].id);
        $('#edit_gallerytype #edit_gallerytype_name').val(result.data[0].gallerytype_name);
        if(result.data[0].status=='1'){
                $('#edit_gallerytype  #edit_active').prop('checked', true); // checked
              }
          else{
              $('#edit_gallerytype  #edit_inactive').prop('checked', true);
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



/* ======  gallerytypes  Table  edit  end ===== */


/* ======  gallerytypes  Table  update  start ===== */

$("#edit_gallerytype").validate({
     
     rules:{
        edit_gallerytype_name :"required",
        edit_gallerytype_status:"required"
     }
 });

 $("#updategallerytypes").click(function(){

	  if(!$("#edit_gallerytype").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_gallerytype")[0] );
   $.ajax({
       type:"POST",
       url:url+"templateadmin/GalleryTypeController/updateGalleryTypesByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#gallerytypes-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#gallerytypes-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_gallerytype")[0].reset();
            setTimeout(function(){
               $('#EditGalleryTypesModal').modal('hide');
                }, 5000); 
			viewGalleryTypes();  

   }
	else if(result.success===false){
				$('#gallerytypes-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#gallerytypes-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#gallerytypes-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#gallerytypes-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  gallerytypes  Table  update  end ===== */


/* ====== add  gallerytypes  details  start ===== */
$("#add_gallerytype").validate({
     
     rules:{
        add_gallerytype_name :"required",
        add_gallerytype_status:"required"
     }
 });

$("#addgallerytypes").click(function() {
	
	  if(!$("#add_gallerytype").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_gallerytype")[0] );
     $.ajax({
      type:"POST",
    url:url+"templateadmin/GalleryTypeController/saveGalleryTypes",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			if(result.success==true){
				$('#gallerytypes-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#gallerytypes-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_gallerytype')[0].reset();
				setTimeout(function(){
               $('#AddGalleryTypesModal').modal("hide");
                    }, 5000);	
				viewGalleryTypes();  
				 
			}
			else{
				$('#gallerytypes-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#gallerytypes-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){
			$('#gallerytypes-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#gallerytypes-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });


});
/* ====== add  gallerytypes  details  end ===== */

$(document).on('click', '.gallerytypes_delete a', function(e){
 var id= $(this).attr("data-gallerytypesid");
 var name=$(this).attr("data-gallerytypesname");

    $.ajax({
    type: "GET",
    url:url+'templateadmin/GalleryTypeController/deleteGalleryTypesById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
     alert(''+result.message+''); 
    viewGalleryTypes();  
   
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


});

