var url=base_url.baseurl;
$(document).ready(function(){

 viewleadsLis();   
        function viewleadsLis(){
            $.ajax({
                type  : 'GET',
                url   : url+"LeadsController/leadslist",
                async : true,
                dataType : 'json',
                success : function(result){
                     if(result.success==true){
                          leadsListview(result.data);
                       }        
                }
            });
        }

function leadsListview(leadsListdata){

if ( $.fn.DataTable.isDataTable('#leadstable')) {
         $('#leadstable').DataTable().destroy();
         }  
         $('#leadstable tbody').empty();

         var data=leadsListdata;
         var table = $('#leadstable').DataTable({
        
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'Sno.'},
      {data: 'name',title:'Name'},
      {data: 'email',title:'E-Mail'},
      {data: 'phone_number',title:'Mobile Number'},
      {data: 'bussiness_name',title:'Bussiness'},
      {data: 'message',title:'Message'},
      {data: 'employeename',title:'Updated By'},
      {data: 'modified_on',title:'Updated On'},
      {data: 'status',title:'Status'}, 
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           mRender: function (data, type, row) {
    return '<button class="btn btn-info btn-sm mt-2 prospect_status_edit" data-toggle="modal" id="prospect_status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button>'
           } }],
                 columnDefs: [{
         targets: 8,
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
$('[data-toggle="modal"]').tooltip();



$(document).on('click', '.prospect_status_edit a', function(e){
 
 var id= $(this).attr("data-businessid");

 $.ajax({
    type: "GET",
    url:url+'LeadsController/editStatusByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
        
        $('#status_change_form #prospect_status_id').val(id);
        $('#status_change_form #prospect_status_change').val(result.data[0].status).prop("selected", true);
    
       }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});

$("#prospectupdatestatus").click(function(){
  // alert("hhh");

    if(!$("#status_change_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#status_change_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"LeadsController/updateStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
      
      if(result.success===true){
      
        $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $("#citymapping-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#status_change_form")[0].reset();
            setTimeout(function(){
               $('#EditstatusModal').modal('hide');
                }, 5000); 

       viewleadsLis();

   }
  else if(result.success===false){
        $('#citymapping-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#citymapping-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#citymapping-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});

/* ====== add  citymapping  details  start ===== */
$("#add_leads").validate({
     
     rules:{
        add_lead_name :"required",
        add_lead_mobileno :{required:true,number:true,minlength:10, maxlength:10},
        
      
     }
 });

$("#addleads").click(function() {

	  if(!$("#add_leads").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_leads")[0] );
     $.ajax({
      type:"POST",
    url:url+"LeadsController/saveLeads",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			if(result.success==true){
				$('#leads-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			  $( "#leads-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_leads')[0].reset();
				 
			}
			else if(result.success===false){
				$('#leads-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#leads-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#leads-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#leads-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	

            
      });


});
/* ====== add  citymapping  details  end ===== */


}); // document ready 

