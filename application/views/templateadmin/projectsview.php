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
                  <h4 class="card-title">Manage Projects </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddprojectModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="projecttable" class="table table-hover">
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
  <div class="modal fade function_edit_project" id="EditProjectModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Project</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_project" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_project_id" name="edit_project_id" >
                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Type </label>
                                         <select class="form-control" name="edit_project_type" id="edit_project_type">
                                          <option value=""> Select Project Type </option>
                                          <option value="1"> Our Products</option>
                                          <option value="2"> Client Projects</option>
                                         </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Project</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Project" name="edit_project_title" id="edit_project_title">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Url of Project</label>
                                        <input type="text" class="form-control" placeholder="Url of Project" name="edit_project_url" id="edit_project_url">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Category </label>
                                         <select class="form-control" name="edit_project_category" id="edit_project_category">
                                         </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Image Alt </label>
                                         <input type="text" class="form-control" placeholder="Project Image Alt" name="edit_project_image_alt" id="edit_project_image_alt">

                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Certification Frame Image Alt </label>
                                         <input type="text" class="form-control" placeholder="Project Certification Frame Image Alt " name="edit_project_certification_image_alt" id="edit_project_certification_image_alt">
                                    </div>
                                </div>
                               <div class="row clearfix"> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_project_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_project_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                   <div class="form-group">
                                      <label>Project Image</label>
                                         <input type="file" class="form-control" placeholder="Project Heading" name="edit_project_image" id="edit_project_image">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div id="projectimage"></div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Project Certification Frame</label>
                                         <input type="file" class="form-control" name="edit_project_certification" id="edit_project_certification">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div id="projectcertificationimage"></div>
                                </div>

                               </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updateproject" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="project-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddprojectModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Project</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_project" method="POST" enctype="multipart/form-data">
                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Type </label>
                                         <select class="form-control" name="add_project_type" id="add_project_type">
                                          <option value=""> Select Project Type </option>
                                          <option value="1"> Our Products</option>
                                          <option value="2"> Client Projects</option>
                                         </select>
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Project</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Project" name="add_project_title" id="add_project_title">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Url of Project</label>
                                        <input type="text" class="form-control" placeholder="Url of Project" name="add_project_url" id="add_project_url">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Category </label>
                                         <select class="form-control" name="add_project_category" id="add_project_category">
                                         </select>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Image Alt </label>
                                         <input type="text" class="form-control" placeholder="Project Image Alt " name="add_project_image_alt" id="add_project_image_alt">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Certification Frame Image Alt </label>
                                         <input type="text" class="form-control" placeholder="Project Certification Frame Image Alt" name="add_project_certification_image_alt" id="add_project_certification_image_alt">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Project Image</label>
                                         <input type="file" class="form-control" name="add_project_image" id="add_project_image">
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Project Certification Frame</label>
                                         <input type="file" class="form-control"                         name="add_project_certification" id="add_project_certification">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_project_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_project_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_project_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addproject" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="project-addmsg"></div>
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
   