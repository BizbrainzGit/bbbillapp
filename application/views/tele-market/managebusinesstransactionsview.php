<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?>

<div class="main-panel">
    <div class="content-wrapper listbusiness-class" id="">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Business Transactions</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">             
                        </div>
                    </div>
                     
                      <div class="col-2"></div>
                     <!-- <div class="col-8">
                  <form id="search_business" method="post" >
                      <div class="row clearfix" >
                               <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Comany Name:</label>
                                       <input type="text" class="form-control"  placeholder="Enter Company Name" name="search_business_cname" id="search_business_cname">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>City Name :</label>
                                        <select class="form-control" name="search_business_city" id="search_business_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                  <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label> From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_business_fromdate" id="search_business_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label>  To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Business Date " name="search_business_todate" id="search_business_todate">
                                         </div> 
                                   </div>
                                </div> 

                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label> Created By :</label>          
                                         <select class="form-control" name="search_business_createdby" id="search_business_createdby" style="width: 100%;">
                            
                                         </select> 
                                   </div>
                                </div>
                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label>  Business Status:</label>          
                                          <select class="form-control" name="search_business_status" id="search_business_status">
                                          </select>
                                   </div>
                                </div>

                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchbusiness" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div> -->
                          <div class="col-2"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="businesstransactionstable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


     <!-- content-wrapper ends -->
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

<script src="/<?php echo base_url();?>assets/js/Common/BusinessTransactionController.js"></script>



  <!-- keywords add model start-->


<div class="modal  fade" id="businesstransactionsModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Transaction Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="body">
                         <form id="add_businesstransaction_cheque_approval" method="post" >

                            <div class="row clearfix">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Company Name :</label>
                                        <label id="businesstransaction_company_name"></label>
                                    </div>
                                </div>

                               <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Packages :</label>
                                        <label id="businesstransaction_packages"></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Campains :</label>
                                        <label id="businesstransaction_campains"></label>
                                    </div>
                                </div>
                             <!--     <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Package Taken Date :</label>
                                        <label id="businesstransaction_package_date"></label>
                                    </div>
                                </div> -->
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Grand Total :</label>
                                        <label id="businesstransaction_grandtotal"></label>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Transaction Date :</label>
                                        <label id="businesstransaction_date"></label>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Transation Amount :</label>
                                        <label id="businesstransaction_amount"></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Transation Status :</label>
                                        <label id="businesstransaction_status"></label>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Payment Method :</label>
                                        <label id="businesstransaction_paymentmethod"></label>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 businesstransactions_chequeapproval_class" style="display: none"> 
                                   <input type="hidden"  class="form-control" name="businesstransaction_approval_id" id="businesstransaction_approval_id">

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Payment Approval:</label>
                                        <input type="checkbox"  class="form-control" name="businesstransaction_approval_status" id="businesstransaction_approval_status" value="1"> 
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                       <button  type="button" id="addbusinesstransactionchequeapproval" class="btn btn-primary">Save</button>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                               <div class="col-sm-12" id="businesstransactions-addmsg"></div>

                             
                               
                            </div>
                       </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
                        
        
      </div>
        </form>
      </div>
    </div>
  </div>
<!-- keywords add model end -->