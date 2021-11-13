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
                  <h4 class="card-title">Manage Count List </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                          <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddcountlistModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="countlisttable" class="table table-hover">
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
  <div class="modal fade function_edit_countlist" id="EditCountListModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit CountList</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                        <form id="edit_countlist" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_countlist_id" name="edit_countlist_id" >
                            <div class="row clearfix">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Established Year</label>
                                         <input type="text" class="form-control" placeholder="Established Year" name="edit_countlist_establishedyear" id="edit_countlist_establishedyear">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Clients Count </label>
                                         <input type="text" class="form-control" placeholder="Clients Count" name="edit_countlist_clientcount" id="edit_countlist_clientcount">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Projects Count </label>
                                         <input type="text" class="form-control" placeholder="Projects Count" name="edit_countlist_projectcount" id="edit_countlist_projectcount">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Team Count </label>
                                         <input type="text" class="form-control" placeholder="Team Count" name="edit_countlist_teamcount" id="edit_countlist_teamcount">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_countlist_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_countlist_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>

                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updatecountlist" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="countlist-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddcountlistModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Count List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_countlist" method="POST" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Established Year</label>
                                         <input type="text" class="form-control" placeholder="Established Year" name="add_countlist_establishedyear" id="add_countlist_establishedyear">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Clients Count </label>
                                         <input type="text" class="form-control" placeholder="Clients Count" name="add_countlist_clientcount" id="add_countlist_clientcount">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Projects Count </label>
                                         <input type="text" class="form-control" placeholder="Projects Count" name="add_countlist_projectcount" id="add_countlist_projectcount">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Team Count </label>
                                         <input type="text" class="form-control" placeholder="Team Count" name="add_countlist_teamcount" id="add_countlist_teamcount">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_countlist_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_countlist_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_countlist_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addcountlist" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="countlist-addmsg"></div>
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
   