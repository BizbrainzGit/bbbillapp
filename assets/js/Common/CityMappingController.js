
$(document).ready(function(){

viewCitymapping();   
        function viewCitymapping(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/CityMappingController/listCityMapping",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#citymappingtable')) {
				 $('#citymappingtable').DataTable().destroy();
				 }	
				 $('#citymappingtable tbody').empty();

				 var data=result.data; 
				 var table = $('#citymappingtable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Sno.'},
		  {data: 'marketlead_user_name',title:'Market Lead Name'},
		  {data: 'user_name',title:'Marketing User Name'},		  
		  {data: 'city_mapping_name',title:'Cities'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm citymappingdata_edit" data-toggle="modal" id="citymappingdata_edit" data-target="#EditcitymappingModal"><a data-citymappingid="'+data.user_id+'" data-citymappingname="' +data.user_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    // <button class="btn btn-danger btn-sm citymapping_delete"><a data-citymappingid="'+data.user_id+'" data-citymappingname="' +data.user_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }]

	

			 });

table.rows.add(data).draw();

         
  }        
                }
            });
        }


/* ======  citymapping  Table  edit  start ===== */

 $(document).on('click', '.citymappingdata_edit a', function(e){
 
 var id= $(this).attr("data-citymappingid");


 $.ajax({
    type: "GET",
    url:url+'admin/CityMappingController/editCitymappingByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_citymapping #edit_citymapping_id').val(result.data[0].user_id);
         $('#edit_citymapping #edit_marketlead_user').val(result.data[0].marketlead_user_id).prop('selected', true);
        $('#edit_citymapping #edit_user').val(result.data[0].user_id).prop('selected', true);
       
        var values = result.data[0].city_mapping_id;
		var selectedValues=new Array();
		$.each(values.split(","), function(i,e){
			selectedValues[i]=e;
		   });

		$("#edit_mapping_city").select2().val(selectedValues).trigger('change');

  

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  citymapping  Table  edit  end ===== */


/* ======  citymapping  Table  update  start ===== */

$("#edit_citymapping").validate({
     
     rules:{
     	edit_marketlead_user : "required",
        edit_user :"required",
        edit_mapping_city :"required"
      
     }
 });

 $("#updatecitymapping").click(function(){

	  if(!$("#edit_citymapping").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_citymapping")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/CityMappingController/updateCitymappingByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
			
				$('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_citymapping")[0].reset();
            setTimeout(function(){
               $('#EditcitymappingModal').modal('hide');
                }, 5000); 
			viewCitymapping();   

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

/* ======  citymapping  Table  update  end ===== */


/* ====== add  citymapping  details  start ===== */
$("#add_citymapping").validate({
     
     rules:{
        add_user :"required",
        add_mapping_city :"required",
      
     }
 });

$("#addcitymapping").click(function() {
	
	  if(!$("#add_citymapping").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_citymapping")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/CityMappingController/saveCityMapping",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#citymapping-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#citymapping-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_citymapping')[0].reset();
				setTimeout(function(){
               $('#AddcitymappingModal').modal("hide");
                    }, 5000);	
				viewCitymapping();   
				 
			}
			else if(result.success===false){
				$('#citymapping-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#citymapping-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#citymapping-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#citymapping-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  citymapping  details  end ===== */


$(document).on('click', '.citymapping_delete a', function(e){
 
 var id= $(this).attr("data-citymappingid");
 var name=$(this).attr("data-citymappingname");
    $.ajax({
    type: "GET",
    url:url+'admin/CityMappingController/deleteCitymappingById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    viewCitymapping();   
   
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

