<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/hiliteui/template/demo/vertical-default-light/pages/samples/register-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 May 2019 11:07:05 GMT -->
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
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    <link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/favicon.png" />
<!-- plugin css for this page -->
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">

<!-- inject:css -->
     <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->

    <link rel="stylesheet" href="/<?php echo base_url();?>assets/css/custom.css">

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
               <img src="/<?php echo base_url();?>assets/images/logo.png" style="height:45px;" alt="logo"/></a>
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Join us today! It takes only few steps</h6>
              <form class="pt-3" id="marketing_selectedcity_form" name="marketing_selectedcity_form" method="post">
                <div class="form-group">
                  <label>Select City</label>
                  <select class="form-control form-control-lg" id="marketing_selected_city" name="marketing_selected_city" >
                    <option>City Name</option>
                   
                    <?php
                    for($i=0;$i<count($cityid);$i++)
                    {
                        echo "<option value=".$cityid[$i]['cityid'].">".$cityid[$i]['cityname']."</option>";
                    } ?>
                  </select>
                </div>
                <div class="mt-3">
                  <button type="button" class="btn btn-block btn-primary" id="marketing_selectedcity_btn" name="marketing_selectedcity_btn">Submit</button>
                </div>
              </form>
              <a class="dropdown-item" href="/<?php echo base_url();?>Common/logout">
    <i class="mdi mdi-logout text-primary"></i>
    Logout
    </a>
            </div>
          </div>
          <div class="col-lg-6 register-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2019 BizBrainz Technologies Private Limited All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
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

    <script src="/<?php echo base_url();?>assets/js/data-table.js"></script>
  
  <script src="/<?php echo base_url();?>assets/vendors/sweetalert/sweetalert.min.js"></script>
  <script src="/<?php echo base_url();?>assets/vendors/jquery.avgrund/jquery.avgrund.min.js"></script>
   <script src="/<?php echo base_url();?>assets/vendors/select2/select2.min.js"></script>

   <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnT63XUjqjPgXZ0lFTU_pdpfUX7swzTTM&amp;callback=initMap">
    
   </script> -->
<!-- 
   <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdUmQev-C9BJCwDzgvL8wn00tNeKxKwVQ&amp;callback=initMap">
 </script>
   
   <script src="/<?php echo base_url();?>assets/js/google-maps.js"></script>
   -->
  <!-- Custom js for this page-->
  <script src="/<?php echo base_url();?>assets/js/wizard.js"></script>
  <!-- End custom js for this page-->
    <script src="/<?php echo base_url();?>assets/js/select2.js"></script>
  <script src="/<?php echo base_url();?>assets/js/gobalSettings.js"></script> 
  <script src="/<?php echo base_url();?>assets/js/Common/common.js"></script> 
  <script src="/<?php echo base_url();?>assets/js/Common/BusinessController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/LoginController.js"></script>
  <script src="/<?php echo base_url();?>assets/js/Common/TodayAppointmentsController.js"></script>
</body>


<!-- Mirrored from www.urbanui.com/hiliteui/template/demo/vertical-default-light/pages/samples/register-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 May 2019 11:07:05 GMT -->
</html>
