$(document).ready(function(){

viewProjects();   

        function viewProjects(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/ProjectController/ProjectList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ProjectsList(result.data);
                                 }        
                }
            });
        }

function ProjectsList(projectslistdata){
	 if ( $.fn.DataTable.isDataTable('#projecttable')) {
				 $('#projecttable').DataTable().destroy();
				 }	
				 $('#projecttable tbody').empty();
				 var data=projectslistdata; 
				 var table = $('#projecttable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'project_type',title: 'Project Type'},
		  {data: 'project_title',title: 'Titele'},
		  {data: 'project_url',title: 'Url'},
		  {data: 'status',title: 'Status',render: getImg},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_project" data-toggle="modal" data-target="#EditProjectModal"><a data-projectid="'+data.id+'" data-projectname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md project_delete"><a data-projectid="'+data.id+'" data-projectname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
	
		 columnDefs: [{
		  targets: 1,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
                    data = 'Our Products' 
			  }else if(data == '2' ){
				  data = 'Client Projects'
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
$("#add_project").validate({
     
     rules:{
     	 add_project_type :"required",
     	 add_project_title :"required",
         add_project_url  :"required",
         add_project_status :"required",
         add_project_image :"required"
      }
 });

$("#addproject").click(function() {
	  if(!$("#add_project").valid())
	 {   
		 return false;
	 }
    var formData = new FormData($("#add_project")[0]);
     $.ajax({
      type:"POST",
      url:url+"templateadmin/ProjectController/saveProject",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success==true){
		    $('#project-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#project-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_project')[0].reset();
			 setTimeout(function(){
               $('#AddprojectModal').modal("hide");
                    }, 4000);
             viewProjects();          		
				
			}
			else{
				 $('#project-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#project-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#project-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#project-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_project a', function(e){
    var id = $(this).attr('data-projectid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/ProjectController/projectEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_project #edit_project_id').val(id);
               $('#edit_project #edit_project_title').val(result.data[0].project_title);
               $('#edit_project #edit_project_url').val(result.data[0].project_url);
               $('#edit_project #edit_project_category').val(result.data[0].project_category);
               $('#edit_project #edit_project_image_alt').val(result.data[0].image_alt);
               $('#edit_project #edit_project_certification_image_alt').val(result.data[0].certification_image_alt);
			   $('#edit_project #edit_project_type').val(result.data[0].project_type).prop('selected',true);

				if(result.data[0].status=='1'){
					$('#edit_project  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_project  #edit_inactive').prop('checked', true);
				}

		       $("#projectimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');

		       if(result.data[0].certification_image !=null){
                 var  certificationimage = '<img src="'+url+result.data[0].certification_image+'" heignt="74px" width="74px" align="center"/>' ;
			  }
			  else{
		        var certificationimage = '<img  src="'+url+'assets/images/no_image.png" heignt="74px" width="74px" align="center"/> ' ;
			  }

			  $("#projectcertificationimage").html(certificationimage);

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


$("#edit_project").validate({
     rules:{
         edit_project_type :"required",
     	 edit_project_title :"required",
         edit_project_url  :"required",
         edit_project_status :"required",
      }
 });

$("#updateproject").click(function(){

	   if(!$("#edit_project").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_project")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/ProjectController/updateProject",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#project-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#project-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_project')[0].reset();
                
                setTimeout(function(){
               $('#EditProjectModal').modal("hide");
                    }, 4000);	
                viewProjects();   

			 }
			else{
				$('#project-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#project-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#project-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#project-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.project_delete a', function(e){
 var id= $(this).attr("data-projectid");
 var name=$(this).attr("data-projectname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/ProjectController/deleteProjectById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewProjects();   
   
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