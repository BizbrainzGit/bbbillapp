<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/market-leadLayout_Header.php');
?>
<div class="main-panel">
<div class="modal fade" id="market_lead_EditstatusModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row clearfix" id="marketlead_appointment_statuschecked"></div>
                    <div class="body" id="marketlead_appointment_statusmodel" style="display: none">
                      <div id="citymapping-editmsg"></div>
                        <form id="market_lead_change_status_form" method="post" >
                          <input type="hidden" id="market_lead_change_status_id" name="market_lead_change_status_id"> 
                          <input type="hidden" id="market_lead_change_assignment_id" name="market_lead_change_assignment_id"> 

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                       <label>Message <span style="color: red">*</span> :</label>
                                         <input  class='form-control' type="text" id="market_lead_change_assignment_message" name="market_lead_change_assignment_message"> 
                                    </div>
                                </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status<span style="color: red">*</span>:</label>
                                          <select class='form-control' name="market_lead_change_status" id="market_lead_change_status">
                                            <option id="">Select Status</option>
                                          </select>
                                    </div>
                                </div>
                                 <div class="col-sm-12" style="text-align: center;">
                                    <button type="button" id="market_lead_updatestatus" class="btn btn-primary">Update</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
            </form>
                    </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
     
        </div>
      </div>
    </div>
  </div>



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



