
$(document).ready(function(){

//============== demo websites end =====//
$(function(){          
  var items=""
      $.getJSON(url+"CustomerBuyController/getCategories",function(category_name){
      items+="<option value=''>--Select Category--</option>";
      $.each(category_name,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.id+"'>"+item.category_name+"</option>";
        });
      });
      $("#search_demowebsite_emaillink").html(items);
  });

  // $("#search_bemail_website").select2();

});

viewDemowebsites();   
        function viewDemowebsites(){
            $.ajax({
                type  : 'GET',
                url   : url+"CustomerBuyController/SearchWebsitesForEmailLink",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){
        viewDemowebsitesList(result.data);
      
              }        
                }
            });
        }

function viewDemowebsitesList(demowebsites){
       var items = "";
       var edititems = "";
       var i;
       var n = demowebsites.length;

    for(var i=0; i<n; i++){
        items+='<div class="col-md-4 col-12 form-group"><div class="demoweb card"><img src="'+url+demowebsites[i].web_photo+'" alt="web image" class="image"><div class="container"><h6 class="p-2">'+demowebsites[i].web_name+'</h6></div><div class="overlay"><div class="text"><a  href="'+demowebsites[i].web_url+'" class="btn btn-info btn-rounded btn-fw mb-3" target="_blank">Live Demo</a><a  href="'+demowebsites[i].web_url+'" class="btn btn-light btn-rounded btn-fw" target="_blank">Preview</a></div></div></div></div>';
     }    

        $("#demowebsitesemaillink").html(items);;
  
  }


$("#searchdemowebsiteemail").click(function(){

   var search_demowebsite_emaillink = $('#search_demowebsite_emaillink').val();
   // alert(search_demowebsite_emaillink);
  var items ="";
   $.ajax({
       type:"POST",
       url:url+"CustomerBuyController/SearchWebsitesForEmailLink",
    dataType: 'json',
    data:{search_demowebsite_emaillink:search_demowebsite_emaillink},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
        viewDemowebsitesList(result.data);  
      }
  else if(result.success==false){
       $('#search_demowebsite_emaillink-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
       $( "#search_demowebsite_emaillink-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
        viewDemowebsites();  
      }
    },
    
    failure: function (result){
      $('#search_demowebsite_emaillink-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_demowebsite_emaillink-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");  
      viewDemowebsites();      
    } 
         
      });

  
  
});
//============== demo websites end =====//


// function getState(selectedValue){
//    var cityId=selectedValue.value;
//    var items="";
	
// 	    $.getJSON(url+"CustomerBuyController/getCustomerBuyState/"+cityId,function(profilestate){
// 	    items+="<option value=''>---Select State---</option>";
// 	    $.each(profilestate,function(index,itemlist) {
// 	   	$.each(itemlist,function(index,item) {
// 			items+="<option value='"+item.state_id+"'>"+item.state_name+"</option>";
// 		    });
// 	    });
//       $("#add_customerbuy_state").html(items);
//       // $("#market_edit_business_state").html(items);
//   });
// }

$(function(){          
  var items="";

      $.getJSON(url+"CustomerBuyController/getCustomerBuyCity",function(city){
      items+="<option value=''>--Select City--</option>";
      $.each(city,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      items+="<option value='"+item.cityid+"'>"+item.cityname+"</option>";
        });
      });
      $("#add_customerbuy_city").html(items);
      
  });
      
});

$(function(){				   
	var items="";
	
	    $.getJSON(url+"CustomerBuyController/getCustomerBuyState",function(profilestate){
	    items+="<option value=''>---Select State---</option>";
	    $.each(profilestate,function(index,itemlist) {
	   	$.each(itemlist,function(index,item) {
			items+="<option value='"+item.state_id+"'>"+item.state_name+"</option>";
		    });
	    });
      $("#add_customerbuy_state").html(items);
      
	});
});




$(function(){          
  var items="";
  var itemsb="";
  var edititems="";

      $.getJSON(url+"CustomerBuyController/getCustomerBuyPackagelist",function(packagelist){
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
      items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages"> <div class="text-center pt-3 pb-2 card-packagehead"><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2">Rs.'+item.package_amount+'</h4></div> <div class="scrollbar"><span class="packages_scollbar" > '+sname+'</span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center"> <label> <input type="checkbox"  value='+item.id+'  id="add_customerbuy_package" name="add_customerbuy_package[]" data-pname="'+item.package_name+'" data-pamount="'+item.package_amount+'"> Select Package </label></div></div>';
    });
     
  });
  $("#add_customerbuy_packagelist").html(items);
   
  });
});


$(function(){          
  var items="";
  var bitems="";

      $.getJSON(url+"CustomerBuyController/getCustomerBuyCampaignlist",function(campaignlist){
      items+=" ";
      bitems+=" ";
      $.each(campaignlist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
      items+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' data-cname="'+item.campaign_name+'" data-camount="'+item.campaign_amount+'" id="add_customerbuy_campaign" name="add_customerbuy_campaign[]" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';

      });
      $("#add_customerbuy_campaignlist").html(items);
     
      
  });
});
      });



$(function(){          
  var items="";
  var bitems="";

      $.getJSON(url+"CustomerBuyController/getCustomerBuyCampaignERPlist",function(campaignlist){
      items+=" ";
      bitems+=" ";
      $.each(campaignlist,function(index,itemlist) {
      $.each(itemlist,function(index,item) {
      
      items+='<div class="col-md-4"><div class="form-group">  <label> <input type="checkbox"  value='+item.id+' id="add_customerbuy_campaign" name="add_customerbuy_campaign[]" data-cname="'+item.campaign_name+'" data-camount="'+item.campaign_amount+'" > <span style="text-align:center;"> <img src="'+url+item.campaign_photo+ '" width="100"  height="80" alt=" photo" /> <p class="form-label"> '+item.campaign_name+' </p> <div>Amount: '+item.campaign_amount+' </div>  </span> </label> </div></div>';

          });
      });
      $("#add_customerbuy_campaignERPlist").html(items);
      
  });
});

