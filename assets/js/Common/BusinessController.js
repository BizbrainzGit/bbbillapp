
var map;
var marker;
function myMap() {
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (p) {
        var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
        var mapOptions = {
            center: LatLng,
            zoom: 13,
            draggable: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var marker = new google.maps.Marker({
            position: LatLng,
            draggable: true,
            map: map,
            title: "<div style = 'height:60px;width:200px'><b>Your location:</b><br />Latitude: " + p.coords.latitude + "<br />Longitude: " + p.coords.longitude
        });

        google.maps.event.addListener(marker, "click", function (e) {
            var infoWindow = new google.maps.InfoWindow();
            infoWindow.setContent(marker.title);
            infoWindow.open(map, marker);

        });

/*var geocoder;
      google.maps.event.addListener(marker, 'dragend', function() {

geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
//$('#address').val(results[0].formatted_address);
$('#add_business_currentlat').val(p.coords.latitude);
$('#add_business_currentlat').val(p.coords.longitude);
infowindow.setContent(results[0].formatted_address);
infowindow.open(map, marker);
}
}
});
});*/     

         //alert(p.coords.latitude+" , "+p.coords.longitude);

    document.getElementById("add_business_currentlat").value = p.coords.latitude;
    document.getElementById("add_business_currentlag").value = p.coords.longitude;

    })  ;
    
  
    

} else {

    alert('Geo Location feature is not supported in this browser.');

}

  }


function showPosition() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMap, showError);
    } else {
        alert("Sorry, your browser does not support HTML5 geolocation.");
    }
}
 
// Define callback function for successful attempt
function showMap(position) {
    // Get location data
    lat = position.coords.latitude;
    long = position.coords.longitude;
    var latlong = new google.maps.LatLng(lat, long);
    
    var myOptions = {
        center: latlong,
        zoom: 16,
        mapTypeControl: true,
        navigationControlOptions: {
            style:google.maps.NavigationControlStyle.SMALL
        }
    }
    
    var map = new google.maps.Map(document.getElementById("embedMap"), myOptions);
    var marker = new google.maps.Marker({ position:latlong, map:map, title:"You are here!" });
}
 
// Define callback function for failed attempt
function showError(error) {
    if(error.code == 1) {
        result.innerHTML = "You've decided not to share your position, but it's OK. We won't ask you again.";
    } else if(error.code == 2) {
        result.innerHTML = "The network is down or the positioning service can't be reached.";
    } else if(error.code == 3) {
        result.innerHTML = "The attempt timed out before it could get the location data.";
    } else {
        result.innerHTML = "Geolocation failed due to unknown error.";
    }
}


// $(document).ready(function(){

