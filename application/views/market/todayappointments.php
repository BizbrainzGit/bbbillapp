<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/marketLayout_Header.php');
?>

<div class="main-panel">
<!-- 
<div class="modal fade" id="market_EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <div class="modal-body">
                 <div class="row clearfix" id="market_appointment_statuschecked"></div>
                    <div class="row clearfix" id="market_appointment_statusmodel">
                    <div class="body">
                        <form id="todaymarket_change_status_form" method="post" >
                          <input type="hidden" id="todaymarket_change_status_id" name="todaymarket_change_status_id"> 
                          <input type="hidden" id="todaymarket_change_assignment_id" name="todaymarket_change_assignment_id">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Message <span style="color: red">*</span> :</label>
                                         <input  class='form-control' type="text" id="todaymarket_change_assignment_message" name="todaymarket_change_assignment_message"> 
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status<span style="color: red">*</span> :</label>
                                         <select class='form-control' name="todaymarket_change_status" id="todaymarket_change_status">
                                            <option id="">Select Status</option>
                                          </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center;">
                                    <div id="todaymarket-editmsg"></div>
                                <button type="button" id="todaymarket_updatestatus" class="btn btn-primary">Update</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                               </div>
                            </div>

                           </div>

                        </form>
              
                     </div>

                    </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div> -->


<?php
$txnid = time();
$merchant_order_id="BB_RAZORPAY_".$txnid;
$surl = '/'.base_url().'BusinessController/success';
$furl = '/'.base_url().'BusinessController/failed';        
$key_id = $this->config->item('RAZOR_KEY_ID');
$currency_code = $this->config->item('DISPLAY_CURRENCY'); 
$card_holder_name=isset($card_holder_name)?$card_holder_name:"Test";
$productinfo=isset($merchant_product_info_id)?$merchant_product_info_id:null;
?>
<div class="modal fade" id="razorPayModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pay Now</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                <h6>Are you sure you want to Pay Online?</h6>
                              </div>
                                <div class="col-sm-12">
                                  
                <form name="razorpay-form" id="razorpay-form" action="/<?php echo base_url();?>BusinessController/callback" method="POST" target="_blank">
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                  <input type="hidden" name="razorpay_signature" id="razorpay_signature" />
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                  <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value=""/>
                </form>
                                </div>
                                  
                            </div>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
          <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Yes" class="btn btn-primary" />
          <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade"  role="dialog" id="orderGeneration">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Generation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                        <div id="orderMessage"></div>
                            <div class="row clearfix">
                              <div class="col-sm-12">
                                <h6>Are you sure you want to Genarate an Order?</h6>
                              </div>
                                <div class="col-sm-12">
                <form name="orderRazorpayForm" id="orderRazorpayForm" method="POST">
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value=""/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value=""/>
                </form>
                                </div>
                                  
                            </div>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
      <div class="row">
        <div class="col-lg-12 text-right">
            <button type="button" id="orderButton" class="btn btn-primary orderButton">Yes</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>


  