$(function(){          
  var items="";
  var edititems="";

      $.getJSON(url+"CustomerBuyController/getCustomerBuyPaymenttype",function(profilestate){
      items+=" ";
      edititems+=" ";
      $.each(profilestate,function(index,itemlist) {
      $.each(itemlist,function(index,item) {

      items+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_business_payment_mode" name="add_business_payment_mode"  onchange="showPaymentmode(this)" style="display: inline;"> <span class="form-label"> '+item.paymenttype_name+' </span> </label> </li>';

      edititems+='<li class="nav-item"><label> <input type="radio"  value='+item.id+' id="add_newbusiness_payment_mode" name="add_newbusiness_payment_mode"  onchange="shownewPaymentmode(this)" style="display:inline;"> <span class="form-label"> '+item.paymenttype_name+' </span> </label> </li>';
         });
      });
     $("#add_customerbuy_packagespaymentmode").html(items);
     
  });
});

var customerbuyform = $("#add_customerbuy_packagesdata");
customerbuyform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_customerbuy_name :"required",
      add_customerbuy_companyname :"required",
      // add_customerbuy_houseno :"required",
      add_customerbuy_campaign:"required", 
      // add_customerbuy_area:"required",
      add_customerbuy_city:"required",
      add_customerbuy_state:"required",
      add_customerbuy_phonenumber:{required:true,number:true,minlength:10, maxlength:10},
      add_customerbuy_package:"required",
      add_customerbuy_email:{required:true,email: true}
      
    }
});

customerbuyform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    saveState: false,
    enableFinishButton: true,
    preloadContent: false,
    showFinishButtonAlways: false,
    forceMoveForward: false,
    onStepChanging: function (event, currentIndex, newIndex)
    {    

 
         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", customerbuyform).remove();
            $(".body:eq(" + newIndex + ") .error", customerbuyform).removeClass("error");
        }
        //alert(customerbuyform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
           });
        
        //alert(currentIndex);
        customerbuyform.validate().settings.ignore = ":disabled,:hidden";
        return customerbuyform.valid();
        // newpaymentmode.validate().settings.ignore = ":disabled,:hidden";
        // return newpaymentmode.valid();
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
         var campaigntotal=0;
     $('#totalamount1').show();  
     // $('#grandtotalamount').hide(); 
      $('#campaignlist1').empty();
        var n = $("#add_customerbuy_campaign:checked").length;
        if (n > 0){
            $("#add_customerbuy_campaign:checked").each(function(){
                //var campaign_id= $(this).val();
                var campainname=$(this).attr("data-cname");
                var campaignamount=$(this).attr("data-camount");
                campaigntotal += Number(campaignamount);

        $('#campaignlist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campainname+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+campaignamount+'</label></div>');   
  
            });

        }

        $('#packagelist1').empty();
        var n = $("#add_customerbuy_package:checked").length;
        if (n > 0){
            $("#add_customerbuy_package:checked").each(function(){
                //var campaign_id= $(this).val();
                var packagename=$(this).attr("data-pname");
                var packageamount=$(this).attr("data-pamount");
               packagetotal += Number(packageamount); 
        $('#packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packageamount+'</label></div>');   
  
            });
        }
       
      var total=campaigntotal+packagetotal;
      // alert(total);
      var total= parseFloat(total).toFixed(2);

      var tdsvalue = $('#add_customerbuy_tds:checked').val();
     // alert(tdsvalue);
     if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          // alert(tds);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }
       
     var state_id = $('#add_packages_companyname_state_id').val();
     if(state_id==32){
        var cgst=Number(total*9/100);
        var sgst=Number(total*9/100);

        var cgst= parseFloat(cgst).toFixed(2);
        var sgst= parseFloat(sgst).toFixed(2);
        var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
        var grandtoatal= parseFloat(grandtoatal).toFixed(2);
        var grandtoatal =Math.round(grandtoatal);
        var gst='<div class="col-sm-6 col-6 form-group"> <label> CGST </label></div> <div class="col-sm-6 col-6 form-group"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 form-group"> <label> SGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+sgst+'</label></div>'+tdsview+' ';

       
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var grandtoatal =Math.round(grandtoatal);
      gst='<div class="col-sm-6 col-6 form-group"> <label>IGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+igst+'</label></div> '+tdsview+' ';
     } 
     // alert(grandtoatal);
     $('#totalamount1').empty();
     $('#totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div>           </div></div>')
      $('#add_customerbuy_packages_grandtotal').val(total);
      // alert(total);

    },
    onFinishing: function (event, currentIndex)
    {
        customerbuyform.validate().settings.ignore = ":disabled";
        return customerbuyform.valid();
        //return true;
    },
    onFinished: function (event, currentIndex)
    {
      //alert('submitted!!!');
  


     var formData = new FormData($("#add_customerbuy_packagesdata")[0] );

     $.ajax({
      type:"POST",
      url:url+"CustomerBuyController/saveCustomerBuyPackagesData",
      dataType: 'json',
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
      beforeSend: function(){
          // Show image container
          $(".loader").show();
      },
      success: function(result){
      
      if(result.success==true){

        $('#customerbuydata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#customerbuydata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_customerbuy_packagesdata')[0].reset(); 

        window.setTimeout(function(){location.reload()},3000)
       
        }
      else{
        $('#customerbuydata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#customerbuydata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#customerbuydata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#customerbuydata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



























});