<div class="content-wrapper  market_lead_todayAppointmentList_class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Today's Appointment List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header"></div>
                    </div>
                     <div class="col-12"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="todayallapptable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



      <div class="content-wrapper market_lead_addpackages-class" style="display: none;">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Details
                 <a href="/<?php echo base_url();?>Market-Lead-User-todayAppointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="market_lead_add_packagesdata"  method="post" enctype="multipart/form-data" >
                    <div>
                         
                     <!-- <h3 class="text-uppercase">Business KeyWords</h3>
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
                               </div> 
                       </div>
                       <div class="col-sm-2 col-12">  
                        <div style="text-align: right;"><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#AddNewBusinesskeywordsModal"><i class="fa fa-plus" aria-hidden="true"></i>Add Business Keywords </button></div>
                      </div>
                      </div>
                         <div class="form-group" id="search_packages_keywords-msg"></div>
                         <div class="row clearfixed" id="addkeywordspackages" >
                        </div>
                      </section> --> 


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
                         <div class="row clearfixed" id="demowebsitespackages" ></div>
                         
                       
                      </section> 


                        <h3>Domain && GST Details</h3>
                      <section>
                        <h3> Domain && GST Details</h3>
                       <div class="row clearfixed">
                       <div class="col-sm-12 col-12 text-center mb-4"><button class="btn btn-success btn-lg btn-block"><a target="_blank" href="http://web.bizbrainz.in/" style="color: #ffffff;">Buy Domain Name Click Here </a></button> </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Amount (With Out GST) <input  type="checkbox" value="1" name="market_lead_add_packages_domainamount_checked" id="market_lead_add_packages_domainamount_checked"> </label>
                          <input type="text" class="form-control" placeholder="Domain Amount" name="market_lead_add_packages_domainamount" id="market_lead_add_packages_domainamount" value="800" readonly="">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 1 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_lead_add_packages_domainnames_option1" id="market_lead_add_packages_domainnames_option1">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 2 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_lead_add_packages_domainnames_option2" id="market_lead_add_packages_domainnames_option2">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Domain Name Option 3 </label>
                          <input type="text" class="form-control" placeholder="Domain Name Avaiable" name="market_lead_add_packages_domainnames_option3" id="market_lead_add_packages_domainnames_option3">
                        </div>
                             <div class="col-sm-6 col-12 form-group">
                               <label onclick="packageuppersaleFunction()" style="background-color:#1D2B6D; padding: 10px; border-radius: 50%; color: #ffffff;">
                                <i class="mdi mdi-arrow-up-bold"></i> </label> <label>  <input  class="form-control" type="text"  name="market_lead_add_packages_uppersale_amount" id="market_lead_add_packages_uppersale_amount" placeholder="Upper Sale Amount" disabled>  </label>
                                  <script type="text/javascript">
                                       function packageuppersaleFunction(){
                                          document.getElementById("market_lead_add_packages_uppersale_amount").disabled = false;
                                          }
                                  </script>
                                  
                                   <input  type="hidden"  class="form-control"  name="market_lead_add_packages_totaluppersale_amount" id="market_lead_add_packages_totaluppersale_amount" placeholder="Total Upper Sale Amount" >
                               </div>

                      </div>
                      </section>


                    <!--    <h3>Campaign Selection</h3>
                      <section>
                       <h3>Company Name : <span id="market_lead_cname"> </span></h3>

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
                          <input type="hidden" id="market_lead_add_packages_companyname" name="market_lead_add_packages_companyname">
                             <input type="hidden" id="market_lead_add_packages_companyname_state_id" name="market_lead_add_packages_companyname_state_id">
                             <div class="row pricing-table" id="addpackagelist"></div>
                             <div class="col-sm-12 col-12" style="background-color: #66cc66; padding:10px;" > 
                                <input class="" type="checkbox" value="1" name="market_lead_add_packages_tds" id="market_lead_add_packages_tds">
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
                          <input type="hidden" class="form-control" name="market_lead_add_packages_total" id="market_lead_add_packages_total">
                          <input type="hidden" class="form-control" name="market_lead_add_packages_id" id="market_lead_add_packages_id"> 

                          <input type="text" class="form-control" placeholder="Promocode Enter" name="market_lead_add_packages_promocode" id="market_lead_add_packages_promocode">
                        </div>

                         <div class="col-sm-4 col-12 mt-2">
                           <label></label>
                          <button type="button" class="btn btn-primary form-control" name="todaymarketingleadapplypromocode" id="todaymarketingleadapplypromocode">Apply Promocode</button>
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

                         <input type="hidden" class="form-control" name="market_lead_add_packages_discountamount" id="market_lead_add_packages_discountamount">
                         <input type="hidden" class="form-control" name="market_lead_add_packages_grandtotal" id="market_lead_add_packages_grandtotal">
                         <input type="hidden" class="form-control" name="market_lead_add_packages_promocode_id" id="market_lead_add_packages_promocode_id">
                        <input type="hidden" class="form-control" name="market_lead_add_packages_totalpackageamount" id="market_lead_add_packages_totalpackageamount">

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
                            <input type="text" class="form-control" placeholder="Amount" name="market_lead_add_packages_cashamount" id="market_lead_add_packages_cashamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="market_lead_add_packages_cashdate" id="market_lead_add_packages_cashdate">
                          </div>
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Person Name</label>
                            <input type="text" class="form-control" placeholder="Person Name" name="market_lead_add_packages_personame" id="market_lead_add_packages_personame">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Place/City Name</label>
                            <input type="text" class="form-control" placeholder="Place/City Name" name="market_lead_add_packages_placename" id="market_lead_add_packages_placename">
                          </div>
                         </div> 
                      </div>
                        <div class="tab-content tab-content-vertical" id="paymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Number</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="market_lead_add_packages_neftnumber" id="market_lead_add_packages_neftnumber">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Amount</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="market_lead_add_packages_neftamount" id="market_lead_add_packages_neftamount">
                          </div>
                         </div> 
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Number</label>
                            <input type="text" class="form-control" placeholder="UPI Number" name="market_lead_add_packages_upi" id="market_lead_add_packages_upi">
                          </div>
                            <div class="col-sm-6 col-12 form-group">
                            <label>Phone Pay</label>
                            <input type="text" class="form-control" placeholder="Phone Pay Number" name="market_lead_add_packages_phonepay" id="market_lead_add_packages_phonepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amazon Pay</label>
                            <input type="text" class="form-control" placeholder="Amazon Pay Number" name="market_lead_add_packages_amazonpay" id="market_lead_add_packages_amazonpay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Google Pay</label>
                            <input type="text" class="form-control" placeholder="GooglePay Number" name="market_lead_add_packages_googlepay" id="market_lead_add_packages_googlepay">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="market_lead_add_packages_upiamount" id="market_lead_add_packages_upiamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_paytm" style="display: none">
                         <h5> PayTm Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm UPI Number</label>
                            <input type="text" class="form-control" placeholder="PayTm UPI Number" name="market_lead_add_packages_paytm_upi" id="market_lead_add_packages_paytm_upi">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm Amount</label>
                            <input type="text" class="form-control" placeholder="PayTm Amount" name="market_lead_add_packages_paytmamount" id="market_lead_add_packages_paytmamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="market_lead_add_packages_chequeno" id="market_lead_add_packages_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Confirm Cheque Number" name="market_lead_add_packages_cchequeno" id="market_lead_add_packages_cchequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="market_lead_add_packages_chequeamount" id="market_lead_add_packages_chequeamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" name="market_lead_add_packages_chequeaccountno" id="market_lead_add_packages_chequeaccountno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Holder Name</label>
                            <input type="text" class="form-control" placeholder="Cheque Holder Name" name="market_lead_add_packages_chequeholdername" id="market_lead_add_packages_chequeholdername">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="market_lead_add_packages_chequeissuedate" id="market_lead_add_packages_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control " placeholder="Bank Name" name="market_lead_add_packages_cheque_bankname" id="market_lead_add_packages_cheque_bankname">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>IFSC Code</label>
                            <input type="text" class="form-control text-uppercase" placeholder="IFSC Code" name="market_lead_add_packages_cheque_ifsc" id="market_lead_add_packages_cheque_ifsc">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>MICR Code</label>
                            <input type="text" class="form-control" placeholder="MICR Code" name="market_lead_add_packages_cheque_micr" id="market_lead_add_packages_cheque_micr">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Photo</label>
                           <input type="file" class="form-control" name="market_lead_add_packages_cheque_photo" id="market_lead_add_packages_cheque_photo">
                          </div>
                         </div> 
                      </div>
                     </div>
                      <h3>Business Status </h3>
                       <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                            <select class="form-control"  name="market_lead_add_packages_status" id="market_lead_add_packages_status" >
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
                          <input type="password" class="form-control" placeholder="Account Number"  name="market_lead_add_packages_accountno" id="market_lead_add_packages_accountno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Account Number</label>
                          <input type="text" class="form-control" placeholder="Account Number" name="market_lead_add_packages_caccountno" id="market_lead_add_packages_caccountno">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Account Holder Name </label>
                          <input type="password" class="form-control" placeholder="Account Holder Name "  name="market_lead_add_packages_acholdername" id="market_lead_add_packages_acholdername">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm Holder Name</label>
                          <input type="text" class="form-control" placeholder="Account Holder Name " name="market_lead_add_packages_cacholdername" id="market_lead_add_packages_cacholdername">
                        </div>


                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank Name </label>
                          <input type="text" class="form-control " placeholder="Bank Name" name="market_lead_add_packages_bankname" id="market_lead_add_packages_bankname">
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank IFSC Code</label>
                          <input type="text" class="form-control text-uppercase" placeholder="Bank IFSC Code" name="market_lead_add_packages_ifsccode" id="market_lead_add_packages_ifsccode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>Bank City </label>
                          <input type="text" class="form-control" placeholder="Bank City" name="market_lead_add_packages_bankcity" id="market_lead_add_packages_bankcity">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Branch Name </label>
                          <input type="text" class="form-control" placeholder="Branch Name" name="market_lead_add_packages_branchname" id="market_lead_add_packages_branchname">
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                          <label>Select Account Type </label>
                            <select class="form-control"  name="market_lead_add_packages_acctype" id="market_lead_add_packages_acctype" >
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

                      <input type="hidden" class="form-control" placeholder="Email" name="add_business_email" id="add_business_email">
                      <input type="hidden" class="form-control" placeholder="Email" name="add_business_mobileno" id="add_business_mobileno">
                      <input type="hidden" class="form-control" placeholder="Email" name="add_business_pname" id="add_business_pname"> 

                      <input type="hidden" class="form-control" name="marketinglead_add_package_otp" id="marketinglead_add_package_otp">
                      
                      <div style="text-align: center;">
                     <!--  <button class="btn btn-info btn-md" type="button" id="marketinglead_packages_generated_opt" >Generate OTP</button>
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
  

        <div class="content-wrapper market_lead_editbusiness-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit <span id="market_lead_edit_businessname_head"></span>
                 <a href="/<?php echo base_url();?>Market-Lead-User-todayAppointments"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>

                  <form id="market_lead_edit_businessdata"  method="post" enctype="multipart/form-data" >
                    <div>
                      <h3>Company  Details</h3>
                      <section>
                        <h3>Company  Details</h3>
                        <div class="row clearfixed">
                          <input type="hidden" id="market_lead_edit_business_id" name="market_lead_edit_business_id">
                          <input type="hidden" id="market_lead_edit_business_addid" name="market_lead_edit_business_addid">
                        <div class="col-12 form-group">
                          <label>Company Name</label>
                          <input type="text" class="form-control " aria-describedby="emailHelp" placeholder="Company Name" name="market_lead_edit_business_cname" id="market_lead_edit_business_cname">
                         <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Building No/House No</label>
                          <input type="text" class="form-control " placeholder="Building No/House No" name="market_lead_edit_business_hno" id="market_lead_edit_business_hno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Street/Road</label>
                          <input type="text" class="form-control " placeholder="Street Name" name="market_lead_edit_business_street" id="market_lead_edit_business_street">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Sub Area</label>
                          <input type="text" class="form-control " placeholder="Sub Area" name="market_lead_edit_business_subarea" id="market_lead_edit_business_subarea">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Area</label>
                          <input type="text" class="form-control " placeholder="Area" name="market_lead_edit_business_area" id="market_lead_edit_business_area">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Landmark</label>
                          <input type="text" class="form-control " placeholder="Landmark" name="market_lead_edit_business_landmark" id="market_lead_edit_business_landmark">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Pincode</label>
                          <input type="text" class="form-control" placeholder="PINCODE" name="market_lead_edit_business_pincode" id="market_lead_edit_business_pincode">
                        </div>
                        
                        <div class="col-sm-6 col-12 form-group">
                          <label>City</label>
                           <select class="form-control" name="market_lead_edit_business_city" id="market_lead_edit_business_city" onchange="getState(this);">
                            
                          </select>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>State</label>
                          <select class="form-control" name="market_lead_edit_business_state" id="market_lead_edit_business_state">
                            
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
                          <input type="text" class="form-control " placeholder="Person Name" name="market_lead_edit_business_pname" id="market_lead_edit_business_pname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="market_lead_edit_business_designation" id="market_lead_edit_business_designation">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="market_lead_edit_business_mobileno" id="market_lead_edit_business_mobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Alternative Mobile Number</label>
                          <input type="text" class="form-control" placeholder="ALTERNATIVE MOBILE NUMBER" name="market_lead_edit_business_altnemobileno" id="market_lead_edit_business_altnemobileno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Landline Number/Company Number</label>
                          <input type="text" class="form-control" placeholder="LANDLINE NUMBER/COMPANY NUMBER" name="market_lead_edit_business_landlineno" id="market_lead_edit_business_landlineno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Email </label>
                          <input type="email" class="form-control " placeholder="Email" name="market_lead_edit_business_email" id="market_lead_edit_business_email">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                         <div id="businessimage"></div>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Photo</label>
                          <input type="file" class="form-control" name="market_lead_edit_business_photo" id="market_lead_edit_business_photo">
                        </div>
                         <div class="col-sm-6 col-12 form-group">
                        </div>
                         
                       <!--   <div class="row clearfixed"> -->
                        <div class="col-sm-12 col-12 "><h5> Owner Details : </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control " placeholder="Owner Name" name="market_lead_edit_business_owner1name" id="market_lead_edit_business_owner1name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="market_lead_edit_business_owner1role" id="market_lead_edit_business_owner1role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="market_lead_edit_business_owner1mobile" id="market_lead_edit_business_owner1mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control " placeholder="Email" name="market_lead_edit_business_owner1email" id="market_lead_edit_business_owner1email">
                        </div>

                         <div class="col-sm-12 col-12 "><h5> Another Owner Details : </h5></div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Owner Name</label>
                          <input type="text" class="form-control " placeholder="Owner Name" name="market_lead_edit_business_owner2name" id="market_lead_edit_business_owner2name">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Designation</label>
                          <input type="text" class="form-control " placeholder="Designation"  name="market_lead_edit_business_owner2role" id="market_lead_edit_business_owner2role">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" placeholder="MOBILE NUMBER" name="market_lead_edit_business_owner2mobile" id="market_lead_edit_business_owner2mobile">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Email</label>
                          <input type="text" class="form-control " placeholder="Email" name="market_lead_edit_business_owner2email" id="market_lead_edit_business_owner2email">
                        </div>
                   <!--    </div> -->


                        <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-web text-web icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Website URL" name="market_lead_edit_business_website" id="market_lead_edit_business_website">
                            </div>

                         </div>

                         <div class="col-sm-6 col-12 form-group">
                           <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-facebook text-facebook icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Facebook URL" name="market_lead_edit_business_facebook" id="market_lead_edit_business_facebook">
                            </div>
                         </div>

                         <div class="col-sm-6 col-12 form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-twitter text-twitter icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Twitter URL" name="market_lead_edit_business_twitter" id="market_lead_edit_business_twitter">
                            </div>
                         </div>
                         <div class="col-sm-6 col-12 form-group">
                           <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-youtube text-youtube icon-md"></i></span>
                              </div>
                              <input type="text" class="form-control"  placeholder="Youtube URL" name="market_lead_edit_business_youtube" id="market_lead_edit_business_youtube">
                            </div>

                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-linkedin text-linkedin icon-md"></i></span>
                              </div>
                             <input type="text" class="form-control"  placeholder="Linkedin URL" name="market_lead_edit_business_linkedin" id="market_lead_edit_business_linkedin">
                            </div>

                         </div>
                         <div class="col-sm-6 col-12 form-group">
                             <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-instagram text-instagram icon-md"></i></span>
                              </div>
                            <input type="text" class="form-control" placeholder="Instagram URL" name="market_lead_edit_business_instagram" id="market_lead_edit_business_instagram">
                            </div>

                         </div>
                      </div>
                      </section>

                      <h3>Map Location</h3>
                      <section>
                        <h3>Map Location</h3>
                        <div class="form-group">
                          <label>Seclect Company Location in Map </label>

                          <div ><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15231.277659457965!2d78.53201005!3d17.372420499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1559383383757!5m2!1sen!2sin"  height="450" frameborder="0" style="border:0; width: 100%" allowfullscreen></iframe></div>
                        </div>
                      </section>

                     
                      
                         <h3>GST Details</h3>
                      <section>
                        <h3> GST Details </h3>
                     <div class="row clearfixed">
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Company Name</label>
                          <input type="text" class="form-control " placeholder="Company Name" name="market_lead_edit_business_gstcname" id="market_lead_edit_business_gstcname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Company Name</label>
                          <input type="text" class="form-control " placeholder="Confirm GST Company Name" name="market_lead_edit_business_cgstcname" id="market_lead_edit_business_cgstcname">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Number </label>
                          <input type="password" class="form-control text-uppercase" placeholder="GST Number" name="market_lead_edit_business_gstno" id="market_lead_edit_business_gstno">
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Confirm GST Number</label>
                          <input type="text" class="form-control text-uppercase"  placeholder="GST Number" name="market_lead_edit_business_cgstno" id="market_lead_edit_business_cgstno">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>GST State</label>
                          <select class="form-control" name="market_lead_edit_business_gststate" id="market_lead_edit_business_gststate" ></select>
                          <!-- <input type="text" class="form-control" maxlength="10" placeholder="Write here"> -->
                        </div>

                       
                        <div class="col-sm-6 col-12 form-group">
                          <label>GST Pincode</label>
                          <input type="text" class="form-control" minlength="6" maxlength="6" placeholder="Pincode" name="market_lead_edit_business_gstpincode" id="market_lead_edit_business_gstpincode">
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                          <label>Company PAN Number</label>
                          <input type="text" class="form-control text-uppercase " placeholder="Company PAN Number" name="market_lead_edit_business_gstpanno" id="market_lead_edit_business_gstpanno">
                        </div>
                         <div class="col-sm-12 col-12 form-group">
                          <label>GST Address</label>
                          <input type="text" class="form-control " placeholder="Address" name="market_lead_edit_business_gstaddress" id="market_lead_edit_business_gstaddress">
                        </div>
                      </div>
                      </section>
                       <h3>Final</h3>
                      <section >                        
                       
                               <div class="form-check">
                                  <h4><label class="form-check-label">
                                    <input class="checkbox" type="checkbox" name="market_lead_edit_business_condition" id="market_lead_edit_business_condition">
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
include('Layouts/market-leadLayout_Footer.php');
?>

 <script src="/<?php echo base_url();?>assets/js/Common/MarketleadTodayAllAppointmentsController.js"></script>

