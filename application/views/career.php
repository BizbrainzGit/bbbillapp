<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>

<!-- ==============================================
**Inner Banner**
=================================================== -->

         <?php  if(isset($banner)&&count($banner)>0){

         foreach($banner as $row => $data)  {  if($row==0){ ?>
        <section class="inner-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->image; ?>') no-repeat center fixed;
             background-size:100% 100%;">
            <div class="container">
                <div class="contents">
                    <h1 style="font-size:60px;"><?php echo $data->banner_title;  ?></h1>
                    <p><?php echo $data->banner_content;  ?></span></p>
                </div>
            </div>
        </section>

 <?php } } }?>



<!-- ==============================================
**What can we do Sec**
=================================================== -->
        <section class="wht-can-we-do-outer padding-lg" id="current-openings">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 content-area">
                        <h2>Opening <span class="bulecolor">Positions </span> </h2>
                    </div>
                </div>
                <div class="row">


                          <?php  if(isset($jobdata)){
                   foreach($jobdata as $row => $data) {  
                    ?> 

                    <div class="col-md-4">
                        <div class="career-info-panel equal-hight">
                            <h3><?php echo $data->job_title;  ?></h3>
                            <p><?php echo $data->job_content; ?></p>
                            <ul class="jobskills-height"> 
                                <?php   

                                $skillsarray=(explode(",",$data->jobskill_name)); 
                                for($i=0;$i<count($skillsarray);$i++){
                                ?>
                                <li><?php echo $skillsarray[$i]; ?></li>
                            <?php } ?>
                            </ul>
                            <a class="btn apply-now" data-toggle="modal" data-target="#applyjobModal">Apply Now</a> </div>
                    </div>

                       <?php } } ?>

                </div>
            </div>
        </section>



<?php
include('static/Frontend_Empty_footer.php');
?>


  <div class="modal fade" id="applyjobModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apply for Job</h4>
          <button type="button" class="close1" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <form id="add_applyjob" method="post" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Apply For Job <span class="redcolor">*</span> </label>
                                        <select class="form-control" name="add_applyjob_id" id="add_applyjob_id"></select>
                                    </div>
                                </div>

                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="redcolor">*</span> </label>
                                        <input type="text" class="form-control" placeholder="First Name" name="add_applyjob_firstname" id="add_applyjob_firstname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name </label>
                                        <input type="text" class="form-control" placeholder="Last Name" name="add_applyjob_lastname" id="add_applyjob_lastname">
                                    </div>
                                </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Id <span class="redcolor">*</span> </label>
                                         <input type="text" class="form-control" placeholder="Email Id" name="add_applyjob_emailid" id="add_applyjob_emailid">
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Mobile No <span class="redcolor">*</span></label>
                                        <input type="text" class="form-control" placeholder="Mobile No" name="add_applyjob_mobileno" id="add_applyjob_mobileno">
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Height Qualification <span class="redcolor">*</span></label>
                                        <input type="text" class="form-control" placeholder="Height Qualification" name="add_applyjob_qualification" id="add_applyjob_qualification">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Upload Resume <span class="redcolor">*</span></label>
                                         <input type="file" class="form-control"  name="add_applyjob_file" id="add_applyjob_file"><span class="">doc, docx, pdf - 2MB max</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Current Address</label>
                                       <textarea class="form-control" placeholder="Current Address" name="add_applyjob_address" id="add_applyjob_address"> </textarea>
                                    </div>
                                </div>
                                 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Message</label>
                                        <textarea class="form-control" name="add_applyjob_message" id="add_applyjob_message" > </textarea>
                                    </div>
                                </div>
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addapplyjob" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
              <div id="applyjob-addmsg"></div>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
<!--  add model end -->
