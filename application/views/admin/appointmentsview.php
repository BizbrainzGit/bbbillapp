<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>

<div class="main-panel">
<div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Appointment List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                          
                        </div>
                    </div>
                     <!-- <div class="col-12">
                      <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="appointmentstable" class="table table-hover">
                    
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
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 BizBrainz Technologies Private Limited All rights reserved. </span>
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


  <div class="modal fade appointment_edit" id="EditappointmentModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Appointment Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="appointment-editmsg"></div>
                        <form id="edit_appointment" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_appointment_id" name="edit_appointment_id">
                                        <label>Company Name :</label>
                                        <span name="edit_company_name" id="edit_company_name"></span>
                                    </div>
                                </div>
                                 <!--  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Person Name :</label>
                                       <span class="form-control" name="edit_person_name" id="edit_person_name"></span>
                                    </div>
                                </div> -->
                                <div class="col-sm-12">
                                    <div id="image"></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Status:</label>
                                       <select class="form-control"  name="edit_status" id="edit_status" > </select>
                                    </div>
                                </div>
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                             <button type="button" id="updateappointment" class="btn btn-primary">Update</button>
                             <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
<!-- <script src="/<?php echo base_url();?>assets/js/Common/AssignmentsController.js" type="text/javascript"></script> -->