<script type="text/javascript">
  
  $("#market_lead_add_packages_debitcard_expireddate").datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'mm-yyyy'
});
  $('#market_lead_add_packages_creditcard_expireddate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'mm-yyyy'
});
  $('#market_lead_add_packages_chequeissuedate').datepicker({
      todayHighlight: true,
      autoclose: true,
      startDate: '0d',
      format: 'dd-mm-yyyy'
});
  $('#market_lead_add_packages_cashdate').datepicker({
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


 function showPaymentmode(test){
    var test = test.value;
      var tdsvalue = $('#market_lead_add_packages_tds:checked').val();
    if(test==1)
      { 
       var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
        document.getElementById("market_lead_add_packages_cashamount").value = grand_total;
         document.getElementById("market_lead_add_packages_upiamount").value = '';
        document.getElementById("market_lead_add_packages_paytmamount").value = '';
        document.getElementById("market_lead_add_packages_chequeamount").value ='';
        document.getElementById("market_lead_add_packages_neftamount").value ='';
        $("#paymentmode_cash").show();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

$("#market_lead_add_packages_upi").val('');
$("#market_lead_add_packages_phonepay").val('');
$("#market_lead_add_packages_amazonpay").val('');
$("#market_lead_add_packages_googlepay").val('');

$("#market_lead_add_packages_paytm_upi").val('');

$("#market_lead_add_packages_chequeno").val('');
$("#market_lead_add_packages_cchequeno").val('');
$("#market_lead_add_packages_chequeaccountno").val('');
$("#market_lead_add_packages_chequeholdername").val('');
$("#market_lead_add_packages_chequeissuedate").val('');
$("#market_lead_add_packages_cheque_bankname").val('');
$("#market_lead_add_packages_cheque_ifsc").val('');
$("#market_lead_add_packages_cheque_micr").val('');
$("#market_lead_add_packages_cheque_photo").val(''); 

$("#market_lead_add_packages_neftnumber").val('');


      }else if(test==4){

        var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
        document.getElementById("market_lead_add_packages_cashamount").value = '';
         document.getElementById("market_lead_add_packages_upiamount").value = grand_total;
        document.getElementById("market_lead_add_packages_paytmamount").value = '';
        document.getElementById("market_lead_add_packages_chequeamount").value ='';
        document.getElementById("market_lead_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").show();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

$("#market_lead_add_packages_paytm_upi").val('');

$("#market_lead_add_packages_chequeno").val('');
$("#market_lead_add_packages_cchequeno").val('');
$("#market_lead_add_packages_chequeaccountno").val('');
$("#market_lead_add_packages_chequeholdername").val('');
$("#market_lead_add_packages_chequeissuedate").val('');
$("#market_lead_add_packages_cheque_bankname").val('');
$("#market_lead_add_packages_cheque_ifsc").val('');
$("#market_lead_add_packages_cheque_micr").val('');
$("#market_lead_add_packages_cheque_photo").val(''); 

$("#market_lead_add_packages_cashdate").val('');
$("#market_lead_add_packages_personame").val('');
$("#market_lead_add_packages_placename").val(''); 

$("#market_lead_add_packages_neftnumber").val('');


      }else if(test==5)
      {  

       var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
        document.getElementById("market_lead_add_packages_cashamount").value = '';
         document.getElementById("market_lead_add_packages_upiamount").value = '';
        document.getElementById("market_lead_add_packages_paytmamount").value = grand_total;
        document.getElementById("market_lead_add_packages_chequeamount").value ='';
        document.getElementById("market_lead_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").show();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

$("#market_lead_add_packages_upi").val('');
$("#market_lead_add_packages_phonepay").val('');
$("#market_lead_add_packages_amazonpay").val('');
$("#market_lead_add_packages_googlepay").val('');



$("#market_lead_add_packages_chequeno").val('');
$("#market_lead_add_packages_cchequeno").val('');
$("#market_lead_add_packages_chequeaccountno").val('');
$("#market_lead_add_packages_chequeholdername").val('');
$("#market_lead_add_packages_chequeissuedate").val('');
$("#market_lead_add_packages_cheque_bankname").val('');
$("#market_lead_add_packages_cheque_ifsc").val('');
$("#market_lead_add_packages_cheque_micr").val('');
$("#market_lead_add_packages_cheque_photo").val(''); 

$("#market_lead_add_packages_cashdate").val('');
$("#market_lead_add_packages_personame").val('');
$("#market_lead_add_packages_placename").val(''); 

$("#market_lead_add_packages_neftnumber").val('');

      }else if(test==6){

        var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
        document.getElementById("market_lead_add_packages_cashamount").value = '';
         document.getElementById("market_lead_add_packages_upiamount").value = '';
        document.getElementById("market_lead_add_packages_paytmamount").value = '';
        document.getElementById("market_lead_add_packages_chequeamount").value =grand_total;
        document.getElementById("market_lead_add_packages_neftamount").value ='';
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").show();
        $("#paymentmode_neft").hide();
        $("#razorPayModal").hide(); 

$("#market_lead_add_packages_upi").val('');
$("#market_lead_add_packages_phonepay").val('');
$("#market_lead_add_packages_amazonpay").val('');
$("#market_lead_add_packages_googlepay").val('');

$("#market_lead_add_packages_paytm_upi").val('');


$("#market_lead_add_packages_cashdate").val('');
$("#market_lead_add_packages_personame").val('');
$("#market_lead_add_packages_placename").val(''); 

$("#market_lead_add_packages_neftnumber").val('');

        
      }else if(test==7)
      {   
         var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
        document.getElementById("market_lead_add_packages_cashamount").value = '';
         document.getElementById("market_lead_add_packages_upiamount").value = '';
        document.getElementById("market_lead_add_packages_paytmamount").value = '';
        document.getElementById("market_lead_add_packages_chequeamount").value ='';
        document.getElementById("market_lead_add_packages_neftamount").value =grand_total;
          
        $("#paymentmode_cash").hide();
        $("#paymentmode_upi").hide();
        $("#paymentmode_paytm").hide();
        $("#paymentmode_cheque").hide();
        $("#paymentmode_neft").show();
        $("#razorPayModal").hide(); 

$("#market_lead_add_packages_upi").val('');
$("#market_lead_add_packages_phonepay").val('');
$("#market_lead_add_packages_amazonpay").val('');
$("#market_lead_add_packages_googlepay").val('');

$("#market_lead_add_packages_paytm_upi").val('');

$("#market_lead_add_packages_chequeno").val('');
$("#market_lead_add_packages_cchequeno").val('');
$("#market_lead_add_packages_chequeaccountno").val('');
$("#market_lead_add_packages_chequeholdername").val('');
$("#market_lead_add_packages_chequeissuedate").val('');
$("#market_lead_add_packages_cheque_bankname").val('');
$("#market_lead_add_packages_cheque_ifsc").val('');
$("#market_lead_add_packages_cheque_micr").val('');
$("#market_lead_add_packages_cheque_photo").val(''); 

$("#market_lead_add_packages_cashdate").val('');
$("#market_lead_add_packages_personame").val('');
$("#market_lead_add_packages_placename").val(''); 


      }

 if(test==8){

$("#market_lead_add_packages_upi").val('');
$("#market_lead_add_packages_phonepay").val('');
$("#market_lead_add_packages_amazonpay").val('');
$("#market_lead_add_packages_googlepay").val('');

$("#market_lead_add_packages_paytm_upi").val('');

$("#market_lead_add_packages_chequeno").val('');
$("#market_lead_add_packages_cchequeno").val('');
$("#market_lead_add_packages_chequeaccountno").val('');
$("#market_lead_add_packages_chequeholdername").val('');
$("#market_lead_add_packages_chequeissuedate").val('');
$("#market_lead_add_packages_cheque_bankname").val('');
$("#market_lead_add_packages_cheque_ifsc").val('');
$("#market_lead_add_packages_cheque_micr").val('');
$("#market_lead_add_packages_cheque_photo").val(''); 

$("#market_lead_add_packages_cashdate").val('');
$("#market_lead_add_packages_personame").val('');
$("#market_lead_add_packages_placename").val(''); 

$("#market_lead_add_packages_neftnumber").val('');

    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total=((document.getElementById('market_lead_add_packages_grandtotal').value)>0)? document.getElementById('market_lead_add_packages_grandtotal').value:document.getElementById('market_lead_add_packages_total').value;
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

var email=document.getElementById('add_business_email').value;
var mobileno=document.getElementById('add_business_mobileno').value;
var card_holder_name=document.getElementById('add_business_pname').value;
var razorpay_order_id=document.getElementById('razorpay_order_id').value;
//alert(razorpay_order_id);
//alert(email);
//alert(mobileno);
//alert(card_holder_name);
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


<div class="modal" id="marketinglead_package_otpverficationmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">OTP Verfication </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <form id="marketinglead_package_otp_verification" method="post">
          <div class="form-row">
            <label>OTP is sent to Your Mobile Number</label>    
          </div>
        <div class="form-row">
          <input type="text" class="form-control" name="marketinglead_package_mobileOtp"  id="marketinglead_package_mobileOtp" class="form-input" placeholder="Enter the OTP">  </div>
        <div class="row" style="text-align: center;margin-top:20px;">
          <button type="button" id="marketingleadpackageotpverification"  class="btn btn-primary" >Submit</button>
        </div>
     </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>


