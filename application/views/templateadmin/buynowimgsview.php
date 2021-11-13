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
                  <h4 class="card-title">Manage Buy Now Images </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddbuynowimgModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="buynowimgtable" class="table table-hover">
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
  <div class="modal fade function_edit_buynowimg" id="EditBuyNowimgModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit Buy Now img</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                       
                        <form id="edit_buynowimg" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_buynowimg_id" name="edit_buynowimg_id" >
                            <div class="row clearfix">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of Buy Now Imges </label>
                                         <input type="text" class="form-control" placeholder="Tile Of BuyNowimg" name="edit_buynowimg_title" id="edit_buynowimg_title">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>BuyNowimg Image_Alt</label>
                                         <input type="text" class="form-control" placeholder="BuyNowimg Image_Alt" name="edit_buynowimg_image_alt" id="edit_buynowimg_image_alt">
                                    </div>
                                </div>
                               <div class="row clearfix"> 
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_buynowimg_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_buynowimg_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                   <div class="form-group">
                                      <label>BuyNowimg Image</label>
                                         <input type="file" class="form-control" placeholder="BuyNowimg Heading" name="edit_buynowimg_image" id="edit_buynowimg_image">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div id="buynowimgimage"></div>
                                </div> 

                               </div>
                            </div>    
                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updatebuynowimg" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="buynowimg-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddbuynowimgModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add BuyNowimg</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
        
                    <div class="body">
                        <form id="add_buynowimg" method="POST" enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Title Of BuyNowimg</label>
                                         <input type="text" class="form-control" placeholder="Tile Of BuyNowimg" name="add_buynowimg_title" id="add_buynowimg_title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>BuyNowimg Image_Alt</label>
                                         <input type="text" class="form-control" placeholder="BuyNowimg Image_Alt" name="add_buynowimg_image_alt" id="add_buynowimg_image_alt">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>BuyNowimg Image</label>
                                         <input type="file" class="form-control" name="add_buynowimg_image" id="add_buynowimg_image">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_buynowimg_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_buynowimg_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_buynowimg_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addbuynowimg" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="buynowimg-addmsg"></div>
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
   