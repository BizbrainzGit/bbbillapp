

$(function(){          
  var items="";
  
      $.getJSON(url+"ProjectStatusController/getProjectStatusList",function(status){
      items+="<option value=''>--Select Status--</option>";
      $.each(status,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.status+"</option>";
        });
      });
      $("#project_change_status").html(items);
     
  });
});




