<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>
 <style>


  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  .background-img-projects{
  background-image: url("/<?php echo base_url();?>assets/images/background/449903.jpg");
  background-repeat: no-repeat;
  background-position:center;
  background-size: 100% 100%;

}

.background-img-products{
  background-image: url("/<?php echo base_url();?>assets/images/background/background1.jpg");
  background-repeat: no-repeat;
  background-position:center;
  background-size: 100% 100%;

}



/*.underline {
  background-repeat: repeat-x;
}*/

.underline--stars {
  background-image: url("/<?php echo base_url();?>assets/images/Logo_Underilne.png");
  background-repeat: no-repeat;
  height: 50px;
  background-position:center;
  background-size: 100%;
}

/*.carousel-inner .carousel-item {
  transition: -webkit-transform 2s;
  transition: transform 2s;
  transition: transform 2s, -webkit-transform 2s ;
}*/
.marigin_top50_class{
   margin-top: 50px;
}

.carousel-item {
    -webkit-perspective: 500px;
    perspective: 500px;
}

  </style>

<!-- ==============================================
**Banner Slider**
=================================================== -->
<section class="container-fuild" >
    <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
  <!--   <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li> -->

    <?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {      
                    
                       if($row==0){
                                 $active='data-slide-to="'.$row.'" class="active"';
                             }else{
                                 $active='data-slide-to="'.$row.'" class="active"';
                                }
                           ?>                                               
              <li data-target="#demo" <?php echo $active ?> ></li>
             
               <?php } }?>

  </ul>
  <div class="carousel-inner">
    <?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {    
                      if($row==0){
                                 $active='class="carousel-item active"';
                             }else{
                                 $active='class="carousel-item"';
                                }
                           ?> 
    <div <?php echo $active ?>  >
      <img src="/<?php echo base_url();?><?php echo $data->image;?>" alt="<?php echo $data->image_alt;?>" width="1100" height="500">
      <div class="carousel-caption animated fadeInRight delay-02s">
        <h3 ><?php echo $data->banner_title;  ?></h3>
        <p><?php echo $data->banner_content;  ?></p>
      </div>   
    </div>

 <?php } }?> 

  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</section>

<!-- ==============================================
**Simple Editor**
=================================================== -->
        <section class="simple-editor padding-lg">
            <div class="container">
                <div class="row"> 
                  <!-- class=""  -->
                    <div class="col-sm-12 col-md-12 col-lg-5 cnt-block text_align_justify section--purple wow slideInLeft" data-wow-delay="900" >
                        <h2 >Welcome To <span class="bulecolor">BizBrainz </span></h2>
                       <!--  <span class="underline underline--stars"></span>  -->
                        <!-- <img src="/<?php echo base_url();?>assets/images/Logo_Underilne.png" width="500" > -->
                        <p>Bizbrainz is a goal-oriented and technologically advanced corporate IT company which aims at providing the most impressive services in the fields of Website design, web development, Mobile, applications, E-commerce and online marketing. We began our journey in the year 2019, with a vision of providing businesses with amazing digital experiences and help their business grow.</p>
                        <a href="/<?php echo base_url();?>About-Us" class="know-more mt-2 right">Know more</a> 
                      </div>

                <div class="col-sm-12 col-md-12 col-lg-7 mt-4">
                  <figure class="img">
					        <div id="buynowimages" class="carousel slide" data-ride="carousel">
  						     <ul class="carousel-indicators">
                          <?php  if(isset($buynowimg)&&count($buynowimg)>0){
                             foreach($buynowimg as $row => $data)  {      
                                 if($row==0){
                                           $active='data-slide-to="'.$row.'" class="active"';
                                       }else{
                                           $active='data-slide-to="'.$row.'" class="active"';
                                          }
                                     ?>                                               
                              <li data-target="#buynowimages" <?php echo $active ?> ></li>
                         <?php } }?>
  						     </ul>
						       <div class="carousel-inner">
                   <?php  if(isset($buynowimg)&&count($buynowimg)>0){
                     foreach($buynowimg as $row => $data)  {    
                            if($row==0){
                                 $active='class="carousel-item active"';
                              }else{
                                 $active='class="carousel-item"';
                                }
                            ?> 
                 <div <?php echo $active ?>  >
                 <img src="/<?php echo base_url();?><?php echo $data->image;?>" alt="<?php echo $data->image_alt;?>" class="img-fluid">
                 <!-- <div class="carousel-caption animated fadeInRight delay-02s">
                    <h3 ><?php echo $data->buynowimg_title;  ?></h3>
                 </div>   --> 
               </div>

             <?php } }?> 

  </div>   

						
						  <a class="carousel-control-prev" href="#buynowimages" data-slide="prev">
						    <span class="carousel-control-prev-icon"></span>
						  </a>
						  <a class="carousel-control-next" href="#buynowimages" data-slide="next">
						    <span class="carousel-control-next-icon"></span>
						  </a>

                </div>
  
						</figure>
                <a class="btn apply-now buynowbutton  wow slideInLeft"target="_blank" href="/<?php echo base_url();?>buynow"  data-wow-duration="800ms">BUY NOW</a>

                    </div>
                </div>
            </div>
        </section>

        <!-- ==============================================
