<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">


<head>
<title>Bill-App</title>
<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Bill-App Marketing Lead </title>
		<!-- base:css -->
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/<?php echo base_url();?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<!-- End plugin css for this page -->
    <link rel="shortcut icon" href="/<?php echo base_url();?>assets/images/BB_Icon.png" />
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

.notification {
  text-decoration: none;
  position: relative;
  display: inline-block;
  border-radius: 2px;
  text-align: center;
}
/*
.notification:hover {
  background: red;
}*/

.notification .badge {
  position: absolute;
  top: 8px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
}
    </style>
</head>
<body>

<div class="loader" style="display: none"></div>

<div class="container-scroller">
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
          <a class="navbar-brand brand-logo" href="/<?php echo base_url();?>Marketing-Lead"><img src="/<?php echo base_url();?>assets/images/logo.png" style="height:45px;" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="/<?php echo base_url();?>Marketing-Lead"><img src="/<?php echo base_url();?>assets/images/logo.png" height="40" alt="logo"/></a> 
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav">
	       <li class="nav-item  dropdown d-none align-items-center d-lg-flex d-none"> </li>
          
          </ul>
          <ul class="navbar-nav navbar-nav-right">
           <li class="nav-item">
              <div class="input-group">
                
                <div class="input-group-prepend">
                   <a href="/<?php echo base_url();?>Market-Lead-User-todayAppointments" class="notification btn btn-block btn-primary">
                     <span>Today Appointments </span>
                     <span class="badge" id="todayappointment_notification"></span>
                 </a>
                  <!-- <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                  </span> -->
                </div>
                <!-- <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search"> -->
              </div>
            </li>
	<li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" alt="image" style="width:37px;height: 37px;">
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <!--<p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>-->
		<a class="dropdown-item">
		<i class="mdi mdi-settings text-primary"></i>
		Settings
		</a>

       <a href="#" class="dropdown-item" data-toggle="modal" data-target="#changepswdModal">
       	<i class="mdi mdi-settings text-primary"></i> Change Password
       </a>
		<a class="dropdown-item" href="/<?php echo base_url();?>Common/logout">
		<i class="mdi mdi-logout text-primary"></i>
		Logout
		</a>
              </div>
            </li>
            
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
			<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<!-- partial:partials/_settings-panel.html -->
        <!--<div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options" id="sidebar-light-theme">
              <div class="img-ss rounded-circle bg-light border mr-3"></div>
              Light
            </div>
            <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
              <div class="img-ss rounded-circle bg-dark border mr-3"></div>
              Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles primary"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>-->
        
        <!-- partial -->
				<!-- partial:partials/_sidebar.html -->
				<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link d-flex">
              <div class="profile-image">
                <img src="/<?php echo base_url().$this->session->profile_pic_path;?>" alt="image">
              </div>
              <div class="profile-name">
                <p class="name">
                  <?php echo $this->session->name;?>
                </p>
                <p class="designation">
                  <?php echo $this->session->user_roles;?> 
                  
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Marketing-Lead">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-GForm-View">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">G - Form</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-Packages-List">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Our Packages</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-User-todayAppointments">
            <i class="mdi mdi-shield-check menu-icon"></i>
            <span class="menu-title">Today's Appointment</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-User-Assignments">
            <i class="mdi mdi-assistant menu-icon"></i>
            <span class="menu-title">Manage Assignments</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-manageBusiness">
            <i class="mdi mdi-hand-pointing-right menu-icon"></i>
            <span class="menu-title">Manage Business</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-BusinessSelectedPackages">
            <i class="mdi mdi-shield-check menu-icon"></i>
            <span class="menu-title"> Customer Packages Details </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-BusinessTransactions">
            <i class="mdi mdi-view-day menu-icon"></i>
            <span class="menu-title">Business Transactions </span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-DealClosed">
            <i class="mdi mdi-view-day menu-icon"></i>
            <span class="menu-title"> Deal Closed</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-Promocodes">
            <i class="mdi mdi-view-day menu-icon"></i>
            <span class="menu-title">Manage PromoCodes</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-Prospect-Leads">
            <i class="mdi mdi-shield-check menu-icon"></i>
            <span class="menu-title">Prospect leads </span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-SendDemoLinks">
            <i class="mdi mdi-shield-check menu-icon"></i>
            <span class="menu-title">Send Demo Links</span>
            </a>
          </li>

           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Reports</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="general-pages" style="">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                  <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-LoginReport"> User LogIn Report </a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" href="/<?php echo base_url();?>Market-Lead-DemolinksEmailReports"> Demo Likns Email Sending <br> Reports </a>
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
				<!-- partial -->

         <!-- Modal -->
  <div class="modal fade" id="changepswdModal" role="dialog">
    <div class="modal-dialog modal-md">
    <form method="post" id="changepasswordForm" name="changepasswordForm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>
        
        <div class="modal-body">
        
            <div id="alert-msg"></div>
          <div class="form-row">
            <div class="form-group col-md-12">
          <label for="old_password">Old Password</label>
          <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
        </div>
       </div> 
       <div class="form-row">
            <div class="form-group col-md-12">
          <label for="new_password">New Password</label>
          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
        </div>
       </div>
       <div class="form-row">
            <div class="form-group col-md-12">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        </div>
       </div>
          <div class="form-row">
              <div class="form-group col-md-12" style="text-align:center">
                <button type="button" id="cpswd_save" class="btn btn-primary">Submit</button>
                <button class="btn btn-secondary btn-md" type="reset"> Reset </button>&nbsp;
              </div>
           </div>
          
        </div>
        <div class="modal-footer">
          
      </div>

      </div>
      </form>
    </div>
  </div>		




<?php
$txnid = time();
$merchant_order_id="BB_RAZORPAY_".$txnid;
$surl = '/'.base_url().'BusinessController/success';
$furl = '/'.base_url().'BusinessController/failed';        
$key_id = $this->config->item('RAZOR_KEY_ID');
$currency_code = $this->config->item('DISPLAY_CURRENCY'); 
$card_holder_name=isset($card_holder_name)?$card_holder_name:"Test";
$productinfo=isset($merchant_product_info_id)?$merchant_product_info_id:null;
 ?>
<div class="modal fade" id="razorPayModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pay Now</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <div class="modal-body">
          <div class="body">
           <div class="row clearfix">
              <div class="col-sm-12">
                  <h6>Are you sure you want to Pay Online?</h6>
              </div>
              <div class="col-sm-12">
                <form name="razorpay-form" id="razorpay-form" action="/<?php echo base_url();?>BusinessController/callback" method="POST" target="_blank">
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
                  
                     <input type="hidden" name="razorpay_email" id="razorpay_email" value=""/>
                     <input type="hidden" name="razorpay_mobileno" id="razorpay_mobileno" value=""/>
                     <input type="hidden" name="razorpay_pname" id="razorpay_pname" value=""/>
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