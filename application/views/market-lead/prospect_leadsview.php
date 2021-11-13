<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/market-leadLayout_Header.php');
?>
<div class="main-panel">


<div class="modal fade" id="EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                      <div id="citymapping-editmsg"></div>
                        <form id="status_change_form" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="prospect_status_id" name="prospect_status_id"> 
                                       
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status :</label>
                                       
                                          <select class='form-control' name="prospect_status_change" id="prospect_status_change">
                                            <option id="">Select Status</option>
                                            <option value="1" >Active</option>
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
          <button type="button" id="prospectupdatestatus" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>
  
<div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Prospect Leads List</h4>
                  <div class="row grid-margin">
                    
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="leadstable" class="table table-hover">
                    
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


  
       
         
<?php
include('Layouts/market-leadLayout_Footer.php');
?>
   

