

// $(document).ready(function(){


function getDemolinkByCategory(selectedValue){
   var categoryId=selectedValue.value;
   var items="";
    $.getJSON(url+"Common/getDemoWebsitelinks/"+categoryId,function(demolinks){
      items+="<option value=''>--Select Demo Website link--</option>";
      $.each(demolinks,function(index,itemlist){ 
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.web_url+"'>"+item.web_name+"</option>";
        });
      });
      $("#add_sendlink_demolinks").html(items);
    });
}

  
$(function(){          
  var items="";
      $.getJSON(url+"Common/getMarketLeadUsers",function(email){
      items+="<option value=''>--Select Market Lead Users--</option>";
      $.each(email,function(index,itemlist){ 
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.email+"</option>";
        });
      });
      $("#add_marketlead_user").html(items);
      $("#edit_marketlead_user").html(items);
    });
});

$(function(){          
  var items="";
      $.getJSON(url+"Common/getMarketingUsers",function(email){
      items+="<option value=''>--Select Marketing Users--</option>";
      $.each(email,function(index,itemlist){
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.email+"</option>";
        });
      });
      $("#add_user").html(items);
      $("#edit_user").html(items);
    });
       // $("#add_user").select2();
});


$(function(){          
  var items="";
      $.getJSON(url+"Common/getAllUsers",function(list){
      items+="<option value=''> --Select Users --</option>";
      $.each(list,function(index,itemlist){
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.first_name+" "+item.last_name+"("+item.designation+")</option>";
        });
      });
      $("#search_business_createdby").html(items);
    });
       $("#search_business_createdby").select2();
});


$(function(){          
  var items="";
      $.getJSON(url+"Common/getStatus",function(list){
      items+="<option value=''>--Select Status --</option>";
      $.each(list,function(index,itemlist){
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.status_value+"</option>";
        });
      });
      $("#search_business_status").html(items);
    });
       // $("#add_user").select2();
});


$(function(){          
  var items="";

      $.getJSON(url+"Common/getDesignation",function(city){
      items+="<option value=''>--Select Designation--</option>";
      $.each(city,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.designation+"</option>";
        });
      });
      $("#add_employees_role").html(items);
      $("#edit_employees_role").html(items);
      $("#search_employee_designation").html(items);
  });
});


$(function(){          
  var items="";
      $.getJSON(url+"Common/getSubpackages",function(sublist_name){
      items+="<option value=''>--Select Packages --</option>";
      $.each(sublist_name,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.sublist_name+"</option>";
        });
      });
      $("#add_package_campaign").html(items);
      $("#edit_package_campaign").html(items);
   });
}); 


$(function(){          
  var items=""

      $.getJSON(url+"Common/getCategories",function(category_name){
      items+="<option value=''>--Select Category--</option>";
      $.each(category_name,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.category_name+"</option>";
        });
      });
      $("#add_demowebsites_category").html(items);
      $("#edit_demowebsites_category").html(items);
      $("#add_keywords_category").html(items);
      $("#edit_keywords_category").html(items);

      $("#search_business_website").html(items);
      $("#search_editbusiness_website").html(items);

      $("#search_demo_website").html(items);
      $("#search_editbusiness_keyword").html(items);
      $("#search_demo_keyword").html(items);
      $("#search_packages_website").html(items); 
      $("#add_sendlink_category").html(items); 

      
  });

  // $("#search_business_website").select2();
  $("#search_editbusiness_website").select2();
  $("#search_demo_website").select2();
  $("#search_editbusiness_keyword").select2();
  $("#search_demo_keyword").select2();

});





$(function(){          
  var items="";
  
      $.getJSON(url+"Common/getStatusWithOutDealClosed",function(status){
      items+="<option value=''>--Select Status--</option>";
      $.each(status,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.status_value+"</option>";
        });
      });
      $("#add_business_status").html(items);
      $("#add_packages_status").html(items);
      $("#edit_business_status").html(items);
      $("#edit_status").html(items);
      $("#change_status").html(items);
    
      $("#market_add_packages_status").html(items);
      $("#market_edit_business_status").html(items);
    
      $("#market_lead_add_packages_status").html(items);
      $("#market_lead_edit_business_status").html(items);
      // $("#market_lead_edit_business_status").html(items);
      $("#add_paymentpending_status").html(items);
  });
});



