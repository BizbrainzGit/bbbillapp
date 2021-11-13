


$(document).ready(function(){

view_paymenttypes();  
 
        function view_paymenttypes(){
            $.ajax({
                type  : 'GET',
                url   : url+"admin/PaymentTypesController/listPaymentTypes",
                async : true,
                dataType : 'json',
                success : function(result){
if(result.success===true){

  if ( $.fn.DataTable.isDataTable('#paymenttypestable')) {
				 $('#paymenttypestable').DataTable().destroy();
				 }	
				 $('#paymenttypestable tbody').empty();

				 var data=result.data; 
				 var table = $('#paymenttypestable').DataTable({
				
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S No.'},
		  {data: 'paymenttype_name',title:'Payment Type'},
		  {data: null,
					 'title' : 'Action',
					 "sClass" : "center",
					 mRender: function (data, type, row) {
    return '<button class="btn btn-primary btn-sm paymenttypedata_edit" data-toggle="modal" id="paymenttypedata_edit" data-target="#EditpaymenttypeModal"><a data-paymenttypeid="'+data.id+'" data-paymenttypename="' +data.paymenttype_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-grease-pencil"></i></a></button>&nbsp;'
    //<button class="btn btn-danger btn-sm paymenttype_delete"><a data-paymenttypeid="'+data.id+'" data-paymenttypename="' +data.paymenttype_name+ '" style="color:#FFFFFF;"> <i class="mdi mdi-delete"></i> </a></button>&nbsp;
					 } }]

	

			 });

table.rows.add(data).draw();
         
  }        
                }
            });
        }




/* ====== Payment Mode  Table  edit  start ===== */

 $(document).on('click', '.paymenttypedata_edit a', function(e){
 
 var id= $(this).attr("data-paymenttypeid");


 $.ajax({
    type: "GET",
    url:url+'admin/PaymentTypesController/editPaymenttypeByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
      
        $('#edit_paymenttype_head').html(result.data[0].paymenttype_name);  
        $('#edit_paymenttype #edit_paymenttype_id').val(result.data[0].id);
        $('#edit_paymenttype #edit_paymenttype').val(result.data[0].paymenttype_name);
         

        }else{
            alert('request failed', 'error');
      }

    },
   
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});

});



/* ======  Payment Mode Table  edit  end ===== */


/* ====== Update Payment Mode  Table start ===== */

$("#edit_paymenttype").validate({
     
     rules:{
        edit_paymenttype :"required",
       }
 });

 $("#updatepaymenttype").click(function(){

	  if(!$("#edit_paymenttype").valid())
	 {
		 return false;
	 }
	
	var formData = new FormData($("#edit_paymenttype")[0] );
   $.ajax({
       type:"POST",
       url:url+"admin/PaymentTypesController/updatePaymenttypeByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
			
			if(result.success===true){
				
		       
				$('#paymenttype-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $("#paymenttype-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

			     $("#edit_paymenttype")[0].reset();
            setTimeout(function(){
               $('#EditpaymenttypeModal').modal('hide');
                }, 5000); 

            view_paymenttypes();   
			

   }
	else if(result.success===false){
				$('#paymenttype-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#paymenttype-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#paymenttype-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#paymenttype-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
         
      });


});

/* ====== Update Payment Mode  end ===== */


/* ====== add  Payment Mode  start ===== */
$("#add_paymenttype").validate({
     
     rules:{
        add_paymenttype :"required",
        
     }
 });

$("#addpaymenttype").click(function() {
	
	  if(!$("#add_paymenttype").valid())
	 {
		 return false;
	 }
	
   var formData = new FormData($("#add_paymenttype")[0] );
     $.ajax({
      type:"POST",
    url:url+"admin/PaymentTypesController/savePaymentType",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,


      success: function(result){
			
			if(result.success==true){
				$('#paymenttype-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#paymenttype-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
				$('#add_paymenttype')[0].reset();
				setTimeout(function(){
               $('#AddpaymenttypesModal').modal("hide");
                    }, 5000);	

				view_paymenttypes();   
				 
			}
			else{
				$('#paymenttype-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#paymenttype-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
	  
		failure: function (result){

			$('#paymenttype-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#paymenttype-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	




            
      });


});
/* ====== add  Payment Mode  end ===== */

/* ====== delete  Payment Mode  start ===== */
$(document).on('click', '.paymenttype_delete a', function(e){
 
 var id= $(this).attr("data-paymenttypeid");
 var name=$(this).attr("data-paymenttypename");

    $.ajax({
    type: "GET",
    url:url+'admin/PaymentTypesController/deletePaymenttypeById/'+id,
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    
    swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success"); 

    view_paymenttypes();   
   
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});


 

});


/* ====== delete  Payment Mode details  end ===== */



});

