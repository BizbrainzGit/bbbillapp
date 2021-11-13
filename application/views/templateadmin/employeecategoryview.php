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
                  <h4 class="card-title">Manage Employee Category
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddEmployeeCategorysModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
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
                        <table id="employeecategorystable" class="table table-hover">
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
  <div class="modal fade" id="EditEmployeeCategorysModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Employee Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="employeecategorys-editmsg"></div>
                        <form id="edit_employeecategory" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_employeecategory_id" name="edit_employeecategory_id">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee Category Name:</label>
                                        <input type="text" class="form-control" placeholder="Employee Category Name" name="edit_employeecategory_name" id="edit_employeecategory_name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee Category Content :</label>
                                        <textarea class="form-control" placeholder="Employee Category Content" name="edit_employeecategory_content" id="edit_employeecategory_content">  </textarea>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_employeecategory_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_employeecategory_status" value="2" id="edit_inactive"> In Active
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
                                    <button type="button" id="updateemployeecategorys" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- add model start-->

<div class="modal  fade" id="AddEmployeeCategorysModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Employee Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div id="employeecategorys-addmsg"></div>
                    <div class="body">
                        <form id="add_employeecategory" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee Category Name :</label>
                                        <input type="text"  class="form-control" placeholder="Employee Category Name" name="add_employeecategory_name" id="add_employeecategory_name">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee Category Content :</label>
                                        <textarea class="form-control" placeholder="Employee Category Content" name="add_employeecategory_content" id="add_employeecategory_content">  </textarea>
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_employeecategory_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_employeecategory_status" value="2" id="inactive"> In Active
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
                                    <button  type="button" id="addemployeecategorys" class="btn btn-primary">Save</button>
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
   

