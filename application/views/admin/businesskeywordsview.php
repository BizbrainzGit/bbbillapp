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
                  <h4 class="card-title">Manage Business Keywords
                    <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddBusinesskeywordsModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
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
                            <form id="search_business_keywords" method="post" >

                                 <div class="row clearfix" >
                                  <div class="col-sm-12 col-12">
                                    <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Search Keyword" name="search_business_keyword_name" id="search_business_keyword_name">
                                   </div>
                                  </div>

                                   <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_business_keyword_status" id="search_business_keyword_status">
                                        <option value="">Selecte Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">In-Active</option>

                                      </select>
                                   </div>
                                  </div>
                                  <div class="col-sm-6 col-12" style="text-align: center;">
                                    <button  type="button" id="searchbusinesskeywords" class="btn btn-primary">Search</button>
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
                        <table id="businesskeywordstable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditBusinesskeywordsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Business Keyword</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="businesskeywords-editmsg"></div>
                        <form id="edit_business_keywords" method="post" >
                            <div class="row clearfix">
                              <input type="hidden" id="edit_business_keywords_id" name="edit_business_keywords_id">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Business Keyword:</label>
                                        <input type="text" class="form-control" placeholder="Business Keyword" name="edit_business_keywords_name" id="edit_business_keywords_name">
                                    </div>
                                </div>
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_business_keywords_status" value="1" id="edit_active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="edit_business_keywords_status" value="2" id="edit_inactive"> In Active
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
                                    <button type="button" id="updatebusinesskeywords" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

        </div>
        
      </div>
    </div>
  </div>


<!-- keywords add model start-->


<div class="modal  fade" id="AddBusinesskeywordsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Business Keywords</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div id="businesskeywords-addmsg"></div>
                    <div class="body">
                        <form id="add_business_keywords" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Business Keyword :</label>
                                        <input type="text"  class="form-control" placeholder="Business Keyword" name="add_business_keywords_name" id="add_business_keywords_name">
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                         <p class='radiovalid'>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_business_keywords_status" value="1" id="active"> Active
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="add_business_keywords_status" value="2" id="inactive"> In Active
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
                                    <button  type="button" id="addbusinesskeywords" class="btn btn-primary">Save</button>
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
   
<script src="/<?php echo base_url();?>assets/js/Common/BusinessKeywordsController.js" type="text/javascript"></script>
