<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?>

<div class="main-panel">
<div class="content-wrapper business_dealclosed-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Deals Closed List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
                          
                        </div>

                    </div>
                    <div class="col-2"></div>
                     <div class="col-8">
                    <form id="search_businessdealclosed" method="post" >
                      <div class="row clearfix" >
                               <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By Comany Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="search_businessdealclosed_cname" id="search_businessdealclosed_cname">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By City Name :</label>
                                        <select class="form-control" name="search_businessdealclosed_city" id="search_businessdealclosed_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label>Search By Dealclosed From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Search By Dealclosed From Date" name="search_businessdealclosed_fromdate" id="search_businessdealclosed_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label> Search By Dealclosed To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Search By Dealclosed To Date" name="search_businessdealclosed_todate" id="search_businessdealclosed_todate">
                                         </div> 
                                   </div>
                                </div> 
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchbusinessdealclosed" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 
                       </form>
                       </div>
                          <div class="col-2"></div>
                    <!--  <div class="col-12">
                      <div class="alert alert-warning" role="alert">
                          <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                      </div>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="dealclosedtable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


         <div class="content-wrapper business_dealclosed_invoice-class" style="display: none">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card px-2">
                      <div class="card-body">
                        <!-- <h4 class="card-title">Business Details -->
                 <a href="/<?php echo base_url();?>Tele-Marketing-DealClosed">
         <div style="float:right;">
          <button type="button" class="btn btn-info btn-sm"> Back </button>
         </div>
         </a>
          <!-- </h4> -->
                        <div id="invoice_printdata">
                          <div class="container-fluid">
                            <div class="row"> 
                            <div class="col-md-3"><img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/> 
                            </div>
                            <div class="col-md-9"> <h3> <div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                    <p>Flat No.16, Paigah Apartments, S.P Road, Secunderabad, Telangana, 500003.</p>
                                    <p> +91 733 77 56789, +91 973 99 89333. Email:
                                       hyd@bizbrainz.in, blr@bizbrainz.in</p>
                                    <!-- <p>visit our Website www.bizbrainz.in </p> -->
                            </div></h3></div>
                            </div>
                            <hr>
                          </div>
                          <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h1>Invoice</h1>
                            </div>
                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-left">
                              <b class="mb-0 mt-5">Invoice No : <span id="business_dealclosed_invoice_id"></span> .</b>
                            </div>
                            
                            <div class="col-lg-6 pl-0 text-right">
                              <b class="mb-0 mt-5">Date : <span id="business_dealclosed_invoice_raisedate"></span> .</b>
                            </div>
                          </div>

                          <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-6 pl-0 text-uppercase">
                              <h4 class="mt-5 mb-2"><b>BizBrainz Technologies Private Limited.</b></h4>
                               <p>Flat No.16, Paigah Apartments<br>S.P Road, Secunderabad,<br>Telangana,500003.</p>
                              <p>GST No. : 36AAICB5799E1ZA </p>
                            </div>
                            <div class="col-lg-6 pr-0 text-uppercase">
                              <h4 class="mt-5 mb-2 text-right"><b><span id="business_dealclosed_invoice_company_name"></span></b></h4>
                              <p class="text-right"><span id="business_dealclosed_invoice_address"></span></p>
                              <p class="text-right">GST No. :<span id="business_dealclosed_invoice_gstno">.</span></p>
                            </div>
                          </div>
                          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100 ">
                                <table class="table css-serial" id="myTable">
                                  <thead>
                                    <tr class="bg-dark text-white">
                                        <th>S.No</th>
                                        <th>Description</th>
                                        <th class="text-right">Quantity</th>
                                        <th class="text-right">Unit cost</th>
                                        <th class="text-right">Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="container-fluid mt-5 w-100">
                           
                                     <p class="text-right mb-2">Package Sub Total Amount:&nbsp; &nbsp;<span id="business_dealclosed_invoice_subtotal"></span></p>
                            <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;<span id="business_dealclosed_invoice_dicount"></span></p>
                            <p class="text-right mb-2">Package Total Amount: &nbsp; &nbsp;<span id="business_dealclosed_invoice_packagetotal"></span></p>
                            <p class="text-right mb-2"> Domain Amount: &nbsp; &nbsp; <span id="business_dealclosed_invoice_domainamount"></span> </p>
                            <p class="text-right mb-2"> Total Amount: &nbsp; &nbsp; <span id="business_dealclosed_invoice_total"></span> </p>

                            <p class="text-right">CGST (9%) :&nbsp; &nbsp;<span id="business_dealclosed_invoice_cgst"></span></p>
                            <p class="text-right">SGST (9%) :&nbsp; &nbsp;<span id="business_dealclosed_invoice_sgst"></span></p>
                            <p class="text-right">IGST (18%) :&nbsp; &nbsp;<span id="business_dealclosed_invoice_igst"></span></p>
                            <p class="text-right">TDS (2%) :&nbsp; &nbsp;<span id="business_dealclosed_invoice_tds"></span></p>
                            <h4 class="text-right mb-5">Grand Total : &nbsp; &nbsp;<span id="business_dealclosed_invoice_grandtotal"></span></h4>
                            <hr>
                          </div>
                        </div>
                          <div class="container-fluid w-100">
                            <form id="export_invoice" method="post">
                              <input type="hidden" id="business_invoice_selectedid" name="business_invoice_selectedid">
                           
                           <div style="text-align: center;">
                        <!-- <button  id="excel" value="excel" style="display:none;" ><img  src="/<?php echo base_url()."assets/img/excel.png" ?>" style="cursor: pointer;"/></button> -->
                        <button class="btn btn-primary btn-sm" type="button" id="invoice_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button>
                        <!-- <button class="btn btn-primary btn-sm" type="button" id="invoice_print" value="print" ><i class="mdi mdi-printer"></i></button> --> 
                       <button class="btn btn-primary btn-sm" type="button" id="invoice_sendmail" value="print" >SendMail</button>
                        <div id="invoice_sendmail_msg"> </div>
                    </div>
                           </form>
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
   
<?php
include('Layouts/tele-marketLayout_Footer.php');
?>
<script src="/<?php echo base_url();?>assets/js/Common/DealClosedController.js"></script>

<script type="text/javascript">
$('#search_businessdealclosed_fromdate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
 });

$('#search_businessdealclosed_todate').datepicker({
      todayHighlight: true,
      autoclose: true,
      endDate: '0d',
      format: 'dd-mm-yyyy'
 });
</script>



