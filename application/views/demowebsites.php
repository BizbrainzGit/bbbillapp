<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Empty_Header.php');
?>
 <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper">
       <div class="container">
           <div class="card content">
                <div class="card-body">
                  <div class="row mt-3 mb-3 pb-4 pt-4" >
                     <div class="col-md-4 col-12 text-center">
                         <div class="brand-logo">
                           <img src="/<?php echo base_url();?>assets/images/BizBrainz_logo.PNG" style="height:100px;" alt="logo"/>
                          </div>
                     </div>
                     <div class="col-md-8 col-12 text-center">
                      <div class="row clearfixed"> 
                        <div class="col-12 col-lg-12 col-md-12 "> <h2> Choose  Beautiful Looking Themes</h2>
                       <h4>Find the Right Look and Feel for Your Business </h4></div>
                       <div class="col-12 col-lg-12 col-md-12 text-center mt-3 mb-3" >
                            <form id="search_demowebsite_email" method="post" >
                                 <div class="row clearfix" >
                                   <div class="col-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <select class="form-control" placeholder="Search Websites" name="search_bemail_website" id="search_demowebsite_emaillink" style="width: 100%;"></select>
                                   </div>
                                  </div>
                                  <div class="col-12 col-lg-12 col-md-12" style="text-align: center;">
                                  <button  type="button" id="searchdemowebsiteemail" class="btn btn-primary">Search</button>
                                  </div> 
                               </div> 
                         </form>
                       </div>
                      </div>
                     </div>
                  </div>
                 <div class="row"> 
                  <div class=" col-lg-12 col-md-12 col-12" id="search_demowebsite_emaillink-msg"></div>
                </div>
<!-- 
                  <div class="row" id="berfore_search_demowebsitesemail">
                  <?php
                            for($i=0;$i<count($weblist);$i++)
                            {
                                 ?>

                  <div class="col-md-4 col-6 form-group"><div class="demoweb card"><img src="/<?php echo base_url();?><?php echo $weblist[$i]['web_photo'] ?>" alt="web image" class="image"><div class="container"><h6 class="p-2"><?php echo $weblist[$i]['web_name'] ?></h6></div><div class="overlay"><div class="text"><a  href="<?php echo $weblist[$i]['web_url'] ?>" class="btn btn-info btn-rounded btn-fw mb-3" target="_blank">Live Demo</a><a  href="<?php echo $weblist[$i]['web_url'] ?>" class="btn btn-light btn-rounded btn-fw" target="_blank">Preview</a></div></div></div></div>

                
                <?php  } ?>
             </div> -->
             <div class="row" id="demowebsitesemaillink"></div>
           </div>
        </div>
      </div>
   
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<?php
include('static/Empty_Footer.php');
?>
