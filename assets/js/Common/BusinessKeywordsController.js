
$(document).ready(function(){

viewKeywords();   

        function viewKeywords(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/BusinessKeywordsController/SearchBusinessKeywordsList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             keywordsList(result.data);
                                 }        
                }
            });
        }

function keywordsList(keywordslistdata){

	 if ( $.fn.DataTable.isDataTable('#businesskeywordstable')) {
				 $('#businesskeywordstable').DataTable().destroy();
				 }	
				 $('#businesskeywordstable tbody').empty();

				 var data=keywordslistdata; 
				 var table = $('#businesskeywordstable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'category_name',title:'Business Keyword'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm keywordsdata_edit" data-toggle="modal" id="keywordsdata_edit" data-target="#EditBusinesskeywordsModal"><a data-keywordsid="'+data.id+'" data-keywordsname="' +data.category_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm keywords_delete"><a data-keywordsid="'+data.id+'" data-keywordsname="' +data.category_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
           columnDefs: [{
      targets: 2,
         render: function(data, type, full, meta){
      if(type === 'display'){
        if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
        } else{
          data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
        }      
          }
        return data;
       }
     }]

	

			 });

table.rows.add(data).draw();
         
}


/* ======  keywords  Table  edit  start ===== */

 $(document).on('click', '.keywordsdata_edit a', function(e){
 
 var id= $(this).attr("data-keywordsid");


 $.ajax({
    type: "GET",
    url:url+'admin/BusinessKeywordsController/editKeywordsByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_business_keywords #edit_business_keywords_id').val(result.data[0].id);
        $('#edit_business_keywords #edit_business_keywords_name').val(result.data[0].category_name);
        if(result.data[0].status=='1'){
                $('#edit_business_keywords  #edit_active').prop('checked', true); // checked
              }
          else{
              $('#edit_business_keywords  #edit_inactive').prop('checked', true);
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



/* ======  keywords  Table  edit  end ===== */


/* ======  keywords  Table  update  start ===== */

$("#edit_business_keywords").validate({
     
     rules:{
        edit_business_keywords_name :"required",
        edit_business_keywords_status:"required"
     }
 });

 $("#updatebusinesskeywords").click(function(){

	  if(!$("#edit_business_keywords").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_business_keywords")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/BusinessKeywordsController/updateKeywordsByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#businesskeywords-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#businesskeywords-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_business_keywords")[0].reset();
            setTimeout(function(){
               $('#EditBusinesskeywordsModal').modal('hide');
                }, 5000); 
			viewKeywords();  

   }
	else if(result.success===false){
				$('#businesskeywords-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#businesskeywords-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#businesskeywords-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#businesskeywords-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  keywords  Table  update  end ===== */


/* ====== add  keywords  details  start ===== */
$("#add_business_keywords").validate({
     
     rules:{
        add_business_keywords_name :"required",
        add_business_keywords_status:"required"
     }
 });

$("#addbusinesskeywords").click(function() {
	
	  if(!$("#add_business_keywords").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_business_keywords")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/BusinessKeywordsController/saveKeywords",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#businesskeywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#businesskeywords-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_business_keywords')[0].reset();
				setTimeout(function(){
               $('#AddBusinesskeywordsModal').modal("hide");
                    }, 5000);	
				viewKeywords();  
				 
			}
			else{
				$('#businesskeywords-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#businesskeywords-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){
			$('#businesskeywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#businesskeywords-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  keywords  details  end ===== */


$(document).on('click', '.keywords_delete a', function(e){
 
 var id= $(this).attr("data-keywordsid");
 var name=$(this).attr("data-keywordsname");

    $.ajax({
    type: "GET",
    url:url+'admin/BusinessKeywordsController/deleteKeywordsById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    viewKeywords();  
   
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


$("#searchbusinesskeywords").click(function(){

var formData = new FormData($("#search_business_keywords")[0] );

   $.ajax({
       type:"POST",
       url:url+"admin/BusinessKeywordsController/SearchBusinessKeywordsList",
      dataType: 'json',
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
 success: function(result){
      
      if(result.success===true){
           keywordsList(result.data);
    
   }
  else if(result.success===false){
        $('#search_business_keywords-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_business_keywords-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_business_keywords-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_business_keywords-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});

});

