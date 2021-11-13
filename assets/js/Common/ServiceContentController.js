
$(document).ready(function(){

viewServiceContents();   

        function viewServiceContents(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/ServiceContentController/ServiceContentList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ServiceContentsList(result.data);
                                 }        
                }
            });
        }

function ServiceContentsList(servicecontentslistdata){
	 if ( $.fn.DataTable.isDataTable('#servicecontenttable')) {
				 $('#servicecontenttable').DataTable().destroy();
				 }	
				 $('#servicecontenttable tbody').empty();
				 var data=servicecontentslistdata; 
				 var table = $('#servicecontenttable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'service_title',title: 'Service Content Type'},
		  {data: 'bannertitle',title: 'Banner Title'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_servicecontent" data-toggle="modal" data-target="#EditServiceContentModal"><a data-servicecontentid="'+data.id+'" data-servicecontentname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md servicecontent_delete"><a data-servicecontentid="'+data.id+'" data-servicecontentname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
	
		 columnDefs: [{
		  targets: 3,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
               data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }else if(data == '2' ){
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
$("#add_servicecontent").validate({
     
     rules:{
     	 add_servicecontent_type :"required",
     	 add_servicecontent_title :"required",
         add_servicecontent_url  :"required",
         add_servicecontent_status :"required",
         add_servicecontent_image :"required"
      }
 });

$("#addservicecontent").click(function() {
	  if(!$("#add_servicecontent").valid())
	 {   
		 return false;
	 }
    var formData = new FormData($("#add_servicecontent")[0]);
     $.ajax({
      type:"POST",
      url:url+"templateadmin/ServiceContentController/saveServiceContent",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success==true){
		    $('#servicecontent-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#servicecontent-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_servicecontent')[0].reset();
			 setTimeout(function(){
               $('#AddservicecontentModal').modal("hide");
                    }, 4000);
             viewServiceContents();          		
				
			}
			else{
				 $('#servicecontent-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#servicecontent-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#servicecontent-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#servicecontent-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_servicecontent a', function(e){
    var id = $(this).attr('data-servicecontentid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/ServiceContentController/servicecontentEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		      
		       $('#edit_servicecontent #edit_servicecontent_id').val(id);
			   $('#edit_servicecontent #edit_servicecontent_type').val(result.data[0].servicecontent_type).prop('selected',true);

			$('#edit_servicecontent #edit_servicecontent_bannertitle').val(result.data[0].bannertitle);
            $('#edit_servicecontent #edit_servicecontent_bannercontent').val(result.data[0].bannercontent);
            $('#edit_servicecontent #edit_servicecontent_bannerimagealt').val(result.data[0].bannerimage_alt);

            if(result.data[0].bannerimage !=null){
                 var  bannerimage = '<img src="'+url+result.data[0].bannerimage+'" heignt="74px" width="74px" align="center"/>' ;
			  }
			  else{
		        var bannerimage = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
			  }

			  $("#servicecontent_bannerimage").html(bannerimage);
			 
     $('#edit_servicecontent #edit_servicecontent_section1_heading').val(result.data[0].section1_heading);
     $('#edit_servicecontent #edit_servicecontent_section1_content').val(result.data[0].section1_content);
     $('#edit_servicecontent #edit_servicecontent_section1_imagealt').val(result.data[0].section1_image_alt);
    if(result.data[0].section1_image !=null){
                 var  section1_image = '<img src="'+url+result.data[0].section1_image+'" heignt="74px" width="74px" align="center"/>' ;
        }
        else{
            var section1_image = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
        }
     $('#edit_servicecontent #edit_servicecontent_section2_heading').val(result.data[0].section2_heading);
     $('#edit_servicecontent #edit_servicecontent_section2_content').val(result.data[0].section2_content);
     $('#edit_servicecontent #edit_servicecontent_section2_imagealt').val(result.data[0].section2_image_alt);
    if(result.data[0].section2_image !=null){
                 var  section2_image = '<img src="'+url+result.data[0].section2_image+'" heignt="74px" width="74px" align="center"/>' ;
        }
        else{
            var section2_image = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
        }

    $('#edit_servicecontent #edit_servicecontent_section3_heading').val(result.data[0].section3_heading);
     $('#edit_servicecontent #edit_servicecontent_section3_content').val(result.data[0].section3_content);
     $('#edit_servicecontent #edit_servicecontent_section3_imagealt').val(result.data[0].section3_image_alt);
    if(result.data[0].section3_image !=null){
                 var  section3_image = '<img src="'+url+result.data[0].section3_image+'" heignt="74px" width="74px" align="center"/>' ;
        }
        else{
            var section3_image = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
        }

        $("#servicecontent_section3_image").html(section3_image);    

        $("#servicecontent_section2_image").html(section2_image);   

        $("#servicecontent_section1_image").html(section1_image);






			 if(result.data[0].status=='1'){
					$('#edit_servicecontent  #edit_active').prop('checked', true); // checked
				}else if(result.data[0].status=='2'){
					$('#edit_servicecontent  #edit_inactive').prop('checked', true);
				}

		     

		   //     if(result.data[0].bannerimage !=null){
     //             var  certificationimage = '<img src="'+url+result.data[0].bannerimage+'" heignt="74px" width="74px" align="center"/>' ;
			  // }
			  // else{
		   //      var certificationimage = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
			  // }

			  // $("#servicecontentcertificationimage").html(certificationimage);

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


$("#edit_servicecontent").validate({
     rules:{
         edit_servicecontent_type :"required",
     	 edit_servicecontent_title :"required",
         edit_servicecontent_url  :"required",
         edit_servicecontent_status :"required",
      }
 });

$("#updateservicecontent").click(function(){

	   if(!$("#edit_servicecontent").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_servicecontent")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/ServiceContentController/updateServiceContent",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#servicecontent-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#servicecontent-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_servicecontent')[0].reset();
                
                setTimeout(function(){
               $('#EditServiceContentModal').modal("hide");
                    }, 4000);	
                viewServiceContents();   

			 }
			else{
				$('#servicecontent-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#servicecontent-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#servicecontent-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#servicecontent-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.servicecontent_delete a', function(e){
 var id= $(this).attr("data-servicecontentid");
 var name=$(this).attr("data-servicecontentname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/ServiceContentController/deleteServiceContentById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewServiceContents();   
   
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