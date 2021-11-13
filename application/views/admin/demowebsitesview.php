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
                  <h4 class="card-title">Manage Demo Websites
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AdddemowebsitesModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                         
                        </div>
                    </div>
                    <div class="col-12">
                     <div class="row clearfixed">
                       <div class="col-2"></div>
                       <div class="col-8">
                           <form id="search_demo_webcategory" method="post" >
                                 <div class="row clearfix" >
                                   <div class="col-sm-8 col-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_demo_website" id="search_demo_website" style="width: 100%;"></select>
                                   </div>
                                  </div>
                                  <div class="col-sm-4 col-12" style="text-align: center;">
                                    <button  type="button" id="searchdemowebcategory" class="btn btn-primary">Search</button>
                                  </div> 
                               </div> 
                      </form>

                       </div>
                          <div class="col-2"></div>

                       </div>
                      </div>
                       

                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="demowebsitestable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditdemowebsitesModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="edit_demowebsitesname_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="demowebsites-editmsg"></div>
                        <form id="edit_demowebsites" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_demowebsites_id" name="edit_demowebsites_id">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category:</label>
                                         <select class="form-control" placeholder="Demo Websites Name" name="edit_demowebsites_category" id="edit_demowebsites_category">
                                         </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Demowebsites Name :</label>
                                        <input type="text" class="form-control" placeholder="Demowebsites Name" name="edit_demowebsites_name" id="edit_demowebsites_name">
                                    </div>
                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Websites URL :</label>
                                        <input type="text" class="form-control" placeholder="Demo Websites URL" name="edit_demowebsites_url" id="edit_demowebsites_url">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div id="demowebsites_image"></div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Photo:</label>
                                       <input type="file" class="form-control" name="edit_demowebsites_photo" id="edit_demowebsites_photo">
                                    </div>
                                </div>
                                   <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <select class="form-control" name="edit_demowebsites_status" id="edit_demowebsites_status">
                                           <option value="">Select  Status</option>
                                           <option value="1">Active</option>
                                           <option value="2">In-Active</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatedemowebsites" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- demowebsites add model start-->


<div class="modal  fade" id="AdddemowebsitesModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Demowebsites details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="demowebsites-addmsg"></div>
                    <div class="body">
                        <form id="add_demowebsites" method="post" >
                            <div class="row clearfix">

                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category:</label>
                                         <select class="form-control" placeholder="Demo Websites Name" name="add_demowebsites_category" id="add_demowebsites_category">
                                           
                                         </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Demo Websites Name :</label>
                                        <input type="text" class="form-control" placeholder="Demo Websites Name" name="add_demowebsites_name" id="add_demowebsites_name">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Websites URL :</label>
                                        <input type="text" class="form-control" placeholder="Demo Websites URL" name="add_demowebsites_url" id="add_demowebsites_url">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                      <label>Photo:</label>
                                       <input type="file" class="form-control" name="add_demowebsites_photo" id="add_demowebsites_photo">
                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <select class="form-control" name="add_demowebsites_status" id="add_demowebsites_status">
                                           <option value="">Select  Status</option>
                                           <option value="1">Active</option>
                                           <option value="2">In-Active</option>
                                       </select>
                                    </div>
                                </div>

                            </div>
                      
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
        
          <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="adddemowebsites" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
          </form>
      </div>
      </div>
    </div>
  </div>
<!-- demowebsites add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
   

