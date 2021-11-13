<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Empty_Header.php');
?>



<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0"  >
        <div class="row w-100 mx-0">
          
          <div class="col-lg-4 col-md-12 col-sm-12 col-12" >
            <div class="auth-form-light py-2 px-2" style="overflow: hidden;">
               <img src="/<?php echo base_url();?>assets/images/Image_70flat.jpg" class="img-fluid" >

             </div>
          </div>

           <div class="col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="auth-form-light py-2 px-2" style="overflow: hidden;">
              <div class="row" style="text-align: center;">
                <div class=" col-md-6 col-sm-6 col-6" style="padding-top: 10px;" >
                   <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG"   alt="logo" class="img-fluid" >
                </div>
                 <div class=" col-md-6 col-sm-6 col-6" >
                    <img src="/<?php echo base_url();?>assets/images/logo.png" width="80" height="80"  alt="logo" class="img-fluid" >
                </div> 

              </div>
           
              <div id="leads-addmsg"></div>

               <div class="row mt-3">
                 <div class=" col-md-12 col-sm-12 col-12">

              <form method="post" id="add_leads">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="add_lead_name" name="add_lead_name" placeholder="Name">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="add_lead_email" name="add_lead_email" placeholder="Email">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="add_lead_mobileno" name="add_lead_mobileno" placeholder="Mobile Number">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="add_lead_bussiness" name="add_lead_bussiness" placeholder="Bussiness">
                </div>

                <div class="form-group">
                <textarea id="add_lead_message" name="add_lead_message"  placeholder="Your valubule words..." class="form-control form-control-lg"></textarea>

                </div>
               
                 <div class="row" style="text-align: center;">
                 <div class=" col-md-6 col-sm-6 col-6 form-group">
                   <button type="button" id="addleads" class="btn btn-primary" class="form-control">Save</button>
                </div>
                <div class=" col-md-6 col-sm-6 col-6 form-group">
                    <button type="reset" class="btn btn-danger" class="form-control">Cancel</button>
                </div>

              </div>
               
              </form>
           </div>
         </div>
      </div>
          </div>

            <div class="col-lg-4 col-md-12 col-sm-12 col-12" >
            <div class="auth-form-light py-2 px-2" style="overflow: hidden;" style="padding-top: 10px;">
               <img src="/<?php echo base_url();?>assets/images/Image_60falt.jpg" class="img-fluid" >

             </div>
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


