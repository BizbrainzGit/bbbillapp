
// $(function(){
	
// 		 var items="";
// 		 $.getJSON(url+"admin/CampaignController/listCampaign", function(campaignList){
// 		  $.each(campaignList,function(index,itemlist)
// 		 {
// 		 if ( $.fn.DataTable.isDataTable('#campaigntable')) {
// 				 $('#campaigntable').DataTable().destroy();
// 				 }	
// 				 $('#campaigntable tbody').empty();

// 				 var data=itemlist; 
// 				 var table = $('#campaigntable').DataTable({
				
// 				 paging: true,
// 				 searching: true,
// 				 columns: [
// 		  {data: 'id',title: 'Id.'},
// 		  {data: 'campaign_name',title:'Campaign Name'},
// 		  {data: 'campaign_amount',title:'Amount'},
// 		  {data: null,
// 					 'title' : 'Action',
// 					 "sClass" : "center",
// 					 mRender: function (data, type, row) {
//     return '<button class="btn btn-primary btn-sm campaigndata_edit" data-toggle="modal" id="campaigndata_edit" data-target="#EditcampaignModal"><a data-campaignid="'+data.id+'" data-campaignname="' +data.campaign_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;<button class="btn btn-danger btn-sm campaign_delete"><a data-campaignid="'+data.id+'" data-campaignname="' +data.campaign_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;'
// 					 } }]

	

// 			 });

// table.rows.add(data).draw();

 
		 
// 		  });	
// });	
//  });



$(document).ready(function(){

view_campaign();   

        function view_campaign(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/CampaignController/listCampaign",
                async : true,
                dataType : 'json',
                success : function(result){
         if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#campaigntable')) {
				 $('#campaigntable').DataTable().destroy();
				 }	
				 $('#campaigntable tbody').empty();

				 var data=result.data; 
				 var table = $('#campaigntable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'Id.'},
		  {data: 'campaign_name',title:'Campaign Name'},
		  {data: 'campaign_photo',title:'Campaign Photo'},
		  {data: 'campaign_amount',title:'Amount'},
		  {data: 'status',title:'Status',render: getImg},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm campaigndata_edit" data-toggle="modal" id="campaigndata_edit" data-target="#EditcampaignModal"><a data-campaignid="'+data.id+'" data-campaignname="' +data.campaign_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    // <button class="btn btn-danger btn-sm campaign_delete"><a data-campaignid="'+data.id+'" data-campaignname="' +data.campaign_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }],
		 columnDefs: [{
         targets: 2,
         render: function(data, type, full, meta){
		  if(type === 'display'){
			  
             data = '<img id="active" src="'+url+data+'" style="height:100px;width:100px;align:center;" />' 
			  		 
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
		   data = '<img id="inactive" src="'+url+Inactive_Image_Path+'" heignt="32px" width="32px" align="center"/>' ;
			  }

       return data;
    }
/* ======  campaign  Table  edit  start ===== */

 $(document).on('click', '.campaigndata_edit a', function(e){
 
 var id= $(this).attr("data-campaignid");


 $.ajax({
    type: "GET",
    url:url+'admin/CampaignController/editCampaignByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_campaignname_head').html(result.data[0].campaign_name);  
        $('#edit_campaign #edit_campaign_id').val(result.data[0].id);
        $('#edit_campaign #edit_campaign_name').val(result.data[0].campaign_name);
         $('#edit_campaign #edit_campaign_amount').val(result.data[0].campaign_amount);
         $('#edit_campaign #edit_campaign_status').val(result.data[0].status); 
  //       if(result.data[0].campaign_status=='1'){
		// 	$('#edit_campaign  #edit_campaign_active').prop('checked', true); // checked
		// }
		// else{
		// 	$('#edit_campaign  #edit_campaign_inactive').prop('checked', true);
		// }
	$("#image").html('<img src="'+url+result.data[0].campaign_photo+ '" width="200px"  height="100px" alt=" photo" />');
	   
		

      }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  campaign  Table  edit  end ===== */


/* ======  campaign  Table  update  start ===== */

$("#edit_campaign").validate({
     
     rules:{
        edit_campaign_name :"required",
        edit_campaign_amount:"required"
     }
 });

 $("#updatecampaign").click(function(){

	  if(!$("#edit_campaign").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_campaign")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/CampaignController/updateCampaignByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#campaign-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#campaign-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_campaign")[0].reset();
            setTimeout(function(){
               $('#EditcampaignModal').modal('hide');
                }, 5000); 
		view_campaign(); 	

   }
	else if(result.success===false){
				$('#campaign-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#campaign-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#campaign-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#campaign-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ======  campaign  Table  update  end ===== */


/* ====== add  campaign  details  start ===== */
$("#add_campaign").validate({
     
     rules:{
        add_campaign_name :"required",
        add_campaign_photo :"required",
        add_campaign_amount:"required"
     }
 });

$("#addcampaign").click(function() {
	
	  if(!$("#add_campaign").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_campaign")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/CampaignController/saveCampaign",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#campaign-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#campaign-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_campaign')[0].reset();
				setTimeout(function(){
               $('#AddcampaignModal').modal("hide");
                    }, 5000);	
				view_campaign(); 
				 
			}
			else{
				$('#campaign-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#campaign-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#campaign-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#campaign-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  campaign  details  end ===== */


$(document).on('click', '.campaign_delete a', function(e){
 
 var id= $(this).attr("data-campaignid");
 var name=$(this).attr("data-campaignname");

    $.ajax({
    type: "GET",
    url:url+'admin/CampaignController/deleteCampaignById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 
    view_campaign(); 
   
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

