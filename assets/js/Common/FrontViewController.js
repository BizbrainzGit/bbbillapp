


$(document).ready(function(){
$(function(){          
  var items=""
      $.getJSON(url+"FrontViewController/getProjectCategorys",function(categorytypelist){
      items+="<option value=''>--Select Project Category --</option>";
      $.each(categorytypelist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.category_name+"</option>";
        });
      });
      
       $("#search_forntview_project_category").html(items);
      
  });
      
  $("#search_forntview_project_category").select2();
      

});

$(function(){          
  var items=""
      $.getJSON(url+"FrontViewController/getJobListForApplyForntView",function(jobslist){
      items+="<option value=''>--Select Job --</option>";
      $.each(jobslist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.job_title+"</option>";
        });
      });
      
      $("#add_applyjob_id").html(items);
    
  });

});



}); // document ready 