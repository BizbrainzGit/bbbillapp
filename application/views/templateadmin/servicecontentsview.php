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
                  <h4 class="card-title">Manage Service Contents </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddservicecontentModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="servicecontenttable" class="table table-hover">
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
  <div class="modal fade function_edit_servicecontent" id="EditServiceContentModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Edit ServiceContent</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
                    <div class="body">
                        <form id="edit_servicecontent" method="post" enctype="multipart/form-data" >
                           <input type="hidden" class="form-control" id="edit_servicecontent_id" name="edit_servicecontent_id" >

                         <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Content Type </label>
                                         <select class="form-control" name="edit_servicecontent_type" id="edit_servicecontent_type">
                                         </select>
                                    </div>
                                </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Banner Title </label>
                                         <input type="text" class="form-control" placeholder="Banner Title" name="edit_servicecontent_bannertitle" id="edit_servicecontent_bannertitle">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group">
                                      <label> Banner Content Image</label>
                                         <input type="file" class="form-control" name="edit_servicecontent_bannerimage" id="edit_servicecontent_bannerimage">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <label> Banner Content Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Banner Content Image Alt" name="edit_servicecontent_bannerimagealt" id="edit_servicecontent_bannerimagealt">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group" id="servicecontent_bannerimage">
                                    </div>
                                </div>
                         
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Banner Content</label>
                                       <textarea class="form-control" placeholder="Banner Content" name="edit_servicecontent_bannercontent" id="edit_servicecontent_bannercontent">
                                         
                                       </textarea>
                                    </div>
                                </div>
                                
                                     <h4 class="col-sm-12">Section I</h4>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                     
                                        <label>Section1 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="edit_servicecontent_section1_heading" id="edit_servicecontent_section1_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section1 Image</label>
                                          <input type="file" class="form-control"  name="edit_servicecontent_section1_image" id="edit_servicecontent_section1_image">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section1 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section1 Image Alt" name="edit_servicecontent_section1_imagealt" id="edit_servicecontent_section1_imagealt">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group" id="servicecontent_section1_image">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section1 Content</label>
                                        <textarea class="form-control" placeholder="Section1 Heading" name="edit_servicecontent_section1_content" id="edit_servicecontent_section1_content">
                                        </textarea>
                                    </div>
                                </div>
                                <h4 class="col-sm-12">Section 2</h4>
                                   <div class="col-sm-4">
                                    <div class="form-group">
                  
                                        <label>Section2 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="edit_servicecontent_section2_heading" id="edit_servicecontent_section2_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section2 Image</label>
                                          <input type="file" class="form-control"  name="edit_servicecontent_section2_image" id="edit_servicecontent_section2_image">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section2 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section2 Image Alt" name="edit_servicecontent_section2_imagealt" id="edit_servicecontent_section2_imagealt">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group" id="servicecontent_section2_image">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section2 Content</label>
                                        <textarea class="form-control" placeholder="Section1 Heading" name="edit_servicecontent_section2_content" id="edit_servicecontent_section2_content">
                                        </textarea>
                                    </div>
                                </div>
                                 <h4 class="col-sm-12">Section 3</h4>
                                   <div class="col-sm-4">
                                    <div class="form-group">
                                        <!--  <h4>Section I</h4> -->
                                        <label>Section3 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="edit_servicecontent_section3_heading" id="edit_servicecontent_section3_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section3 Image</label>
                                          <input type="file" class="form-control"  name="edit_servicecontent_section3_image" id="edit_servicecontent_section3_image">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section3 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section3 Image Alt" name="edit_servicecontent_section3_imagealt" id="edit_servicecontent_section3_imagealt">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group" id="servicecontent_section3_image">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section3 Content</label>
                                        <textarea class="form-control" placeholder="Section3 Heading" name="edit_servicecontent_section3_content" id="edit_servicecontent_section3_content">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='edit_servicecontent_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_servicecontent_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_servicecontent_status" value="2" id="edit_inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>     

                        </div>
                     </div>
        <div class="modal-footer">
        <div class="col-sm-12" style="text-align: center;">
            <button type="button" id="updateservicecontent" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
             <div id="servicecontent-updatemsg"></div>
        </div>
        </form>
        </div>  
      </div>
    </div>
  </div>


