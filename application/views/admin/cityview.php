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
                  <h4 class="card-title">Manage City
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddcityModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                         
                        </div>
                    </div>
                   <!--   <div class="col-12">
                      <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="citytable" class="table table-hover">
                    
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


  <!-- The Modal -->
  <div class="modal fade" id="EditcityModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="edit_cityname_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="city-editmsg"></div>
                        <form id="edit_city" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_city_id" name="edit_city_id">
                                        <label>City Name :</label>
                                        <input type="text" class="form-control" placeholder="City Name" name="edit_city_name" id="edit_city_name">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>City Short Code :</label>
                                        <input type="text" class="form-control" placeholder="City Short Codet" name="edit_city_shortcode" id="edit_city_shortcode">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select State:</label>
                                        <select class="form-control" name="edit_city_state" id="edit_city_state">
                                        </select>
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Status:</label>
                                        <select class="form-control" name="edit_city_status" id="edit_city_status">
                                        	<option value=" ">Select Status</option>
                                        	<option value="1">Active</option>
                                        	<option value="0">In-Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatecity" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- city add model start-->


<div class="modal  fade" id="AddcityModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add City </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="city-addmsg"></div>
                    <div class="body">
                        <form id="add_city" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>City Name :</label>
                                        <input type="text" class="form-control" placeholder="City Name" name="add_city_name" id="add_city_name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>City Short Code :</label>
                                        <input type="text" class="form-control" placeholder="City Short Code" name="add_city_shortcode" id="add_city_shortcode">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select State:</label>
                                        <select class="form-control" name="add_city_state" id="add_city_state">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Status:</label>
                                        <select class="form-control" name="add_city_status" id="add_city_status">
                                        	<option value="">Select Status</option>
                                        	<option value="1">Active</option>
                                        	<option value="0">In-Active</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                      
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
        
          <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addcity" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- city add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
   
<script src="/<?php echo base_url();?>assets/js/Common/CityController.js" type="text/javascript"></script>
