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
                  <h4 class="card-title">Manage Services </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddserviceModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="servicetable" class="table table-hover">
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
  <div class="modal fade function_edit_service" id="EditServiceModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_service" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_service_id" name="edit_service_id" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Service</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Service" name="edit_service_title" id="edit_service_title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Url</label>
                                         <input type="text" class="form-control" placeholder="Service Url" name="edit_service_url" id="edit_service_url">
                                    </div>
                                </div>

                                
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Content of Service</label>
                                       <textarea class="form-control" placeholder="Content of Service" name="edit_service_content" id="edit_service_content"> </textarea>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Service  Images</label>
                                        <input type="file" class="form-control"   name="edit_service_image" id="edit_service_image">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Service  Images Alt</label>
                                        <input type="text" class="form-control"  placeholder="Service  Images Alt" name="edit_service_imagealt" id="edit_service_imagealt">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <div id="serviceimage"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="status">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_service_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_service_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updateservice" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="service-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddserviceModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_service" method="post" enctype="multipart/form-data">
                            <div class="row clearfix">
                              
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Service</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Service" name="add_service_title" id="add_service_title">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Url</label>
                                         <input type="text" class="form-control" placeholder="Service Url" name="add_service_url" id="add_service_url">
                                    </div>
                                </div>

                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Content of Service</label>
                                       <textarea class="form-control" placeholder="Content of Service" name="add_service_content" id="add_service_content"></textarea>
                                    </div>
                                </div>
                                 
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Image</label>
                                        <input type="file" class="form-control"  name="add_service_image" id="add_service_image">
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Image Alt</label>
                                        <input type="text" class="form-control" placeholder="Service  Images Alt"  name="add_service_imagealt" id="add_service_imagealt">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                       <label for="status">Status</label>   
                                         <p class='add_service_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_service_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_service_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addservice" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="service-addmsg"></div>
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
   