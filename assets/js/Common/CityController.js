
$(document).ready(function(){
    view_city();   
        function view_city(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/CityController/listCity",
                async : true,
                dataType : 'json',
                success : function(result){
         if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#citytable')) {
				 $('#citytable').DataTable().destroy();
				 }	
				 $('#citytable tbody').empty();

				 var data=result.data; 
				 var table = $('#citytable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'cityid',title: 'Id.'},
		  {data: 'cityname',title:'City Name'},
		  {data: 'short_code',title:'City Short Code'},
		  {data: 'state_name',title:'State Name'},
		  {data: 'status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm citydata_edit" data-toggle="modal" id="citydata_edit" data-target="#EditcityModal"><a data-cityid="'+data.cityid+'" data-cityname="' +data.cityname+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm city_delete"><a data-cityid="'+data.cityid+'" data-cityname="' +data.cityname+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
		 columnDefs: [{
         targets: 4,
         render: function(data, type, full, meta){
		  if(type === 'display'){
             if(data == '1'){
            data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' ;
			  }
			  else{
		   data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>' ;
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

/* ======  city  Table  edit  start ===== */

 $(document).on('click', '.citydata_edit a', function(e){
 
 var id= $(this).attr("data-cityid");
 $.ajax({
    type: "GET",
    url:url+'admin/CityController/editCityByid/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
         $('#edit_city #edit_city_id').val(result.data[0].cityid);
         $('#edit_city #edit_city_name').val(result.data[0].cityname);
         $('#edit_city #edit_city_shortcode').val(result.data[0].short_code);
         $('#edit_city #edit_city_state').val(result.data[0].state_id).prop('selected', true); 
         $('#edit_city #edit_city_status').val(result.data[0].status).prop('selected', true);
		
      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  city  Table  edit  end ===== */


/* ======  city  Table  update  start ===== */

$("#edit_city").validate({
     
     rules:{
        edit_city_name :"required",
        edit_city_shortcode :"required",
        edit_city_status :"required",
        edit_city_state:"required"
     }
 });

 $("#updatecity").click(function(){

	  if(!$("#edit_city").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_city")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/CityController/updateCityByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#city-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#city-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_city")[0].reset();
            setTimeout(function(){
               $('#EditcityModal').modal('hide');
                }, 5000); 
		view_city(); 	

   }
	else if(result.success===false){
				$('#city-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#city-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#city-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#city-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  city  Table  update  end ===== */


/* ====== add  city  details  start ===== */
$("#add_city").validate({
     
     rules:{
        add_city_name :"required",
        add_city_shortcode :"required",
        add_city_status :"required",
        add_city_state:"required"
     }
 });

$("#addcity").click(function() {
	
	  if(!$("#add_city").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_city")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/CityController/saveCity",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#city-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#city-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_city')[0].reset();
				setTimeout(function(){
               $('#AddcityModal').modal("hide");
                    }, 5000);	
				view_city(); 
				 
			}
			else{
				$('#city-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#city-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#city-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#city-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  city  details  end ===== */


$(document).on('click', '.city_delete a', function(e){
 
 var id= $(this).attr("data-cityid");
 var name=$(this).attr("data-cityname");

    $.ajax({
    type: "GET",
    url:url+'admin/CityController/deleteCityById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    view_city(); 
   
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

