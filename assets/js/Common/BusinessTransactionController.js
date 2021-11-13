
$(document).ready(function(){
viewBusinessTransaction();   
        function viewBusinessTransaction(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessTransactionController/listofBusinessTransactions",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
         var role=result.role; 
        viewBusinessTransactionList(result.data,role);
               }        
                }
            });
        }

 function viewBusinessTransactionList(businesslist,role){
         // var role=result.role; 
         if ( $.fn.DataTable.isDataTable('#businesstransactionstable')) {
         $('#businesstransactionstable').DataTable().destroy();
         }  
         $('#businesstransactionstable tbody').empty();
         var data=businesslist; 
         var table = $('#businesstransactionstable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'Sno'},
      {data: 'company_name_id',title:'Company Name & Id'},
      {data: 'person_name_mobile',title: 'Person Name & Mobile No'},
      // {data: 'cityname',title: 'City Name'},
      {data: 'package_name',title: 'Package Name'},
      {data: 'campaign_name',title:'Compain Name'},
      {data: 'gstgrand_total_amount',title:'Package Grand <br> Total Amount'},
      {data: 'created_on',title:'Transaction Date'},
      {data: 'transaction_amount',title:'Transaction Amount'},
      {data: 'transaction_status',title:'Transaction Status'},
      {data: 'paymenttype_name',title:'Payment Method'}, 
      {data: 'employeename',title:'Enter By'},
      // {data: 'status',title:'Project Status'},
      {data: null,
          'title' : 'Action',
          "sClass" : "center",
          mRender: function (data, type, row) {

              if(role=="Admin"){
               return '<button class="btn btn-info btn-sm mt-2 businesstransactions_details" data-toggle="modal" id="businesstransactions_details" data-target="#businesstransactionsModal" title="Payment Details"><a data-businesstransactionid="'+data.id+'"  style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp; ' 
             }else if(role=="Accountant"){
                    
                    return '<button class="btn btn-info btn-sm mt-2 businesstransactions_details" data-toggle="modal" id="businesstransactions_details" data-target="#businesstransactionsModal" title="Payment Details"><a data-businesstransactionid="'+data.id+'"  style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp; '
             }else{

              return ' '
             }


        } }
     ]
 });
table.rows.add(data).draw();
 }

$('[data-toggle="modal"]').tooltip();



 $(document).on('click', '.businesstransactions_details a', function(e){
 
 var id= $(this).attr("data-businesstransactionid");
 $.ajax({
    type: "GET",
    url:url+'BusinessTransactionController/BusinessTransactionDataByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 
        // alert(result.data);

        $('#add_businesstransaction_cheque_approval #businesstransaction_approval_id').val(result.data[0].id);
        
         $('#businesstransaction_company_name').html(result.data[0].company_name);
        $('#businesstransaction_campains').html(result.data[0].campaign_name);
        $('#businesstransaction_packages').html(result.data[0].package_name);
        $('#businesstransaction_grandtotal').html(result.data[0].gstgrand_total_amount);

        $('#businesstransaction_date').html(result.data[0].created_on);
        $('#businesstransaction_amount').html(result.data[0].transaction_amount);
        $('#businesstransaction_paymentmethod').html(result.data[0].paymenttype_name);
        $('#businesstransaction_status').html(result.data[0].transaction_status);
        if(result.data[0].paymenttype_name=="Cheque" && result.data[0].is_cheque_received!=1 ) {
        	$('.businesstransactions_chequeapproval_class').show();
          }else{
          	$('.businesstransactions_chequeapproval_class').hide();
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


/* ====== add details start ===== */

$("#add_businesstransaction_cheque_approval").validate({
     
     rules:{
        businesstransaction_approval_status :"required",
     }
 });

$("#addbusinesstransactionchequeapproval").click(function() {
	
	  if(!$("#add_businesstransaction_cheque_approval").valid())
	 {
		 return false;
	 }

   var formData = new FormData($("#add_businesstransaction_cheque_approval")[0] );
     $.ajax({
      type:"POST",
    url:url+"BusinessTransactionController/saveBusinessTransactionChequeApproval",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
			
			if(result.success==true){

				$('#businesstransactions-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);		
			    $( "#businesstransactions-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

				$('.businesstransactions_chequeapproval_class').hide();

				setTimeout(function(){
               $('#businesstransactionsModal').modal("hide");
                    }, 5000);	
				 
			}
			else{
				$('#businesstransactions-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
				$( "#businesstransactions-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
			}
		},
		failure: function (result){
			$('#businesstransactions-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
			$( "#businesstransactions-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");		  
		}	
      });


});
/* ====== add  details  end ===== */



  }); // document ready