$(function(){          
  var items="";
      $.getJSON(url+"Common/getStatusListForTelemarketingBForm",function(status){
      items+="<option value=''>--Select Status--</option>";
      $.each(status,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.status_value+"</option>";
        });
      });
      $("#add_business_status_telemarketing").html(items);
  });
});

$(function(){          
  var items="";
  
      $.getJSON(url+"Common/getStatus",function(status){
      items+="<option value=''>--Select Status--</option>";
      $.each(status,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.status_value+"</option>";
        });
      });
       $("#market_change_status").html(items);
       $("#todaymarket_change_status").html(items);
       $("#market_lead_change_status").html(items);

  });
});



function getState(selectedValue){
   var cityId=selectedValue.value;
   var items="";
	
	    $.getJSON(url+"Common/getState/"+cityId,function(profilestate){
	    items+="<option value=''>---Select State---</option>";
	    $.each(profilestate,function(index,itemlist) {
	   	$.each(itemlist,function(index,item) {
			items+="<option value='"+item.state_id+"'>"+item.state_name+"</option>";
		    });
	    });
      $("#add_business_state").html(items);
      $("#edit_business_state").html(items);
      $("#add_business_gststate").html(items);
      $("#edit_business_gststate").html(items);
      $("#add_employees_state").html(items);
      $("#edit_employees_state").html(items);
      $("#market_edit_business_state").html(items);
      $("#market_edit_business_gststate").html(items);
      $("#market_lead_edit_business_state").html(items);
      $("#market_lead_edit_business_gststate").html(items);
      $("#add_gform_state").html(items);
      $("#add_sendlink_state").html(items);
      
  });
}
$(function(){          
  var items="";

      $.getJSON(url+"Common/getCity",function(city){
      items+="<option value=''>--Select City--</option>";
      $.each(city,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.cityid+"'>"+item.cityname+"</option>";
        });
      });
      $("#add_business_city").html(items);
      $("#edit_business_city").html(items);
      $("#add_mapping_city").html(items);
      $("#edit_mapping_city").html(items);
      $("#add_employees_city").html(items);
      $("#edit_employees_city").html(items);
      $("#search_business_city").html(items);
      $("#search_employee_city").html(items);
      $("#search_telemarketing_business_city").html(items);
      $("#search_marketinglead_business_city").html(items);
      $("#market_edit_business_city").html(items);
      $("#market_lead_edit_business_city").html(items);
      $("#add_gform_city").html(items); 
      $("#search_businessdealclosed_city").html(items);
      $("#search_businessseletedpackage_city").html(items);
      $("#search_businessassignments_city").html(items);
      $("#add_sendlink_city").html(items);  

  });
      $("#search_telemarketing_business_city").select2();
      $("#search_marketinglead_business_city").select2();
      $("#add_mapping_city").select2();
      $("#edit_mapping_city").select2();
});

$(function(){				   
	var items="";
	    $.getJSON(url+"Common/getState",function(profilestate){
	    items+="<option value=''>---Select State---</option>";
	    $.each(profilestate,function(index,itemlist) {
	   	$.each(itemlist,function(index,item) {
			items+="<option value='"+item.state_id+"'>"+item.state_name+"</option>";
		    });
	    });
      $("#add_business_state").html(items);
      $("#edit_business_state").html(items);
      $("#add_business_gststate").html(items);
      $("#edit_business_gststate").html(items);
      $("#add_employees_state").html(items);
      $("#edit_employees_state").html(items);
      $("#market_edit_business_state").html(items);
      $("#market_edit_business_gststate").html(items);
      $("#market_lead_edit_business_state").html(items);
      $("#market_lead_edit_business_gststate").html(items);
      $("#add_gform_state").html(items);
      $("#add_city_state").html(items);
      $("#edit_city_state").html(items);
	});
});






