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
               <img src="/<?php echo base_url();?>assets/images/logo.png" style="height:45px;" alt="logo"/>
              </div>
              <div id="alert-msg"></div>
              <h4>Forgotten Password ?</h4>
			  <h6 class="font-weight-light">Enter your email to reset your password:</h6>
			  <form class="pt-3" class="cmxform" id="forgotPasswordForm" method="post" action="#">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Username" required>
                </div>
				<div class="mt-3">
          <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="forgot-button" type="button" value="Submit">Request</a>
                </div>
			  </form>
<?php
include('static/Empty_Footer.php');
?>