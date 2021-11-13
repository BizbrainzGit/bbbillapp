
$(document).ready(function(){

viewBanners();   

        function viewBanners(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/BannerController/BannerList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             BannersList(result.data);
                                 }        
                }
            });
        }

function BannersList(bannerslistdata){
	 if ( $.fn.DataTable.isDataTable('#bannertable')) {
				 $('#bannertable').DataTable().destroy();
				 }	
				 $('#bannertable tbody').empty();
				 var data=bannerslistdata; 
				 var table = $('#bannertable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'menu_name',title: 'Menu Name'},
		  {data: 'banner_title',title: 'Titele'},
		  {data: 'banner_content',title: 'Content'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_banner" data-toggle="modal" data-target="#EditBannerModal"><a data-bannerid="'+data.id+'" data-bannername="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md banner_delete"><a data-bannerid="'+data.id+'" data-bannername="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
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
$("#add_banner").validate({
     
     rules:{
     	 add_banner_menu :"required",
     	 // add_banner_title :"required",
       //   add_banner_content  :"required",
         add_banner_status :"required",
         add_banner_image :"required"
      }
 });

$("#addbanner").click(function() {
	  if(!$("#add_banner").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_banner")[0] );
     $.ajax({
      type:"POST",
      url:url+"templateadmin/BannerController/saveBanner",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#banner-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#banner-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_banner')[0].reset();
			 setTimeout(function(){
               $('#AddbannerModal').modal("hide");
                    }, 4000);
             viewBanners();          		
				
			}
			else{
				 $('#banner-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#banner-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#banner-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#banner-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_banner a', function(e){
    var id = $(this).attr('data-bannerid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/BannerController/bannerEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_banner #edit_banner_id').val(id);
               $('#edit_banner #edit_banner_title').val(result.data[0].banner_title);
               $('#edit_banner #edit_banner_content').val(result.data[0].banner_content);
               $('#edit_banner #edit_banner_image_alt').val(result.data[0].image_alt);
			   $('#edit_banner #edit_banner_menu').val(result.data[0].menu_id).prop('selected',true);

				if(result.data[0].status=='1'){
					$('#edit_banner  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_banner  #edit_inactive').prop('checked', true);
				}

		       $("#bannerimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');

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


$("#edit_banner").validate({
     rules:{
        edit_banner_menu :"required",
     	 // edit_banner_title :"required",
       //   edit_banner_content  :"required",
         edit_banner_status :"required",
      }
 });

$("#updatebanner").click(function(){

	   if(!$("#edit_banner").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_banner")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/BannerController/updateBanner",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#banner-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#banner-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_banner')[0].reset();
                
                setTimeout(function(){
               $('#EditBannerModal').modal("hide");
                    }, 4000);	
                viewBanners();   

			 }
			else{
				$('#banner-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#banner-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#banner-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#banner-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.banner_delete a', function(e){
 var id= $(this).attr("data-bannerid");
 var name=$(this).attr("data-bannername");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/BannerController/deleteBannerById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert("<div class='alert alert-success'>"+result.message+"</div>"); 
      viewBanners();   
   
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