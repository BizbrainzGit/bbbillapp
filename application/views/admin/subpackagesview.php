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
                  <h4 class="card-title">Manage Sub Packages
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddSubpackageModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                         
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
                        <table id="subpackagestable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditSubpackageModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
       
        <div class="modal-header">
          <h4 class="modal-title" id="edit_subpackagename_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
       
        <div class="modal-body">
         
                    <div class="body">
                        <div id="subpackage-editmsg"></div>
                        <form id="edit_subpackage" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" id="edit_subpackage_id" name="edit_subpackage_id">
                                        <label>Sub Package Name :</label>
                                        <input type="text" class="form-control" placeholder="Sub Package Name" name="edit_subpackage_name" id="edit_subpackage_name">
                                    </div>
                                </div>
                                 
                              
                                 
                            </div>
              
          </div>

        </div>
        
       
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatesubpackage" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- campaign add model start-->


<div class="modal  fade" id="AddSubpackageModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Sub Package details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="subpackage-addmsg"></div>
                    <div class="body">
                        <form id="add_subpackage" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Sub Package Name :</label>
                                        <input type="text" class="form-control" placeholder="Sub Package Name" name="add_subpackage_name" id="add_subpackage_name">
                                    </div>
                                </div>
                               
                            </div>
                      
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
        
          <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addsubpackage" class="btn btn-primary">Save</button>
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
   

