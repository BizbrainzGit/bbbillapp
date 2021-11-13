<!DOCTYPE html>
<html lang="en">

<head>
<title>Bill-App</title>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bill-App Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    <link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/favicon.png" />
<!-- plugin css for this page -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  

<!-- inject:css -->
     <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">
    <style type="text/css">

.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url("<?php echo base_url();?>/assets/images/loading.gif") 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
    </style>
</head>


<body>
<?php
$txnid = time();
$merchant_order_id="BB_RAZORPAY_".$txnid;
$surl = '/'.base_url().'CustomerBuyController/success';
$furl = '/'.base_url().'CustomerBuyController/failed';        
$key_id = $this->config->item('RAZOR_KEY_ID');
$currency_code = $this->config->item('DISPLAY_CURRENCY'); 
$card_holder_name=isset($card_holder_name)?$card_holder_name:"Test";
$productinfo=isset($merchant_product_info_id)?$merchant_product_info_id:null;
 ?>
<div class="modal fade" id="razorPayModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pay Now</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="body">
              <div class="row clearfix">
                   <div class="col-sm-12">
                      <h6>Are you sure you want to Pay Online?</h6>
                    </div>
                    <div class="col-sm-12">
                        <form name="razorpay-form" id="razorpay-form" action="/<?php echo base_url();?>CustomerBuyController/callback" method="POST" target="_blank">
                          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                          <input type="hidden" name="razorpay_signature" id="razorpay_signature" />
                          <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                          <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                          <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                          <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                          <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                          <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                          <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                          <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                          <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value=""/>
                        </form>
                   </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
          <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Yes" class="btn btn-primary" />
          <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
<!-- Order ID-->
<div class="modal fade"  role="dialog" id="orderGeneration">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Generation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <div id="orderMessage"></div>
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                <h6>Are you sure you want to Genarate an Order?</h6>
                              </div>
                                <div class="col-sm-12">
                <form name="orderRazorpayForm" id="orderRazorpayForm" method="POST">
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                </form>
                                </div>
                                  
                            </div>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
            <button type="button" id="orderButton" class="btn btn-primary orderButton">Yes</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
<!-- End of Order ID-->
 <div class="loader" style="display: none"></div>
         <!--- Selected Pakges View   -->
    <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Details</h4>
                  <form id="add_sendlinkbuynow_packagesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                    <h3>Package Selection</h3>
                      <section>
                        <h3>Package Selection</h3>
                         <!--  <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div> -->

                          <input type="hidden" id="add_sendlinkbuynow_business_id" name="add_sendlinkbuynow_business_id" value="<?php echo $businessdata[0]['id']; ?>">
                          <input type="hidden" id="add_sendlinkbuynow_state_id" name="add_sendlinkbuynow_state_id" value="<?php echo $businessdata[0]['state_id']; ?>">
                          <input type="hidden" id="add_sendlinkbuynow_business_email" name="add_sendlinkbuynow_business_email" value="<?php echo $businessdata[0]['email']; ?>">
                          <input type="hidden" id="add_sendlinkbuynow_business_mobileno" name="add_sendlinkbuynow_business_mobileno" value="<?php echo $businessdata[0]['mobile_no']; ?>">
                           <input type="hidden" id="add_sendlinkbuynow_business_personname" name="add_sendlinkbuynow_business_personname" value="<?php echo $businessdata[0]['person_name']; ?>">


                          <div class="row pricing-table" id="add_sendlinkbuynow_packagelist"></div>
                           <div class="col-sm-12 col-12"> 
                             <input class="" type="checkbox" value="1" name="add_sendlinkbuynow_tds" id="add_sendlinkbuynow_tds">Pls Check TDS Applicable.
                          </div>
                      </section> 

                       <h3>Payment</h3>
                      <section>
                        <h3>Payment</h3>
                       <div class="row clearfixed" id="sendlinkbuynow_packagelist1">
                       </div>

                       <div class="row clearfixed" id="sendlinkbuynow_totalamount1">
                       </div>


                      <h3>Mode of Payments</h3>
                      <label> <button  class="btn btn-primary btn-md" type="button" value="8" id="add_sendlinkbuynow_payment_mode" name="add_sendlinkbuynow_payment_mode" onclick="showPaymentmode(this)"> Online Pay Now </button> </label>
                      <input type="hidden" class="form-control" name="add_sendlinkbuynow_razorpay_order_id" id="add_sendlinkbuynow_razorpay_order_id" value="<?php echo $merchant_order_id; ?>">
                       <input type="hidden" class="form-control" name="add_sendlinkbuynow_grandtotal" id="add_sendlinkbuynow_grandtotal">    
                      <input type="hidden" class="form-control" name="add_sendlinkbuynow_packages_total" id="add_sendlinkbuynow_packages_total">     
                    
                               <div class="form-check">
                                  <h4><label class="form-check-label">
                                  <input class="checkbox" type="checkbox" name="add_package_condition" id="add_package_condition">
                                    I Agree With The Terms and Conditions.
                                  </label></h4>
                                  <div id="sendlinkbuynowdata-addmsg"></div>
                              </div>

 
                      </section>
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
  
          <div class="footer-wrapper">
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 BizBrainz Technologies Private Limited All rights reserved. </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz Technologies Private Limited.</a> </span>
              </div>
            </footer>
          </div>
         


