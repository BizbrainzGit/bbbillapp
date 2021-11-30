
$(document).ready(function(){
    view_producttype();   
        function view_producttype(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/ProductTypesController/listProductType",
                async : true,
                dataType : 'json',
                success : function(result){
         if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#producttypetable')) {
				 $('#producttypetable').DataTable().destroy();
				 }	
				 $('#producttypetable tbody').empty();

				 var data=result.data; 
				 var table = $('#producttypetable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'product_type_name',title:'Product Type Name'},
		  {data: 'product_type_status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm producttypedata_edit" data-toggle="modal" id="producttypedata_edit" data-target="#EditproducttypeModal"><a data-producttypeid="'+data.id+'" data-producttypename="' +data.product_type_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
					 } }],
		 columnDefs: [{
         targets: 2,
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

/* ======  producttype  Table  edit  start ===== */

 $(document).on('click', '.producttypedata_edit a', function(e){
 
 var id= $(this).attr("data-producttypeid");
 $.ajax({
    type: "GET",
    url:url+'admin/ProductTypesController/editProductTypeByid/'+id,
    dataType: 'json',
  success:function(result){
      if(result.success===true)
      { 
         $('#edit_producttype #edit_producttype_id').val(result.data[0].id);
         $('#edit_producttype #edit_producttype_name').val(result.data[0].product_type_name);
         $('#edit_producttype #edit_producttype_status').val(result.data[0].product_type_status).prop('selected', true);
		
      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  producttype  Table  edit  end ===== */


/* ======  producttype  Table  update  start ===== */

$("#edit_producttype").validate({
     
     rules:{
        edit_producttype_name :"required",
        edit_producttype_status:"required"
     }
 });

 $("#updateproducttype").click(function(){

	  if(!$("#edit_producttype").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_producttype")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/ProductTypesController/updateProductTypeByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				 $('#producttype-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#producttype-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_producttype")[0].reset();
            setTimeout(function(){
               $('#EditproducttypeModal').modal('hide');
                }, 5000); 
		view_producttype(); 	

   }
	else if(result.success===false){
				$('#producttype-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#producttype-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#producttype-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#producttype-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  producttype  Table  update  end ===== */


/* ====== add  producttype  details  start ===== */
$("#add_producttype").validate({
     
     rules:{
        add_producttype_name :"required",
        add_producttype_state:"required"
     }
 });

$("#addproducttype").click(function() {
	
	  if(!$("#add_producttype").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_producttype")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/ProductTypesController/saveProductType",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

      success: function(result){
			
			if(result.success==true){
				$('#producttype-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#producttype-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_producttype')[0].reset();
				setTimeout(function(){
               $('#AddproducttypeModal').modal("hide");
                    }, 5000);	
				view_producttype(); 
				 
			}
			else{
				$('#producttype-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#producttype-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#producttype-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#producttype-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  producttype  details  end ===== */




});