<div class="content-wrapper market_todayAppointmentList_class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Today's Appointment List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                      </div>
                    </div>
                     <div class="col-12"> </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="todayapptable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



         <div class="content-wrapper market_addpackages-class" style="display: none;">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Details
                 <a href="/<?php echo base_url();?>Marketing-User-todayAppointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="market_add_packagesdata"  method="post" enctype="multipart/form-data" >
                    <div>

                      <h3>Company  Details</h3>
                      <section>
                        <h3>Company  Details</h3>
                        <div class="row clearfixed">

                          <input type="hidden" id="market_edit_business_id" name="market_edit_business_id">
                          <input type="hidden" id="market_edit_business_addid" name="market_edit_business_addid">

                        <div class="col-6 form-group">
                          <label>Company Name</label>
                          <input type="text" class="form-control " aria-describedby="emailHelp" placeholder="Company Name" name="market_edit_business_cname" id="market_edit_business_cname">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Person Name</label>
                          <input type="text" class="form-control " placeholder="Person Name" name="market_edit_business_pname" id="market_edit_business_pname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="market_edit_business_designation" id="market_edit_business_designation">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="market_edit_business_mobileno" id="market_edit_business_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control " placeholder="Email" name="market_edit_business_email" id="market_edit_business_email">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="market_edit_business_hno" id="market_edit_business_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street/Road</label>
                          <input type="text" class="form-control " placeholder="Street Name" name="market_edit_business_street" id="market_edit_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Sub Area</label>
                          <input type="text" class="form-control " placeholder="Sub Area" name="market_edit_business_subarea" id="market_edit_business_subarea">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control " placeholder="Area" name="market_edit_business_area" id="market_edit_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="market_edit_business_landmark" id="market_edit_business_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" placeholder="PINCODE" name="market_edit_business_pincode" id="market_edit_business_pincode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City</label>
                           <select class="form-control" name="market_edit_business_city" id="market_edit_business_city" onchange="getState(this);">
                          </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>State</label>
                          <select class="form-control" name="market_edit_business_state" id="market_edit_business_state">
                          </select>
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>GST Number </label>
                          <input type="text" class="form-control" placeholder="GST Number" name="market_edit_business_gstno" id="market_edit_business_gstno">
                        </div>
                      
                      </section>
                 
                      <h3>Demo WebSite</h3>
                      <section>
                        <h3>Demo WebSite</h3>
                      <div class="row clearfixed">
                         <div class="col-sm-2 col-12"></div>
                         <div class="col-sm-8 col-12">
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

                       <h3>Domain Details</h3>
                      <section>
                        <h3> Domain Details</h3>
                       <div class="row clearfixed">
                       <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Amount (With Out GST) <input  type="checkbox" value="1" name="market_add_packages_domainamount_checked" id="market_add_packages_domainamount_checked"> </label>
                          <input type="text" class="form-control" placeholder="Domain Amount" name="market_add_packages_domainamount" id="market_add_packages_domainamount" value="800" readonly="">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 1 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_add_packages_domainnames_option1" id="market_add_packages_domainnames_option1">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 2 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_add_packages_domainnames_option2" id="market_add_packages_domainnames_option2">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 3 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_add_packages_domainnames_option3" id="market_add_packages_domainnames_option3">
                        </div>

                             <div class="col-sm-6 col-12 form-group">
                               <label onclick="marketpackageuppersaleFunction()" style="background-color:#1D2B6D; padding: 10px; border-radius: 50%; color: #ffffff;">
                                <i class="mdi mdi-arrow-up-bold"></i> </label> <label>  <input  class="form-control" type="text"  name="market_add_packages_uppersale_amount" id="market_add_packages_uppersale_amount" placeholder="Upper Sale Amount" disabled>  </label>
                                  <script type="text/javascript">
                                       function marketpackageuppersaleFunction(){
                                          document.getElementById("market_add_packages_uppersale_amount").disabled = false;
                                          }
                                  </script>
                                  
                                   <input  type="hidden"  class="form-control"  name="market_add_packages_totaluppersale_amount" id="market_add_packages_totaluppersale_amount" placeholder="Total Upper Sale Amount" >
                               </div>

                      </div>
                      </section>

                        <h3>Package Selection</h3>
                      <section>
                        <h3>Package Selection</h3>
                         <input type="hidden" id="market_add_packages_companyname" name="market_add_packages_companyname">
                             <input type="hidden" id="market_add_packages_companyname_state_id" name="market_add_packages_companyname_state_id">

                             <div class="row pricing-table" id="addpackagelist"></div>

                         <div class="col-sm-12 col-12" style="background-color: #66cc66; padding:10px;" > 
                                <input class="" type="checkbox" value="1" name="market_add_packages_tds" id="market_add_packages_tds">
                             <p>Pls Check TDS Applicable.</p> </div>
                      </section>

                       <h3>Selected Details</h3>
                      <section>
                        <h3>Selected Detail</h3>

                       <div class="row clearfixed" id="market_campaignlist1">
                       </div>

                       <div class="row clearfixed" id="market_packagelist1">
                       </div>

                       <div class="row clearfixed" id="market_totalamount1">
                       </div>
                       
                       <form id="market_apply_promocode" method="post"> 
                          <div class="row clearfixed">
                          <div class="col-sm-6 col-12">
                          <label>Promocode</label>
                          <input type="hidden" class="form-control" name="market_add_packages_total" id="market_add_packages_total">
                          <input type="hidden" class="form-control" name="market_add_packages_id" id="market_add_packages_id"> 

                          <input type="text" class="form-control" placeholder="Promocode Enter" name="market_add_packages_promocode" id="market_add_packages_promocode">
                        </div>

                         <div class="col-sm-4 col-12 mt-2">
                           <label></label>
                          <button type="button" class="btn btn-primary form-control" name="market_applypromocode" id="market_applypromocode">Apply Promocode</button>
                          </div>
                             
                          </div>
                          <div id="market_promcodeamount-msg"></div>
                       </form>
                       
                       <div class="row clearfixed" >
                          <div class="col-sm-12 col-12" id="market_discount">
                           
                           </div>
                        </div>

                        <div class="row clearfixed" >
                           <div class="col-sm-12 col-12" id="market_grandtotalamount">
                           </div>
                         <input type="hidden" class="form-control" name="market_add_packages_discountamount" id="market_add_packages_discountamount">
                         <input type="hidden" class="form-control" name="market_add_packages_grandtotal" id="market_add_packages_grandtotal">
                         <input type="hidden" class="form-control" name="market_add_packages_promocode_id" id="market_add_packages_promocode_id">
                        <input type="hidden" class="form-control" name="market_add_packages_totalpackageamount" id="market_add_packages_totalpackageamount">
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
                            <label>Cash Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="market_add_packages_cashamount" id="market_add_packages_cashamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="market_add_packages_cashdate" id="market_add_packages_cashdate">
                          </div>
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Person Name</label>
                            <input type="text" class="form-control" placeholder="Person Name" name="market_add_packages_personame" id="market_add_packages_personame">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Place/City Name</label>
                            <input type="text" class="form-control" placeholder="Place/City Name" name="market_add_packages_placename" id="market_add_packages_placename">
                          </div>
                         </div> 
                      </div>

                      <div class="tab-content tab-content-vertical" id="paymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Number</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="market_add_packages_neftnumber" id="market_add_packages_neftnumber">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Amount</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="market_add_packages_neftamount" id="market_add_packages_neftamount">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Amount</label>
                            <input type="file" class="form-control"  name="market_add_packages_neftphoto" id="market_add_packages_neftphoto">
                          </div>

                         </div> 
                      </div>

                      <div class="tab-content tab-content-vertical" id="paymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">

                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Name</label>
                            <input type="text" class="form-control" placeholder="UPI Name" name="market_add_packages_upiname" id="market_add_packages_upiname">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Id</label>
                            <input type="text" class="form-control" placeholder="UPI Id" name="market_add_packages_upiid" id="market_add_packages_upiid">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>UPI Phone Number</label>
                            <input type="text" class="form-control" placeholder="UPI Phone Number" name="market_add_packages_upiphonenumber" id="market_add_packages_upiphonenumber">
                          </div>

                           <div class="col-sm-6 col-12 form-group">
                            <label>UPI Transction Photo</label>
                            <input type="file" class="form-control" placeholder="UPI Transction Photo" name="market_add_packages_upiphoto" id="market_add_packages_upiphoto">
                          </div>

                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="market_add_packages_upiamount" id="market_add_packages_upiamount">
                          </div>

                          
                         </div>
                      </div>

                      <div class="tab-content tab-content-vertical" id="paymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="market_add_packages_chequeno" id="market_add_packages_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Confirm Cheque Number" name="market_add_packages_cchequeno" id="market_add_packages_cchequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="market_add_packages_chequeamount" id="market_add_packages_chequeamount">
                          </div>
                         
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="market_add_packages_chequeissuedate" id="market_add_packages_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control " placeholder="Bank Name" name="market_add_packages_cheque_bankname" id="market_add_packages_cheque_bankname">
                          </div>
                         
                           <div class="col-sm-6 col-12 form-group">
                            <label> Cheque Photo</label>
                           <input type="file" class="form-control" name="market_add_packages_cheque_photo" id="market_add_packages_cheque_photo">
                          </div>
                         </div> 
                      </div>
                      
                     </div>
                    

                </div>
                </section>
                    
                       <h3>Final</h3>
                      <section > 
                      	<h3>Business Status </h3>

                      <input type="hidden" class="form-control" name="razorpay_select_payment_order_id" id="razorpay_select_payment_order_id" value="<?php echo $merchant_order_id; ?>">    
                       <input type="hidden" class="form-control" name="marketing_add_package_otp" id="marketing_add_package_otp">
                     <!--  <div style="text-align: center;">
                      <button class="btn btn-info btn-md" type="button" id="marketing_packages_generated_opt" >Generate OTP</button>
                        </div> -->

                       <div class="col-12 col-md-12">
                        <div class="row clearfixed">

                        <div class="col-sm-6 col-12 form-group">
                          <label>Product Type </label>
                           <select class="form-control"  name="market_add_packages_producttype" id="market_add_packages_producttype" >
                           </select>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                           <select class="form-control"  name="market_add_packages_status" id="market_add_packages_status" >
                           </select>
                        </div>


                        <div class="col-sm-6 col-12 form-group">
                        	<input type="hidden" name="market_add_packages_assignment_id" id="market_add_packages_assignment_id">
                          <label> Appointment  Message </label>
                          <textarea class="form-control" cols="2" rows="5" name="market_add_packages_status_msg" id="market_add_packages_status_msg">
                          </textarea>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                            <label>Next Follow Up Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="market_add_packages_next_followup_date" id="market_add_packages_next_followup_date">
                          </div>
                          </div>

                         
                       

                      </div>
                      </div>

                               <div class="form-check">
                                  <h4><label class="form-check-label">
                                  <input class="checkbox" type="checkbox" name="market_add_package_condition" id="market_add_package_condition">
                                    I Agree With The Terms and Conditions.
                                  </label></h4>
                                  <div id="market_packagesdata-addmsg"></div>
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

