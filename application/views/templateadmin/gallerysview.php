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
                  <h4 class="card-title">Manage Gallerys </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddgalleryModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="gallerytable" class="table table-hover">
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
  <div class="modal fade function_edit_gallery" id="EditGalleryModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Gallery</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_gallery" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_gallery_id" name="edit_gallery_id" >
                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gallery Type </label>
                                         <select class="form-control" name="edit_gallery_type" id="edit_gallery_type"></select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Gallery</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Gallery" name="edit_gallery_title" id="edit_gallery_title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gallery Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Gallery Image Alt" name="edit_gallery_image_alt" id="edit_gallery_image_alt">
                                    </div>
                                </div>
                               <div class="row clearfix"> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_gallery_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_gallery_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                   <div class="form-group">
                                      <label>Gallery Image</label>
                                         <input type="file" class="form-control" placeholder="Gallery Heading" name="edit_gallery_image" id="edit_gallery_image">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div id="galleryimage"></div>
                                </div> 
                               </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updategallery" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="gallery-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddgalleryModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Gallery</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_gallery" method="post" enctype="multipart/form-data">
                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gallery Type </label>
                                         <select class="form-control" name="add_gallery_type" id="add_gallery_type"></select>
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Gallery</label>
                                         <input type="text" class="form-control" placeholder="Tile Of Gallery" name="add_gallery_title" id="add_gallery_title">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Gallery Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Gallery Image Alt" name="add_gallery_image_alt" id="add_gallery_image_alt">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Gallery Image</label>
                                         <input type="file" class="form-control" placeholder="Gallery Heading" name="add_gallery_image" id="add_gallery_image">
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_gallery_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_gallery_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_gallery_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addgallery" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="gallery-addmsg"></div>
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
   