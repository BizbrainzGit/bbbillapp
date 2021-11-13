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
                  <h4 class="card-title">Manage Project Categories 
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddProjectCategorysModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="projectcategorystable" class="table table-hover">
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
  <div class="modal fade" id="EditProjectCategorysModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Project Category </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="projectcategorys-editmsg"></div>
                        <form id="edit_projectcategory" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_projectcategory_id" name="edit_projectcategory_id">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Category Name:</label>
                                        <input type="text" class="form-control" placeholder="ProjectCategory Name" name="edit_projectcategory_name" id="edit_projectcategory_name">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_projectcategory_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_projectcategory_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updateprojectcategorys" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- add model start-->

<div class="modal  fade" id="AddProjectCategorysModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Project Categorys</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div id="projectcategorys-addmsg"></div>
                    <div class="body">
                        <form id="add_projectcategory" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Category Name :</label>
                                        <input type="text"  class="form-control" placeholder="ProjectCategory Name" name="add_projectcategory_name" id="add_projectcategory_name">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_projectcategory_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_projectcategory_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
        <!-- Modal footer -->
                         <div class="modal-footer">
                              <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addprojectcategorys" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                       </div>
        </form>
      </div>
    </div>
  </div>
<!-- keywords add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
   