<script>
var base_url={ baseurl:"/<?php echo base_url();?>" };
</script>
<!-- base:js -->
    <script src="/<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="/<?php echo base_url();?>assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/<?php echo base_url();?>assets/vendors/flot/jquery.flot.js"></script>
    <script src="/<?php echo base_url();?>assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="/<?php echo base_url();?>assets/vendors/flot/curvedLines.js"></script>
    <script src="/<?php echo base_url();?>assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="/<?php echo base_url();?>assets/js/off-canvas.js"></script>
    <script src="/<?php echo base_url();?>assets/js/hoverable-collapse.js"></script>
    <script src="/<?php echo base_url();?>assets/js/template.js"></script>
    <script src="/<?php echo base_url();?>assets/js/settings.js"></script>
    <script src="/<?php echo base_url();?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/<?php echo base_url();?>assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->

  <script src="/<?php echo base_url();?>assets/vendors/jquery-steps/jquery.steps.min.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
  <!-- End plugin js for this page -->
  <script src="/<?php echo base_url();?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
   <script src="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

    <script src="/<?php echo base_url();?>assets/js/data-table.js"></script>
  
  <script src="/<?php echo base_url();?>assets/vendors/sweetalert/sweetalert.min.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/jquery.avgrund/jquery.avgrund.min.js"></script>
   <script src="/<?php echo base_url();?>assets/vendors/select2/select2.min.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

   <script src="/<?php echo base_url();?>assets/js/google-maps.js"></script>
  <!-- Custom js for this page-->
   <script src="/<?php echo base_url();?>assets/js/wizard.js"></script>
   <script src="/<?php echo base_url();?>assets/js/owl-carousel.js"></script>
   <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script> 
   <script src="/<?php echo base_url();?>assets/js/Common/CustomerBuyController.js"></script>
   <script src="/<?php echo base_url();?>assets/js/Common/SendLinkBuyNowController.js"></script>
  
  </body>
</html>


<script>

  function showPaymentmode(test){
    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('add_sendlinkbuynow_grandtotal').value)>0)? document.getElementById('add_sendlinkbuynow_grandtotal').value:document.getElementById('add_sendlinkbuynow_grandtotal').value;
    merchant_total=((grand_total*100)>0)? (grand_total*100):100;
    merchant_amount=((grand_total)>0)? grand_total:1;
     // alert(merchant_total);
     // alert(merchant_amount);
    document.getElementById('merchant_total').value=merchant_total;
    document.getElementById('merchant_amount').value=merchant_amount;
    // alert(grand_total);
    $(document).ready(function(){
    $('#orderButton').click(function(){
    var merchant_order_id= $("#merchant_order_id").val();
    var merchant_total= $("#merchant_total").val();
    var merchant_amount= $("#merchant_amount").val();
   $.ajax({
    type: "POST",
     dataType: 'json',
    url:base_url+"CustomerBuyController/CustomerBuyorderRazorPayGeneration",
    cache: false,
    data: {merchant_order_id:merchant_order_id,merchant_total:merchant_total,merchant_amount:merchant_amount},
    success: function(result) {
        if(result.success===true){
            $("#orderGeneration").modal("hide");
            $("#razorPayModal").modal();
            var razorpay_order_id=result.message;
            document.getElementById('razorpay_order_id').value=razorpay_order_id;
           }else{
              $('#orderMessage').hide().fadeIn('slow').delay(1000).fadeOut(2200);
             $( "#orderMessage").html("<div class='alert alert-danger'>Some thing went wrong Please try again ...</div>");
         }
    }
   });
  });
});
       
  }
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  
  var razorpay_submit_btn, razorpay_instance;
  function razorpaySubmit(el){
  //start of payment gateway razorpay
var email=document.getElementById('add_sendlinkbuynow_business_email').value;
var mobileno=document.getElementById('add_sendlinkbuynow_business_mobileno').value;
var card_holder_name=document.getElementById('add_sendlinkbuynow_business_personname').value;
var razorpay_order_id=document.getElementById('razorpay_order_id').value;
//alert(razorpay_order_id);
//alert(email);
//alert(mobileno);
//alert(card_holder_name);
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
  prefill:{
  },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    "handler": function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = transaction.razorpay_signature;
        
        document.getElementById('razorpay-form').submit();

       // document.getElementById("razorpay_payment_order_id").value=transaction.razorpay_payment_id ;
       // document.getElementById("razorpay_payment_transaction_amount").value=merchant_total1;
    },
    "modal": {
        "ondismiss": function(){
          $('#razorPayModal').modal('hide');
            console.log("This code runs when the popup is closed");
           // location.reload()
        }
    }
  };
razorpay_options.order_id=razorpay_order_id;
razorpay_options.amount=merchant_total;
razorpay_options.name=card_holder_name;
razorpay_options.prefill.name=card_holder_name;
razorpay_options.prefill.email=email;
razorpay_options.prefill.contact=mobileno;
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }   
  //end of payment gateway razorpay 
</script>