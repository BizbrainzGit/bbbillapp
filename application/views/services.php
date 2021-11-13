<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('static/Frontend_Empty_header.php');
?>
<style type="text/css">
  
    .comingsoon {
    width: 100%;
    height: 100%;
     position: static; 
    display: table;
    background: url('/<?php echo base_url();?>assets/images/background/12.jpg') no-repeat center fixed;
    background-size: cover;
}

</style>

<?php  if(isset($servicecontent)){
       if(count($servicecontent)>0){
       foreach($servicecontent as $row => $data) {  ?> 

<!-- ==============================================
**Inner Banner**
=================================================== -->
 

        <section class="inner-banner how-it-works-banner" style=" background: url('/<?php echo base_url();?><?php echo $data->bannerimage; ?>') no-repeat center fixed;
    background-size: cover;">
            <div class="container">
                <div class="contents">
                    <h1><?php echo $data->bannertitle; ?></h1>
                    <p><?php echo $data->bannercontent; ?></span></p>
                </div>
            </div>
        </section>

<!-- ==============================================
**How it works**
=================================================== -->
<?php  if($data->section1_heading!=null||$data->section1_content!=null) { ?>
        <section class="how-it-work-items padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 section--purple wow slideInRight text_align_justify" data-wow-delay="900">
                           <!--  <div class="text-area"> -->
                                <h2 class="text-center mb-4"><?php echo $data->section1_heading; ?></h2>
                                <?php echo $data->section1_content; ?>
                              <!--   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since been</p> -->
                          <!--   </div>
                         -->
                    </div>
                    <div class="col-md-5 section--purple wow slideInLeft" data-wow-delay="900">
                        <figure class="right" style="margin-top: 60px;"><img src="/<?php echo base_url();?><?php echo $data->section1_image; ?>" class="img-fluid" alt="<?php echo $data->section1_image_alt; ?>"></figure>
                    </div>
                </div>

            </div>
        </section>
      

      <?php } if($data->section2_heading!=null||$data->section2_content!=null) { ?>
        <section class="how-it-work-items">
            <div class="container">
                <div class="row">
                    
                     <div class="col-md-5 section--purple wow slideInRight " data-wow-delay="900">
                        <figure class="right"><img src="/<?php echo base_url();?><?php echo $data->section2_image; ?>" class="img-fluid" alt="<?php echo $data->section2_image_alt; ?>" ></figure>
                    </div>

                    <div class="col-md-7 section--purple wow slideInLeft text_align_justify" data-wow-delay="900">
                           <!--  <div class="text-area"> -->
                                <h2 class="text-center mb-4"><?php echo $data->section2_heading; ?></h2>
                                <?php echo $data->section2_content; ?>
                              <!--   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since been</p> -->
                          <!--   </div>
                         -->
                    </div>

                    

                  
                </div>

            </div>
        </section>
      


       <?php  } if($data->section3_heading!=null||$data->section3_content!=null) { ?>
        <section class="how-it-work-items padding-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 section--purple wow slideInRight text_align_justify" data-wow-delay="900">
                           <!--  <div class="text-area"> -->
                                <h2 class="text-center mb-4"><?php echo $data->section3_heading; ?></h2>
                                <?php echo $data->section3_content; ?>
                              <!--   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since beenLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since been</p> -->
                          <!--   </div>
                         -->
                    </div>

                      <div class="col-md-5 section--purple wow slideInLeft" data-wow-delay="900">
                        <figure class="right"><img src="/<?php echo base_url();?><?php echo $data->section3_image; ?>" class="img-fluid" alt="<?php echo $data->section3_image_alt; ?>"></figure>
                     </div>
                </div>

            </div>
        </section>
      


            <?php } } } else if(count($servicecontent)==0){ ?>
                <!-- ==============================================
**Coming Soon**!isset($_REQUEST['submit'])
=================================================== -->
        <section class="comingsoon">
            <div class="countdown-container">
                <div class="countdown-wrapper">
                    <h1>Coming Soon</h1>
                    <p> Our Service Page is Construction, We'll be here soon with new awesome page !
                       <!--  We're working hard to give you the best experience! -->
                    </p>
                    <!-- <div class="social-media-box">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div> -->
                    <h3>Service page be ready in Few Days....</h3>
                  <!--   <ul class="count-dwn-cnt clearfix">
                        <li><span class="days count">00</span><span>Days</span></li>
                        <li><span class="hours count">00</span><span>Hours</span></li>
                        <li><span class="minutes count">00</span><span>Minutes</span></li>
                        <li><span class="seconds count">00</span><span>Seconds</span></li>
                    </ul> -->
                </div>
            </div>
        </section>


         <?php   }}?>

<?php
include('static/Frontend_Empty_footer.php');
?>