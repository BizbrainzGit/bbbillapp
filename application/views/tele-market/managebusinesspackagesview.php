<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?>

<!-- Main    -->
<div class="main-panel">
     <div class="content-wrapper listslectedpackages-class">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Customer Seleted Packages 
                   <!--  <div style="float:right">
                      <a href="/<?php echo base_url();?>Tele-Marketing-BusinessSelectedPackages">
                       <button type="button" class="btn btn-info btn-sm"> Back </button>
                      </a> 
                   </div> -->
                 </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                        </div>
                    </div>
                    <div class="col-2"></div>
                     <div class="col-8">
                    <form id="search_businessseletedpackage" method="post" >
                      <div class="row clearfix" >
                               <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By Comany Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="search_businessseletedpackage_cname" id="search_businessseletedpackage_cname">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By City Name :</label>
                                        <select class="form-control" name="search_businessseletedpackage_city" id="search_businessseletedpackage_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label>Search By Dealclosed From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_businessseletedpackage_fromdate" id="search_businessseletedpackage_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label> Search By Dealclosed To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_businessseletedpackage_todate" id="search_businessseletedpackage_todate">
                                         </div> 
                                   </div>
                                </div> 
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchbusinessseletedpackage" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 
                       </form>
                       </div>
                          <div class="col-2"></div>

                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="businessseletedpackagestable" class="table table-hover">
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- payment pending start -->
        <div class="content-wrapper paymentpending-class" style="display: none;" >
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Business Payment  Details
                          <a href="/<?php echo base_url();?>Tele-Marketing-BusinessSelectedPackages"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> 
                    </h4>
                  <form id="add_business_paymentpending"  method="post" enctype="multipart/form-data" >
                    <div>
                       <h3>Basic Details</h3>
                      <section>
                        <h3>Basic Details</h3>
                      <div class="row clearfixed">
                        <div class="col-sm-12 col-12 form-group">
                            <label>Company Name :</label>
                            <label id="business_paymentpending_company_name">Company Name :</label>
                        </div>
                        <div class="col-sm-6 col-12 form-group">
                          <label>Person Name :</label>
                            <label id="business_paymentpending_person_name">Company Name :</label>
                        </div>

                         <div class="col-sm-6 col-12 form-group">
                           <label>Designetion :</label>
                            <label id="business_paymentpending_designation">Company Name :</label>
                         </div>

                        <div class="col-sm-6 col-12 form-group">
                           <label>Mobile Number :</label>
                            <label id="business_paymentpending_mobileno">Mobile Number :</label>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                           <label>Email :</label>
                            <label id="business_paymentpending_email">Email :</label>
                        </div>

                        <div class="col-sm-6 col-12 form-group">
                            <label>Address :</label>
                            <label id="business_paymentpending_address">Address :</label>
                        </div>

                      
                      </div>

                      </section>

                      <h3>Payments Details</h3>
                      <section>
                        <h3>Payments Details</h3>
                        <div class="row clearfixed">

                        <div class="col-sm-12 col-12 form-group text-center">
                          <h5> Packages Details</h5>
                           <label id="business_paymentpending_packagedetails"></label>
                                  <table class="table  text-centered table-bordered table-striped table-hover" id="business_paymentpending_packages_table">
                                    <tr>
                                      <th>Package Name</th>
                                      <th>Package Amount</th>
                                    </tr>
                                  </table>
                        </div>
                       
                        <div class="col-sm-12 col-12 form-group text-center">
                          <h5>Payments Details </h5>
                           <label id="business_paymentpending_paymentdetails"></label>
                            <table class="table  text-centered table-bordered table-striped table-hover" >
                                    <tr>
                                      <th>Details</th>
                                      <th>Amounts</th>
                                    </tr>
                                     <tr>
                                      <td>Package Sub Total</td>
                                      <td><span id="business_paymentpending_subtotal"></span></td>
                                    </tr>
                                     <tr>
                                      <td>Discount</td>
                                      <td><span id="business_paymentpending_discount"></span></td>
                                    </tr>
                                    <tr>
                                      <td>Package Total</td>
                                      <td><span id="business_paymentpending_packagetotal"></span></td>
                                    </tr>
                                     <tr>
                                      <td>Domain Amount</td>
                                      <td><span id="business_paymentpending_domainamount"></span></td>
                                    </tr>
                                     <tr>
                                      <td> Total</td>
                                      <td><span id="business_paymentpending_total"></span></td>
                                    </tr>
                                    <tr>
                                      <td>GST</td>
                                      <td><span id="business_paymentpending_gst"></span></td>
                                    </tr>
                                     <tr>
                                      <td>TDS</td>
                                      <td><span id="business_paymentpending_tdsamount"></span></td>
                                    </tr>
                                     <tr>
                                      <td>Grand Total</td>
                                      <td><span id="business_paymentpending_gstgrandtotal"></span></td>
                                    </tr>
                                  </table>
                        </div>

                        <div class="col-sm-12 col-12 form-group text-center">
                          <h5>Transction Details </h5>
                               <div class="table-responsive">
                                 <table class="table  text-centered table-bordered table-striped table-hover" id="business_paymentpending_transctiondetails"> 
                                    <tr>
                                      <th>Order ID</th>
                                      <th>Total Amount</th>
                                      <th>Payment Method</th>
                                      <th>Status</th>
                                    </tr>
                                  </table>
                                </div>
                        </div>

                         <div class="col-sm-12 col-12 form-group text-center">
                          <h5>Payment Pending Details </h5>
                                <div class="table-responsive">
                                 <table class="table  text-centered table-bordered table-striped table-hover"> 
                                    <tr>
                                      <th>Total Amount</th>
                                      <th>Paid Amount</th>
                                      <th>Pending Amount</th>
                                    </tr>

                                    <tr>
                                       <td><span id="business_paymentpending_transction_gstgrandtotal"></span></td>
                                       <td><span id="business_paymentpending_transction_grandtotal"></span></td>
                                       <td><span id="business_paymentpending_transction_pendingtotal"></span></td>
                                    </tr>
                                  </table>
                        </div>
                      </div>

                       


                      </div>
                      </section>

                     <h3>Payment Types</h3>
                      <section>
                        <h3> Payment Types</h3>
                      <div class="row clearfixed">

                        <div class="col-sm-12 col-12 text-center text-danger"> <h4>Pending Amount : Rs &nbsp; <span id="business_paymentpending_transction_pendingtotal_showingpending"></span></h4> </div>
                      
                        <input type="hidden" class="form-control" name="business_paymentpending_pendingtotal" id="business_paymentpending_pendingtotal">
                        
                        <input type="hidden" class="form-control" name="business_paymentpending_package_id" id="business_paymentpending_package_id"> 

                        <input type="hidden" class="form-control" name="business_paymentpending_business_id" id="business_paymentpending_business_id">
                        
                   <div class="col-sm-4 col-12">
                  <ul class="nav nav-pills nav-pills-vertical nav-pills-info">
                    <span id="addpaymentpendingpaymentmode"></span>
                      </ul>
                    </div>
                    <div class="col-sm-8 col-12"> 
                      <div class="tab-content tab-content-vertical" id="paymentpendingpaymentmode_cash" style="display: none">
                        <h5>Cash Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_paymentpending_cashamount" id="add_paymentpending_cashamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" placeholder="Date" name="add_paymentpending_cashdate" id="add_paymentpending_cashdate">
                          </div>
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Person Name</label>
                            <input type="text" class="form-control" placeholder="Person Name" name="add_paymentpending_personame" id="add_paymentpending_personame">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Place/City Name</label>
                            <input type="text" class="form-control" placeholder="Place/City Name" name="add_paymentpending_placename" id="add_paymentpending_placename">
                          </div>
                         </div> 
                      </div>
                       <div class="tab-content tab-content-vertical" id="paymentpendingpaymentmode_neft" style="display: none">
                        <h5>NEFT/IMPS Details : </h5>
                           <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Number</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Number" name="add_paymentpending_neftnumber" id="add_paymentpending_neftnumber">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>NEFT/IMPS Amount</label>
                            <input type="text" class="form-control" placeholder="NEFT/IMPS Amount" name="add_paymentpending_neftamount" id="add_paymentpending_neftamount">
                          </div>
                         </div> 
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentpendingpaymentmode_upi" style="display: none">
                         <h5> UPI Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>UPI Number</label>
                            <input type="text" class="form-control" placeholder="UPI Number" name="add_paymentpending_upi" id="add_paymentpending_upi">
                          </div>
                            <div class="col-sm-6 col-12 form-group">
                            <label>Phone Pay</label>
                            <input type="text" class="form-control" placeholder="Phone Pay Number" name="add_paymentpending_phonepay" id="add_paymentpending_phonepay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Amazon Pay</label>
                            <input type="text" class="form-control" placeholder="Amazon Pay Number" name="add_paymentpending_amazonpay" id="add_paymentpending_amazonpay">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Google Pay</label>
                            <input type="text" class="form-control" placeholder="GooglePay Number" name="add_paymentpending_googlepay" id="add_paymentpending_googlepay">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="Amount" name="add_paymentpending_upiamount" id="add_paymentpending_upiamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentpendingpaymentmode_paytm" style="display: none">
                         <h5> PayTm Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm UPI Number</label>
                            <input type="text" class="form-control" placeholder="PayTm UPI Number" name="add_paymentpending_paytm_upi" id="add_paymentpending_paytm_upi">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>PayTm Amount</label>
                            <input type="text" class="form-control" placeholder="PayTm Amount" name="add_paymentpending_paytmamount" id="add_paymentpending_paytmamount">
                          </div>
                         </div>
                      </div>
                      <div class="tab-content tab-content-vertical" id="paymentpendingpaymentmode_cheque" style="display: none">
                        <h5> Cheque Details : </h5>
                         <div class="row clearfixed">
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Cheque Number" name="add_paymentpending_chequeno" id="add_paymentpending_chequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Confirm Cheque Number</label>
                            <input type="text" class="form-control" placeholder="Confirm Cheque Number" name="add_paymentpending_cchequeno" id="add_paymentpending_cchequeno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Amount</label>
                            <input type="text" class="form-control" placeholder="Cheque Amount" name="add_paymentpending_chequeamount" id="add_paymentpending_chequeamount">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Account Number</label>
                            <input type="text" class="form-control" placeholder="Account Number" name="add_paymentpending_chequeaccountno" id="add_paymentpending_chequeaccountno">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Holder Name</label>
                            <input type="text" class="form-control" placeholder="Cheque Holder Name" name="add_paymentpending_chequeholdername" id="add_paymentpending_chequeholdername">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Cheque Issue Date</label>
                            <input type="text" class="form-control" placeholder="Cheque Issue Date" name="add_paymentpending_chequeissuedate" id="add_paymentpending_chequeissuedate">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>Bank Name</label>
                            <input type="text" class="form-control " placeholder="Bank Name" name="add_paymentpending_cheque_bankname" id="add_paymentpending_cheque_bankname">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>IFSC Code</label>
                            <input type="text" class="form-control text-uppercase" placeholder="IFSC Code" name="add_paymentpending_cheque_ifsc" id="add_paymentpending_cheque_ifsc">
                          </div>
                          <div class="col-sm-6 col-12 form-group">
                            <label>MICR Code</label>
                            <input type="text" class="form-control" placeholder="MICR Code" name="add_paymentpending_cheque_micr" id="add_paymentpending_cheque_micr">
                          </div>
                           <div class="col-sm-6 col-12 form-group">
                            <label>Photo</label>
                           <input type="file" class="form-control" name="add_paymentpending_cheque_photo" id="add_paymentpending_cheque_photo">
                          </div>
                         </div> 
                      </div>
                     </div>
                      <h3>Business Status </h3>
                       <div class="col-sm-6 col-12 form-group">
                          <label> Business Status </label>
                            <select class="form-control"  name="add_paymentpending_status" id="add_paymentpending_status" >
                           </select>
                            <input type="hidden" class="form-control" name="razorpay_paymentpending_order_id" id="razorpay_paymentpending_order_id" value="<?php echo $merchant_order_id; ?>">
                        </div>
                    </div>
                
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="add_paymentpending_condition" id="add_paymentpending_condition">
                            I Agree With The Terms and Conditions.
                          </label>
                          <div id="paymentpendingdata-addmsg"></div>
                        </div>
                      </section>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       
        <!-- payment Pending Ends -->

         <!-- Reciept Start -->
    <div class="content-wrapper listofreceipt-class" style="display: none;">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Receipt <span id="lisofbusiness"></span>
                 <a href="/<?php echo base_url();?>Tele-Marketing-BusinessSelectedPackages"> <div style="float:right"><button type="button" class="btn btn-info btn-sm"> Back </button></div></a> </h4>
                     <div class="row grid-margin">
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="listofreceipttable" class="table table-hover">
                        </table>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>


    <div class="content-wrapper receipt-class"  style="display: none;" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                   <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                             <div class="container-fluid w-100">
                              <div id="receipt_sendmail_msg"> </div>
                            <form id="export_receipt" method="post">
                              <input type="hidden" id="business_receipt_selectedid" name="business_receipt_selectedid">

                              <div>
                               <a href="/<?php echo base_url();?>Tele-Marketing-manageBusiness">
                                <button type="button" class="btn btn-info btn-sm" style="float:right;margin-left: 10px;"> Back </button>  </a>
                             </div>
                           <div style="float: right;">
                        <!-- <button  id="excel" value="excel" style="display:none;" ><img  src="/<?php echo base_url()."assets/img/excel.png" ?>" style="cursor: pointer;"/></button> -->
                        <button class="btn btn-primary btn-sm" type="button" id="receipt_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                       <!--  <button class="btn btn-primary btn-sm" type="button" id="receipt_print" value="print" ><i class="mdi mdi-printer"></i></button> -->
                        <button class="btn btn-primary btn-sm" type="button" id="receipt_sendmail" value="receipt_sendmail" >Sendmail</button>
                      </div>
                           </form>
                          </div>
                       </div>
                     </div>
                     
                     <div class="col-12" id="receipt_printdata" style="border: 2px solid; border-radius: 12px;">
                      <!-- <div class="row clearfixed"> -->
                          <div class="row clearfixed receipt-header">                          
                             <div class="col-sm-3 col-12 text-center">
                               <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/>
                             </div>
                             <div class="col-sm-6 col-12 receipt_heading text-center">
                                 <h1>Customer Receipt</h1>   
                             </div>
                             <!-- <div class="col-sm-3"> Date: <span id="receipt_date"></span> </div> -->
                          </div>
                      
                        <div class="row clearfixed receipt_line1"> 
                            <div class="col-sm-2">
                                <label >Receipt No. :</label>
                             </div>
                             <div class="col-sm-4">
                                  <div id="receipt_number"></div>
                             </div>


                             <div class="col-sm-2">
                                <label >Date : </label>
                             </div>
                             <div class="col-sm-4">
                                  <div id="receipt_date"></div>
                             </div>
                        </div> 

                         <div class="row clearfixed receipt_line2"> 
                            <div class="col-sm-2">
                               <label >Business Name:</label>
                            </div>
                            <div class="col-sm-10 border_bottom">
                              <div id="receipt_company_name"></div>
                            </div>

                             <!-- <div class="col-sm-2">
                                <label >Business Id :</label>
                             </div>
                             <div class="col-sm-4 border_bottom">
                                  <div id="receipt_number"></div>
                             </div> -->

                         </div>  
                          
                         
                         
                          <div class="row clearfixed receipt_line2"> 
                             <div class="col-sm-2">
                                 <label >City :</label>
                              </div>
                              <div class="col-sm-4 border_bottom">
                               <span id="receipt_company_city"></span>
                              </div>
                         
                               <div class="col-sm-2">
                                <label >State :</label>
                              </div>
                              <div class="col-sm-4 border_bottom">
                                <span id="receipt_comapy_state"></span>
                              </div>
                          </div>
                           <div class="row clearfixed receipt_line2"> 
                               <div class="col-sm-2">
                                 <label >Contact Person:</label>
                                </div>
                               <div class="col-sm-4 border_bottom">
                                <span id="receipt_person_name"></span>
                               </div>
                               <div class="col-sm-2">
                                   <label >Contact No. :</label>
                               </div>
                               <div class="col-sm-4 border_bottom">
                                  <span id="receipt_mobile_no"></span>
                               </div>
                          </div>

                     <div class="row clearfixed receipt_line2">
                        <div class="col-sm-2">
                          <label >Designation :</label>
                        </div>
                        <div class="col-sm-4 border_bottom"><span id="receipt_person_designation"></span>
                        </div>
                        <div class="col-sm-2">
                          <label >Email ID :</label>
                        </div>
                        <div class="col-sm-4 border_bottom"><span id="receipt_email"></span>
                        </div>
                      </div>
                       <div class="row clearfixed receipt_line2"> 
                             <div class="col-sm-2">
                               <label >Address :</label>
                             </div>
                             <div class="col-sm-10 border_bottom">
                               <span id="receipt_company_address"></span>
                             </div>
                       </div> 
                  <div class="row clearfixed receipt_line2">
                    <div class="col-sm-6">
                        <div class="row">
                          <!-- <div class="col-sm-12" >
                            <div class="col-sm-12 text-center">
                              <div style="height:120px;background-color: ;border: 1px solid;border-radius: 12px;">
                                <p style="padding: 5px 5px 0px 5px;"> Authorised Signature & Stamp:</p><hr>
                              </div>
                            </div>
                        </div>
                         -->

                        <div class="col-sm-12">
                          <div style="padding: 10px 0px 0px 15px;text-align: justify;">

                             <h3 style="text-align: center;">Terms and Conditions</h3>
                              <ul>
                                <li>After payment clearance only contract will be activation.</li>
                                <!-- <li>Cheque got bounce charges should be applicable.</li>
                                <li>Once the payments clear its not refundable</li> -->
                                <li>BizBrainz DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with BizBrainz.
                              </li>
                              <li>After payment clearance customer should be provide content and photos with in 7 Working days for website </li>
                              <li>The Advertiser has given his consent to contact him for any business promotion of BizBrainz during the tenure of this agreement. Whether the Advertiser has registered their entity/firm’s contact numbers as per customer request.</li>
                              <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                              </li>
                            </ul>
                            
                          </div>
                        </div> 
                        </div> 

                        </div>

                         <div class="col-sm-6">
                          <div style="background-color: ;border: 1px solid;border-radius: 12px;">
                            <h4 style="text-align: center;padding: 10px 0px 10px 0px ; background-color: gray;border-radius: 12px 12px 0px 0px;">PAYMENT DETAILS</h4>

                          <!--  <div class="row" style="padding-left: 5px;">
                             <div class="col-sm-6"> <p>Sub-Total :</p>   </div>
                              <div class="col-sm-5" style="border-bottom: 1px solid"><span id="receipt_sub_total"></span>
                             </div>
                          </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>Discount Amount:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="receipt_discount_amount"></span>
                           </div>
                         </div>
                        <div class="row" style="padding-left: 5px;">
                            <div class="col-sm-6"> <p>Total Amount:</p>   </div>
                            <div class="col-sm-5" style="border-bottom: 1px solid"><span id="receipt_total_amount"></span>
                            </div>
                        </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>GST:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="receipt_gst"></span>
                           </div>
                        </div>
                         <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>Grand Total:</p>   </div>
                           <div class="col-sm-5" style="border-bottom: 1px solid"><span id="receipt_grand_total"></span>
                         </div>
                        </div>
 -->
                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Order ID:</p>  </div>
                           <div class="col-sm-6">  <span id="receipt_order_id"></span> </div>
                        </div>

                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Payment Method:</p>  </div>
                           <div class="col-sm-6">  <span id="receipt_payment_methode"></span> </div>
                         </div>

                        <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Transction Amount:</p>  </div>
                           <div class="col-sm-6">  <span id="receipt_transaction_amount"></span> </div>
                        </div>

                         <div class="row receipt_line2" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Transction Status:</p>  </div>
                           <div class="col-sm-6">  <span id="receipt_transaction_status"></span> </div>
                         </div>

                        <div class="row">
                           <div class="col-sm-6" >
                                 <div class="row" style="padding-left: 5px;">
                                   <div class="col-sm-6">  <p>ME Name :</p>   </div>
                                   <div class="col-sm-6 "><span id="receipt_marketing_name"></span></div>
                                </div>
                                
                                <div class="row" style="padding-left: 5px;">
                                    <div class="col-sm-6">  <p>TME Name :</p>   </div>
                                    <div class="col-sm-6 "><span id="receipt_telemarketing_name"></span></div>
                                </div>
                              
                           </div>
                           <div class="col-sm-6" >
                                <div class="row" style="padding-left: 5px;">
                                   <div class="col-sm-6">  <p>ME Id :</p>   </div>
                                    <div class="col-sm-6 "><span id="receipt_marketing_id"></span></div>
                                </div>
                                <div class="row" style="padding-left: 5px;">
                                     <div class="col-sm-6">  <p>TME Id :</p>   </div>
                                     <div class="col-sm-6 "><span id="receipt_telemarketing_id"></span></div>
                                </div>
                           </div>
                       </div>
                      </div>
                    </div>
                    </div> 
                     <div class="row clearfixed receipt_line2" style="border-top: 1px solid;"> 
                               <div class="col-sm-12 text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                     <strong><p>CIN: U72900TG2019PTC134639, GST: 36AAICB5799E1ZA </p></strong>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad,Telangana,500003.</p>
                                    <p> +91 733 77 56789 , +91 973 99 89333   <b>Email:</b>
                                       hyd@bizbrainz.in , blr@bizbrainz.in</p>
                                    <p>visit our Website <b style="font-size: 20px;">www.bizbrainz.in</b></p>
                                </div>
                      </div>  
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
           
 <!-- Reciept Ends -->


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
include('Layouts/tele-marketLayout_Footer.php');
?>

