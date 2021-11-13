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
**Latest Stories opt3**
=================================================== -->
        <section class="latest-stories padding-lg">
            <div class="container">
                <!-- <div class="row justify-content-center head-block">
                    <div class="col-md-10"> 
                        <h2>Our <span class="bulecolor"> Products </span> </h2>
                        <p class="hidden-xs">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy</p>
                    </div>
                </div> -->
                <div class="card-deck blog-blocks">
                    
                    <div class="row" id="ourprojectslistforproducts"></div>

                   <!--  <div class="card">
                        <figure><img src="/<?php echo base_url();?>assets/forntend/images/blog-img1.jpg" class="img-fluid" alt=""></figure>
                        <div class="card-body">
                            <h3><a href="blog-grid.html">Lorem Ipsum is simply dummy text of the printin...</a></h3>
                        </div>
                    </div>
                    <div class="card">
                        <figure><img src="/<?php echo base_url();?>assets/forntend/images/blog-img2.jpg" class="img-fluid" alt=""></figure>
                        <div class="card-body">
                            <h3><a href="blog-grid.html">Lorem Ipsum is simply dummy text of the printin...</a></h3>
                       </div>
                    </div>
                    <div class="card">
                        <figure><img src="/<?php echo base_url();?>assets/forntend/images/blog-img3.jpg" class="img-fluid" alt=""></figure>
                        <div class="card-body">
                            <h3><a href="blog-grid.html">Lorem Ipsum is simply dummy text of the printin...</a></h3>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>


<?php
include('static/Frontend_Empty_footer.php');
?>