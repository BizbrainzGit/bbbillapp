<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/market-leadLayout_Header.php');
?>

<div class="main-panel">
<div class="content-wrapper" >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Assignments List </h4>
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
                    <!-- <div id="msg"></div>
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

 <!-- 

<div class="modal  fade" id="AddassignmentModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">  
      
        <div class="modal-header">
          <h4 class="modal-title">Add Assignment</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      
        <div class="modal-body">
         <div id="assignment-addmsg"></div>
                    <div class="body">
                        <form id="add_assignment" method="post" >
                            <div class="row clearfix">
                              
                               <div class="col-sm-12">
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
                                </div>

                                  <div class="col-sm-6">
                                   <div class="form-group">
                                      <label>Appointment Date :</label>          
                                         <div id="datepicker-popup" class="input-group date datepicker">
                                         <input type="text" class="form-control" placeholder="Appointment Date " name="add_appointment_date" id="add_appointment_date">
                                         </div> 
                                   </div>
                                </div> 
                            </div>             
                        </div> 
                      </div> 

        <div class="modal-footer">
          <div class="col-sm-12" style="text-align: center;">
             <button  type="button" id="addassignment" class="btn btn-primary">Save</button>
             <button type="reset" class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </div>
 -->

       
         
<?php
include('Layouts/market-leadLayout_Footer.php');
?>

<script type="text/javascript">
     $( "#search_businessassignments_fromdate" ).datepicker({
      todayHighlight: true,
      autoclose  : true,
      Format : 'dd-mm-yy'
});

 $( "#search_businessassignments_todate" ).datepicker({
    todayHighlight: true,
    autoclose  : true,
    Format : 'dd-mm-yy'
});


</script>