<script src="/<?php echo base_url();?>assets/js/Common/BusinessSelectedPackageController.js" type="text/javascript"></script> 


<script type="text/javascript">
$('#search_businessseletedpackage_fromdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
 });

$('#search_businessseletedpackage_todate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
 });



function showpaymentpendingPaymentmode(test){
    var test = test.value;
    if(test==1)
      {  
       var grand_total=document.getElementById('business_paymentpending_pendingtotal').value;
        // alert(grand_total);
       var total = parseFloat(grand_total).toFixed(2);
        document.getElementById("add_paymentpending_cashamount").value = total;
        document.getElementById("add_paymentpending_upiamount").value = '';
        document.getElementById("add_paymentpending_paytmamount").value = '';
        document.getElementById("add_paymentpending_chequeamount").value =''; 
        document.getElementById("add_paymentpending_neftamount").value =''; 

        $("#paymentpendingpaymentmode_cash").show();
        $("#paymentpendingpaymentmode_cheque").hide();
        $("#paymentpendingpaymentmode_upi").hide();
        $("#paymentpendingpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#paymentpendingpaymentmode_neft").hide();


$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_cchequeno").val('');
$("#add_paymentpending_chequeaccountno").val('');
$("#add_paymentpending_chequeholdername").val('');
$("#add_paymentpending_chequeissuedate").val('');
$("#add_paymentpending_cheque_bankname").val('');
$("#add_paymentpending_cheque_ifsc").val('');
$("#add_paymentpending_cheque_micr").val('');
$("#add_paymentpending_cheque_photo").val('');

$("#add_paymentpending_upi").val('');
$("#add_paymentpending_phonepay").val('');
$("#add_paymentpending_amazonpay").val('');
$("#add_paymentpending_googlepay").val('');

$("#add_paymentpending_paytm_upi").val('');
$("#add_paymentpending_neftnumber").val('');

      }else if(test==4){
var grand_total= document.getElementById('business_paymentpending_pendingtotal').value;
        // alert(grand_total);
       var total = parseFloat(grand_total).toFixed(2);
        document.getElementById("add_paymentpending_cashamount").value = '';
        document.getElementById("add_paymentpending_upiamount").value = total;
        document.getElementById("add_paymentpending_paytmamount").value = '';
        document.getElementById("add_paymentpending_chequeamount").value =''; 
        document.getElementById("add_paymentpending_neftamount").value =''; 
             
        $("#paymentpendingpaymentmode_cash").hide();
        $("#paymentpendingpaymentmode_cheque").hide();
        $("#paymentpendingpaymentmode_upi").show();
        $("#paymentpendingpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#paymentpendingpaymentmode_neft").hide();

$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_cchequeno").val('');
$("#add_paymentpending_chequeaccountno").val('');
$("#add_paymentpending_chequeholdername").val('');
$("#add_paymentpending_chequeissuedate").val('');
$("#add_paymentpending_cheque_bankname").val('');
$("#add_paymentpending_cheque_ifsc").val('');
$("#add_paymentpending_cheque_micr").val('');
$("#add_paymentpending_cheque_photo").val('');


$("#add_paymentpending_paytm_upi").val('');

$("#add_paymentpending_neftnumber").val('');


$("#add_paymentpending_cashdate").val('');
$("#add_paymentpending_personame").val('');
$("#add_paymentpending_placename").val('');



      }else if(test==5)
      { 
        var grand_total=document.getElementById('business_paymentpending_pendingtotal').value ;
        // alert(grand_total);
       var total = parseFloat(grand_total).toFixed(2);
        document.getElementById("add_paymentpending_cashamount").value = '';
        document.getElementById("add_paymentpending_upiamount").value = '';
        document.getElementById("add_paymentpending_paytmamount").value =  total;
        document.getElementById("add_paymentpending_chequeamount").value =''; 
        document.getElementById("add_paymentpending_neftamount").value =''; 
             
        $("#paymentpendingpaymentmode_cash").hide();
        $("#paymentpendingpaymentmode_cheque").hide();
        $("#paymentpendingpaymentmode_upi").hide();
        $("#paymentpendingpaymentmode_paytm").show(); 
        $("#razorPayModal").hide(); 
        $("#paymentpendingpaymentmode_neft").hide();

$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_cchequeno").val('');
$("#add_paymentpending_chequeaccountno").val('');
$("#add_paymentpending_chequeholdername").val('');
$("#add_paymentpending_chequeissuedate").val('');
$("#add_paymentpending_cheque_bankname").val('');
$("#add_paymentpending_cheque_ifsc").val('');
$("#add_paymentpending_cheque_micr").val('');
$("#add_paymentpending_cheque_photo").val('');

$("#add_paymentpending_upi").val('');
$("#add_paymentpending_phonepay").val('');
$("#add_paymentpending_amazonpay").val('');
$("#add_paymentpending_googlepay").val('');


$("#add_paymentpending_neftnumber").val('');


$("#add_paymentpending_cashdate").val('');
$("#add_paymentpending_personame").val('');
$("#add_paymentpending_placename").val('');

      }else if(test==6){ 
       
       var grand_total=document.getElementById('business_paymentpending_pendingtotal').value ;
        // alert(grand_total);
       var total = parseFloat(grand_total).toFixed(2);
        document.getElementById("add_paymentpending_cashamount").value = '';
        document.getElementById("add_paymentpending_upiamount").value = '';
        document.getElementById("add_paymentpending_paytmamount").value = '';
        document.getElementById("add_paymentpending_chequeamount").value = total; 
        document.getElementById("add_paymentpending_neftamount").value =''; 
             
        $("#paymentpendingpaymentmode_cash").hide();
        $("#paymentpendingpaymentmode_cheque").show();
        $("#paymentpendingpaymentmode_upi").hide();
        $("#paymentpendingpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#paymentpendingpaymentmode_neft").hide();


$("#add_paymentpending_upi").val('');
$("#add_paymentpending_phonepay").val('');
$("#add_paymentpending_amazonpay").val('');
$("#add_paymentpending_googlepay").val('');

$("#add_paymentpending_paytm_upi").val('');

$("#add_paymentpending_neftnumber").val('');


$("#add_paymentpending_cashdate").val('');
$("#add_paymentpending_personame").val('');
$("#add_paymentpending_placename").val('');

      }if(test==7){

        var grand_total= document.getElementById('business_paymentpending_pendingtotal').value ;
        // alert(grand_total);
       var total = parseFloat(grand_total).toFixed(2);
        document.getElementById("add_paymentpending_cashamount").value = '';
        document.getElementById("add_paymentpending_upiamount").value = '';
        document.getElementById("add_paymentpending_paytmamount").value = '';
        document.getElementById("add_paymentpending_chequeamount").value =''; 
        document.getElementById("add_paymentpending_neftamount").value = total; 
             
        $("#paymentpendingpaymentmode_cash").hide();
        $("#paymentpendingpaymentmode_cheque").hide();
        $("#paymentpendingpaymentmode_upi").hide();
        $("#paymentpendingpaymentmode_paytm").hide(); 
        $("#razorPayModal").hide(); 
        $("#paymentpendingpaymentmode_neft").show();

$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_cchequeno").val('');
$("#add_paymentpending_chequeaccountno").val('');
$("#add_paymentpending_chequeholdername").val('');
$("#add_paymentpending_chequeissuedate").val('');
$("#add_paymentpending_cheque_bankname").val('');
$("#add_paymentpending_cheque_ifsc").val('');
$("#add_paymentpending_cheque_micr").val('');
$("#add_paymentpending_cheque_photo").val('');

$("#add_paymentpending_upi").val('');
$("#add_paymentpending_phonepay").val('');
$("#add_paymentpending_amazonpay").val('');
$("#add_paymentpending_googlepay").val('');

$("#add_paymentpending_paytm_upi").val('');


$("#add_paymentpending_cashdate").val('');
$("#add_paymentpending_personame").val('');
$("#add_paymentpending_placename").val('');


      }

if(test==8){

$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_chequeno").val('');
$("#add_paymentpending_cchequeno").val('');
$("#add_paymentpending_chequeaccountno").val('');
$("#add_paymentpending_chequeholdername").val('');
$("#add_paymentpending_chequeissuedate").val('');
$("#add_paymentpending_cheque_bankname").val('');
$("#add_paymentpending_cheque_ifsc").val('');
$("#add_paymentpending_cheque_micr").val('');
$("#add_paymentpending_cheque_photo").val('');

$("#add_paymentpending_upi").val('');
$("#add_paymentpending_phonepay").val('');
$("#add_paymentpending_amazonpay").val('');
$("#add_paymentpending_googlepay").val('');
$("#add_paymentpending_paytm_upi").val('');
$("#add_paymentpending_neftnumber").val('');
$("#add_paymentpending_cashdate").val('');
$("#add_paymentpending_personame").val('');
$("#add_paymentpending_placename").val('');

    var base_url='/<?php echo base_url();?>';
    $("#orderGeneration").modal();
    var merchant_total=0;
    var merchant_amount=0;
    var grand_total= document.getElementById('business_paymentpending_pendingtotal').value;
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