BusinessviewListData();   
function BusinessviewListData(){
    $.ajax({
    type : 'GET',
    url : url+"BusinessController/SearchBusinessList",
    async : true,
    dataType : 'json',
    success : function(result){
      if(result.success===true){
        BusinessViewList(result.data,result.role);
      } 

    }
    });
}

 function BusinessViewList(businesslist,roles){
       var role=roles ;
   if ( $.fn.DataTable.isDataTable('#businesstable')) {
         $('#businesstable').DataTable().destroy();
         }  
         $('#businesstable tbody').empty();
          var data=businesslist;
         var table = $('#businesstable').DataTable({
         paging: true,
         searching: true,
         columns: [
      {data: 'id',title: 'S No.'},
      {data: 'company_name_id',title:'Company Name'},
      {data: 'person_name_mobile',title:'Person Name'},
      {data: 'cityname',title: 'City Name'},
      {data: 'state_name',title: 'State Name'}, 
      {data: 'created_name',title: 'Created By'}, 
      {data: 'business_created_on',title: 'Created Date'},
      {data: 'status_value',title:'Status'},
      {data: null,
           'title' : 'Action',
           "sClass" : "center",
           "width":"20%",
           mRender: function (data, type, row) {
           if(role=="Marketing-Lead"){
             return '<button class="btn btn-secondary btn-sm mt-2 status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp; <button class="btn btn-dark btn-sm mt-2  editbusiness"  id="businessdata_edit" title="Business Edit" style="color:#0066ff"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"  style="color:#ffffff"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;                          <button class="btn btn-info btn-sm mt-2 selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;'

          }else if(role=="Marketing"){
               return '<button class="btn btn-dark btn-sm mt-2  editbusiness"  id="businessdata_edit" title="Business Edit" style="color:#0066ff"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"  style="color:#ffffff"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;   <button class="btn btn-info btn-sm mt-2 selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;'

          }else if(role=="Tele-Marketing"){
              return '<button class="btn btn-info btn-sm mt-2 selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;    <button class="btn btn-warning btn-sm assignmentaddview mt-2" id="assignmentaddview" data-toggle="modal"  data-target="#AddassignmentModal" title="Add Appointment"> <a data-assignmentid="'+data.id+'" data-assignmentname="' +data.company_name+ '" style="color:#FFFFFF;"><i class="mdi mdi-view-array"></i></a></button> '

          } else{
   
       return '<button class="btn btn-secondary btn-sm mt-2 status_edit" data-toggle="modal" id="status_edit" data-target="#EditstatusModal" title="Status Edit"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" style="color:#ffffff"> <i class="mdi mdi-pencil-box"></i> </a></button> &nbsp;<button class="btn btn-dark btn-sm mt-2  editbusiness" id="businessdata_edit" title="Business Edit" style="color:#0066ff"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"  style="color:#ffffff"> <i class="mdi mdi-grease-pencil"></i> </a></button>&nbsp;  <button class="btn btn-info btn-sm mt-2 selectedpackages" title="Select Package"><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '"style="color:#ffffff" data-businessstate_id="'+data.state_id+'" > <i class="mdi mdi-package-variant" data-name="mdi-package-variant"></i> </a></button>&nbsp;'  }

       // <button class="btn btn-danger btn-sm mt-2 business_delete" title="Business Delete" ><a data-businessid="'+data.id+'" data-businessname="' +data.company_name+ '" style="color:#ffffff" > <i class="mdi mdi-delete"></i> </a></button>&nbsp;
           } }] 


       });

 
table.rows.add(data).draw();

if(data.length>0){
    $('#business_excel').show();
    $('#business_pdf').show();
    $('#business_print').show();
  }else{
     $('#business_excel').hide();
     $('#business_pdf').hide();
     $('#business_print').hide();
  }
 
 }

$('[data-toggle="modal"]').tooltip();


$(document).on('click', '.status_edit a', function(e){
 var id= $(this).attr("data-businessid");
 $.ajax({
    type: "GET",
    url:url+'BusinessController/editStatusByid/'+id,
    dataType: 'json',
    success:function(result){
        if(result.success===true)
        { 
         $('#change_status_form #change_status_id').val(id);
         $('#change_status_form #change_status').val(result.data[0].business_status_id).prop("selected", true);
      
         }else{
              alert('request failed', 'error');
        }
      },
   fail:function(result){
        
        alert('Information request failed: ' + textStatus, 'error');
      }
 });

});

 $("#updatestatus").click(function(){
    if(!$("#change_status_form").valid())
   {
     return false;
   }
  
  var formData = new FormData($("#change_status_form")[0] );
   $.ajax({
       type:"POST",
       url:url+"BusinessController/updateStatusByid",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,

 success: function(result){
      
      if(result.success===true){
        $('#change_status-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
        $("#change_status-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");

           $("#change_status_form")[0].reset();
            setTimeout(function(){
               $('#EditstatusModal').modal('hide');
                }, 5000); 

       BusinessviewListData();

   }
  else if(result.success===false){
        $('#change_status-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#change_status-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){

      $('#change_status-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#change_status-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });


});



$("#showaddbusiness").click(function(){
 $(".listbusiness-class").hide();
 $(".addbusiness-class").show();
});


$(document).on('click', '.editbusiness a', function(e){

 $(".listbusiness-class").hide();
 $(".addbusiness-class").hide();
 $(".editbusiness-class").show();
 var id= $(this).attr("data-businessid");

$.ajax({
    type: "GET",
    url:url+'BusinessController/editBusinessByid/'+id,
    dataType: 'json',
 
  success:function(result){
      if(result.success===true)
      { 

        // alert(result.data[0].company_name);
        // $('#edit_businessname_head').html(result.data[0].company_name);  

        $('#edit_businessdata #edit_business_addid').val(result.data[0].address_id);
        $('#edit_businessdata #edit_business_id').val(result.data[0].id);
        $('#edit_businessdata #edit_business_cname').val(result.data[0].company_name);
        $('#edit_businessdata #edit_business_hno').val(result.data[0].house_no);
        $('#edit_businessdata #edit_business_street').val(result.data[0].street);
        $('#edit_businessdata #edit_business_subarea').val(result.data[0].sub_area);
        $('#edit_businessdata #edit_business_area').val(result.data[0].area);
        $('#edit_businessdata #edit_business_landmark').val(result.data[0].landmark);
        $('#edit_businessdata #edit_business_city').val(result.data[0].city_id).prop("selected", true);
        $('#edit_businessdata #edit_business_state').val(result.data[0].state_id).prop("selected", true);
        
        if(result.data[0].pincode==0){
           var pincode ="";
        }else{
            var pincode =result.data[0].pincode;
        }
        $('#edit_businessdata #edit_business_pincode').val(pincode);

         $('#edit_businessdata #edit_business_pname').val(result.data[0].person_name);
         $('#edit_businessdata #edit_business_designation').val(result.data[0].person_designation);
         $('#edit_businessdata #edit_business_landlineno').val(result.data[0].landline_no);
         $('#edit_businessdata #edit_business_mobileno').val(result.data[0].mobile_no);
         $('#edit_businessdata #edit_business_altnemobileno').val(result.data[0].alt_mobile_no);
         $('#edit_businessdata #edit_business_email').val(result.data[0].email);

        $('#edit_businessdata #edit_business_gstcname').val(result.data[0].gst_company_name);
        $('#edit_businessdata #edit_business_cgstcname').val(result.data[0].gst_company_name);
        $('#edit_businessdata #edit_business_gstno').val(result.data[0].gst_number);
        $('#edit_businessdata #edit_business_cgstno').val(result.data[0].gst_number);
        $('#edit_businessdata #edit_business_gststate').val(result.data[0].gst_state);
         if(result.data[0].gst_pincode==0){
           var gst_pincode ="";
        }else{
            var gst_pincode =result.data[0].gst_pincode;
        }
        $('#edit_businessdata #edit_business_gstpincode').val(gst_pincode);
        $('#edit_businessdata #edit_business_gstpanno').val(result.data[0].gst_pan_no);
        $('#edit_businessdata #edit_business_gstaddress').val(result.data[0].gst_address);
        $('#edit_businessdata #edit_business_status').val(result.data[0].business_status_id).prop("selected", true);


        $('#edit_businessdata #edit_business_website').val(result.data[0].website_url);
        $('#edit_businessdata #edit_business_facebook').val(result.data[0].facebook_url);
        $('#edit_businessdata #edit_business_twitter').val(result.data[0].twitter_url);
        $('#edit_businessdata #edit_business_youtube').val(result.data[0].youtube_url);
        $('#edit_businessdata #edit_business_linkedin').val(result.data[0].linkedin_url);
        $('#edit_businessdata #edit_business_instagram').val(result.data[0].instagram_url);

        $('#edit_businessdata #edit_business_owner1name').val(result.editowner[0].owner_name);
        $('#edit_businessdata #edit_business_owner1role').val(result.editowner[0].owner_role);
         if(result.editowner[0].owner_mobile==0){
           var owner_mobile ="";
        }else{
            var owner_mobile =result.editowner[0].owner_mobile;
        }
        $('#edit_businessdata #edit_business_owner1mobile').val(owner_mobile);
        $('#edit_businessdata #edit_business_owner1email').val(result.editowner[0].owner_email);

        $('#edit_businessdata #edit_business_owner2name').val(result.editowner[1].owner_name);
        $('#edit_businessdata #edit_business_owner2role').val(result.editowner[1].owner_role);
         if(result.editowner[1].owner_mobile==0){
           var owner_mobile1 ="";
        }else{
            var owner_mobile1 =result.editowner[1].owner_mobile;
        }
        $('#edit_businessdata #edit_business_owner2mobile').val(owner_mobile1);
        $('#edit_businessdata #edit_business_owner2email').val(result.editowner[1].owner_email);
         $('#edit_businessdata #edit_business_lat').val(result.data[0].latitude);
         $('#edit_businessdata #edit_business_long').val(result.data[0].longitude);

// alert(result.data[0].longitude);
        var latitude=result.data[0].latitude;
        var longitude=result.data[0].longitude;
        var myLatLng = {lat:latitude, lng:longitude};
        var map = new google.maps.Map(document.getElementById('editdvMap'), {
         zoom: 4,
         center: myLatLng
       });

       var marker = new google.maps.Marker({
         position: myLatLng,
         map: map
       });

         if(result.data[0].photo!=null){
             $("#businessimage").html('<img src="'+url+result.data[0].photo+ '" width="200px"  height="100px" alt=" photo" />');
         }else{
            $("#businessimage").html('<img src="'+url+No_Image_Path+'" width="200px"  height="100px" alt=" photo" />')
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

var businesseditform = $("#edit_businessdata");
businesseditform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
      edit_business_city :"required",
      edit_business_state :"required",
      edit_business_cname :"required",
      // edit_business_street:"required", 
      // edit_business_area:"required",
      edit_business_pincode:{number:true,minlength:6, maxlength:6},
      edit_business_pname:"required",
      edit_business_designation:"required",
      edit_business_landlineno:{number:true,minlength:8, maxlength:16},
      edit_business_mobileno:{required:true,number:true, number:true,minlength:10, maxlength:10},
      edit_business_altnemobileno:{minlength:10, maxlength:10},
      edit_business_condition:"required",
      edit_business_email:{required:true,email: true },
      edit_business_cgstcname: {equalTo: "#edit_business_gstcname"},
      edit_business_cgstno: {equalTo: "#edit_business_gstno"},
      edit_business_debitcardno:{number:true,minlength:5, maxlength:18},
      edit_business_creditcardno:{number:true,minlength:5, maxlength:18},
      edit_business_accountno:{number:true,minlength:5, maxlength:20},
      edit_business_caccountno: {number:true,minlength:5, maxlength:20,equalTo: "#edit_business_accountno"},
      edit_business_cacholdername: { equalTo: "#edit_business_acholdername"},
      // edit_business_owner1name:"required",
      // edit_business_owner1role:"required",
      edit_business_owner1mobile:{number:true,minlength:10, maxlength:10},
      edit_business_owner1email:{email: true },
      edit_business_owner2mobile:{minlength:10, maxlength:10},
      edit_business_owner2email:{email: true },
      // edit_business_status:"required",
      

    }
});

businesseditform.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        businesseditform.validate().settings.ignore = ":disabled,:hidden";
        return businesseditform.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if ($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
           } 
        });
        businesseditform.validate().settings.ignore = ":disabled";
        return businesseditform.valid();
    },
    onFinished: function (event, currentIndex)
    {

    var formData = new FormData($("#edit_businessdata")[0] );
     $.ajax({
      type:"POST",
    url:url+"BusinessController/updateBusinessData",
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
        $('#businessdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#businessdata-editmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#edit_businessdata')[0].reset();
        window.setTimeout(function(){location.reload()},3000)
      }
      else{
        $('#businessdata-editmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#businessdata-editmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
      complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#businessdata-editmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#businessdata-editmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});



$(document).on('click', '.business_delete a', function(e){
       var id= $(this).attr("data-businessid");
       var name=$(this).attr("data-businessname");
    $.ajax({
        type: "GET",
        url:url+'BusinessController/deleteBusinessById/'+id,
        dataType: 'json',
      success:function(result){
          if(result.success===true)
          { 
        
          swal("Deleted!", "Your"+" "+ name +" "+"has been deleted.", "success");  
          window.setTimeout(function(){location.reload()},3000);
       
          }else{
                alert('request failed', 'error');
          }

        },
     
     fail:function(result){
          
          alert('Information request failed: ' + textStatus, 'error');
        }

    });

    

    });

/* ====== Business delete end ===== */

var businessform = $("#add_businessdata");
var paymentmodeid = $("#add_newbusiness_payment_mode:checked").val();
businessform.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {

      add_business_city :"required",
      add_business_state :"required",
      add_business_cname :"required",
      add_business_category_name :"required", 
      add_business_pincode:{number:true,minlength:6, maxlength:6},
      add_business_pname:"required",
      add_business_designation:"required",
      add_business_landlineno:{number:true,minlength:8, maxlength:16},
      add_business_mobileno:{required:true,number:true,minlength:10, maxlength:10},
      add_business_cmobileno: { number:true,minlength:10, maxlength:10,equalTo: "#add_business_mobileno"},
      add_business_altnemobileno:{number:true,minlength:10, maxlength:10}, 
      add_business_condition:"required",
      add_business_email:{required:true,email: true},  

      // add_business_street:"required", 
      // add_business_area:"required",
      // add_business_photo:"required",
      // add_business_cgstcname: {equalTo: "#add_business_gstcname"},
      // add_business_cgstno: {equalTo: "#add_business_gstno"},
      // add_business_accountno:{number:true,minlength:5, maxlength:20},
      // add_business_caccountno: {number:true,minlength:5, maxlength:20,equalTo: "#add_business_accountno"},
      // add_business_cacholdername: { equalTo: "#add_business_acholdername"},
      // add_business_owner1name:"required",
      // add_business_owner1role:"required",
      // add_business_owner1mobile:{number:true,minlength:10, maxlength:10},
      // add_business_owner1email:{email: true },
      // add_business_owner2mobile:{minlength:10, maxlength:10},
      // add_business_owner2email:{email: true },
      // add_business_status:"required",

     /* 
       add_business_debitcardno:{required:function (){
            $("#add_newbusiness_payment_mode:checked").val()==2;
          },number:true,minlength:5, maxlength:18},
       add_business_debitcard_expireddate:{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==2;
        }
        },   
        add_business_creditcardno:{
          required:function (){
            $("#add_newbusiness_payment_mode:checked").val()==3;
          },number:true,minlength:5, maxlength:16
        },
        add_business_creditcard_expireddate :{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==3;
          }
        },
       add_business_chequeaccountno:{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==6;
             
          
        },number:true,minlength:2, maxlength:18
        },
       add_business_chequeno:{ required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==6;
        },number:true,minlength:2, maxlength:10},
       add_business_cchequeno:{
          required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==6;
            
        },number:true,minlength:2, maxlength:10,equalTo: "#add_business_chequeno"},
        add_business_cheque_micr:{required:function(){
           $("#add_newbusiness_payment_mode:checked").val()==6;
        },number:true},
       add_business_cheque_photo :{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==6;
           
        }},
        add_business_chequeissuedate:{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==6; 
            
        }},
      // add_business_phonepay:{number:true,minlength:5, maxlength:12},
      // add_business_amazonpay:{number:true,minlength:5, maxlength:12},
      // add_business_googlepay:{number:true},
       add_business_cashamount :{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==1; 
            
        },number:true},
       add_business_cashdate :{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==1; 
            
        }},
       add_business_personame:{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==1;
           
        }},
       add_business_placename:{required:function(){
          $("#add_newbusiness_payment_mode:checked").val()==1;
            
        }},
        add_business_neftnumber:{required:function(){
          
          $("#add_newbusiness_payment_mode:checked").val()==7;
          },number:true},*/
    }
});

businessform.children("div").steps({
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
         

         var paymentmodeid = $("#add_newbusiness_payment_mode:checked").val();
         var add_business_creditcard_expireddate=$("#add_business_creditcard_expireddate").val();
         var add_business_creditcardno=$("#add_business_creditcardno").val();
         
         if(paymentmodeid==3 && (!add_business_creditcard_expireddate || add_business_creditcard_expireddate.length<=0) && (!add_business_creditcardno ||  add_business_creditcardno.length<=0)){
            alert("Please fill all Credit Card Mode options!!!");
            return false;
         }
         
         var add_business_chequeaccountno=$("#add_business_chequeaccountno").val();
         var add_business_chequeno=$("#add_business_chequeno").val();
         var add_business_cchequeno=$("#add_business_cchequeno").val();
         var add_business_cheque_micr=$("#add_business_cheque_micr").val();
         var add_business_cheque_photo=$("#add_business_cheque_photo").val();
         var add_business_chequeissuedate=$("#add_business_chequeissuedate").val();
         
         if(paymentmodeid==6 && (!add_business_chequeaccountno || add_business_chequeaccountno.length<=0) && (!add_business_chequeno ||  add_business_chequeno.length<=0) && (!add_business_cchequeno || add_business_cchequeno.length<=0) && (!add_business_cheque_micr || add_business_cheque_micr.length<=0) && (!add_business_cheque_photo || add_business_cheque_photo.length<=0) && (!add_business_chequeissuedate || add_business_chequeissuedate.length<=0)){
            alert("Please fill all Cheque Mode options!!!");
            return false;
         }
         
         var add_business_cashamount=$("#add_business_cashamount").val();
         var add_business_cashdate=$("#add_business_cashdate").val();
         var add_business_personame=$("#add_business_personame").val();
         var add_business_placename=$("#add_business_placename").val();
         
         if(paymentmodeid==1 && (!add_business_cashamount || add_business_cashamount.length<=0) && (!add_business_cashdate ||  add_business_cashdate.length<=0) && (!add_business_personame ||  add_business_personame.length<=0) && (!add_business_placename ||  add_business_placename.length<=0)){
            alert("Please fill all Cash Mode options!!!");
            return false;
         }
         
         var add_business_debitcardno=$("#add_business_debitcardno").val();
         var add_business_debitcard_expireddate=$("#add_business_debitcard_expireddate").val();
         if(paymentmodeid==2 && (!add_business_debitcardno || add_business_debitcardno.length<=0) && (!add_business_debitcard_expireddate || add_business_debitcard_expireddate.length<=0)){
            alert("Please fill all Debit Card Mode options!!!");
            return false;
         }
          
         var add_business_neftnumber=$("#add_business_neftnumber").val();
         if(paymentmodeid==7 && (!add_business_neftnumber || add_business_neftnumber.length<=0)){
            alert("Please fill all NEFT/IMPS Mode options!!!");
            return false;
         }
           
         if (currentIndex < newIndex)
        {
            // To remove error styles
            $(".body:eq(" + newIndex + ") label.error", businessform).remove();
            $(".body:eq(" + newIndex + ") .error", businessform).removeClass("error");
        }
        //alert(businessform.valid());
        var result = $('ul[aria-label=Pagination]').children().find('a');
        $(result).each(function ()  { 
           if($(this).text() == 'Finish') {
               $(this).attr('disabled', true);
               $(this).css('background', 'green');
               
           }
           });
        
        //alert(currentIndex);
        businessform.validate().settings.ignore = ":disabled,:hidden";
        return businessform.valid();
        // newpaymentmode.validate().settings.ignore = ":disabled,:hidden";
        // return newpaymentmode.valid();


    },

  onStepChanged: function (event, currentIndex)
    {   

      var total=0;
      var packagetotal=0;
      var campaigntotal=0; 
      var package=0;
    
    var uppersaleamount = $("#add_business_uppersale_amount").val();
     if (uppersaleamount>0) {
        var uppersaleamount=Number(uppersaleamount);
     }else{
        var  uppersaleamount=0;
        // alert(uppersaleamount);
     }

    if (currentIndex==5) {
          viewpackagelist(uppersaleamount);
          // alert(uppersaleamount);
        }    

      $('#business_totalamount1').show();
      // $('#business_grandtotalamount').empty();
      $('#business_campaignlist1').empty();
        var n = $("#add_newbusiness_campaign:checked").length;
        if (n > 0){
            $("#add_newbusiness_campaign:checked").each(function(){
                //var campaign_id= $(this).val();
                var campainname=$(this).attr("data-newcname");
                var campaignamount=$(this).attr("data-newcamount");
                campaigntotal += Number(campaignamount);

        $('#business_campaignlist1').append('<div class="col-sm-6 col-6 form-group"><label>'+campainname+'</label></div> <div class="col-sm-6 col-6 form-group"><label>'+campaignamount+'</label></div>');   
  
            });

        }

        $('#business_packagelist1').empty();
        var n = $("#add_newbusiness_package:checked").length;
        if (n > 0){
            $("#add_newbusiness_package:checked").each(function(){
                var packagename=$(this).attr("data-newpname");
                var packageamount=Number($(this).attr("data-newpamount"));
                 package += Number(packageamount); 
                var packageamount=Number(packageamount+uppersaleamount);  
                packagetotal += Number(packageamount); 
               
        $('#business_packagelist1').append('<div class="col-sm-6 col-6 form-group"><label>'+packagename+'</label></div> <div class="col-sm-6 col-6 form-group"><label>'+packageamount+'</label></div>');   
  
            });
        }
      

    
     
     var totaluppersaleamount = Number(packagetotal-package); 
      $('#add_business_totaluppersale_amount').val(totaluppersaleamount); 
  
      var domainamount_checked = $('#add_business_domainamount_checked:checked').val();
     if(domainamount_checked==1){
          var business_domainamount=$("#add_business_domainamount").val();
           var domainamount='<div class="col-sm-6 col-6 form-group"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6 form-group "><label>'+business_domainamount+'</label></div>'
       }else{
           var business_domainamount= 0;
           var domainamount=' ';
       }

     var business_domainamount=Number(business_domainamount);
     var totalpackageamount=Number(campaigntotal+packagetotal); 
     var total=Number(totalpackageamount+business_domainamount); 
     var total= parseFloat(total).toFixed(2); 
     var state_id = $('#add_business_state').val();
     var tdsvalue = $('#add_business_tds:checked').val();
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

     if(state_id==32){
        var cgst=Number(total*9/100);
        var sgst=Number(total*9/100);
        var cgst= parseFloat(cgst).toFixed(2);
        var sgst= parseFloat(sgst).toFixed(2);
        var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)-parseFloat(tds);
        var grandtoatal= parseFloat(grandtoatal).toFixed(2);
        var grandtoatal =Math.round(grandtoatal);
        var gst='<div class="col-sm-6 col-6 form-group"> <label> CGST </label></div> <div class="col-sm-6 col-6 form-group"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 form-group"> <label> SGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+sgst+'</label></div>'+tdsview+' ';
     }else if(state_id!=32){
       var igst=Number(total*18/100);
       var igst= parseFloat(igst).toFixed(2);
       var grandtoatal= parseFloat(total) + parseFloat(igst)-parseFloat(tds);
       var grandtoatal= parseFloat(grandtoatal).toFixed(2);
       var grandtoatal =Math.round(grandtoatal);
       gst='<div class="col-sm-6 col-6 form-group"> <label>IGST</label></div> <div class="col-sm-6 col-6 form-group"><label>'+igst+'</label></div>'+tdsview+' ';
     } 

     $('#business_totalamount1').empty();
     $('#business_totalamount1').append('<div class="col-sm-12 col-12"> <div class="row clearfixed"> <div class="col-sm-6 col-6 form-group"> <label> Packages Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+totalpackageamount+'</label></div> '+domainamount+' <div class="col-sm-6 col-6 form-group"> <label> Gross Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 form-group"> <label> Total Amount </label></div> <div class="col-sm-6 col-6 form-group"><label>'+grandtoatal+'</label></div> </div></div>');
  
      
      $('#add_business_totalpackageamount').val(totalpackageamount);
      $('#add_business_totalamount').val(total);
      $('#add_business_grandtotalamount').val(grandtoatal);


      // $('#add_business_packages_total').val(total);
      // $('#business_packages_total').val(total);
      // $('#business_packages_state_id').val(state_id);

      },

    onFinishing: function (event, currentIndex)
    {
        businessform.validate().settings.ignore = ":disabled";
        return businessform.valid();
        //return true;
    },
    onFinished: function (event, currentIndex)
    {
      //alert('submitted!!!');
     var paymentmodeid = $("#add_newbusiness_payment_mode:checked").val();
         var add_business_creditcard_expireddate=$("#add_business_creditcard_expireddate").val();
         var add_business_creditcardno=$("#add_business_creditcardno").val();
         if(paymentmodeid==3 && (!add_business_creditcard_expireddate || add_business_creditcard_expireddate.length<=0) && (!add_business_creditcardno ||  add_business_creditcardno.length<=0)){
           alert("Please fill all Credit Card Mode options!!!");
            return false;
         }
         
         var add_business_chequeaccountno=$("#add_business_chequeaccountno").val();
         var add_business_chequeno=$("#add_business_chequeno").val();
         var add_business_cchequeno=$("#add_business_cchequeno").val();
         var add_business_cheque_micr=$("#add_business_cheque_micr").val();
         var add_business_cheque_photo=$("#add_business_cheque_photo").val();
         var add_business_chequeissuedate=$("#add_business_chequeissuedate").val();
         
         if(paymentmodeid==6 && (!add_business_chequeaccountno || add_business_chequeaccountno.length<=0) && (!add_business_chequeno ||  add_business_chequeno.length<=0) && (!add_business_cchequeno || add_business_cchequeno.length<=0) && (!add_business_cheque_micr || add_business_cheque_micr.length<=0) && (!add_business_cheque_photo || add_business_cheque_photo.length<=0) && (!add_business_chequeissuedate || add_business_chequeissuedate.length<=0)){
             alert("Please fill all Cheque Mode options!!!");
            return false;
         }
         
         var add_business_cashamount=$("#add_business_cashamount").val();
         var add_business_cashdate=$("#add_business_cashdate").val();
         var add_business_personame=$("#add_business_personame").val();
         var add_business_placename=$("#add_business_placename").val();
         
         //alert(paymentmodeid);
         if(paymentmodeid==1 && (!add_business_cashamount || add_business_cashamount.length<=0) && (!add_business_cashdate ||  add_business_cashdate.length<=0) && (!add_business_personame ||  add_business_personame.length<=0) && (!add_business_placename ||  add_business_placename.length<=0)){
            alert("Please fill all Cash Mode options!!!");
            return false;
         }
         
         var add_business_debitcardno=$("#add_business_debitcardno").val();
         var add_business_debitcard_expireddate=$("#add_business_debitcard_expireddate").val();
         if(paymentmodeid==2 && (!add_business_debitcardno || add_business_debitcardno.length<=0) && (!add_business_debitcard_expireddate || add_business_debitcard_expireddate.length<=0)){
          alert("Please fill all Debit Card Mode options!!!");
            return false;
         }
          
         var add_business_neftnumber=$("#add_business_neftnumber").val();
         if(paymentmodeid==7 && (!add_business_neftnumber || add_business_neftnumber.length<=0)){
           alert("Please fill all Neft/IMPS Mode options!!!");
            return false;
         }
         
     var formData = new FormData($("#add_businessdata")[0] );

     $.ajax({
      type:"POST",
      url:url+"BusinessController/saveBusinessData",
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

        $('#businessdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
        $( "#businessdata-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_businessdata')[0].reset(); 
           var dataurl =result.data;
           window.open(dataurl,'_blank');
           window.setTimeout(function(){location.reload()},3000);
        }
      else{
        $('#businessdata-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#businessdata-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
   complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      $('#businessdata-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#businessdata-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");     
    } 
         
      });

    }
});


// Marketing  person City select start //

$("#marketing_selected_city").on('change', function() {  
 var id= $("#marketing_selected_city").val();
    $.ajax({
    type: "GET",
    url:url+'BusinessController/getCityByIdForMarketing/'+id,
    dataType: 'json',
    success:function(result){
          if(result.success===true)
          { 
            setTimeout('window.location.href = "'+url+'Marketing"; ',100);
          }else{
                alert('request failed', 'error');
          }

      },
   
    fail:function(result){
        alert('Information request failed: ' + textStatus, 'error');
      }

  });


});
 
// Marketing  person City select End  //





//===== selected campaign start===//


$(document).on('click', '.selectedpackages a', function(e){

 var id= $(this).attr("data-businessid");
 var name=$(this).attr("data-businessname");
 var state_id=$(this).attr("data-businessstate_id");
$("#add_packages_companyname_state_id").val(state_id);
$("#add_packages_companyname").val(id);
$("#cname").html(name);
$(".listbusiness-class").hide();
$(".addpackages-class").show();


   });
 



  $("#business_applypromocode").click(function(){
 var business_packages_promocode = $('#business_packages_promocode').val();
 var totalamount = $('#add_business_totalpackageamount').val();
 var state_id = $('#add_business_state').val();
 var tdsvalue = $('#add_business_tds:checked').val();
 var domainamount_checked = $('#add_business_domainamount_checked:checked').val();
     

    $.ajax({
    type: "POST",
    url:url+'BusinessController/getAmountPromocodeforBusiness',
    data:{business_packages_promocode:business_packages_promocode},
    dataType: 'json',
    
  success:function(result){
      if(result.success===true)
      { 
    $('#business_totalamount1').hide();
    var discountamount=0 ;
          if(result.data[0].discount_amount !='NULL' && result.data[0].discount_amount >0){
          $( "#business_promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_amount+"Rs Discount to Using this Promocode </div>"); 
            discountamount=result.data[0].discount_amount;
            var discountamount= parseFloat(discountamount).toFixed(2);
          }else if(result.data[0].discount_percentage != 'NULL'){
          $("#business_promcodeamount-msg" ).html("<div class='alert alert-success'>"+result.data[0].discount_percentage+"% Discount to Using this Promocode </div>");   
                  var percentage=result.data[0].discount_percentage; 
                  discountamount =(totalamount/100) * percentage ;
          var discountamount= parseFloat(discountamount).toFixed(2);
          }

        $('#business_grandtotalamount').empty();
         if(domainamount_checked==1){
           var business_domainamount=$("#add_business_domainamount").val();
           var business_domainamount = Number(business_domainamount);
           var domainamount='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+business_domainamount+'</label></div>'
         }else{
           var business_domainamount= 0;
           var domainamount=' ';
         }
         var totalpackageamount=totalamount-discountamount;
         var total=Number(totalpackageamount+business_domainamount); 
      if(tdsvalue==1){
            var tds=Number(total*2/100);
            var tds= parseFloat(tds).toFixed(2);
            var tdsview='<div class="col-sm-6 col-6"> <label> TDS </label></div> <div class="col-sm-6 col-6"><label>'+tds+'</label></div>'
         }else{
             var tds= 0;
             var tdsview=' ';
         }

        if(state_id==32){
              var cgst=Number(total*9/100);
              var sgst=Number(total*9/100);

              var cgst= parseFloat(cgst).toFixed(2);
              var sgst= parseFloat(sgst).toFixed(2);
              var grandtoatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
              var grandtoatal= parseFloat(grandtoatal).toFixed(2);
               var grandtoatal =Math.round(grandtoatal);
              
              var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6"> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
             
           }else{
             var igst=Number(total*18/100);
             var igst= parseFloat(igst).toFixed(2);
             var grandtoatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
             var grandtoatal= parseFloat(grandtoatal).toFixed(2);
              var grandtoatal =Math.round(grandtoatal);
             var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div>'+tdsview+'';
            
           } 
 
      $('#business_grandtotalamount').append(' <div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Amount </label></div> <div class="col-sm-6 col-6"><label>'+discountamount+'</label></div> <div class="col-sm-6 col-6"><label> Discount Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>')

      $('#add_business_grandtotalamount').val('');
      $('#add_business_packages_discountamount').val(discountamount);
      $('#add_business_packages_promocode_id').val(result.data[0].id);
      $('#add_business_totalpackageamount').val(totalamount);
      $('#add_business_promocode_grandtotalamount').val(grandtoatal);

       
        }else if(result.success==false){

          $('#business_totalamount1').hide(); 
          $('#business_grandtotalamount').empty();
          $('#business_promcodeamount-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);   
          $("#business_promcodeamount-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>"); 
    
       if(domainamount_checked==1){
           var business_domainamount=$("#add_business_domainamount").val();
           var business_domainamount = Number(business_domainamount);
           var domainamount='<div class="col-sm-6 col-6"> <label> Domain Amount </label></div> <div class="col-sm-6 col-6"><label>'+business_domainamount+'</label></div>'
         }else{
           var business_domainamount= 0;
           var domainamount=' ';
         }

      var totalpackageamount=Number(totalamount);
      var total=Number(totalpackageamount+business_domainamount);
      var total= parseFloat(total).toFixed(2); 
   
      if(tdsvalue==1){
          var tds=Number(total*2/100);
          var tds= parseFloat(tds).toFixed(2);
          var tdsview='<div class="col-sm-6 col-6"> <label> TDS </label></div> <div class="col-sm-6 col-6 "><label>'+tds+'</label></div>'
       }else{
           var tds= 0;
           var tdsview=' ';
       }

        if(state_id==32){
              var cgst=Number(total*9/100);
              var sgst=Number(total*9/100);
               var cgst= parseFloat(cgst).toFixed(2);
              var sgst= parseFloat(sgst).toFixed(2);
              var grand_toatal= parseFloat(total) + parseFloat(cgst)+parseFloat(sgst)+parseFloat(tds);
              var grand_toatal1= parseFloat(grand_toatal).toFixed(2);
              var grandtoatal =Math.round(grand_toatal1);
                var gst='<div class="col-sm-6 col-6"> <label> CGST </label></div> <div class="col-sm-6 col-6"><label>'+cgst+'</label></div> <div class="col-sm-6 col-6 "> <label> SGST</label></div> <div class="col-sm-6 col-6"><label>'+sgst+'</label></div>'+tdsview+'';
             
           }else if(state_id!=32){
             var igst=Number(total*18/100);
             var igst= parseFloat(igst).toFixed(2);
             var grand_toatal= parseFloat(total) + parseFloat(igst)+parseFloat(tds);
             var grand_toatal1= parseFloat(grand_toatal).toFixed(2);
             var grandtoatal =Math.round(grand_toatal1);
            var gst='<div class="col-sm-6 col-6"> <label>IGST</label></div> <div class="col-sm-6 col-6"><label>'+igst+'</label></div>'+tdsview+'';
           } 
       
        $('#business_grandtotalamount').append('<div class="col-sm-12 col-12"><div class="row clearfixed"><div class="col-sm-6 col-6"><label>Package Total </label></div> <div class="col-sm-6 col-6"><label>'+totalpackageamount+'</label></div>'+domainamount+'<div class="col-sm-6 col-6"><label> Gross Amount </label></div> <div class="col-sm-6 col-6"><label>'+total+'</label></div>'+gst+'<div class="col-sm-6 col-6 "> <label> Total Amount </label></div> <div class="col-sm-6 col-6"><label>'+grandtoatal+'</label></div></div>')
         
        $('#add_business_totalpackageamount').val(totalpackageamount);
        $('#add_business_grandtotalamount').val(grandtoatal);

      }

    },
 
 fail:function(result){
      
      alert('Information request failed: ' + textStatus, 'error');
    }


});
    });

// ==== business search starts == //

$("#search_business").validate({
     
     rules:{
        // search_business_cname :"required",
        // search_business_city :"required",
      
     }
 });

$("#searchbusiness").click(function() {
    if(!$("#search_business").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#search_business")[0] );
     $.ajax({
      type:"POST",
    url:url+"BusinessController/SearchBusinessList",
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
        BusinessViewList(result.data,result.role)
       }
      else if(result.success===false){
        alert('Information request failed:error, Please try Again....');
      }
    },
    
     complete:function(){
    // Hide image container
    $(".loader").hide();
}, 
    failure: function (result){

      alert('Information request failed: error, Please try Again....');
    } 

 });


});
// ==== business search ends == //





$("#generated_opt").click(function() {
var add_business_mobileno = $("#add_business_mobileno").val();
var add_newbusiness_payment_mode =$("input:radio[name=add_newbusiness_payment_mode]:checked").val(); 
var add_business_packages_total = $("#add_business_packages_total").val();
var add_business_packages_grandtotal = $("#add_business_packages_grandtotal").val();
   $.ajax({
    type:"POST",
    url:url+"Welcome/OtpSendToMobile",
    dataType: 'json',
    data:{add_business_mobileno:add_business_mobileno,add_newbusiness_payment_mode:add_newbusiness_payment_mode,add_business_packages_total:add_business_packages_total,add_business_packages_grandtotal:add_business_packages_grandtotal},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
          alert(result.message);
           $('#otpverficationmodal').modal('show');
        }
  else if(result.success==false){
        alert(result.message);
      }
    },
    
    failure: function (result){
      alert("Some thing went wrong try again ...");
    } 
         
      });

});

// }


$("#otp_verification").click(function() {
var mobileOtp = $("#mobileOtp").val();
 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"Welcome/OtpVerficationToMobile",
    dataType: 'json',
    data:{mobileOtp:mobileOtp},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
        
        $('#add_business_otp').val(mobileOtp);
        $('#otpverficationmodal').modal('hide');    
        alert(result.message);
   }
  else if(result.success===false){
       alert(result.message);
      }
    },
    
    failure: function (result){
     alert("Some thing went wrong try again ...");
    } 
         
      });

});



/* ====== add  keywords  details  start ===== */
$("#add_new_business_keywords").validate({
     
     rules:{
        add_new_business_keywords_name :"required"
     }
 });

$("#addnewbusinesskeywords").click(function() {
  
    if(!$("#add_new_business_keywords").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_new_business_keywords")[0] );
     $.ajax({
      type:"POST",
    url:url+"BusinessController/saveNewKeywords",
    dataType: 'json',
    data:formData,
    contentType: false, 
    cache: false,      
    processData:false,
      success: function(result){
      if(result.success==true){
        $('#businesskeywordsnew-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $( "#businesskeywordsnew-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_new_business_keywords')[0].reset();
        setTimeout(function(){
               $('#AddNewBusinesskeywordsModal').modal("hide");
                    }, 5000); 
       }else{
        $('#businesskeywordsnew-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#businesskeywordsnew-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#businesskeywordsnew-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#businesskeywordsnew-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
  });

});
/* ====== add  keywords  details  end ===== */



// Assignments Marketing Person dropdown Start//

$(document).on('click','.assignmentaddview a', function(e){
 
 var business_id= $(this).attr("data-assignmentid");
  $('#add_business_id').val(business_id);
  // alert(business_id);
$.ajax({
    type: "GET",
    url:url+'AssignmentsController/getMarketingUsersForAssignments/'+business_id,
    dataType: 'json',
 
  success:function(result){
      if(result.success==true)
      { 
   var items
   items+="<option value=''>--Select Marketing Users--</option>";
      $.each(result.data,function(index,itemlist){ 
        items+="<option value='"+itemlist.user_id+"'>"+itemlist.user_name+" ("+itemlist.designation+")</option>";
      });
      
      $("#add_assignment_markrting_user").html(items);
      }else{
            alert('request failed', 'error');
      }

    },
 
 fail:function(result){
      alert('Information request failed: ' + textStatus, 'error');
    }

});

});



$("#add_assignment").validate({
     rules:{
        add_message :"required",
        add_assignment_markrting_user:"required",
        add_appointment_date:"required",
     }
 });

$("#addassignment").click(function() {

  // alert("babu");
    if(!$("#add_assignment").valid())
   {
     return false;
   }
  
   var formData = new FormData($("#add_assignment")[0] );
     $.ajax({
      type:"POST",
    url:url+"AssignmentsController/saveAssignments",
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
        $('#assignment-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);    
          $( "#assignment-addmsg" ).html("<div class='alert alert-success'>"+result.message+"</div>");
        $('#add_assignment')[0].reset();
        setTimeout(function(){
               $('#AddassignmentModal').modal("hide");
                    }, 5000); 
           var dataurl =result.data;
           window.open(dataurl,'_blank');
      }
      else if(result.success===false){
        $('#assignment-addmsg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#assignment-addmsg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
     complete:function(){
    // Hide image container
    $(".loader").hide();
},
    failure: function (result){

      $('#assignment-addmsg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#assignment-addmsg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 

      });


});


// Assignments Marketing Person dropdown End //


 /* ====== keywords  details  start ===== */ 

viewBusinessKeywords();   
        function viewBusinessKeywords(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessController/getBusinessKeywordslist",
                async : true,
                dataType : 'json',
                success : function(result){
     if(result.success==true){

        businesskeywordsview(result.data);
      
              }        
                }
            });
        }

  function businesskeywordsview(keywordlist){
    
       var items = "";
       var edititems = "";
       var i;
       var n = keywordlist.length;

for(i=0;i<n;i++) {
   items+= '<div class="col-md-4 col-12 form-group"> <input type="radio"  value='+keywordlist[i].id+' id="add_business_businesskeyword" name="add_business_businesskeyword"  style="display: inline;"> <span class="form-label" for="add_business_businesskeyword"> '+keywordlist[i].category_name+' </span></div>'

       }

         $("#addkeywordsbusiness").html(items);
  
  }


// $("#searchbusinesskeywordscategory").click(function(){

$("#search_business_keyword").keyup(function() {
 var search_business_keyword = $('#search_business_keyword').val();
  var items =" ";
   $.ajax({
       type:"POST",
       url:url+"BusinessController/SearchKeywordsForBusinessList",
    dataType: 'json',
    data:{search_business_keyword:search_business_keyword},
    dataType: 'json',

 success: function(result){
      
      if(result.success===true){

          businesskeywordsview(result.data)
   }
  else if(result.success===false){
        $('#search_business_keywords-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_business_keywords-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_business_keywords-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_business_keywords-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });

});

/* ======  keywords  details  end ===== */
/* ======  demo websites  details start ===== */
$("#searchbusinesswebcategory").click(function(){
  var search_website = $('#search_business_website').val();
  // alert(search_website);
  searchdemowebsitesByCategory(search_website);
});
/* ======  demo websites  details end ===== */ 

// Business Export Start //


$('#business_excel').click(excelexport);
$('#business_pdf').click(excelexport);
$('#business_print').click(excelexport);
function DownloadExcel(link) {
   var downloadurl=url+link;
  // alert(downloadurl);
  window.open(downloadurl,'_blank');
}
function excelexport(){
  var export_type='';
  var id = this.id;
  if(id=='business_excel'){
    export_type=$("#business_excel").val();
    
  }
  if(id=='business_pdf'){
    export_type=$("#business_pdf").val();  
  }
  if(id=='business_print'){
    export_type=$("#business_print").val();  
  }
  var obj=  {export_type:export_type};
  var data = JSON.stringify(obj);
  
  jQuery.ajax({
    type: "POST",
    url:url+"BusinessController/businessListExport",
    dataType: 'json',
    data:data,
    success: function(result){
      if(result.success===true){
           $('#msg').hide().fadeIn('slow').delay(1350).fadeOut(2200);   
           $("#msg").html("<div class='alert alert-success'>"+result.message+"</div>");
          if(result.download_type=='excel' || result.download_type=='pdf'){
            DownloadExcel(result.data);
            return false;
          }else{
            
              var printWindow = window.open('', '', 'height=400,width=800');
              printWindow.document.write('<html><head><title>Business  List </title>');
              printWindow.document.write('</head><body >');
              printWindow.document.write(result.data);
              printWindow.document.write('</body></html>');
              printWindow.document.close();
              printWindow.print();
              
          }
          
      }
      else{
        //window.location.href= '';
        setTimeout(function(){
          $('#msg').html('<div class="alert alert-failure">No Data !...</div>');
        },1000);
        }
    },
    failure: function (result){
      setTimeout(function(){
        $('#msg').html('<div class="alert alert-failure">Something went wrong in App!...</div>');
      },1000);
      
    }
  });
}


 function viewpackagelist(uppersaleamout){
  var items="";
  var uppersaleamout = uppersaleamout;
   if (uppersaleamout>0) {
            var uppersaleamout=Number(uppersaleamout);
            // alert(uppersaleamout);
           
    }else{
              var uppersaleamout=0; 
              // alert(uppersaleamout);
             
    }

      $.getJSON(url+"Common/getPackagelist",function(packagelist){
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
       var package_amount=  Number(item.package_amount);
       var package_amount=  Number(package_amount+uppersaleamout)
      items+='<div class="col-md-6 col-xl-4 mt-2 mb-2 packageslist"><div class="card border-success border card-packages "> <div class="text-center pt-3 pb-2 "><h3>'+item.package_name+'</h3><h4 class="font-weight-normal mt-2 mb-2 id="package_uppersaleamout">Rs.'+package_amount+'</h4></div> <div class="scrollbar" ><span class="packages_scollbar"> '+sname+'</span></div> <p class="mt-3 mb-3 plan-cost text-gray text-center"> <label> <input type="checkbox"  value='+item.id+'  id="add_newbusiness_package" name="add_newbusiness_package[]" data-newpname="'+item.package_name+'" data-newpamount="'+item.package_amount+'"> Select Package </label></p></div></div>';
    });
     
  });
        
        $("#addbusinesspackagelist").html(items);
  });

}






//============== demo websites start ====//
viewDemowebsites();   
        function viewDemowebsites(){
            $.ajax({
                type  : 'GET',
                url   : url+"BusinessController/SearchWebsitesForBusinessList",
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
        items+='<div class="col-md-4 col-12 form-group"><div class="demoweb card">  <img src="'+url+demowebsites[i].web_photo+'" alt="web image" class="image"><div class="container"><h6 class="p-2">'+demowebsites[i].web_name+'</h6></div><div class="overlay"><div class="text"><a  href="'+demowebsites[i].web_url+'" class="btn btn-info btn-rounded btn-fw mb-3" target="_blank">Live Demo</a><a  href="'+demowebsites[i].web_url+'" class="btn btn-light btn-rounded btn-fw" target="_blank">Preview</a> </p> <p> <input type="checkbox"  value='+demowebsites[i].web_url+' id="add_business_demolink" name="add_business_demolink[]"> Select Demo Links </p> </div></div></div> <p class="mt-3 mb-3 plan-cost text-gray text-center">  </div>';
     }    

        $("#demowebsitesbusiness").html(items);

  }

function searchdemowebsitesByCategory(search_website){

  var search_business_website = search_website;
 var items =" ";
   $.ajax({
       type:"POST",
       url:url+"BusinessController/SearchWebsitesForBusinessList",
    dataType: 'json',
    data:{search_business_website:search_business_website},
    dataType: 'json',

 success: function(result){
      
      if(result.success==true){
        
        viewDemowebsitesList(result.data);  
      }
  else if(result.success==false){
        $('#search_business_website-msg').hide().fadeIn('').delay(1000).fadeOut(2200);
        $( "#search_business_website-msg" ).html("<div class='alert alert-danger'>"+result.message+"</div>");
      }
    },
    
    failure: function (result){
      $('#search_business_website-msg').hide().fadeIn('slow').delay(1000).fadeOut(2200);
      $( "#search_business_website-msg" ).html("<div class='alert alert-danger'>Some thing went wrong try again ...</div>");      
    } 
         
      });

}
//============== demo websites end =====//