**Generate Forms**
=================================================== -->

 <section class="still-hav-qtns-outer padding-lg">
            <div class="container">
                <h2>Our <span class="bulecolor"> Services </span> </h2>
                <ul class="row features-listing">
                   
                    <?php  if(isset($services)){
                     foreach($services as $row => $data) {  ?> 

                    <li class="col-lg-4 col-md-6 col-sm-6 equal-hight">
                        <div class="info-content"> 
                            <span class="icon-holder">
                              <!-- <img src="/<?php echo base_url();?>assets/images/services/site-img35.png" width="100px" height="100px" alt=""> --> 
                               <img src="/<?php echo base_url();?><?php echo $data->image; ?>" width="100px" height="100px" alt=" <?php echo $data->image_alt; ?> "> 
                            </span>
                            <h3><?php echo $data->service_title; ?></h3>
                            <p class="text_align_justify"><?php echo $data->service_content; ?></p>
                            <a href="/<?php echo base_url();?><?php echo $data->service_url; ?>" class="know-more">Know more</a> 
                        </div>
                    </li>
                 <?php } } ?>

                

                </ul>
            </div>
        </section>

<!-- ==============================================
**Banner Options**
=================================================== -->
        <section class="demo-wrapper background-img-products padding-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 data-aos="fade-right" style="transition-timing-function: linear;">Our <span class="bulecolor"> Products </span> </h2>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p> -->
                    </div>
                </div>
            <!-- </div>
            <div class="container lg"> -->
                <ul class="row theme-demo-listing">

                    <?php  if(isset($ourprojects)){
                     foreach($ourprojects as $row => $data) {  ?> 

                      <li class="col-6 col-md-6 col-lg-3 section--purple wow slideInRight" data-wow-delay="900">
                        <div class="top-bar"><img src="/<?php echo base_url();?>assets/images/projects/top-bar.png" alt="projects_top_bar"></div>
                        <div class="thumbnail-holder text-center">
                            <figure><img src="/<?php echo base_url();?><?php echo $data->image; ?>" alt="<?php echo $data->image_alt; ?>" width="400px" height="200px"></figure>
                             <h4><b class="text-uppercase"><?php echo $data->project_title; ?></b></h4>
                            <div class="mask">
                                <div class="inner">
                                    <h3 class="text-uppercase"><?php echo $data->project_title; ?></h3>
                                    <!-- <a href="banner-solid.html" class="ovelay-icon">
                                    <span class="icon-go"></span></a>  -->
                                    <!-- <div class="mt-2"><a href="#" class="know-more"></a></div>
                                    <div class="mt-2"><a href="#" class="know-more"></a></div>  -->
                                    <div class="box">
                                    <ul class="blog-tag">
                                        <li><a href="<?php echo $data->project_url; ?>" target="_blank">View</a></li>
                                        <br>
                                        <li><a href="/<?php echo base_url();?>Our-Products">Know More</a></li>
                                    </ul>
                                  </div>

                                </div>
                            </div>
                        </div>
                         <div class="top-bar"><img src="/<?php echo base_url();?>assets/images/projects/bottom-bar.png" alt="projects_bottom_bar"></div>
                    </li>

                <?php } } ?>
                 
                    
                </ul>
            </div>
        </section>


<!-- ==============================================
**Latest Stories**
=================================================== -->
        <section class="latest-stories padding-lg background-img-projects">
            <div class="container">
                <div class="row justify-content-center head-block">
                    <div class="col-md-10">
                        <h2>Our <span class="bulecolor"> Projects</span></h2>
                    </div>
                </div>
                <div class="card-deck blog-blocks">
                    <?php  if(isset($clientprojects)){
                     foreach($clientprojects as $row => $data) {  ?> 

                    <div class="card project-card section--purple wow slideInLeft" data-wow-delay="900">
                        <figure><img src="/<?php echo base_url();?><?php echo $data->image; ?>" class="img-fluid" alt=" <?php echo $data->image_alt; ?> "></figure>
                         <div class="card-body">
                            <h3 class="text-uppercase text-center"><strong><?php echo $data->project_title; ?></strong></h3>
                         </div>
                         <div class="project-overlay">
                           <div class="project-text">
                            <?php if($data->certification_image==null){$image=$data->image;}else{$image=$data->certification_image;} ?>
                            <img src="/<?php echo base_url();?><?php 
                            echo $image; ?>" class="img-fluid" alt=" <?php echo $data->certification_image_alt; ?> ">
                            <div class="project-link mt-2">
                                <a href="<?php echo $data->project_url; ?>" class="know-more" target="_blank" >View</a> 
                                <a href="/<?php echo base_url();?>Clients-Projects" class="know-more" >Know More</a>
                            </div>
                        </div>
                        </div>
                    </div>
                     <?php } } ?>

                </div>
            </div>
        </section>



<?php
include('static/Frontend_Empty_footer.php');
?>