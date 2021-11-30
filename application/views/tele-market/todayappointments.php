<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?>

<div class="main-panel">
<div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Today's Appointment List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                          <!--   <h5> Today's Appointment List
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddcampaignModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5> -->
                        </div>
                    </div>
                     <div class="col-12">
                      <!-- <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div> -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="todayappointmentsstablelist" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


   <!-- partial:partials/_footer.html -->
          <div class="footer-wrapper">
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 BizBrainz Technologies Private Limited. All rights reserved. </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz Technologies Private Limited.</a> </span>
              </div>
            </footer>
          </div>
          <!-- partial -->
        <!-- main-panel ends -->
        </div>
      <!-- page-body-wrapper ends -->
      </div>
    </div>
    <!-- container-scroller -->



       
         
<?php
include('Layouts/tele-marketLayout_Footer.php');
?>

 <script src="/<?php echo base_url();?>assets/js/Common/TodayAppointmentsController.js"> </script>