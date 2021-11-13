<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>
<style type="text/css">
    .about-video {
    background: url('/<?php echo base_url();?>assets/images/background/photo-1522441815192-d9f04eb0615c.jpg');
  background-repeat: no-repeat;
  background-position:center;
  background-size: 100% 100%;
}

.video_class{
    width:640px ;
    height: 360px;
   }


@media (max-width: 767px) {
.about-video {
    height: 360px;
} 
.video_class{
     width:300px; 
     height:180px;
}


}
.row {
     margin-right: 0px; 
 }

</style>
<!-- ==============================================
**Inner Banner**
=================================================== -->

         <?php  if(isset($banner)&&count($banner)>0){
         foreach($banner as $row => $data)  {  if($row==0){ ?>
        <section class="inner-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->image; ?>') no-repeat center fixed;
    background-size:100% 100%;">
            <div class="container">
                <div class="contents">
                    <h1><?php echo $data->banner_title; ?></h1>
                    <p><?php echo $data->banner_content;  ?></span></p>
                </div>
            </div>
        </section>

 <?php } } }?>

<!-- ==============================================
**Who we Are**
=================================================== -->
        <section class="who-we-are padding-lg">
            <div class="container">
                <div class="row row1">
                    <div class="col-lg-6 section--purple wow slideInRight" data-wow-delay="1000">
                        <figure><img src="/<?php echo base_url();?>assets/images/banners/who-we-are.jpg" class="img-fluid" alt="About Bizbrainz " ></figure>
                    </div>
                    <div class="col-lg-6 section--purple wow slideInLeft" data-wow-delay="1000">
                        <div class="cnt-block">
                            <h2>Who <span class="bulecolor"> We Are </span> </h2>
                            <p class="text_align_justify">Bizbrainz is one of the best information technology services and businesses development company providing Automation needs of businesses across various domains and is stimulated by a group of qualified and experienced professionals from Information Technology Industry, having combined business experience of more than 16years.</p>
                            <p class="text_align_justify">
                            Team Bizbrainz build creative IT development solutions and services using both web and digital technologies, incorporated with collective technical, business and industry expertise.
                            We have a highly skilled team of developers, integrators and testers with expertise in various domains and platforms. </p>
                         
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==============================================
**Our Features opt3**
=================================================== -->
        <section class="client-speak our-features padding-lg">
            <div class="container">
                <div class="row justify-content-center head-block">
                 <!--    <div class="col-md-10"> <span>Our Features</span> -->
                         <h2>Why <span class="bulecolor"> Choose Us ? </span> </h2>
                        <p class="hidden-xs">Team bizbrainz helps organizations execute their business strategies by conferring with clients to build effective services, innovate and grow, reduce costs, manage risk and regulation. Our objective is to support you in designing, managing and executing continuous beneficial change. We combine the strengths of local relationships and to deliver solutions to your business needs.
                       </p>
                    </div>
                </div>
                <ul class="row features-listing bg-none">
                    <li class="col-md-6">
                        <div class="inner"> <span class="icon"><span class="icon-analytics"></span></span>
                               <h2>Our <span class="bulecolor">Mission </span> </h2>
                            <p>Our mission is to create a long term relationship with our clients by providing the latest innovative, cost-effective and high-quality IT solutions and services</p>
                        </div>
                    </li>
                    <li class="col-md-6">
                        <div class="inner"> <span class="icon"><span class="icon-responsive"></span></span>
                            <h2>Our <span class="bulecolor">Vision </span> </h2>
                            <p>Our vision is providing services for amazing digital experiences and help their business development in information technology.</p>
                        </div>
                    </li>
                   
                </ul>
            
        </section>

<!-- ==============================================
**Who we Are**
=================================================== -->
        <section class="who-we-are padding-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 padding-lg">
                        <ul class="counter-listing">
                            <?php  if(isset($countlist)&&count($countlist)>0){
                                foreach($countlist as $row => $data)  {  if($row==0){ ?>

                            <li> 
                                <span class="counter" data-num="<?php echo $data->establishedyear;  ?>"><?php echo $data->establishedyear;  ?></span>
                                <span class="sub-title">ESTABLISHED IN</span>
                            </li>
                            <li>
                                <div class="couter-outer"><span class="counter" data-num="<?php echo $data->clientcount;  ?>"><?php echo $data->clientcount;  ?></span><span>+</span></div>
                                <span class="sub-title">CLIENTS</span>
                            </li>
                            <li>
                                <div class="couter-outer"><span class="counter" data-num="<?php echo $data->projectcount;  ?>"><?php echo $data->projectcount;  ?></span><span>+</span></div>
                                <span class="sub-title">PROJECTS COMPLETED</span>
                            </li>
                            <li>
                                <div class="couter-outer"><span class="counter" data-num="<?php echo $data->teamcount;  ?>"><?php echo $data->teamcount;  ?></span><span>+</span></div>
                                <span class="sub-title">TEAM MEMBERS</span>
                            </li>
                            
                           <?php } } }?>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
<!-- ==============================================
**Take a Tour Section**
=================================================== -->
        <section class="about-video">
            <div class="container">
                <div class="cnt-block"> 
                    <div class=" col-12 col-md-12 col-lg-12" > 
                        <iframe  class="video_class"src="https://www.youtube.com/embed/mmdwfCbASi0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                       <!--  <video class="video_class" autoplay controls>
                          <source  src="/<?php echo base_url();?>assets/images/background/BB_New1.mp4" type="video/mp4">
                      </video> -->
                   </div>
            </div>
          </div>
        </section>




<?php
include('static/Frontend_Empty_footer.php');
?>