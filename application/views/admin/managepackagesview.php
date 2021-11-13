<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>

	<div class="main-panel">
<!-- 
<div class="content-wrapper listpackages-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Packages<div style="float:right"><button type="button" class="btn btn-info btn-sm" id="showaddpackages"><i class="fa fa-plus" aria-hidden="true"></i>Add</button></div></h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                           
                        </div>
                    </div>
                     <div class="col-12">
                      <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="packagestable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->




       

    
        <div class="content-wrapper editpackages-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit <span id="edit_packagesname_head"></span>
                 <a href="/<?php echo base_url();?>manageBusiness"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="edit_packagesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                      <h3>Location Details</h3>
                      <section>
                        <h3>Location Details</h3>
                        <div class="row clearfixed">
                        	<input type="hidden" id="edit_packages_id" name="edit_packages_id">
                          <input type="hidden" id="edit_packages_addid" name="edit_packages_addid">
                        <div class="col-12 form-group">
                          <label>Company Name</label>
                          <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Company Name" name="edit_packages_cname" id="edit_packages_cname">
                         <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control" placeholder="Building No/House No" name="edit_packages_hno" id="edit_packages_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street</label>
                          <input type="text" class="form-control" placeholder="Street Name" name="edit_packages_street" id="edit_packages_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Sub Area</label>
                          <input type="text" class="form-control" placeholder="Sub Area" name="edit_packages_subarea" id="edit_packages_subarea">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control" placeholder="Area" name="edit_packages_area" id="edit_packages_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control" placeholder="Landmark" name="edit_packages_landmark" id="edit_packages_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" maxlength="6" placeholder="Pincode" name="edit_packages_pincode" id="edit_packages_pincode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City</label>
                           <select class="form-control" name="edit_packages_city" id="edit_packages_city">
                          	
                          </select>
                         <!--  <input type="text" class="form-control" placeholder="Write here"> -->
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State</label>
                          <select class="form-control" name="edit_packages_state" id="edit_packages_state">
                          	
                          </select>
                          <!-- <input type="text" class="form-control" placeholder="Write here"> -->
                        </div>

                      </div>


                      </section>
                      <h3>Contact Details</h3>
                      <section>
                        <h3>Contact</h3>


                        <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Person Name</label>
                          <input type="text" class="form-control" placeholder="Person Name" name="edit_packages_pname" id="edit_packages_pname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landline Number/Company Number</label>
                          <input type="text" class="form-control" placeholder="Landline Number/Company Number" maxlength="14" name="edit_packages_landlineno" id="edit_packages_landlineno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="edit_packages_mobileno" id="edit_packages_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Alternative Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Alternative Mobile Number" name="edit_packages_altnemobileno" id="edit_packages_altnemobileno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email </label>
                          <input type="email" class="form-control" placeholder="Email" name="edit_packages_email" id="edit_packages_email">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                         <div id="packagesimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo</label>
                          <input type="file" class="form-control" name="edit_packages_photo" id="edit_packages_photo">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                            <label>Website</label>
                            <input type="text" class="form-control"  placeholder="Website URL" name="edit_packages_website" id="edit_packages_website">
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control"  placeholder="Facebook URL" name="edit_packages_facebook" id="edit_packages_facebook">
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control"  placeholder="Facebook URL" name="edit_packages_twitter" id="edit_packages_twitter">
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control"  placeholder="Facebook URL" name="edit_packages_youtube" id="edit_packages_youtube">
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control"  placeholder="Facebook URL" name="edit_packages_linkedin" id="edit_packages_linkedin">
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" placeholder="Instagram URL" name="edit_packages_instagram" id="edit_packages_instagram">
                         </div>
                       

                      </div>


                      </section>
                      <h3>Map Location</h3>
                      <section>
                        <h3>Map Location</h3>
                        <div class="form-group">
                          <label>Seclect Company Location in Map </label>
                           
                          <!--   <div id="editdvMap" class="google-map"></div> -->

                          <div ><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15231.277659457965!2d78.53201005!3d17.372420499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1559383383757!5m2!1sen!2sin"  height="450" frameborder="0" style="border:0; width: 100%" allowfullscreen></iframe></div>
                        
                        </div>
                      </section>
                      <h3>Mode of Payments</h3>
                      <section>
                        <h3>Mode of Payments</h3>

                        <div class="row" id="editpayment">

                       </div>   

                      </section>

                       <h3>Campaign Selection</h3>
                      <section>
                        <h3>Campaign Selection</h3>

                        <div class="row" id="editcampaignlist">

                       </div>   

                      </section>
                          <h3>Owner & Employee Details</h3>
                      <section>
                        <h3>  </h3>
                     <div class="row clearfixed">
                                                 <div class="col-sm-12 col-12 "><h5> Owner Details </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control" placeholder="Owner Name" name="edit_packages_owner1name" id="edit_packages_owner1name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control" placeholder="Designation"  name="edit_packages_owner1role" id="edit_packages_owner1role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="edit_packages_owner1mobile" id="edit_packages_owner1mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" placeholder="Email" name="edit_packages_owner1email" id="edit_packages_owner1email">
                        </div>

                         <div class="col-sm-12 col-12 "><h5> Another Owner Details </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control" placeholder="Owner Name" name="edit_packages_owner2name" id="edit_packages_owner2name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control" placeholder="Designation"  name="edit_packages_owner2role" id="edit_packages_owner2role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="edit_packages_owner2mobile" id="edit_packages_owner2mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" placeholder="Email" name="edit_packages_owner2email" id="edit_packages_owner2email">
                        </div>

                         <div class="col-sm-12 col-12"><h5> Employee Details </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Employee Name</label>
                          <input type="text" class="form-control" placeholder="Employee Name" name="edit_packages_empname" id="edit_packages_empname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control" placeholder="Designation"  name="edit_packages_emprole" id="edit_packages_emprole">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" maxlength="10" placeholder="Mobile Number" name="edit_packages_empmobile" id="edit_packages_empmobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" placeholder="Email" name="edit_packages_empemail" id="edit_packages_empemail">
                        </div>

                      

                      </div>
                      </section>
                         <h3>GST Details</h3>
                      <section>
                        <h3> GST Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Company Name</label>
                          <input type="text" class="form-control" placeholder="Company Name" name="edit_packages_gstcname" id="edit_packages_gstcname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Number </label>
                          <input type="password" class="form-control" placeholder="GST Number" name="edit_packages_gstno" id="edit_packages_gstno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Number</label>
                          <input type="text" class="form-control"  placeholder="GST Number" name="edit_packages_cgstno" id="edit_packages_cgstno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>GST State</label>
                          <select class="form-control" name="edit_packages_gststate" id="edit_packages_gststate" ></select>
                          <!-- <input type="text" class="form-control" maxlength="10" placeholder="Write here"> -->
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Pincode</label>
                          <input type="text" class="form-control" placeholder="Pincode" name="edit_packages_gstpincode" id="edit_packages_gstpincode">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Company PAN Number</label>
                          <input type="text" class="form-control" placeholder="Company PAN Number" name="edit_packages_gstpanno" id="edit_packages_gstpanno">
                        </div>

                         <div class="col-sm-12 col-12 form-group">
                          <label>GST Address</label>
                          <input type="text" class="form-control" placeholder="Address" name="edit_packages_gstaddress" id="edit_packages_gstaddress">
                        </div>

                      </div>
                      </section>

                        <h3>Account Details</h3>
                      <section>
                        <h3> Account Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Number </label>
                          <input type="password" class="form-control" placeholder="Account Number" name="edit_packages_accountno" id="edit_packages_accountno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Account Number</label>
                          <input type="text" class="form-control"  placeholder="Account Number" name="edit_packages_caccountno" id="edit_packages_caccountno">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Account Holder Name </label>
                          <input type="password" class="form-control" placeholder="Account Holder Name" name="edit_packages_acholdername" id="edit_packages_acholdername">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Account Holder Name </label>
                          <input type="text" class="form-control"  placeholder="Account Holder Name" name="edit_packages_cacholdername" id="edit_packages_cacholdername">
                        </div>


                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank Name </label>
                          <input type="text" class="form-control"  placeholder="Write here" name="edit_packages_bankname" id="edit_packages_bankname">
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank IFSC Code</label>
                          <input type="text" class="form-control" placeholder="Bank IFSC Code" name="edit_packages_ifsccode" id="edit_packages_ifsccode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank City </label>
                          <input type="text" class="form-control" placeholder="Bank City" name="edit_packages_bankcity" id="edit_packages_bankcity">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Branch Name </label>
                          <input type="text" class="form-control" placeholder="Branch Name" name="edit_packages_branchname" id="edit_packages_branchname">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Account Type </label>
                          <select class="form-control"  name="edit_packages_acctype" id="edit_packages_acctype" >
                              <option value=" "> Select Account Type </option>
                              <option value="1">Current Account </option>
                              <option value="2">Saveing Account </option>
                          </select>
                         <!--  <input type="text" class="form-control" placeholder="Write here" name="edit_packages_acctype" id="edit_packages_acctype"> -->
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label> Status </label>
                            <select class="form-control"  name="edit_packages_status" id="edit_packages_status" >
                              
                          </select>
                        
                        </div>


                      </div>

                       <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="edit_packages_condition" id="edit_packages_condition">
                            I agree with the Terms and Conditions.
                          </label>
                          <div id="packagesdata-editmsg"></div>
                        </div>

                      </section>
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>
       
         
<?php
include('Layouts/adminLayout_Footer.php');
?>
