
$(document).ready(function(){

viewDemowebsites();   

        function viewDemowebsites(){
            $.ajax({
                type  : 'GET',
                url   : url+"DemoWebsitesController/SearchDemoWebsitesList",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success==true){

 		 Demowebsiteslist(result.data);
         
  }        
                }
            });
        }
function Demowebsiteslist(Demowebsiteslistdata){

	if ( $.fn.DataTable.isDataTable('#demowebsitestable')) {
				 $('#demowebsitestable').DataTable().destroy();
				 }	
				 $('#demowebsitestable tbody').empty();

				 var data=Demowebsiteslistdata; 
				 var table = $('#demowebsitestable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'category_name',title:'Category Name'},
		  {data: 'web_name',title:'Website Name'},
      {data: 'employee_name',title:'Employee Name'},
      {data: 'created_datetime',title:'Created Date'},
      {data: 'web_status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm demowebsitesdata_edit" data-toggle="modal" id="demowebsitesdata_edit" data-target="#EditdemowebsitesModal"><a data-demowebsitesid="'+data.id+'" data-demowebsitesname="' +data.web_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    // <button class="btn btn-danger btn-sm demowebsites_delete"><a data-demowebsitesid="'+data.id+'" data-demowebsitesname="' +data.web_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
           columnDefs: [{
      targets: 5,
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


/* ======  demowebsites  Table  edit  start ===== */

 $(document).on('click', '.demowebsitesdata_edit a', function(e){
 
 var id= $(this).attr("data-demowebsitesid");

 $.ajax({
    type: "GET",
    url:url+'DemoWebsitesController/editDemowebsitesByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
      
        $('#edit_demowebsites #edit_demowebsites_id').val(result.data[0].id);
        $('#edit_demowebsites #edit_demowebsites_name').val(result.data[0].web_name);
        $('#edit_demowebsites #edit_demowebsites_url').val(result.data[0].web_url);
        $('#edit_demowebsites #edit_demowebsites_category').val(result.data[0].category_id).prop('selected',true);
	    $("#demowebsites_image").html('<img src="'+url+result.data[0].web_photo+ '" width="200px"  height="100px" alt=" photo" />');
	   
		

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  demowebsites  Table  edit  end ===== */


/* ======  demowebsites  Table  update  start ===== */

$("#edit_demowebsites").validate({
     
     rules:{
        edit_demowebsites_name :"required",
        edit_demowebsites_url:"required"
     }
 });

 $("#updatedemowebsites").click(function(){

	  if(!$("#edit_demowebsites").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_demowebsites")[0] );
   $.ajax({
       type:"POST",
       url:url+"DemoWebsitesController/updateDemowebsitesByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#demowebsites-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#demowebsites-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_demowebsites")[0].reset();
            setTimeout(function(){
               $('#EditdemowebsitesModal').modal('hide');
                }, 5000); 
		viewDemowebsites();  

   }
	else if(result.success===false){
				$('#demowebsites-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#demowebsites-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#demowebsites-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#demowebsites-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  demowebsites  Table  update  end ===== */


/* ====== add  demowebsites  details  start ===== */
$("#add_demowebsites").validate({
     
     rules:{
        add_demowebsites_name :"required",
        add_demowebsites_photo :"required",
        add_demowebsites_url:"required"
     }
 });

$("#adddemowebsites").click(function() {
	
	  if(!$("#add_demowebsites").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_demowebsites")[0] );
     $.ajax({
      type:"POST",
    url:url+"DemoWebsitesController/saveDemowebsites",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#demowebsites-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#demowebsites-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_demowebsites')[0].reset();
				setTimeout(function(){
               $('#AdddemowebsitesModal').modal("hide");
                    }, 5000);	
		     viewDemowebsites();  

			}
			else{
				$('#demowebsites-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#demowebsites-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#demowebsites-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#demowebsites-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  demowebsites  details  end ===== */


$(document).on('click', '.demowebsites_delete a', function(e){
 
 var id= $(this).attr("data-demowebsitesid");
 var name=$(this).attr("data-demowebsitesname");

    $.ajax({
    type: "GET",
    url:url+'DemoWebsitesController/deleteDemowebsitesById/'+id,
    dataType: 'json',
 beforeSend:function(){
         return confirm("Are you sure? You want to delete "+name+" ");
      },   
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    viewDemowebsites();  
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});


/* ======  delete end ===== */

$("#searchdemowebcategory").click(function(){
var search_demo_website = $('#search_demo_website').val();
 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"DemoWebsitesController/SearchDemoWebsitesList",
    dataType: 'json',
    data:{search_demo_website:search_demo_website},
    dataType: 'json',

 success: function(result){

      if(result.success===true){
      Demowebsiteslist(result.data);
   }
  else if(result.success===false){
        alert('request failed', 'error');
      }
    },
    
    failure: function (result){
      alert('request failed', 'error');      
    } 
         
      });


});


});

