
// $(function(){
	
// 		 var items="";
// 		 $.getJSON(url+"admin/FeedbackQuestionController/listFeedbackQuestion", function(feedbackquestionList){
// 		  $.each(feedbackquestionList,function(index,itemlist)
// 		 {
// 		 if ( $.fn.DataTable.isDataTable('#feedbackquestiontable')) {
// 				 $('#feedbackquestiontable').DataTable().destroy();
// 				 }	
// 				 $('#feedbackquestiontable tbody').empty();

// 				 var data=itemlist; 
// 				 var table = $('#feedbackquestiontable').DataTable({
				
// 				 paging: true,
// 				 searching: true,
// 				 columns: [
// 		  {data: 'id',title: 'Sno.'},
// 		  {data: 'question',title:'Question'},
// 		  {data: 'value',title:'Option'},
// 		  {data: 'status',title:'Status',render: getImg},
// 		  //{data: 'status',title:'Status'},
// 		  {data: null,
// 					 'title' : 'Action',
// 					 "sClass" : "center",
// 					 mRender: function (data, type, row) {
//     return '<button class="btn btn-primary btn-sm feedbackquestiondata_edit" data-toggle="modal" id="feedbackquestiondata_edit" data-target="#EditfeedbackquestionModal"><a data-feedbackquestionid="'+data.id+'" data-feedbackquestionname="' +data.question+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;<button class="btn btn-danger btn-sm feedbackquestion_delete"><a data-feedbackquestionid="'+data.id+'" data-feedbackquestionname="' +data.question+ '"  data-feedbackoptionid="'+data.optionid+'" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
// 					 } }],

// 				 columnDefs: [{
//          targets: 2,
//          render: function(data, type, full, meta){
// 		  if(type === 'display'){
// 			  if(data == '1' ){
//              //data = '<img id="active" src="'+url+'assets/images/active.png" heignt="32px" width="32px" align="center"/>' 
//              data='Yes'
// 			  }	else{
				
//                   data='No'   
// 				  //data = '<img id="inactive" src="'+url+'assets/images/inactive.png" heignt="32px" width="32px" align="center"/>'
// 			  }			 
//           }

//           return data;
//        }
// 		 }]

// 			 });

// table.rows.add(data).draw();

 
		 
// 		  });	
// });	
//  });

// function getImg(data, type, full, meta) {

//            if(data == '1'){
//             data = '<img id="active" src="'+url+'assets/images/active.png" heignt="32px" width="32px" align="center"/>' ;
// 			  }
// 			  else{
// 		   data = '<img id="inactive" src="'+url+'assets/images/inactive.png" heignt="32px" width="32px" align="center"/>' ;
// 			  }

//        return data;
//     }

