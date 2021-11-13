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
                  <h4 class="card-title">Manage Jobs </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddjobModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="jobtable" class="table table-hover">
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
                <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright &copy; 2019 Bizbrainz.in. All rights reserved. </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="http://bizbrainz.in/" target="_blank">BizBrainz.in</a> </span>
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
  <div class="modal fade function_edit_job" id="EditJobModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Job</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_job" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_job_id" name="edit_job_id" >
                            <div class="row clearfix">
                              

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Job</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Job" name="edit_job_title" id="edit_job_title">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Content of Job</label>
                                        <input type="text" class="form-control" placeholder="Content of Job" name="edit_job_content" id="edit_job_content">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Skills </label>
                                         <select class="form-control select2" name="edit_job_skill[]" id="edit_job_skill"  multiple="multiple" style="width: 100%;"></select>
                                         
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <label for="status">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_job_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_job_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updatejob" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="job-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddjobModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Job</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_job" method="post" enctype="multipart/form-data">
                            <div class="row clearfix">
                              
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Job</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Job" name="add_job_title" id="add_job_title">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Content of Job</label>
                                        <input type="text" class="form-control" placeholder="Content of Job" name="add_job_content" id="add_job_content">
                                        
                                    </div>
                                </div>
                                 
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Skills</label>
                                         <select class="form-control select2" name="add_job_skill[]" id="add_job_skill"  multiple="multiple" style="width: 100%;" placeholder="Select Job Skills"></select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <label for="status">Status</label>   
                                         <p class='add_job_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_job_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_job_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">

             <button  type="button" id="addjob" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="job-addmsg"></div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
<!--  add model end -->
      



<?php
include('Layouts/adminLayout_Footer.php');
?>
   