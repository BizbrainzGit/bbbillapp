<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>

<!-- ==============================================
**Inner Banner**
=================================================== -->

    <?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {  if($row==0){ ?>
        <section class="inner-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->image; ?>') no-repeat center fixed;
    background-size:100% 100%;">
            <div class="container">
                <div class="contents">
                    <h1><?php echo $data->banner_title;  ?></h1>
                    <p><?php echo $data->banner_content;  ?></span></p>
                </div>
            </div>
        </section>

 <?php } } }?>

<!-- ==============================================
**Product Listing**
=================================================== -->
    <section class="shop-grid padding-lg latest-stories">
        <div class="container">
             <!-- <div class="row justify-content-center head-block">
                    <div class="col-md-10"> 
                        <h2>Clients <span class="bulecolor"> Projects </span> </h2>
                        <p class="hidden-xs">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy</p>
                    </div>
                </div> -->

            <div class="row">
                <!-- Start Sidebar -->
                <!-- <div class="col-md-4 col-lg-3 shop-sidebar">
                    <div class="product-categories">
                        <h3>Projects Categories</h3>
                        <ul class="anyClass">
                            <div id="productcategoriesListview"></div>
                        </ul>
                    </div>
                </div> -->
                <!-- End Sidebar -->
                
                <!-- Start Product Listing -->
                <div class="col-md-12 col-lg-12">
                    <ul class="row Product-listing right-sec">
                        <div class="col-md-2 col-lg-2 shop-sidebar"></div>
                        <div class="col-md-8 col-lg-8 shop-sidebar">
                             <form  method="Post" class="search-outer d-flex">
                                   <select class="form-control" name="search_forntview_project_category" id="search_forntview_project_category">
                                         </select>
                                  <button type="button" class="go-btn" id="searchprojectscategory"><span class="icon-search"></span></button>
                            </form>
                            <div id="search_project_category-msg"></div>
                        </div>

                        <div class="row" id="clientprojectslistforproducts"></div>
                      
                    </ul>
                    <!-- <div class="paging-block">
                        <ul>
                            <li><a href="#" class="prev"><span class="icon-left-arrow"></span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#" class="dots"><span class="icon-paging-dots"></span></a></li>
                            <li><a href="#">43</a></li>
                            <li><a href="#" class="next"><span class="icon-right-arrow"></span></a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- End Product Listing -->
            </div>
        </div>
    </section>
<?php
include('static/Frontend_Empty_footer.php');
?>