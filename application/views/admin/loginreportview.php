<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');
?>
<div class="main-panel">
   <div class="content-wrapper userlogs-list-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">  
                <div class="card-body">
                  <h4 class="card-title">User LogIn Report
                    <div style="float:right"><button type="button" class="btn btn-primary btn-sm" id="loginreport_pdf" value="pdf"><i class="mdi mdi-file-pdf"></i></button></div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header"></div>
                    </div>
                     <div class="col-12"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="loginreporttable" class="table table-hover">
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="content-wrapper userlogs-induviallist-class" style="display: none;">
          <div class="row">
            <div class="col-12">
              <div class="card">  
                <div class="card-body">
                  <h4 class="card-title"><span id="userlogs_username" style="color:green"></span> LogIn Report Details
                    <div style="float:right">
                       <a href="/<?php echo base_url();?>admin-LoginReport"><button type="button" class="btn btn-info btn-sm"> Back </button></a>
                    </div>
                  </h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header"></div>
                    </div>
                     <div class="col-12"></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="userlogsreporttable" class="table table-hover">
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


<?php
include('Layouts/adminLayout_Footer.php');
?>
   

