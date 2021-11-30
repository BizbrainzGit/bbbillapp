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
                  <h4 class="card-title">Manage User City Mapping </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddcitymappingModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
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
                        <table id="citymappingtable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditcitymappingModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit City Mapping details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="citymapping-editmsg"></div>
                        <form id="edit_citymapping" method="post" >
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="edit_citymapping_id" name="edit_citymapping_id"> 
                                        <label>Market Lead User ID:</label>
                                         <select class="form-control" name="edit_marketlead_user" id="edit_marketlead_user">
                 
                                         </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Marketing User Id :</label>
                                         <select class="form-control" name="edit_user" id="edit_user">
                 
                                         </select>
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>City Mapping :</label>
                                         <select class="form-control js-example-basic-multiple w-100" multiple="multiple" name="edit_mapping_city[]" id="edit_mapping_city" style="width: 100%">
                                         </select>
                                    </div>
                                </div>
                                
                                
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatecitymapping" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- citymapping add model start-->


<div class="modal fade" id="AddcitymappingModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add City Mapping details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="citymapping-addmsg"></div>
                    <div class="body">
                        <form id="add_citymapping" method="post" >
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Select Market Lead User Id :</label>
                                         <select style="width: 100%" class="form-control" name="add_marketlead_user" id="add_marketlead_user">
                 
                                         </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Select Marketing User Id :</label>
                                         <select style="width: 100%" class="form-control" name="add_user" id="add_user">
                 
                                         </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>City Mapping :</label>
                                         <select style="width: 100%" class="form-control js-example-basic-multiple w-100" multiple="multiple" name="add_mapping_city[]" id="add_mapping_city">
                 
                                         </select>
                                    </div>
                                </div>
                               
                            </div>
                      
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
                               <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addcitymapping" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- citymapping add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
   
<script src="/<?php echo base_url();?>assets/js/Common/CityMappingController.js" type="text/javascript"></script>
