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
                  <h4 class="card-title">G Form Data</h4> 
                   
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                       <h5><div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddgformModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
                       </div>
                         </h5>
                        </div>
                    </div>
                   
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="gformdatatable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- <div class="content-wrapper " id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                   <h2 style="text-align: center;">G - Form Data Entry</h2>
                    
                  
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="employeestable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->






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


<div class="modal  fade" id="AddgformModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">G-Form Data Entry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
      <form id="add_gform_form" method="post" >
        <div class="modal-body">
            <div class="body">
              <div class="row clearfix" >
                                <div class="col-sm-12">
                                 <div class="form-group">
                                        <label>Company Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="add_gform_company_name" id="add_gform_company_name">
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Contact Person:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Contact Person Name" name="add_gform_proprietor_name" id="add_gform_proprietor_name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Mobile Number :</label>          
                                         <input type="text" class="form-control" placeholder="Mobile Number " name="add_gform_mobileno" id="add_gform_mobileno">
                                         
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Email :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Email " name="add_gform_email" id="add_gform_email">
                                         
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Business Keywords :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Business Keywords " name="add_gform_businesskeyword" id="add_gform_businesskeyword">
                                         
                                   </div>
                                </div>

                                  <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Working Hours :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Working Hours " name="add_gform_workinghours" id="add_gform_workinghours">
                                         
                                   </div>
                                </div>

                                 <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  House No./Flat No. :</label>          
                                         <input type="text" class="form-control" placeholder="Enter House No./Flat No. " name="add_gform_houseno" id="add_gform_houseno">
                                         
                                   </div>
                                </div>

                                 <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Area/Street :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Area " name="add_gform_area" id="add_gform_area">
                                         
                                   </div>
                                </div>

                                 <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Land Mark :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Land Mark " name="add_gform_landmark" id="add_gform_landmark">
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Pincode :</label>          
                                         <input type="text" class="form-control" placeholder="Enter Pincode " name="add_gform_pincode" id="add_gform_pincode">
                                         
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City :</label>
                                        <select class="form-control" name="add_gform_city" id="add_gform_city"  onchange="getState(this);">
                                       </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State :</label>
                                        <select class="form-control" name="add_gform_state" id="add_gform_state">
                                       </select>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>  Photo :</label>          
                                         <input type="file" class="form-control" placeholder="Upload Photo " name="add_gform_photo" id="add_gform_photo" />
                                   </div>
                                </div>
                          </div> 
                  </div>
          </div>

        
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <div id="gformdata-addmsg"></div>
                <button  type="button" id="savegformdata" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div> 
       </div>
       </form>
      </div>
    </div>
  </div>
<!-- campaign add model end -->


<?php
include('Layouts/adminLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/Common/GFormController.js" type="text/javascript"></script>   

