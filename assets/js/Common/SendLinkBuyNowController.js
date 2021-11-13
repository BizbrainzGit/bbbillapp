
$(document).ready(function(){

  $(function(){ 

    var items="";
        $.getJSON(url+"SendLinkBuyNowController/getSendLinkBuyNowPackagelist",function(packagelist){
        items+=" ";
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
        items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages"> <div class="text-center pt-3 pb-2 card-packagehead"><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2">Rs.'+item.package_amount+'</h4></div> <div class="scrollbar"><span class="packages_scollbar" > '+sname+'</span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center"> <label> <input type="checkbox"  value='+item.id+'  id="add_sendlinkbuynow_package" name="add_sendlinkbuynow_package[]" data-pname="'+item.package_name+'" data-pamount="'+item.package_amount+'"> Select Package </label></div></div>';
      });
       
    });
    $("#add_sendlinkbuynow_packagelist").html(items);
     
    });
  });



var sendlinkbuynowform = $("#add_sendlinkbuynow_packagesdata");
sendlinkbuynowform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      add_sendlinkbuynow_package:"required",
    }
});

sendlinkbuynowform.children("div").steps({
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
          var sendlinkbuynow_package = $("#add_sendlinkbuynow_package:checked").length;
           if(sendlinkbuynow_package<=0){
                    alert('Pls Selecte Any One Package');
                     return false;
            }

         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", sendlinkbuynowform).remove();
            $(".body:eq(" + newIndex + ") .error", sendlinkbuynowform).removeClass("error");
        }
        //alert(sendlinkbuynowform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
           });
        sendlinkbuynowform.validate().settings.ignore = ":disabled,:hidden";
        return sendlinkbuynowform.valid();
      
    },
    onStepChanged: function (event, currentIndex)
    {    
         var total=0;
         var packagetotal=0;
        $('#sendlinkbuynow_totalamount1').show();  
        $('#sendlinkbuynow_packagelist1').empty();

        var n = $("#add_sendlinkbuynow_package:checked").length;
        if (n > 0){
            $("#add_sendlinkbuynow_package:checked").each(function(){
                //var campaign_id= $(this).val();
                var packagename=$(this).attr("data-pname");
                var packageamount=$(this).attr("data-pamount");
               packagetotal += Number(packageamount); 

        $('#sendlinkbuynow_packagelist1').append('<div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group" id="pakagesname"><label>'+packageamount+'</label></div>');   
  
            });
        }
       
      var total=packagetotal;
      var total= parseFloat(total).toFixed(2);
      var tdsvalue = $('#add_sendlinkbuynow_tds:checked').val();
     if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          // alert(tds);
          var tdsview='<div class="col-sm-6 col-6 form-group"> <label> TDS </label></div> <div class="col-sm-6 col-6 form-group"><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }
       
     var state_id = $('#add_sendlinkbuynow_state_id').val();
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
     $('#sendlinkbuynow_totalamount1').empty();
     $('#sendlinkbuynow_totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div> </div></div>');

      $('#add_sendlinkbuynow_grandtotal').val(grandtoatal);
      $('#add_sendlinkbuynow_packages_total').val(total);
      
    },
    onFinishing: function (event, currentIndex)
    {
        sendlinkbuynowform.validate().settings.ignore = ":disabled";
        return sendlinkbuynowform.valid();
        //return true;
    },
    onFinished: function (event, currentIndex)
    {
      //alert('submitted!!!');

     var formData = new FormData($("#add_sendlinkbuynow_packagesdata")[0] );

     $.ajax({
      type:"POST",
      url:url+"SendLinkBuyNowController/saveSendLinkBuyNowPackagesData",
      dataType: 'json',
      data:formData,
      contentType: false, 
      cache: false,      
      processData:false,
      beforeSend: function(){
          $(".loader").show();
      },
      success: function(result){
      
      if(result.success==true){

        $('#sendlinkbuynowdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $("#sendlinkbuynowdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_sendlinkbuynow_packagesdata')[0].reset(); 
          window.setTimeout(function(){location.reload()},3000)
        }
      else{
        $('#sendlinkbuynowdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#sendlinkbuynowdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    $(".loader").hide();
}, 
    failure: function (result){

      $('#sendlinkbuynowdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#sendlinkbuynowdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



























});

