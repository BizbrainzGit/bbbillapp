$(document).ready(function(){

viewJobs();   

        function viewJobs(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/JobController/JobList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             JobsList(result.data);
                                 }        
                }
            });
        }

function JobsList(jobslistdata){
	 if ( $.fn.DataTable.isDataTable('#jobtable')) {
				 $('#jobtable').DataTable().destroy();
				 }	
				 $('#jobtable tbody').empty();
				 var data=jobslistdata; 
				 var table = $('#jobtable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'job_title',title: 'Titele'},
		  {data: 'job_content',title: 'Content'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
return '<button class="btn btn-primary btn-md function_edit_job" data-toggle="modal" data-target="#EditJobModal"><a data-jobid="'+data.id+'" data-jobname="' +data.menu_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp; <button class="btn btn-danger btn-md job_delete"><a data-jobid="'+data.id+'" data-jobname="' +data.menu_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
					 } }],
					 columnDefs: [{
		  targets: 3,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
             data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' 
			  }	else{
				  data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>'
			  }			 
          }
        return data;
       }
		 }]
			 });

table.rows.add(data).draw();

         
}




/* ====== add start ===== */
$("#add_job").validate({
     
     rules:{
     	 add_job_skill:"required",
     	 add_job_title :"required",
         add_job_content  :"required",
         add_job_status :"required"
      }
 });

$("#addjob").click(function() {
	  if(!$("#add_job").valid())
	 {   
		 return false;
	 }
    var formData = new FormData( $("#add_job")[0] );
     $.ajax({
      type:"POST",
      url:url+"templateadmin/JobController/saveJob",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
    success: function(result){
	  if(result.success===true){
		    $('#job-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			$( "#job-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
		    $('#add_job')[0].reset();
			 setTimeout(function(){
               $('#AddjobModal').modal("hide");
                    }, 4000);
             viewJobs();          		
				
			}
			else{
				 $('#job-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#job-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#job-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#job-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });

});
/* ====== add  details  end ===== */

/* ====== edit  details  end ===== */

$(document).on('click','.function_edit_job a', function(e){
    var id = $(this).attr('data-jobid');
    $.ajax({
			type:         'GET',
			url:  url+"templateadmin/JobController/jobEditById/" + id,
			dataType:     'json',
	success: function(result){
            if (result.success===true){
		       $('#edit_job #edit_job_id').val(id);
               $('#edit_job #edit_job_title').val(result.data[0].job_title);
               $('#edit_job #edit_job_content').val(result.data[0].job_content);

               var values = result.data[0].job_skill_id;
		       var selectedValues=new Array();
				$.each(values.split(","), function(i,e){
					selectedValues[i]=e;
				   });

		       $("#edit_job_skill").select2().val(selectedValues).trigger('change');

				if(result.data[0].status=='1'){
					$('#edit_job  #edit_active').prop('checked', true); // checked
				}
				else{
					$('#edit_job  #edit_inactive').prop('checked', true);
				}

		       $("#jobimage").html('<img src="'+url+result.data[0].image+ '" width="100px"  height="100px" alt="photo" />');

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


$("#edit_job").validate({
     rules:{
        edit_job_skill:"required",
     	 // edit_job_title :"required",
       //   edit_job_content  :"required",
         edit_job_status :"required",
      }
 });

$("#updatejob").click(function(){

	   if(!$("#edit_job").valid())
	 {   
		 return false;
	 }

	 var formData = new FormData($("#edit_job")[0]);
  $.ajax({
      type:"POST",
      url:url+"templateadmin/JobController/updateJob",
      dataType : 'json',
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
     success: function(result){
			if(result.success===true){
				$('#job-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#job-updatemsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#edit_job')[0].reset();
                
                setTimeout(function(){
               $('#EditJobModal').modal("hide");
                    }, 4000);	
                viewJobs();   

			 }
			else{
				$('#job-updatemsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#job-updatemsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#job-updatemsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#job-updatemsg").html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      
      });


});

/* ====== delete end ===== */

$(document).on('click', '.job_delete a', function(e){
 var id= $(this).attr("data-jobid");
 var name=$(this).attr("data-jobname");
    $.ajax({
    type: "GET",
    url:url+'templateadmin/JobController/deleteJobById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    alert(result.message); 
      viewJobs();   
   
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