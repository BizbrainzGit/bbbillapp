<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
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

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdUmQev-C9BJCwDzgvL8wn00tNeKxKwVQ&callback=myMap"></script>

   <script src="/<?php echo base_url();?>assets/js/google-maps.js"></script>
  
  <!-- Custom js for this page-->
  <script src="/<?php echo base_url();?>assets/js/wizard.js"></script>
   <script src="/<?php echo base_url();?>assets/js/owl-carousel.js"></script>
  <!-- End custom js for this page-->
    <script src="/<?php echo base_url();?>assets/js/select2.js"></script>
  <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script>  
  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script>  
  <script src="/<?php echo base_url();?>assets/js/Common/common.js"></script>
   <script src="/<?php echo base_url();?>assets/js/Common/BusinessController.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/BusinessCPselectedController.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/DealClosedController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/DashboardController.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/BusinessSelectedPackageController.js" type="text/javascript"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/BusinessTransactionController.js" type="text/javascript"></script>

	</body>
</html>
 
<!-- keywords add model start-->



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_submit_btn, razorpay_instance;
  function razorpaySubmit(el){
var email=document.getElementById('razorpay_email').value;
var mobileno=document.getElementById('razorpay_mobileno').value;
var card_holder_name=document.getElementById('razorpay_pname').value;
var razorpay_order_id=document.getElementById('razorpay_order_id').value;
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
