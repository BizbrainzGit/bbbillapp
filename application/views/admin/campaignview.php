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
                  <h4 class="card-title">Manage Campaign 
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddcampaignModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
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
                        <table id="campaigntable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditcampaignModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="edit_campaignname_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="campaign-editmsg"></div>
                        <form id="edit_campaign" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_campaign_id" name="edit_campaign_id">
                                        <label>Campaign Name :</label>
                                        <input type="text" class="form-control" placeholder="Campaign Name" name="edit_campaign_name" id="edit_campaign_name">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Amount :</label>
                                        <input type="text" class="form-control" placeholder="Campaign Amount" name="edit_campaign_amount" id="edit_campaign_amount">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div id="image"></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Photo:</label>
                                       <input type="file" class="form-control" name="edit_campaign_photo" id="edit_campaign_photo">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Select Status:</label>
                                        <select class="form-control" name="edit_campaign_status" id="edit_campaign_status">
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
                                    <button type="button" id="updatecampaign" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- campaign add model start-->


<div class="modal  fade" id="AddcampaignModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Campaign details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="campaign-addmsg"></div>
                    <div class="body">
                        <form id="add_campaign" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Campaign Name :</label>
                                        <input type="text" class="form-control" placeholder="Campaign Name" name="add_campaign_name" id="add_campaign_name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Amount :</label>
                                        <input type="text" class="form-control" placeholder="Campaign Amount" name="add_campaign_amount" id="add_campaign_amount">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    
                                      <label>Photo:</label>
                                       <input type="file" class="form-control" name="add_campaign_photo" id="add_campaign_photo">
                                   
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Select Category:</label>
                                        <select class="form-control" name="add_campaign_category" id="add_campaign_category">
                                        	<option value=" ">Select Category</option>
                                        	<option value="1">Website</option>
                                        	<option value="2">ERP</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Select Status:</label>
                                        <select class="form-control" name="add_campaign_status" id="add_campaign_status">
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
                                    <button  type="button" id="addcampaign" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- campaign add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>

 <script src="/<?php echo base_url();?>assets/js/Common/CampaignController.js" type="text/javascript"></script>   

