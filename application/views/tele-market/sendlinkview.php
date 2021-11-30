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
                  <h4 class="card-title">Send Demo Links Data</h4> 
                   
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                       <h5><div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddsendlinkModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                       </div>
                         </h5>
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="sendlinkdatatable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>







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
     


     <!-- campaign add model start-->


<div class="modal  fade" id="AddsendlinkModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send Demo Link </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
      <form id="add_sendlink_form" method="post" >
        <div class="modal-body">
            <div class="body">
                    <div class="row clearfix" >
                                <div class="col-sm-12">
                                 <div class="form-group">
                                        <label>Company Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="add_sendlink_company_name" id="add_sendlink_company_name">
                                    </div>
                                 </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Contact Person:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Contact Person Name" name="add_sendlink_proprietor_name" id="add_sendlink_proprietor_name">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                      <label>  Mobile Number :</label>          
                                         <input type="text" class="form-control" placeholder="Mobile Number " name="add_sendlink_mobileno" id="add_sendlink_mobileno">
                                   </div>
                                </div>
                                
                                  <div class="col-sm-12">
                                   <div class="form-group">
                                      <label>  Email :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Email " name="add_sendlink_email" id="add_sendlink_email">
                                         
                                   </div>
                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select City:</label>
                                         <select class="form-control" name="add_sendlink_city" id="add_sendlink_city"  onchange="getState(this);">
                                         </select>
                                    </div>    
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select State:</label>
                                        <select class="form-control" name="add_sendlink_state" id="add_sendlink_state">
                                       </select>
                                    </div>    
                                </div>
                                
                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category:</label>
                                         <select class="form-control" name="add_sendlink_category" id="add_sendlink_category" onchange="getDemolinkByCategory(this);">
                                          <option></option>
                                         </select>
                                    </div>    
                                </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                      <label>  Select demo Links :</label>  
                                      <select class="form-control"  name="add_sendlink_demolinks" id="add_sendlink_demolinks">
                                        <option> Select demo Links </option>
                                      </select>       
                                   </div>
                                </div>







                             
                          </div> 
                  </div>
          </div>

        
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <div id="sendlinkdata-addmsg"></div>
                <button  type="button" id="savesendlinkdata" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div> 
       </div>
       </form>
      </div>
    </div>
  </div>
<!-- campaign add model end -->


        
<?php
include('Layouts/tele-marketLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/Common/SendLinkController.js"></script>  

