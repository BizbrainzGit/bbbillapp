$(document).ready(function(){

viewJobSkills();   

        function viewJobSkills(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/JobSkillController/JobSkillsList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             jobskillsList(result.data);
                                 }        
                }
            });
        }

function jobskillsList(jobskillslistdata){

	 if ( $.fn.DataTable.isDataTable('#jobskillstable')) {
				 $('#jobskillstable').DataTable().destroy();
				 }	
				 $('#jobskillstable tbody').empty();

				 var data=jobskillslistdata; 
				 var table = $('#jobskillstable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'jobskill_name',title:'JobSkill Name'},
		  {data: 'status',title: 'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm jobskillsdata_edit" data-toggle="modal" id="jobskillsdata_edit" data-target="#EditJobSkillsModal"><a data-jobskillsid="'+data.id+'" data-jobskillsname="' +data.jobskill_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i>Edit</a></button>&nbsp;<button class="btn btn-danger btn-sm jobskills_delete"><a data-jobskillsid="'+data.id+'" data-jobskillsname="' +data.jobskill_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i>Delete</a></button>&nbsp;'
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


/* ======  jobskills  Table  edit  start ===== */

 $(document).on('click', '.jobskillsdata_edit a', function(e){
 
 var id= $(this).attr("data-jobskillsid");


 $.ajax({
    type: "GET",
    url:url+'templateadmin/JobSkillController/editJobSkillsByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_jobskill #edit_jobskill_id').val(result.data[0].id);
        $('#edit_jobskill #edit_jobskill_name').val(result.data[0].jobskill_name);
        if(result.data[0].status=='1'){
                $('#edit_jobskill  #edit_active').prop('checked', true); // checked
              }
          else{
              $('#edit_jobskill  #edit_inactive').prop('checked', true);
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



/* ======  jobskills  Table  edit  end ===== */


/* ======  jobskills  Table  update  start ===== */

$("#edit_jobskill").validate({
     
     rules:{
        edit_jobskill_name :"required",
        edit_jobskill_status:"required"
     }
 });

 $("#updatejobskills").click(function(){

	  if(!$("#edit_jobskill").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_jobskill")[0] );
   $.ajax({
       type:"POST",
       url:url+"templateadmin/JobSkillController/updateJobSkillsByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#jobskills-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#jobskills-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_jobskill")[0].reset();
            setTimeout(function(){
               $('#EditJobSkillsModal').modal('hide');
                }, 5000); 
			viewJobSkills();  

   }
	else if(result.success===false){
				$('#jobskills-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#jobskills-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#jobskills-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#jobskills-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  jobskills  Table  update  end ===== */


/* ====== add  jobskills  details  start ===== */
$("#add_jobskill").validate({
     
     rules:{
        add_jobskill_name :"required",
        add_jobskill_status:"required"
     }
 });

$("#addjobskills").click(function() {
	
	  if(!$("#add_jobskill").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_jobskill")[0] );
     $.ajax({
      type:"POST",
    url:url+"templateadmin/JobSkillController/saveJobSkills",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			if(result.success==true){
				$('#jobskills-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#jobskills-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_jobskill')[0].reset();
				setTimeout(function(){
               $('#AddJobSkillsModal').modal("hide");
                    }, 5000);	
				viewJobSkills();  
				 
			}
			else{
				$('#jobskills-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#jobskills-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){
			$('#jobskills-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#jobskills-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });


});
/* ====== add  jobskills  details  end ===== */

$(document).on('click', '.jobskills_delete a', function(e){
 var id= $(this).attr("data-jobskillsid");
 var name=$(this).attr("data-jobskillsname");

    $.ajax({
    type: "GET",
    url:url+'templateadmin/JobSkillController/deleteJobSkillsById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
      alert(result.message); 
      viewJobSkills();  
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