$(document).ready(function(){  


view_feedbackquestion();   

        function view_feedbackquestion(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/FeedbackQuestionController/listFeedbackQuestion",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#feedbackquestiontable')) {
				 $('#feedbackquestiontable').DataTable().destroy();
				 }	
				 $('#feedbackquestiontable tbody').empty();

				 var data=result.data;
				 var table = $('#feedbackquestiontable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Sno.'},
		  {data: 'question',title:'Question'},
		  {data: 'value',title:'Option'},
		  {data: 'status',title:'Status',render: getImg},
		  //{data: 'status',title:'Status'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm feedbackquestiondata_edit" data-toggle="modal" id="feedbackquestiondata_edit" data-target="#EditfeedbackquestionModal"><a data-feedbackquestionid="'+data.id+'" data-feedbackquestionname="' +data.question+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm feedbackquestion_delete"><a data-feedbackquestionid="'+data.id+'" data-feedbackquestionname="' +data.question+ '"  data-feedbackoptionid="'+data.optionid+'" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],

				 columnDefs: [{
         targets: 2,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  if(data == '1' ){
             //data = '<img id="active" src="'+url+'assets/images/active.png" heignt="32px" width="32px" align="center"/>' 
             data='Yes'
			  }	else{
				
                  data='No'   
				  //data = '<img id="inactive" src="'+url+'assets/images/inactive.png" heignt="32px" width="32px" align="center"/>'
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

function getImg(data, type, full, meta) {

           if(data == '1'){
            data = '<img id="active" src="'+url+Active_Image_Path+'" heignt="32px" width="32px" align="center"/>' ;
			  }
			  else{
		   data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" width="32px" align="center"/>' ;
			  }

       return data;
    }

/* ======  feedbackquestion  Table  edit  start ===== */

 $(document).on('click', '.feedbackquestiondata_edit a', function(e){
 
 var id= $(this).attr("data-feedbackquestionid");


 $.ajax({
    type: "GET",
    url:url+'admin/FeedbackQuestionController/editFeedbackquestionByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
       
        $('#edit_feedbackquestion #edit_feedbackquestion_id').val(result.data[0].id);
        $('#edit_feedbackquestion #edit_feedbackoption_id').val(result.data[0].optionid);

        $('#edit_feedbackquestion #edit_feedback_question').val(result.data[0].question);
      
      if(result.data[0].value=='1'){
			$('#edit_feedbackquestion  #edit_yes').prop('checked', true); // checked
		}
		else{
			$('#edit_feedbackquestion  #edit_no').prop('checked', true);
		}


      if(result.data[0].status=='1'){
			$('#edit_feedbackquestion  #edit_active').prop('checked', true); // checked
		}
		else{
			$('#edit_feedbackquestion  #edit_inactive').prop('checked', true);
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



/* ======  feedbackquestion  Table  edit  end ===== */


/* ======  feedbackquestion  Table  update  start ===== */

$("#edit_feedbackquestion").validate({
     
     rules:{
         edit_feedback_question :"required",
        edit_feedback_option :"required",
        edit_feedback_status :"required",
      
     }
 });

 $("#updatefeedbackquestion").click(function(){

	  if(!$("#edit_feedbackquestion").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_feedbackquestion")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/FeedbackQuestionController/updateFeedbackquestionByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
			
				$('#feedbackquestion-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#feedbackquestion-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_feedbackquestion")[0].reset();
            setTimeout(function(){
               $('#EditfeedbackquestionModal').modal('hide');
                }, 5000); 

       view_feedbackquestion();     
			

   }
	else if(result.success===false){
				$('#feedbackquestion-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#feedbackquestion-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#feedbackquestion-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#feedbackquestion-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  feedbackquestion  Table  update  end ===== */


/* ====== add  feedbackquestion  details  start ===== */
$("#add_feedbackquestion").validate({
     
     rules:{
        add_feedback_question :"required",
        add_feedback_option :"required",
        add_feedback_status :"required",
     }
 });

$("#addfeedbackquestion").click(function() {
	
	  if(!$("#add_feedbackquestion").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_feedbackquestion")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/FeedbackQuestionController/saveFeedbackQuestion",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#feedbackquestion-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#feedbackquestion-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_feedbackquestion')[0].reset();
				setTimeout(function(){
               $('#AddfeedbackquestionModal').modal("hide");
                    }, 5000);	

				view_feedbackquestion();
				 
			}
			else if(result.success===false){
				$('#feedbackquestion-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#feedbackquestion-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#feedbackquestion-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#feedbackquestion-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  feedbackquestion  details  end ===== */


$(document).on('click', '.feedbackquestion_delete a', function(e){
 
 var delete_feedbackquestion_id= $(this).attr("data-feedbackquestionid");
 var delete_feedbackoption_id= $(this).attr("data-feedbackoptionid");
 var name=$(this).attr("data-feedbackquestionname");
    $.ajax({
    type: "POST",
    url:url+'admin/FeedbackQuestionController/deleteFeedbackquestionById',
    dataType: 'json',
    data:{delete_feedbackoption_id:delete_feedbackoption_id,delete_feedbackquestion_id:delete_feedbackquestion_id},
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    view_feedbackquestion();

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

