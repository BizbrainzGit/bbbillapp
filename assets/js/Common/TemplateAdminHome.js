
$(document).ready(function(){


	$(function(){          
  var items=""

      $.getJSON(url+"templateadmin/TemplateAdminHome/getCategoriesForProjects",function(category_name){
      items+="<option value=''>--Select Category--</option>";
      $.each(category_name,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.category_name+"</option>";
        });
      });
       $("#add_project_category").html(items);
       $("#edit_project_category").html(items);
     
  });

  

});

viewContactFormDetails();   
        function viewContactFormDetails(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/TemplateAdminHome/ContactFormDetailsList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             ContactFormDetailsList(result.data);
                        }        
                }
            });
        }

function ContactFormDetailsList(contactformlistdata){
	 if ($.fn.DataTable.isDataTable('#contactformtable')) {

				 $('#contactformtable').DataTable().destroy();

				 }	

				 $('#contactformtable tbody').empty();
				 var data=contactformlistdata; 
				 var table = $('#contactformtable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'name',title:'Name'},
		  {data: 'email',title: 'Status'},
          {data: 'mobile_no',title: 'Phone No'},
          {data: 'company_name',title: 'Company Name'},
          {data: 'message',title: 'Message'},
          {data: 'created_date',title: 'Date & Time'},],
     
			 });

table.rows.add(data).draw();
         
}


viewJobApplyDetails();   
        function viewJobApplyDetails(){
            $.ajax({
                type  : 'GET',
                url   : url+"templateadmin/TemplateAdminHome/JobApplyDetailsList",
                async : true,
                dataType : 'json',
                success : function(result){
                          if(result.success===true){
                             JobApplyDetailsList(result.data);
                        }        
                }
            });
        }

function JobApplyDetailsList(jobapplylistdata){
	 if ($.fn.DataTable.isDataTable('#jobapplytable')) {

				 $('#jobapplytable').DataTable().destroy();

				 }	

				 $('#jobapplytable tbody').empty();
				 var data=jobapplylistdata; 
				 var table = $('#jobapplytable').DataTable({
				 paging: true,
				 searching: true,
				 columns: [
		  {data: 'id',title: 'S.No'},
		  {data: 'job_title',title: 'Job Apply'},
		  {data: 'name',title:'Name'},
		  {data: 'email',title: 'Email'},
          {data: 'mobileno',title: 'Mobile No'},
          {data: 'qualification',title: 'Qualification'},
          {data: 'message',title: 'Message'},
          {data: 'resume',title: 'Resume',render: getImg},
          ],
     
			 });

table.rows.add(data).draw();
         
}

function getImg(data, type, full, meta) {

            if(data != null){
             data = '<a href="'+url+data+'" download> <img src="'+url+'assets/images/download.png" heignt="32px" width="32px" align="center"/> </a>' 
			  }	else{
				  data = ' '
			  }

       return data;
    }

}); // document ready 