$(function(){          
  var items="";
  var edititems="";
  var paymentpedingitems="";
      $.getJSON(url+"Common/getPaymenttype",function(profilestate){
      items+=" ";
      edititems+=" ";
      paymentpedingitems+=" ";
      $.each(profilestate,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
        
      items+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_business_payment_mode" name="add_business_payment_mode"  onchange="showPaymentmode(this)" style="display: inline;"> <span class="form-label"> '+item.paymenttype_name+' </span> </label> </li>';
      
      edititems+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_newbusiness_payment_mode" name="add_newbusiness_payment_mode"  onchange="shownewPaymentmode(this)" style="display:inline;"> <span class="form-label"> '+item.paymenttype_name+' </span> </label> </li>';
      paymentpedingitems+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_paymentpending_payment_mode" name="add_paymentpending_payment_mode"              onchange="showpaymentpendingPaymentmode(this)" style="display: inline;"> <span class="form-label"> '+item.paymenttype_name+' </span> </label> </li>';
         });
      });
     $("#addpackagespaymentmode").html(items);
     $("#addbusinesspaymentmode").html(edititems);
     $("#addpaymentpendingpaymentmode").html(paymentpedingitems);
     // $("#receiptpayment").html(items);
     // $("#printreceiptpayment").html(items);
  });
});


$(function(){          
  var items="";
  var bitems="";

      $.getJSON(url+"Common/getCampaignlist",function(campaignlist){
      items+=" ";
      bitems+=" ";
      $.each(campaignlist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
      items+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' data-cname="'+item.campaign_name+'" data-camount="'+item.campaign_amount+'" id="add_business_campaign" name="add_business_campaign[]" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';

      bitems+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' data-newcname="'+item.campaign_name+'" data-newcamount="'+item.campaign_amount+'" id="add_newbusiness_campaign" name="add_newbusiness_campaign[]" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';
          });
      });
      $("#addcampaignlist").html(items);
      $("#addbusinesscampaignlist").html(bitems);
      
  });
});



$(function(){          
  var items="";
  var bitems="";

      $.getJSON(url+"Common/getCampaignERPlist",function(campaignlist){
      items+=" ";
      bitems+=" ";
      $.each(campaignlist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
      items+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' id="add_business_campaign" name="add_business_campaign[]" data-cname="'+item.campaign_name+'" data-camount="'+item.campaign_amount+'" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';

      bitems+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' id="add_newbusiness_campaign" name="add_newbusiness_campaign[]" data-newcname="'+item.campaign_name+'" data-newcamount="'+item.campaign_amount+'" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';

          });
      });
      $("#addcampaignERPlist").html(items);
      $("#addbusinesscampaignERPlist").html(bitems);
  });
});



// $(function(){ 

packagelistview();
 function packagelistview(){
  var items="";
  var itemsb="";
  var edititems="";

      $.getJSON(url+"Common/getPackagelist",function(packagelist){
      items+=" ";
      itemsb+=" ";
      edititems+=" ";
      $.each(packagelist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
  var i;
  var values = item.sublist_name;
  var subname = values.split(',');
  var n =subname.length;
  var sname ="";

for(i=0;i<n;i++) {
   sname+= "<div class='subpackage'>"+subname[i]+"</div>"
   }
      items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages"> <div class="text-center pt-3 pb-2 card-packagehead"><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2">Rs.'+item.package_amount+'</h4></div> <div class="scrollbar"><span class="packages_scollbar"> '+sname+'</span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center"> <label> <input type="checkbox"  value='+item.id+'  id="add_business_package" name="add_business_package[]" data-pname="'+item.package_name+'" data-pamount="'+item.package_amount+'"> Select Package </label></div></div>';

    
    });
     
  });
        // $("#addpackagelist").html(items);
        $("#ourpackagelist").html(items);
        // $("#addbusinesspackagelist").html(itemsb);
  });

}

// });


  







// });// Documnets Ready 