<div class="modal  fade" id="AssignmentMessageModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content card-body">  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Assignment Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <!-- Modal body -->
        <div class="modal-body">
         <div id="assignment-addmsg"></div>
                    <div class="body">
                        <form id="get_assignment" method="post" >
                            <div class="row clearfix">
                                <input type="hidden" name="get_assignment_message_id" id="get_assignment_message_id">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        
                                        <div id="get_message" name="get_message"></div>
                                       </div>
                                </div> 
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
             
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>

   
         
<?php
include('Layouts/marketLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/MarketingTodayAppointmentsController.js"></script>


<script>
  $('#market_add_packages_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
  $('#market_add_packages_cashdate').datepicker({
     todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
}); 

  $('#add_paymentpending_cashdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
});


  $('#add_paymentpending_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
  
$('#market_add_packages_next_followup_date').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});

</script>


<script>

   function showPaymentmode(test){
    var test = test.value;
    if(test==1)
      { 
       var grand_total=((document.getElementById('market_add_packages_grandtotal').value)>0)? document.getElementById('market_add_packages_grandtotal').value:document.getElementById('market_add_packages_total').value;
        document.getElementById("market_add_packages_cashamount").value = grand_total;
        document.getElementById("market_add_packages_upiamount").value = '';
        document.getElementById("market_add_packages_chequeamount").value ='';
        document.getElementById("market_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").show();
        $("#paymentmode_upi").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#market_add_packages_neftnumber").val('');
      $("#market_add_packages_neftphoto").val('');
      
      $("#market_add_packages_upiname").val('');
      $("#market_add_packages_upiid").val('');
      $("#market_add_packages_upiphonenumber").val('');
      $("#market_add_packages_upiphoto").val('');
      
      $("#market_add_packages_chequeno").val('');
      $("#market_add_packages_cchequeno").val('');
      $("#market_add_packages_chequeissuedate").val('');
      $("#market_add_packages_cheque_bankname").val('');
      $("#market_add_packages_cheque_photo").val(''); 

      }else if(test==4){

        var grand_total=((document.getElementById('market_add_packages_grandtotal').value)>0)? document.getElementById('market_add_packages_grandtotal').value:document.getElementById('market_add_packages_total').value;
        document.getElementById("market_add_packages_cashamount").value = '';
         document.getElementById("market_add_packages_upiamount").value = grand_total;
        document.getElementById("market_add_packages_chequeamount").value ='';
        document.getElementById("market_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").show();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#market_add_packages_cashdate").val('');
      $("#market_add_packages_personame").val('');
      $("#market_add_packages_placename").val('');

      $("#market_add_packages_neftnumber").val('');
      $("#add_packages_neftphoto").val('');

      $("#market_add_packages_chequeno").val('');
      $("#market_add_packages_cchequeno").val('');
      $("#market_add_packages_chequeissuedate").val('');
      $("#market_add_packages_cheque_bankname").val('');
      $("#market_add_packages_cheque_photo").val(''); 


      }else if(test==6){

  var grand_total=((document.getElementById('market_add_packages_grandtotal').value)>0)? document.getElementById('market_add_packages_grandtotal').value:document.getElementById('market_add_packages_total').value;
        document.getElementById("market_add_packages_cashamount").value = '';
         document.getElementById("market_add_packages_upiamount").value = '';
        document.getElementById("market_add_packages_chequeamount").value =grand_total;
        document.getElementById("market_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_cheque").show();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

      $("#market_add_packages_cashdate").val('');
      $("#market_add_packages_personame").val('');
      $("#market_add_packages_placename").val('');

      $("#market_add_packages_neftnumber").val('');
      $("#market_add_packages_neftphoto").val('');

      
      $("#market_add_packages_upiname").val('');
      $("#market_add_packages_upiid").val('');
      $("#market_add_packages_upiphonenumber").val('');
      $("#market_add_packages_upiphoto").val('');

        
      }else if(test==7)
      {   
         var grand_total=((document.getElementById('market_add_packages_grandtotal').value)>0)? document.getElementById('market_add_packages_grandtotal').value:document.getElementById('market_add_packages_total').value;
        document.getElementById("market_add_packages_cashamount").value = '';
        document.getElementById("market_add_packages_upiamount").value = '';
        document.getElementById("market_add_packages_chequeamount").value ='';
        document.getElementById("market_add_packages_neftamount").value =grand_total;
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").show();
        $("#razorPayModal").hide(); 

     $("#market_add_packages_cashdate").val('');
      $("#market_add_packages_personame").val('');
      $("#market_add_packages_placename").val('');

      $("#market_add_packages_upiname").val('');
      $("#market_add_packages_upiid").val('');
      $("#market_add_packages_upiphonenumber").val('');
      $("#market_add_packages_upiphoto").val('');
      
      $("#market_add_packages_chequeno").val('');
      $("#market_add_packages_cchequeno").val('');
      $("#market_add_packages_chequeissuedate").val('');
      $("#market_add_packages_cheque_bankname").val('');
      $("#market_add_packages_cheque_photo").val(''); 


      }

 if(test==8){

      $("#market_add_packages_cashdate").val('');
      $("#market_add_packages_personame").val('');
      $("#market_add_packages_placename").val('');

      $("#market_add_packages_neftnumber").val('');
      $("#market_add_packages_neftphoto").val('');
      
      $("#market_add_packages_upiname").val('');
      $("#market_add_packages_upiid").val('');
      $("#market_add_packages_upiphonenumber").val('');
      $("#market_add_packages_upiphoto").val('');
      
      $("#market_add_packages_chequeno").val('');
      $("#market_add_packages_cchequeno").val('');
      $("#market_add_packages_chequeissuedate").val('');
      $("#market_add_packages_cheque_bankname").val('');
      $("#market_add_packages_cheque_photo").val(''); 



    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('market_add_packages_grandtotal').value)>0)? document.getElementById('market_add_packages_grandtotal').value:document.getElementById('market_add_packages_total').value;
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  
  var razorpay_submit_btn, razorpay_instance;
  function razorpaySubmit(el){

var email=document.getElementById('market_edit_business_email').value;
var mobileno=document.getElementById('market_edit_business_mobileno').value;
var card_holder_name=document.getElementById('market_edit_business_pname').value;
var razorpay_order_id=document.getElementById('razorpay_order_id').value;
// alert(razorpay_order_id);
// alert(email);
// alert(mobileno);
// alert(card_holder_name);
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
  prefill:{
  },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    "handler": function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = transaction.razorpay_signature;
        
        document.getElementById('razorpay-form').submit();

       // document.getElementById("razorpay_payment_order_id").value=transaction.razorpay_payment_id ;
       // document.getElementById("razorpay_payment_transaction_amount").value=merchant_total1;
    },
    "modal": {
        "ondismiss": function(){
          $('#razorPayModal').modal('hide');
            console.log("This code runs when the popup is closed");
           // location.reload()
        }
    }
  };
razorpay_options.order_id=razorpay_order_id;
razorpay_options.amount=merchant_total;
razorpay_options.name=card_holder_name;
razorpay_options.prefill.name=card_holder_name;
razorpay_options.prefill.email=email;
razorpay_options.prefill.contact=mobileno;
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }   
  //end of payment gateway razorpay 
</script>





  <div class="modal" id="marketing_package_otpverficationmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">OTP Verfication </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form id="marketing_package_otp_verification" method="post">
          <div class="form-row">
            <label>OTP is sent to Your Mobile Number</label>    
          </div>
        <div class="form-row">
          <input type="text" class="form-control" name="marketing_package_mobileOtp"  id="marketing_package_mobileOtp" class="form-input" placeholder="Enter the OTP">  </div>
        <div class="row" style="text-align: center;margin-top:20px;">
          <button type="button" id="marketingpackageotpverification"  class="btn btn-primary" >Submit</button>
        </div>
     </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>