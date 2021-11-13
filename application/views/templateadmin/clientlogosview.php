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
                  <h4 class="card-title">Manage Client Logos </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddclientlogoModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="clientlogotable" class="table table-hover">
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
  <div class="modal fade function_edit_clientlogo" id="EditClientLogoModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit ClientLogo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_clientlogo" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_clientlogo_id" name="edit_clientlogo_id" >
                            <div class="row clearfix">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Client Logo</label>
                                         <input type="text" class="form-control" placeholder="Tile Of ClientLogo" name="edit_clientlogo_title" id="edit_clientlogo_title">
                                    </div>
                                </div>
                                
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Url of ClientLogo</label>
                                        <input type="text" class="form-control" placeholder="Url of ClientLogo" name="edit_clientlogo_url" id="edit_clientlogo_url">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Clien tLogo Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Clien tLogo Image Alt" name="edit_clientlogo_image_alt" id="edit_clientlogo_image_alt">
                                    </div>
                                </div>
                               <div class="row clearfix"> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_clientlogo_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_clientlogo_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                   <div class="form-group">
                                      <label>Client Logo Image</label>
                                         <input type="file" class="form-control" placeholder="Client Logo Heading" name="edit_clientlogo_image" id="edit_clientlogo_image">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div id="clientlogoimage"></div>
                                </div> 
                               </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updateclientlogo" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="clientlogo-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddclientlogoModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add ClientLogo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_clientlogo" method="POST" enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of ClientLogo</label>
                                         <input type="text" class="form-control" placeholder="Tile Of ClientLogo" name="add_clientlogo_title" id="add_clientlogo_title">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Url of ClientLogo</label>
                                        <input type="text" class="form-control" placeholder="Url of ClientLogo" name="add_clientlogo_url" id="add_clientlogo_url">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Client Logo Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Client Logo Image Alt" name="add_clientlogo_image_alt" id="add_clientlogo_image_alt">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>ClientLogo Image</label>
                                         <input type="file" class="form-control" name="add_clientlogo_image" id="add_clientlogo_image">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_clientlogo_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_clientlogo_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_clientlogo_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addclientlogo" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="clientlogo-addmsg"></div>
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
   