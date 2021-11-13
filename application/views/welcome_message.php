<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Empty_Header.php');
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="/<?php echo base_url();?>assets/images/logo.png" height="60" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" class="cmxform" id="loginForm" method="post" action="#">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" required>
                </div>
                 <label class="mt-3"> <input type="checkbox" onclick="passwordShow()"> &nbsp; Show Password</label>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="login-button" type="submit" value="Submit">SIGN IN</a>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="/<?php echo base_url();?>Welcome/forgotPassword" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!--<div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="/<?php echo base_url();?>Welcome/RegisterView" class="text-primary">Create</a>
                </div>-->
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php
include('static/Empty_Footer.php');
?>

<script type="text/javascript">

function passwordShow() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


// $('#login-button').keydown(function() {
 
// var key = e.which;
// if (key == 13) {
// // As ASCII code for ENTER key is "13"
// $('#login-button').submit(); // Submit form code
// }
// });

$("input").keypress(function(event) {
     // alert("babu");
    if (event.which == 13) {
        event.preventDefault();
        $('#login-button').click();
    }
});

</script>