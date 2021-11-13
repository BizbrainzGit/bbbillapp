<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/marketLayout_Header.php');
?>

<div class="main-panel">
<div class="modal fade" id="EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
         <form id="change_status_form" method="post" >
               <div class="modal-body">
                    <div class="body">
                      <div id="change_status-editmsg"></div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <input type="hidden" id="change_status_id" name="change_status_id"> 
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status :</label>
                                          <select class='form-control' name="change_status" id="change_status">
                                            <option id="">Select Status</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                      
                    </div>
                </div>
              <div class="modal-footer">
                <div class="col-sm-12" style="text-align: center;">
                    <button type="button" id="updatestatus" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
              </div>
           </form>
      </div>
    </div>
  </div>

<div class="content-wrapper listbusiness-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Business
        	          <div style="float:right;">
        	          <button type="button" class="btn btn-info btn-sm" id="showaddbusiness" title="Add Business">
        	          <i class="fa fa-plus" aria-hidden="true"></i>
        	          Add Business
        	          </button>
        	          </div>
               </h4>

                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">             
                        </div>
                     </div>
                     
                       <div class="col-sm-2 col-12"></div>
                       <div class="col-sm-8 col-12">
                    <form id="search_business" method="post" >
                      <div class="row clearfix" >
                               <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Comany Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="search_business_cname" id="search_business_cname">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>City Name :</label>
                                        <select class="form-control" name="search_business_city" id="search_business_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                
                                  <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label> From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_business_fromdate" id="search_business_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-sm-6 col-12">
                                   <div class="form-group">
                                      <label>  To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_business_todate" id="search_business_todate">
                                         </div> 
                                   </div>
                                </div>
                                <div class=" col-12 col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchbusiness" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div>
                          <div class="col-sm-2 col-12"></div>
                  </div>
             

                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="businesstable" class="table table-hover businesstable">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<div class="content-wrapper addbusiness-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Details
                    <a href="/<?php echo base_url();?>Marketing-manageBusiness"> <div style="float:right;"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a>
                  </h4>
                  <form id="add_businessdata"  method="post" enctype="multipart/form-data" >
                    <div>
                    <!--  <h3 class="text-uppercase">Business KeyWords</h3>
                      <section class="text-uppercase">
                        <h3>Business KeyWords</h3>
                      <div class="row clearfixed">
                       <div class="col-sm-2 col-12"></div>
                       <div class="col-sm-8 col-12">
                                 <div class="row clearfix" >
                                   <div class="col-sm-6 col-12 text-center">
                                    <div class="form-group">
                                       <label> Search Business Keywords </label>
                                      <input type="text" class="form-control" placeholder="Search Business Keywords" name="search_business_keyword" id="search_business_keyword">
                                   </div>
                                  </div>
                               </div> 
                        </div>
                          <div class="col-sm-2 col-12">
                              <div style="text-align: right;"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddNewBusinesskeywordsModal"><i class="fa fa-plus" aria-hidden="true"></i>Add Business Keywords </button>
                             </div>
                         </div>
                       </div>
                         <div class="form-group" id="search_business_keywords-msg"></div>
                         <div class="row clearfixed" id="addkeywordsbusiness"></div>
                      </section> -->



                        <h3>Demo WebSite</h3>
                      <section>
                        <h3>Demo WebSite</h3>
                      <div class="row clearfixed">
                       <div class="col-sm-2 col-12"></div>
                       <div class="col-sm-8 col-12">
                                 <div class="row clearfix" >
                                   <div class="col-sm-8 col-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_business_website" id="search_business_website" style="width: 100%;"></select>
                                   </div>
                                  </div>
                                  <div class="col-sm-4 col-12" style="text-align: center;">
                                    <button  type="button" id="searchbusinesswebcategory" class="btn btn-primary">Search</button>
                                  </div> 
                               </div> 
                       </div>
                          <div class="col-sm-2 col-12"></div>

                      </div>
                         <div class="form-group" id="search_business_website-msg"></div>
                         <div class="row clearfixed" id="demowebsitesbusiness" >
                    
                        </div>
                       
                      </section>
                      

                      <h3>Company Details</h3>
                      <section>
                        <h3>Company  Details</h3>
                        <div class="row clearfixed">

                          <div class="col-sm-6 col-12 form-group">
                          <label>Company Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Company Name" name="add_business_cname" id="add_business_cname">
                         </div>

                          <div class="col-sm-6 col-12 form-group">
                            <label>Business Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  placeholder="Enter Business Category" name="add_business_category_name" id="add_business_category_name">
                         </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control" placeholder="Building No/House No" name="add_business_hno" id="add_business_hno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Street/Road</label>
                          <input type="text" class="form-control" placeholder="Street Name" name="add_business_street" id="add_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Sub Area</label>
                          <input type="text" class="form-control" placeholder="Sub Area" name="add_business_subarea" id="add_business_subarea">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control" placeholder="Area" name="add_business_area" id="add_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control" placeholder="Landmark" name="add_business_landmark" id="add_business_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" placeholder="PINCODE" name="add_business_pincode" id="add_business_pincode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City <span class="text-danger">*</span></label>
                           <select class="form-control" name="add_business_city" id="add_business_city" onchange="getState(this);">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>State <span class="text-danger">*</span></label>
                          <select class="form-control" name="add_business_state" id="add_business_state">
                          </select>
                        </div>
                      </div>

                      </section>
                      <h3>Contact Details</h3>
                      <section>
                        <h3></h3>

                        <div class="row clearfixed">
                          <div class="col-sm-12 col-12 "><h5> Contact Information:</h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Person Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" placeholder="Person Name" name="add_business_pname" id="add_business_pname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" placeholder="Designation"  name="add_business_designation" id="add_business_designation">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="add_business_mobileno" id="add_business_mobileno">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Confirm MOBILE NUMBER" name="add_business_cmobileno" id="add_business_cmobileno">
                          </div>
                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landline Number</label>
                          <input type="text" class="form-control" placeholder="LANDLINE NUMBER" name="add_business_landlineno" id="add_business_landlineno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Alternative Mobile Number</label>
                          <input type="text" class="form-control" placeholder="ALTERNATIVE MOBILE NUMBER" name="add_business_altnemobileno" id="add_business_altnemobileno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Company Email <span class="text-danger">*</span> </label>
                          <input type="email" class="form-control" placeholder="Email" name="add_business_email" id="add_business_email">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Company Photo</label>
                          <input type="file" class="form-control" name="add_business_photo" id="add_business_photo" >
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Visiting Card Photo</label>
                          <input type="file" class="form-control" name="add_business_visitingcardphoto" id="add_business_visitingcardphoto">
                        </div>
                       <!--  <div class="row clearfixed"> -->
                        <div class="col-sm-12 col-12 "><h5> Owner Details :</h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control" placeholder="Owner Name" name="add_business_owner1name" id="add_business_owner1name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control" placeholder="Designation"  name="add_business_owner1role" id="add_business_owner1role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="add_business_owner1mobile" id="add_business_owner1mobile">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" placeholder="Email" name="add_business_owner1email" id="add_business_owner1email">
                        </div>
                         <div class="col-sm-12 col-12 "><h5> Another Owner Details :</h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control" placeholder="Owner Name" name="add_business_owner2name" id="add_business_owner2name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control" placeholder="Designation"  name="add_business_owner2role" id="add_business_owner2role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="add_business_owner2mobile" id="add_business_owner2mobile">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" placeholder="Email" name="add_business_owner2email" id="add_business_owner2email">
                        </div>
                   <!--    </div> -->
                        <!--  <div class="col-sm-6 col-12 form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-web text-web icon-md"></i></span>
                              </div>
                            <input type="text" class="form-control"  placeholder="Website URL" name="add_business_website" id="add_business_website">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-facebook text-facebook icon-md"></i></span>
                              </div>
                            <input type="text" class="form-control"  placeholder="Facebook URL" name="add_business_facebook" id="add_business_facebook">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-twitter text-twitter icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Twitter URL" name="add_business_twitter" id="add_business_twitter">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-youtube text-youtube icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Youtube URL" name="add_business_youtube" id="add_business_youtube">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-linkedin text-linkedin icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control" placeholder="Linkedin URL" name="add_business_linkedin" id="add_business_linkedin">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-instagram text-instagram icon-md"></i></span>
                              </div>
                           <input type="text" class="form-control" placeholder="Instagram URL" name="add_business_instagram" id="add_business_instagram">
                            </div>
                         </div> -->
                      </div>
                      </section>
                      <h3>Map Location</h3>
                      <section>
                        <h3>Map Location</h3>
                        <div class="form-group">
                          <label>Seclect Company Location in Map </label>
                          <div class="col-md-12 col-lg-12 grid-margin">
                                <div class="row mb-3">
                                  <div class="col-sm-6 col-md-6 col-lg-6">
                                      <label> Latitude:</label>
                                      <input type="text" id="add_business_currentlat" name="add_business_currentlat">
                                  </div>
                                  <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>Longitude:</label> <input type="text" id="add_business_currentlag" name="add_business_currentlag">
                                  </div>
                                </div>
                              <div class="map-container">
                                <div id="dvMap" class="google-map"></div>
                              </div>
                            </div>
                        </div>
                           
                         
                            
                         
                      </section>

                      <h3>Domain && GST Details</h3>
                      <section>
                        <h3> Domain && GST Details</h3>
                     <div class="row clearfixed">

                       <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>
                        <div class="col-sm-6 col-12 form-group">
                           <!-- <p>Note : Domain For only one Year </p> -->
                          <label>Domain Amount (With Out GST) <input  type="checkbox" value="1" name="add_business_domainamount_checked" id="add_business_domainamount_checked"> </label>
                          <input type="text" class="form-control" placeholder="Domain Amount" name="add_business_domainamount" id="add_business_domainamount" value="800" readonly="">
                        </div>


                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 1 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_business_domainnames_option1" id="add_business_domainnames_option1">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 2 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_business_domainnames_option2" id="add_business_domainnames_option2">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 3 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_business_domainnames_option3" id="add_business_domainnames_option3">
                        </div>

                        <!-- <div class="col-sm-6 col-12 form-group">
                          <label>GST Company Name</label>
                          <input type="text" class="form-control" placeholder="GST Company Name" name="add_business_gstcname" id="add_business_gstcname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Company Name</label>
                          <input type="text" class="form-control" placeholder="Confirm GST Company Name" name="add_business_cgstcname" id="add_business_cgstcname">
                        </div> 
                         -->
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Number </label>
                          <input type="password" class="form-control" placeholder="GST Number"  name="add_business_gstno" id="add_business_gstno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Number</label>
                          <input type="text" class="form-control" placeholder="Confirm GST Number" name="add_business_cgstno" id="add_business_cgstno">
                        </div>
                        <!-- <div class="col-sm-6 col-12 form-group">
                          <label>GST State</label>
                           <select class="form-control"  name="add_business_gststate" id="add_business_gststate" ></select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Pincode</label>
                          <input type="text" class="form-control" placeholder="Pincode" name="add_business_gstpincode" id="add_business_gstpincode" minlength="6" maxlength="6">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Company PAN Number</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Company PAN Number" name="add_business_gstpanno" id="add_business_gstpanno">
                        </div>
                         <div class="col-sm-12 col-12 form-group">
                          <label>GST Address</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Address" name="add_business_gstaddress" id="add_business_gstaddress">
                        </div> -->

                         <div class="col-sm-6 col-12 form-group">
                               <label onclick="uppersaleFunction()" style="background-color:#1D2B6D; padding: 10px; border-radius: 50%; color: #ffffff;">
                                <i class="mdi mdi-arrow-up-bold"></i> </label> <label>  <input  class="form-control" type="text"  name="add_business_uppersale_amount" id="add_business_uppersale_amount" placeholder="Upper Sale Amount" disabled>  </label>
                                  <script type="text/javascript">
                                       function uppersaleFunction(){
                                          document.getElementById("add_business_uppersale_amount").disabled = false;
                                          }
                                  </script>
                                   <input  type="hidden"  class="form-control"  name="add_business_totaluppersale_amount" id="add_business_totaluppersale_amount" placeholder="Total Upper Sale Amount" >

                               </div>

                      </div>
                      </section>

                     
                     <!--  <h3>Campaign Selection</h3>
                      <section>
                       <h3>Company Name : <span id="cname"> </span></h3>
                          <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>

                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label> Campaign Selection</label>
                        </div>
                        <div class="row" id="addbusinesscampaignlist"></div>  
                           <label> ERP Selection</label>
                        <div class="row" id="addbusinesscampaignERPlist"></div> 
                     </section> -->

                        <h3>Package Selection</h3>
                      <section>
                        <h3>Package Selection <p> </h3>
                             <div class="row pricing-table" id="addbusinesspackagelist"></div>
                              <div class="col-sm-12 col-12" style="background-color: #66cc66; padding:10px;" > 
                               <label><input  type="checkbox" value="1" name="add_business_tds" id="add_business_tds">
                             Pls Check TDS Applicable.</label> </div>
                      </section>

                       <h3>Selected Details</h3>
                      <section>
                        <h3>Selected Detail</h3>

                       <div class="row clearfixed" id="business_campaignlist1">
                       </div>

                       <div class="row clearfixed" id="business_packagelist1">
                       </div>

                       <div class="row clearfixed" id="business_totalamount1">
                       </div>
                       
                        <!-- <form id="business_apply_promocode" method="post">  -->

                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12">
                          <label>Promocode</label>
                          
                        <!--   <input type="hidden" class="form-control" name="business_packages_total" id="business_packages_total">
                          <input type="hidden" class="form-control" name="business_packages_state_id" id="business_packages_state_id"> -->


                          <input type="text" class="form-control" placeholder="Promocode Enter" name="business_packages_promocode" id="business_packages_promocode">
                        </div>

                         <div class="col-sm-4 col-12 mt-2">
                           <label></label>
                          <button type="button" class="btn btn-primary form-control" name="business_applypromocode" id="business_applypromocode">Apply Promocode</button>
                          </div>
                             
                          </div>
                          <div id="business_promcodeamount-msg"></div>
                       <!-- </form> -->
                       <div class="row clearfixed" >
                          <div class="col-sm-12 col-12" id="business_discount"></div>
                        </div>

                         <div class="row clearfixed" >
                         <div class="col-sm-12 col-12" id="business_grandtotalamount"> </div>
                           
                            <input type="hidden" class="form-control" name="add_business_totalpackageamount" id="add_business_totalpackageamount">
                             
                            <input type="hidden" class="form-control" name="add_business_grandtotalamount" id="add_business_grandtotalamount">
                           <input type="hidden" class="form-control" name="add_business_promocode_grandtotalamount" id="add_business_promocode_grandtotalamount">
                            <input type="hidden" class="form-control" name="add_business_packages_discountamount" id="add_business_packages_discountamount">
                            <input type="hidden" class="form-control" name="add_business_packages_promocode_id" id="add_business_packages_promocode_id">



                        </div>
                      </section>
                       <h3>Mode of Payments</h3>
                      <section>
                       <h3>Mode of Payments</h3>
                <div class="row clearfixed">
                   <div class="col-sm-4 col-12">
                  <ul class="nav nav-pills nav-pills-vertical nav-pills-info">
                    <span id="addbusinesspaymentmode"></span>
                      </ul>
                    </div>
                    <div class="col-sm-8 col-12">
                      <div class="tab-content tab-content-vertical" id="newpaymentmode_cash" style="display: none">
                        <h5>Cash Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_business_cashamount" id="add_business_cashamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="add_business_cashdate" id="add_business_cashdate">
                          </div>
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Person Name</label>
                            <input type="text" class="form-control" placeholder="Person Name" name="add_business_personame" id="add_business_personame">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Place/City Name</label>
                            <input type="text" class="form-control" placeholder="Place/City Name" name="add_business_placename" id="add_business_placename">
                          </div>
                         </div> 
                      </div>
                      <!-- <div class="tab-content tab-content-vertical" id="newpaymentmode_debitcard" style="display: none">
                        <h5> PayUmoney  :</h5>
                        <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Debit Card Number</label>
                            <input type="text" class="form-control" placeholder="Debit Card Number" name="add_business_debitcardno" id="add_business_debitcardno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Expired Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Expired Date" name="add_business_debitcard_expireddate" id="add_business_debitcard_expireddate">
                          </div>
                          </div>
                         
                         </div> 
                      </div> -->
                     <!--  <div class="tab-content tab-content-vertical" id="newpaymentmode_creditcard" style="display: none">
                         <h5> Credit Card Details : </h5>
                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Credit Card Number</label>
                            <input type="text" class="form-control" placeholder="Credit Card Number" name="add_business_creditcardno" id="add_business_creditcardno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Expired Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Expired Date" name="add_business_creditcard_expireddate" id="add_business_creditcard_expireddate">
                          </div>
                          </div>
                         
                         </div> 
                      </div> -->
                      <div class="tab-content tab-content-vertical" id="newpaymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI ID</label>
                            <input type="text" class="form-control" placeholder="UPI ID" name="add_business_upi" id="add_business_upi">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Phone Pay</label>
                            <input type="text" class="form-control" placeholder="Phone Pay Number" name="add_business_phonepay" id="add_business_phonepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amazon Pay</label>
                            <input type="text" class="form-control" placeholder="Amazon Pay Number" name="add_business_amazonpay" id="add_business_amazonpay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Google Pay</label>
                            <input type="text" class="form-control" placeholder="GooglePay Number" name="add_business_googlepay" id="add_business_googlepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_business_upiamount" id="add_business_upiamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="newpaymentmode_paytm" style="display: none">
                         <h5> PayTm Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm UPI ID</label>
                            <input type="text" class="form-control" placeholder="PayTm UPI ID" name="add_business_paytm_upi" id="add_business_paytm_upi">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm Amount</label>
                            <input type="text" class="form-control" placeholder="PayTm Amount" name="add_business_paytmamount" id="add_business_paytmamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="newpaymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="add_business_chequeno" id="add_business_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Confirm Cheque Number" name="add_business_cchequeno" id="add_business_cchequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="add_business_chequeamount" id="add_business_chequeamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" name="add_business_chequeaccountno" id="add_business_chequeaccountno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Holder Name</label>
                            <input type="text" class="form-control" placeholder="Cheque Holder Name" name="add_business_chequeholdername" id="add_business_chequeholdername">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="add_business_chequeissuedate" id="add_business_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control" placeholder="Bank Name" name="add_business_cheque_bankname" id="add_business_cheque_bankname">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>IFSC Code</label>
                            <input type="text" class="form-control text-uppercase" placeholder="IFSC Code" name="add_business_cheque_ifsc" id="add_business_cheque_ifsc">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>MICR Code</label>
                            <input type="text" class="form-control" placeholder="MICR Code" name="add_business_cheque_micr" id="add_business_cheque_micr">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Photo</label>
                           <input type="file" class="form-control" name="add_business_cheque_photo" id="add_business_cheque_photo">
                          </div>
                         </div> 
                      </div>
                      <div class="tab-content tab-content-vertical" id="newpaymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Number</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="add_business_neftnumber" id="add_business_neftnumber">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="add_business_neftamount" id="add_business_neftamount">
                          </div>
                         </div> 
                      </div>
                     </div>
                   </div>
                     <h3>Business Status </h3>
                       <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                            <select class="form-control"  name="add_business_status" id="add_business_status" >
                           </select>
                        </div>
                         <input type="hidden" class="form-control" name="razorpay_payment_order_id" id="razorpay_payment_order_id" value="<?php echo $merchant_order_id; ?>">
                            <div class="form-check">
                          <h4><label class="form-check-label">
                            <input class="" type="checkbox" value="1" name="add_business_condition" id="add_business_condition">
                             I Agree With The Terms and Conditions.
                          </label></h4>
                           <div id="businessdata-addmsg"></div>
                        </div>
                      </section> 

                       <!--  <h3>Account Details</h3>
                      <section>
                        <h3> Account Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Number </label>
                          <input type="password" class="form-control" placeholder="Account Number"  name="add_business_accountno" id="add_business_accountno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Account Number</label>
                          <input type="text" class="form-control" placeholder="Account Number" name="add_business_caccountno" id="add_business_caccountno">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Account Holder Name </label>
                          <input type="password" class="form-control" placeholder="Account Holder Name "  name="add_business_acholdername" id="add_business_acholdername">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Holder Name</label>
                          <input type="text" class="form-control" placeholder="Account Holder Name " name="add_business_cacholdername" id="add_business_cacholdername">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank Name </label>
                          <input type="text" class="form-control text-uppercase" placeholder="Bank Name" name="add_business_bankname" id="add_business_bankname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank IFSC Code</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Bank IFSC Code" name="add_business_ifsccode" id="add_business_ifsccode">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank City </label>
                          <input type="text" class="form-control" placeholder="Bank City" name="add_business_bankcity" id="add_business_bankcity">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Branch Name </label>
                          <input type="text" class="form-control" placeholder="Branch Name" name="add_business_branchname" id="add_business_branchname">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Account Type </label>
                            <select class="form-control"  name="add_business_acctype" id="add_business_acctype" >
                              <option value="0"> Select Account Type </option>
                              <option value="1">Current Account </option>
                              <option value="2">Saving Account </option>
                          </select>
                        </div>
                      </div>
                      </section>
 
                        <h3>Final</h3>
                      <section >   
                      <input type="hidden" id="add_business_otp" name="add_business_otp">
                        <div style="text-align: center;">
                       <button class="btn btn-info btn-md" type="button" id="generated_opt" >Generate OTP</button>
                        </div>
                    
                     </section>  -->

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

  

        <div class="content-wrapper editbusiness-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit <span id="edit_businessname_head"></span>
                 <a href="/<?php echo base_url();?>Marketing-manageBusiness"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="edit_businessdata"  method="post" enctype="multipart/form-data" >
                    <div>
                      <h3>Company  Details</h3>
                      <section>
                        <h3>Company  Details</h3>
                        <div class="row clearfixed">
                          <input type="hidden" id="edit_business_id" name="edit_business_id">
                          <input type="hidden" id="edit_business_addid" name="edit_business_addid">
                        <div class="col-12 form-group">
                          <label>Company Name</label>
                          <input type="text" class="form-control " aria-describedby="emailHelp" placeholder="Company Name" name="edit_business_cname" id="edit_business_cname">
                         <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="edit_business_hno" id="edit_business_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street/Road</label>
                          <input type="text" class="form-control " placeholder="Street Name" name="edit_business_street" id="edit_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Sub Area</label>
                          <input type="text" class="form-control " placeholder="Sub Area" name="edit_business_subarea" id="edit_business_subarea">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control " placeholder="Area" name="edit_business_area" id="edit_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="edit_business_landmark" id="edit_business_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" placeholder="PINCODE" name="edit_business_pincode" id="edit_business_pincode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City</label>
                           <select class="form-control" name="edit_business_city" id="edit_business_city">
                            
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State</label>
                          <select class="form-control" name="edit_business_state" id="edit_business_state">
                            
                          </select>
                        </div>

                      </div>
                      </section>
                      <h3>Contact Details</h3>
                      <section>
                        <h3></h3>

                         

                        <div class="row clearfixed">
                          <div class="col-sm-12 col-12 form-group"><h5>Contact : </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Person Name</label>
                          <input type="text" class="form-control " placeholder="Person Name" name="edit_business_pname" id="edit_business_pname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="edit_business_designation" id="edit_business_designation">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="edit_business_mobileno" id="edit_business_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Alternative Mobile Number</label>
                          <input type="text" class="form-control" placeholder="ALTERNATIVE MOBILE NUMBER" name="edit_business_altnemobileno" id="edit_business_altnemobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landline Number/Company Number</label>
                          <input type="text" class="form-control" placeholder="LANDLINE NUMBER/COMPANY NUMBER" name="edit_business_landlineno" id="edit_business_landlineno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email </label>
                          <input type="email" class="form-control " placeholder="Email" name="edit_business_email" id="edit_business_email">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                         <div id="businessimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo</label>
                          <input type="file" class="form-control" name="edit_business_photo" id="edit_business_photo">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                        </div>
                         
                         <div class="row clearfixed">
                        <div class="col-sm-12 col-12 "><h5> Owner Details : </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control " placeholder="Owner Name" name="edit_business_owner1name" id="edit_business_owner1name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="edit_business_owner1role" id="edit_business_owner1role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="edit_business_owner1mobile" id="edit_business_owner1mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control " placeholder="Email" name="edit_business_owner1email" id="edit_business_owner1email">
                        </div>

                         <div class="col-sm-12 col-12 "><h5> Another Owner Details : </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control " placeholder="Owner Name" name="edit_business_owner2name" id="edit_business_owner2name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="edit_business_owner2role" id="edit_business_owner2role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="edit_business_owner2mobile" id="edit_business_owner2mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control " placeholder="Email" name="edit_business_owner2email" id="edit_business_owner2email">
                        </div>
                      </div>


                        <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-web text-web icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Website URL" name="edit_business_website" id="edit_business_website">
                            </div>

                         </div>

                         <div class="col-sm-6 col-12 form-group">
                           <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-facebook text-facebook icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Facebook URL" name="edit_business_facebook" id="edit_business_facebook">
                            </div>
                         </div>

                         <div class="col-sm-6 col-12 form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-twitter text-twitter icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Twitter URL" name="edit_business_twitter" id="edit_business_twitter">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                           <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-youtube text-youtube icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Youtube URL" name="edit_business_youtube" id="edit_business_youtube">
                            </div>

                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-linkedin text-linkedin icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Linkedin URL" name="edit_business_linkedin" id="edit_business_linkedin">
                            </div>

                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-instagram text-instagram icon-md"></i></span>
                              </div>
                            <input type="text" class="form-control" placeholder="Instagram URL" name="edit_business_instagram" id="edit_business_instagram">
                            </div>

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

                     
                      
                         <h3>GST Details</h3>
                      <section>
                        <h3> GST Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Company Name</label>
                          <input type="text" class="form-control " placeholder="Company Name" name="edit_business_gstcname" id="edit_business_gstcname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Company Name</label>
                          <input type="text" class="form-control " placeholder="Confirm GST Company Name" name="edit_business_cgstcname" id="edit_business_cgstcname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Number </label>
                          <input type="password" class="form-control text-uppercase" placeholder="GST Number" name="edit_business_gstno" id="edit_business_gstno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Number</label>
                          <input type="text" class="form-control text-uppercase"  placeholder="GST Number" name="edit_business_cgstno" id="edit_business_cgstno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>GST State</label>
                          <select class="form-control" name="edit_business_gststate" id="edit_business_gststate" ></select>
                          <!-- <input type="text" class="form-control" maxlength="10" placeholder="Write here"> -->
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Pincode</label>
                          <input type="text" class="form-control" minlength="6" maxlength="6" placeholder="Pincode" name="edit_business_gstpincode" id="edit_business_gstpincode">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Company PAN Number</label>
                          <input type="text" class="form-control text-uppercase " placeholder="Company PAN Number" name="edit_business_gstpanno" id="edit_business_gstpanno">
                        </div>
                       <!--   <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                            <select class="form-control"  name="edit_business_status" id="edit_business_status" >
                          </select>
                        </div> -->

                         <div class="col-sm-12 col-12 form-group">
                          <label>GST Address</label>
                          <input type="text" class="form-control " placeholder="Address" name="edit_business_gstaddress" id="edit_business_gstaddress">
                        </div>
                      </div>
                      </section>
                       <h3>Final</h3>
                      <section >                        
                       
                               <div class="form-check">
                                  <h4><label class="form-check-label">
                                    <input class="checkbox" type="checkbox" name="edit_business_condition" id="edit_business_condition">
                                    I Agree With The Terms and Conditions.
                                  </label></h4>
                                  <div id="businessdata-editmsg"></div>
                                </div>

                        </section>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
         
        </div>



              <!--- Selected Pakges View   -->
    <div class="content-wrapper addpackages-class" style="display: none;">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Details
                 <a href="/<?php echo base_url();?>Marketing-manageBusiness"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                  <form id="add_packagesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                    <!--  <h3 class="text-uppercase">Business KeyWords</h3>
                      <section class="text-uppercase">
                        <h3>Business KeyWords</h3>
                      <div class="row clearfixed">
                       <div class="col-sm-2 col-12"></div>
                       <div class="col-sm-8 col-12">
                                 <div class="row clearfix" >
                                   <div class="col-sm-8 col-12 text-center">
                                    <div class="form-group">
                                      <h5>Search Business Keywords</h5>
                                      <input type="text" class="form-control" placeholder="Search Business Keywords" name="search_packages_keyword" id="search_packages_keyword">
                                   </div>
                                  </div>
                                  <div class="col-sm-4 col-12" >
                                  </div> 
                               </div> 
                       </div>
                          <div class="col-sm-2 col-12"> <div style="text-align: right;"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddNewBusinesskeywordsModal"><i class="fa fa-plus" aria-hidden="true"></i>Add Business Keywords </button></div>
                        </div>
                      </div>
                         <div class="form-group" id="search_packages_keywords-msg"></div>
                         <div class="row clearfixed" id="addkeywordspackages" >
                        </div>
                      </section>  -->

                      <h3>Demo WebSite</h3>
                      <section>
                        <h3>Demo WebSite</h3>
                      <div class="row clearfixed">
                       <div class="col-sm-2 col-12"></div>
                       <div class="col-sm-8 col-12">
                           <!--  <form id="search_business_webcategory" method="post" > -->
                                 <div class="row clearfix" >
                                   <div class="col-sm-8 col-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_packages_website" id="search_packages_website" style="width: 100%;"></select>
                                   </div>
                                  </div>
                                  <div class="col-sm-4 col-12" style="text-align: center;">
                                    <button  type="button" id="searchpackageswebcategory" class="btn btn-primary">Search</button>
                                  </div> 
                               </div> 
                            </div>
                          <div class="col-sm-2 col-12"></div>
                       </div>
                         <div class="form-group" id="search_packages_website-msg"></div>
                         <div class="row clearfixed" id="demowebsitespackages" >
                        </div>
                      </section>

                      <h3>Domain && GST Details</h3>
                      <section>
                        <h3> Domain && GST Details</h3>
                       <div class="row clearfixed">
                       <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Amount (With Out GST) <input  type="checkbox" value="1" name="add_packages_domainamount_checked" id="add_packages_domainamount_checked"> </label>
                          <input type="text" class="form-control" placeholder="Domain Amount" name="add_packages_domainamount" id="add_packages_domainamount" value="800" readonly="">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 1 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_packages_domainnames_option1" id="add_packages_domainnames_option1">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 2 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_packages_domainnames_option2" id="add_packages_domainnames_option2">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 3 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="add_packages_domainnames_option3" id="add_packages_domainnames_option3">
                        </div>
                            <div class="col-sm-6 col-12 form-group">
                               <label onclick="packageuppersaleFunction()" style="background-color:#1D2B6D; padding: 10px; border-radius: 50%; color: #ffffff;">
                                <i class="mdi mdi-arrow-up-bold"></i> </label> <label>  <input  class="form-control" type="text"  name="add_packages_uppersale_amount" id="add_packages_uppersale_amount" placeholder="Upper Sale Amount" disabled>  </label>
                                  <script type="text/javascript">
                                       function packageuppersaleFunction(){
                                          document.getElementById("add_packages_uppersale_amount").disabled = false;
                                          }
                                  </script>
                                   <input  type="hidden"  class="form-control"  name="add_packages_totaluppersale_amount" id="add_packages_totaluppersale_amount" placeholder="Total Upper Sale Amount" >
                               </div>

                      </div>
                      </section>


                     <!--   <h3>Campaign Selection</h3>
                      <section>
                       <h3>Company Name : <span id="cname"> </span></h3>

                          <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>

                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label> Campaign Selection</label>
                            
                          </div>
                        </div>
                        <div class="row" id="addcampaignlist"></div>  
                           <label> ERP Selection</label>
                        <div class="row" id="addcampaignERPlist"></div> 
                  </section> -->

                        <h3>Package Selection</h3>
                      <section>
                        <h3>Package Selection</h3>
                            
                            

                     
                        
                             <input type="hidden" id="add_packages_companyname" name="add_packages_companyname">
                             <input type="hidden" id="add_packages_companyname_state_id" name="add_packages_companyname_state_id">

                             <div class="row pricing-table" id="addpackagelist"></div>
                             
                             <div class="col-sm-12 col-12" style="background-color: #66cc66; padding:10px;" > 
                                <input class="" type="checkbox" value="1" name="add_packages_tds" id="add_packages_tds">
                             Pls Check TDS Applicable.</p> </div>
                      </section>

                       <h3>Selected Details</h3>
                      <section>
                        <h3>Selected Detail</h3>

                       <div class="row clearfixed" id="campaignlist1">
                       </div>

                       <div class="row clearfixed" id="packagelist1">
                       </div>

                       <div class="row clearfixed" id="totalamount1">
                       </div>
                       
                       <form id="apply_promocode" method="post"> 
                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12">
                          <label>Promocode</label>
                          <input type="hidden" class="form-control" name="add_packages_total" id="add_packages_total">
                          <input type="hidden" class="form-control" name="add_packages_id" id="add_packages_id"> 
                          <input type="text" class="form-control" placeholder="Promocode Enter" name="add_packages_promocode" id="add_packages_promocode">
                        </div>

                         <div class="col-sm-4 col-12 mt-2">
                           <label></label>
                          <button type="button" class="btn btn-primary form-control" name="applypromocode" id="applypromocode">Apply Promocode</button>
                          </div>
                             
                          </div>
                          <div id="promcodeamount-msg"></div>
                       </form>
                       
                       <div class="row clearfixed" >
                          <div class="col-sm-12 col-12" id="discount">
                           
                           </div>
                        </div>

                        <div class="row clearfixed" >
                          <div class="col-sm-12 col-12" id="grandtotalamount">
                          
                           </div>

                         <input type="hidden" class="form-control" name="add_packages_discountamount" id="add_packages_discountamount">
                         <input type="hidden" class="form-control" name="add_packages_grandtotal" id="add_packages_grandtotal">
                         <input type="hidden" class="form-control" name="add_packages_promocode_id" id="add_packages_promocode_id">
                          <input type="hidden" class="form-control" name="add_packages_totalpackageamount" id="add_packages_totalpackageamount">

                        </div>
                      </section>

                         <h3>Mode of Payments</h3>
                      <section>
                       <h3>Mode of Payments</h3>

                <div class="row clearfixed">
                   <div class="col-sm-4 col-12">
                  <ul class="nav nav-pills nav-pills-vertical nav-pills-info">
                    <span id="addpackagespaymentmode"></span>
                      </ul>
                    </div>
                    <div class="col-sm-8 col-12"> 
                      <div class="tab-content tab-content-vertical" id="paymentmode_cash" style="display: none">
                        <h5>Cash Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_packages_cashamount" id="add_packages_cashamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="add_packages_cashdate" id="add_packages_cashdate">
                          </div>
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Person Name</label>
                            <input type="text" class="form-control" placeholder="Person Name" name="add_packages_personame" id="add_packages_personame">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Place/City Name</label>
                            <input type="text" class="form-control" placeholder="Place/City Name" name="add_packages_placename" id="add_packages_placename">
                          </div>
                         </div> 
                      </div>
                       <div class="tab-content tab-content-vertical" id="paymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Number</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="add_packages_neftnumber" id="add_packages_neftnumber">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Amount</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="add_packages_neftamount" id="add_packages_neftamount">
                          </div>
                         </div> 
                      </div>
                      <!--<div class="tab-content tab-content-vertical" id="paymentmode_debitcard" style="display: none">
                        <h5> Debit Card Details :</h5>
                        <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Debit Card Number</label>
                            <input type="text" class="form-control" placeholder="Debit Card Number" name="add_packages_debitcardno" id="add_packages_debitcardno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Expired Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Expired Date" name="add_packages_debitcard_expireddate" id="add_packages_debitcard_expireddate">
                          </div>
                          </div>
                       
                         </div> 
                      </div>-->
                      <!--<div class="tab-content tab-content-vertical" id="paymentmode_creditcard" style="display: none">
                         <h5> Credit Card Details : </h5>
                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Credit Card Number</label>
                            <input type="text" class="form-control" placeholder="Credit Card Number" name="add_packages_creditcardno" id="add_packages_creditcardno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Expired Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Expired Date" name="add_packages_creditcard_expireddate" id="add_packages_creditcard_expireddate">
                          </div>
                          </div>
                       
                         </div> 
                      
                      </div>-->
                      <div class="tab-content tab-content-vertical" id="paymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Number</label>
                            <input type="text" class="form-control" placeholder="UPI Number" name="add_packages_upi" id="add_packages_upi">
                          </div>
                            <div class="col-sm-6 col-12 form-group">
                            <label>Phone Pay</label>
                            <input type="text" class="form-control" placeholder="Phone Pay Number" name="add_packages_phonepay" id="add_packages_phonepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amazon Pay</label>
                            <input type="text" class="form-control" placeholder="Amazon Pay Number" name="add_packages_amazonpay" id="add_packages_amazonpay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Google Pay</label>
                            <input type="text" class="form-control" placeholder="GooglePay Number" name="add_packages_googlepay" id="add_packages_googlepay">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_packages_upiamount" id="add_packages_upiamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_paytm" style="display: none">
                         <h5> PayTm Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm UPI Number</label>
                            <input type="text" class="form-control" placeholder="PayTm UPI Number" name="add_packages_paytm_upi" id="add_packages_paytm_upi">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm Amount</label>
                            <input type="text" class="form-control" placeholder="PayTm Amount" name="add_packages_paytmamount" id="add_packages_paytmamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="add_packages_chequeno" id="add_packages_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Confirm Cheque Number" name="add_packages_cchequeno" id="add_packages_cchequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="add_packages_chequeamount" id="add_packages_chequeamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" name="add_packages_chequeaccountno" id="add_packages_chequeaccountno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Holder Name</label>
                            <input type="text" class="form-control" placeholder="Cheque Holder Name" name="add_packages_chequeholdername" id="add_packages_chequeholdername">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="add_packages_chequeissuedate" id="add_packages_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control " placeholder="Bank Name" name="add_packages_cheque_bankname" id="add_packages_cheque_bankname">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>IFSC Code</label>
                            <input type="text" class="form-control text-uppercase" placeholder="IFSC Code" name="add_packages_cheque_ifsc" id="add_packages_cheque_ifsc">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>MICR Code</label>
                            <input type="text" class="form-control" placeholder="MICR Code" name="add_packages_cheque_micr" id="add_packages_cheque_micr">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Photo</label>
                           <input type="file" class="form-control" name="add_packages_cheque_photo" id="add_packages_cheque_photo">
                          </div>
                         </div> 
                      </div>
                     </div>
                      <h3>Business Status </h3>
                       <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                            <select class="form-control"  name="add_packages_status" id="add_packages_status" >
                           </select>
                        </div>
                </div>
                </section>
                    
                      <!--  <h3>Account Details</h3>
                      <section>
                        <h3> Account Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>Account Number </label>
                          <input type="password" class="form-control" placeholder="Account Number"  name="add_packages_accountno" id="add_packages_accountno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Account Number</label>
                          <input type="text" class="form-control" placeholder="Account Number" name="add_packages_caccountno" id="add_packages_caccountno">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Account Holder Name </label>
                          <input type="password" class="form-control" placeholder="Account Holder Name "  name="add_packages_acholdername" id="add_packages_acholdername">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Holder Name</label>
                          <input type="text" class="form-control" placeholder="Account Holder Name " name="add_packages_cacholdername" id="add_packages_cacholdername">
                        </div>


                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank Name </label>
                          <input type="text" class="form-control " placeholder="Bank Name" name="add_packages_bankname" id="add_packages_bankname">
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank IFSC Code</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Bank IFSC Code" name="add_packages_ifsccode" id="add_packages_ifsccode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank City </label>
                          <input type="text" class="form-control" placeholder="Bank City" name="add_packages_bankcity" id="add_packages_bankcity">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Branch Name </label>
                          <input type="text" class="form-control" placeholder="Branch Name" name="add_packages_branchname" id="add_packages_branchname">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Account Type </label>
                            <select class="form-control"  name="add_packages_acctype" id="add_packages_acctype" >
                              <option value="0">Select Account Type </option>
                              <option value="1">Current Account </option>
                              <option value="2">Saving Account </option>
                          </select>
                        </div>
                      </div>
                      </section> -->
                      
                       <h3>Final</h3>
                      <section > 
                      <input type="hidden" class="form-control" name="razorpay_select_payment_order_id" id="razorpay_select_payment_order_id" value="<?php echo $merchant_order_id; ?>">


                      <!-- <input type="hidden" class="form-control" name="add_package_otp" id="add_package_otp">
                      <div style="text-align: center;">
                      <button class="btn btn-info btn-md" type="button" id="packages_generated_opt" >Generate OTP</button>
                        </div> -->
                                
                    <!--   style="border: 3px solid #302b2b;border-radius: 8px; width: auto;"            
                        <h3 style="text-align: center;">Terms and Conditions</h3>                       
                       <div style="word-break: break-all;">
                         <p>
                          <ul>
                            <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                             </li>
                             <li>Upon the execution of CCSI/NACH/Direct Debit MANDATE BizBrains is authorized to DEDUCT
                                the instalment amount until BizBrains receives advance notice as specified in clause 4 of the terms of service.
                              </li>
                              <li>In case payments mode opted by the ADVERTISER’S is CCSI & NACH, then the contract would be AUTOMATICALLY REEWED on the same terms and conditions unless determined by parties. The automatic renewal is at the absolute discretion of the BizBrians.                               
                              </li>
                              <li>If Advertiser wishes to terminate the ES/CCS/NACH/ Direct Debit facility, then Advertiser has to provide prior NOTICE OF 3 MONTHS to Biz Brains, only upon the completion of minimum tenure of  9(Nine) months from the effective date.
                              </li>
                              <li>BizBrains reserves the right to terminate the contract or its services at its discretion with or without cause or by serving 30(Thirty) days written notice to the Advertiser.
                              </li>
                              <li>BizBrains DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with Biz Brains.
                              </li>
                              <li>In case of any Disputes, differences and /or claims arising out of the contract shall be settled by Arbitration in accordance with the provisions of Arbitration and Conciliation Act 1996 or any statutory amendment thereof. The Arbitration shall be appointed by the authorized representative/Director of BizBrains. The proceeding shall be conducted in English and held at Hyderabad. The Award shall be final and binding. The Court of Hyderabad shall have the exclusive jurisdiction.
                              </li>
                              <li>The Advertiser has given his consent to contact him for any business promotion of BizBrains during the tenure of this agreement or even after the expiry of its tenure. Whether the Advertiser has registered their entity/firm’s contact numbers in the “Do Not Call” registry of Telecom Regulatory of India (TRAI).</li>
                          </ul>
                        </p>
                      </div> -->
                               <div class="form-check">
                                  <h4><label class="form-check-label">
                                  <input class="checkbox" type="checkbox" name="add_package_condition" id="add_package_condition">
                                    I Agree With The Terms and Conditions.
                                  </label></h4>
                                  <div id="packagesdata-addmsg"></div>
                                </div>

                        </section>
                    </div>
                  </form>
                  
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
       
