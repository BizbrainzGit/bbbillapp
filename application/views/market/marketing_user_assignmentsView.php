<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/marketLayout_Header.php');
?>



<div class="main-panel">
<div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assignments List fwfwf</h4>
                <div class="row grid-margin">
                    <div class="col-12" >
                      <div class="header">
      
                        </div>
                    </div>
                 
                      <div class="col-2"></div>
                     <div class="col-8">
                  <form id="search_marketing_assignment" method="post" >
                      <div class="row clearfix" >
                              
                               <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Select Marketing Person:</label>
                                        <select class="form-control" name="add_markrting_user" id="add_markrting_user">
                            
                                       </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Massage :</label>
                                         <textarea rows="5"  type="text" class="form-control discount" placeholder="Type Your Massage" name="add_message" id="add_message" ></textarea>
                                    </div>
                                </div> -->
                                
                                  <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>Appointment From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="From Date " name="search_appointment_fromdate" id="search_appointment_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-sm-6">
                                   <div class="form-group">
                                      <label> Appointment To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Appointment Date " name="search_appointment_todate" id="search_appointment_todate">
                                         </div> 
                                   </div>
                                </div>
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchmarketingassignment" class="btn btn-primary">Search</button>
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
                        <table id="allassignmrntstable" class="table table-hover">
                    
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
include('Layouts/marketLayout_Footer.php');
?>

<script type="text/javascript">
     $( "#search_appointment_todate" ).datepicker({
      todayHighlight: true,
    autoclose  : true,
    Format : 'dd-mm-yy'
});

 $( "#search_appointment_fromdate" ).datepicker({
  todayHighlight: true,
    autoclose  : true,
    Format : 'dd-mm-yy'
});


</script>