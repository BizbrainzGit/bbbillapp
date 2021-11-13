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

   <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnT63XUjqjPgXZ0lFTU_pdpfUX7swzTTM&amp;callback=initMap">
   	
   </script> -->

   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdUmQev-C9BJCwDzgvL8wn00tNeKxKwVQ&amp;callback=myMap">
 </script>
   
   <script src="/<?php echo base_url();?>assets/js/google-maps.js"></script>
  
  <!-- Custom js for this page-->
  <script src="/<?php echo base_url();?>assets/js/wizard.js"></script>
   <script src="/<?php echo base_url();?>assets/js/owl-carousel.js"></script>
  <!-- End custom js for this page-->
    <script src="/<?php echo base_url();?>assets/js/select2.js"></script>
    <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script> 
  <script src="/<?php echo base_url();?>assets/js/Common/common.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/AssignmentsController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/BusinessCPselectedController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/DealClosedController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/GFormController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/DashboardController.js" type="text/javascript">
 </script>
  
	</body>
</html>
 
<!-- keywords add model start-->


<div class="modal  fade" id="AddNewBusinesskeywordsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Business Keywords</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="businesskeywordsnew-addmsg"></div>
                    <div class="body">
                        <form id="add_new_business_keywords" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Business Keyword :</label>
                                        <input type="text"  class="form-control" placeholder="Business Keyword" name="add_new_business_keywords_name" id="add_new_business_keywords_name">
                                    </div>
                                </div>
                            </div>
                       </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
                         <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addnewbusinesskeywords" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
        
      </div>
        </form>
      </div>
    </div>
  </div>
<!-- keywords add model end -->