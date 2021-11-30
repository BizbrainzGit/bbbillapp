<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/tele-marketLayout_Header.php');
?>

<div class="main-panel">
 <div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Assignments List </h4>
                  <div class="row grid-margin">
                    <div class="col-12" >
                      <div class="header">
                        </div>
                    </div>
                 
                      <div class="col-2"></div>
                     <div class="col-8">
                  <form id="search_assignment" method="post" >
                      <div class="row clearfix" >

                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By Comany Name:</label>
                                       <input type="text" class="form-control"  placeholder="Search By Comany Name" name="search_businessassignments_cname" id="search_businessassignments_cname">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Search By City Name :</label>
                                        <select class="form-control" name="search_businessassignments_city" id="search_businessassignments_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label>Search By Assignments From Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Search By Assignments From Date" name="search_businessassignments_fromdate" id="search_businessassignments_fromdate">
                                         </div> 
                                   </div>
                                </div>

                                 <div class="col-md-6 col-sm-12 col-12">
                                   <div class="form-group">
                                      <label> Search By Assignments To Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Search By Assignments To Date" name="search_businessassignments_todate" id="search_businessassignments_todate">
                                         </div> 
                                   </div>
                                </div> 

                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchassignment" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 

                   </form>
                       </div>
                          <div class="col-2"></div>
                  
                  </div>
                  <div class="row">
                    <div class="col-12">
                  <!--   <div id="msg"></div>
                      <div style="float: right;">
                        <button  id="assignments_excel" value="excel" style="display:none;" ><img  src="/<?php echo base_url()."assets/images/excel.png" ?>" style="cursor: pointer;"/></button>
                        <button  id="assignments_pdf" value="pdf" style="display:none;"><img  src="/<?php echo base_url()."assets/images/pdf.png" ?>" style="cursor: pointer;"></button>
                        <button  id="assignments_print" value="print" style="display:none;"><img  src="/<?php echo base_url()."assets/images/print.png" ?>" style="cursor: pointer;"></button>
                    </div> -->

                      <div class="table-responsive">
                        <table id="assignmentstablelist" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        

<!-- <div class="content-wrapper assignmentadd-class" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assignments List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                    	<div class="header">
      
                        </div>
                    </div>
                     <div class="col-12">
                      <div class="row clearfix">
                        <div class="col-2"></div>
                        <div class="col-8">
                         <form id="search_telemarketing_business" method="post" >
                              <div class="row clearfix" >
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Comany Name:</label>
                                       <input type="text" class="form-control text-uppercase"  placeholder="Enter Company Name" name="search_telemarketing_business_cname" id="search_telemarketing_business_cname">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City Name :</label>
                                        <select class="form-control" name="search_telemarketing_business_city" id="search_telemarketing_business_city" style="width: 100%;">
                                       </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12" style="text-align: center;">
                                  <button  type="button" id="searchtelemarketingbusiness" class="btn btn-primary">Search</button>
                                  <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div> 
                            </div> 
                         </form>
                       </div>
                          <div class="col-2"></div>
                          </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="assignmentstable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->





    <!-- <div class="content-wrapper assignmentaddview-class" style="display: none" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assignments Add List</h4>
                  <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">

                        </div>
                    </div>
                     <div class="col-12">
                      <div class="col-sm-6"> <strong>Company Name &nbsp;: &nbsp;<span id="assignment_companyname"></span></strong></div>
                     
                       <div style="text-align: center;">
                        <input type="hidden" id="assignmentadd_business_id" name="assignmentadd_business_id">
                        <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" id="assignmentadd" data-target="#AddassignmentModal"><i class="fa fa-plus" aria-hidden="true"></i>Add Assignments</button>
                         </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="assignmentsaddtable" class="table table-hover">
                    
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->

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
<script src="/<?php echo base_url();?>assets/js/Common/AssignmentsController.js"> </script>


<script type="text/javascript">
     $( "#add_appointment_date" ).datepicker({
      todayHighlight: true,
    autoclose  : true,
    startDate  : '0d',
    Format : 'dd-mm-yy'
  });
</script>