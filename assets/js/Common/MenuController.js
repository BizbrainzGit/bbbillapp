$(document).ready(function(){

viewMenus();   

        function viewMenus(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/MenuController/MenusList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             menusList(result.data);
                                 }        
                }
            });
        }

function menusList(menuslistdata){

	 if ( $.fn.DataTable.isDataTable('#menustable')) {
				 $('#menustable').DataTable().destroy();
				 }	
				 $('#menustable tbody').empty();

				 var data=menuslistdata; 
				 var table = $('#menustable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'menu_name',title:'Menu Name'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm menusdata_edit" data-toggle="modal" id="menusdata_edit" data-target="#EditMenusModal"><a data-menusid="'+data.id+'" data-menusname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp;<button class="btn btn-danger btn-sm menus_delete"><a data-menusid="'+data.id+'" data-menusname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
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


/* ======  menus  Table  edit  start ===== */

 $(document).on('click', '.menusdata_edit a', function(e){
 
 var id= $(this).attr("data-menusid");


 $.ajax({
    type: "GET",
    url:url+'templateadmin/MenuController/editMenusByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_menu #edit_menu_id').val(result.data[0].id);
        $('#edit_menu #edit_menu_name').val(result.data[0].menu_name);
        $('#edit_menu #edit_menu_urlname').val(result.data[0].menu_urlname);
        $('#edit_menu #edit_menu_titletag').val(result.data[0].menu_titletag);
        $('#edit_menu #edit_menu_metakeyword').val(result.data[0].menu_metakeyword);
        $('#edit_menu #edit_menu_metadescription').val(result.data[0].menu_metadescription);
        
        if(result.data[0].status=='1'){
                $('#edit_menu  #edit_active').prop('checked', true); // checked
              }
          else{
              $('#edit_menu  #edit_inactive').prop('checked', true);
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



/* ======  menus  Table  edit  end ===== */


/* ======  menus  Table  update  start ===== */

$("#edit_menu").validate({
     
     rules:{
        edit_menu_name :"required",
        edit_menu_status:"required"
     }
 });

 $("#updatemenus").click(function(){

	  if(!$("#edit_menu").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_menu")[0] );
   $.ajax({
       type:"POST",
       url:url+"templateadmin/MenuController/updateMenusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				  $('#menus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#menus-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_menu")[0].reset();
            setTimeout(function(){
               $('#EditMenusModal').modal('hide');
                }, 5000); 
			viewMenus();  

   }
	else if(result.success===false){
				$('#menus-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#menus-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#menus-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#menus-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  menus  Table  update  end ===== */


/* ====== add  menus  details  start ===== */
$("#add_menu").validate({
     
     rules:{
        add_menu_name :"required",
        add_menu_status:"required"
     }
 });

$("#addmenus").click(function() {
	
	  if(!$("#add_menu").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_menu")[0] );
     $.ajax({
      type:"POST",
    url:url+"templateadmin/MenuController/saveMenus",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			if(result.success==true){
				$('#menus-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#menus-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_menu')[0].reset();
				setTimeout(function(){
               $('#AddMenusModal').modal("hide");
                    }, 5000);	
				viewMenus();  
				 
			}
			else{
				$('#menus-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#menus-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){
			$('#menus-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$("#menus-addmsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });


});
/* ====== add  menus  details  end ===== */

$(document).on('click', '.menus_delete a', function(e){
 var id= $(this).attr("data-menusid");
 var name=$(this).attr("data-menusname");

    $.ajax({
    type: "GET",
    url:url+'templateadmin/MenuController/deleteMenusById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
     alert("<div class='alert alert-success'>"+result.message+"</div>"); 
    viewMenus();  
   
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

