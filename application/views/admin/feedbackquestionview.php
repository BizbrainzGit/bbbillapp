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
                  <h4 class="card-title">Feedback Question List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                            <h5>
                          <div style="float:right"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddfeedbackquestionModal"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div>
                         </h5>
                        </div>
                    </div>
                     <!-- <div class="col-12">
                      <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="feedbackquestiontable" class="table table-hover">
                    
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
  <div class="modal fade" id="EditfeedbackquestionModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Feedback Question details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         
                    <div class="body">
                        <div id="feedbackquestion-editmsg"></div>
                        <form id="edit_feedbackquestion" method="post" >
                            <div class="row clearfix">
                                
                                  <input type="hidden" id="edit_feedbackquestion_id" name="edit_feedbackquestion_id"> 
                                  <input type="hidden" id="edit_feedbackoption_id" name="edit_feedbackoption_id"> 

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Question Text:</label>
                                         <textarea class="form-control" rows="2" cols="2" name="edit_feedback_question" id="edit_feedback_question" placeholder="Write Question" >
                                          </textarea>
                                          <!--  <input type="text" class="form-control" rows="2" cols="2" name="add_feedback_question" id="add_feedback_question" placeholder="Write Question" > -->
                                        
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Options :</label>
                                        <div class="row" style="text-align: center;">
                                          <div class="col-sm-6" ><span>Yes</span>&nbsp; &nbsp; <input type="radio" value="1" name="edit_feedback_option" id="edit_yes"></div>
                                          <div class="col-sm-6"><span>No</span>&nbsp; &nbsp; <input type="radio" value="2" name="edit_feedback_option" id="edit_no"></div>
                                        </div>
                                
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Status :</label>
                                        <div class="row" style="text-align: center;">
                                          <div class="col-sm-6" ><span>Active</span>&nbsp; &nbsp; <input type="radio" value="1" name="edit_feedback_status" id="edit_active"></div>
                                          <div class="col-sm-6"><span>Inactive</span>&nbsp; &nbsp; <input type="radio" value="2" name="edit_feedback_status" id="edit_inactive"></div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
              
          </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">

                            <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="updatefeedbackquestion" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>

                            </div>
                        </form>

          </div>
        </div>
      </div>
    </div>
  </div>


<!-- feedbackquestion add model start-->


<div class="modal  fade" id="AddfeedbackquestionModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Feedback Question details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                      <div id="feedbackquestion-addmsg"></div>
                        <form id="add_feedbackquestion" method="post" >
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Question Text:</label>
                                         <textarea class="form-control" rows="2" cols="2" name="add_feedback_question" id="add_feedback_question" placeholder="Write Question" >
                                          </textarea>
                                          <!--  <input type="text" class="form-control" rows="2" cols="2" name="add_feedback_question" id="add_feedback_question" placeholder="Write Question" > -->
                                        
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Options :</label>
                                        <div class="row" style="text-align: center;">
                                          <div class="col-sm-6" ><span>Yes</span>&nbsp; &nbsp; <input type="radio" value="1" name="add_feedback_option" id="yes"></div>
                                          <div class="col-sm-6"><span>No</span>&nbsp; &nbsp; <input type="radio" value="2" name="add_feedback_option" id="no"></div>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Status :</label>
                                        <div class="row" style="text-align: center;">
                                          <div class="col-sm-6" ><span>Active</span>&nbsp; &nbsp; <input type="radio" value="1" name="add_feedback_status" id="active"></div>
                                          <div class="col-sm-6"><span>Inactive</span>&nbsp; &nbsp; <input type="radio" value="2" name="add_feedback_status" id="inactive"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
                                    <button  type="button" id="addfeedbackquestion" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                       
          </form>
      
      </div>
    </div>
  </div>
</div> 
<!-- feedbackquestion add model end -->
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/FeedbackQuestionController.js" type="text/javascript"></script>
   

