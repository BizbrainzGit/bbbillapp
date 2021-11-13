
$(document).ready(function(){

viewCountLists();   

        function viewCountLists(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/CountListController/CountListList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             CountListsList(result.data);
                                 }        
                }
            });
        }

function CountListsList(countlistslistdata){
	 if ( $.fn.DataTable.isDataTable('#countlisttable')) {
				 $('#countlisttable').DataTable().destroy();
				 }	
				 $('#countlisttable tbody').empty();
				 var data=countlistslistdata; 
				 var table = $('#countlisttable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'establishedyear',title: 'Established Year'},
		  {data: 'projectcount',title: 'Projects Count'},
		  {data: 'clientcount',title: 'Client Count'},
		  {data: 'teamcount',title: 'Team Count'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_countlist" data-toggle="modal" data-target="#EditCountListModal"><a data-countlistid="'+data.id+'" data-countlistname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md countlist_delete"><a data-countlistid="'+data.id+'" data-countlistname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
	
		 columnDefs: [{
		  targets: 5,
         render: function(data, type, full, meta){
		  if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
			  }	else{
				  data ='<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }

       return data;
       }
		 }]
		
			 });
table.rows.add(data).draw();

         
}



/* ====== add start ===== */
$("#add_countlist").validate({
     
     rules:{
     	 add_countlist_establishedyear :"required",
     	 add_countlist_clientcount :"required",
         add_countlist_projectcount  :"required",
         add_countlist_status :"required",
         add_countlist_teamcount :"required"
      }
 });

$("#addcountlist").click(function() {
	  if(!$("#add_countlist").valid())
	 {   
		 return false;
	 }
    var formData = new FormData($("#add_countlist")[0]);
     $.ajax({
      type:"POST",
      url:url+"templateadmin/CountListController/saveCountList",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success==true){
		    $('#countlist-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#countlist-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_countlist')[0].reset();
			 setTimeout(function(){
               $('#AddcountlistModal').modal("hide");
                    }, 4000);
             viewCountLists();          		
				
			}
			else{
				 $('#countlist-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#countlist-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#countlist-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#countlist-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_countlist a', function(e){
    var id = $(this).attr('data-countlistid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/CountListController/countlistEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
            	
		       $('#edit_countlist #edit_countlist_id').val(id);
               $('#edit_countlist #edit_countlist_clientcount').val(result.data[0].clientcount);
               $('#edit_countlist #edit_countlist_projectcount').val(result.data[0].projectcount);
			   $('#edit_countlist #edit_countlist_establishedyear').val(result.data[0].establishedyear);
			   $('#edit_countlist #edit_countlist_teamcount').val(result.data[0].teamcount);

				if(result.data[0].status=='1'){
					$('#edit_countlist  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_countlist  #edit_inactive').prop('checked', true);
				}

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


$("#edit_countlist").validate({
     rules:{
         edit_countlist_establishedyear :"required",
     	 edit_countlist_clientcount :"required",
         edit_countlist_projectcount  :"required",
         edit_countlist_status :"required",
      }
 });

$("#updatecountlist").click(function(){

	   if(!$("#edit_countlist").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_countlist")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/CountListController/updateCountList",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#countlist-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#countlist-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_countlist')[0].reset();
                
                setTimeout(function(){
               $('#EditCountListModal').modal("hide");
                    }, 4000);	
                viewCountLists();   

			 }
			else{
				$('#countlist-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#countlist-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#countlist-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#countlist-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.countlist_delete a', function(e){
 var id= $(this).attr("data-countlistid");
 var name=$(this).attr("data-countlistname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/CountListController/deleteCountListById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewCountLists();   
   
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