<?php
include('Layouts/marketLayout_Footer.php');
?>




<script type="text/javascript">
  if ($('.imagesslider-class').length) {
    $('.imagesslider-class').owlCarousel({
      loop: true,
      margin: 5,
      items: 1,
      nav: true,
      autoplay: true,
      autoplayTimeout: 5500,
      navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"]
    });
  }

 $("#add_business_debitcard_expireddate").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
     $('#add_business_creditcard_expireddate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
   $("#add_packages_debitcard_expireddate").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'mm-yyyy'
});
     $('#add_packages_creditcard_expireddate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'mm-yyyy'
});
     $('#add_business_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
$('#add_packages_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

$('#search_business_fromdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
});
$('#search_business_todate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
});

$('#add_packages_cashdate').datepicker({
     todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

$('#add_business_cashdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

$('#add_paymentpending_cashdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

$('#add_paymentpending_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

</script>

<script>
  function shownewPaymentmode(test){

    var test = test.value;
    //alert(test);
    if(test==1)
      {  
    var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value
        document.getElementById("add_business_cashamount").value = grand_total;
        document.getElementById("add_business_upiamount").value = '';
        document.getElementById("add_business_paytmamount").value = '';
        document.getElementById("add_business_chequeamount").value =''; 
        document.getElementById("add_business_neftamount").value =''; 

        $("#newpaymentmode_cash").show();
        $("#newpaymentmode_cheque").hide();
        $("#newpaymentmode_neft").hide();
        $("#newpaymentmode_paytm").hide(); 
        $("#newpaymentmode_upi").hide();
        $("#razorPayModal").hide(); 
        


    $("#add_business_chequeno").val('');
    $("#add_business_chequeno").val('');
    $("#add_business_cchequeno").val('');
    $("#add_business_chequeaccountno").val('');
    $("#add_business_chequeholdername").val('');
    $("#add_business_chequeissuedate").val('');
    $("#add_business_cheque_bankname").val('');
    $("#add_business_cheque_ifsc").val('');
    $("#add_business_cheque_micr").val('');
    $("#add_business_cheque_photo").val('');

    $("#add_business_upi").val('');
    $("#add_business_phonepay").val('');
    $("#add_business_amazonpay").val('');
    $("#add_business_googlepay").val('');

    $("#add_business_paytm_upi").val('');
    $("#add_business_neftnumber").val('');

      }else if(test==4){
          var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value
          document.getElementById("add_business_cashamount").value = '';
          document.getElementById("add_business_upiamount").value = grand_total;
          document.getElementById("add_business_paytmamount").value = '';
          document.getElementById("add_business_chequeamount").value =''; 
          document.getElementById("add_business_neftamount").value =''; 
          $("#newpaymentmode_cash").hide();
          $("#newpaymentmode_cheque").hide();
          $("#newpaymentmode_upi").show();
          $("#newpaymentmode_paytm").hide(); 
          $("#razorPayModal").hide(); 
          $("#newpaymentmode_neft").hide();

      $("#add_business_chequeno").val('');
      $("#add_business_chequeno").val('');
      $("#add_business_cchequeno").val('');
      $("#add_business_chequeaccountno").val('');
      $("#add_business_chequeholdername").val('');
      $("#add_business_chequeissuedate").val('');
      $("#add_business_cheque_bankname").val('');
      $("#add_business_cheque_ifsc").val('');
      $("#add_business_cheque_micr").val('');
      $("#add_business_cheque_photo").val('');


      $("#add_business_paytm_upi").val('');

      $("#add_business_neftnumber").val('');


      $("#add_business_cashdate").val('');
      $("#add_business_personame").val('');
      $("#add_business_placename").val('');



      }else if(test==5)
      { 
        var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value
        document.getElementById("add_business_cashamount").value = '';
        document.getElementById("add_business_upiamount").value = '';
        document.getElementById("add_business_paytmamount").value = grand_total;
        document.getElementById("add_business_chequeamount").value =''; 
        document.getElementById("add_business_neftamount").value =''; 
             
        $("#newpaymentmode_cash").hide();
        $("#newpaymentmode_cheque").hide();
        $("#newpaymentmode_upi").hide();
        $("#newpaymentmode_paytm").show(); 
        $("#razorPayModal").hide(); 
        $("#newpaymentmode_neft").hide();

    $("#add_business_chequeno").val('');
    $("#add_business_chequeno").val('');
    $("#add_business_cchequeno").val('');
    $("#add_business_chequeaccountno").val('');
    $("#add_business_chequeholdername").val('');
    $("#add_business_chequeissuedate").val('');
    $("#add_business_cheque_bankname").val('');
    $("#add_business_cheque_ifsc").val('');
    $("#add_business_cheque_micr").val('');
    $("#add_business_cheque_photo").val('');

    $("#add_business_upi").val('');
    $("#add_business_phonepay").val('');
    $("#add_business_amazonpay").val('');
    $("#add_business_googlepay").val('');

    $("#add_business_neftnumber").val('');

    $("#add_business_cashdate").val('');
    $("#add_business_personame").val('');
    $("#add_business_placename").val('');

      }else if(test==6){ 
       
       var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value
        document.getElementById("add_business_cashamount").value = '';
        document.getElementById("add_business_upiamount").value = '';
        document.getElementById("add_business_paytmamount").value = '';
        document.getElementById("add_business_chequeamount").value =grand_total; 
        document.getElementById("add_business_neftamount").value =''; 
             
        $("#newpaymentmode_cash").hide();
        $("#newpaymentmode_cheque").show();
        $("#newpaymentmode_upi").hide();
        $("#newpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#newpaymentmode_neft").hide();

    $("#add_business_upi").val('');
    $("#add_business_phonepay").val('');
    $("#add_business_amazonpay").val('');
    $("#add_business_googlepay").val('');

    $("#add_business_paytm_upi").val('');

    $("#add_business_neftnumber").val('');

    $("#add_business_cashdate").val('');
    $("#add_business_personame").val('');
    $("#add_business_placename").val('');

      }if(test==7){

        var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value
        // alert(grand_total);
        document.getElementById("add_business_cashamount").value = '';
        document.getElementById("add_business_upiamount").value = '';
        document.getElementById("add_business_paytmamount").value = '';
        document.getElementById("add_business_chequeamount").value =''; 
        document.getElementById("add_business_neftamount").value =grand_total; 
             
        $("#newpaymentmode_cash").hide();
        $("#newpaymentmode_cheque").hide();
        $("#newpaymentmode_upi").hide();
        $("#newpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#newpaymentmode_neft").show();

    $("#add_business_chequeno").val('');
    $("#add_business_chequeno").val('');
    $("#add_business_cchequeno").val('');
    $("#add_business_chequeaccountno").val('');
    $("#add_business_chequeholdername").val('');
    $("#add_business_chequeissuedate").val('');
    $("#add_business_cheque_bankname").val('');
    $("#add_business_cheque_ifsc").val('');
    $("#add_business_cheque_micr").val('');
    $("#add_business_cheque_photo").val('');

    $("#add_business_upi").val('');
    $("#add_business_phonepay").val('');
    $("#add_business_amazonpay").val('');
    $("#add_business_googlepay").val('');

    $("#add_business_paytm_upi").val('');


    $("#add_business_cashdate").val('');
    $("#add_business_personame").val('');
    $("#add_business_placename").val('');


      }

if(test==8){

    $("#add_business_chequeno").val('');
    $("#add_business_chequeno").val('');
    $("#add_business_cchequeno").val('');
    $("#add_business_chequeaccountno").val('');
    $("#add_business_chequeholdername").val('');
    $("#add_business_chequeissuedate").val('');
    $("#add_business_cheque_bankname").val('');
    $("#add_business_cheque_ifsc").val('');
    $("#add_business_cheque_micr").val('');
    $("#add_business_cheque_photo").val('');

    $("#add_business_upi").val('');
    $("#add_business_phonepay").val('');
    $("#add_business_amazonpay").val('');
    $("#add_business_googlepay").val('');

    $("#add_business_paytm_upi").val('');

    $("#add_business_neftnumber").val('');

    $("#add_business_cashdate").val('');
    $("#add_business_personame").val('');
    $("#add_business_placename").val('');

    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('add_business_promocode_grandtotalamount').value)>0)? document.getElementById('add_business_promocode_grandtotalamount').value:document.getElementById('add_business_grandtotalamount').value;

    merchant_total=((grand_total*100)>0)? (grand_total*100):100;
    merchant_amount=((grand_total)>0)? grand_total:1;
     // alert(merchant_total);
     // alert(merchant_amount);
    document.getElementById('merchant_total').value=merchant_total;
    document.getElementById('merchant_amount').value=merchant_amount;


    $(document).ready(function(){
    $('#orderButton').click(function(){
    var merchant_order_id= $("#merchant_order_id").val();
    var merchant_total= $("#merchant_total").val();
    var merchant_amount= $("#merchant_amount").val();
   $.ajax({
    type: "POST",
     dataType: 'json',
    url:base_url+"BusinessController/orderRazorPayGeneration",
    cache: false,
    data: {merchant_order_id:merchant_order_id,merchant_total:merchant_total,merchant_amount:merchant_amount},
    success: function(result) {
        if(result.success===true){
            //alert('hi');
            // $("#orderGeneration").hide();
             $("#orderGeneration").modal("hide");
            $("#razorPayModal").modal();
            var razorpay_order_id=result.message;
            document.getElementById('razorpay_order_id').value=razorpay_order_id;
           //alert(razorpay_order_id);
           
           
        }else{
              $('#orderMessage').hide().fadeIn('slow').delay(1000).fadeOut(2200);
             $( "#orderMessage").html("<div class='alert alert-danger'>Some thing went wrong Please try again ...</div>");
        }
    }
   });
  });
});
     
  }

  }



  function showPaymentmode(test){
    var test = test.value;
    if(test==1)
      { 
       var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
        document.getElementById("add_packages_cashamount").value = grand_total;
         document.getElementById("add_packages_upiamount").value = '';
        document.getElementById("add_packages_paytmamount").value = '';
        document.getElementById("add_packages_chequeamount").value ='';
        document.getElementById("add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").show();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#add_packages_upi").val('');
      $("#add_packages_phonepay").val('');
      $("#add_packages_amazonpay").val('');
      $("#add_packages_googlepay").val('');

      $("#add_packages_paytm_upi").val('');

      $("#add_packages_chequeno").val('');
      $("#add_packages_cchequeno").val('');
      $("#add_packages_chequeaccountno").val('');
      $("#add_packages_chequeholdername").val('');
      $("#add_packages_chequeissuedate").val('');
      $("#add_packages_cheque_bankname").val('');
      $("#add_packages_cheque_ifsc").val('');
      $("#add_packages_cheque_micr").val('');
      $("#add_packages_cheque_photo").val(''); 
      $("#add_packages_neftnumber").val('');

      }else if(test==4){

        var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
        document.getElementById("add_packages_cashamount").value = '';
        document.getElementById("add_packages_upiamount").value = grand_total;
        document.getElementById("add_packages_paytmamount").value = '';
        document.getElementById("add_packages_chequeamount").value ='';
        document.getElementById("add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").show();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 
      $("#add_packages_paytm_upi").val('');
      $("#add_packages_chequeno").val('');
      $("#add_packages_cchequeno").val('');
      $("#add_packages_chequeaccountno").val('');
      $("#add_packages_chequeholdername").val('');
      $("#add_packages_chequeissuedate").val('');
      $("#add_packages_cheque_bankname").val('');
      $("#add_packages_cheque_ifsc").val('');
      $("#add_packages_cheque_micr").val('');
      $("#add_packages_cheque_photo").val(''); 

      $("#add_packages_cashdate").val('');
      $("#add_packages_personame").val('');
      $("#add_packages_placename").val(''); 

      $("#add_packages_neftnumber").val('');

      }else if(test==5)
      {  

       var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
        document.getElementById("add_packages_cashamount").value = '';
         document.getElementById("add_packages_upiamount").value = '';
        document.getElementById("add_packages_paytmamount").value = grand_total;
        document.getElementById("add_packages_chequeamount").value ='';
        document.getElementById("add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").show();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

        $("#add_packages_upi").val('');
        $("#add_packages_phonepay").val('');
        $("#add_packages_amazonpay").val('');
        $("#add_packages_googlepay").val('');
        $("#add_packages_chequeno").val('');
        $("#add_packages_cchequeno").val('');
        $("#add_packages_chequeaccountno").val('');
        $("#add_packages_chequeholdername").val('');
        $("#add_packages_chequeissuedate").val('');
        $("#add_packages_cheque_bankname").val('');
        $("#add_packages_cheque_ifsc").val('');
        $("#add_packages_cheque_micr").val('');
        $("#add_packages_cheque_photo").val(''); 

        $("#add_packages_cashdate").val('');
        $("#add_packages_personame").val('');
        $("#add_packages_placename").val(''); 

        $("#add_packages_neftnumber").val('');

      }else if(test==6){

        var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
        document.getElementById("add_packages_cashamount").value = '';
         document.getElementById("add_packages_upiamount").value = '';
        document.getElementById("add_packages_paytmamount").value = '';
        document.getElementById("add_packages_chequeamount").value =grand_total;
        document.getElementById("add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").show();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#add_packages_upi").val('');
      $("#add_packages_phonepay").val('');
      $("#add_packages_amazonpay").val('');
      $("#add_packages_googlepay").val('');

      $("#add_packages_paytm_upi").val('');


      $("#add_packages_cashdate").val('');
      $("#add_packages_personame").val('');
      $("#add_packages_placename").val(''); 

      $("#add_packages_neftnumber").val('');

        
      }else if(test==7)
      {   
         var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
        document.getElementById("add_packages_cashamount").value = '';
         document.getElementById("add_packages_upiamount").value = '';
        document.getElementById("add_packages_paytmamount").value = '';
        document.getElementById("add_packages_chequeamount").value ='';
        document.getElementById("add_packages_neftamount").value =grand_total;
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").show();
        $("#razorPayModal").hide(); 

        $("#add_packages_upi").val('');
        $("#add_packages_phonepay").val('');
        $("#add_packages_amazonpay").val('');
        $("#add_packages_googlepay").val('');

        $("#add_packages_paytm_upi").val('');

        $("#add_packages_chequeno").val('');
        $("#add_packages_cchequeno").val('');
        $("#add_packages_chequeaccountno").val('');
        $("#add_packages_chequeholdername").val('');
        $("#add_packages_chequeissuedate").val('');
        $("#add_packages_cheque_bankname").val('');
        $("#add_packages_cheque_ifsc").val('');
        $("#add_packages_cheque_micr").val('');
        $("#add_packages_cheque_photo").val(''); 

        $("#add_packages_cashdate").val('');
        $("#add_packages_personame").val('');
        $("#add_packages_placename").val(''); 


      }else if(test==8){

      $("#add_packages_upi").val('');
      $("#add_packages_phonepay").val('');
      $("#add_packages_amazonpay").val('');
      $("#add_packages_googlepay").val('');

      $("#add_packages_paytm_upi").val('');

      $("#add_packages_chequeno").val('');
      $("#add_packages_cchequeno").val('');
      $("#add_packages_chequeaccountno").val('');
      $("#add_packages_chequeholdername").val('');
      $("#add_packages_chequeissuedate").val('');
      $("#add_packages_cheque_bankname").val('');
      $("#add_packages_cheque_ifsc").val('');
      $("#add_packages_cheque_micr").val('');
      $("#add_packages_cheque_photo").val(''); 

      $("#add_packages_cashdate").val('');
      $("#add_packages_personame").val('');
      $("#add_packages_placename").val(''); 

      $("#add_packages_neftnumber").val('');

    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('add_packages_grandtotal').value)>0)? document.getElementById('add_packages_grandtotal').value:document.getElementById('add_packages_total').value;
    merchant_total=((grand_total*100)>0)? (grand_total*100):100;
    merchant_amount=((grand_total)>0)? grand_total:1;
    document.getElementById('merchant_total').value=merchant_total;
    document.getElementById('merchant_amount').value=merchant_amount;
    $(document).ready(function(){
    $('#orderButton').click(function(){
    var merchant_order_id= $("#merchant_order_id").val();
    var merchant_total= $("#merchant_total").val();
    var merchant_amount= $("#merchant_amount").val();
   $.ajax({
    type: "POST",
     dataType: 'json',
    url:base_url+"BusinessController/orderRazorPayGeneration",
    cache: false,
    data: {merchant_order_id:merchant_order_id,merchant_total:merchant_total,merchant_amount:merchant_amount},
    success: function(result) {
        if(result.success===true){
            //alert('hi');
            // $("#orderGeneration").hide();
             $("#orderGeneration").modal("hide");
            $("#razorPayModal").modal();
            var razorpay_order_id=result.message;
            document.getElementById('razorpay_order_id').value=razorpay_order_id;
           //alert(razorpay_order_id);
           
        }else{
              $('#orderMessage').hide().fadeIn('slow').delay(1000).fadeOut(2200);
             $( "#orderMessage").html("<div class='alert alert-danger'>Some thing went wrong Please try again ...</div>");
        }
    }
   });
  });
});
  }
  }

  
</script>



  <div class="modal" id="otpverficationmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">OTP Verfication </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form id="frm-mobile-verification">
          <div class="form-row">
            <label>OTP is sent to Your Mobile Number</label>    
          </div>
        <div class="form-row">
          <input type="text" class="form-control" name="mobileOtp"  id="mobileOtp" class="form-input" placeholder="Enter the OTP">  </div>
        <div class="row">
          <button id="otp_verification" type="button" class="btn btn-primary" >Submit</button>
        </div>
     </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>


  <div class="modal" id="package_otpverficationmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">OTP Verfication </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form id="frm-mobile-verification">
          <div class="form-row">
            <label>OTP is sent to Your Mobile Number</label>    
          </div>
        <div class="form-row">
          <input type="text" class="form-control" name="package_mobileOtp"  id="package_mobileOtp" class="form-input" placeholder="Enter the OTP">  </div>
        <div class="row">
          <button id="package_otp_verification" type="button" class="btn btn-primary" >Submit</button>
        </div>
     </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>

 