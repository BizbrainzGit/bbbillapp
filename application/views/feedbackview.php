<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Empty_Header.php');
?>
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <div class="row" style="text-align: center;">
                <div class=" col-md-12 col-sm-12 col-12">
                   <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG"   alt="logo" class="img-fluid" >
                </div>
                <!-- <div class=" col-md-6 col-sm-6 col-6">
                    <img src="/<?php echo base_url();?>assets/images/logo.png" alt="logo" class="img-fluid" >
                </div> -->

              </div>
              </div>
              <h4>Feedback To Our Executive </h4>
            <!--   <h4>How Do Feel About Our Executive </h4> -->
              <h6 class="font-weight-light"> here have a few questions for feedback  </h6>
              <form class="pt-3" method="post" id="business_given_feedback_form">
                
                <div class="form-group">
                  <input type="hidden" class="form-control" id="business_given_marketing_userid" value="<?php echo $businessid[0]['marketing_user_id']; ?>" name=" business_given_marketing_userid">
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control form-control-lg" value="<?php echo $businessid[0]['business_details_id'] ; ?>" id="business_given_businessid" name="business_given_businessid">
                </div>

                 <div class="form-group">
                  <input type="hidden" class="form-control form-control-lg"  value=" <?php echo count($feedbackquestions) ?>" id="business_given_questioncount" name="business_given_questioncount">
                </div>

                 <?php
                    for($i=0;$i<count($feedbackquestions);$i++)
                    {
                         ?>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <span> <?php echo $feedbackquestions[$i]['id']."&nbsp . ".$feedbackquestions[$i]['question'];?></span>
                                         <input type="hidden" value="<?php echo $feedbackquestions[$i]['id']?>" id="business_given_feedback_question" name="business_given_feedback_question<?php echo $i;?>">
                                    </div>
                                </div>
                               <div class="col-sm-12">
                                    <div class="form-group">
                                       <!-- <label>Options :</label> -->
                                        <div class="row">
                                          <div class="col-sm-6" style="text-align: center;"><span>Yes</span>&nbsp; &nbsp; <input type="radio" value="1" name="business_given_feedback_option<?php echo $i;?>" id="business_given_yes"></div>
                                          <div class="col-sm-6" style="text-align: center;"><span>No</span>&nbsp; &nbsp; <input type="radio" value="2" name="business_given_feedback_option<?php echo $i;?>" id="business_given_no"></div>
                                        </div>
                                    </div>
                                </div>
                                 <?php  } ?>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <h5>Any Additional Comments:</h5>
                                         <textarea class="form-control" rows="2" cols="2" name="business_given_feedback_comments" id="business_given_feedback_comments" >
                                          </textarea>
                                          <!--  <input type="text" class="form-control" rows="2" cols="2" name="add_feedback_question" id="add_feedback_question" placeholder="Write Question" > -->
                                        
                                    </div>
                                </div>
                <div class="mt-3 row clearfixed">
                    <div class="col-sm-6">
                      <div class="form-group">
                  <button type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="business_given_feedback_save" name="business_given_feedback_save">SUBMIT</button>
                   </div>
                 </div>
                 <div class="col-sm-6">
                      <div class="form-group">
                   <button type="reset" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="" name="">CANCEL</button>
                     </div>
                 </div>
                </div>
              </form>
              <div id="feedback-savemsg"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<?php
include('static/Empty_Footer.php');
?>