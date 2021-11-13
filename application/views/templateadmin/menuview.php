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
                  <h4 class="card-title">Manage Menus
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddMenusModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
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
                        <table id="menustable" class="table table-hover">
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
  <div class="modal fade" id="EditMenusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Menu</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <div id="menus-editmsg"></div>
                        <form id="edit_menu" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_menu_id" name="edit_menu_id">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Menu Name:</label>
                                        <input type="text" class="form-control" placeholder="Menu Name" name="edit_menu_name" id="edit_menu_name">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Menu Url Name:</label>
                                        <input type="text"  class="form-control" placeholder="Menu Url Name" name="edit_menu_urlname" id="edit_menu_urlname">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Tag :</label>
                                        <input type="text"  class="form-control" placeholder="Title Tag" name="edit_menu_titletag" id="edit_menu_titletag">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Meta keywords :</label>
                                        <textarea class="form-control" placeholder="Meta keywords" name="edit_menu_metakeyword" id="edit_menu_metakeyword">

                                        </textarea>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Meta Description :</label>
                                        <textarea class="form-control" placeholder="Meta Description" name="edit_menu_metadescription" id="edit_menu_metadescription">
                                        </textarea>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_menu_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_menu_status" value="2" id="edit_inactive"> In Active
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
                                    <button type="button" id="updatemenus" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- add model start-->

<div class="modal  fade" id="AddMenusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Menus</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div id="menus-addmsg"></div>
                    <div class="body">
                        <form id="add_menu" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Menu Name :</label>
                                        <input type="text"  class="form-control" placeholder="Menu Name" name="add_menu_name" id="add_menu_name">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Menu Url Name:</label>
                                        <input type="text"  class="form-control" placeholder="Menu Url Name" name="add_menu_urlname" id="add_menu_urlname">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Tag :</label>
                                        <input type="text"  class="form-control" placeholder="Title Tag" name="add_menu_titletag" id="add_menu_titletag">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Meta keywords :</label>
                                        <textarea class="form-control"  name="add_menu_metakeyword" id="add_menu_metakeyword">

                                        </textarea>
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Meta Description :</label>
                                        <textarea class="form-control" placeholder="" name="add_menu_metadescription" id="add_menu_metadescription">
                                        </textarea>
                                    </div>
                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_menu_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_menu_status" value="2" id="inactive"> In Active
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
                                    <button  type="button" id="addmenus" class="btn btn-primary">Save</button>
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
   

