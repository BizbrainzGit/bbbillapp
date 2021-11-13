
$(document).ready(function(){
viewBuyNowimgs();   

        function viewBuyNowimgs(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/BuyNowimgController/BuyNowimgList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             BuyNowimgsList(result.data);
                                 }        
                }
            });
        }

function BuyNowimgsList(buynowimgslistdata){
	 if ( $.fn.DataTable.isDataTable('#buynowimgtable')) {
				 $('#buynowimgtable').DataTable().destroy();
				 }	
				 $('#buynowimgtable tbody').empty();
				 var data=buynowimgslistdata; 
				 var table = $('#buynowimgtable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'buynowimg_title',title: 'Titele'},
		  {data: 'image',title: 'BuyNow Image'},
		  {data: 'image_alt',title: 'Image Alt'},
		  {data: 'status',title: 'Status',render: getImg},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_buynowimg" data-toggle="modal" data-target="#EditBuyNowimgModal"><a data-buynowimgid="'+data.id+'" data-buynowimgname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md buynowimg_delete"><a data-buynowimgid="'+data.id+'" data-buynowimgname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
	
		 columnDefs: [{
		  targets: 2,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data !=null ){
                    data = '<img id="active" src="'+url+data+'"  align="center"/>' 
			  }else{
				  data = '<img id="active" src="'+url+'assets/images/no_image.png" align="center"/>'
			  }			 
          }
        return data;
       }
		 }]
		
			 });
table.rows.add(data).draw();

         
}

function getImg(data, type, full, meta) {

            if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
			  }	else{
				  data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }

       return data;
    }

/* ====== add start ===== */
$("#add_buynowimg").validate({
     
     rules:{
     	 add_buynowimg_title :"required",
         add_buynowimg_status :"required",
         add_buynowimg_image :"required"
      }
 });

$("#addbuynowimg").click(function() {
	  if(!$("#add_buynowimg").valid())
	 {   
		 return false;
	 }
    var formData = new FormData($("#add_buynowimg")[0]);
     $.ajax({
      type:"POST",
      url:url+"templateadmin/BuyNowimgController/saveBuyNowimg",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success==true){
		    $('#buynowimg-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#buynowimg-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_buynowimg')[0].reset();
			 setTimeout(function(){
               $('#AddbuynowimgModal').modal("hide");
                    }, 4000);
             viewBuyNowimgs();          		
				
			}
			else{
				 $('#buynowimg-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#buynowimg-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#buynowimg-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#buynowimg-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_buynowimg a', function(e){
    var id = $(this).attr('data-buynowimgid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/BuyNowimgController/buynowimgEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_buynowimg #edit_buynowimg_id').val(id);
               $('#edit_buynowimg #edit_buynowimg_title').val(result.data[0].buynowimg_title);
               $('#edit_buynowimg #edit_buynowimg_image_alt').val(result.data[0].image_alt);
           
				if(result.data[0].status=='1'){
					$('#edit_buynowimg  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_buynowimg  #edit_inactive').prop('checked', true);
				}

		       $("#buynowimgimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');
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


$("#edit_buynowimg").validate({
     rules:{
       
     	 edit_buynowimg_title :"required",
         edit_buynowimg_status :"required",
      }
 });

$("#updatebuynowimg").click(function(){

	   if(!$("#edit_buynowimg").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_buynowimg")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/BuyNowimgController/updateBuyNowimg",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#buynowimg-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#buynowimg-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_buynowimg')[0].reset();
                
                setTimeout(function(){
               $('#EditBuyNowimgModal').modal("hide");
                    }, 4000);	
                viewBuyNowimgs();   

			 }
			else{
				$('#buynowimg-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#buynowimg-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#buynowimg-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#buynowimg-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.buynowimg_delete a', function(e){
 var id= $(this).attr("data-buynowimgid");
 var name=$(this).attr("data-buynowimgname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/BuyNowimgController/deleteBuyNowimgById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewBuyNowimgs();   
   
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