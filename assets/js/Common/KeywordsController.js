$(document).ready(function(){
     viewKeywords();   
        function viewKeywords(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/KeywordsController/SearchKeywordsList",
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

	 if ( $.fn.DataTable.isDataTable('#keywordstable')) {
				 $('#keywordstable').DataTable().destroy();
				 }	
				 $('#keywordstable tbody').empty();

				 var data=keywordslistdata; 
				 var table = $('#keywordstable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'category_name',title:'Category Name'},
		  {data: 'keywords',title:'Keywords'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm keywordsdata_edit" data-toggle="modal" id="keywordsdata_edit" data-target="#EditkeywordsModal"><a data-keywordsid="'+data.id+'" data-keywordsname="' +data.category_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm keywords_delete"><a data-keywordsid="'+data.id+'" data-keywordsname="' +data.category_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }]

	

			 });

table.rows.add(data).draw();
         
}


/* ======  keywords  Table  edit  start ===== */

 $(document).on('click', '.keywordsdata_edit a', function(e){
 
 var id= $(this).attr("data-keywordsid");


 $.ajax({
    type: "GET",
    url:url+'admin/KeywordsController/editKeywordsByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_keywords #edit_keywords_id').val(result.data[0].id);
        $('#edit_keywords #edit_keywords_name').val(result.data[0].keywords);
        $('#edit_keywords #edit_keywords_category').val(result.data[0].category_id);
  

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

$("#edit_keywords").validate({
     
     rules:{
        edit_keywords_name :"required",
        edit_keywords_category:"required"
     }
 });

 $("#updatekeywords").click(function(){

	  if(!$("#edit_keywords").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_keywords")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/KeywordsController/updateKeywordsByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#keywords-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#keywords-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_keywords")[0].reset();
            setTimeout(function(){
               $('#EditkeywordsModal').modal('hide');
                }, 5000); 
			viewKeywords();  

   }
	else if(result.success===false){
				$('#keywords-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#keywords-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#keywords-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#keywords-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  keywords  Table  update  end ===== */


/* ====== add  keywords  details  start ===== */
$("#add_keywords").validate({
     
     rules:{
        add_keywords_name :"required",
        add_keywords_category:"required"
     }
 });

$("#addkeywords").click(function() {
	
	  if(!$("#add_keywords").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_keywords")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/KeywordsController/saveKeywords",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#keywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#keywords-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_keywords')[0].reset();
				setTimeout(function(){
               $('#AddkeywordsModal').modal("hide");
                    }, 5000);	
				viewKeywords();  
				 
			}
			else{
				$('#keywords-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#keywords-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#keywords-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#keywords-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  keywords  details  end ===== */


$(document).on('click', '.keywords_delete a', function(e){
 
 var id= $(this).attr("data-keywordsid");
 var name=$(this).attr("data-keywordsname");

    $.ajax({
    type: "GET",
    url:url+'admin/KeywordsController/deleteKeywordsById/'+id,
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


$("#searchdemokeywordscategory").click(function(){
var search_demo_keyword = $('#search_demo_keyword').val();
 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"admin/KeywordsController/SearchKeywordsList",
    dataType: 'json',
    data:{search_demo_keyword:search_demo_keyword},
    dataType: 'json',

 success: function(result){
      
      if(result.success===true){
           keywordsList(result.data);
    
   }
  else if(result.success===false){
        $('#search_business_website-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_business_website-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_business_keywords-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_business_keywords-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});

});

