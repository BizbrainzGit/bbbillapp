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
                  <h4 class="card-title">Manage Keywords
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddkeywordsModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                         
                        </div>
                    </div>
                     <div class="col-12">
                      <div class="row clearfixed">
                       <div class="col-2"></div>
                       <div class="col-8">
                            <form id="search_demo_keywords" method="post" >
                                 <div class="row clearfix" >
                                   <div class="col-sm-8 col-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_demo_keyword" id="search_demo_keyword" style="width: 100%;"></select>
                                   </div>
                                  </div>
                                  <div class="col-sm-4 col-12" style="text-align: center;">
                                    <button  type="button" id="searchdemokeywordscategory" class="btn btn-primary">Search</button>
                                  </div> 
                               </div> 
                         </form>

                       </div>
                          <div class="col-2"></div>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="keywordstable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditkeywordsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="edit_keywordsname_head"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="keywords-editmsg"></div>
                        <form id="edit_keywords" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_keywords_id" name="edit_keywords_id">
                               
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category:</label>
                                        <select class="form-control" name="edit_keywords_category" id="edit_keywords_category">
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Business Keywords:</label>
                                        <textarea cols="4" rows="4" class="form-control" placeholder="Business Keywords" name="edit_keywords_name" id="edit_keywords_name"></textarea>
                                    </div>
                                </div>
                                 
                                
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatekeywords" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- keywords add model start-->


<div class="modal  fade" id="AddkeywordsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Business Keywords</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="keywords-addmsg"></div>
                    <div class="body">
                        <form id="add_keywords" method="post" >
                            <div class="row clearfix">
                               
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category:</label>
                                        <select class="form-control" name="add_keywords_category" id="add_keywords_category">
                                        
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <label>Business Keywords :</label>
                                        <textarea cols="4" rows="4" class="form-control" placeholder="Business Keywords" name="add_keywords_name" id="add_keywords_name"></textarea>
                                    </div>
                                </div>

                                

                            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          
        
          <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addkeywords" class="btn btn-primary">Save</button>
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
   