<!--  add model start-->


<div class="modal fade" id="AddservicecontentModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Service Content</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <form id="add_servicecontent" method="POST" enctype="multipart/form-data">
                            
                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Service Content Type </label>
                                         <select class="form-control" name="add_servicecontent_type" id="add_servicecontent_type">
                                         </select>
                                    </div>
                                </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Banner Title </label>
                                         <input type="text" class="form-control" placeholder="Banner Title" name="add_servicecontent_bannertitle" id="add_servicecontent_bannertitle">
                                    </div>
                                </div>

                                 <div class="col-sm-4">
                                    <div class="form-group">
                                      <label> Banner Content Image</label>
                                         <input type="file" class="form-control" name="add_servicecontent_bannerimage" id="add_servicecontent_bannerimage">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                      <label> Banner Content Image Alt</label>
                                         <input type="text" class="form-control" placeholder="Banner Content Image Alt" name="add_servicecontent_bannerimagealt" id="add_servicecontent_bannerimagealt">
                                    </div>
                                </div>

                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Banner Content</label>
                                       <textarea class="form-control" placeholder="Banner Content" name="add_servicecontent_bannercontent" id="add_servicecontent_bannercontent">
                                         
                                       </textarea>
                                    </div>
                                </div>
                                
                                     <h4 class="col-sm-12">Section I</h4>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                     
                                        <label>Section1 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="add_servicecontent_section1_heading" id="add_servicecontent_section1_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section1 Image</label>
                                          <input type="file" class="form-control"  name="add_servicecontent_section1_image" id="add_servicecontent_section1_image">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section1 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section1 Image Alt" name="add_servicecontent_section1_imagealt" id="add_servicecontent_section1_imagealt">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section1 Content</label>
                                        <textarea class="form-control" placeholder="Section1 Heading" name="add_servicecontent_section1_content" id="add_servicecontent_section1_content">
                                        </textarea>
                                    </div>
                                </div>
                                <h4 class="col-sm-12">Section 2</h4>
                                   <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section2 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="add_servicecontent_section2_heading" id="add_servicecontent_section2_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section2 Image</label>
                                          <input type="file" class="form-control"  name="add_servicecontent_section2_image" id="add_servicecontent_section2_image">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section2 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section2 Image Alt" name="add_servicecontent_section2_imagealt" id="add_servicecontent_section2_imagealt">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section2 Content</label>
                                        <textarea class="form-control" placeholder="Section1 Heading" name="add_servicecontent_section2_content" id="add_servicecontent_section2_content">
                                        </textarea>
                                    </div>
                                </div>
                                 <h4 class="col-sm-12">Section 3</h4>
                                   <div class="col-sm-4">
                                    <div class="form-group">
                                        <!--  <h4>Section I</h4> -->
                                        <label>Section3 Heading</label>
                                          <input type="text" class="form-control" placeholder="Section1 Heading" name="add_servicecontent_section3_heading" id="add_servicecontent_section3_heading">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section3 Image</label>
                                          <input type="file" class="form-control"  name="add_servicecontent_section3_image" id="add_servicecontent_section3_image">
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Section3 Image Alt</label>
                                          <input type="text" class="form-control" placeholder="Section3 Image Alt" name="add_servicecontent_section3_imagealt" id="add_servicecontent_section3_imagealt">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Section1 Content</label>
                                        <textarea class="form-control" placeholder="Section3 Heading" name="add_servicecontent_section3_content" id="add_servicecontent_section3_content">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="Gender">Status</label>   
                                         <p class='add_servicecontent_status'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_servicecontent_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_servicecontent_status" value="2" id="inactive"> In Active
                                        </label><br>
                                        </p>
                                   </div>
                                </div>
                            </div>    

                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addservicecontent" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="servicecontent-addmsg"></div>
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
   